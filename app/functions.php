<?php

/*
 * @return \Swoft\Redis\Redis
 */
function redis()
{
    return \Swoft\App::getBean(\Swoft\Redis\Redis::class);
}

/*-返回今天剩余时间戳-*/
function today_rest()
{

    /*-今天凌晨时间戳-*/
    $endtime = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;

    $surplus = $endtime - time();

    return $surplus;
}


/**
 * 获取推流地址
 * 如果不传key和过期时间，将返回不含防盗链的url
 * @param string $bizId 您在腾讯云分配到的bizid
 * @param string $streamId 您用来区别不同推流地址的唯一id
 * @param string $key 安全密钥
 * @return String url
 */
function getPushUrl($bizId, $streamId, $key)
{
    $txTime = strtoupper(base_convert(time() + 3600 * 24, 10, 16));
    //txSecret = MD5( KEY + livecode + txTime )
    //livecode = bizid+"_"+stream_id  如 8888_test123456
    $livecode = $bizId . "_" . $streamId; //直播码
    $txSecret = md5($key . $livecode . $txTime);
    $ext_str = "?" . http_build_query([
            "bizid" => $bizId,
            "txSecret" => $txSecret,
            "txTime" => $txTime
        ]);

    return "rmtp://{$bizId}.livepush.myqcloud.com/live/{$livecode}.{$ext_str}";

}


function charset_encode($data)
{
    if (!empty($data)) {
        $fileType = mb_detect_encoding($data, array('UTF-8', 'GBK', 'LATIN1', 'BIG5'));
        if ($fileType != 'UTF-8') {
            $data = mb_convert_encoding($data, 'utf-8', $fileType);
        }
    }
    return $data;
}

function password_encrypt(string $password, string $salt): string
{
    return md5(md5($password) . $salt);
}

function password_check(string $password, string $sale, string $encrypt_password): bool
{
    if (password_encrypt($password, $sale) == $encrypt_password) {
        return true;
    } else {
        return false;
    }
}