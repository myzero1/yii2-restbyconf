/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : yii2advanced

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-10-31 10:13:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for z1_captcha
-- ----------------------------
DROP TABLE IF EXISTS `z1_captcha`;
CREATE TABLE `z1_captcha` (
  `id` bigint(20) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `used_times` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
