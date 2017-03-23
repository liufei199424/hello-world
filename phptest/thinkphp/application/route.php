<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// use think\Route;

// Route::get('blog/:age','index/blog/getage');

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'get'],['name' => '\w+']],
    ],

    // 定义闭包
    // 'hello/[:name]$' => function ($name){
    //     return "Liu,{$name}!!!";
    // },

    // 'hello/[:name]$' => 'index/index/hello',
    'index/[:name]$' => 'index/index/index',
    'hello/[:name]' => 'index/index/hello',
    // 'test' => 'index/index/test',

    // 定义路由的请求类型和后缀
    // 'hello/[:name]' => ['index/index/hello', ['method' => 'get', 'ext' => 'html']],

    // 'blog/:year/:month' => ['blog/archive', ['method' => 'get'], ['year' => '\d{4}', 'month' => '\d{2}']],
    // 'blog/:id'          => ['blog/get', ['method' => 'get'], ['id' => '\d+']],
    // 'blog/:name'        => ['blog/read', ['method' => 'get'], ['name' => '\w+']],

    // 访问方式 tp5.com?s=blog/2014/11
    '[blog]' => [
        'year/:month' => ['index/blog/archive', ['method' => 'get'], ['year' => '\d{4}', 'month' => '\d{2}']],
        ':id' => ['index/blog/get', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/blog/read', ['method' => 'get'], ['name' => '\w+']],
    ],

    '[before]' => [
        'hello' => ['index/before_action/hello',['method' => 'get']],
        'data' => ['index/before_action/data',['method' => 'get']],
    ],
];
