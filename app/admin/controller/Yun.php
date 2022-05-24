<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-13 19:43:56
 * @LastEditTime: 2022-03-29 20:42:19
 * @FilePath: \yiyanyun\app\admin\controller\Yun.php
 */

namespace app\Admin\controller;
use think\facade\View;
use think\Request;
use app\admin\model\Admin;

class yun
{
    public function index()
    {
        $view = Admin::where('id', 1)->find();
        if (empty($view['yun_token'])) {
            return view::fetch('/yun');
        }
        $data = 'token=' . $view['yun_token'];
        $url = config('web.yun_api') . 'index/info';
        $res = request_curl($url, $data);
        $data = json_decode($res, true);
        if ($data['code'] == 201) {
            return view::fetch('/yun');
        }
        if ($data['code'] == 200) {
            view::assign([
                'user' => $data['info']['user'],
                'nick' => $data['info']['nick'],
                'mail' => $data['info']['mail']
            ]);
            return view::fetch('/yun_user');
        }
        return view::fetch('/yun_user');
    }

    public function login(Request $request)
    {
        if ($request->isPost()) {
            $user = input('post.user');
            $password = input('post.password');
            if (empty($user) && empty($password)) {
                return jsons(201, '请输入完整');
            }
            $data = [
                'user' => $user,
                'password' => $password,
                'ip' => getip(),
                'ser_ip' => $request->ip(),
                'info' => php_uname()
            ];
            //此块为获取服务器信息以采取下次更新的良好决策，如您强行需要更改，
            //请您立即在24小时内将本系统从您的服务器或计算机等任何设备中彻底删除,
            //如有发现您将负责全部责任。
            //PS ：这块之前有个大bug差点把我心脏病都着急出来的
            $url = config('web.yun_api') . 'index';
            $res = request_curl($url, 'user='.$user.'&password='.$password.'&ser_ip='. $request->ip() .'&info='.php_uname().'&ip='.getip());
            $data = json_decode($res, true);
            if ($data['code'] == 200) {
                $auth = admin::where('id', '1')->update(['yun_token' => $data['msg']]);
                if (!$auth) {
                    return jsons(201, '服务器异常请稍后重试或联系客服');
                }
                return jsons(2010, '绑定成功');
            }
            return jsons(201, $data['msg']);
        }
    }

    public function logout()
    {
        $logout = Admin::where('id', 1)->update(['yun_token' => null]);
        if (!$logout) {
            return jsons(201, '解绑失败');
        }
        return jsons(200, '解绑退出成功您需要登录云端删除本服务器');
    }
}
