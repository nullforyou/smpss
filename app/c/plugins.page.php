<?php
/**
 * 数据转换插件
 * @author loid  email:loid@163.com
 *
 */
class c_plugins extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		$this->params ['inpath'] = $inPath;
	}
	
	function pageindex($inPath){
		return $this->render ( 'plugins/index.html', $this->params );
	}
	
	function pageecshop($inPath){
		//define(DEBUG,1);
		$url = $this->getUrlParams ( $inPath );
		$lastid = (int)$url['lastid']?(int)$url['lastid']:0;
		if($_POST or $lastid>0){
			$pre = base_Utils::getStr($_REQUEST['pre'])?base_Utils::getStr($_REQUEST['pre']):$url['pre'];
			$num = (int)$_POST['num']?(int)$_POST['num']:$url['num'];
			$ecshop = new m_plugins("ecshop");
			$ecshop->_db->setLimit($num);
			$categoryObj = new m_category();
			$goodsObj = new m_goods();
			$type = $_POST['type']?$_POST['type']:$url['type'];
			if($type==1){
				$table = $pre ."category";
				if($lastid==0){
					$categoryObj->clearTable(array("category"));
				}
				$rs = $ecshop->_db->select($table,"cat_id>{$lastid}","cat_id,cat_name,parent_id,sort_order,is_show","order by cat_id asc")->items;
				if(is_array($rs[0])){
					foreach($rs as $k){
						$itmes['cat_id'] = $k['cat_id'];
						$itmes['cat_name'] = $k['cat_name'];
						$itmes['pid'] = $k['parent_id'];
						$itmes['sort'] = $k['sort_order'];
						$itmes['is_show'] = $k['is_show'];
						if(!$categoryObj->insert($itmes)){
							$this->showMsg('写入数据错误'.$categoryObj->getError());
						}
						$lastid = $k['cat_id'];
					}
					$this->showMsg("转换{$num}条完成！",$this->createUrl ( "/plugins/ecshop", array("lastid"=>$lastid,"num"=>$num,"type"=>1) )."?pre={$pre}",2,1);
				}else{
					$this->showMsg("转换完成",$this->createUrl ( "/plugins/ecshop" ),5,1);
				}
			}else{
				$table = $pre ."goods";
				if($lastid==0){
				$goodsObj->clearTable(array("goods","member","purchase","sales","log"));
				}
				$rs = $ecshop->_db->select($table,"goods_id>{$lastid}","","order by goods_id asc")->items;
				if(is_array($rs[0])){
					$i = 0;
					$j = 0;
					foreach($rs as $k){
						$itmes['cat_id'] = $k['cat_id'];
						$itmes['goods_sn'] = $k['goods_sn'];
						$itmes['goods_name'] = $k['goods_name'];
						$itmes['market_price'] = $k['market_price'];
						$itmes['out_price'] = $k['shop_price'];
						$itmes['promote_price'] = $k['promote_price'];
						$itmes['ispromote'] = $k['is_promote'];
						$itmes['weight'] = $k['goods_weight'];
						$itmes['unit'] = '';
						$itmes['in_price'] = 0;
						$itmes['ismemberprice'] = 1;
						$itmes['promote_start_date'] = date("Y-m-d",$k['promote_start_date']);
						$itmes['promote_end_date'] = date("Y-m-d",$k['promote_end_date']);
						$itmes['warn_stock'] = $k['warn_number'];
						$itmes['goods_desc'] = $k['goods_brief'];
						if(!$goodsObj->create($itmes)){
							$j++;//$this->showMsg('写入数据错误'.$goodsObj->getError());
						}
						$i++;
						$lastid = $k['goods_id'];
					}
					$this->showMsg("共转换{$i}条数据，失败或者重复商品{$j}条！",$this->createUrl ( "/plugins/ecshop", array("lastid"=>$lastid,"num"=>$num,"type"=>2) )."?pre={$pre}",2,1);
				}else{
					$this->showMsg("转换商品完成",$this->createUrl ( "/plugins/ecshop" ),5,1);
				}
			}
		}
		$this->params ['head_title'] = "Ecshop转换插件-" . $this->params ['head_title'];
		return $this->render ( 'plugins/ecshop/index.html', $this->params );
	}
}