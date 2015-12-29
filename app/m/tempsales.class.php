<?php
/**
 * 销售表临时表数据模型
 * @author loid  email:loid@163.com
 */
class m_tempsales extends base_m {
	public function primarykey() {
		return 'id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'tempsales';
	}
	public function relations() {
		return array ();
	}
	
	public function insertOrder($data,$order_id){
		if(!$order_id){
			$this->setError(0,"订单号为空！");
			return false;
		}
		$data['order_id'] = $order_id;
		$data['dateline'] = $this->_time;
		$rs = $this->insert($data);
		if($rs){
			return true;
		}else{
			$this->setError(0,"插入数据出错!");
			return false;
		}
	}
	
	public function delOrder($orderid){
		if($orderid){
			$this->delete("order_id='{$orderid}'");
			return true;
		}
		return false;
	}
	
	public function updateOrder($data){
		if($data['order_id'] and $data['goods_id']){
			$this->update("order_id='{$data['order_id']}' and goods_id={$data['goods_id']}","num={$data['num']}");
			return true;
		}
		return false;
	}
	
}