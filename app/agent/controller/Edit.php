<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-27 16:29:39
 * @LastEditTime: 2022-03-27 16:46:49
 * @FilePath: \yiyanyun\app\agent\controller\Edit.php
 */

namespace app\agent\controller;

use think\facade\View;
use think\Request;
use app\agent\model\Agent;
use think\facade\Session;

class edit
{
    public function index()
    {
        $aid = session::get('token');
        $info = agent::where('id', $aid['aid'])->find();
        return view::fetch('/edit', ['info' => $info]);
    }

    public function update(Request $request)
    {
        if ($request->isPost()) {
            $pass = input('post.password');
            $nick = input('post.nick');
            $data = [
                'password' => $pass,
                'nick' => $nick
            ];
            $aid = session::get('token');
            if (empty($pass)) {
                return jsons(203,'密码为空');
            }
            $res = agent::where('id', $aid['aid'])->update($data);
            if (empty($res)) {
                return jsons(201, '更新失败，或许是参数未变');
            }
            return jsons(200, '更新成功');
        }
    }
}
