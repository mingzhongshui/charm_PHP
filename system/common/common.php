<?php 

	function p() 
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

	