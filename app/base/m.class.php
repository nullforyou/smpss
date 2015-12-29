<?php
/**
 * 模型基类
 */
class base_m {
	public $_db;
	protected $_time;
	protected $_pkid; //数据对象主键
	protected $_pkid_lock = array ();
	protected $_data = array ();
	protected $_dataTmp = array ();
	protected $_error = array ();
	
	function __construct($pkid = false) {
		$this->_dbConfig = SDb::getConfig ( "default" );
		$this->_db = SDb::getDbEngine ( "mysql" );
		$this->_db->init ( $this->_dbConfig );
		$this->_time = time ();
		if ($pkid !== false) {
			$this->setPkid ( $pkid );
		}
	}
	
	public function __destruct() {
		$this->_db = null;
	}
	
	/**
	 * 强行指定为主库
	 */
	public function setDbEntry($dbtype = 'main') {
		$this->_db->setDbEntry ( $dbtype );
	}
	
	/**
	 * 写入错误信息
	 * @param int $code
	 * @param string $msg
	 */
	protected function setError($code = 0, $msg = "") {
		$this->_error ["code"] = $code;
		$this->_error ["msg"] = $msg;
	}
	/**
	 * 获取错误信息
	 * @param string $type
	 */
	public function getError($type = "msg") {
		return $this->_error [$type];
	}
	/**
	 * 设置主健名称
	 */
	public function primarykey() {
		return "id";
	}
	
	/**
	 * 设置当前表名，该方法必需被子类覆盖
	 */
	public function tableName() {
		return false;
	}
	
	/**
	 * 设置主健值
	 * @param int $id
	 */
	public function setPkid($id) {
		$this->_pkid = $id;
		$this->_dataTmp = array ();
	}
	
	/**
	 * 获取当前主健值
	 */
	public function getPkid() {
		return $this->_pkid;
	}
	
	/**
	 * 数据输入
	 * @param string $key,字段名
	 * @param mixed $value,对应值
	 */
	public function set($key, $value) {
		if (empty ( $this->_pkid )) {
			$this->_data [0] [$key] = $value;
		} else {
			$this->_data [$this->_pkid] [$key] = $value;
		}
		$this->_dataTmp [$key] = $value;
	}
	
	/**
	 * 数据保存
	 * @param mixed $pkid  当存在主健值是，为更新否则为插入，$pkid传入false时为插入
	 * @param boolean $lock 是否锁表,公用于更新操作
	 */
	public function save($pkid = "", $lock = false) {
		if (! $this->_dataTmp) {
			return true;
		}
		if ($pkid === false) {
			$this->_pkid = null; //清除主键值
		}
		if ($pkid) {
			$this->_pkid = $pkid;
		}
		$tableName = $this->tableName ();
		if (! $tableName) {
			return false;
		}
		$primarykey = $this->primarykey ();
		if (! $primarykey) {
			return false;
		}
		if ($this->_pkid) { //存在主健值则为修改
			$condition = array ($primarykey => $this->_pkid );
			if ($lock == true) {
				$rowCount = $this->_db->update ( $tableName, $condition, $this->_dataTmp, array ('lock' => 1 ) );
			} else {
				$rowCount = $this->_db->update ( $tableName, $condition, $this->_dataTmp );
			}
			if ($rowCount === false) {
				return false;
			} else {
				$this->_dataTmp = array (); //清空临时数据
				return true;
			}
		} else { //不存在主健值为插入
			$lastInsertID = $this->_db->insert ( $tableName, $this->_dataTmp );
			$this->_pkid = $lastInsertID;
			$this->_dataTmp = array (); //清空临时数据
			return $lastInsertID;
		}
	}
	
	/**
	 * 获取一行数据
	 * @param mixed $condition 条件
	 * @param mixed $item 查询字段
	 * @param boolean $lock 是否锁表
	 * 
	 */
	public function get($condition = "", $item = "*", $lock = false) {
		$search = null;
		if (!empty($this->_pkid) && !empty($this->_data [$this->_pkid])) {
			$search = $this->_data [$this->_pkid];
		}
		if ((! $condition) && $search) { //没有查询条件并且data数据存在，直接返回数据
			return $this->_data [$this->_pkid];
		}
		$tableName = $this->tableName ();
		if (! $tableName) {
			return false;
		}
		$primarykey = $this->primarykey ();
		if (! $primarykey) {
			return false;
		}
		if (! $condition) {
			if (! $this->_pkid) {
				return false;
			}
			$condition = array ($primarykey => $this->_pkid );
		}
		if ($item != "*") {
			$item = str_replace ( " ", "", $item );
			if (! is_array ( $item )) {
				$aItem = explode ( ",", $item );
			}
			if (! in_array ( $primarykey, $aItem )) { //查询字段中不包括主键时，把主键加进去
				$aItem [] = $primarykey;
			}
			$item = implode ( ",", $aItem );
		}
		if ($lock == true) {
			$data = $this->_db->selectOne ( $tableName, $condition, $item, null, null, null, array ('lock' => 'FOR UPDATE' ) );
		} else {
			
			$data = $this->_db->selectOne ( $tableName, $condition, $item );
		}
		$this->_pkid = $data [$primarykey];
		$this->_data [$this->_pkid] = $data;
		return $this->_data [$this->_pkid];
	}
	
