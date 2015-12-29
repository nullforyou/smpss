<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */
function smarty_modifier_inarr($string, $arr = array()) {
	if(in_array($string,$arr)){
		return true;
	}
	return false;
}
?>
