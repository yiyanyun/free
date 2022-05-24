<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-19 20:07:11
 * @LastEditTime: 2022-04-03 09:22:31
 * @FilePath: \yiyanyun\app\agent\controller\Index.php
 */
declare (strict_types = 1);
namespace app\agent\controller;
use think\facade\View;
use think\Request;
use app\agent\model\Scode;
use app\agent\model\Agpro;
use think\facade\Session;
class Index
{
    public function index(Request $request)
    {
        $scode = scode::where('operator',aid())->count();
        $pro = agpro::where('aid',aid())->count();
        $scodes = Scode::where('operator',aid())->where('use_time','null')->count();
        $use = $scode - $scodes;
        view::assign([
            'code'=>$scode,
            'id'=>aid(),
            'pro'=>$pro,
            'use' => $use
        ]);
        return view::fetch('/index');
    }
}
