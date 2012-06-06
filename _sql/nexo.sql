/*
Navicat MySQL Data Transfer

Source Server         : AsfoDB
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : nexo

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2012-06-02 16:27:17
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `nexo_configs`
-- ----------------------------
DROP TABLE IF EXISTS `nexo_configs`;
CREATE TABLE `nexo_configs` (
  `option_id` bigint(20) NOT NULL,
  `option_name` varchar(64) NOT NULL,
  `option_value` longtext NOT NULL,
  `description` text,
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nexo_configs
-- ----------------------------

-- ----------------------------
-- Table structure for `nexo_custom_pages`
-- ----------------------------
DROP TABLE IF EXISTS `nexo_custom_pages`;
CREATE TABLE `nexo_custom_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `uri` varchar(128) NOT NULL,
  `special_content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of nexo_custom_pages
-- ----------------------------
INSERT INTO nexo_custom_pages VALUES ('1', 'How to connect', 'This is the how to connect guide!...You can edit it from the admin panel', 'how_to_connect', null);

-- ----------------------------
-- Table structure for `nexo_news`
-- ----------------------------
DROP TABLE IF EXISTS `nexo_news`;
CREATE TABLE `nexo_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(128) NOT NULL,
  `date` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of nexo_news
-- ----------------------------
INSERT INTO nexo_news VALUES ('1', 'Testing', 'Sabeeeee<br />\r\nTesting 2', 'Drakantas', '1338232758');
INSERT INTO nexo_news VALUES ('2', 'Sabroso', 'I love your mum.', 'Drakantas', '1338232759');

-- ----------------------------
-- Table structure for `nexo_template`
-- ----------------------------
DROP TABLE IF EXISTS `nexo_template`;
CREATE TABLE `nexo_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `installed` int(3) NOT NULL DEFAULT '0',
  `active` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of nexo_template
-- ----------------------------
INSERT INTO nexo_template VALUES ('1', '', '1', '1');
