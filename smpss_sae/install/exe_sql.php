<?php
class exe_sql {
	public $db;
	public $err;
	
	function __construct($database, $db) {
		$this->db = $db;
		if (! mysql_select_db ( $database, $this->db )) {
			//$database = "CREATE DATABASE {$database}";
			//if (! mysql_query ( $database, $this->db )) {
				die ( "无法选择数据库，请检查是否已经创建数据库：{$database}！" );
			//}
			//mysql_select_db ( $database, $this->db );
		}
		$result = mysql_query ( "set names 'utf8'" );
	}
	function seterr($msg) {
		$this->err = $msg;
	}
	function geterr() {
		return $this->err;
	}
	function __destruct() {
		mysql_close ( $this->db );
	}
	function run($sqls,$admin='') {
		if (! is_array ( $sqls )) {
			$this->seterr ( "SQL 为空！" );
			return false;
		}
		foreach ( $sqls as $sql ) {
			$items = $this->parse_sql_file ( $sql );
			if (! $items) {
				continue;
			}
			foreach ( $items as $item ) {
				if (! $item) {
					continue;
				}
				if (! mysql_query ( $item, $this->db )) {
					$this->seterr ( "SQL查询错误！".mysql_error() );
					return false;
				}
			}
		}
		if($admin){
			 mysql_query ("delete from smpss_admin", $this->db );//删除默认的帐号
			 mysql_query ( $admin, $this->db );//创建新管理员帐号
		}
		return true;
	}
	
	function parse_sql_file($file_path) {
		if (! file_exists ( $file_path )) {
			$this->seterr ( "指定的数据库文件不存在！" );
			return false;
		}
		$sql = implode ( '', file ( $file_path ) );
		$sql = preg_replace ( '/^\s*(?:--|#).*/m', '', $sql );
		$sql = preg_replace ( '/^\s*\/\*.*?\*\//ms', '', $sql );
		$sql = trim ( $sql );
		if (! $sql) {
			$this->seterr ( "没有SQL已经！" );
			return false;
		}
		$sql = str_replace ( "\r", '', $sql );
		return explode ( ";\n", $sql );
	}
}
?>