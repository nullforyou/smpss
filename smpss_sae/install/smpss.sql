--
-- 表的结构 `smpss_admin`
--

CREATE TABLE IF NOT EXISTS `smpss_admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` char(16) NOT NULL,
  `admin_pwd` char(32) NOT NULL,
  `gid` int(1) NOT NULL COMMENT '管理用户组ID',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `lastlogintime` int(10) NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `smpss_admin`
--

INSERT INTO `smpss_admin` (`admin_name`, `admin_pwd`, `gid`, `createtime`, `lastlogintime`) VALUES
('admin', '21218cca77804d2ba1922c33e0151105', 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_category`
--

CREATE TABLE IF NOT EXISTS `smpss_category` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `pid` int(10) NOT NULL COMMENT '父ID',
  `is_show` tinyint(1) NOT NULL COMMENT '是否显示',
  `sort` tinyint(1) NOT NULL COMMENT '排序',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品分类表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `smpss_category`
--

INSERT INTO `smpss_category` (`cat_id`, `cat_name`, `pid`, `is_show`, `sort`) VALUES
(1, '日用品', 0, 1, 1),
(2, '舒肤佳', 1, 1, 2),
(3, '海飞丝', 1, 1, 3),
(4, '食品', 0, 1, 4),
(5, '优乐美', 4, 1, 2),
(6, '舒肤佳A', 2, 1, 1),
(7, '舒肤佳B', 2, 1, 1),
(8, '烟酒', 0, 0, 0),
(9, '龙凤呈祥', 8, 1, 0),
(10, '茅台', 8, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_goods`
--

CREATE TABLE IF NOT EXISTS `smpss_goods` (
  `goods_id` int(10) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(100) NOT NULL,
  `goods_sn` varchar(32) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `stock` float NOT NULL DEFAULT '0' COMMENT '库存',
  `warn_stock` tinyint(3) NOT NULL DEFAULT '1' COMMENT '库存警告',
  `weight` varchar(32) NOT NULL,
  `unit` varchar(32) NOT NULL,
  `out_price` decimal(8,2) NOT NULL COMMENT '销售价',
  `in_price` decimal(8,2) NOT NULL COMMENT '进价-未使用',
  `market_price` decimal(8,2) NOT NULL COMMENT '市场价',
  `promote_price` decimal(8,2) NOT NULL COMMENT '促销价',
  `ispromote` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用',
  `promote_start_date` date NOT NULL COMMENT '促销开始时间',
  `promote_end_date` date NOT NULL COMMENT '促销结束时间',
  `ismemberprice` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否享受会员价',
  `creatymd` date NOT NULL COMMENT '商品添加时间',
  `creatdateline` int(10) NOT NULL,
  `lastinymd` date NOT NULL COMMENT '最后进货时间',
  `lastindateline` int(10) NOT NULL,
  `goods_desc` varchar(200) NOT NULL COMMENT '商品简介',
  `countamount` float(10,2) unsigned NOT NULL COMMENT '商品总进价',
  `salesamount` float(10,2) unsigned NOT NULL COMMENT '销售总额',
  PRIMARY KEY (`goods_id`),
  UNIQUE KEY `goods_sn` (`goods_sn`),
  KEY `creatymd` (`creatymd`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `smpss_goods`
--

INSERT INTO `smpss_goods` (`goods_id`, `goods_name`, `goods_sn`, `cat_id`, `stock`, `warn_stock`, `weight`, `unit`, `out_price`, `in_price`, `market_price`, `promote_price`, `ispromote`, `promote_start_date`, `promote_end_date`, `ismemberprice`, `creatymd`, `creatdateline`, `lastinymd`, `lastindateline`, `goods_desc`, `countamount`, `salesamount`) VALUES
(1, '龙凤呈祥', '6911989262553', 9, 30, 0, '50g', '包', '10.00', '0.00', '12.00', '0.00', 0, '0000-00-00', '0000-00-00', 1, '2012-02-07', 1328593540, '2012-02-10', 1328861152, '', 244.92, 40.00),
(2, '龙凤呈祥2', '6911989262552', 9, 42, 0, '', '', '10.00', '1.33', '12.00', '0.00', 0, '0000-00-00', '0000-00-00', 1, '2012-02-03', 1328252652, '2012-02-09', 1328774193, '', 55.90, 10.00),
(3, '茅台酒', '6911989262551', 10, 6, 0, '500ml', 'ml', '200.00', '150.00', '240.00', '0.00', 0, '0000-00-00', '0000-00-00', 1, '2012-02-09', 1328774380, '2012-02-10', 1328861152, '', 900.00, 800.00),
(4, '海飞丝去屑洗发水', '6911989262550', 3, 5, 0, '', '', '10.00', '0.00', '12.00', '8.00', 1, '2012-02-08', '2012-03-08', 1, '2012-02-09', 1328779753, '2012-02-17', 1329462898, '', 35.00, 40.00),
(5, '我的优乐美', '6911989262549', 5, 0, 0, '', '', '2.00', '0.00', '2.40', '0.00', 0, '0000-00-00', '0000-00-00', 1, '2012-02-15', 1329276341, '0000-00-00', 0, '', 0.00, 0.00);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_group`
--

CREATE TABLE IF NOT EXISTS `smpss_group` (
  `gid` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(60) NOT NULL,
  `action_code` text NOT NULL COMMENT '权限范围',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0禁用 1可以',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理组权限表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `smpss_group`
--

INSERT INTO `smpss_group` (`gid`, `group_name`, `action_code`, `state`) VALUES
(1, '超级管理员', 'a:3:{s:3:"all";i:0;s:6:"action";a:20:{i:0;s:12:"system_index";i:1;s:14:"system_setting";i:2;s:13:"system_rights";i:3;s:16:"system_addrights";i:4;s:13:"account_index";i:5;s:18:"account_addaccount";i:6;s:17:"account_modifypwd";i:7;s:12:"member_index";i:8;s:16:"member_addmember";i:9;s:14:"category_index";i:10;s:17:"category_category";i:11;s:11:"goods_index";i:12;s:14:"goods_addgoods";i:13;s:14:"purchase_index";i:14;s:17:"purchase_purchase";i:15;s:11:"sales_index";i:16;s:11:"sales_sales";i:17;s:12:"sales_return";i:18;s:16:"statistics_index";i:19;s:16:"statistics_sales";}s:4:"menu";a:8:{s:6:"system";a:4:{s:5:"index";s:12:"系统信息";s:7:"setting";s:12:"系统配置";s:6:"rights";s:12:"权限管理";s:9:"addrights";s:15:"添加管理组";}s:7:"account";a:3:{s:5:"index";s:12:"帐号管理";s:10:"addaccount";s:12:"添加帐号";s:9:"modifypwd";s:12:"密码修改";}s:6:"member";a:2:{s:5:"index";s:12:"帐号管理";s:9:"addmember";s:12:"添加帐号";}s:8:"category";a:2:{s:5:"index";s:12:"分类管理";s:8:"category";s:12:"添加分类";}s:5:"goods";a:2:{s:5:"index";s:12:"商品管理";s:8:"addgoods";s:12:"添加商品";}s:8:"purchase";a:2:{s:5:"index";s:12:"库存管理";s:8:"purchase";s:12:"添加库存";}s:5:"sales";a:3:{s:5:"index";s:12:"销售列表";s:5:"sales";s:12:"商品出库";s:6:"return";s:12:"商品退货";}s:10:"statistics";a:2:{s:5:"index";s:12:"销售统计";s:5:"sales";s:12:"进货统计";}}}', 1),
(2, '普通管理员', 'a:3:{s:3:"all";i:0;s:6:"action";a:4:{i:0;s:12:"system_index";i:1;s:14:"system_setting";i:2;s:13:"system_rights";i:3;s:16:"system_addrights";}s:4:"menu";a:1:{s:6:"system";a:4:{s:5:"index";s:12:"系统信息";s:7:"setting";s:12:"系统配置";s:6:"rights";s:12:"权限管理";s:9:"addrights";s:15:"添加管理组";}}}', 1),
(3, '普通会员', 'a:3:{s:3:"all";i:0;s:6:"action";a:5:{i:0;s:12:"system_index";i:1;s:17:"account_modifypwd";i:2;s:11:"sales_index";i:3;s:11:"sales_sales";i:4;s:12:"sales_return";}s:4:"menu";a:3:{s:6:"system";a:1:{s:5:"index";s:12:"系统信息";}s:7:"account";a:1:{s:9:"modifypwd";s:12:"密码修改";}s:5:"sales";a:3:{s:5:"index";s:12:"销售列表";s:5:"sales";s:12:"商品出库";s:6:"return";s:12:"商品退货";}}}', 1);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_log`
--

CREATE TABLE IF NOT EXISTS `smpss_log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '日志类型：0添加商品1商品入库2商品出库',
  `goods_id` int(10) NOT NULL COMMENT '商品ID',
  `content` text NOT NULL,
  `user_id` int(10) NOT NULL,
  `username` varchar(32) NOT NULL,
  `dateymd` date NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `dateymd` (`dateymd`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品管理日志表' AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `smpss_log`
--

INSERT INTO `smpss_log` (`log_id`, `type`, `goods_id`, `content`, `user_id`, `username`, `dateymd`, `dateline`) VALUES
(1, 1, 1, '增加入库：名称：龙凤呈祥,数量：10', 1, '管理员', '2012-02-06', 1328520664),
(2, 1, 1, '增加入库：名称：龙凤呈祥,数量：10', 1, '管理员', '2012-02-06', 1328520698),
(3, 1, 1, '增加入库：名称：龙凤呈祥,数量：10', 1, '管理员', '2012-02-06', 1328520858),
(4, 1, 1, '增加入库：名称：龙凤呈祥,数量：2', 1, '管理员', '2012-02-06', 1328520909),
(5, 1, 2, '增加入库：名称：龙凤呈祥2,数量：10', 1, '管理员', '2012-02-06', 1328520953),
(6, 1, 2, '增加入库：名称：龙凤呈祥2,数量：10', 1, '管理员', '2012-02-06', 1328520960),
(7, 1, 2, '增加入库：名称：龙凤呈祥2,数量：10', 1, '管理员', '2012-02-06', 1328520966),
(8, 1, 2, '增加入库：名称：龙凤呈祥2,数量：3', 1, '管理员', '2012-02-06', 1328520975),
(9, 1, 1, '增加入库：名称：龙凤呈祥,数量：2', 1, '管理员', '2012-02-07', 1328584427),
(10, 1, 2, '增加入库：名称：龙凤呈祥2,数量：10', 1, '管理员', '2012-02-07', 1328584441),
(11, 0, 1, '修改商品：龙凤呈祥', 1, '管理员', '2012-02-07', 1328593504),
(12, 0, 1, '修改商品：龙凤呈祥', 1, '管理员', '2012-02-07', 1328593540),
(13, 2, 2, '退款商品ID：2数量:1退款总金额：10.00', 1, '管理员', '2012-02-09', 1328774193),
(14, 0, 3, '新增商品：茅台酒', 1, '管理员', '2012-02-09', 1328774380),
(15, 1, 3, '增加入库：名称：茅台酒,数量：10', 1, '管理员', '2012-02-09', 1328774416),
(16, 2, 3, '退款商品ID：3数量:1退款总金额：200.00', 1, '管理员', '2012-02-09', 1328774635),
(17, 2, 3, '商品ID：3出库:2', 1, '管理员', '2012-02-09', 1328776033),
(18, 2, 3, '商品ID：3出库:1', 1, '管理员', '2012-02-09', 1328776132),
(19, 2, 3, '退款商品ID：3数量:1退款总金额：100.00', 1, '管理员', '2012-02-09', 1328776256),
(20, 0, 4, '新增商品：海飞丝去屑洗发水', 1, '管理员', '2012-02-09', 1328779753),
(21, 1, 4, '增加入库：名称：海飞丝去屑洗发水,数量：10', 1, '管理员', '2012-02-09', 1328779778),
(22, 2, 4, '商品ID：4出库:2', 1, '管理员', '2012-02-09', 1328779829),
(23, 2, 4, '退款商品ID：4数量:1退款总金额：8.00', 1, '管理员', '2012-02-09', 1328779873),
(24, 2, 1, '商品ID：1出库:1', 1, '管理员', '2012-02-10', 1328861152),
(25, 2, 3, '商品ID：3出库:1', 1, '管理员', '2012-02-10', 1328861152),
(26, 2, 4, '商品ID：4出库:1', 1, '管理员', '2012-02-10', 1328861274),
(27, 0, 5, '新增商品：我的优乐美', 1, '管理员', '2012-02-15', 1329276341),
(28, 2, 4, '商品ID：4出库:2', 1, '管理员', '2012-02-17', 1329457313),
(29, 2, 4, '退款商品ID：4数量:2退款总金额：16.00', 1, '管理员', '2012-02-17', 1329458642),
(30, 2, 4, '商品ID：4出库:3', 1, '管理员', '2012-02-17', 1329462898);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_mbgroup`
--

CREATE TABLE IF NOT EXISTS `smpss_mbgroup` (
  `mgid` int(10) NOT NULL AUTO_INCREMENT,
  `mgroup_name` varchar(32) NOT NULL,
  `credit` int(10) NOT NULL COMMENT '消费金额',
  `discount` int(3) NOT NULL COMMENT '折扣',
  PRIMARY KEY (`mgid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员用户组' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `smpss_mbgroup`
--

INSERT INTO `smpss_mbgroup` (`mgid`, `mgroup_name`, `credit`, `discount`) VALUES
(1, '普通会员', 0, 99),
(2, '铜牌会员', 1000, 50);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_member`
--

CREATE TABLE IF NOT EXISTS `smpss_member` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `membercardid` varchar(16) NOT NULL COMMENT '会员卡ID',
  `realname` varchar(32) NOT NULL COMMENT '真实名字',
  `phone` varchar(16) NOT NULL COMMENT '座机',
  `mobile` varchar(16) NOT NULL COMMENT '手机',
  `email` varchar(32) NOT NULL COMMENT '邮箱',
  `prov_id` int(10) NOT NULL COMMENT '省份ID',
  `prov_name` varchar(32) NOT NULL COMMENT '省份名称',
  `city_id` int(10) NOT NULL COMMENT '城市ID',
  `city_name` varchar(32) NOT NULL COMMENT '城市名称',
  `address` varchar(200) NOT NULL COMMENT '地址',
  `zipcode` int(7) NOT NULL COMMENT '邮编',
  `cardid` varchar(18) NOT NULL COMMENT '身份证',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态0停用 1可用',
  `grade` tinyint(1) NOT NULL DEFAULT '1' COMMENT '会员等级',
  `credit` int(10) NOT NULL DEFAULT '0' COMMENT '购物积分',
  `regdateymd` date NOT NULL COMMENT '注册时间YMD',
  `regdateline` int(10) NOT NULL COMMENT '注册时间',
  `lastdateline` int(10) NOT NULL COMMENT '最后购物时间',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `membercardid` (`membercardid`),
  KEY `regdateymd` (`regdateymd`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员信息表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `smpss_member`
--

INSERT INTO `smpss_member` (`mid`, `membercardid`, `realname`, `phone`, `mobile`, `email`, `prov_id`, `prov_name`, `city_id`, `city_name`, `address`, `zipcode`, `cardid`, `state`, `grade`, `credit`, `regdateymd`, `regdateline`, `lastdateline`) VALUES
(1, '1111111', 'jjjjjjjjj', '15009668000', '15900000000', '999999@qq.com', 3418, '重庆', 3419, '万州', '重庆渝中区', 400013, '500223198602282222', 1, 1, 0, '2012-02-02', 1328173320, 0),
(2, '22222222', 'kkkkkkkkkk', '15009668000', '15900000000', '999999@qq.com', 3418, '重庆', 6503, '渝中', '重庆渝中区', 400013, '500223198602282222', 1, 2, 218, '2012-02-02', 1328167314, 1328776256);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_purchase`
--

CREATE TABLE IF NOT EXISTS `smpss_purchase` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) NOT NULL,
  `goods_sn` varchar(32) NOT NULL,
  `goods_name` varchar(100) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `in_num` float NOT NULL COMMENT '进货数量',
  `out_num` float NOT NULL DEFAULT '0' COMMENT '销售数量',
  `in_price` decimal(8,2) NOT NULL COMMENT '进价',
  `dateymd` date NOT NULL COMMENT '进货时间',
  `dateline` int(10) NOT NULL,
  `isdel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否可用1不可用 0可用',
  PRIMARY KEY (`id`),
  KEY `goods_sn` (`goods_sn`),
  KEY `dateymd` (`dateymd`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='进货表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `smpss_purchase`
--

INSERT INTO `smpss_purchase` (`id`, `goods_id`, `goods_sn`, `goods_name`, `cat_id`, `in_num`, `out_num`, `in_price`, `dateymd`, `dateline`, `isdel`) VALUES
(1, 1, '6911989262553', '龙凤呈祥', 9, 10, 4, '8.10', '2012-02-06', 1328520664, 0),
(2, 1, '6911989262553', '龙凤呈祥', 9, 10, 0, '8.20', '2012-02-06', 1328520698, 0),
(3, 1, '6911989262553', '龙凤呈祥', 9, 10, 0, '8.20', '2012-02-06', 1328520858, 0),
(4, 1, '6911989262553', '龙凤呈祥', 9, 2, 0, '8.00', '2012-02-06', 1328520909, 0),
(5, 2, '6911989262552', '龙凤呈祥2', 9, 10, 1, '1.20', '2012-02-06', 1328520953, 0),
(6, 2, '6911989262552', '龙凤呈祥2', 9, 10, 0, '1.30', '2012-02-06', 1328520960, 0),
(7, 2, '6911989262552', '龙凤呈祥2', 9, 10, 0, '1.40', '2012-02-06', 1328520966, 0),
(8, 2, '6911989262552', '龙凤呈祥2', 9, 3, 0, '1.60', '2012-02-06', 1328520975, 0),
(9, 1, '6911989262553', '龙凤呈祥', 9, 2, 0, '8.16', '2012-02-07', 1328584427, 0),
(10, 2, '6911989262552', '龙凤呈祥2', 9, 10, 0, '1.33', '2012-02-07', 1328584441, 0),
(11, 3, '6911989262551', '茅台酒', 10, 10, 4, '150.00', '2012-02-09', 1328774416, 0),
(12, 4, '6911989262550', '海飞丝去屑洗发水', 3, 10, 5, '7.00', '2012-02-09', 1328779778, 0);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_region`
--

CREATE TABLE IF NOT EXISTS `smpss_region` (
  `region_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `region_name` varchar(120) NOT NULL DEFAULT '',
  `region_ename` varchar(32) NOT NULL COMMENT '地区英文名',
  `level` tinyint(1) NOT NULL COMMENT '地区级别',
  PRIMARY KEY (`region_id`),
  KEY `parent_id` (`parent_id`),
  KEY `region_name` (`region_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户资料中的地区表' AUTO_INCREMENT=6559 ;

--
-- 转存表中的数据 `smpss_region`
--

INSERT INTO `smpss_region` (`region_id`, `parent_id`, `region_name`, `region_ename`, `level`) VALUES
(3374, 1, '北京', 'beijing', 2),
(3375, 3374, '东城', 'dongcheng', 3),
(3377, 3374, '西城', 'xicheng', 3),
(3381, 3374, '朝阳', 'chaoyang', 3),
(3382, 3374, '丰台', 'fengtai', 3),
(3383, 3374, '石景山', 'shijingshan', 3),
(3384, 3374, '海淀', 'haidian', 3),
(3385, 3374, '门头沟', 'mentougou', 3),
(3386, 3374, '房山', 'fangshan', 3),
(3387, 3374, '通州', 'tongzhou', 3),
(3388, 3374, '顺义', 'shunyi', 3),
(3389, 3374, '昌平', 'changping', 3),
(3390, 3374, '大兴', 'daxing', 3),
(3391, 3374, '平谷', 'pinggu', 3),
(3392, 3374, '怀柔', 'huairou', 3),
(3393, 3374, '密云', 'miyun', 3),
(3394, 3374, '延庆', 'yanqing', 3),
(3395, 1, '安徽', 'anhui', 2),
(3396, 3395, '合肥', 'hefei', 3),
(3397, 3395, '安庆', 'anqing', 3),
(3398, 3395, '蚌埠', 'bangbu', 3),
(3399, 3395, '亳州', 'haozhou', 3),
(3400, 3395, '巢湖', 'chaohu', 3),
(3401, 3395, '滁州', 'chuzhou', 3),
(3402, 3395, '阜阳', 'fuyang', 3),
(3403, 3395, '池州', 'chizhou', 3),
(3404, 3395, '淮北', 'huaibei', 3),
(3406, 3395, '淮南', 'huainan', 3),
(3407, 3395, '黄山', 'huangshan', 3),
(3409, 3395, '六安', 'liuan', 3),
(3410, 3395, '马鞍山', 'maanshan', 3),
(3411, 3395, '宿州', 'suzhou', 3),
(3412, 3395, '铜陵', 'tongling', 3),
(3415, 3395, '宣城', 'xuancheng', 3),
(3417, 3395, '芜湖', 'wuhu', 3),
(3418, 1, '重庆', 'chongqing', 2),
(3419, 3418, '万州', 'wanzhou', 3),
(3420, 3418, '涪陵', 'fuling', 3),
(3422, 3418, '大渡口', 'dadukou', 3),
(3423, 3418, '江北', 'jiangbei', 3),
(3425, 3418, '沙坪坝', 'shapingba', 3),
(3426, 3418, '九龙坡', 'jiulongpo', 3),
(3427, 3418, '南岸', 'nanan', 3),
(3428, 3418, '北碚', 'beibei', 3),
(3429, 3418, '万盛', 'wansheng', 3),
(3430, 3418, '双桥', 'pudongxinqu', 3),
(3431, 3418, '渝北', 'yubei', 3),
(3432, 3418, '巴南', 'banan', 3),
(3433, 3418, '黔江', 'qianjiang', 3),
(3434, 3418, '长寿', 'changshou', 3),
(3435, 3418, '綦江', 'qijiang', 3),
(3436, 3418, '潼南', 'tongnan', 3),
(3437, 3418, '铜梁', 'tongliang', 3),
(3438, 3418, '大足', 'dazu', 3),
(3439, 3418, '荣昌', 'rongchang', 3),
(3440, 3418, '壁山', 'bishan', 3),
(3441, 3418, '梁平', 'liangping', 3),
(3442, 3418, '城口', 'chengkou', 3),
(3443, 3418, '丰都', 'fengdu', 3),
(3444, 3418, '垫江', 'dianjiang', 3),
(3445, 3418, '武隆', 'wulong', 3),
(3446, 3418, '忠县', 'zhongxian', 3),
(3447, 3418, '开县', 'kaixian', 3),
(3448, 3418, '云阳', 'yunyang', 3),
(3449, 3418, '奉节', 'fengjie', 3),
(3450, 3418, '巫山', 'wushan', 3),
(3451, 3418, '巫溪', 'wuxi', 3),
(3452, 3418, '石柱', 'shizhu', 3),
(3453, 3418, '秀山', 'xiushan', 3),
(3454, 3418, '酉阳', 'youyang', 3),
(3455, 3418, '彭水', 'pengshui', 3),
(3456, 3418, '江津', 'jiangjin', 3),
(3457, 3418, '合川', 'hechuan', 3),
(3458, 3418, '永川', 'yongchuan', 3),
(3459, 3418, '南川', 'nanchuan', 3),
(3460, 1, '福建', 'fujian', 2),
(3461, 3460, '福州', 'fuzhou', 3),
(3463, 3460, '龙岩', 'longyan', 3),
(3464, 3460, '南平', 'nanping', 3),
(3465, 3460, '宁德', 'ningde', 3),
(3466, 3460, '莆田', 'putian', 3),
(3467, 3460, '泉州', 'quanzhou', 3),
(3468, 3460, '三明', 'sanming', 3),
(3474, 3460, '厦门', 'xiamen', 3),
(3476, 1, '甘肃', 'gansu', 2),
(3477, 3476, '兰州', 'lanzhou', 3),
(3478, 3476, '白银', 'baiyin', 3),
(3479, 3476, '定西', 'dingxi', 3),
(3481, 3476, '甘南', 'gannan', 3),
(3482, 3476, '金昌', 'jinchang', 3),
(3483, 3476, '酒泉', 'jiuquan', 3),
(3484, 3476, '临夏', 'linxia', 3),
(3485, 3476, '平凉', 'pingliang', 3),
(3486, 3476, '天水', 'tianshui', 3),
(3487, 3476, '陇南', 'longnan', 3),
(3490, 3476, '嘉峪关', 'jiayuguan', 3),
(3491, 3476, '张掖', 'zhangye', 3),
(3492, 1, '广东', 'guangdong', 2),
(3493, 3492, '广州', 'guangzhou', 3),
(3495, 3492, '潮州', 'chaozhou', 3),
(3497, 3492, '东莞', 'dongwan', 3),
(3498, 3492, '佛山', 'foshan', 3),
(3499, 3492, '河源', 'heyuan', 3),
(3500, 3492, '惠州', 'huizhou', 3),
(3501, 3492, '江门', 'jiangmen', 3),
(3502, 3492, '揭阳', 'jieyang', 3),
(3504, 3492, '茂名', 'maoming', 3),
(3505, 3492, '梅州', 'meizhou', 3),
(3506, 3492, '清远', 'qingyuan', 3),
(3507, 3492, '汕头', 'shantou', 3),
(3508, 3492, '汕尾', 'shanwei', 3),
(3509, 3492, '韶关', 'shaoguan', 3),
(3510, 3492, '深圳', 'shenzhen', 3),
(3512, 3492, '阳江', 'yangjiang', 3),
(3514, 3492, '云浮', 'yunfu', 3),
(3516, 3492, '湛江', 'zhanjiang', 3),
(3517, 3492, '肇庆', 'zhaoqing', 3),
(3518, 3492, '中山', 'zhongshan', 3),
(3519, 3492, '珠海', 'zhuhai', 3),
(3520, 1, '广西', 'guangxi', 2),
(3521, 3520, '南宁', 'nanning', 3),
(3522, 3520, '百色', 'baise', 3),
(3523, 3520, '北海', 'beihai', 3),
(3524, 3520, '桂林', 'guilin', 3),
(3525, 3520, '防城港', 'fangchenggang', 3),
(3526, 3520, '河池', 'hechi', 3),
(3527, 3520, '贺州', 'hezhou', 3),
(3528, 3520, '柳州', 'liuzhou', 3),
(3529, 3520, '来宾', 'laibin', 3),
(3530, 3520, '钦州', 'qinzhou', 3),
(3531, 3520, '梧州', 'wuzhou', 3),
(3533, 3520, '玉林', 'yulin', 3),
(3534, 1, '贵州', 'guizhou', 2),
(3536, 3534, '贵阳', 'guiyang', 3),
(3537, 3534, '安顺', 'anshun', 3),
(3541, 3534, '六盘水', 'liupanshui', 3),
(3542, 3534, '铜仁', 'tongren', 3),
(3545, 3534, '遵义', 'zunyi', 3),
(3546, 1, '海南', 'hainan', 2),
(3547, 3546, '海口', 'haikou', 3),
(3548, 3546, '三亚', 'sanya', 3),
(3549, 3546, '五指山', 'wuzhishan', 3),
(3550, 3546, '琼海', 'qionghai', 3),
(3551, 3546, '儋州', 'danzhou', 3),
(3552, 3546, '文昌', 'wenchang', 3),
(3553, 3546, '万宁', 'wanning', 3),
(3554, 3546, '东方', 'dongfang', 3),
(3555, 3546, '定安', 'dingan', 3),
(3556, 3546, '屯昌', 'tunchang', 3),
(3557, 3546, '澄迈', 'chengmai', 3),
(3558, 3546, '临高', 'lingao', 3),
(3560, 3546, '白沙黎族', 'baishalizuzizhixian', 3),
(3561, 3546, '昌江黎族', 'changjianglizuzizhixian', 3),
(3562, 3546, '乐东黎族', 'ledonglizuzizhixian', 3),
(3563, 3546, '陵水黎族', 'lingshuilizuzizhixian', 3),
(3564, 3546, '保亭黎族', 'baotinglizu', 3),
(3565, 3546, '琼中黎族', 'qiongzhonglizu', 3),
(3566, 3546, '西沙群岛', 'xishaqundao', 3),
(3567, 3546, '南沙群岛', 'nanshaqundao', 3),
(3568, 3546, '中沙群岛', 'zhongshaqundao', 3),
(3569, 1, '河北', 'hebei', 2),
(3571, 3569, '保定', 'baoding', 3),
(3573, 3569, '沧州', 'cangzhou', 3),
(3574, 3569, '承德', 'chengde', 3),
(3576, 3569, '邯郸', 'handan', 3),
(3577, 3569, '衡水', 'hengshui', 3),
(3578, 3569, '廊坊', 'langfang', 3),
(3580, 3569, '秦皇岛', 'qinhuangdao', 3),
(3581, 3569, '唐山', 'tangshan', 3),
(3583, 3569, '邢台', 'xingtai', 3),
(3584, 3569, '张家口', 'zhangjiakou', 3),
(3585, 1, '黑龙江', 'heilongjiang', 2),
(3586, 3585, '哈尔滨', 'haerbin', 3),
(3588, 3585, '大庆', 'daqing', 3),
(3589, 3585, '大兴安岭', 'daxinganling', 3),
(3590, 3585, '鹤岗', 'hegang', 3),
(3591, 3585, '黑河', 'heihe', 3),
(3592, 3585, '佳木斯', 'jiamusi', 3),
(3594, 3585, '牡丹江', 'mudanjiang', 3),
(3595, 3585, '齐齐哈尔', 'qiqihaer', 3),
(3596, 3585, '七台河', 'qitaihe', 3),
(3597, 3585, '双鸭山', 'shuangyashan', 3),
(3598, 3585, '绥化', 'suihua', 3),
(3599, 3585, '伊春', 'yichun', 3),
(3601, 1, '河南', 'henan', 2),
(3602, 3601, '郑州', 'zhengzhou', 3),
(3603, 3601, '安阳', 'anyang', 3),
(3604, 3601, '鹤壁', 'hebi', 3),
(3606, 3601, '焦作', 'jiaozuo', 3),
(3608, 3601, '开封', 'kaifeng', 3),
(3609, 3601, '漯河', 'luohe', 3),
(3610, 3601, '洛阳', 'luoyang', 3),
(3611, 3601, '南阳', 'nanyang', 3),
(3612, 3601, '平顶山', 'pingdingshan', 3),
(3613, 3601, '濮阳', 'puyang', 3),
(3614, 3601, '三门峡', 'sanmenxia', 3),
(3615, 3601, '商丘', 'shangqiu', 3),
(3616, 3601, '新乡', 'xinxiang', 3),
(3617, 3601, '信阳', 'xinyang', 3),
(3618, 3601, '许昌', 'xuchang', 3),
(3619, 3601, '周口', 'zhoukou', 3),
(3620, 3601, '驻马店', 'zhumadian', 3),
(3626, 1, '湖北', 'hubei', 2),
(3627, 3626, '武汉', 'wuhan', 3),
(3628, 3626, '恩施', 'enshi', 3),
(3629, 3626, '鄂州', 'ezhou', 3),
(3630, 3626, '黄冈', 'huanggang', 3),
(3631, 3626, '黄石', 'huangshi', 3),
(3632, 3626, '荆门', 'jingmen', 3),
(3633, 3626, '荆州', 'jingzhou', 3),
(3635, 3626, '十堰', 'shiyan', 3),
(3636, 3626, '随州', 'suizhou', 3),
(3639, 3626, '咸宁', 'xianning', 3),
(3641, 3626, '襄樊', 'xiangfan', 3),
(3642, 3626, '孝感', 'xiaogan', 3),
(3643, 3626, '宜昌', 'yichang', 3),
(3644, 1, '湖南', 'hunan', 2),
(3645, 3644, '长沙', 'changsha', 3),
(3646, 3644, '常德', 'changde', 3),
(3647, 3644, '郴州', 'chenzhou', 3),
(3648, 3644, '衡阳', 'hengyang', 3),
(3649, 3644, '怀化', 'huaihua', 3),
(3651, 3644, '娄底', 'loudi', 3),
(3652, 3644, '邵阳', 'shaoyang', 3),
(3653, 3644, '湘潭', 'xiangtan', 3),
(3654, 3644, '益阳', 'yiyang', 3),
(3655, 3644, '岳阳', 'yueyang', 3),
(3656, 3644, '永州', 'yongzhou', 3),
(3657, 3644, '张家界', 'zhangjiajie', 3),
(3658, 3644, '株洲', 'zhuzhou', 3),
(3659, 1, '江苏', 'jiangsu', 2),
(3660, 3659, '南京', 'nanjing', 3),
(3662, 3659, '常州', 'changzhou', 3),
(3668, 3659, '连云港', 'lianyungang', 3),
(3669, 3659, '南通', 'nantong', 3),
(3672, 3659, '宿迁', 'suqian', 3),
(3673, 3659, '苏州', 'suzhou', 3),
(3675, 3659, '泰州', 'taizhou', 3),
(3677, 3659, '无锡', 'wuxi', 3),
(3678, 3659, '徐州', 'xuzhou', 3),
(3679, 3659, '盐城', 'yancheng', 3),
(3680, 3659, '扬州', 'yangzhou', 3),
(3684, 3659, '镇江', 'zhenjiang', 3),
(3686, 1, '江西', 'jiangxi', 2),
(3687, 3686, '南昌', 'nanchang', 3),
(3688, 3686, '抚州', 'fuzhou', 3),
(3689, 3686, '赣州', 'ganzhou', 3),
(3690, 3686, '吉安', 'jian', 3),
(3691, 3686, '景德镇', 'jingdezhen', 3),
(3693, 3686, '九江', 'jiujiang', 3),
(3695, 3686, '萍乡', 'pingxiang', 3),
(3696, 3686, '上饶', 'shangrao', 3),
(3697, 3686, '新余', 'xinyu', 3),
(3698, 3686, '宜春', 'yichun', 3),
(3699, 3686, '鹰潭', 'yingtan', 3),
(3700, 1, '吉林', 'jilin', 2),
(3701, 3700, '长春', 'changchun', 3),
(3702, 3700, '白城', 'baicheng', 3),
(3705, 3700, '辽源', 'liaoyuan', 3),
(3707, 3700, '吉林', 'jilin', 3),
(3708, 3700, '四平', 'siping', 3),
(3709, 3700, '松原', 'songyuan', 3),
(3710, 3700, '通化', 'tonghua', 3),
(3712, 1, '辽宁', 'liaoning', 2),
(3713, 3712, '沈阳', 'shenyang', 3),
(3714, 3712, '鞍山', 'anshan', 3),
(3715, 3712, '本溪', 'benxi', 3),
(3716, 3712, '朝阳', 'chaoyang', 3),
(3717, 3712, '大连', 'dalian', 3),
(3718, 3712, '丹东', 'dandong', 3),
(3719, 3712, '抚顺', 'fushun', 3),
(3720, 3712, '阜新', 'fuxin', 3),
(3721, 3712, '葫芦岛', 'huludao', 3),
(3722, 3712, '锦州', 'jinzhou', 3),
(3723, 3712, '辽阳', 'liaoyang', 3),
(3724, 3712, '盘锦', 'panjin', 3),
(3725, 3712, '铁岭', 'tieling', 3),
(3726, 3712, '营口', 'yingkou', 3),
(3729, 1, '内蒙古', 'neimenggu', 2),
(3730, 3729, '呼和浩特', 'huhehaote', 3),
(3731, 3729, '阿拉善盟', 'alashanmeng', 3),
(3732, 3729, '包头', 'baotou', 3),
(3733, 3729, '赤峰', 'chifeng', 3),
(3738, 3729, '通辽', 'tongliao', 3),
(3739, 3729, '乌海', 'wuhai', 3),
(3742, 1, '宁夏', 'ningxia', 2),
(3743, 3742, '银川', 'yinchuan', 3),
(3744, 3742, '固原', 'guyuan', 3),
(3745, 3742, '中卫', 'zhongwei', 3),
(3746, 3742, '石嘴山', 'shizuishan', 3),
(3747, 3742, '吴忠', 'wuzhong', 3),
(3748, 1, '青海', 'qinghai', 2),
(3749, 3748, '西宁', 'xining', 3),
(3752, 3748, '海南', 'hainan', 3),
(3753, 3748, '海东', 'haidong', 3),
(3754, 3748, '海北', 'haibei', 3),
(3755, 3748, '果洛', 'guoluo', 3),
(3756, 3748, '黄南', 'huangnan', 3),
(3757, 3748, '玉树', 'yushu', 3),
(3758, 1, '山东', 'shandong', 2),
(3759, 3758, '济南', 'jinan', 3),
(3760, 3758, '滨州', 'binzhou', 3),
(3762, 3758, '德州', 'dezhou', 3),
(3763, 3758, '东营', 'dongying', 3),
(3764, 3758, '菏泽', 'heze', 3),
(3765, 3758, '济宁', 'jining', 3),
(3766, 3758, '莱芜', 'laiwu', 3),
(3767, 3758, '聊城', 'liaocheng', 3),
(3768, 3758, '临沂', 'linyi', 3),
(3770, 3758, '青岛', 'qingdao', 3),
(3772, 3758, '日照', 'rizhao', 3),
(3775, 3758, '泰安', 'taian', 3),
(3776, 3758, '潍坊', 'weifang', 3),
(3777, 3758, '威海', 'weihai', 3),
(3778, 3758, '烟台', 'yantai', 3),
(3779, 3758, '枣庄', 'zaozhuang', 3),
(3780, 3758, '淄博', 'zibo', 3),
(3781, 1, '上海', 'shanghai', 2),
(3782, 3781, '崇明', 'chongming', 3),
(3783, 3781, '黄浦', 'huangpu', 3),
(3784, 3781, '卢湾', 'luwan', 3),
(3785, 3781, '徐汇', 'xuhui', 3),
(3786, 3781, '长宁', 'changning', 3),
(3787, 3781, '静安', 'jingan', 3),
(3788, 3781, '普陀', 'putuo', 3),
(3789, 3781, '闸北', 'zhabei', 3),
(3790, 3781, '虹口', 'hongkou', 3),
(3791, 3781, '杨浦', 'yangpu', 3),
(3792, 3781, '闵行', 'minhang', 3),
(3793, 3781, '宝山', 'baoshan', 3),
(3794, 3781, '嘉定', 'jiading', 3),
(3795, 3781, '浦东', 'pudong', 3),
(3796, 3781, '金山', 'jinshan', 3),
(3797, 3781, '松江', 'songjiang', 3),
(3798, 3781, '青浦', 'qingpu', 3),
(3800, 3781, '奉贤', 'fengxian', 3),
(3802, 1, '山西', 'shanxi', 2),
(3803, 3802, '太原', 'taiyuan', 3),
(3804, 3802, '长治', 'changzhi', 3),
(3805, 3802, '大同', 'datong', 3),
(3807, 3802, '晋城', 'jincheng', 3),
(3811, 3802, '朔州', 'shuozhou', 3),
(3812, 3802, '忻州', 'xinzhou', 3),
(3815, 3802, '运城', 'yuncheng', 3),
(3816, 1, '陕西', 'shanxi', 2),
(3817, 3816, '西安', 'xian', 3),
(3818, 3816, '安康', 'ankang', 3),
(3819, 3816, '宝鸡', 'baoji', 3),
(3820, 3816, '汉中', 'hanzhong', 3),
(3821, 3816, '渭南', 'weinan', 3),
(3822, 3816, '商洛', 'shangluo', 3),
(3824, 3816, '铜川', 'tongchuan', 3),
(3825, 3816, '咸阳', 'xianyang', 3),
(3826, 3816, '延安', 'yanan', 3),
(3827, 3816, '榆林', 'yulin', 3),
(3828, 1, '四川', 'sichuan', 2),
(3829, 3828, '成都', 'chengdu', 3),
(3830, 3828, '巴中', 'bazhong', 3),
(3831, 3828, '达州', 'dazhou', 3),
(3832, 3828, '德阳', 'deyang', 3),
(3836, 3828, '广安', 'guangan', 3),
(3837, 3828, '广元', 'guangyuan', 3),
(3840, 3828, '乐山', 'leshan', 3),
(3843, 3828, '绵阳', 'mianyang', 3),
(3844, 3828, '眉山', 'meishan', 3),
(3845, 3828, '南充', 'nanchong', 3),
(3846, 3828, '内江', 'neijiang', 3),
(3847, 3828, '攀枝花', 'panzhihua', 3),
(3848, 3828, '遂宁', 'suining', 3),
(3850, 3828, '凉山彝族自治州', 'liangshanyizuzizhizhou', 3),
(3851, 3828, '雅安', 'yaan', 3),
(3852, 3828, '宜宾', 'yibin', 3),
(3853, 3828, '自贡', 'zigong', 3),
(3854, 3828, '资阳', 'ziyang', 3),
(3876, 1, '天津', 'tianjin', 2),
(3878, 3876, '和平', 'heping', 3),
(3879, 3876, '东丽', 'dongli', 3),
(3880, 3876, '河东', 'hedong', 3),
(3881, 3876, '西青', 'xiqing', 3),
(3882, 3876, '河西', 'hexi', 3),
(3883, 3876, '津南', 'jinnan', 3),
(3884, 3876, '南开', 'nankai', 3),
(3885, 3876, '北辰', 'beichen', 3),
(3886, 3876, '河北', 'hebei', 3),
(3887, 3876, '武清', 'wuqing', 3),
(3892, 3876, '宁河', 'ninghe', 3),
(3893, 3876, '静海', 'jinghai', 3),
(3894, 3876, '宝坻', 'baodi', 3),
(3895, 3876, '蓟县', 'jixian', 3),
(3896, 1, '新疆', 'xinjiang', 2),
(3897, 3896, '乌鲁木齐', 'wulumuqi', 3),
(3899, 3896, '阿勒泰', 'aletai', 3),
(3902, 3896, '昌吉', 'changji', 3),
(3905, 3896, '哈密', 'hami', 3),
(3906, 3896, '和田', 'hetian', 3),
(3907, 3896, '喀什', 'kashi', 3),
(3908, 3896, '克拉玛依', 'kelamayi', 3),
(3914, 3896, '吐鲁番', 'tulufan', 3),
(3916, 1, '西藏', 'Tibet', 2),
(3917, 3916, '拉萨', 'lasa', 3),
(3918, 3916, '阿里', 'ali', 3),
(3919, 3916, '昌都', 'changdu', 3),
(3920, 3916, '林芝', 'linzhi', 3),
(3921, 3916, '那曲', 'naqu', 3),
(3922, 3916, '日喀则', 'rikaze', 3),
(3923, 3916, '山南', 'shannan', 3),
(3924, 1, '云南', 'yunnan', 2),
(3925, 3924, '昆明', 'kunming', 3),
(3926, 3924, '大理', 'dali', 3),
(3927, 3924, '保山', 'baoshan', 3),
(3934, 3924, '临沧', 'lincang', 3),
(3935, 3924, '丽江', 'lijiang', 3),
(3938, 3924, '曲靖', 'qujing', 3),
(3940, 3924, '文山', 'wenshan', 3),
(3941, 3924, '西双版纳', 'xishuangbanna', 3),
(3942, 3924, '玉溪', 'yuxi', 3),
(3944, 3924, '昭通', 'zhaotong', 3),
(3945, 1, '浙江', 'zhejiang', 2),
(3946, 3945, '杭州', 'hangzhou', 3),
(3953, 3945, '湖州', 'huzhou', 3),
(3954, 3945, '嘉兴', 'jiaxing', 3),
(3955, 3945, '金华', 'jinhua', 3),
(3958, 3945, '丽水', 'lishui', 3),
(3959, 3945, '宁波', 'ningbo', 3),
(3963, 3945, '衢州', 'quzhou', 3),
(3966, 3945, '绍兴', 'shaoxing', 3),
(3968, 3945, '台州', 'taizhou', 3),
(3970, 3945, '温州', 'wenzhou', 3),
(3972, 3945, '舟山', 'zhoushan', 3),
(4003, 3569, '石家庄', 'huaian', 3),
(4274, 3802, '吕梁', 'lvliang', 3),
(4288, 3802, '晋中', 'jinzhong', 3),
(6503, 3418, '渝中', 'yuzhong', 3),
(6504, 3729, '呼伦贝尔市', 'hulunbeiershi', 3),
(6507, 3729, '鄂尔多斯市', 'eerduosishi', 3),
(6508, 3729, '巴彦淖尔', 'bayannaoer', 3),
(6509, 3729, '乌兰察布', 'wulanchabu', 3),
(6510, 3729, '兴安盟', 'xinganmeng', 3),
(6511, 3585, '鸡西', 'jixi', 3),
(6513, 3460, '漳州', 'zhangzhou', 3),
(6514, 3828, '阿坝藏族羌族自治州', 'abazhangzuzizhizhou', 3),
(6515, 3828, '甘孜藏族自治州', 'ganzizhangzuzizhizhou', 3),
(6516, 3534, '黔西南布依族苗族自治州', 'qianxinanyizunanzuzizhizhou', 3),
(6517, 3534, '黔东南苗族侗族自治州', 'qiandongnanmiaozudongzuzizhizhou', 3),
(6518, 3534, '黔南布依族苗族自治州', 'qiannanbuyizumiaozuzizhizhou', 3),
(6519, 3924, '普洱', 'puer', 3),
(6520, 3924, '楚雄', 'chuxiong', 3),
(6521, 3924, '红河', 'honghe', 3),
(6522, 3924, '德宏', 'dehong', 3),
(6523, 3924, '怒江', 'nujiang', 3),
(6524, 3924, '迪庆', 'diqing', 3),
(6525, 3476, '庆阳', 'qingyang', 3),
(6526, 3476, '武威', 'wuwei', 3),
(6528, 3748, '海西', 'haixi', 3),
(6529, 3896, '博尔塔拉', 'boertala', 3),
(6530, 3896, '巴音郭楞', 'bayinguoleng', 3),
(6531, 3896, '阿克苏', 'akesu', 3),
(6532, 3896, '克孜勒苏柯尔克孜', 'kezilesukeerkezi', 3),
(6533, 3896, '伊犁哈萨克', 'yilihasake', 3),
(6534, 3896, '塔城', 'tacheng', 3),
(6535, 3520, '贵港', 'guigang', 3),
(6536, 3520, '崇左', 'chongzuo', 3),
(6537, 3534, '毕节', 'bijie', 3),
(6538, 3601, '济源', 'jiyuan', 3),
(6539, 3644, '湘西', 'xiangxi', 3),
(6540, 3626, '仙桃', 'xiantao', 3),
(6541, 3626, '潜江', 'qianjiang', 3),
(6542, 3626, '天门', 'tianmen', 3),
(6543, 3626, '神农架林区', 'shenlongjialinqu', 3),
(6545, 3700, '白山', 'baishan', 3),
(6546, 3700, '延边朝鲜族自治州', 'yanbianchaoxianzizhizhou', 3),
(6547, 3729, '锡林郭勒盟', 'xilinguolemeng', 3),
(6548, 3802, '阳泉', 'yangquan', 3),
(6549, 3802, '临汾', 'linfen', 3),
(6551, 3876, '滨海新区', 'binhaixinqu', 3),
(6553, 3896, '石河子', 'shihezi', 3),
(6554, 3896, '阿拉尔', 'alaer', 3),
(6555, 3896, '图木舒克', 'tumushuke', 3),
(6556, 3896, '五家渠', 'wujiaqu', 3),
(6557, 3876, '红桥', 'hongqiaoqu', 3),
(6558, 3828, '泸州', 'luzhou', 3);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_sales`
--

CREATE TABLE IF NOT EXISTS `smpss_sales` (
  `sid` int(10) NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) NOT NULL,
  `goods_sn` varchar(16) NOT NULL,
  `goods_name` varchar(100) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `order_id` varchar(14) NOT NULL,
  `mid` int(10) NOT NULL,
  `membercardid` varchar(16) NOT NULL COMMENT '会员卡卡号',
  `realname` varchar(32) NOT NULL,
  `num` float NOT NULL,
  `price` decimal(8,2) NOT NULL COMMENT '实际售价(优惠后的金额)',
  `out_price` decimal(8,2) NOT NULL COMMENT '商品表的售价(未优惠的价格)',
  `in_price` decimal(8,2) NOT NULL COMMENT '销售时的平均进价',
  `dateymd` date NOT NULL,
  `dateline` int(10) NOT NULL,
  `m_discount` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '会员优惠金额',
  `p_discount` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '促销优惠的金额',
  `refund_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '退款类型 0无退款 1全额退款 2部分退款',
  `refund_num` float NOT NULL DEFAULT '0' COMMENT '退货数量',
  `refund_amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '退款金额',
  `sales_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '销售类型 0正常销售1退货销售',
  PRIMARY KEY (`sid`),
  KEY `goods_id` (`goods_id`),
  KEY `goods_sn` (`goods_sn`),
  KEY `order_id` (`order_id`),
  KEY `dateymd` (`dateymd`),
  KEY `membercardid` (`membercardid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='销售记录表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `smpss_sales`
--

INSERT INTO `smpss_sales` (`sid`, `goods_id`, `goods_sn`, `goods_name`, `cat_id`, `order_id`, `mid`, `membercardid`, `realname`, `num`, `price`, `out_price`, `in_price`, `dateymd`, `dateline`, `m_discount`, `p_discount`, `refund_type`, `refund_num`, `refund_amount`, `sales_type`) VALUES
(1, 1, '2147483647', '龙凤呈祥', 9, '2147483647', 0, '', '', 3, '10.00', '10.00', '8.00', '2012-02-08', 1328683147, 0.00, 0.00, 0, 0, '0.00', 0),
(2, 2, '2147483647', '龙凤呈祥2', 9, '2147483647', 0, '', '', 2, '10.00', '10.00', '8.00', '2012-02-08', 1328683147, 0.00, 0.00, 0, 0, '0.00', 0),
(3, 1, '6911989262553', '龙凤呈祥', 9, '02081454027451', 2, '22222222', 'kkkkkkkkkk', 1, '9.80', '10.00', '8.00', '2012-02-08', 1328684042, 0.20, 0.00, 0, 0, '0.00', 0),
(4, 3, '6911989262551', '茅台酒', 10, '02091602110806', 0, '', '', 2, '200.00', '200.00', '160.00', '2012-02-09', 1328774531, 0.00, 0.00, 2, 1, '200.00', 0),
(5, 3, '6911989262551', '茅台酒', 10, '02091627131571', 0, '', '', 2, '200.00', '200.00', '160.00', '2012-02-09', 1328776033, 0.00, 0.00, 0, 0, '0.00', 0),
(6, 3, '6911989262551', '茅台酒', 10, '02091628521588', 2, '22222222', 'kkkkkkkkkk', 1, '100.00', '200.00', '160.00', '2012-02-09', 1328776132, 100.00, 0.00, 0, 0, '0.00', 0),
(7, 4, '6911989262550', '海飞丝去屑洗发水', 3, '02091730292066', 0, '', '', 2, '8.00', '10.00', '8.00', '2012-02-09', 1328779829, 0.00, 2.00, 0, 0, '0.00', 0),
(8, 1, '6911989262553', '龙凤呈祥', 9, '02101605524789', 0, '', '', 1, '10.00', '10.00', '8.00', '2012-02-10', 1328861152, 0.00, 0.00, 0, 0, '0.00', 0),
(9, 3, '6911989262551', '茅台酒', 10, '02101605524789', 0, '', '', 1, '200.00', '200.00', '160.00', '2012-02-10', 1328861152, 0.00, 0.00, 0, 0, '0.00', 0),
(10, 4, '6911989262550', '海飞丝去屑洗发水', 3, '02101607541067', 0, '', '', 1, '8.00', '10.00', '8.00', '2012-02-10', 1328861274, 0.00, 2.00, 0, 0, '0.00', 0),
(11, 4, '6911989262550', '海飞丝去屑洗发水', 3, '02171341532932', 0, '', '', 2, '8.00', '10.00', '8.00', '2012-02-17', 1329457313, 0.00, 2.00, 2, 2, '16.00', 0),
(12, 4, '6911989262550', '海飞丝去屑洗发水', 3, '02171514583337', 0, '', '', 3, '8.00', '10.00', '7.00', '2012-02-17', 1329462898, 0.00, 2.00, 0, 0, '0.00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_system`
--

CREATE TABLE IF NOT EXISTS `smpss_system` (
  `sysname` varchar(100) NOT NULL,
  `options` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统配置信息表';

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
