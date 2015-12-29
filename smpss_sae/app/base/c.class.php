<?php
/**
 * 控制器基类
 * @author loid  email:loid@163.com
 */
class base_c extends SGui {
	public $params = array ();
	
	public function __construct() {
		//define(DEBUG, 1);
		$this->params ['_time'] = time ();
		$this->params ['version'] = "SmPSS" . base_Constant::VERSION;
		$this->params ['root_dir'] = base_Constant::ROOT_DIR ? '/' . trim ( base_Constant::ROOT_DIR, '/' ) : '' ;
		self::getRights ();
	}
	
	function isLogin() {
		if ($_COOKIE ['key']) {
			if ($_COOKIE ['key'] != md5 ( $_COOKIE ['admin_id'] . $_COOKIE ['admin_name'] . $_COOKIE ['lastlogintime'] . base_Constant::COOKIE_KEY )) {
				$cookie ['key'] = '';
				$cookie ['admin_id'] = '';
				$cookie ['gid'] = '';
				$cookie ['admin_name'] = '';
				$cookie ['lastlogintime'] = '';
				base_Utils::ssetcookie ( $cookie, - 1 );
				return false;
			}
		} else {
			return false;
		}
		return true;
	}
	
	function checkRights($inPath = array()) {
		$gid = ( int ) $_COOKIE ['gid'];
		$cacheName = "action_code_group_" . $gid;
		/*$cache = memcache_init();
		//$cache->init ( array ("dir" => SlightPHP::$appDir . "/cache", "depth" => 3 ) );
		$rs = $cache->get ( $cacheName );
		if ($cache and $rs) {
		} else {
			$rsObj = base_mAPI::get ( 'm_group', $gid );
			$rs = $rsObj->get ();
			$cache->set ( $cacheName, $rs );
		}*/
		$rsObj = base_mAPI::get ( 'm_group', $gid );
		$rs = $rsObj->get ();
		if ($rs) {
			$action = unserialize ( $rs ['action_code'] );
			$c = $inPath [1] . '_' . $inPath [2];
			if (in_array ( $c, $action ['action'] ) or $action ['all'] == 1) {
				return true;
			}
			return false;
		}
		return false;
	}
	
	private function getRights() {
		$gid = ( int ) $_COOKIE ['gid'];
		$cacheName = "action_code_group_" . $gid;
		/*$cache = memcache_init();
		//$cache->init ( array ("dir" => SlightPHP::$appDir . "/cache", "depth" => 3 ) );
		$rs = $cache->get ( $cacheName );
		if ($cache and $rs) {
		} else {
			$rsObj = base_mAPI::get ( 'm_group', $gid );
			$rs = $rsObj->get ();
			$cache->set ( $cacheName, $rs );
		}*/
		$rsObj = base_mAPI::get ( 'm_group', $gid );
		$rs = $rsObj->get ();
		$action = unserialize ( $rs ['action_code'] );
		$mc = memcache_init();
		$head_title = $mc->get($_SERVER['HTTP_APPVERSION']."head_title");
		if(!$head_title){
			$modelObj = new base_m ();
			$rs = $modelObj->_db->selectOne(base_Constant::TABLE_PREFIX."system","","sysname");
			$head_title = $rs['rsystem_name'];
			$mc->set($_SERVER['HTTP_APPVERSION']."head_title",$head_title);
		}
		$this->params ['head_title'] = $head_title;
		$this->params ['menu'] = $action ['menu'];
		$this->params ['_userid'] = $_COOKIE ['admin_id'];
		$this->params ['_adminname'] = $_COOKIE ['admin_name'];
	}
	/**
	 * 获取uri参数
	 */
	public function getUrlParams($inPath) {
		$newary = array ();
		for($i = 3; $i < count ( $inPath ); $i ++) {
			//如果不遵守变量规则，直接跳过
			if (preg_match ( "/[^A-Za-z0-9_]/", $inPath [$i] ))
				continue;
			if ($i % 2) {
				$newary [$inPath [$i]] = $inPath [$i + 1];
			}
		}
		unset ( $newary [base_Constant::URL_SUFFIX] );
		return $newary;
	}
	
	/**
	 * 构建完整url
	 */
	public function createUrl($route, $params = array()) {
		$root_dir = base_Constant::ROOT_DIR ? '/' . trim ( base_Constant::ROOT_DIR, '/' ) : '' ;
		$uf = base_Constant::URL_FORMAT;
		$url = rtrim ( $route, base_Constant::URL_FORMAT );
		if (! empty ( $params )) {
			$sux = '.' . base_Constant::URL_SUFFIX;
			foreach ( $params as $key => $value ) {
				if (trim ( $value ) != '') {
					$tmp .= $key . $uf . $value . $uf;
				}
			}
			$tmp = rtrim ( $tmp, $uf );
			$url = rtrim ( $url . base_Constant::URL_FORMAT . $tmp, base_Constant::URL_FORMAT );
		}
		if (substr ( $url, - 1 ) != '/') { //以'/'结束的url不加$sux;
			$url = $route === '' ? $url : $url . $sux;
		}
		if (! base_Constant::REWRITE) {
			return $root_dir."/index.php/c" . $url;
		}
		return $root_dir.$url;
	}
	
