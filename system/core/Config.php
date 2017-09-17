<?php 
namespace system\core;

/**
 * 配置类
 */
class Config
{

	static public $config = [];
	/**
	 * 获取单个配置项值
	 * @param  strkey  $name 单个配置项名
	 * @param  strpath $file 配置文件名
	 * @return string       单个配置项值
	 * date(2017.6.18)
	 */
	static public function get($name, $file) 
	{
		/**
		 * 1、判断配置文件是否存在
		 * 2、判断配置项是否存在
		 * 3、缓存配置
		 */
		$strConfigPath = replace(SYSTEM . '\config\\' . $file . APPEXT);
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

	/**
	 * 获取全部配置项
	 * @param  strpath $file 配置文件名
	 * @return array       配置项
	 * date(2017.6.18 night)
	 */
	static public function getAll($file)
	{	
		$strConfigPath = replace(SYSTEM . '\config\\' . $file . APPEXT);
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

