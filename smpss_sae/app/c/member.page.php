<?php
/**
 * 会员管理
 * @author loid  email:loid@163.com
 *
 */
class c_member extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "会员管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		$memberObj = new m_member ();
		$condition = '';
		$key = base_Utils::shtmlspecialchars ( $_POST ['key'] );
		if ($key) {
			$condition = "membercardid like '%{$key}%' or realname like '%{$key}%' or mobile like '%{$key}%' or phone like '%{$key}%'";
			$this->params ['key'] = $key;
		}
		$memberObj->setCount ( true );
		$memberObj->setPage ( $page );
		$memberObj->setLimit ( base_Constant::PAGE_SIZE );
		$member = $memberObj->select ( $condition, '', '', "order by credit desc" );
		$this->params ['member'] = $member->items;
		$this->params ['pagebar'] = $this->PageBar ( $member->totalSize, base_Constant::PAGE_SIZE, $page, $inPath );
		return $this->render ( 'member/index.html', $this->params );
	}
	
	function pagegroup($inPath){
		$url = $this->getUrlParams ( $inPath );
		$mbgroupObj = new m_mbgroup ($url['mgid']);
		if($_POST){
			$data = base_Utils::shtmlspecialchars ( $_POST );
			$rs = $mbgroupObj -> creat($data);
			if($rs){
				$this->showMsg("操作成功",$this->createUrl ( "/member/group" ),2,1);
			}else{
				$this->showMsg("操作失败！".$mbgroupObj->getError());
			}
		}
		$this -> params ['groupone'] = $mbgroupObj->get();
		$this -> params ['group'] = $mbgroupObj->select()->items;
		return $this->render ( 'member/group.html', $this->params );
	}
	
	function pageaddmember($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$mid = ( int ) $url ['mid'] > 0 ? ( int ) $url ['mid'] : ( int ) $_POST ['mid'];
		$memberObj = new m_member ( $mid );
		if ($_POST) {
			$post = base_Utils::shtmlspecialchars ( $_POST );
			if ($mid) {
				if ($memberObj->create ( $post )) {
					$this->ShowMsg ( "修改成功！", $this->createUrl ( "/member/index" ), '', 1 );
				}
				$this->ShowMsg ( "修改失败" . $memberObj->getError () );
			} else {
				if ($memberObj->create ( $post )) {
					$this->ShowMsg ( "添加成功！", $this->createUrl ( "/member/index" ), '', 1 );
				}
				$this->ShowMsg ( "添加失败，原因：" . $memberObj->getError () );
			}
		} else {
			if ($mid) {
				$this->params ['member'] = $memberObj->get ();
			}
			$mbgroupObj = new m_mbgroup ();
			$this -> params ['group'] = $mbgroupObj->select()->items;
			return $this->render ( 'member/addmember.html', $this->params );
		}
	}
}
?>