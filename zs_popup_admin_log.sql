CREATE TABLE `zs_popup_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日志id',
  `za_uid` int(11) NOT NULL DEFAULT '0' COMMENT '助手后台管理员用户—操作人id',
  `za_uname` varchar(50) NOT NULL DEFAULT '' COMMENT '操作员名称',
  `popup_id` int(11) NOT NULL DEFAULT '0' COMMENT '弹窗id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '弹窗标题',
  `behavior` text COMMENT '操作行为描述',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '操作时间',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='弹窗管理操作记录表';