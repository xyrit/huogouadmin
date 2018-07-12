CREATE TABLE `backstage_log` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` INT(10) UNSIGNED NOT NULL COMMENT '操作人id',
  `module` TINYINT(1) NOT NULL COMMENT '操作模块',
  `content` VARCHAR(255)  NOT NULL DEFAULT '' COMMENT '内容',
  `created_at` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  UNIQUE KEY `idx_admin_id` (`admin_id`, `created_at`)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT='后台操作日志';