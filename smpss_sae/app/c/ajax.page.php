<?php
/**
 * 通用异步请求控制器
 * @author loid  email:loid@163.com
 */
class c_ajax extends base_c{
	
	public function pagegetregion() {
		$aJson = array ();
		$regionObj = new m_region ();
		$iPid = ( int ) $_REQUEST ['parent_id'];
		$exce = ( int ) $_REQUEST ['exce'];
		$aRegions = $regionObj->select ( array ("parent_id" => $iPid ), '*', '', 'order by region_id asc' )->items;
		if (empty ( $iPid )) {
			echo json_encode ( array () );
			exit ();
		}
		if ($aRegions) {
			foreach ( $aRegions as $aRegion ) {
				$r = array ('region_id' => $aRegion ['region_id'], 'region_name' => $aRegion ['region_name'] );
				$aJson [] = $r;
			}
			echo json_encode ( $aJson );
		} else {
			if ($exce) {
				$aRegions = $regionObj->select ( array ("parent_id" => $iPid ), '*', '', 'order by region_id asc' )->items;
				if (! empty ( $aRegions )) {
					$r = array ('region_id' => $aRegions ['region_id'], 'region_name' => $aRegions ['region_name'] );
					echo json_encode ( array ($r ) );
				} else {
					echo json_encode ( array () );
				}
			} else {
				echo json_encode ( array () );
			}
		}
	}
	/**
	 * 生成条形码图片
	 * @param array $inPath
	 */
	public function pagebarcode($inPath){
		$code = $_REQUEST['code'];
		$SBarcode = new SBarcode();
		$SBarcode->genBarCode($code,'png','2','');
	}
	/**
	 * 随机生成一组条形码
	 */
	public function pagegetbarcode($inPath){
		$code = base_Constant::BARCODE.base_Utils::random(4,1);
		$SBarcode = new SBarcode();
		$code = $SBarcode->_ean13CheckDigit($code);
		if(strlen($code)==13){
			$imgsrc = $this->createUrl("/ajax/barcode")."?code={$code}";
			return json_encode(array("code"=>$code,"imgsrc"=>$imgsrc));
		}else{
			return $this->pagegetbarcode($inPath);
		}
	}
}