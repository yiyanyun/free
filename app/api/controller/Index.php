<?php

declare(strict_types=1);

namespace app\Api\controller;

use app\api\model\Scode;
use app\api\model\User;
use app\api\model\Plog;
use app\api\model\Project as pro;
use app\api\model\UserLog;

class Index
{
    public $enc;
    function index()
    {
        $operation = input('post.operation');
        if (empty($operation)) {
            return json(array('code' => 404, 'msg' => '请给出操作方法'));
        }
        $pro = input('post.pro');
        if (empty($pro)) {
            return json(array('code' => 0, 'msg' => '请填写项目ID'));
        }
        $pro = pro::where('id', $pro)->find();
        if (empty($pro)) return json(array('code' => 500, 'msg' => '项目不存在'));
        if ($pro['status'] == 'n') return json(1002, '', $pro);
        $data_arr = $_REQUEST;
        // 开始判断需要执行的操作
        switch ($operation) {
            case 'info': //项目信息1
                return $this->info($pro, $data_arr);
                break;
            case 'register': //用户注册2
                return $this->register($pro, $data_arr);
                break;
            case 'login': //用户登录3
                return $this->login($data_arr, $pro);
                break;
            case 'palpitate': //用户心跳4
                return $this->palpitate($data_arr, $pro);
                break;
            case 'changePassword': //用户修改密码5
                return $this->changePassword($data_arr, $pro);
                break;
            case 'kami_login': //卡密登录6
                return $this->kami_login($data_arr, $pro);
                break;
            case 'getuserinfo': //查询用户信息7
                return $this->getuserinfo($data_arr, $pro);
                break;
            case 'user_sgin': //用户签到8
                return $this->user_sgin($data_arr, $pro);
                break;
            case 'vip_ver': //会员验证9
                return $this->vip_ver($data_arr, $pro);
                break;
            default:
        }
        return '找不到接口 ~ ~ ~ ~';
    }

    function info($pro)
    {
        $data = [
            'name' => $pro['name'],
            'key' => $pro['key'],
        ];
        return jsons(200, $data, $pro);
    }

    function login($data_arr, $pro)
    {
        if ($pro['login_status'] == 'n') return jsons(1003, $pro['logon_notice'], $pro);
        if (!array_key_exists('user', $data_arr)) return jsons(1010, '', $pro);
        if (!array_key_exists('password', $data_arr)) return jsons(1011, '', $pro);
        $log_ip = getip();
        $log_time = time();
        $token = md5($data_arr['user'] . getcode(32) . time() . $pro['id']);
        $user_res = user::where(['user' => $data_arr['user'], "password" => md5($data_arr['password']), "pid" => $pro['id']])->find();

        if (empty($user_res)) return jsons(1013, '', $pro);
        $user_info = [
            'id' => $pro['id'],
            'name' => $pro['name'],
            'vip' => $user_res['vip_time']
        ];
        $datas = [
            'pid' => $pro['pid'],
            'uid' => $user_res['id'],
            'type' => 'login',
            'time' => $log_time,
            'ip' => $log_ip,
            'token' => $token,
            'pid' => $pro['id']
        ];
        plog::insert($datas);
        UserLog::insert($datas);
        // ulog::insert($datas);
        $data = ['token' => $token, 'info' => $user_info];
        return jsons(200, $data, $pro);
    }

    function register($pro, $data_arr)
    {
        if (!array_key_exists('user', $data_arr)) return jsons(1010, '', $pro);
        if (!array_key_exists('password', $data_arr)) return jsons(1011, '', $pro);
        if (!array_key_exists('name', $data_arr)) $name = '这个人没有名字!';
        $reg_ip = getip();
        $reg_time = time();
        if ($pro['reg_status'] == 'n') jsons(1071);
        $user = $data_arr['user'];
        if (empty($user)) return jsons(1010, '', $pro);
        $password = $data_arr['password'];
        if (empty($password)) return jsons(1011, '', $pro);
        $machine = isset($data_arr['machine']) && !empty($data_arr['machine']);
        if (preg_match("/^[\w]{5,11}$/", $user) == 0) return jsons(1016); //账号长度5~11位，不支持中文和特殊字符
        if (preg_match("/^[a-zA-Z\d.*_-]{6,18}$/", $password) == 0) return jsons(1019, '密码长度需要满足6-18位数,不支持中文以及.-*_以外特殊字符'); //密码长度6~18位
        $user_res = user::where(['user' => $user, 'pid' => $pro['id']])->find();
        if (!empty($user_res)) return jsons(1015, '', $pro);

        $datas = [
            'name' => $name,
            'user' => $user,
            'password' => md5($password),
            'reg_mac' => $machine,
            'reg_ip' => $reg_ip,
            'reg_time' => $reg_time,
            'pid' => $pro['id']
        ];
        $add_res = user::insert($datas);
        if ($add_res) {
            return jsons(200, '', $pro);
        }
        return jsons(9999, '注册失败', $pro);
    }

    function palpitate($data_arr, $pro)
    {
        if (!array_key_exists('token', $data_arr)) return jsons(1025, '', $pro);
        $token = $data_arr['token'];
        if (empty($token)) return jsons(1025, '', $pro);
        $user = plog::where('token', $token)->find();
        if (empty($user)) {
            return jsons(1075, '', $pro);
        }
        $token = user::where('pid', $user['pid'])->find();
        if (empty($token)) {
            return jsons(1027, '', $pro);
        }
        $data = [
            'login_time' => time()
        ];
        $res = plog::where('id', $token['id'])->update($data);
        if ($res) {
            return jsons(200, '', $pro);
        }
        return jsons(9999, '', $pro);
    }

