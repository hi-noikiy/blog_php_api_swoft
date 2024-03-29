<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Exception;

use App\Common\Code\Code;
use App\Controllers\TaskController;
use App\Models\Entity\SystemLog;
use App\Models\Entity\SystemTrace;
use App\Tasks\LogTask;
use Swoft\App;
use Swoft\Bean\Annotation\ExceptionHandler;
use Swoft\Bean\Annotation\Handler;
use Swoft\Exception\RuntimeException;
use Exception;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Server\Response;
use Swoft\Exception\BadMethodCallException;
use Swoft\Exception\ValidatorException;
use Swoft\Http\Server\Exception\BadRequestException;
use Swoft\Task\Task;

/**
 * the handler of global exception
 *
 * @ExceptionHandler()
 * @uses      Handler
 * @version   2018年01月14日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class SwoftExceptionHandler
{
    /**
     * @Handler(Exception::class)
     *
     * @param Response $response
     * @param \Throwable $throwable
     *
     * @return Response
     */
    public function handlerException(Response $response, \Throwable $throwable)
    {
//        $file      = $throwable->getFile();
//        $line      = $throwable->getLine();

        $code = $throwable->getCode();
        $message = $throwable->getMessage();

        if ($throwable instanceof ExtendDataException) {
            $bodyData = $throwable->getData();
        } else {
            $bodyData = new \stdClass();
        }


        $data = [
            'code' => $code,
            'data' => $bodyData,
            'msg' => $message,
//            'file' => $throwable->getFile(),
//            'line' => $throwable->getLine(),
        ];

        /* @var LogTask */
        if (!$throwable instanceof ValidatorException) {
            $requset = [
                'access_token' => \Swoft::swoole_header('access_token'),
                'uri' => \request()->getUri()->getPath(),
                'method' => \request()->getMethod(),
                'param' => json_encode(empty(\Swoft::param()) ? new \stdClass() : \Swoft::param(), JSON_UNESCAPED_UNICODE),
                'ip' => \Swoft::ip()
            ];
            Task::deliver('Log', 'record', [$throwable->getMessage(), $throwable->getLine(), $throwable->getFile(), $throwable->getTraceAsString(), $requset], Task::TYPE_ASYNC);
        }
        return $response->json($data);
    }

    /**
     * @Handler(RuntimeException::class)
     *
     * @param Response $response
     * @param \Throwable $throwable
     *
     * @return Response
     */
    public function handlerRuntimeException(Response $response, \Throwable $throwable)
    {
        $file = $throwable->getFile();
        $code = $throwable->getCode();
        $exception = $throwable->getMessage();

        return $response->json([$exception, 'runtimeException']);
    }

    /**
     * @Handler(ValidatorException::class)
     *
     * @param Response $response
     * @param \Throwable $throwable
     *
     * @return Response
     */
    public function handlerValidatorException(Response $response, \Throwable $throwable)
    {
        $data = [
            'code' => Code::INVALID_PARAMETER,
            'data' => new \stdClass(),
            'msg' => $throwable->getMessage(),
        ];

        return $response->json($data);
    }

    /**
     * @Handler(BadRequestException::class)
     *
     * @param Response $response
     * @param \Throwable $throwable
     *
     * @return Response
     */
    public function handlerBadRequestException(Response $response, \Throwable $throwable)
    {
        $data = [
            'code' => $throwable->getCode(),
            'data' => new \stdClass(),
            'msg' => $throwable->getMessage(),
        ];
        return $response->json($data);
    }

    /**
     * @Handler(BadMethodCallException::class)
     *
     * @param Request $request
     * @param Response $response
     * @param \Throwable $throwable
     *
     * @return Response
     */
    public function handlerViewException(Request $request, Response $response, \Throwable $throwable)
    {
        $name = $throwable->getMessage() . $request->getUri()->getPath();
        $notes = [
            'New Generation of PHP Framework',
            'Hign Performance, Coroutine and Full Stack',
        ];
        $links = [
            [
                'name' => 'Home',
                'link' => 'http://www.swoft.org',
            ],
            [
                'name' => 'Documentation',
                'link' => 'http://doc.swoft.org',
            ],
            [
                'name' => 'Case',
                'link' => 'http://swoft.org/case',
            ],
            [
                'name' => 'Issue',
                'link' => 'https://github.com/swoft-cloud/swoft/issues',
            ],
            [
                'name' => 'GitHub',
                'link' => 'https://github.com/swoft-cloud/swoft',
            ],
        ];
        $data = compact('name', 'notes', 'links');

        return view('exception/index', $data);
    }

}