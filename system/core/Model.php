<?php 
namespace system\core;
use Medoo\Medoo;
use system\core\Config;

/**
 * 模型类
 * date(2017.6.18)
 */
class Model extends Medoo
{
	public $_model; 
	protected $pk;
	public function __construct()
	{
		$arrDbMsg = Config::getAll('database');
		parent::__construct($arrDbMsg);
		if(empty($this->_model)) {
			$this->_model = new Medoo();
		}
	}

	/**
	 * 获取主键值
	 * @return string 获取主键值
	 */
	public function getPk()
	{
		return $this->pk;
	}

	/**
	 * 获取表名
	 * @return string 表名
	 */
	public function getTable() 
	{
		$model     = get_class($this);
		$model     = str_replace('Model', '', $model);
		$model     = explode('\\', $model);
		$modelName = end($model);
		return lcfirst($modelName);
	}

	/**
	 * 根据ID获取数据
	 * @param  int 			$id     ID
	 * @param  string/array $colums 查询字段
	 * @return array                查询数据
	 */
	public function byPkGetInfo($id, $colums = '*')
	{

		if($colums != '*'
			&& is_string($colums)
			&& (strpos($colums, ',') !== FALSE)) {
			$colums = explode(',', $colums);
		}
		return $this->select($this->getTable(), $colums, [$this->getPk() => $id])[0];
	}

	
	public function byPkDel($id)
	{
		if($id) {
			return $this->delete($this->getTable(), [$this->getPk() => $id]);
		}
		
	}

	public function byPkGetVal($id)
	{

	}
}

