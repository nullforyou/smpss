<?php
/**
 * 管理员主表数据模型
 * @author loid  email:loid@163.com
 */
class m_group extends base_m {
	public function primarykey() {
		return 'gid';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'group';
	}
	public function relations() {
		return array ();
	}
}