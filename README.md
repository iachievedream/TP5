框架實作(Framework implementation)

請假系統(Leave system)
以及專案當中有簡易的API串接

<a href="http://fuwork.xyz/index/index/login.html">demo</a><br>

thinkPHP框架的作品集，使用AWS，測試帳密都為123，簡易的demo請假系統。

上傳
~~~
cd C:\AppServ\www\demo\TP5
git add . 
git commit -m "first commit"
git remote add origin https://github.com/iachievedream/TP5.git
git push -u origin master
~~~

下載安裝流程
~~~
git clone https://github.com/iachievedream/TP5.git
cd TP5
composer install 
~~~
下載完後至此網址查看
http://127.0.0.1/demo/TP5/public/index.php/index/index/login.html

composer操作有問題請往下方網址瀏覽:
https://github.com/iachievedream/notebook/blob/master/web_code/composer.md


ubuntu:<br>

M
~~~
<?php
namespace app\index\model;
use think\Model;
class Leave extends model
~~~
V
~~~
username.html 須小寫
~~~
C
~~~
<?php
namespace app\index\controller;  盡量為小寫
use think\Controller;
use think\Request;
use app\index\model\User;
use app\index\model\Leave;    //index須小寫，Leave盡量為小寫，與M檔名須相同,C下面的function函數也須相同
class Index extends Controller   Index須為大寫


	public function username()   username盡量為小寫
	{
		return $this->fetch();
	}
~~~