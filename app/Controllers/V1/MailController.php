<?php

namespace App\Controllers\V1;

use App\Common\Enums\SmsEnum;
use App\Common\Utility\Mail;
use App\Common\Validate\SmsValidate;
use App\Models\Entity\SmsRecord;
use App\Models\Services\SmsService;
use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use App\Common\Code\Code;
use App\Common\Controller\ApiController;
use Swoft\Http\Message\Server\Request;
use Exception;

/**
 * @Controller(prefix="/v1/mail")
 * @Middleware(SignMiddleware::class)
 */
class MailController extends ApiController
{

    /**
     * @Inject()
     * @var SmsService
     */
    private $SmsService;

    /**
     * @RequestMapping(route="send", method=RequestMethod::POST)
     *
     * @return string
     * @throws Exception
     */
    public function send()
    {


        $res = Mail::send(['741696717@qq.com']);

        return $this->setMessage('短信发送成功')->respondWithArray($res);
    }

    /**
     * @RequestMapping(route="notify", method={RequestMethod::GET,RequestMethod::POST})
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function notify(Request $request)
    {

        $res = json_decode($request->raw(), true);

        if ($res) {
            foreach ($res as $item) {
                SmsRecord::updateOne([
                    'send_time' => $item['send_time'],
                    'report_time' => $item['report_time'],
                    'err_msg' => $item['err_msg'],
                    'status' => $item['success'] ? 1 : 2
                ], ['biz_id' => $item['biz_id']]);
            }
        }

        return ['code' => 0, 'msg' => '接受成功'];
    }
}