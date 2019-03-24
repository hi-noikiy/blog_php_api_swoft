<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use Qbhy\BaiduAIP\BaiduAIP;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Upload\UploadedFile;
use Zxing\QrReader;

/**
 * @Controller(prefix="/v1/ocr")
 */
class OcrController extends ApiController
{

    /**
     * @RequestMapping(route="qrcode", method={RequestMethod::GET,RequestMethod::POST})
     * @return string
     */
    public function qrcode(Request $request)
    {
        /* @var UploadedFile $image */
        $image = $request->file('image');
        $tmp_file = $image->toArray()['tmp_file'];


//        $data = file_get_contents($tmp_file);
//
//        $baiduAI = new BaiduAIP(config('baiduai'));
//        echo $baiduAI->access_token->getToken().PHP_EOL;
//        $cb = $baiduAI->ocr->general($data);
        $qrcodeReader = new QrReader($tmp_file);

        return $this->respondWithArray($qrcodeReader->getResult());
    }

}