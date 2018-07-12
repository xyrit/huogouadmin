-- 2015-12-10
ALTER TABLE `share_topic_images`
ADD COLUMN `mobile`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否添加手机图' AFTER `basename`;


-- 2015-12-17
ALTER TABLE `users`
ADD COLUMN `reg_ip`  bigint(10) NOT NULL DEFAULT 0 COMMENT '注册ip' AFTER `protected_status`,
ADD COLUMN `reg_terminal`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '注册终端(1 pc  2 微信 3 ios  4 Android)' AFTER `reg_ip`;


-- 2015-12-18
ALTER TABLE `share_topic_images`
ADD COLUMN `recommend`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否推荐图' AFTER `mobile`,
ADD COLUMN `roll`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否滚动图' AFTER `recommend`,
ADD COLUMN `main`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否主图' AFTER `roll`;

-- 2015-12-18
ALTER TABLE `users` ADD `spread_source` VARCHAR(20)  NULL  DEFAULT NULL  COMMENT '推广来源'  AFTER `reg_terminal`;

-- 2015-12-29
ALTER TABLE `admin`
ADD COLUMN `privilege`  varchar(255) NOT NULL DEFAULT '' COMMENT '权限' AFTER `role`;

-- 2015-12-30
ALTER TABLE `menu`
ADD COLUMN `pass`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否需要验证' AFTER `route`;

-- 2016年6月23日 14:16:17
ALTER TABLE `admin`
ADD COLUMN `login_at` int NOT NULL DEFAULT 0 COMMENT '最近登录时间',
ADD COLUMN `login_ip` VARCHAR(18) NOT NULL DEFAULT '0.0.0.0' COMMENT '最近登录IP';

-- 2016年7月26日 19:16:17
ALTER TABLE `actives`
ADD COLUMN `min_ver` VARCHAR(10) NOT NULL DEFAULT '0' COMMENT '最低版本';

ALTER TABLE `jdcard_buyback_list` ADD action_log text COMMENT '操作记录';

--2016年8月1日 10:39:17

ALTER TABLE `virtual_depot_log` ADD order_id int(10) NOT NULL DEFAULT '0' COMMENT '订单id';
ALTER TABLE `virtual_depot_log` ADD cardno varchar(50) NOT NULL DEFAULT '' COMMENT '卡号';
ALTER TABLE `virtual_depot_log` ADD cardpws varchar(50) NOT NULL DEFAULT '' COMMENT '卡密';
ALTER TABLE `virtual_depot_log` ADD activity_id int(1) NOT NULL DEFAULT '0' COMMENT '活动id   0表示普通订单';

--2016年8月3日 18:30:26
ALTER TABLE `pk_orders` ADD deliver_adminid int(10) NOT NULL DEFAULT '0' COMMENT '发货人';
ALTER TABLE `pk_orders` ADD deliver_time int(10) NOT NULL DEFAULT '0' COMMENT '发货时间';