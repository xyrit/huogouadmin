CREATE TABLE `products` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `bn` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '商品编号',
  `barcode` VARCHAR(25) NOT NULL DEFAULT '' COMMENT '商品条形码',
  `name` VARCHAR(255) NOT NULL COMMENT '商品名称',
  `price` INT(10) UNSIGNED NOT NULL COMMENT '商品价格',
  `marketable` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '上架下架，0=下架，1=上架',
  `cost` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品成本价格',
  `cat_id` INT(10) UNSIGNED NOT NULL COMMENT '商品分类ID',
  `brand_id` INT(10) UNSIGNED NOT NULL COMMENT '商品品牌ID',
  `delivery_id` INT(10) UNSIGNED NOT NULL COMMENT '发货方式ID',
  `order_manage_gid` INT(10) UNSIGNED NOT NULL COMMENT '订单处理小组ID',
  `store` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存(伙购期数)',
  `limit_num` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '限购数量,0为不限购',
  `allow_share` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否允许晒单',
  `is_recommend` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否热门推荐',
  `list_order` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `brief` VARCHAR(255) DEFAULT '' COMMENT '商品简介',
  `intro` LONGTEXT COMMENT '详细介绍',
  `picture` VARCHAR(255) NOT NULL COMMENT '封面图,带后缀的图片名',
  `tag` VARCHAR(255) DEFAULT '' COMMENT '标签',
  `keywords` VARCHAR(255) DEFAULT '' COMMENT '关键字',
  `created_at` INT(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `updated_at` INT(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `admin_id` INT(10) UNSIGNED COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';