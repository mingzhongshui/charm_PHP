<?php 
namespace system\core;
use system\core\Log;
/**
 * Charm 核心类
 */
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

		Log::init();
		// 取得控制器和方法名
		$strController = ucfirst($objRoute->strController) . 'Controller';
		$strAction     = $objRoute->strAction;

		// 拼接控制器文件路径
		$strCtrlFile = CONTROLLER . $strController . APPEXT;
		$strClass    = replace(CONTROLLER . $strController, ['/', '\\'], '\\');
		file_put_contents('log.log', date('Y-m-d H:i:s') . 'Controller:' . $strClass . '  action:' .  $strAction . PHP_EOL, FILE_APPEND);
		if(is_file($strCtrlFile)) {
			require_once $strCtrlFile;
			$objClass = new $strClass();
			$objClass->$strAction();

			// Log::log('Controller:' . $strClass . '  action:' .  $strAction);
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
		$strClassPath = replace(CHARM . DIRESEP .$strClass . APPEXT);
		if(in_array($strClass, self::$arrClassMap)) {
			return TRUE;
		}else {
			if(is_file($strClassPath)) {
				require_once $strClassPath;
				self::$arrClassMap[$strClass] = $strClass;
			}else {
				throw new \Exception("找不到类 -- " . $strClass);
			}
		}
	}
}
