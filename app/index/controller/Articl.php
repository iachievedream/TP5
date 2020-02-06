<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\User;
use app\index\model\Article;
class Articl extends Controller
{
	//首頁
	public function Index()
	{
		session_start();
		if(empty($_SESSION['username'])){
			return $this->error('Illegal access, please enter your username and password.', url('login'));
		}
		$list = Article::all();
		$this->assign('list', $list);
		$this->assign('count', count($list));
		return $this->fetch();
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
		// 接收传入数据
		$postData = Request::instance()->post();
		// 实例化Teacher空对象
		$Article = new Article();
		// 为对象赋值
		$Article->article = $postData['article'];
		$Article->Author = $postData['Author'];
		$Article->time = $postData['time'];
		$Article->Remarks = $postData['Remarks'];
		// 新增对象至数据表
		$Article->save();
		// 反馈结果
		return $this->success('Article add success 。', url('Index'));

		// return $this->success('Article add success 。add ID is:'. $Article->id, url('Index'));

		// $leave = new Leave;
		// var_dump($leave);die;
		// if ($leave->allowField(true)->save(input('post.'))) {
		// return '用户[ ' . $leave->name . ':' . $leave->id . ' ]新增成功';
		// } else {
		// return $leave->getError();
		// }
	}
	public function Username()
	{
		session_start();
		if(empty($_SESSION['username'])){
			return $this->error('Illegal access, please enter your username and password.', url('login'));
		}
		$list = User::all();
		$this->assign('list', $list);
		$this->assign('count', count($list));
		return $this->fetch();
	}
	


	//修改資料
	public function Useredit()
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
			if (null === $User = User::get($id))
			{
			// 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
				$this->error('系统未找到ID为' . $id . '的记录');
			}
			// 将数据传给V层
			$this->assign('User', $User);
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

	public function Userupdate(){
		try {
			// 接收数据，获取要更新的关键字信息
			$id = Request::instance()->post('id/d');
			// 获取当前对象
			$User = User::get($id);
			if (!is_null($User)) {
			// 写入要更新的数据
				$User->id = input('post.id');
				$User->name = input('post.name');
				$User->username = input('post.username');
				$User->password = input('post.password');
			// 更新
				if (false === $User->validate(true)->save()) {
					return $this->error('更新失败' . $User->getError());
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
		return $this->success('操作成功', url('Username'));
	}

	public function Userdelete(){
		$id = Request::instance()->param('id/d');
		$User	=	User::get($id);//	获取要删除的对象
		$User->delete();//	删除对象
		return $this->success('删除成功', url('Username'));
	}
// public function insert()
// {
// // 接收传入数据
// $postData = Request::instance()->post();
// // 实例化Teacher空对象
// $Teacher = new Teacher();
// // 为对象赋值
// $Teacher->name = $postData['name'];
// $Teacher->username = $postData['username'];
// $Teacher->sex = $postData['sex'];
// $Teacher->email = $postData['email'];
// // 新增对象至数据表
// $Teacher->save();
// // 反馈结果
// return '新增成功。新增ID为:' . $Teacher->id;
// }
}
