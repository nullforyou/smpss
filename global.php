<?php
define("ROOT",				dirname(__FILE__));
define("ROOT_APP",			ROOT."/app");
define("ROOT_CONFIG",		ROOT."/config");
define("ROOT_SLIGHTPHP",	ROOT."/slightPHP/");
define("ROOT_PLIGUNS",		ROOT_SLIGHTPHP."/plugins");
require_once(ROOT_SLIGHTPHP."/SlightPHP.php");
function __autoload($class){
	if($class{0}=="S"){
		$file = ROOT_PLIGUNS."/$class.class.php";
	}else{
		$file = SlightPHP::$appDir."/".str_replace("_","/",$class).".class.php";
	}
	if(file_exists($file)) return require_once($file);
}
spl_autoload_register('__autoload');