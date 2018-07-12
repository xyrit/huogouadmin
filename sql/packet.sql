CREATE TABLE `packet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '红包名称',
  `num` int(10) NOT NULL COMMENT '红包数量',
  `desc` text NOT NULL COMMENT '描述',
  `content` varchar(400) NOT NULL DEFAULT '' COMMENT '红包内容',
  `send_num` int(10) DEFAULT '0' COMMENT '发出数量',
  `left_num` int(10) DEFAULT '0' COMMENT '剩余数量',
  `receive_limit` int(2) DEFAULT '1' COMMENT '领取限制',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;