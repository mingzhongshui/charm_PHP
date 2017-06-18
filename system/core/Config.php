<?php 
namespace system\core;

class Config
{

	static public $config = [];
	static public function get($name, $file) 
	{
		/**
		 * 1、判断配置文件是否存在
		 * 2、判断配置项是否存在
		 * 3、缓存配置
		 */
		$strConfigPath = SYSTEM . '\config\\' . $file . APPEXT;
		if(isset(self::$config[$file])) {
			return self::$config[$file][$name];
		}else {
			if(is_file($strConfigPath)) {
				$conf = include $strConfigPath;
				if(isset($conf[$name])) {
					self::$config[$file] = $conf;
					return $conf[$name];
				}else {
					throw new \Exception("找不到配置项：" . $name);
				}
			}else {
				throw new \Exception("找不到配置文件：" . $file);
				
			}
		}
		
	}

	static public function getAll($file)
	{	
		$strConfigPath = SYSTEM . '\config\\' . $file . APPEXT;
		if(isset(self::$config[$file])) {
			return self::$config[$file];
		}else {
			if(is_file($strConfigPath)) {
				$conf = include $strConfigPath;
				self::$config[$file] = $conf;
				return self::$config[$file];
			}else {
				throw new \Exception("找不到配置文件：" . $file);
				
			}
		}
	}
}

