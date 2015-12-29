<?php
/**
 * 管理员主表数据模型
 * @author loid  email:loid@163.com
 */
class m_admin extends base_m {
	public function primarykey() {
		return 'admin_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'admin';
	}
	public function relations() {
		return array ();
	}
	public function checkLogin($username, $pwd, $timeout = 7200) {
		$pwd = md5 ( $pwd );
		$rs = $this->selectOne ( "admin_name = '{$username}' and admin_pwd = '{$pwd}'" );
		if ($rs) {
			if ($this->update ( "admin_id = {$rs['admin_id']}", "lastlogintime = {$this->_time}" )) {
				$cookie ['admin_id'] = $rs ['admin_id'];
				$cookie ['admin_name'] = $rs ['admin_name'];
				$cookie ['gid'] = $rs ['gid'];
				$cookie ['lastlogintime'] = $rs ['lastlogintime'];
				$cookie ['key'] = md5 ( $rs ['admin_id'] . $rs ['admin_name'] . $rs ['lastlogintime'] . base_Constant::COOKIE_KEY );
				base_Utils::ssetcookie ( $cookie, $timeout );
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}