	/**
	 * 系统提示
	 */
	public function ShowMsg($msg = 'message', $backurl = '', $second = 3, $state = 0) {
		$params ['msg'] = $msg;
		$params ['url'] = $backurl;
		$params ['second'] = $second;
		$params ['state'] = $state;
		$params ['root_dir'] = $this->params ['root_dir'];
		echo $this->render ( 'common/showmsg.html', $params );
		exit ();
	}
	/**
	 * 分页
	 */
	function PageBar($count, $limit, $i_page, $inPath, $style = 'style1', $getPath = "") {
		$pageSize = base_Constant::PAGE_SIZE;
		$pagenum = ceil ( $count / $limit );
		$page = min ( $pagenum, $i_page );
		$prepg = $page - 1;
		$nextpg = $page == $pagenum ? 0 : $page + 1;
		$offset = ($page - 1) * $limit;
		$startdata = $count ? ($offset + 1) : 0;
		$enddata = min ( $offset + $limit, $count );
		$pars = $this->getUrlParams ( $inPath );
		if (! empty ( $pars ))
			$pars = array_map ( "htmlspecialchars", $pars );
		$domain = "";
		if (array_key_exists ( 'page', $pars )) {
			unset ( $pars ['page'] );
			$str_page = "page";
		} elseif (array_key_exists ( "p", $pars )) {
			unset ( $pars ["p"] );
			$str_page = "p";
		} else {
			$str_page = "page";
		}
		for($i = 0; $i < $pagenum; $i ++) {
			$params ['pages'] [$i] ['page'] = $i + 1;
			$params ['pages'] [$i] ['url'] = self::createUrl ( "/{$inPath[1]}/{$inPath[2]}", array_merge ( $pars, array ($str_page => $i + 1 ) ) ) . $getPath;
		}
		$params ['first'] = self::createUrl ( "/{$inPath[1]}/{$inPath[2]}", $pars ) . $getPath;
		//仅提供给输页码跳转使用
		$params ['gotobase'] = self::createUrl ( "/{$inPath[1]}/{$inPath[2]}", array_merge ( $pars, array ($str_page => 1 ) ) ) . $getPath;
		if (! empty ( $nextpg )) {
			$params ['nextpg'] = self::createUrl ( "/{$inPath[1]}/{$inPath[2]}", array_merge ( $pars, array ($str_page => $nextpg ) ) ) . $getPath;
		} else {
			$params ['nextpg'] = null;
		}
		if (! empty ( $prepg )) {
			$params ['prepg'] = self::createUrl ( "/{$inPath[1]}/{$inPath[2]}", array_merge ( $pars, array ($str_page => $prepg ) ) ) . $getPath;
		} else {
			$params ['prepg'] = null;
		}
		$params ['last'] = self::createUrl ( "/{$inPath[1]}/{$inPath[2]}", array_merge ( $pars, array ($str_page => $pagenum ) ) ) . $getPath;
		$params ['startdata'] = $startdata;
		$params ['enddata'] = $enddata;
		$params ['currpage'] = $i_page;
		$params ["str_page"] = $str_page;
		if ($pagenum > $pageSize) {
			if ($i_page >= $pageSize) {
				$params ['start'] = $i_page - $pageSize / 2;
				$params ['max'] = $pageSize;
				if ($pagenum - $params ['start'] < $pageSize) {
					$params ['start'] = $pagenum - $pageSize;
				}
			} else {
				$params ['start'] = 0;
				$params ['max'] = $pageSize;
			}
		} else {
			$params ['start'] = 0;
			$params ['max'] = $pageSize;
		}
		$params ["total"] = $pagenum; //总页数
		$pretenpg = $params ['start'] + 1 - 10;
		$nexttenpg = $params ['start'] + $params ['max'] + 10;
		if ($pretenpg >= 0)
			$params ["pretenpg"] = self::createUrl ( "/{$inPath[1]}/{$inPath[2]}", array_merge ( $pars, array ($str_page => $pretenpg ) ) ) . $getPath;
		if ($nexttenpg <= $pagenum)
			$params ["nexttenpg"] = self::createUrl ( "/{$inPath[1]}/{$inPath[2]}", array_merge ( $pars, array ($str_page => $nexttenpg ) ) ) . $getPath;
		return $this->render ( "common/page/$style.html", $params );
	}
}
?>