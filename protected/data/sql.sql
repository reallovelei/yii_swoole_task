CREATE TABLE `task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `event` varchar(255) DEFAULT '',
  `param` text,
    `retry_cnt` tinyint(4) DEFAULT '1' COMMENT '重试次数',
  `is_success` int(11) DEFAULT '0' COMMENT '是否成功',
    `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
