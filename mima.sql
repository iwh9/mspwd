/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : mima

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-08-19 00:49:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `m_admin`
-- ----------------------------
DROP TABLE IF EXISTS `m_admin`;
CREATE TABLE `m_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT '/public/admin/assets/images/users/avatar-1.jpg',
  `is_all` int(2) DEFAULT '1' COMMENT '0为全部查看1为隐私查看',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_admin
-- ----------------------------
INSERT INTO `m_admin` VALUES ('1', '123456', 'e10adc3949ba59abbe56e057f20f883e', '默笙', '/public/admin/assets/images/users/avatar-1.jpg', '0');
INSERT INTO `m_admin` VALUES ('2', 'test123', '098f6bcd4621d373cade4e832627b4f6', '测试', '/public/admin/assets/images/users/avatar-1.jpg', '0');

-- ----------------------------
-- Table structure for `m_class`
-- ----------------------------
DROP TABLE IF EXISTS `m_class`;
CREATE TABLE `m_class` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `cname` varchar(255) DEFAULT NULL,
  `create_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_class
-- ----------------------------
INSERT INTO `m_class` VALUES ('1', '未分类', '1534474551');
INSERT INTO `m_class` VALUES ('2', '论坛账号', '1534474551');
INSERT INTO `m_class` VALUES ('3', '公司账号', '1534474551');
INSERT INTO `m_class` VALUES ('4', '私人账号', '1534474551');
INSERT INTO `m_class` VALUES ('6', '论坛BBS', '1534558493');

-- ----------------------------
-- Table structure for `m_config`
-- ----------------------------
DROP TABLE IF EXISTS `m_config`;
CREATE TABLE `m_config` (
  `id` int(2) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `temple` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_config
-- ----------------------------
INSERT INTO `m_config` VALUES ('1', '193403647300920548ebf73c039129bc', 'index/index');

-- ----------------------------
-- Table structure for `m_loginep`
-- ----------------------------
DROP TABLE IF EXISTS `m_loginep`;
CREATE TABLE `m_loginep` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_loginep
-- ----------------------------
INSERT INTO `m_loginep` VALUES ('1', '1', '默笙', '127.0.0.1', '1517535965');
INSERT INTO `m_loginep` VALUES ('2', '1', '默笙', '127.0.0.1', '1534573713');
INSERT INTO `m_loginep` VALUES ('3', '1', '默笙', '127.0.0.1', '1534590690');
INSERT INTO `m_loginep` VALUES ('4', '1', '默笙', '127.0.0.1', '1534593713');
INSERT INTO `m_loginep` VALUES ('5', '1', '默笙', '127.0.0.1', '1534593772');
INSERT INTO `m_loginep` VALUES ('6', '1', '默笙', '127.0.0.1', '1534593788');
INSERT INTO `m_loginep` VALUES ('7', '1', '默笙', '127.0.0.1', '1534596545');
INSERT INTO `m_loginep` VALUES ('8', '1', '默笙', '127.0.0.1', '1534603811');
INSERT INTO `m_loginep` VALUES ('9', '1', '默笙', '127.0.0.1', '1534604064');
INSERT INTO `m_loginep` VALUES ('10', '1', '默笙', '127.0.0.1', '1534604274');
INSERT INTO `m_loginep` VALUES ('11', '2', '测试', '127.0.0.1', '1534605579');

-- ----------------------------
-- Table structure for `m_pass`
-- ----------------------------
DROP TABLE IF EXISTS `m_pass`;
CREATE TABLE `m_pass` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `cid` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `sfdel` int(10) DEFAULT '0',
  `adress` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_pass
-- ----------------------------
INSERT INTO `m_pass` VALUES ('3', '1', '123456', '654321', '1524465230', '0', 'www.tecms.net', null, null, '这是一个备注');
INSERT INTO `m_pass` VALUES ('2', '1', '123456123', '123456', '1517535965', '1', 'www.tecms.net', '', '', '这是一个备注');
INSERT INTO `m_pass` VALUES ('4', '1', '1235', '123', '1524534729', '0', 'www.tecms.net', '123', '123', '132');
INSERT INTO `m_pass` VALUES ('5', '3', '123', '132', '1524534745', '0', 'www.tecms.net', '132', '132', '123');
INSERT INTO `m_pass` VALUES ('6', '1', 'ceshizhanghao', 'ceshizhanghao', null, '0', 'www.tecms.net', null, null, '这是一个备注');
INSERT INTO `m_pass` VALUES ('8', '1', '123456', '123456', '1534413974', '0', 'www.tecms.net', null, null, '这是一个备注');
INSERT INTO `m_pass` VALUES ('9', '1', '123456', '123456', '1534586247', '0', '123456', '123456', '123456', '123456');

-- ----------------------------
-- Table structure for `m_system`
-- ----------------------------
DROP TABLE IF EXISTS `m_system`;
CREATE TABLE `m_system` (
  `id` int(1) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `ftitle` varchar(255) DEFAULT NULL,
  `beian` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `descc` varchar(255) DEFAULT NULL,
  `is_inex` int(2) DEFAULT '0' COMMENT '0为关闭1为开启',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_system
-- ----------------------------
INSERT INTO `m_system` VALUES ('1', '默笙密码管理系统 www.tecms.net', 'Copyright ©2018 河南默笙科技网络有限公司 All Rights Reserved. ', '京ICP备1000000号', '密码系统,安全密码管理,账户管理系统,信息管理系统,密码安全系统', '默笙密码管理系统是由\'默笙\'自主开发的密码管理系统哦', '0');

-- ----------------------------
-- Table structure for `m_temple`
-- ----------------------------
DROP TABLE IF EXISTS `m_temple`;
CREATE TABLE `m_temple` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `templename` varchar(255) DEFAULT NULL,
  `templeimg` varchar(255) DEFAULT NULL,
  `templeurl` varchar(255) DEFAULT NULL,
  `templeclass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_temple
-- ----------------------------
INSERT INTO `m_temple` VALUES ('1', '默认主题', '/public/admin/temple/defulttempleimg.jpg', 'index/index', 'ribbon ribbon-dark');
INSERT INTO `m_temple` VALUES ('2', 'Bt快速新增', '/public/admin/temple/mstpl.jpg', 'mstpl/pages-login', 'ribbon ribbon-primary');

-- ----------------------------
-- Table structure for `m_visit`
-- ----------------------------
DROP TABLE IF EXISTS `m_visit`;
CREATE TABLE `m_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_visit
-- ----------------------------
INSERT INTO `m_visit` VALUES ('1', '127.0.0.1', '1514441643');
INSERT INTO `m_visit` VALUES ('2', '127.0.0.1', '1514441686');
INSERT INTO `m_visit` VALUES ('3', '127.0.0.1', '1514645297');
INSERT INTO `m_visit` VALUES ('4', '127.0.0.1', '1534404229');
INSERT INTO `m_visit` VALUES ('5', '127.0.0.1', '1534404260');
INSERT INTO `m_visit` VALUES ('6', '127.0.0.1', '1534404521');
INSERT INTO `m_visit` VALUES ('7', '127.0.0.1', '1534404560');
INSERT INTO `m_visit` VALUES ('8', '127.0.0.1', '1534404567');
INSERT INTO `m_visit` VALUES ('9', '127.0.0.1', '1534404599');
INSERT INTO `m_visit` VALUES ('10', '127.0.0.1', '1534404713');
INSERT INTO `m_visit` VALUES ('11', '127.0.0.1', '1534405112');
INSERT INTO `m_visit` VALUES ('12', '127.0.0.1', '1534411922');
