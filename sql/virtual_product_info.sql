CREATE TABLE `virtual_product_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `order_id` char(25) NOT NULL COMMENT '中奖订单号',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '充值方式（1 支付宝）',
  `account` varchar(32) NOT NULL COMMENT '充值账号',
  `contact` varchar(32) DEFAULT NULL COMMENT '联系方式',
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  `created_at` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`),
  KEY `idx_order_id` (`order_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '虚拟物品中奖信息';