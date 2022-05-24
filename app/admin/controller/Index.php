<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-13 08:54:25
 * @LastEditTime: 2022-04-10 11:49:12
 * @FilePath: \yiyanyun\app\admin\controller\Index.php
 */

declare (strict_types = 1);
namespace app\Admin\controller;

use app\admin\model\Admin;
use app\admin\model\Project;
use app\admin\model\Scode;
use app\admin\model\User;
use app\admin\model\Agent;
use app\admin\model\Log;
use think\Request;
use think\facade\View;

class Index
{
    public function index()
    {
        $info = Admin::where('id',1)->find();
        if (empty($info)) {
            return view::fetch('/install');
        }
        $user = User::count();
        $pro = Project::count();
        $pros = Project::where('status','y')->count();
        $scode = Scode::count();
        $scodes = Scode::where('use_time','null')->count();
        $v_user = user::where('vip','null')->count();
        $agent = Agent::count();
        $log = Log::count();
        $use = $scode - $scodes;
        $vip_user = $user - $v_user;
        view::assign([
            'server' => php_uname(),
            'ServerIP' => GetHostByName($_SERVER['SERVER_NAME']),
            'version' => config('web.version'),
            'user' => $user,
            'vip_user' => $vip_user,
            'code' => $scode,
            'pro' => $pro,
            'use_code' => $use,
            'agent' => $agent,
            'log' => $log,
            'pros' => $pros
        ]);
        return view::fetch('/index');
    }

    /**
     * 初始化管理员信息
     * 安装完成后可删除
     */
    public function init(Request $request)
    {
        if ($request->isPost()) {
            $init = Admin::where('id',1)->find();
            if (!empty($init)) {
                return jsons(201,'初始化失败，此库已初始化完成如需重新请删除yi_admin库数据');
            }
            $data = input();
            if ($data['user'] == '' || $data['password'] == '' || $data['nick'] == '') {
                return jsons(201,'请输入完整');
            }
            $datas = [
                'user' => $data['user'],
                'password' => $data['password'],
                'nick' => $data['nick'],
                'version' => $data['version'],
            ];
            $res = Admin::insert($datas);
            if (empty($res)) {
                return jsons(201,'初始化失败，如多次失败请从服务器彻底删除文件后重新上传安装并确保数据库信息配置正常');
            }
            return jsons(200,'初始化成功');
        }
    }
}