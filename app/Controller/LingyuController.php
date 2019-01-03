<?php 
namespace app\Controller;
use system\core\Model;
use system\core\Controller;
use system\core\Config;

/**
 * 公司测试控制器(测试)
 */
class LingyuController extends Controller
{
	public function index()
	{

		dump($_SERVER);
		post();
		// $model = new Model();
		// $route_config = Config::get('DEFAULT_CONTROLLER', 'route');
		// $route_action = Config::get('DEFAULT_ACTION', 'route');
		// p($route_config);

		// p($route_action);
		// $res = $model->query('select * from user');
		// p($res->fetchAll());
		// 
		// echo base_url();
		view('index', ['title' => '测试标题', 'content' => '我是测试内容啊喂']);
	}
}