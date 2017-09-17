<?php 

function replace($subject, $search = ['/', '\\'], $replace = DIRECTORY_SEPARATOR)
{
	return str_replace($search, $replace, $subject);
}

define('SYSTEM', replace(CHARM . '\system'));
define('CORE', replace(CHARM . '\system\core'));
define('APP', replace(CHARM . '\app'));
define('CONTROLLER', replace('app\Controller\\'));

define('APPEXT', '.php');
define('VIEWS', replace(APP . '\views\\'));


include SYSTEM . replace('\core\Common.php');
include SYSTEM . replace('\core\Charm.php');