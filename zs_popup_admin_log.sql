CREATE TABLE `zs_popup_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '��־id',
  `za_uid` int(11) NOT NULL DEFAULT '0' COMMENT '���ֺ�̨����Ա�û���������id',
  `za_uname` varchar(50) NOT NULL DEFAULT '' COMMENT '����Ա����',
  `popup_id` int(11) NOT NULL DEFAULT '0' COMMENT '����id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '��������',
  `behavior` text COMMENT '������Ϊ����',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '����ʱ��',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '����ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='�������������¼��';