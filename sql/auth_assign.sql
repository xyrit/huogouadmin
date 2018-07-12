DROP TABLE IF EXISTS `auth_assign`;
CREATE TABLE `auth_assign` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` VARCHAR(64) NOT NULL COMMENT '后台id',
  `data` text,
  `created_at` INT(10) UNSIGNED NOT NULL ,
  `updated_at` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY `id` (`id`, `admin_id`),
  UNIQUE KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员授权表';