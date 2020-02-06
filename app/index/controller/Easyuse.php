<?php
namespace app\index\controller;
use app\index\model\Easyuser as UserModel;
class Easyuse
// class tp5easyuseexindex
{
	// 新增用户数据http://127.0.0.1/user/add
	//http://127.0.0.1/index/index/add
	public function add()
	{
		$user = new UserModel;
		$user->nickname = '流年';
		$user->email = 'thinkphp@qq.com';
		$user->birthday = strtotime('1977-03-05');
		if ($user->save()) {
		return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
		} else {
			return $user->getError();
		}
	}
	// 批量新增用户数据http://127.0.0.1/user/add_list
	public function addList()
	{
		$user = new UserModel;
		$list = [
		['nickname' => '张三', 'email' => 'zhanghsan@qq.com', 'birthday' => strtotime('1
		988-01-15')],
		['nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1990-0
		9-19')],
		];
		if ($user->saveAll($list)) {
		return '用户批量新增成功';
		} else {
			return $user->getError();
		}
	}

	// 获取用户数据列表http://127.0.0.1/user/index
	public function index()
	{
		$list = UserModel::all();
		foreach ($list as $user) {
			echo $user->nickname . '<br/>';
			echo $user->email . '<br/>';
			echo date('Y/m/d', $user->birthday) . '<br/>';
			echo '----------------------------------<br/>';
		}
	}

	// 读取用户数据http://127.0.0.1/TP5/public/index/2
	//修改route.php
	public function read($id='')
	{
		$user = UserModel::get($id);
		// var_dump($user);die;
		echo $user->nickname . '<br/>';
		echo $user->email . '<br/>';
		echo date('Y/m/d', $user->birthday) . '<br/>';
	}

	// 更新用户数据http://127.0.0.1/TP5/public/index/update/2
	public function update($id)
	{
		$user = UserModel::get($id);
		$user->nickname = '刘晨';
		$user->email = 'liu21st@gmail.com';
		if (false !== $user->save()) {
			return '更新用户成功';
			} else {
				return $user->getError();
			}
		}
		
	// 删除用户数据http://127.0.0.1/user/delete/5
	public function delete($id)
	{
		$user = UserModel::get($id);
		if ($user) {
			$user->delete();
			return '删除用户成功';
			} else {
			return '删除的用户不存在';
		}
	}
}