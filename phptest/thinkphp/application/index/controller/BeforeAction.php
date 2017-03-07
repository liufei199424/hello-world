<?php

namespace app\index\controller;
use think\Controller;

class BeforeAction extends Controller
{
    /**
     * 
     * @var 1.0
     * 
     * 前置方法，以键值对的形式
     * 键名：表示前置方法的名称
     * 值：也是以键值对的形式，键表示条件，值表示方法
     * 如果值为空，表示为所有方法的前置方法
     * 例如：'first' 表示所有方法执行前，都会先执行first方法
     * 'second'  =>  ['except'=>'hello'] 表示出了hello方法的其他方法，执行前都会先执行second
     */
	protected	$beforeActionList	=	[
		'first',
		'second'  =>  ['except'=>'hello'],
		'three'   =>  ['only'=>'hello,data'],
	];
	
	protected	function	first()
	{
		echo	'first<br/>';
	}
	
	protected	function	second()
	{
		echo	'second<br/>';
	}
	
	protected	function	three()
	{
		echo	'three<br/>';
	}
	
	public	function	hello()
	{
		return	'hello';
	}
	
	public	function	data()
	{
		return	'data';
	}
}
