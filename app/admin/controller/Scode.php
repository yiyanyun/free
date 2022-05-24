<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-13 16:29:01
 * @LastEditTime: 2022-04-07 07:42:57
 * @Description: file content
 * @FilePath: \yiyanyun\app\admin\controller\Scode.php
 */

namespace app\Admin\controller;
use app\admin\model\Project;
use think\facade\View;
use app\admin\model\Scode as code;
use app\api\model\Project as ModelProject;
use think\Request;

class Scode
{
    public function index()
    {
        $list = code::order('id', 'desc')->paginate(50);
        $page = $list->render();
        return view::fetch('/scode', ['list' => $list, 'page' => $page]);
    }

    public function scodeadd()
    {
        $list = project::paginate();
        return view::fetch('/scodeadd', ['list' => $list]);
    }

    public function scode()
    {
        $list = project::paginate();
        return view::fetch('/scodeadd', ['list' => $list]);
    }

    public function add(Request $request)
    {
        if ($request->isPost()) {
            $kami_tatol = input('post.kami_tatol');
            $kami_lenght = input('post.kami_lenght');
            $kami_trait = input('post.kami_trait');
            $project_id = input('post.project_id');
            $kami_value = input('post.kami_value');

            $pros = ModelProject::where('id', $project_id)->find();
            if (empty($pros)) {
                return jsons(201, '项目不存在');
            }
            
            // 开始判断卡密长度
            if ($kami_lenght == 1) {
                $lenght = 10;
            } elseif ($kami_lenght == 2) {
                $lenght = 18;
            } elseif ($kami_lenght == 3) {
                $lenght = 32;
            } elseif ($kami_lenght == 4) {
                $lenght = 40;
            } else {
                return jsons(201, '没有你想要的卡密长度');
            }

            // 开始判断时长或值
            if ($kami_value == 1) {
                $value = 1;
            } elseif ($kami_value == 2) {
                $value = 3;
            } elseif ($kami_value == 3) {
                $value = 7;
            } elseif ($kami_value == 4) {
                $value = 30;
            } elseif ($kami_value == 5) {
                $value = 365;
            } elseif ($kami_value == 6) {
                $value = -1;
            } else {
                return jsons(201, '没有你想要的类型');
            }

            for ($i = 1; $i <= $kami_trait; $i++) {
                if ($kami_tatol == 'Single') {
                    $key = get_code($lenght);
                } elseif ($kami_tatol == 'uppercase') {
                    $key = strtoupper(get_code($lenght));
                } else {
                    return jsons(201, '没有你想要的类型');
                }

                // 组合数据写入数据库
                $data = [
                    'pid' => $project_id,
                    'kami' => $key,
                    'time' => time(),
                    'value' => $value,
                    'operator' => '管理员'
                ];
                $res = code::insert($data);
                if (empty($res)) {
                    return jsons(201, '生成失败');
                }
            }
            return json(array('code' => 200, 'msg' => '生成成功', 'time' => time()));
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
                $res = code::where('id', 'in', $where)->delete();
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
                $res = code::where('id', 'in', $where)->update(['status' => 'n']);
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
                $res = code::where('id', 'in', $where)->update(['status' => 'y']);
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
