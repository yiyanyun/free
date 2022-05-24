<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-20 11:45:52
 * @LastEditTime: 2022-04-10 11:07:16
 * @FilePath: \yiyanyun\app\admin\middleware\Auth.php
 */

declare(strict_types=1);

namespace app\admin\middleware;

use think\facade\Session;
use think\facade\View;
use app\admin\model\Admin;

class Auth
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
        if ($action !== 'login' && $action != 'reg') {
            if (!Session::get('token')) {
                if ($request->isAjax()) {
                    //
                } else {
                    redirect('/admin/login')->send();
                    exit;
                }
            }
        }
        return $next($request);
    }
}
