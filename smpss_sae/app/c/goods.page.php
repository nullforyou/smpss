<?php
/**
 * 商品管理
 * @author loid  email:loid@163.com
 *
 */
class c_goods extends base_c {
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params['inpath'] = $inPath;
		$this->params ['head_title'] = "商品管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$page = $url['page']?(int)$url['page']:1;
		$categoryObj = new m_category ();
		$this->params['catelist'] = $categoryObj->getOrderCate('&nbsp;&nbsp;&nbsp;&nbsp;');
		$condi = '';
		$goodsObj = new m_goods();
		if($_POST){
			$key = base_Utils::getStr($_POST['key'],'html');
			$cat_id = (int)$_POST['cat_id'];
			$this->params['key'] = $key;
			$this->params['cat_id'] = $cat_id;
			$tableName = $goodsObj->tableName();
			if($key){
				$condi .= "{$tableName}.goods_name like '%{$key}%' or {$tableName}.goods_sn like '%{$key}%'";
			}
			if($cat_id){
				 $condi = $condi ? $condi." and {$tableName}.cat_id = {$cat_id}" : "{$tableName}.cat_id = {$cat_id}";
			}
		}
		$rs = $goodsObj->getGoodsList($condi,$page);
		$this->params ['goods'] = $rs->items;
		$this->params ['pagebar'] = $this->PageBar ( $rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath );
		return $this->render ( 'goods/index.html', $this->params );
	}
	
	function pageaddgoods($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$goods_id = ( int ) $url ['gid'] > 0 ? ( int ) $url ['gid'] : ( int ) $_POST ['goods_id'];
		$goodsObj = new m_goods($goods_id);
		if($_POST){
			$post = base_Utils::shtmlspecialchars ( $_POST );
			if ($goodsObj->create ( $post )) {
				base_Utils::ssetcookie(array('cat_id'=>$post['cat_id']));
				$this->ShowMsg ( "操作成功！", $this->createUrl ( "/goods/addgoods" ), 2, 1 );
			}
			$this->ShowMsg ( "操作失败" . $goodsObj->getError () );
		}
		$categoryObj = new m_category ();
		$this->params['cat_id'] = (int)$_COOKIE['cat_id'];
		$this->params['catelist'] = $categoryObj->getOrderCate('&nbsp;&nbsp;&nbsp;&nbsp;');
		$this->params['goods'] = $goodsObj->selectOne("goods_id={$goods_id}");
		return $this->render ( 'goods/addgoods.html', $this->params );
	}
}