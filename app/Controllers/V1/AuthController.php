<?php

namespace App\Controllers\V1;


use App\Common\Code\Code;
use App\Common\Controller\ApiController;
use App\Common\Factory\AuthFactory;
use App\Common\Mapping\AuthInterface;
use App\Common\Utility\Token;
use App\Common\Validate\AuthValidate;
use App\Exception\InvaildTokenException;
use App\Models\Services\AuthServices\PasswordAuthService;
use Swoft\App;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/v1/auth")
 * @Middleware(SignMiddleware::class)
 */
class AuthController extends ApiController
{


    /**
     * @RequestMapping(route="signin", method=RequestMethod::POST)
     * @param Request $request
     * @return string
     */
    public function signin(Request $request)
    {
        /* @var AuthValidate */
        $this->validate('App\Common\Validate\AuthValidate.signin');
        $login_type = $request->post('login_type');

        /* @var AuthInterface $auth */
        $auth = AuthFactory::getService($login_type);
        $data = $auth->auth($request->post());

        return $this->respondWithArray($data);
    }

    /**
     * @RequestMapping(route="signup", method=RequestMethod::GET)
     * @param Request $request
     * @return string
     */
    public function signup(Request $request)
    {

        return $request->getAttribute('uid');
        return $this->respondWithArray();
    }


    /**
     * @RequestMapping(route="/v1/refresh", method=RequestMethod::POST)
     * @param Request $request
     * @return string
     */
    public function refresh(Request $request)
    {
        /* @var AuthValidate */
        $this->validate('App\Common\Validate\AuthValidate.refresh');
        $refresh_token = $request->post('refresh_token');

        $refresh_token_key = sprintf("%s:%s", Token::REFRESH_TOKEN, $refresh_token);

        $ttl = redis()->ttl($refresh_token_key);

        if ($ttl == -2) {
            throw new InvaildTokenException('refresh_token已失效', Code::INVALID_TOKEN);
        }
        $hData = redis()->hgetall($refresh_token_key);
        //refresh_token小于一个半小时 则不刷新返回原来的token
        if ($ttl < Token::refresh_expires - Token::expires + 1800) {

        } else {
            $data = [
                'access_token' => $hData['access_token'],
                'refresh_token' => $refresh_token
            ];
        }

        return $this->respondWithArray($data);

    }
}