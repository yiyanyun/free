<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-19 20:12:51
 * @LastEditTime: 2022-04-02 15:50:58
 * @FilePath: \yiyanyun\app\agent\middleware\Auth.php
 */

declare(strict_types=1);
namespace app\agent\middleware;
use think\facade\View;
use think\facade\Session;
use app\agent\model\Agent;
class auth
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        // 添加中间件执行代码
        $pathInfo = str_replace('.' . $request->ext(), '', $request->pathInfo());
        $action = explode('/', $pathInfo)[0];
        if ($action !== 'login'&&$action!='reg') {
            if (!Session::get('tokens')) {
                if ($request->isAjax()) {
                    //
                } else {
                    redirect('/agent/login')->send();
                    exit;
                }
            }
            $ids = session::get('tokens','');
            if (!empty($ids)) {
                $data = Agent::where('id', aid())->find();
                View::assign([
                    'nick' => $data['nick'],
                ]);
                session::set('id', $data['id']);
            }
        }
        return $next($request);
    }
}
