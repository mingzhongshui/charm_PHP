<?php 
namespace system\core;

/**
 * 控制器类
 */
class Controller
{
	/**
	 * 加载视图
	 * @param  string $file_path 文件路径
	 * @param  array  $data      值
	 */
	public function view($file_path, $data) 
	{
		$file_path = VIEWS . $file_path . APPEXT;

		if(is_array($data)) extract($data);
		if(is_file($file_path)) include_once $file_path;
	}
}

