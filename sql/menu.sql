DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` INT(10) UNSIGNED NOT NULL  COMMENT '父类别ID',
  `name` VARCHAR(100) NOT NULL COMMENT '菜单名',
  `route` INT(11) UNSIGNED NOT NULL COMMENT '路由id',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态',
  `order` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `updated_at` INT(10) UNSIGNED NOT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `route` (`route`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='导航菜单表';