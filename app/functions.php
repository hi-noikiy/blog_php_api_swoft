<?php
/*-返回今天剩余时间戳-*/
function today_rest()
{

    /*-今天凌晨时间戳-*/
    $endtime = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;

    $surplus = $endtime - time();

    return $surplus;
}


function ip()
{
    return \Swoft\Core\RequestContext::getRequest()->getHeaders()['x-real-ip'][0];
}

function page(int $page = 1, int $limit = 20)
{
    $page = $page > 0 ? $page : 1;
    return $offset = $limit * ($page - 1);
//    return $limit . ',' . $offset;
//    return $offset . ',' . $limit;
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