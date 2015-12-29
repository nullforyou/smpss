<?php
/**
 * 帐号管理
 * @author loid  email:loid@163.com
 *
 */
class c_account extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "帐号管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$aid = ( int ) $url ['aid'];
		$this->params ['aid'] = $aid;
		$adminObj = new m_admin ( $aid );
		if ($aid) {
			if ($_POST ['group'] > 0) {
				$post = base_Utils::shtmlspecialchars ( $_POST );
				if ($post ['pwd'])
					$adminObj->set ( "admin_pwd", md5 ( $post ['pwd'] ) );
				if ($post ['group'])
					$adminObj->set ( "gid", $post ['group'] );
				if ($adminObj->save ( $aid )) {
					$this->ShowMsg ( '修改成功', $this->createUrl ( '/account/index' ), '', '1' );
				}
				$this->ShowMsg ( '修改出错！原因：' . $adminObj->getError () );
			} else {
				$groupObj = new m_group ();
				$this->params ['group'] = $groupObj->select ()->items;
				$this->params ['account'] = $adminObj->get ();
				return $this->render ( 'account/indexshow.html', $this->params );
			}
		}
		$prefix = base_Constant::TABLE_PREFIX;
		$account = $adminObj->select ( '', '', '', '', array ("{$prefix}group" => "{$prefix}group.gid={$prefix}admin.gid" ) )->items;
		$this->params ['account'] = $account;
		return $this->render ( 'account/index.html', $this->params );
	}
	
	function pageaddaccount($inPath) {
		if ($_POST) {
			$adminObj = new m_admin ();
			$post = base_Utils::shtmlspecialchars ( $_POST );
			$item = array ();
			$item ["admin_name"] = $post ['admin_name'];
			$item ["admin_pwd"] = md5 ( $post ['pwd'] );
			$item ["gid"] = ( int ) $post ['group'];
			foreach ( $item as $k => $v ) {
				if (! $v)
					$this->ShowMsg ( "字段：{$k}不能够为空" );
			}
			if ($adminObj->insert ( $item )) {
				$this->ShowMsg ( '添加成功', $this->createUrl ( '/account/index' ), '', '1' );
			}
			$this->ShowMsg ( '添加出错！原因：' . $adminObj->getError () );
		}
		$groupObj = new m_group ();
		$this->params ['group'] = $groupObj->select ()->items;
		return $this->render ( 'account/addaccount.html', $this->params );
	}
	
	function pagemodifypwd($inPath) {
		$admin_id = ( int ) $_COOKIE ['admin_id'];
		if ($_POST) {
			$adminObj = new m_admin ();
			$post = base_Utils::shtmlspecialchars ( $_POST );
			$resPwd = $adminObj->get ( "admin_id = {$admin_id}", 'admin_pwd' );
			if ($resPwd ['admin_pwd'] == md5 ( $post ['old_pwd'] ) and $post ['new_pwd'] == $post ['new_pwd2'] and $post ['new_pwd']) {
				$pwd = md5 ( $post ['new_pwd'] );
				$rs = $adminObj->update ( "admin_id = {$admin_id}", "admin_pwd = '{$pwd}'" );
				if ($rs) {
					$this->ShowMsg ( '修改成功', $this->createUrl ( '/account/modifypwd' ), '', 1 );
				} else {
					$this->ShowMsg ( '修改失败，请重试！错误原因：' . $adminObj->getError () );
				}
			} else {
				$this->ShowMsg ( '原密码错误或者两次新密码不一致！' );
			}
		}
		return $this->render ( 'account/modifypwd.html', $this->params );
	}
}
?>