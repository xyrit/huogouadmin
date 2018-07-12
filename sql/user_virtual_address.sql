CREATE TABLE `user_virtual_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `type` tinyint(1) NOT NULL COMMENT '充值类型',
  `account` varchar(64) NOT NULL COMMENT '账号',
  `contact` varchar(32) DEFAULT NULL COMMENT '手机号码',
  `created_at` int(10) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `uid` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '虚拟物品收货地址';