	/**
	 * 获取data数据
	 * @param string $key 键名
	 * @param boolean $lock 是否锁表，仅在需要重新从数库取回数据时有效
	 */
	public function getData($key = "", $lock = false) {
		if (! $this->_pkid) {
			return false;
		}
		//是否需要重新获取数据
		$is_entry = $lock == true && $this->_pkid_lock [$this->_pkid] != true;
		if ($is_entry) {
			//清除数据
			$this->_pkid_lock [$this->_pkid] = true;
			$this->clearData ();
		}
		if (! $this->_data [$this->_pkid]) {
			$this->_data [$this->_pkid] = $this->get ( "", "*", $lock );
		}
		if ($key) {
			if ($this->_data [$this->_pkid] [$key] !== null) {
				return $this->_data [$this->_pkid] [$key];
			} else {
				$primarykey = $this->primarykey ();
				if (! $primarykey) {
					return false;
				}
				$this->_data [$this->_pkid] = $this->get ( array ($primarykey => $this->_pkid ), "*", $lock );
				//保持最新的值,避免被获取的数据覆盖
				foreach ( $this->_dataTmp as $k => $v ) {
					$this->set ( $k, $v );
				}
				return $this->_data [$this->_pkid] [$key];
			}
		} else {
			return $this->_data [$this->_pkid];
		}
	}
	
	/**
	 * 清除data数据
	 */
	public function clearData() {
		$this->_data [( int ) $this->_pkid] = null;
	}
	
	/**
	 * 删除
	 * @return boolean
	 */
	public function del() {
		if (! $this->_pkid) {
			return false;
		}
		$tableName = $this->tableName ();
		$primarykey = $this->primarykey ();
		$res = $this->_db->delete ( $tableName, array ($primarykey => $this->_pkid ) );
		if ($res > 0) {
			$this->_data [$this->_pkid] = array ();
			$this->_dataTmp = array ();
			$this->_pkid = null;
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 单行记录查询
	 */
	public function selectOne($condition = "", $item = "*", $groupby = "", $orderby = "", $leftjoin = "", $params = array('type'=>'query')) {
		return $this->_db->selectOne ( $this->tableName (), $condition, $item, $groupby, $orderby, $leftjoin, $params );
	}
	
	/**
	 * 多行记录查询
	 */
	public function select($condition = "", $item = "*", $groupby = "", $orderby = "", $leftjoin = "", $params = array('type'=>'query')) {
		return $this->_db->select ( $this->tableName (), $condition, $item, $groupby, $orderby, $leftjoin, $params );
	}
	
	/**
	 * 插入记录
	 */
	public function insert($item = "", $isreplace = false, $isdelayed = false, $update = array(), $params = array('type'=>'main')) {
		return $this->_db->insert ( $this->tableName (), $item, $isreplace, $isdelayed, $update, $params );
	}
	
	/**
	 * 更新记录
	 */
	public function update($condition = "", $item = "", $params = array('type'=>'main')) {
		return $this->_db->update ( $this->tableName (), $condition, $item, $params );
	}
	
	/**
	 * 删除记录
	 */
	public function delete($condition = "", $params = array('type'=>'main')) {
		return $this->_db->delete ( $this->tableName (), $condition, $params );
	}
	
	/**
	 * 直接执行SQL
	 */
	public function query($sql, $bind1 = array(), $bind2 = array(), $params = array()) {
		return $this->_db->query ( $this->tableName (), $sql, $bind1, $bind2, $params );
	}
	
	/**
	 * 设置是否统计总数
	 */
	public function setCount($count) {
		$this->_db->setCount ( $count );
	}
	
	/**
	 * 设置当前页数
	 */
	public function setPage($page) {
		$this->_db->setPage ( $page );
	}
	
	/**
	 * 设置当前返回记录数
	 */
	public function setLimit($limit) {
		$this->_db->setLimit ( $limit );
	}
	
	/**
	 * 开始事务
	 */
	public function beginTransaction($table = '', $params = array('type'=>'main')) {
		$table = empty ( $table ) ? $this->tableName () : $table;
		return $this->_db->beginTransaction ( $table, $params );
	}
	
	/**
	 * 提交事务
	 */
	public function commit($table = '', $params = array('type'=>'main')) {
		$table = empty ( $table ) ? $this->tableName () : $table;
		return $this->_db->commit ( $table, $params );
	}
	
	/**
	 * 回滚事务
	 */
	public function rollBack($table = '', $params = array('type'=>'main')) {
		$table = empty ( $table ) ? $this->tableName () : $table;
		return $this->_db->rollBack ( $table, $params );
	}
	
	/**
	 * 获取数据库错误信息
	 */
	public function getDbError() {
		return join ( ',', ( array ) $this->_db->error ['msg'] );
	}
	
	/**
	 * 获取插入ID
	 */
	public function lastInsertId() {
		return $this->_db->lastInsertId ();
	}
	
	/**
	 * 获取relations条件
	 * @param string $name 关系名称
	 * @return string|false
	 */
	public function getRelationsCondition($name) {
		$conditon = '';
		$relations = $this->relations ();
		if (! isset ( $relations [$name] )) {
			$this->setError ( 0, '无法获取关系结构' );
			return false;
		}
		$condition = $relations [$name] [1];
		return $condition;
	}
	/**
	 * 获取临时数据
	 */
	public function getTmpData() {
		return $this->_dataTmp;
	}
	
	/**
	 * 清空表数据
	 */
	public function clearTable($tableArr=array()){
		if(is_array($tableArr)){
			foreach($tableArr as $t){
				$this->_db->delete(base_Constant::TABLE_PREFIX.$t);
			}
		}
		return true;
	}
}
