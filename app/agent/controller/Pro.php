<?php 
/*
 * @Author: Lucifer
 * @Date: 2022-03-19 20:45:07
 * @LastEditTime: 2022-04-02 15:53:53
 * @FilePath: \yiyanyun\app\agent\controller\Pro.php
 */
namespace app\agent\controller;
use think\facade\View;
use app\agent\model\Agpro;
use think\facade\Session;
class Pro 
{
    public function index()
    {
        $aid = session::get('tokens');
        $list = agpro::where('id',$aid['aid'])->order('id', 'desc')->paginate(10);
        $page = $list->render();
        return view::fetch('/pro',['list'=>$list,'page'=>$page]);
    }

    public function test()
    {
        $a = session::get('tokens');
        return $a['aid'];
        return json($a);
    }
}
