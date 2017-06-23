<?php 
namespace app\Controller;
use system\core\Model;
use system\core\Controller;
use system\core\Config;

/**
 * 默认控制器(测试)
 */
class TestController extends Controller
{
	public function index()
	{
		
		// post();
		// echo base_url('index/index').'<br>';
		// echo js('css.css');
		// $model = new Model();
		// $route_config = Config::get('DEFAULT_CONTROLLER', 'route');
		// $route_action = Config::get('DEFAULT_ACTION', 'route');
		// p($route_config);

		// p($route_action);
		// $res = $model->query('select * from user');
		// p($res->fetchAll());
		// 
		// echo base_url();
		view('index', ['title' => '测试标题test', 'content' => '我是测试内容啊喂']);
	}
}