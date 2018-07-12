CREATE TABLE `coupon_code` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` int(10) NOT NULL,
  `code` char(10) NOT NULL DEFAULT '' COMMENT '优惠券码',
  `status` int(1) DEFAULT '0' COMMENT '优惠券状态,0-可用,1-已领取，2-已使用，3-过期，4-失效,5-冻结',
  `export` int(1) DEFAULT '0' COMMENT '是否导出',
  `packet_id` int(10) DEFAULT '0' COMMENT '在哪个红包里边',
  `user_id` int(10) DEFAULT '0' COMMENT '领取人id',
  `receive_time` int(10) DEFAULT '0' COMMENT '领取时间',
  `used_time` int(10) DEFAULT '0' COMMENT '使用时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8;