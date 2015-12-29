<?php
/**
 * 模型对外接口
 */
class base_mAPI {
	private static $_model = array (); //存储已创建的模型
	/**
	 * 获取数据模型
	 * @param string $name 获取模型的名称，例如:mk_task
	 * @param int $id 需要实例化的数据记录ID
	 * return object
	 */
	static public function get($name, $id = null) {
		$class_name = $name;
		if (empty ( $id )) {
			return new $class_name ();
		} else {
			$cache_name = $name . '_' . $id;
			if (! isset ( self::$_model [$cache_name] )) {
				self::$_model [$cache_name] = new $class_name ( $id );
			}
			return self::$_model [$cache_name];
		}
	}
}