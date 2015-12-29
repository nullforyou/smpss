<?php
/**
 * 地区表数据模型
 * @author loid  email:loid@163.com
 */
class m_region extends base_m {
	public function primarykey() {
		return 'region_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'region';
	}
	public function relations() {
		return array ();
	}
}