<?php 

namespace system\core;

class Route
{
	public $strController;
	public $strAction;
	public function __construct() 
	{
		// xxx.com/index/index/id/1
		// 1、隐藏index.php
		// 2、获取url参数部分
		// 3、返回对应控制器和方法
		
		if( isset( $_SERVER['REQUEST_URI'] ) && $_SERVER['REQUEST_URI'] != '/' ) {
			$arrUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
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
			$this->strAction = 'index';
		}

		
	}	
}