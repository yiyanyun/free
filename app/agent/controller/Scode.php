<?php 
namespace app\agent\controller;
use think\facade\Session;
use think\facade\View;
use app\agent\model\Scode as code;
use app\agent\model\Agpro;
use think\Request;
class scode
{
    public function index()
    {
        $list = code::where('operator',aid())->order('id','desc')->paginate(50);
        $page = $list->render();
        return view::fetch('/scode',['list'=>$list,'page'=>$page]);
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
                $res = code::where('operator',aid())->where('id', 'in', $where)->delete();
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
                $res = code::where('operator',aid())->where('id', 'in', $where)->update(['status'=>'n']);
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
                $res = code::where('operator','in',aid())->where('id', 'in', $where)->update(['status'=>'y']);
                if ($res) {
                    return jsons(200, '操作成功');
                }
                return jsons(201, '操作失败');
            } else {
                return jsons(201, '没有选择数据');
            }
        }
    }

    public function scodeadd()
    {
        $list = agpro::where('aid',aid())->paginate();
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
                $value = 'day';
            } elseif ($kami_value == 2) {
                $value = 'zhou';
            } elseif ($kami_value == 3) {
                $value = 'month';
            } elseif ($kami_value == 4) {
                $value = 'year';
            } elseif ($kami_value == 5) {
                $value = 'permanent';
            } else {
                return jsons(201, '没有你想要的类型');
            }

            if (empty($project_id)) {
                return jsons(201,'项目不存在');
            }
            $Unit = agpro::where(['aid'=>aid(),'pid'=>$project_id])->find();
            $values = $Unit[$value]; //获取单价
            $jieguo = $kami_trait * $values; //开始计算总价 单价乘以总数
            $upquota = $Unit['balance']-$jieguo;
            if ($upquota < 0) {
                return jsons(201, '额度不足');
            }
            $pro = agpro::where(['aid'=>aid(),'pid'=>$project_id])->find();
            if ($pro['status'] == 'n') {
                return jsons(201,'项目已被禁用');
            }
            if (empty($pro)) {
                return jsons(201,'项目不存在');
            }

            // 开始判断时长或值
            if ($kami_value == 1) {
                $value = 1;
            } elseif ($kami_value == 2) {
                $value = 7;
            } elseif ($kami_value == 3) {
                $value = 30;
            } elseif ($kami_value == 4) {
                $value = 365;
            } elseif ($kami_value == 5) {
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
                    'operator' => aid()
                ];
                $res = code::insert($data);
                if (empty($res)) {
                    return jsons(201, '生成失败');
                }
            }
            agpro::where('aid', aid())->update(['balance' => $upquota]);
            return json(array('code' => 200, 'msg' => '生成成功', 'time' => time()));
        }
    }

}