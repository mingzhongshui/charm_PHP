<?php 
namespace system\core;

class Charm
{	

	private static $arrClassMap = []; // 加载的类记录数组

	/**
	 * 框架运行
	 */
	static public function run()
	{
		// 实例化路由
		$objRoute = new \system\core\Route();

		// 取得控制器和方法名
		$strController = ucfirst($objRoute->strController) . 'Controller';
		$strAction     = $objRoute->strAction;

		// 拼接控制器文件路径
		$strCtrlFile = APP . '\Controller\\' . $strController . APPEXT;
		$strClass    = CONTROLLER . $strController;
		if(is_file($strCtrlFile)) {
			require_once $strCtrlFile;
			$objClass = new $strClass();
			$objClass->$strAction();
		}else {
			throw new \Exception("找不到控制器 -- " . $strCtrlFile);
		}
	}

	/**
	 * 自动加载类库
	 * @param  string $strClass 方法名
	 */
	static public function load($strClass) 
	{
		$strClassPath = CHARM . '\\' .$strClass . APPEXT;
		if(in_array($strClass, self::$arrClassMap)) {
			return TRUE;
		}else {
			if(is_file($strClassPath)) {
				require_once $strClassPath;
				self::$arrClassMap[$strClass] = $strClass;
			}else {
				return FALSE;
			}
		}
	}	

}


 ?>