<?php 
namespace app\demo\controller;

/**
 * 
 * @author fhw
 * 如果控制器是驼峰，则访问的时候用hello_world/index
 */
class HelloWorld{
    public function index ($name = 'World') {
        return "Hello,{$name}!!!";
    }    
}