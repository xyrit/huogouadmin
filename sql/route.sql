DROP TABLE IF EXISTS `route`;
CREATE TABLE `route` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(64) NOT NULL COMMENT 'url地址',
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='路由表';