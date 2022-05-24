<?php 
namespace app\admin\model;
use think\model;

class api extends model
{
    protected $table = 'yi_apicode';

    protected $type = [
        'time'=>'timestamp'
    ];

}