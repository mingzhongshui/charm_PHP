<?php 
/**
 * charm_PHP 
 */
header( 'Content-Type:text/html;charset=utf-8 ');
date_default_timezone_set('PRC');
define('DIRESEP', DIRECTORY_SEPARATOR);
define('CHARM', str_replace(array('/', '\\'), DIRESEP, dirname(__FILE__)));
define('ENVIRONMENT', 'testing');

include "vendor/autoload.php";


/**
 * 错误级别设置 引自CI
 */
switch (ENVIRONMENT)
{
	case 'development':
		$whoops     = new \Whoops\Run;
		$errorTitle = '哎呦！出现一个小bug！~';
		$options    = new \Whoops\Handler\PrettyPageHandler;
		$options->setPageTitle($errorTitle); // 设置错误标题
		$whoops->pushHandler($options); 
		$whoops->register();

		error_reporting(-1);
		ini_set('display_errors', 1);
		break;

	case 'testing':
		$whoops     = new \Whoops\Run;
		$errorTitle = '哎呦！出现一个小bug！~';
		$options    = new \Whoops\Handler\PrettyPageHandler;
		$options->setPageTitle($errorTitle); // 设置错误标题
		$whoops->pushHandler($options); 
		$whoops->register();
		
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>=')) {
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		} else {
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
		break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}


require_once 'system' . DIRESEP . 'core'. DIRESEP . 'Core.php';
spl_autoload_register('\system\core\Charm::load');

\system\core\Charm::run();