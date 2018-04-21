<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
/**
 * 控制器demo
 * @Controller(prefix="/v1/auth")
 */
class AuthController extends ApiController
{
    /**
     * @RequestMapping(route="/signin", method=RequestMethod::POST)
     */
    public function signin()
    {
        return $this->respondWithArray(null);
    }
}