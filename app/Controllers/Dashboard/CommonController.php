<?php

namespace App\Controllers\Dashboard;

use App\Common\Controller\ApiController;
use App\Common\Utility\Qiniu;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Request;

/**
 * @Controller(prefix="/dashboard")
 */
class CommonController extends ApiController
{
    /**
     * 上传图片
     * @RequestMapping(route="/dashboard/upload", method={RequestMethod::POST})
     * @param $request Request
     * @return string
     * @throws
     */
    public function upload(Request $request)
    {
        return ($request->file('img'));
    }
}