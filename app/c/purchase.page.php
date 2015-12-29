<?php
/**
 * 进货管理
 * @author loid  email:loid@163.com
 *
 */
class c_purchase extends base_c {
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "进货管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		$categoryObj = new m_category ();
		$purchaseObj = new m_purchase ();
		$condition = "isdel = 0";
		if ($_POST) {
			$key = base_Utils::getStr ( $_POST ['key'] );
			$cat_id = ( int ) $_POST ['cat_id'];
			$condition .= " and goods_name like '%{$key}%' or goods_sn like '%{$key}%'";
			if ($cat_id) {
				$condition .= " and cat_id = {$cat_id}";
			}
			$this->params ['key'] = $key;
		}
		$purchaseObj->setCount ( true );
		$purchaseObj->setPage ( $page );
		$purchaseObj->setLimit ( base_Constant::PAGE_SIZE );
		$purchase = $purchaseObj->select ( $condition, "", "", "order by id desc" );
		$this->params ['purchase'] = $purchase->items;
		$this->params ['pagebar'] = $this->PageBar ( $purchase->totalSize, base_Constant::PAGE_SIZE, $page, $inPath );
		$this->params ['catelist'] = $categoryObj->getOrderCate ( '&nbsp;&nbsp;&nbsp;&nbsp;' );
		return $this->render ( 'purchase/index.html', $this->params );
	}
	
	function pagepurchase($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$goods_id = $url ['gid'] ? ( int ) $url ['gid'] : ( int ) $_POST ['goods_id'];
		$url ['ac'] = $url ['ac'] ? $url ['ac'] : "add";
		$purchaseObj = new m_purchase ( ( int ) $url ['id'] );
		switch ($url ['ac']) {
			case "add" :
				$goodsObj = base_mAPI::get ( "m_goods", $goods_id );
				if ($_POST) {
					$goods_sn = base_Utils::getStr ( $_POST ['goods_sn'] );
					$rs = $goodsObj->get ( "goods_sn = '{$goods_sn}'" );
					if (! $rs)
						$this->ShowMsg ( "没有该商品信息" );
					$data ['goods_id'] = $rs ['goods_id'];
					$data ['goods_sn'] = $rs ['goods_sn'];
					$data ['in_num'] = ( float ) $_POST ['in_num'];
					$data ['in_price'] = ( float ) $_POST ['in_price'];
					if (!$data ['in_num'] or !$data ['in_price']){
						$this->showMsg("数量和单价不能够为空！");
					}
					$data ['content'] = base_Utils::getStr ( $_POST ['content'] );
					if ($purchaseObj->create ( $data )) {
						$this->ShowMsg ( "入库成功！", $this->createUrl ( "/purchase/index" ), 2, 1 );
					}
					$this->ShowMsg ( "入库出错！原因：" . $purchaseObj->getError () );
				}
				if ($url ['id']) {
					$this->params ['goods'] = $purchaseObj->get ();
				} else {
					$this->params ['goods'] = $goodsObj->get ();
				}
				break;
			case "del" :
				if ($url ['gid']) {
					if ($purchaseObj->deleteOne ( $url ['gid'] )) {
						$this->ShowMsg ( "删除成功！", $this->createUrl ( "/purchase/index" ), 2, 1 );
					}
					$this->ShowMsg ( "删除出错！原因：" . $purchaseObj->getError () );
				}
				break;
		}
		$this->params ['ac'] = $url ['ac'];
		return $this->render ( 'purchase/purchase.html', $this->params );
	}
}