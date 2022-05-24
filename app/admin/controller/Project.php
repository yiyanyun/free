<?php

namespace app\Admin\controller;

use app\admin\model\Project as pro;
use app\admin\model\Scode;
use app\admin\model\User;
use app\admin\model\Agpro;
use think\facade\View;
use think\Request;

class Project
{
    public function index()
    {
        $list = pro::order('id', 'desc')->paginate(50);
        $page = $list->render();
        return view::fetch('/project', ['list' => $list, 'page' => $page]);
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
                $res = pro::where('id', 'in', $where)->delete();
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
                $res = pro::where('id', 'in', $where)->update(['status' => 'n']);
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
                $res = pro::where('id', 'in', $where)->update(['status' => 'y']);
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }

    public function proadd()
    {
        return view::fetch('/proadd');
    }

    public function proadds(Request $request)
    {
        if ($request->isPost()) {
            $name = input('post.name');
            $version = input('post.version');
            if ($name == null) {
                return jsons(201, '请输入完整');
            }
            $users = pro::where('name', $name)->find();
            if (!empty($users)) {
                return jsons(201, '项目名已存在');
            }
            $key = key_code();
            $res = pro::insert([
                'name' => $name,
                'key' => $key,
                'version' => $version,
                'time' => time()
            ]);
            if (empty($res)) {
                return jsons(201, '操作失败');
            }
            return jsons(200, '操作成功');
        }
    }

    public function proedit(Request $request)
    {
        if ($request->isGet()) {
            $res = input('get.id');
            if (empty($res)) {
                return jsons(201, $res);
            }
            $project = pro::where(['id' => $res])->find();
            $user = user::where('pid', $res)->count();
            $kami = Scode::where('pid', $res)->count();
            $agpro = agpro::where('pid', $res)->count();
            view::assign([
                'user' => $user,
                'kami' => $kami,
                'agent' => $agpro,
                'id' => $project['id'],
                'name' => $project['name'],
                'key' => $project['key'],
                'status' => $project['status'],
                'landing' => $project['landing'],
                'add_time' => $project['add_time'],
                'encrypt' => $project['encrypt'],
                'check' => $project['check'],
                'encrypt_des' => $project['key_des'],
                'encrypt_rc4' => $project['key_rc4'],
                'reg_status' => $project['reg_status'],
                'login_status' => $project['login_status'],
                'kami_status' => $project['kami_status'],
            ]);
            return view::fetch('/proedit');
        }
    }

    public function user(Request $request)
    {
        if ($request->isPost()) {
            $data = input('');
            $res = pro::where('id', $data['id'])->update([
                'reg_status' => $data['reg_status'],
                'login_status' => $data['login_status'],
                'kami_status' => $data['kami_status']
            ]);
            if ($res) {
                return jsons(200, '操作成功');
            }
            return jsons(201, '操作失败');
        }
    }
    public function session_submit(Request $request)
    {
        if ($request->isPost()) {
            $aes = input('post.aes');
            $id = input('post.id');
            $encrypt = input('post.encrypt');
            if (!empty($aes)) {
                $data = [
                    'encrypt' => $encrypt,
                    'key_aes' => $aes
                ];
            }else{
                $data = [
                    'encrypt' => $encrypt
                ];
            }
            $res = pro::where('id', $id)->update($data);
            if ($res) {
                return jsons(200, '操作成功');
            }
            return jsons(201, '操作成功');
        }
    }

    public function pro_submit(Request $request)
    {
        if ($request->isPost()) {
            $pro_name = input('post.pro_name');
            $id = input('post.id');
            $data = [
                'name' => $pro_name
            ];
            $res = pro::where('id', $id)->update($data);
            if ($res) {
                return jsons(200, '操作成功');
            }
            return jsons(201, '操作失败');
        }
    }
    
    public function key(Request $request)
    {
        if ($request->isPost()) {
            $key = key_code();
            $id = input('post.id');
            $data = [
                'key' => $key
            ];
            $res = pro::where('id', $id)->update($data);
            if ($res) {
                return jsons(200, '操作成功');
            }
            return jsons(201, '操作成功');
        }
    }
}
