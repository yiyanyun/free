<?php 
/*
 * @Author: Lucifer
 * @Date: 2022-03-31 16:24:06
 * @LastEditTime: 2022-03-31 16:26:14
 * @FilePath: \yiyanyun\app\index\controller\Scode.php
 */

namespace app\index\controller;
use think\facade\View;
use think\Request;

class Scode 
{
    public function index()
    {
        return view::fetch();
    }

    public function find(Request $request)
    {
        if ($request->isPost()) {
            $data = input();
            
        }
    }
}