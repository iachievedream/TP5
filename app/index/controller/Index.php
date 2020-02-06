<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\User;
use app\index\model\Leave;
class Index extends Controller
{
	//登入頁面
	public function login()
	{
		return view();
	}
	// 处理用户提交的登录数据
	public function log()
	{
		// var_dump(sub);die;
		if(!empty($_POST['sub'])){
		// 接收post信息
			$postData = Request::instance()->post();
			// 验证用户名是否存在
			// 直接调用M层方法，进行登录。
			if (user::login($postData['username'], $postData['password'])) {
				$_SESSION['username'] = $_POST['username'];//将登录名保存到session中
				return $this->success('login success', url('index'));
			} else {
				return $this->error('username or password incorrect', url('login'));
			}
		}
		//舊code
		// // var_dump(sub);die;
		// if(!empty($_POST['sub'])){
		// // 接收post信息
		// 	$postData = Request::instance()->post();
		// 	// 验证用户名是否存在
		// 	$map = array('username' => $postData['username']);
		// 	$user = User::get($map);
		// 	// $Teacher要么是一个对象，要么是null。
		// 	if (!is_null($user) && $user->getData('password') === $postData['password']) {
		// 	// 用户名密码正确，将teacherId存session，并跳转至教师管理界面
		// 	// session('teacherId', $user->getData('id'));

		// 	session_start();//开启session
		// 	$_SESSION['username'] = $_POST['username'];//将登录名保存到session中
		// 	return $this->success('login success', url('index'));
		// } else {
		// // 用户名不存在，跳转到登录界面。
		// 	return $this->error('username or password incorrect', url('login'));
		// 	}
		// }
	}
	//新增帳號
	public function addlogin()
	{
		return view();
	}
	//新增帳號處理
	public function addloginadd()
	{
		// 接收传入数据
		$postData = Request::instance()->post();
		// 实例化Teacher空对象
		$User = new User();
		// 为对象赋值
		$User->name = $postData['name'];
		$User->username = $postData['username'];
		$User->password = $postData['password'];
		$User->email = $postData['email'];
			// 新增对象至数据表
		$User->save();
			// 反馈结果
		return $this->success('帳號新增成功。新增ID为:'. $User->id, url('login'));
	}
		//首頁
	public function Index()
	{
		session_start();
		if(empty($_SESSION['username'])){
			return $this->error('Illegal access, please enter your username and password.', url('login'));
		}
		try {
		// 获取查询信息
		$name = Request::instance()->get('name');
		echo $name;
		$pageSize = 10; // 每页显示5条数据
		// 实例化Teacher
		$User = new Leave;
		// 定制查询信息
		if (!empty($name)) {
			$User->where('name', 'like', '%' . $name . '%');
			}
			// 按条件查询数据并调用分页
			$list = $User->paginate($pageSize);
			// 向V层传数据
			$this->assign('list', $list);
			$this->assign('count', count($list));// 取回打包后的数据
			$htmls = $this->fetch();
			// 将数据返回给用户
			return $htmls;
			// 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
		} catch (\think\Exception\HttpResponseException $e) {
			throw $e;
			// 获取到正常的异常时，输出异常
		} catch (\Exception $e) {
			return $e->getMessage();
		}

		// $list = Leave::all();
		// $this->assign('list', $list);
		// $this->assign('count', count($list));
		// return $this->fetch();
	}

		//新增
	public function create()
	{
		session_start();
		if(empty($_SESSION['username'])){
			return $this->error('Illegal access, please enter your username and password.', url('login'));
		}		
		return view();
	}

