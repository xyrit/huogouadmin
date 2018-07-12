CREATE TABLE `user_coupons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `coupon_id` int(10) NOT NULL COMMENT '优惠券ID',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '优惠券码',
  `status` int(1) DEFAULT '0' COMMENT '状态，0-可用，1-已使用，2-失效，3-过期，4-冻结',
  `receive_time` int(10) NOT NULL COMMENT '领取时间',
  `used_time` int(10) DEFAULT '0' COMMENT '使用时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/* 下午1:59:07 dev */ ALTER TABLE `user_coupons` ADD `nums` INT(1)  NULL  DEFAULT '1'  COMMENT '张数'  AFTER `code`;
/* 下午2:30:47 dev */ ALTER TABLE `user_coupons` ADD `packet_id` INT(10)  NULL  DEFAULT '0'  COMMENT '红包ID'  AFTER `used_time`;