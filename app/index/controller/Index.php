<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-13 08:55:15
 * @LastEditTime : 2022-05-24 20:17:01
 * @FilePath     : \yiyanyun1.2\app\index\controller\Index.php
 */
declare (strict_types = 1);
namespace app\Index\controller;
use think\facade\View;
use think\facade\Config;
use think\Request;

class Index
{
    public function index(Request $request)
    {
        $ip = $request->ip();
        return $ip;
        return view::fetch();
    }
}
