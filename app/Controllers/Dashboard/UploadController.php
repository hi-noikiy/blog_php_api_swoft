<?php

namespace App\Controllers\Dashboard;

use App\Common\Code\Code;
use App\Common\Controller\ApiController;
use App\Common\Lang\Lang;
use App\Common\Utility\Qiniu;
use App\Models\Dao\Log;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Upload\UploadedFile;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\JwtMiddleware;

/**
 * @Controller(prefix="/dashboard/upload")
 * @Middleware(JwtMiddleware::class)
 */
class UploadController extends ApiController
{
    /**
     *
     * @RequestMapping(route="/dashboard/upload", method={RequestMethod::POST})
     * @param Request $request
     * @return string
     */
    public function upload(Request $request)
    {
        /* @var UploadedFile $file */
        $file = $request->file('media');
        $prefix = $request->post('prefix');
        if (!$file) {
            return $this->setStatusCode(Code::EMPTY_PARAMETER)->respondWithError('图片不能为空');
        }

        $upload = new Qiniu();
        $upload->setPrefix($prefix);
        if (is_array($file)) {
            foreach ($file as $item) {
                $imgs[] = $upload->single_upload($item->toArray());
            }
        } else {
            $imgs = $upload->single_upload($file->toArray());
        }

        return $this->respondWithArray(['imgs' => $imgs], Lang::UPLOAD_SUCCESS);
    }


}