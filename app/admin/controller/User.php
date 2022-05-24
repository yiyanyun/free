<?php
namespace app\Admin\controller;
use think\facade\View;
use app\admin\model\User as users;
use app\admin\model\Order;
use app\admin\model\Project;
use app\api\model\Project as ModelProject;
use think\Request;

class User
{
    public function index()
    {
        $list = users::order('id', 'desc')->paginate(50);
        $pro = Project::order('id', 'desc')->paginate();
        $page = $list->render();
        return view::fetch('/user', ['list' => $list,'page'=>$page,'lists'=>$pro]);
    }

    public function del(Request $request)
    {
        if ($request->isPost()) {
            $id = input('post.id');
            if ($id) {
                $ids = '';
                foreach ($id as $value) {
                    $ids .= intval($value) . ",";
                }
                $where = explode(",", $ids);
                $ids = rtrim($ids, ",");
                $res = users::where('id', 'in', $where)->delete();
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }

    public function jstatus(Request $request)
    {
        if ($request->isPost()) {
            $id = input('post.id');
            if ($id) {
                $ids = '';
                foreach ($id as $value) {
                    $ids .= intval($value) . ",";
                }
                $where = explode(",", $ids);
                $ids = rtrim($ids, ",");
                $res = users::where('id', 'in', $where)->update(['status' => 'n']);
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
            if ($id) {
                $ids = '';
                foreach ($id as $value) {
                    $ids .= intval($value) . ",";
                }
                $where = explode(",", $ids);
                $ids = rtrim($ids, ",");
                $res = users::where('id', 'in', $where)->update(['status' => 'y']);
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }

    public function add(Request $request)
    {
        if ($request->isPost()) {
            $user = input('post.user');
            $password = input('post.password');
            $pid = input('post.pid');
            if ($user == null && $password == null) {
                return jsons(201, '请输入完整');
            }
            $pros = ModelProject::where('id',$pid)->find();
            if (empty($pros)) {
                return jsons(201,'项目不存在');
            }
            $users = users::where('user', $user)->find();
            if (!empty($users)) {
                return jsons(201, '用户名已存在');
            }
            $res = users::insert([
                'user' => $user,
                'password' => $password,
                'pid' => $pid,
                'reg_time' => time()
            ]);
            if (empty($res)) {
                return jsons(201, '操作失败');
            }
            return jsons(200, '操作成功');
        }
    }

    public function editview(Request $request)
    {
        if ($request->isGet()) {
            $id = input('get.id');
            $info = users::where('id',$id)->find();
            if (empty($info)) {
                return '用户不存在';
            }
            view::assign([
                'user'=>$info['user'],
                'id'=>$info['id'],
                'nick'=>$info['niick'],
                'vip'=>$info['vip'],
                'mail'=>$info['mail'],
            ]);
            return view::fetch('/useredit');
        }
    }

    public function edit(Request $request)
    {
        if($request->isPost()){
            $id = input('post.id');
            $nick = input('post.nickname');
            $mail = input('post.email');
            $info = users::where('id',$id)->find();
            if (empty($info)) {
                return jsons(203,'用户不存在');
            }
            $data = [
                'nick'=>$nick,
                'mail'=>$mail,
            ];
            $user = users::where('id',$id)->update($data);
            if ($user) {
                return jsons(200,'修改成功');
            }
            return jsons(201,'修改失败');
        }
    }

    public function order(Request $request)
    {
        $id = input('ids');
        $list = order::where('uid',$id)->order('id desc')->select();
        $total = order::where('uid',$id)->count();
        $data = array('rows' => $list, 'total'=>$total);
        return json($data);
    }
}
