CREATE TABLE `zs_popup_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '����������¼id',
  `zp_id` int(11) NOT NULL COMMENT '����id',
  `u_id` int(11) DEFAULT NULL COMMENT '�û�id',
  `zp_name` varchar(50) NOT NULL COMMENT '��������',
  `zp_type` tinyint(4) NOT NULL COMMENT '�������� 0�汾���� 1��֤ 2� 3���￨',
  `zp_show_type` tinyint(1) NOT NULL COMMENT '����λ�� 0 �м� 1�ײ� 2����',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '���ʱ��',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '����ʱ��',
  PRIMARY KEY (`id`),
  KEY `index` (`zp_id`,`u_id`,`zp_type`,`zp_show_type`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='����Ƶ�μ�¼��';

