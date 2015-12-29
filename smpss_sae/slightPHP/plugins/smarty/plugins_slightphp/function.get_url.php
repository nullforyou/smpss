<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 * 获取URL地址,需要处理复杂的查询方式,比如多参数，搜索等，请使用query,_GET等参数
 * @param    array | path(数组) pathinfo默认参数  接受域名别名,get(数组) 接受_GET方式传参
 * @return   string
 */
function smarty_function_get_url($params) {
	$data = isset ( $params ['path'] ) ? $params ['path'] : array ();
	if (isset ( $params ['data'] )) {
		$a_data = explode ( '&', $params ['data'] );
		$n = count ( $a_data );
		for($i = 0; $i < $n; $i ++) {
			if ($a_data [$i] === '')
				continue;
			$s_segment = explode ( '=', $a_data [$i] );
			$data [$s_segment [0]] = $s_segment [1];
		}
	}
	
	//处理_GET方式传参
	$getdata = array ();
	if (! empty ( $params ['get'] )) {
		$getdata = $params ['get'];
	}
	
	if (isset ( $params ['getdata'] )) {
		$a_data = explode ( '&', $params ['getdata'] );
		$n = count ( $a_data );
		for($i = 0; $i < $n; $i ++) {
			if ($a_data [$i] === '')
				continue;
			$s_segment = explode ( '=', $a_data [$i] );
			$getdata [$s_segment [0]] = $s_segment [1];
		}
	}
	
	if (! empty ( $getdata )) {
		$query = '?' . http_build_query ( $getdata );
	}
	
	//处理分页,如果需要再参数中支持分页，请设置ispage=1,否则默认不支持分页传参
	if (empty ( $params ['ispage'] )) {
		unset ( $data ['page'] );
	}
	
	//是否优化URL中的为0或空的参数
	if ($params ['isoptimize'] == 1) {
		foreach ( $data as $key => $val ) {
			if (empty ( $val )) {
				unset ( $data [$key] );
			}
		}
	}
	return base_c::createUrl($params['rule'],$data).$query;
}
?>
