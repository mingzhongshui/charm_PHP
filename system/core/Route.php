<?php 

namespace system\core;

class Route
{
	public $strController;
	public $strAction;
	public function __construct() 
	{
		$strDocuPath = $_SERVER['DOCUMENT_ROOT'];
		$strFilePath = __FILE__; // 获取当前文件路径
		$strUri      = $_SERVER['REQUEST_URI'];
		$strFilePath = str_replace($strDocuPath, '', $strFilePath);  

	   	$arrFilePath   = explode(DIRECTORY_SEPARATOR, $strFilePath);
	   	$countFilePath = count($arrFilePath);

	   	for ($i = 0; $i < $countFilePath; $i++) {
	        $p = $arrFilePath[$i];
	        if ($p) {
	            $strUri = preg_replace('/^\/'.$p.'\//', '/', $strUri, 1);
	         }
	     }
      
     	$strUri = preg_replace('/^\//', '', $strUri, 1);
     	if($strUri) {
     		$arrUri = explode('/', trim($strUri, '/'));
     		if( !empty( $arrUri[0] ) ) {
				$this->strController = $arrUri[0];
			}
			if( !empty( $arrUri[1] ) ) {
				$this->strAction = $arrUri[1];
			}else {
				$this->strAction = 'index';
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
     		$this->strController = 'index';
			$this->strAction     = 'index';
     	}
		
	}	
}