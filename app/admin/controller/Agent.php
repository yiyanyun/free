<?php

namespace app\Admin\controller;

use think\facade\View;
use app\admin\model\Agent as age;
use app\admin\model\Agpro;
use app\api\model\Project as ModelProject;
use think\Request;

class Agent
{
    public function index()
    {
        $list = age::order('id desc')->paginate();
        $plist = ModelProject::paginate();
        return view::fetch('/agent', ['list' => $list, 'plist' => $plist]);
    }

    public function add(Request $request)
    {
        if ($request->isPost()) {
            $user = input('post.user');
            $password = input('post.password');
            if ($user == null && $password == null) {
                return jsons(201, '请输入完整');
            }
            $users = age::where('user', $user)->find();
            if (!empty($users)) {
                return jsons(201, '用户名已存在');
            }
            $res = age::insert(['user' => $user, 'password'=>$password, 'time' => time()]);
            if (empty($res)) {
                return jsons(201, '操作失败');
            }
            return jsons(200, '操作成功');
        }
    }

    public function adds(Request $request)
    {
        if ($request->isPost()) {
            $user = input('post.user');
            $password = input('post.password');
            $balance = input('post.balance');
            $pid = input('post.pid');
            $day = input('post.day');
            $zhou = input('post.zhou');
            $month = input('post.month');
            $year = input('post.year');
            $permanent = input('post.permanent');
            if ($user == null && $password == null) {
                return jsons(201, '请输入完整');
            }
            $users = Agpro::where('id', $user)->find();
            if (!empty($users)) {
                return jsons(201, '用户名已存在');
            }
            $res = Agpro::insert([
                'aid' => $user,
                'balance' => $balance,
                'pid' => $pid,
                'time' => time(),
                'day' => $day,
                'zhou' => $zhou,
                'month' => $month,
                'year' => $year,
                'permanent' => $permanent,
            ]);
            if (empty($res)) {
                return jsons(201, '操作失败');
            }
            return jsons(200, '操作成功');
        }
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
                $res = age::where('id', 'in', $where)->delete();
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
                $res = age::where('id', 'in', $where)->update(['status' => 'n']);
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
                $res = age::where('id', 'in', $where)->update(['status' => 'y']);
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }

    public function dels(Request $request)
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
                $res = Agpro::where('id', 'in', $where)->delete();
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }

    public function jstatuss(Request $request)
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
                $res = Agpro::where('id', 'in', $where)->update(['status' => 'n']);
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }

    public function qstatuss(Request $request)
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
                $res = Agpro::where('id', 'in', $where)->update(['status' => 'y']);
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }

    public function apl()
    {
        $list = Agpro::paginate(50);
        $page = $list->render();
        $plist = ModelProject::paginate();
        $alist = age::paginate();
        return view::fetch('/apl', ['list' => $list, 'page' => $page, 'plist' => $plist, 'alist' => $alist]);
    }

    public function editview(Request $request)
    {
        if ($request->isGet()) {
            $id = input('get.id');
            $info = Agpro::where('aid', $id)->find();
            if (empty($info)) {
                return '用户不存在';
            }
            view::assign([
                'id' => $info['id'],
                'balance' => $info['balance'],
                'day' => $info['day'],
                'zhou' => $info['day'],
                'month' => $info['month'],
                'year' => $info['year'],
                'permanent' => $info['permanent'],
            ]);
            return view::fetch('/agentedit');
        }
    }

    public function edits(Request $request)
    {
        $id = input('post.id');
        $datas = $_REQUEST;
        $info = Agpro::where('aid', $id)->find();
        if (empty($info)) {
            return jsons(203, '用户不存在');
        }
        $data = [
            'balance' => $datas['balance'],
            'day' => $datas['day'],
            'zhou' => $datas['zhou'],
            'month' => $datas['month'],
            'year' => $datas['year'],
            'permanent' => $datas['permanent'],
        ];
        $user = Agpro::where('aid', $datas['id'])->update($data);
        if ($user) {
            return jsons(200, '修改成功');
        }
        return jsons(201, '修改失败');
    }
}
