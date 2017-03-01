<?php
namespace app\index\controller;
use think\Controller;

class Test extends Controller
{
    public function hello()
    {
        return 'hello,thinkphp!我是方汉文！我为自己代言！！！';
    }

    public function test()
    {
        return '这是一个测试方法!';
    }

    protected function hello2()
    {
        return '只是protected方法!';
    }

    private function hello3()
    {
        return '这是private方法!';
    }
}
