<?php
namespace app\Admin\controller;
use think\facade\View;
use app\admin\model\Order as ord;
use think\Request;
class order
{
    public function index()
    {
        return view::fetch('/order');
    }

    public function list()
    {
        $list = ord::order('id desc')->select();
        $total = ord::count();
        $data = array("rows" => $list, "total" => $total);
        return json($data);
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
                $res = ord::where('id', 'in', $where)->delete();
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
