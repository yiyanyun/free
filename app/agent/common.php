<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-19 20:07:11
 * @LastEditTime: 2022-04-03 09:21:26
 * @FilePath: \yiyanyun\app\agent\common.php
 */

 use think\facade\Session;
// 这是系统自动生成的公共文件
// api token code
//生成一个不会重复的字符串
function make_token()
{
    $str = md5(uniqid(md5(microtime(true)), true));
    $str = sha1($str); //加密
    return $str;
}

// json重构
function jsons($code = 200, $msg = '', $time = '')
{
    header('Content-type: application/json');
    $data['code'] = $code;
    $data['msg'] = $msg;
    $data['time'] = $time;
    $rsult = json_encode($data, true);
    echo $rsult;
    exit;
}

// 获取一段字符串啥玩意的
function get_code($length)
{
    $str = null;
    $strpol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $max = strlen($strpol) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str .= $strpol[rand(0, $max)];
    }
    return $str;
}


// getip
function getip()
{
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknow")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknow")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    } else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknow")) {
        $ip = getenv("REMOTE_ADDR");
    } else if (isset($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknow")) {
        $ip = $_SERVER["REMOTE_ADDR"];
    } else {
        $ip = "unknow";
    }
    return $ip;
}

/*
 *  获取代理ID
 */
function aid()
{
    $token = session::get('tokens');
    if (empty($token)) {
        $id = '';
    }
    return $token['aid'];
}