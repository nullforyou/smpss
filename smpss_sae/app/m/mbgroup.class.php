<?php
/**
 * 会员组主表数据模型
 * @author loid  email:loid@163.com
 */
class m_mbgroup extends base_m {
	public function primarykey() {
		return 'mgid';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'mbgroup';
	}
	public function relations() {
		return array ();
	}
	
	public function creat($data){
		$mgid = $data['mgid'];
		$item['mgroup_name'] = $data['mgroup_name'];
		$item['credit'] = $data['credit']?$data['credit']:0;
		$item['discount'] = $data['discount'];
		if (! $item ['mgroup_name'] or ! $item ['discount']) {
			$this->setError ( 0, "缺少必要参数" );
			return false;
		}
		$this->set('mgroup_name',$item['mgroup_name']);
		$this->set('credit',$item['credit']);
		$this->set('discount',$item['discount']);
		if($this->save ( $mgid )){
			//$cacheName = "member_group_" . $mgid;
			//$cache = SCache::getCacheEngine ( 'file' );
			//$cache->init ( array ("dir" => SlightPHP::$appDir . "/cache", "depth" => 3 ) );
			//$cache->del($cacheName);
			return true;
		}
		$this->setError ( 0, "添加编辑出错！" );
		return false;
	}
	
	public function getOne($mgid) {
		//$cacheName = "member_group_" . $mgid;
		//$cache = SCache::getCacheEngine ( 'file' );
		//$cache->init ( array ("dir" => SlightPHP::$appDir . "/cache", "depth" => 3 ) );
		//$rs = unserialize ( $cache->get ( $cacheName ) );
		//if (! $rs) {
			$this->setPkid ( $mgid );
			$rs = $this->get ();
			//$cache->set ( $cacheName, serialize ( $rs ) );
		//}
		return $rs;
	}
}