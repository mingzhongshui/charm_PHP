<?php 
namespace system\core;

class Model extends \PDO
{

	public function __construct()
	{
		$dsn = 'mysql:host=localhost;dbname=zjm_pro';
		$username = 'root';
		$password = '';
		try {
			parent::__construct($dsn, $username, $password);
		} catch (\PDOException $e) {
			p($e->getMessage());
		}
		
	}
}

