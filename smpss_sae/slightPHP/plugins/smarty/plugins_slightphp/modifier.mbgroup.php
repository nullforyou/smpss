<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */
function smarty_modifier_mbgroup($id,$type) {
	if(in_array($type,array('mgroup_name','credit','discount')) and $id>0){
		$mbgroupObj = new m_mbgroup();
		$rs = $mbgroupObj->getOne($id);
		echo $rs[$type];
	}
}
?>
