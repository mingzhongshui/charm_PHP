<?php 

namespace system\core;
use system\core\Config;
class Log
{

	static $class;
	static public function init() {
		// 确定存储方式
		// 
		$drive = Config::get('DRIVE', 'log');
		$logClass = '\system\drivers\log\\' . $drive;
		self::$class = new $logClass;

	}

	static public function log($data, $file = 'log')
	{
		self::$class->write($data, $file);
	}
}