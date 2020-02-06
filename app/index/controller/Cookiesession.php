<?php
namespace app\index\controller;
use think\Controller;
use think\Cookie;
use think\Session;
class Cookiesession extends Controller
{
	public function index()
	{
		// $this->success('新增成功', 'Session1/index');
		return $this->fetch();
	}

	public function Cookiesave($name='')
	{
		Cookie::set('user_name',$name);
		$this->success('Cookie设置成功');
	}
	public function Cookiedelete()
	{
		Cookie::delete('user_name');
		$this->success('Cookie删除成功');
	}

	public function Sessionsave($name='')
	{
		Session::set('user_name',$name);
		$this->success('Session设置成功');
	}
	public function Sessiondelete()
	{
		Session::delete('user_name');
		$this->success('Session删除成功');
	}
}