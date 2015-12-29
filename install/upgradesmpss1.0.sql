--
-- 表的结构 `smpss_tempsales`
--

CREATE TABLE IF NOT EXISTS `smpss_tempsales` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(14) NOT NULL,
  `goods_id` int(10) NOT NULL,
  `goods_name` varchar(100) NOT NULL,
  `goods_sn` varchar(16) NOT NULL,
  `stock` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `out_price` float(10,2) unsigned NOT NULL,
  `p_discount` float(10,2) unsigned NOT NULL,
  `ismemberprice` tinyint(1) NOT NULL,
  `ispromote` tinyint(1) NOT NULL,
  `promote_price` float(8,2) unsigned NOT NULL,
  `num` float(10,2) unsigned NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='销售临时表' AUTO_INCREMENT=1 ;