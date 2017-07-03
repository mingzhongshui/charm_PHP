<?php 
namespace system\core;
use system\core\Config;
use system\core\lib\Medoo;
/**
 * 模型类
 * date(2017.6.18)
 */
class Model extends Medoo
{

	public function __construct()
	{

		$arrDbMsg = Config::getAll('database');
		parent::__construct($arrDbMsg);
		// $arrDbMsg = Config::getAll('database');
		// $strDsn = "mysql:host={$arrDbMsg['DB_HOST']};dbname={$arrDbMsg['DB_NAME']}";
		// $strDbName = $arrDbMsg['USERNAME'];
		// $strDbPwd = $arrDbMsg['PASSWORD'];

		// try {
		// 	parent::__construct($strDsn, $strDbName, $strDbPwd);
		// } catch (\PDOException $e) {
		// 	p($e->getMessage());
		// }
		
	}
}

