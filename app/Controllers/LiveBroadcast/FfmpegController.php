<?php

namespace App\Controllers\LiveBroadcast;

use App\Common\Controller\ApiController;
use App\Common\Utility\Qiniu;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;

/**
 * @Controller(prefix="/livebroadcast/ffmpeg")
 */
class FfmpegController extends ApiController
{
    /**
     * @RequestMapping(route="/livebroadcast/ffmpeg")
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {

        $ffmeg = FFMpeg::create();
        $file = 'http://mp4.vjshi.com/2018-09-21/d5a88ce26f84c6fdf6de8db499e1ea40.mp4';
        $video = $ffmeg->open($file);
//        $video->getFormat()->all() 视频源数据
        $frame = $video->frame(TimeCode::fromSeconds(20)); //截取第n秒的图片
//        var_dump();

        $qiniu = new Qiniu();

        $video->gif(TimeCode::fromSeconds(10), new Dimension(400, 200), 3)->save('test.gif');
        return;

        return $this->respondWithArray($qiniu::HOST . $qiniu->single_upload_stream($frame->save('test.jpg', false, true)));


    }


}