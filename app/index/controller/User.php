<?php
namespace app\index\controller;
use app\index\model\Easyuser as UserModel;
use think\Controller;
use think\Db;
use think\Cookie;
use think\Session;
class User extends Controller{
	// 获取用户数据列表并输出
	public function index()
	{
		$list = UserModel::paginate(10);
		// $list = DB::name('user')
		// 	->where('id','<',18)
		// 	->field('id,nickname,email,birthday')
		// 	->order('id asc')//大到小desc，小到大asc
		// 	->select();
		// dump( Db::name('user')->getLastSql());die;
		// var_dump($list);die;
		$this->assign('list', $list);
		return $this->fetch();
	}
	// 创建用户数据页面
	public function create()
	{
		return view();
	}
	// 新增用户数据
	public function add($nickname='',$email='')
	{
		$user = new UserModel;
		Cookie::set('user_name',$nickname);
		Session::set('user_email',$email);
		if ($user->allowField(true)->save(input('post.'))) {
		// $this->redirect('User/index');
		$this->success('新增成功', 'index');
		// return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
		} else {
			return $user->getError();
		}
	}
	//更新用户数据页面
	public function date()
	{
		$request = request()->param();
		$data = array(
			'id' => $request['id'],
		);
		$user = new UserModel;
		$return = $user->where('id', $data['id'])->find();
		$data = array(
			0 => array(
				'id' =>  $return['id'],
				'nickname' =>  $return['nickname'] ,
				'email' =>  $return['email'] ,
				'birthday' =>  $return['birthday'],
				'status' =>  $return['status'],
				'create_time' =>  $return['create_time'],
				'update_time' =>  $return['update_time'],
			),
		);
		$this->assign('data', $data);
		// var_dump($data);die;
		return view();
	}
	// 更新用户数据
	public function update()
	{	
		$request = request()->param();
		$user = UserModel::get($request['id']);
		if ($user->allowField(true)->save(input('post.'))) {
			// $this->redirect('index');
		$this->success('更新成功', url('index'));
		// return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
		} else {
			return $user->getError();
		}
	}
	// 删除用户数据http://127.0.0.1/user/delete/5
	public function delete()
	{
		$request = request()->param();
		$user = UserModel::get($request['id']);
		if ($user) {
			$user->delete();
			$this->success('删除用户成功', 'index');
			// return '删除用户成功';
		} else {
			return '删除的用户不存在';
		}
	}

}