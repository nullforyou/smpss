<?php
/**
 * 商品表数据模型
 * @author loid  email:loid@163.com
 */
class m_goods extends base_m {
	public function primarykey() {
		return 'goods_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'goods';
	}
	public function relations() {
		return array ();
	}
	
	public function getGoodsList($condition = '', $page = 1) {
		$this->setCount ( true );
		$this->setPage ( $page );
		$this->setLimit ( base_Constant::PAGE_SIZE );
		$goodsTableName = $this->tableName ();
		$cateTableName = base_Constant::TABLE_PREFIX . 'category';
		$rs = $this->select ( $condition, "{$goodsTableName}.*,{$cateTableName}.cat_name", "", "order by goods_id desc", array ("{$cateTableName}" => "{$goodsTableName}.cat_id={$cateTableName}.cat_id" ) );
		if ($rs)
			return $rs;
		return array ();
	}
	
	public function create($data) {
		if (! $data ['goods_name'] or ! $data ['goods_sn'] or ! $data ['out_price']) {
			$this->setError ( 0, "缺少必要参数" );
			return false;
		}
		$snRs = $this->get ( "goods_sn='{$data ['goods_sn']}'", 'goods_id' );
		if ($snRs ['goods_id'] != $data ['goods_id']) {
			$this->setError ( 0, "条形码重复" );
			return false;
		}
		$data ['market_price'] = $data ['market_price'] ? $data ['market_price'] : $data ['out_price'] * 1.2;
		$this->set ( "cat_id", ( int ) $data ['cat_id'] );
		$this->set ( "goods_name", $data ['goods_name'] );
		$this->set ( "goods_sn", $data ['goods_sn'] );
		$this->set ( "weight", $data ['weight'] );
		$this->set ( "unit", $data ['unit'] );
		$this->set ( "warn_stock", ( int ) $data ['warn_stock'] );
		$this->set ( "in_price", $data ['in_price'] );
		$this->set ( "out_price", $data ['out_price'] );
		$this->set ( "market_price", $data ['market_price'] );
		$this->set ( "promote_price", $data ['promote_price'] );
		$this->set ( "ispromote", $data ['ispromote'] );
		$this->set ( "promote_start_date", $data ['promote_start_date'] );
		$this->set ( "promote_end_date", $data ['promote_end_date'] );
		$this->set ( "ismemberprice", $data ['ismemberprice'] );
		$this->set ( "creatymd", date ( 'Y-m-d', $this->_time ) );
		$this->set ( "creatdateline", $this->_time );
		$content = $data ['goods_id'] ? "修改商品：{$data ['goods_name']}" : "新增商品：{$data ['goods_name']}";
		$rs = $this->save ( $data ['goods_id'] );
		if ($rs) {
			$logObj = base_mAPI::get ( "m_log" );
			$logObj->create ( $rs, $content, 0 );
			if (( int ) $data ['in_num'] > 0 and ! $data ['goods_id']) { //新增商品才可以同时入库
				$purchaseObj = base_mAPI::get ( "m_purchase" );
				$purchase ['goods_id'] = $rs;
				$purchase ['in_num'] = ( float ) $data ['in_num'];
				$purchase ['in_price'] = ( float ) $data ['in_price'];
				$purchase ['goods_sn'] = $data ['goods_sn'];
				$purchaseObj->create ( $purchase );
			}
			return $rs;
		}
		$this->setError ( 0, "保存数据失败" . $this->getError () );
		return false;
	}
	/**
	 * 修改库存
	 * @param int $goods_id
	 * @param float $amount
	 * @param int $isadd 1加 0减
	 */
	public function setStock($goods_id, $amount = 0, $isadd = 1) {
		if (! $goods_id)
			return false;
		$purchaseObj = base_mAPI::get ( "m_purchase" );
		$stock = $purchaseObj->getStockAmount ( $goods_id );
		if ($stock) {
			$this->setPkid ( $goods_id );
			if ($amount > 0) {
				if ($isadd == 1) {
					$salesamount = $this->getData ( "salesamount" ) + $amount;
					$this->set ( "salesamount", $salesamount );
				} else {
					$salesamount = $this->getData ( "salesamount" ) - $amount;
					$this->set ( "salesamount", $salesamount );
				}
			}
			$this->set ( "countamount", $stock ['countamount'] );
			$this->set ( "stock", $stock ['stock'] );
			$this->set ( "lastinymd", date ( "Y-m-d", $this->_time ) );
			$this->set ( "lastindateline", $this->_time );
			if ($this->save ())
				return true;
		}
		$this->setError ( 0, "库存异常" );
		return false;
	}
	/**
	 * 获取商品的实际售价和优惠情况
	 * @param int $goods_id
	 * @return Array
	 */
	public function getSalePrice($goods_sn) {
		$goods = $this->get ( "goods_sn='{$goods_sn}'" );
		if (! $goods)
			return false;
		$data = array ();
		$data ['goods_name'] = $goods ['goods_name'];
		$data ['goods_sn'] = $goods ['goods_sn'];
		$data ['stock'] = $goods ['stock'];
		$data ['goods_id'] = $goods ['goods_id'];
		$data ['cat_id'] = $goods ['cat_id'];
		$data ['out_price'] = $goods ['out_price'];
		$data ['p_discount'] = 0;
		$data ['ismemberprice'] = $goods ['ismemberprice'];
		$data ['ispromote'] = $goods ['ispromote'];
		$ymd = date ( "Y-m-d", $this->_time );
		if ($goods ['ispromote'] == 1 and $ymd > $goods ['promote_start_date'] and $ymd < $goods ['promote_end_date']) {
			$data ['promote_price'] = $goods ['promote_price'];
			$data ['p_discount'] = sprintf ( "%01.2f", $goods ['out_price'] - $goods ['promote_price'] ); //促销优惠
		}
		return $data;
	}
	
	/**
	 * 计算商品平均进价
	 * @param array 商品ID 数组 也可是单个ID
	 */
	function getAvgPrice($goods_ids) {
		$avgrice = array ();
		if (is_array ( $goods_ids )) {
			$goods_ids = join(",", $goods_ids);
			$rs = $this->select ( "goods_id in({$goods_ids})", "goods_id,stock,countamount" )->items;
			if ($rs) {
				foreach ( $rs as $k => $v ) {
					$avgrice [$v ['goods_id']] = sprintf ( "%01.2f", $rs ['countamount'] / $rs ['stock'] );
				}
			}
		} else {
			$rs = $this->selectOne ( "goods_id={$goods_ids}", "stock,countamount" );
			if ($rs)
				return sprintf ( "%01.2f", $rs ['countamount'] / $rs ['stock'] );
		}
		return $avgrice;
	}
}