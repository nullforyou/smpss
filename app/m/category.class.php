<?php
/**
 * 分类表数据模型
 * @author loid  email:loid@163.com
 */
class m_category extends base_m {
	public function primarykey() {
		return 'cat_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'category';
	}
	public function relations() {
		return array ();
	}
	public function getOrderCate($space = '|___') {
		//$this->setCount ( true );
		//$this->setPage ( $page );
		//$this->setLimit ( base_Constant::PAGE_SIZE );
		$values = $this->select ();
		//$listarr[100]['totalSize'] = $values->totalSize; 
		$values = $values->items;
		if ($values) {
			$tree = new base_tree ();
			$miniupid = $delbase = '';
			$listarr = $categoryarr = array ();
			foreach ( $values as $value ) {
				if ($miniupid == '')
					$miniupid = $value ['pid'];
				$tree->setNode ( $value ['cat_id'], $value ['pid'], $value ); //循环生成
			}
			$categoryarr = $tree->getChilds ( $miniupid );
			foreach ( $categoryarr as $key => $catid ) {
				$cat = $tree->getValue ( $catid );
				$cat ['pre'] = $tree->getLayer ( $catid, $space );
				$listarr [$key] = $cat;
			}
			return $listarr;
		}
		return array ();
	}
	public function create($data) {
		$data ['pid'] = $data ['pid'] ? $data ['pid'] : 0;
		if (! $data ['cat_name']) {
			$this->setError ( 0, "缺少必要参数" );
			return false;
		}
		$this->set ( "pid", $data ['pid'] );
		$this->set ( "is_show", $data ['is_show'] );
		$this->set ( "cat_name", $data ['cat_name'] );
		$rs = $this->save ( $data ['cat_id'] );
		if ($rs)
			return $rs;
		$this->setError ( 0, "保存数据失败" . $this->getError () );
		return false;
	}
	
	function isErrorPid($pid, $cat_id){
		$rs = $this->selectOne("cat_id='{$pid}'", "pid");
		if($rs['pid'] == 0){
			return true;
		}
		if($rs['pid'] == $cat_id){
			return false;
		}else{
			return $this->isErrorPid($rs['pid'], $cat_id);
		}
	}
	
	function isHasPid($pid){
		if($pid > 0){
			$rs = $this->selectOne("cat_id='{$pid}'", "cat_id");
			if(empty($rs['cat_id'])){
				return false;
			}
		}
		return true;
	}
}