<?php
/**
 * 销售表数据模型
 * @author loid  email:loid@163.com
 */
class m_sales extends base_m {
	public function primarykey() {
		return 'sid';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'sales';
	}
	public function relations() {
		return array ();
	}
	/**
	 * 获取指定会员的消费总金额
	 * @param int $mid
	 */
	public function getUserConsumption($mid) {
		$rs = $this->select ( "mid='{$mid}'", "sum(price*num-refund_amount) as n" )->items;
		if ($rs and $mid > 0) {
			return sprintf ( "%01.2f", $rs [0] ['n'] );
		}
		return "0";
	}
}