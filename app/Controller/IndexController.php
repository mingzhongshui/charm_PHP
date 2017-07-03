<?php 
namespace app\Controller;
use system\core\Model;
use system\core\Controller;
use system\core\Config;

/**
 * 默认控制器(测试)
 */
class IndexController extends Controller
{
	public function index()
	{

		// $model = new Model();
		// $res = $model->query('select * from user');

		// dump($res->fetchAll());
		// 
		// echo base_url();
		view('index', ['title' => '测试标题', 'content' => '我是测试内容啊喂']);
	}
}