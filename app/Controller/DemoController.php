<?php 
namespace app\Controller;
use system\core\Model;
use system\core\Controller;
use system\core\Config;
use app\library\YunPianSms;
/**
 * 默认控制器(测试)
 */
class DemoController extends Controller
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


	/**
	 * 生成验证码
	 * @param  integer $length 验证码长度
	 * @return string          验证码字符串
	 */
    public function createSmsCode($length = 6)
    {
        $min = pow(10, ($length -1));
        $max = pow(10, $length) -1;
        return rand($min, $max);
    }

	public function sendSms()
	{
		$yunPian     = new YunPianSms();
		$yunPianUser = $yunPian->getUser();
		dump($yunPianUser);
		$result      = $yunPian->sendCode("【命中水】您的验证码是". $this->createSmsCode() ."。如非本人操作，请忽略本短信", 'xxxxx');

		dump($result);
	}
}