<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

// 检查PHP版本
if (version_compare("8.0", PHP_VERSION, ">=")) {
    die("当前的 PHP 运行环境与项目程序运行不兼容，本程序 PHP 版本需高于或等于 PHP8.0 如您有疑惑可联系客服！<br>The current PHP running environment is incompatible with the project program. The PHP version of this program needs to be higher than or equal to php8 0 if you have any doubts, please contact customer service!");
}

require __DIR__ . '/../vendor/autoload.php';

// // 执行HTTP应用并响应
// $http = (new App())->http;

// if (!is_file('../extend/config/install.lock')) {
//     header('Location: /install.php');
// } else {
//     $response = $http->run();
// }

// $response->send();

// $http->end($response);


// 执行HTTP应用并响应
$http = (new App())->http;

$response = $http->run();

$response->send();

$http->end($response);
