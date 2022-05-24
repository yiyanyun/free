<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-15 14:34:26
 * @LastEditTime: 2022-03-26 19:25:00
 * @FilePath: \yiyanyun\app\admin\controller\Update.php
 */

namespace app\Admin\controller;
use think\facade\View;

class update
{
    public function index()
    {
        return view::fetch('/update');
    }
}
