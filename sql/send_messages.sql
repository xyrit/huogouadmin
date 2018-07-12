CREATE TABLE `send_messages` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
	`user_id` INT(10) UNSIGNED NOT NULL COMMENT '用户ID',
	`content` TEXT NOT NULL COMMENT '发货消息内容',
	`type` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0实物，1虚拟',
	`view` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0未查看，1已查看',
	`admin_id` INT(10) NOT NULL COMMENT '发货人',
	`create_time` INT(10) UNSIGNED NOT NULL COMMENT '发货时间',
	PRIMARY KEY (`id`)
)
COMMENT='发货消息表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB

