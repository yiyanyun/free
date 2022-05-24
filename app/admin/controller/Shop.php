<?php
namespace app\admin\controller;
use think\facade\View;
use app\admin\model\Shop as shops;
use think\Request;

class Shop
{
    public function index()
    {
        return view::fetch('/shop');
    }

    public function add()
    {
        return view::fetch('/shopadd');
    }

    public function list(Request $request)
    {
        // if($request->isPost()){
        $list = shops::order('id desc')->select();
        $total = shops::count();
        $data = array("rows" => $list, "total" => $total);
        return json($data);
        // }
    }

    public function jstatus(Request $request)
    {
        if ($request->isPost()) {
            $id = input('post.id');
            $ida = array_column($id, 'id');
            if ($ida) {
                $ids = '';
                foreach ($ida as $value) {
                    $ids .= intval($value) . ",";
                }
                $where = explode(",", $ids);
                $ids = rtrim($ids, ",");
                $res = shops::where('id', 'in', $where)->update(['status' => 'n']);
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }
    
    public function qstatus(Request $request)
    {
        if ($request->isPost()) {
            $id = input('post.id');
            $ida = array_column($id, 'id');
            if ($ida) {
                $ids = '';
                foreach ($ida as $value) {
                    $ids .= intval($value) . ",";
                }
                $where = explode(",", $ids);
                $ids = rtrim($ids, ",");
                $res = shops::where('id', 'in', $where)->update(['status' => 'y']);
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }
    
    public function del(Request $request)
    {
        if ($request->isPost()) {
            $id = input('post.id');
            $ida = array_column($id, 'id');
            if ($ida) {
                $ids = '';
                foreach ($ida as $value) {
                    $ids .= intval($value) . ",";
                }
                $where = explode(",", $ids);
                $ids = rtrim($ids, ",");
                $res = shops::where('id', 'in', $where)->delete();
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }
}
