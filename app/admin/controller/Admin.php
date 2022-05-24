<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-13 16:29:01
 * @LastEditTime: 2022-03-26 15:01:26
 * @Description: file content
 * @FilePath: \yiyanyun\app\admin\controller\Admin.php
 */

namespace app\Admin\controller;
use think\facade\View;
use app\admin\model\Admin as admins;
use think\Request;
use think\facade\Session;

class Admin
{
    public function index()
    {
        $info = admins::find(1);
        view::assign([
            'user' => $info['user'],
            'nick' => $info['nick'],
            'password' => $info['password'],
            'mail' => $info['mail'],
            'yun_user' => $info['yun_user']
        ]);
        return view::fetch('/admin');
    }

    public function edit(Request $request)
    {
        if ($request->isPost()) {
            $pass = input('post.password');
            $res = admins::where('id', 1)->update(['password' => $pass]);
            if (!empty($res)) {
                session::clear();
                return jsons(200, '修改成功');
            }
            return jsons(201, '修改异常');
        }
    }
}
