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
        var_dump(microtime(true));
        var_dump($url, $id);
    }

    public function nick(string $nick, VirtualUser $virtualUser)
    {
        $nick = characet($nick);
//        var_dump($nick);
        $res = $virtualUser::updateOne(['virtual_nick' => $nick], ['virtual_nick' => ''])->getResult();
        if($res == 0){
            $res = $virtualUser->setVirtualNick($nick)->save()->getResult();
        }
        var_dump($nick, $res);
    }
}