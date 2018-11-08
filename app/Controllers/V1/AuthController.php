<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use App\Common\Validate\AuthValidate;
use App\Models\Service\AuthService;
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
     * @Inject()
     * @var AuthService
     */
    private $AuthService;


    /**
     * @RequestMapping(route="signin", method=RequestMethod::POST)
     * @param Request $request
     * @return string
     */
    public function signin(Request $request)
    {
        /* @var AuthValidate */
        $this->validate('App\Common\Validate\AuthValidate.signin_first');
        $login_type = $request->post('login_type');
        $mobile = $request->post('mobile');

        return $this->respondWithArray('success');
        $data = $this->AuthService->auth();

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
     * @RequestMapping(route="/refresh", method=RequestMethod::POST)
     * @param Request $request
     * @return string
     */
    public function refresh(Request $request)
    {

        return $this->respondWithArray($request->input());

    }
}