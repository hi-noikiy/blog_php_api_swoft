<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers;

use App\Common\Code\Code;
use App\Common\Controller\ApiController;
use App\Common\Utility\Qiniu;
use App\Models\Entity\SystemLog;
use App\Models\Logic\IndexLogic;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Swoft\App;
use Swoft\Core\Coroutine;
use Swoft\Bean\Annotation\Inject;
use Swoft\Core\RequestContext;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\View\Bean\Annotation\View;
use Swoft\Task\Task;
use Swoft\Core\Application;
use Swoft\Http\Message\Server\Request;
use Swoole\WebSocket\Server;
use Swoft\HttpClient\Client;

/**
 * 控制器demo
 * @Controller(prefix="/demo")
 */
class DemoController extends ApiController
{

    /**
     * 别名注入
     *
     * @Inject("httpRouter")
     *
     * @var \Swoft\Http\Server\Router\HandlerMapping
     */
    private $router;

    /**
     * 别名注入
     *
     * @Inject("application")
     *
     * @var Application
     */
    private $application;


    /**
     * 注入逻辑层
     * @Inject()
     *
     * @var IndexLogic
     */
    private $logic;

    /**
     * 定义一个route,支持get和post方式，处理uri=/demo2/index
     *
     * @RequestMapping(route="index", method={RequestMethod::GET, RequestMethod::POST})
     *
     * @param Request $request
     *
     * @return object
     */
    public function index(Request $request)
    {


        $ffmeg = FFMpeg::create();
        $file = 'http://mp4.vjshi.com/2018-09-21/d5a88ce26f84c6fdf6de8db499e1ea40.mp4';
        $video  =$ffmeg->open($file);
        var_dump($video->getFormat()->get('duration'));
        return;
//        $frame  = $video->frame(TimeCode::fromSeconds(1));
//        var_dump($frame->);

//        $client = new Client();
////        $result = $client->request('get', 'http://mp4.vjshi.com/2018-09-21/d5a88ce26f84c6fdf6de8db499e1ea40.mp4')->getResponse()->getHeaders();
//
//        $movie = new \ffmpeg_movie($file);
//        var_dump($movie);

//        var_dump(exec("ffmpeg -i $file"));
//        $res = exec("ffmpeg -i $file 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,// ");
//        var_dump($res);
//        var_dump($result['']);
//
//        return $this->respondWithArray($request->file('file')->toArray());
    }

    /**
     * 定义一个route,支持get,以"/"开头的定义，直接是根路径，处理uri=/index2
     * @RequestMapping(route="/index2", method=RequestMethod::GET)
     */
    public function index2()
    {
        Coroutine::create(function () {
            var_dump(Coroutine::id());
            App::trace('this is child trace' . Coroutine::id());
            Coroutine::create(function () {
                var_dump(Coroutine::id());
                App::trace('this is child child trace' . Coroutine::id());
            });
        });

        return 'success';
    }

    /**
     * 没有使用注解，自动解析注入，默认支持get和post
     */
    public function task()
    {
        $result = Task::deliver('test', 'corTask', ['params1', 'params2'], Task::TYPE_CO);
        $mysql = Task::deliver('test', 'testMysql', [], Task::TYPE_CO);
        $http = Task::deliver('test', 'testHttp', [], Task::TYPE_CO, 20);
        $rpc = Task::deliver('test', 'testRpc', [], Task::TYPE_CO, 5);
        $result1 = Task::deliver('test', 'asyncTask', [], Task::TYPE_ASYNC);

        return [$rpc, $http, $mysql, $result, $result1];
    }

    public function index6()
    {
        throw new Exception('AAAA');
        //        $a = $b;
        $A = new AAA();

        return ['data6'];
    }

    /**
     * 子协程测试
     */
    public function cor()
    {
        // 创建子协程
        Coroutine::create(function () {
            App::error('child cor error msg');
            App::trace('child cor error msg');
        });

        // 当前协程id
        $cid = Coroutine::id();

        // 当前运行上下文ID, 协程环境中，顶层协程ID; 任务中，当前任务taskid; 自定义进程中，当前进程ID(pid)
        $tid = Coroutine::tid();

        return [$cid, $tid];
    }

    /**
     * 国际化测试
     */
    public function i18n()
    {
        $data[] = translate('title', [], 'zh');
        $data[] = translate('title', [], 'en');
        $data[] = translate('msg.body', ['stelin', 999], 'en');
        $data[] = translate('msg.body', ['stelin', 666], 'en');

        return $data;
    }

    /**
     * 视图渲染demo - 没有使用布局文件
     * @RequestMapping()
     * @View(template="demo/view")
     */
    public function view()
    {
        $data = [
            'name' => 'Swoft',
            'repo' => 'https://github.com/swoft-cloud/swoft',
            'doc' => 'https://doc.swoft.org/',
            'doc1' => 'https://swoft-cloud.github.io/swoft-doc/',
            'method' => __METHOD__,
        ];

        return $data;
    }

    /**
     * 视图渲染demo - 使用布局文件
     * @RequestMapping()
     * @View(template="demo/content", layout="layouts/default.php")
     */
    public function layout()
    {
        $layout = 'layouts/default.php';
        $data = [
            'name' => 'Swoft',
            'repo' => 'https://github.com/swoft-cloud/swoft',
            'doc' => 'https://doc.swoft.org/',
            'doc1' => 'https://swoft-cloud.github.io/swoft-doc/',
            'method' => __METHOD__,
            'layoutFile' => $layout,
        ];

        return $data;
    }

}
