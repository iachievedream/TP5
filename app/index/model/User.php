<?php
namespace app\index\model;
use think\Model;
class User extends model
{
	// 设置单独的数据库连接
	protected $connection = [
		// 数据库类型
		'type' => 'mysql',
		// 服务器地址
		'hostname' => '127.0.0.1',
		// 数据库名
		'database' => 'mydata',
		// 数据库用户名
		'username' => 'root',
		// 数据库密码
		'password' => '12345678',
		// 数据库连接端口
		'hostport' => '',
		// 数据库连接参数
		'params' => [],
		// 数据库编码默认采用utf8
		'charset' => 'utf8',
		// 数据库表前缀
		'prefix' => '',
		// 数据库调试模式
		'debug' => true,
	];

static public function login($username, $password){// 验证用户是否存在
	$map = array('username' => $username);
	$user = self::get($map);
	if (!is_null($user)) {
	// 验证密码是否正确
		if ($user->checkPassword($password)) {
		// 登录
		session('userId', $user->getData('id'));

		return true;
		}
	}
	return false;
}

public function checkPassword($password){
	if ($this->getData('password') === $password)
	{
		return true;
			} else {
		return false;
		}
	}
}
