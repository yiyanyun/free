<?php
// 这是系统自动生成的公共文件

function jsons($code, $msg = null, $pro = null)
{
    if ($msg && is_array($msg) && isset($msg['mi_state']) && isset($msg['mi_type'])) {
        $mi = $msg;
        $msg = null;
    }
    if (!$msg && !is_array($msg)) {
        $msg = msg($code);
    }
    $sgin = sign_md5($pro);
    if (empty($msg)) {
        $data = array('code' => $code, 'msg' => $msg, 'time' => time(), 'sgin' => $sgin);
    } else {
        $data = array('code' => $code, 'msg' => $msg, 'time' => time(), 'sgin' => $sgin);
    }
    $data = json_encode($data);
    if ($pro['encrypt'] == '1') {
        return $data = openssl_encrypt($data, 'AES-128-ECB', $pro['key_aes'], 0); //aes加密
    } elseif ($pro['encrypt'] == '2') {
        $data = base64_encode($data);
    }
    echo $data;
    exit;
}


function msg($code)
{
    $msg = [
        0 => '未知原因失败',
        9998 => '卡密已到期',
        9999 => '操作失败',
        200 => '操作成功',
        1000 => '请输入项目ID',
        1001 => '项目不存在',
        1002 => '项目已关闭',
        1003 => '项目已关闭登录',
        1004 => '数据签名为空',
        1005 => '数据过期',
        1006 => '数据签名有误',
        1007 => '数据为空',
        1008 => '未发现时间数据',
        1010 => '请输入账号',
        1011 => '请填写密码',
        1012 => '请输入机器码',
        1013 => '账号密码不正确',
        1014 => '账号已被禁用',
        1015 => '账号已存在',
        1016 => '账号不合法',
        1017 => '账号注册频率过快',
        1018 => '设备码不一致',
        1019 => '密码不合法',
        1020 => '验证码为空',
        1021 => '管理员未启动邮箱验证码功能',
        1022 => '账号不存在',
        1023 => '验证码发送频率过快',
        1024 => '验证码不正确',
        1025 => 'TOKEN为空',
        1026 => 'TOKEN不合法',
        1027 => 'TOKEN不存在',
        1028 => '已设置账号不可更改',
        1029 => '名称为空',
        1030 => '订单号为空',
        1031 => '请选择支付方式',
        1032 => '请选择商品',
        1033 => '该应用未开启支付功能',
        1034 => '请先设置异步通知地址',
        1035 => '不支持该支付方式',
        1036 => '商品不存在',
        1037 => '订单入库失败',
        1038 => '支付错误信息',
        1039 => '支付未知错误',
        1040 => '请填写订单信息',
        1041 => '提交方式有误',
        1042 => '上传类型不支持',
        1043 => '积分ID为空',
        1044 => '积分事件不存在',
        1045 => '积分事件已关闭',
        1046 => '签到功能未启用',
        1047 => '今天已经签到过了',
        1048 => '卡密为空',
        1049 => '卡密不存在',
        1050 => '卡密已使用',
        1051 => '卡密已被禁用',
        1052 => '卡密类型不一致',
        1053 => '订单不存在',
        1054 => '等待支付',
        1055 => '未知订单状态',
        1056 => '请输入openid',
        1057 => '请输入access_token',
        1058 => '身份信息错误',
        1059 => '微信openid有误',
        1060 => '该微信已绑定其他账号',
        1061 => '请输入QQ互联ID',
        1062 => '未知登录错误',
        1063 => '该应用不允许使用此种登录方式',
        1064 => '该应用不允许使用当前操作',
        1065 => '当前账号未绑定邮箱',
        1066 => '一张被充值的卡密只能充值给一个账号或者一张主卡密',
        1067 => '不支持积分卡登录',
        1068 => '订单已存在',
        1069 => '您已经是永久会员了',
        1070 => '重要数据为空',
        1071 => '项目已关闭注册',
        1072 => '项目版本不存在',
        1073 => '项目版已关闭',
        1074 => '项目版已更新',
        1075 => 'TOKEN失效2',
        1076 => '安装包校验失败',
        400 => '没有相关操作',
        401 => '错误的数据',
        501 => '变量ID为空',
        502 => '变量名为空',
        503 => '请输入昵称',
        504 => '请输入双卡号',
        505 => '请输入双卡密',
        506 => '双卡密不存在',
        507 => '双卡密未使用',
    ];
    return $msg[$code];
}

// md5校验
function sign_md5($data = [])
{
    if (!is_array($data)) { // 数据类型检测
        $data = (array) $data;
    } // 排序
    ksort($data); // url编码并生成query字符串
    $code = http_build_query($data);
    $sign = md5($code); // 生成签名
    return $sign;
}
// sha1校验
function sign_sha1($data = [])
{
    if (!is_array($data)) { // 数据类型检测
        $data = (array) $data;
    } // 排序
    ksort($data); // url编码并生成query字符串
    $code = http_build_query($data);
    $sign = sha1($code); // 生成签名
    return $sign;
}

function txt_Arr($txt)
{ //文本转数组
    $arr = explode('&', $txt);
    $array = [];
    foreach ($arr as $value) {
        $tmp_arr = explode('=', $value);
        if (is_array($tmp_arr) && count($tmp_arr) == 2) {
            $array = array_merge($array, [$tmp_arr[0] => $tmp_arr[1]]);
        }
    }
    return $array;
}

// 提交数据签名
function sgins($data)
{
    if (!is_array($data)) { // 数据类型检测
        $data = (array) $data;
    } // 排序
    ksort($data); // url编码并生成query字符串
    $code = http_build_query($data);
    $sign = md5($code); // 生成签名
    return $sign;
}

function getcode($length)
{ //取随机字符
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $max = strlen($strPol) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];
    }
    return $str;
}

function getip()
{
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $realip = $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}

function time_count($dayName = '', $date = FALSE)
{
    $startFix = ' 00:00:00';
    $endFix = ' 23:59:59';
    $day = date('Y-m-d');
    $time['t_a'] = $day . $startFix; //今天开始
    $time['t_b'] = $day . $endFix; //今天结束
    if ($date == true) {
        return $dayName ? $time[$dayName] : $time;
    } else {
        return $dayName ? strtotime($time[$dayName]) : $time;
    }
}

