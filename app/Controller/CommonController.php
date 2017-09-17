<?php 
namespace app\Controller;
use system\core\Controller;

/**
 * 登陆控制器(测试)
 */
class CommonController extends Controller
{
	public static $model;
	public function __construct()
	{
		session_start();
		self::$model =& model();
	}

	/**
	 * 登陆
	 */
	public function login()
	{
		if(post('username') && post('password')) {
			$userInfo  = self::$model->select('user', ['id', 'password'], ['username' => trim(post('username'))])[0];
			if(password_verify(post('password'), $userInfo['password']) == TRUE){
				// 记录用户最后一次登录时间
				self::$model->update('user', 
					[
						'login_time' => time(),
						'ip'         => getIp()
					], ['id' => $userInfo['id']]);
				$_SESSION['uid']  = $userInfo['id'];
				$_SESSION['name'] = trim(post('name'));
				$_SESSION['menu'] = '';
				redirect('admin');
			}else{
				echo "<script>alert('账号或密码错误！');location.href='". base_url('admin') ."'</script>";
				exit;
			}
		}
		view('admin/login');
	}

	/**
	 * 	退出时销毁session && 跳转到登陆页面
	 */
	public function logout()
	{
		unset($_SESSION);
		session_destroy(); 
		redirect('common/login');
	}
}