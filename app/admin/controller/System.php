<?php 
namespace app\Admin\controller;
use think\facade\View;
use think\Request;
use app\admin\model\Admin;
class system 
{
    public function index()
    {
        return view::fetch('/system');
    }

    public function Submit(Request $request)
    {
        if ($request->isPost()) {
            $web_site_title = input('post.web_site_title');
            $web_site_copyright = input('post.web_site_copyright');
            $web_site_icp = input('post.web_site_icp');

            $data = [
                'web_title'=>$web_site_title,
                'beian'=>$web_site_icp,
                'copyright'=>$web_site_copyright
            ];

            $res = Admin::where('id',1)->update($data);
            if (empty($res)) {
                return jsons(201,'保存成功');
            }
            return jsons(200,'保存成功');
        }
    }
}