<?php
// 这是系统自动生成的公共文件

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

function data_sign($data = [])
{
    ksort($data); // 排序
    $code = http_build_query($data); // url编码并生成query字符串
    $sign = md5($code); // 生成签名
    return $sign;
}


function send_post($url, $post_data)
{
    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}


/**
 * Curl版本
 * 使用方法：
 * $post_string = "app=request&version=beta";
 * request_by_curl('http://www.jb51.net/restServer.php', $post_string);
 */
function request_curl($remote_server, $post_string)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $remote_server);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "jb51.net's CURL Example beta");
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function version()
{
    $data = [
        'version' => config('web.version')
    ];
    $version = request_curl(config('web.yun_api') . 'index/ser_info', 'version=' . config('web.version'));
    $data = json_decode($version, true);
    return $version;
    if (!$data['code'] == '200') {
        $msg = $data['msg'];
    } elseif ($data <= config('web.version')) {
        $msg = '请到系统页面更新';
    } else {
        $msg = $data['msg'];
    }
    return $msg;
}


function key_code()
{
    $str = md5(uniqid(md5(microtime(true)), true));
    $str = sha1($str); //加密
    return $str;
}