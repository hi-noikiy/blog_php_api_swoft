<?php

namespace App\Tasks;

use App\Common\Utility\Qiniu;
use App\Models\Entity\VirtualUser;
use Swoft\Task\Bean\Annotation\Task;

/**
 *
 * @Task("spider")
 */
class SpiderTask
{
    public function avatar(string $url, Qiniu $qiniu, VirtualUser $virtualUser)
    {
        $url = $qiniu->single_upload_url($url, 'virtual_user');
        $id = $virtualUser->setVirtualAvatar($url)->save()->getResult();
        var_dump($url, $id);
    }

    public function nick(string $nick,VirtualUser $virtualUser){

        $virtualUser::updateOne(['virtual_nick'=>$nick],['virtual_nick'=>null]);
    }
}