<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use App\Models\Service\AuthService;
use App\Models\Token;
use Swoft\App;
use Swoft\Bean\BeanFactory;
use Swoft\Db\Query;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middlewares;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use App\Middlewares\AuthMiddleware;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/v1/auth")
 * @Middlewares({
 *     @Middleware(SignMiddleware::class),
 *     @Middleware(AuthMiddleware::class)
 * })
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
        $this->validate('App\Common\Validate\AuthValidate.signin_first');


        return $this->respondWithArray(AuthService::service()->check());

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
     * @RequestMapping(route="/refresh", method=RequestMethod::POST)
     * @param Request $request
     * @return string
     */
    public function refresh(Request $request)
    {

        return $this->respondWithArray($request->input());

    }
}