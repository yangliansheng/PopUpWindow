CREATE TABLE `zs_popup_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '弹窗弹出记录id',
  `zp_id` int(11) NOT NULL COMMENT '弹窗id',
  `u_id` int(11) DEFAULT NULL COMMENT '用户id',
  `zp_name` varchar(50) NOT NULL COMMENT '弹窗标题',
  `zp_type` tinyint(4) NOT NULL COMMENT '弹窗类型 0版本更新 1认证 2活动 3购物卡',
  `zp_show_type` tinyint(1) NOT NULL COMMENT '弹窗位置 0 中间 1底部 2浮动',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `index` (`zp_id`,`u_id`,`zp_type`,`zp_show_type`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='弹窗频次记录表';

