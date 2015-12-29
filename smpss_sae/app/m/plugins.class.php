<?php
/**
 * 数据转换插件
 * @author loid  email:loid@163.com
 */
class m_plugins {
	public $_db;
	protected $_time;
	protected $_error = array ();
	
	/**
	 * @param string $dbini  在 config/db.ini.php中配置数据库连接
	 */
	function __construct($dbini) {
		$this->_dbConfig = SDb::getConfig ( $dbini );
		$this->_db = SDb::getDbEngine ( "pdo_mysql" );
		$this->_db->init ( $this->_dbConfig );
		$this->_time = time ();
	}
	
	public function __destruct() {
		$this->_db = null;
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
}