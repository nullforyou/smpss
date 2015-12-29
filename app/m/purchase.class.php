<?php
/**
 * 进货表数据模型
 * @author loid  email:loid@163.com
 */
class m_purchase extends base_m {
	public function primarykey() {
		return 'id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'purchase';
	}
	public function relations() {
		return array ();
	}
	
	public function create($data) {
		$goods_id = ( int ) $data ['goods_id'];
		if (! goods_id or ! $data ['in_num'] or ! $data ['in_price']) {
			$this->setError ( 0, "缺少必要参数" );
			return false;
		}
		$goodsObj = base_mAPI::get ( "m_goods", $goods_id );
		$rs = $goodsObj->get ();
		if ($rs ['goods_sn'] != $data ['goods_sn']) {
			$this->setError ( 0, "参数错误" );
			return false;
		}
		$content = $data ['content'] ? $data ['content'] : "增加入库：名称：{$rs ['goods_name']},数量：{$data ['in_num']}";
		$this->set ( "goods_id", $goods_id );
		$this->set ( "goods_sn", $rs ['goods_sn'] );
		$this->set ( "goods_name", $rs ['goods_name'] );
		$this->set ( "cat_id", $rs ['cat_id'] );
		$this->set ( "in_num", ( float ) $data ['in_num'] );
		$this->set ( "in_price", ( float ) $data ['in_price'] );
		$this->set ( "dateymd", date ( "Y-m-d", $this->_time ) );
		$this->set ( "dateline", $this->_time );
		$res = $this->save ();
		if ($res) {
			$goodsObj->setStock ( $goods_id ); //更新库存
			$logObj = base_mAPI::get ( "m_log" );
			$logObj->create ( $goods_id, $content, 1 );
			return $res;
		}
		$this->setError ( 0, "保存数据失败:" . $this->getError () );
		return false;
	}
	/**
	 * 删除单个库存入库记录
	 * @param int $id
	 */
	public function deleteOne($id) {
		if (! $id) {
			$this->setError ( 0, "缺少必要参数" );
			return false;
		}
		$this->setPkid ( $id );
		$rs = $this->get ();
		if (! $rs)
			return false;
		if ($rs ['out_num'] > 0) {
			$this->setError ( 0, "已经存在销售不能够删除！" );
			return false;
		}
		$this->set ( "isdel", 1 );
		if ($this->save ( $id )) {
			$goodsObj = base_mAPI::get ( "m_goods" );
			if ($goodsObj->setStock ( $rs ['goods_id'] )) {
				$logObj = base_mAPI::get ( "m_log" );
				$logObj->create ( $rs ['goods_id'], "删除入库ID为 {$id} 的记录", 1 );
				return true;
			}
			$this->setError ( 0, "更新商品库存出现异常！原因：" . $this->getError () );
			$this->set ( "isdel", 0 );
			$this->save (); //还原操作 否则可能导致库存不准确
			return false;
		}
		$this->setError ( 0, "删除记录失败！" );
		return false;
	}
	/**
	 * 计算库存
	 * @param int $goods_id
	 */
	public function countStock($goods_id) {
		if (! $goods_id)
			return false;
		$rs = $this->select ( "goods_id = {$goods_id} and isdel=0", "sum(in_num) as c_in,sum(out_num) as c_out" )->items;
		if ($rs [0]) {
			( float ) $stock = $rs [0] ['c_in'] - $rs [0] ['c_out'];
			if ($stock >= 0)
				return $stock;
			$this->setError ( 0, "库存出现异常！" );
			return false;
		}
		$this->setError ( 0, "商品信息不存在！" );
		return false;
	}
	/**
	 * 计算商品平均进价
	 * @param int $goods_id
	 */
	public function avgPrice($goods_id) {
		if (! $goods_id)
			return false;
		$rs = array ();
		$rs = $this->select ( "goods_id = {$goods_id} and isdel=0", "in_num,out_num,in_price" )->items;
		$c_in = $c_price = 0;
		if ($rs) {
			foreach ( $rs as $v ) {
				$stock = $v ['in_num'] - $v ['out_num'];
				$c_in += $stock;
				$c_price += $stock * $v ['in_price'];
			}
			return sprintf ( "%01.2f", $c_price / $c_in );
		}
		$this->setError ( 0, "不存在入库记录！" );
		return false;
	}
	/**
	 * 计算商品库存总量和进货总金额
	 * @param int $goods_id
	 * @return Array
	 */
	public function getStockAmount($goods_id) {
		if (! $goods_id)
			return false;
		$rs = $res = array ();
		$rs = $this->select ( "goods_id = {$goods_id} and isdel=0", "in_num,out_num,in_price" )->items;
		$c_in = $c_price = 0;
		if ($rs) {
			foreach ( $rs as $v ) {
				$stock = $v ['in_num'] - $v ['out_num'];
				$c_in += $stock;
				$c_price += $stock * $v ['in_price'];
			}
			$res ['stock'] = sprintf ( "%01.2f", $c_in );
			$res ['countamount'] = sprintf ( "%01.2f", $c_price );
			return $res;
		}
		$this->setError ( 0, "不存在入库记录！" );
		return false;
	}
	/**
	 * 商品出库
	 * @param int $goods_id
	 * @param float $num
	 * @param int $amount 总售价
	 */
	public function outStock($goods_id, $num = 1, $amount) {
		if ($goods_id) {
			$rs = $this->select ( "goods_id = {$goods_id} and isdel=0 and in_num>out_num", "id,in_num,out_num", "", "order by id asc" )->items; //先进先出
			if (! $rs) {
				$this->setError ( 0, "没有可用的库存" );
				return false;
			}
			foreach ( $rs as $v ) {
				$stock = $v ['in_num'] - $v ['out_num'];
				if ($stock >= $num) {
					$this->update ( "id={$v['id']}", "out_num=out_num+{$num}" );
					break;
				} else {
					$this->update ( "id={$v['id']}", "out_num={$v['in_num']}" );
					$num = $num - $stock;
				}
			}
			$goodsObj = base_mAPI::get ( "m_goods" );
			if ($goodsObj->setStock ( $goods_id, $amount )) {
				$logObj = base_mAPI::get ( "m_log" );
				$logObj->create ( $goods_id, "商品ID：{$goods_id}出库:{$num}", 2 );
				return true;
			} else {
				$this->setError ( 0, "修改商品信息错误" . $goodsObj->getError () );
				return false;
			}
		}
		return false;
	}
	/**
	 * 商品退货
	 * @param int $goods_id
	 * @param float $num
	 * @param int $amount 总退款
	 */
	public function backStock($goods_id, $num = 1, $amount) {
		if ($goods_id) {
			$rs = $this->select ( "goods_id = {$goods_id} and isdel=0 and out_num>0", "id,in_num,out_num", "", "order by id desc" )->items; //后出后进
			if (! $rs) {
				$this->setError ( 0, "该商品没有出库记录" );
				return false;
			}
			foreach ( $rs as $v ) {
				if ($v ['out_num'] >= $num) {
					$this->update ( "id={$v['id']}", "out_num=out_num-{$num}" );
					break;
				} else {
					$this->update ( "id={$v['id']}", "out_num=0" );
					$num = $num - $v ['out_num'];
				}
			}
			$goodsObj = base_mAPI::get ( "m_goods" );
			if ($goodsObj->setStock ( $goods_id, $amount, 0 )) {
				$logObj = base_mAPI::get ( "m_log" );
				$logObj->create ( $goods_id, "退款商品ID：{$goods_id}数量:{$num}退款总金额：{$amount}", 2 );
				return true;
			} else {
				$this->setError ( 0, "修改商品信息错误" . $goodsObj->getError () );
				return false;
			}
		}
		return false;
	}
}