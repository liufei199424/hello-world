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
        //	获取包含域名的完整URL地址
		$this->assign('domain',$this->request->url(true));
		return	$this->fetch();
    }

    public function jump ($result = 1) {
    	if($result == 1){
			//设置成功后跳转页面的地址,默认的返回页面是$_SERVER['HTTP_REFERER']
			$this->success('新增成功','test/jumpsuccess');
    	}	else	{
			//错误页面的默认跳转页面是返回前一页,通常不需要设置
			$this->error('新增失败','test/jumperror');
    	}
    }

    public function redirecttest () {
        $this->redirect('test/test',302);
    }

    public function _empty($name)
	{
		//把所有城市的操作解析到city方法
		return $name;
	}

    public function jumpsuccess () {
        return "跳转成功！！！";
    }

    public function jumperror () {
        return "跳转失败！！！";
    }
}
