<?php 
/**
 * charm_PHP 
 */

define('CHARM', dirname(__FILE__) );
define('SYSTEM', CHARM . '\system');
define('APP', CHARM . '\app');
define('ENVIRONMENT', 'development');
define('CONTROLLER', '\app\Controller\\');

define('APPEXT', '.php');

include "vendor/autoload.php";
switch (ENVIRONMENT)
{
	case 'development':
		$whoops     = new \Whoops\Run;
		$errorTitle = '哎呦！出现一个小bug！~';
		$options    = new \Whoops\Handler\PrettyPageHandler;
		$options->setPageTitle($errorTitle);
		$whoops->pushHandler($options);
		$whoops->register();
		
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

if(is_dir(APP .'\views')) {
	define('VIEWS', APP . '\views\\');
}else {
	mkdir(APP .'\views');
	chmod(APP .'\views', 755);
	define('VIEWS', APP . '\views\\');
}

include SYSTEM . '\common\Function.php';
include SYSTEM . '\core\Charm.php';
spl_autoload_register('\system\core\Charm::load');
\system\core\Charm::run();

 ?>