<?php
/*-返回今天剩余时间戳-*/
function today_rest(){

    /*-今天凌晨时间戳-*/
    $endtime=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;

    $surplus = $endtime-time();

    return $surplus;
}

function ip(){
    return \Swoft\Core\RequestContext::getRequest()->getHeaders()['x-real-ip'][0];
}