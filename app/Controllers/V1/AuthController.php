<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
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

        return $this->respondWithArray($request->input());
        return $this->respondWithArray($this->token->getClientInfo('user_id'));
    }

    /**
     * @RequestMapping(route="signup", method=RequestMethod::GET)
     * @return string
     */
    public function signup(){

        return $this->respondWithArray($this->token->getClientInfo(0));
    }
}