    function kami_login($data_arr, $pro)
    {
        if (!array_key_exists('kami', $data_arr)) return jsons(1048, '', $pro);
        if (!array_key_exists('mac', $data_arr)) return jsons(1012, '', $pro);
        if ($pro['kami_status'] == 'n') return jsons(1003, $pro['logon_notice'], $pro);
        $res_kami = scode::where(['pid' => $pro['id']], ['pid' => $pro['pid']])->where('kami', $data_arr['kami'])->find();
        if (!$res_kami) return jsons(1049, '', $pro);
        if ($res_kami['user'] != $data_arr['mac']) {
            if (!empty($res_kami['user'])) return jsons(1018, $pro);
        }

        if ($res_kami['state'] == 'n') return jsons(1051, $pro);
        $kami_info = [
            'kami' => $res_kami['kami'],
            'id' => $res_kami['id'],
            'use_time' => $res_kami['use_time'],
            'end_time' => $res_kami['end_time'],
        ];
        if (empty($res_kami['use_time'])) {
            $vip = time() + 86400 * $res_kami['value'];
            $res = scode::where('id', $res_kami['id'])->update(['use_time' => time(), 'end_time' => $vip]);
            if (!$res) return jsons(9999, '登录失败，请重试', $pro);
            $kami_info = [
                'kami' => $data_arr['kami'],
                'end_time' => $vip
            ];
        } elseif ($res_kami['end_time'] > time()||$res_kami['value'] == -1) {
            $kami_info = [
                'kami' => $data_arr['kami'],
                'end_time' => $res_kami['end_time']
            ];
        } else {
            return jsons(9998, '卡密已到期', $pro);
        }
        $vip = time() + 86400 * $res_kami['value'];
        scode::where('id', $res_kami['id'])->update(['use_time' => time(), 'end_time' => $vip]);
        return jsons(200, $kami_info, $pro);
    }

    function changePassword($data_arr, $pro)
    {
        if (!array_key_exists('user', $data_arr)) return jsons(1010, '', $pro);
        if (!array_key_exists('password', $data_arr)) return jsons(1011, '', $pro);
        if (!array_key_exists('newpass', $data_arr)) return jsons(1011, '', $pro);

        $res = user::where(['pid' => $pro['id'], 'user' => $data_arr['user'], 'password' => md5($data_arr['password'])])->find();
        if (empty($res)) {
            return jsons(1013, '', $pro);
        }

        $row = user::where('id', $res['id'])->update(['password' => md5($data_arr['newpass'])]);
        if (!empty($row)) {
            return jsons(200, '', $pro);
        }
        return jsons(9999, '', $pro);
    }

    function getuserinfo($data_arr, $pro)
    {
        if (!array_key_exists('token', $data_arr)) return jsons(1025, '', $pro);
        $user = UserLog::where('token', $data_arr['token'])->find();
        if (empty($user)) {
            return jsons(1075, '', $pro);
        }
        $token = user::where('pid', $user['pid'])->find();
        if (empty($token)) {
            return jsons(1027, '', $pro);
        }
        $info = [
            'id' => $token['id'],
            'user' => $token['user'],
            'nick' => $token['nick'],
            'mail' => $token['mail'],
            'vip_time' => $token['vip_time'],
            'status' => $token['status']
        ];
        return jsons(200, $info, $pro);
    }

    function user_sgin($data_arr, $pro)
    {
        if (!array_key_exists('token', $data_arr)) return jsons(1025, '', $pro);
        $user = UserLog::where('token', $data_arr['token'])->find();
        if (empty($user)) {
            return jsons(1075, '', $pro);
        }
        $token = user::where('pid', $user['pid'])->find();
        if (empty($token)) {
            return jsons(1027, '', $pro);
        }
        if ($pro['clock_staus'] == 'n') return jsons(1046, '', $pro);
        $res = plog::where(['uid' => $token['id'], 'type' => '签到'])->where('time', 'between', [time_count('t_a'), time_count('t_b')])->find();
        if (!empty($res)) return jsons(1047, '', $pro);

        if ($token['vip'] > time()) {
            $vip = $token['vip'] + 3600 * $token['vip_time'];
        } else {
            $vip = time() + 3600 * $token['vip_time'];
        }
        $res = user::where('id', $token['id'])->update(['vip_time' => $vip]);
        if (!$res) return jsons(201, '签到失败', $pro);
        plog::insert(['uid' => $token['id'], 'type' => '签到', 'status' => 'y', 'time' => time(), 'ip' => getip(), 'pid' => $pro['id']]);
        return jsons(200, '签到成功', $pro);
    }

    function vip_ver($data_arr, $pro)
    {
        if (!array_key_exists('token', $data_arr)) return jsons(1025, '', $pro);

        $user = UserLog::where('token', $data_arr['token'])->find();
        if (empty($user)) {
            return jsons(1075, '', $pro);
        }
        $token = user::where('pid', $user['pid'])->find();
        if (empty($token)) {
            return jsons(1027, '', $pro);
        }
        UserLog::where('token', $token)->update(['time' => time()]);
        if ($token['vip'] == '999999999' or $token['vip'] > time()) {
            return jsons(200, '验证成功', $pro);
        } else {
            return jsons(201, '验证失败', $pro);
        }
    }
}
