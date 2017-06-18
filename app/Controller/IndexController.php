<?php 
namespace app\Controller;
use system\core\Model;
use system\core\Charm;
use system\core\Config;
class IndexController extends Charm
{
	public function index()
	{

		$model = new Model();
		$route_config = Config::get('DEFAULT_CONTROLLER', 'route');
		$route_action = Config::get('DEFAULT_ACTION', 'route');
		// p($route_config);

		// p($route_action);
		$res = $model->query('select * from user');
		p($res->fetchAll());
		// 
		$this->view('index', ['title' => '测试标题', 'content' => '我是测试内容啊喂']);
	}
}