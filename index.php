<?php
/**
 * 入口文件
 * SmPSS(Supermarket Purchase Sale Stock)
 */
error_reporting(0);
require_once("global.php");
SlightPHP::setDebug(true);
SlightPHP::setAppDir(ROOT_APP);
SlightPHP::setSplitFlag("-_.");
SDb::setConfigFile(ROOT_CONFIG. "/db.ini.php");
if(($r=SlightPHP::run())===false){
	header('HTTP/1.1 404 Not Found');
	header('Status: 404 Not Found');
	include './app/v/'.base_Constant::TEMP_DIR.'/common/404.html';
}else{
	echo $r;exit;
}