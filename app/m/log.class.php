<?php
/**
 * 商品日志表数据模型
 * @author loid  email:loid@163.com
 */
class m_log extends base_m {
	public function primarykey() {
		return 'id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'log';
	}
	public function relations() {
		return array ();
	}
	/**
	 * 日志
	 * @param int $goods_id
	 * @param string $content
	 * @param int $type 0添加商品 1入库 2出库
	 */
	function create($goods_id, $content, $type = 0) {
		if (! goods_id or ! $content) {
			$this->setError ( 0, "缺少必要参数" );
			return false;
		}
		$this->set ( "goods_id", $goods_id );
		$this->set ( "type", $type );
		$this->set ( "content", base_Utils::getStr ( $content ) );
		$this->set ( "user_id", $_COOKIE ['admin_id'] );
		$this->set ( "username", $_COOKIE ['admin_name'] );
		$this->set ( "dateymd", date ( "Y-m-d", $this->_time ) );
		$this->set ( "dateline", $this->_time );
		$res = $this->save ();
		if ($res) {
			return $res;
		}
		$this->setError ( 0, "保存数据失败:" . $this->getError () );
		return false;
	}
}