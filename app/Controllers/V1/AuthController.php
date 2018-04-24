<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use Swoft\Bean\BeanFactory;
use Swoft\Db\Query;
use Swoft\Http\Message\Server\Request;
use App\Common\Bean\UserData;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\AuthMiddleware;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/v1/auth")
 * @Middleware(class=AuthMiddleware::class)
 */
class AuthController extends ApiController
{

//    /**
//     *
//     * @Inject()
//     * @var UserData
//     */
//    private $userData;
    /**
     * @RequestMapping(route="signin", method=RequestMethod::POST)
     * @param Request $request
     * @return string
     */
    public function signin(Request $request)
    {

        return $this->respondWithArray(BeanFactory::hasBean("UserData"));
    }
}