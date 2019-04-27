
DROP TABLE IF EXISTS `demo`;
CREATE TABLE `demo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,

  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0未删除，非0为删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
