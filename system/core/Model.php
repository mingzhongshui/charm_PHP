<?php 
namespace system\core;
use system\core\Config;

/**
 * 模型类
 * date(2017.6.18)
 */
class Model extends \PDO
{

	public function __construct()
	{
		$arrDbMsg = Config::getAll('database');
		$strDsn = "mysql:host={$arrDbMsg['DB_HOST']};dbname={$arrDbMsg['DB_NAME']}";
		$strDbName = $arrDbMsg['USERNAME'];
		$strDbPwd = $arrDbMsg['PASSWORD'];

		try {
			parent::__construct($strDsn, $strDbName, $strDbPwd);
		} catch (\PDOException $e) {
			p($e->getMessage());
		}
		
	}
}

