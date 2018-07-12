CREATE TABLE `user_packet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `packet_id` int(10) NOT NULL COMMENT '红包ID',
  `source` varchar(10) DEFAULT NULL COMMENT '来源',
  `status` int(1) NOT NULL COMMENT '状态,0-未打开，1-已打开',
  `receive_time` int(10) NOT NULL COMMENT '领取时间',
  `open_time` int(10) DEFAULT '0' COMMENT '打开时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;