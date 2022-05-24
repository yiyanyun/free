<?php 
/*
 * @Author: Lucifer
 * @Date: 2022-03-13 09:44:46
 * @LastEditTime: 2022-03-30 21:04:34
 * @FilePath: \yiyanyun\app\admin\controller\Login.php
 */
namespace app\Admin\controller;

use app\admin\model\Admin;
use think\facade\View;
use think\Request;
use app\admin\model\Log;
use think\facade\Session;
class Login 
{
    public function index()
    {
        return view::fetch('/login');
    }

    public function login(Request $request)
    {
        if ($request->isPost()) {
            $user = input('post.user');
            $password = input('post.password');
            if ($user == '' || $password == '') {
                return json(array('code' => 204, 'msg' => '请填写完整', 'time' => time()));
            }

            $res = Admin::where(['user'=>$user,'password'=>$password])->find();
            if (empty($res)) {
                return json(array('code' => 206, 'msg' => '账号或密码有误', 'time' => time()));
            }
            $log_data = [
                'ip' => getip(),
                'time' => time(),
                'type' => '登录'
            ];
            log::insert($log_data);
            $log = log::insert($log_data);
            if (empty($log)) {
                return jsons(204,'日志写入失败');
            }
            session::set('token', $log_data);
            return json(array('code' => 200, 'msg' => '登录成功', 'time' => time()));
        }
    }

    public function logout()
    {
        Session::clear();
        return view::fetch('/login');
    }
}