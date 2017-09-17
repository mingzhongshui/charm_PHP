<?php 

namespace system\drivers\log;
use system\core\Config;
class file
{	
	private $_pathSave;

	public function __construct()
	{
		$logOption = Config::get('OPTION', 'log');
		$this->_pathSave = $logOption['PATH'];
	}

	
	public function write($data, $file = 'log') {
		$dateToday  = date('Ymd');
		$pathSaveFloder  = replace($this->_pathSave . $dateToday . '\\');
		$strSaveFileName = $pathSaveFloder . $file . '.log';
		$jsonSaveContent = date('Y-m-d H:i:s') . '   ' . json_encode($data);
		if(is_dir($pathSaveFloder)) {
			file_put_contents($strSaveFileName, $jsonSaveContent . PHP_EOL, FILE_APPEND);
		}else {
			mkdir($pathSaveFloder, 0755, true);
			file_put_contents($strSaveFileName, $jsonSaveContent . PHP_EOL, FILE_APPEND);
		}
	}
}
