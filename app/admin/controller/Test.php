<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-13 17:17:24
 * @LastEditTime: 2022-04-09 20:11:03
 * @FilePath: \yiyanyun\app\admin\controller\Test.php
 */

namespace app\Admin\controller;
use think\facade\View;
class test
{
    public function index()
    {
        $data = [
            'user' => 'po'
        ];
        $version = send_post('http://172.17.204.8/admin/test/tests', $data);
        $data = json_decode($version, true);
        if (!$data['code'] == '200') {
            return jsons(206, '云端链接失败');
        } elseif ($data <= config('web.version')) {
            return jsons(203, '您需要进行升级');
        }
        return jsons(200, '获取成功');
    }

    public function tests()
    {
        return view::fetch('/install');
    }
}
