<?php

namespace App\Controllers\V1;


use App\Common\Code\Code;
use App\Common\Controller\ApiController;
use App\Common\Factory\AuthFactory;
use App\Common\Mapping\AuthInterface;
use App\Common\Utility\Token;
use App\Common\Validate\AuthValidate;
use App\Exception\InvaildTokenException;
use App\Models\Services\Auth\PasswordAuthService;
use App\Models\Services\Auth\RegisterService;
use App\Models\Services\TokenService;
use Swoft\App;
use Swoft\Http\Message\Bean\Annotation\Middlewares;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use Swoft\Bean\Annotation\Inject;
use App\Middlewares\ValidateMiddleware;

/**
 * @Controller(prefix="/v1/auth")
 */
class AuthController extends ApiController
{


    /**
     * @RequestMapping(route="signin", method=RequestMethod::POST)
     * @return string
     */
    public function signin()
    {
        $login_type = \Swoft::param('login_type');

        /* @var AuthInterface $authService */
        $authService = AuthFactory::getService($login_type);
        $data = $authService->auth(\Swoft::param());

        return $this->respondWithArray($data);
    }

    /**
     * @RequestMapping(route="signup", method=RequestMethod::POST)
     * @return string
     */
    public function signup()
    {
        /* @var RegisterService $registerService */
        $registerService = App::getBean(RegisterService::class);
        $data = $registerService->register(\Swoft::param(['mobile']), \Swoft::param(['code']), \Swoft::param(['type']));
        return $this->respondWithArray($data);

    }

    /**
     * @RequestMapping(route="forget", method=RequestMethod::POST)
     * @param Request $request
     * @return string
     */
    public function forget(Request $request)
    {
        /* @var AuthValidate */
        $this->validate('App\Common\Validate\AuthValidate', 'forget');
    }


    /**
     * @RequestMapping(route="/v1/refresh", method=RequestMethod::POST)
     * @return string
     */
    public function refresh()
    {
        $access_token = \Swoft::accessToken();
        $refresh_token = \Swoft::param('refresh_token');

        $refresh_token_key = Token::getRefreshTokenKey($access_token);
//        $refresh_token_key = sprintf("%s:%s", Token::REFRESH_TOKEN, $refresh_token);

        $hData = \Swoft::redis()->hGetAll($refresh_token_key);
        if (!$hData) {
            throw new InvaildTokenException('refresh_token已失效,请重新登录', Code::INVALID_TOKEN);
        }
        if ($refresh_token !== $hData['refresh_token']) {
            throw new InvaildTokenException('refresh_token异常', Code::INVALID_TOKEN);
        }
        //刷新access_token和refresh_token 旧access_token保留5分钟 防止已过期的情况下页面的并发请求
        /* @var TokenService $tokenService */
        $tokenService = App::getBean(TokenService::class);
        $data = $tokenService->refresh($hData['user_id']);

        return $this->respondWithArray($data);

    }
}