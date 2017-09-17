<?php 

namespace system\core;
use system\core\Config;
/**
 * 路由类
 */
class Route
{
	public $strController;
	public $strAction;


	public function __construct() 
	{
		
		$strUri = $this->_get_request_uri();

     	if($strUri && $strUri != '/') {
     		$arrUri = explode('/', trim($strUri, '/'));
     		if( !empty( $arrUri[0] ) ) {
				$this->strController = $arrUri[0];
			}
			if( !empty( $arrUri[1] ) ) {
				$this->strAction = $arrUri[1];
			}else {
				$this->strAction = Config::get('DEFAULT_ACTION', 'route');
			}
			$intCount = count($arrUri);
			// 释放控制器和方法
			unset( $arrUri[0], $arrUri[1] );
			$i = 2;
			while ( $i < $intCount ) {
				$_GET[$arrUri[$i]] = isset($arrUri[$i + 1]) ? $arrUri[$i + 1] : '';
				$i = $i + 2;
			}

     	}else {
     		$this->strController = Config::get('DEFAULT_CONTROLLER', 'route');
			$this->strAction     = Config::get('DEFAULT_ACTION', 'route');
     	}
		
	}	

	/**
	 * 获取uri
	 * @return [type] [description]
	 */
	protected function _get_request_uri()
	{
		if ( ! isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']))
		{
			return FALSE;
		}
		$uri   = parse_url($_SERVER['REQUEST_URI']);
		$uri   = isset($uri['path']) ? $uri['path'] : '';
		if (isset($_SERVER['SCRIPT_NAME'][0])) {
			if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
				$uri = (string) substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			} elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
				$uri = (string) substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
		}
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		return $uri;
	}
}