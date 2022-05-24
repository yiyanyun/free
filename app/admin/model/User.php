<?php
/*
 * @Author: Lucifer
 * @Date: 2022-03-13 15:29:15
 * @LastEditTime: 2022-04-10 14:35:00
 * @FilePath: \yiyanyun\app\admin\model\User.php
 */
namespace app\admin\model;
use think\model;
class User extends model
{
    protected $type = [
        'reg_time' => 'timestamp',
        'vip' => 'timestamp',
    ];
}