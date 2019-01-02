<?php 
namespace app\Controller;
use system\core\Model;
use system\core\Controller;

/**
 * Iss分支切换测试
 */
class IndexController extends Controller
{
	public function index()
	{

		dump($_SERVER);
		
		view('index', ['title' => '测试标题', 'content' => '我是测试内容啊喂']);
	}
}