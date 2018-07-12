CREATE TABLE `coupon_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `desc` varchar(200) NOT NULL DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `coupon_type` WRITE;
/*!40000 ALTER TABLE `coupon_type` DISABLE KEYS */;

INSERT INTO `coupon_type` (`id`, `name`, `desc`)
VALUES
	(1,'代金券','代金券'),
	(2,'折扣券','折扣券'),
	(3,'礼品券','礼品券');