<?php
namespace app\Admin\controller;
use think\facade\View;
use think\Request;
class Proclone
{
    public function index()
    {
        return view::fetch('/proclone');
    }

    public function submit(Request $request)
    {
        if($request->isPost()){
            return '';
        }
    }
}