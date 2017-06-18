<?php 
namespace app\Controller;
use system\core\Model;
use system\core\Charm;
class IndexController extends Charm
{
	public function index()
	{

		$model = new Model();

		$res = $model->query('select * from user');
		// p($res->fetchAll());
		// 
		$this->view('index', ['title' => '测试标题', 'content' => '我是测试内容啊喂']);
	}
}