	public function add()
	{
		session_start();
		if(empty($_SESSION['username'])){
			return $this->error('Illegal access, please enter your username and password.', url('login'));
		}		
			// 接收传入数据
		$postData = Request::instance()->post();
			// 实例化Teacher空对象
		$Leave = new Leave();
			// 为对象赋值
		$Leave->name = $postData['name'];
		$Leave->date = $postData['date'];
		$Leave->reason = $postData['reason'];
		$Leave->approved = $postData['approved'];
			// 新增对象至数据表
		$Leave->save();
			// 反馈结果
		return $this->success('帳號新增成功。', url('Index'));
		// return $this->success('帳號新增成功。新增ID为:'. $User->id, url('Index'));

			// $leave = new Leave;
			// var_dump($leave);die;
			// if ($leave->allowField(true)->save(input('post.'))) {
			// return '用户[ ' . $leave->name . ':' . $leave->id . ' ]新增成功';
			// } else {
			// return $leave->getError();
			// }
	}


	//修改資料
	public function edit()
	{
		session_start();
		if(empty($_SESSION['username'])){
			return $this->error('Illegal access, please enter your username and password.', url('login'));
		}
		try {
			// 获取传入ID
			$id = Request::instance()->param('id/d');
			// 判断是否成功接收
			if (is_null($id) || 0 === $id) {
				throw new \Exception('未获取到ID信息', 1);
			}
			// 在Teacher表模型中获取当前记录
			if (null === $Leave = Leave::get($id))
			{
			// 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
				$this->error('系统未找到ID为' . $id . '的记录');
			}
			// 将数据传给V层
			$this->assign('Leave', $Leave);
			// 获取封装好的V层内容
			$htmls = $this->fetch();
			// 将封装好的V层内容返回给用户
			return $htmls;
			// 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
		} catch (\think\Exception\HttpResponseException $e) {
			throw $e;
			// 获取到正常的异常时，输出异常
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function update(){
		try {
			// 接收数据，获取要更新的关键字信息
			$id = Request::instance()->post('id/d');
			// 获取当前对象
			$Leave = Leave::get($id);
			if (!is_null($Leave)) {
			// 写入要更新的数据
				$Leave->id = input('post.id');
				$Leave->name = input('post.name');
				$Leave->date = input('post.date');
				$Leave->reason = input('post.reason');
				$Leave->approved = input('post.approved');
			// 更新
				if (false === $Leave->validate(true)->save()) {
					return $this->error('更新失败' . $Leave->getError());
				}
			} else {
			throw new \Exception("所更新的记录不存在", 1); // 调用PHP内置类时		，需要在前面加上 \		
			}// 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
		} catch (\think\Exception\HttpResponseException $e) {
			throw $e;
			// 获取到正常的异常时，输出异常
		} catch (\Exception $e) {
			return $e->getMessage();
		}
		// 成功跳转至index触发器
		return $this->success('操作成功', url('index'));
	}
	// 	//修改資料
	// public function data()
	// {
	// 	session_start();
	// 	if(empty($_SESSION['username'])){
	// 		return $this->error('Illegal access, please enter your username and password.', url('login'));
	// 	}		
	// 	return view();
	// }

	public function delete(){
		$id = Request::instance()->param('id/d');
		$Leave	=	Leave::get($id);//	获取要删除的对象
		$Leave->delete();//	删除对象
		return $this->success('删除成功', url('index'));
	}

	//流程
	public function Process()
	{
		session_start();
		if(empty($_SESSION['username'])){
			return $this->error('Illegal access, please enter your username and password.', url('login'));
		}
		return view();
	}

	public function Signout()
	{
		session_start();
		unset($_SESSION['username']);
		return $this->success('Successfully logged out', url('login'));
	}		

	public function insert()
	{
		session_start();
		if(empty($_SESSION['username'])){
			return $this->error('Illegal access, please enter your username and password.', url('login'));
		}	
		// 接收传入数据
		$postData = Request::instance()->post();
		// 实例化Teacher空对象
		$Teacher = new Teacher();
		// 为对象赋值
		$Teacher->name = $postData['name'];
		$Teacher->username = $postData['username'];
		$Teacher->sex = $postData['sex'];
		$Teacher->email = $postData['email'];
		// 新增对象至数据表
		$Teacher->save();
		// 反馈结果
		return '新增成功。新增ID为:' . $Teacher->id;
	}






}