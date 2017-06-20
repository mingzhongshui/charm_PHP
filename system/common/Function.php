<?php 
	
	/**
	 * 打印函数
	 * @param  array/string/int  $arr  打印变量
	 * @param  boolean 			 $flag 是否终止标识符
	 * @return string        
	 */
	function p($arr, $flag = TRUE) 
	{
		echo "<pre>";
		echo '========================开始========================';
		echo "</br>";
		if( $arr ){
			print_r($arr);
		} else {
			echo '此值为空';
		}
		echo "</br>";
		echo '========================结束========================';
		echo "</pre>";
		if($flag == FALSE) exit;
	}

	

	