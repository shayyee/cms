/*
Navicat MySQL Data Transfer

Source Server         : xxy
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : cms

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2017-05-10 19:03:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cms_admin`
-- ----------------------------
DROP TABLE IF EXISTS `cms_admin`;
CREATE TABLE `cms_admin` (
  `admin_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` varchar(15) DEFAULT NULL,
  `lastlogintime` int(10) unsigned DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `realname` varchar(50) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_admin
-- ----------------------------
INSERT INTO `cms_admin` VALUES ('1', 'admin', 'd8ebd039c16d867c2b9b62f47399fa08', '127.0.0.1', '1493165082', 'xxy1024235202@163.com', '许香奕', '1');
INSERT INTO `cms_admin` VALUES ('2', 'admin1', 'd8ebd039c16d867c2b9b62f47399fa08', '127.0.0.1', '1492243926', null, 'shayyee', '1');

-- ----------------------------
-- Table structure for `cms_bucket`
-- ----------------------------
DROP TABLE IF EXISTS `cms_bucket`;
CREATE TABLE `cms_bucket` (
  `bucket_id` int(11) NOT NULL AUTO_INCREMENT,
  `bucketname` varchar(20) NOT NULL,
  `endpoint` varchar(100) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`bucket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_bucket
-- ----------------------------
INSERT INTO `cms_bucket` VALUES ('1', 'shayyee1', 'oss-cn-shanghai.aliyuncs.com', '6');
INSERT INTO `cms_bucket` VALUES ('2', 'shayyee2', 'oss-cn-qingdao.aliyuncs.com', '5');
INSERT INTO `cms_bucket` VALUES ('3', 'shayyee3', 'oss-cn-beijing.aliyuncs.com', '2');
INSERT INTO `cms_bucket` VALUES ('4', 'shayyee4', 'oss-cn-hangzhou.aliyuncs.com', '7');
INSERT INTO `cms_bucket` VALUES ('5', 'shayyee5', 'oss-cn-zhangjiakou.aliyuncs.com', '1');
INSERT INTO `cms_bucket` VALUES ('6', 'shayyee6', 'oss-cn-hongkong.aliyuncs.com', '3');
INSERT INTO `cms_bucket` VALUES ('7', 'shayyee7', 'oss-cn-shenzhen.aliyuncs.com', '4');

-- ----------------------------
-- Table structure for `cms_class`
-- ----------------------------
DROP TABLE IF EXISTS `cms_class`;
CREATE TABLE `cms_class` (
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `issue` tinyint(4) NOT NULL,
  `classname` varchar(50) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `name` (`classname`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_class
-- ----------------------------
INSERT INTO `cms_class` VALUES ('1', '0', 'C语言程序设计(111111)-2017年春', '1');

-- ----------------------------
-- Table structure for `cms_config`
-- ----------------------------
DROP TABLE IF EXISTS `cms_config`;
CREATE TABLE `cms_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_id` varchar(25) NOT NULL,
  `key_secret` varchar(50) NOT NULL,
  `end_point` varchar(100) NOT NULL,
  `bucket` varchar(25) NOT NULL,
  `avatar` varchar(25) DEFAULT NULL,
  `homework` varchar(25) DEFAULT NULL,
  `share` varchar(25) DEFAULT NULL,
  `upload` varchar(25) DEFAULT NULL,
  `pagesize` tinyint(4) NOT NULL,
  `slb` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_config
-- ----------------------------
INSERT INTO `cms_config` VALUES ('1', 'LTAIDEA9Usu0tbjx', 'fCJcflBD9V75S81QdmNCT4xA3ap8wv', 'oss-cn-hangzhou.aliyuncs.com', 'shayyee', 'avatar', 'homework', 'share', 'Uploads', '4', '1');

-- ----------------------------
-- Table structure for `cms_course`
-- ----------------------------
DROP TABLE IF EXISTS `cms_course`;
CREATE TABLE `cms_course` (
  `course_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cno` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `t_id` int(11) NOT NULL,
  `picpath` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  UNIQUE KEY `cno` (`cno`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_course
-- ----------------------------
INSERT INTO `cms_course` VALUES ('1', '111111', 'C语言程序设计', '1', 'http://shayyee.oss-cn-hangzhou.aliyuncs.com/Uploads/avatar/20170415142142.png?OSSAccessKeyId=LTAIDEA9Usu0tbjx&Expires=159172237302&Signature=DOYoNyoqK29Y5TReIGUMvJG4Hsg%3D');

-- ----------------------------
-- Table structure for `cms_donehw`
-- ----------------------------
DROP TABLE IF EXISTS `cms_donehw`;
CREATE TABLE `cms_donehw` (
  `dhw_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `hw_id` int(11) NOT NULL,
  `path` varchar(300) NOT NULL,
  `content` text,
  `score` float DEFAULT NULL,
  `comment` text,
  `updatetime` datetime NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否批改',
  PRIMARY KEY (`dhw_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_donehw
-- ----------------------------
INSERT INTO `cms_donehw` VALUES ('1', '1', '1', 'http://shayyee4.oss-cn-hangzhou.aliyuncs.com/Uploads/homework/20170419103025.sql?OSSAccessKeyId=LTAIDEA9Usu0tbjx&Expires=159172569026&Signature=bYbJFz7t0cZ%2BNz5tgHMCR1rtyNo%3D', '<p>\r\n	#include<stdio.h></stdio.h>\r\n</p>\r\n<p>\r\n	int main()\r\n</p>\r\n<p>\r\n	{\r\n</p>\r\n<p>\r\n	int sal,pro;\r\n</p>\r\n<p>\r\n	sal = 2100;\r\n</p>\r\n<p>\r\n	pro = 1400;\r\n</p>\r\n<p>\r\n	sal = sal + pro;\r\n</p>\r\n<p>\r\n	printf(\"Salary = %d\\n\",sal);\r\n</p>\r\n<p>\r\n	return 0;\r\n</p>\r\n<p>\r\n	}\r\n</p>\r\n<p>\r\n	C语言文件见附件\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', '95', 'Excellent', '2017-04-19 10:30:27', '1');
INSERT INTO `cms_donehw` VALUES ('4', '1', '2', 'http://shayyee4.oss-cn-hangzhou.aliyuncs.com/Uploads/homework/20170417003309.doc?OSSAccessKeyId=LTAIDEA9Usu0tbjx&Expires=159172360390&Signature=pJp7NkaC%2FcfQ7kiHI80wynIPOBg%3D', 'C语言是一种通用、过程化的编程语言，具有灵活、执行高效、功能丰富、表达力强和跨平台等特点。', '91.5', '', '2017-04-17 00:33:15', '1');
INSERT INTO `cms_donehw` VALUES ('5', '1', '5', 'http://shayyee1.oss-cn-shanghai.aliyuncs.com/Uploads/homework/20170422170831.rar?OSSAccessKeyId=LTAIDEA9Usu0tbjx&Expires=159172852138&Signature=h0t3ptISj5HbrgsI5GeL5G7%2F4tw%3D', 'laji', null, null, '2017-04-22 17:09:03', '0');

-- ----------------------------
-- Table structure for `cms_homework`
-- ----------------------------
DROP TABLE IF EXISTS `cms_homework`;
CREATE TABLE `cms_homework` (
  `hw_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text,
  `t_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `endtime` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`hw_id`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_homework
-- ----------------------------
INSERT INTO `cms_homework` VALUES ('1', '第一章作业', '<p>\r\n	<span style=\"font-size:14px;\">根据以下要求编写符合要求的C语言代码。</span>\r\n</p>\r\n<p>\r\n	<span style=\"font-size:14px;\">计算月收入。某小型外贸公司员工的月收入的计算方法为：月基本工资家当月提成。请编写编写程序</span><span style=\"font-size:14px;background-color:#FFE500;\">计算月收入</span><span style=\"font-size:14px;\">。</span>\r\n</p>', '1', '1', '1492660800', '1492237373');
INSERT INTO `cms_homework` VALUES ('2', '第二章作业', '简述C语言的特点', '1', '1', '1492444800', '1492325713');
INSERT INTO `cms_homework` VALUES ('3', '第三章作业', '大小写转换。写一段程序将输入放入大写字母转化成小写字母输出，其他字符则原样输出。', '1', '1', '1493388000', '1492325812');
INSERT INTO `cms_homework` VALUES ('5', '第四章作业', '<span style=\"font-size:14px;\">计算100以内所有的素数，并以每行10个的形式输出。</span>', '1', '1', '1493308800', '1492569359');

-- ----------------------------
-- Table structure for `cms_issue`
-- ----------------------------
DROP TABLE IF EXISTS `cms_issue`;
CREATE TABLE `cms_issue` (
  `iid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `issue` varchar(20) NOT NULL,
  PRIMARY KEY (`iid`),
  UNIQUE KEY `issue` (`issue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_issue
-- ----------------------------

-- ----------------------------
-- Table structure for `cms_my_hw`
-- ----------------------------
DROP TABLE IF EXISTS `cms_my_hw`;
CREATE TABLE `cms_my_hw` (
  `myhw_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `hw_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`myhw_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_my_hw
-- ----------------------------
INSERT INTO `cms_my_hw` VALUES ('1', '1', '1', '1');
INSERT INTO `cms_my_hw` VALUES ('2', '2', '1', '1');
INSERT INTO `cms_my_hw` VALUES ('3', '1', '2', '1');
INSERT INTO `cms_my_hw` VALUES ('4', '2', '2', '0');
INSERT INTO `cms_my_hw` VALUES ('5', '1', '3', '0');
INSERT INTO `cms_my_hw` VALUES ('6', '2', '3', '1');
INSERT INTO `cms_my_hw` VALUES ('10', '2', '5', '0');
INSERT INTO `cms_my_hw` VALUES ('9', '1', '5', '1');
INSERT INTO `cms_my_hw` VALUES ('11', '1', '6', '1');

-- ----------------------------
-- Table structure for `cms_share`
-- ----------------------------
DROP TABLE IF EXISTS `cms_share`;
CREATE TABLE `cms_share` (
  `share_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(20) NOT NULL,
  `path` varchar(500) NOT NULL,
  `author` int(11) NOT NULL,
  `size` varchar(20) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`share_id`),
  KEY `name` (`filename`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_share
-- ----------------------------
INSERT INTO `cms_share` VALUES ('1', '课件1', 'RequestCoreException: cURL resource: Resource id #46; cURL error: Could not resolve host: shayyee1.oss-cn-shanghai.aliyuncs.com (6)', '1', '16487', '2017-04-26 08:13:41', '1', '1');

-- ----------------------------
-- Table structure for `cms_student`
-- ----------------------------
DROP TABLE IF EXISTS `cms_student`;
CREATE TABLE `cms_student` (
  `s_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sno` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `firstlogindate` date NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_student
-- ----------------------------
INSERT INTO `cms_student` VALUES ('1', '136331111', 'd8ebd039c16d867c2b9b62f47399fa08', '许多', '2017-04-15');

-- ----------------------------
-- Table structure for `cms_s_c`
-- ----------------------------
DROP TABLE IF EXISTS `cms_s_c`;
CREATE TABLE `cms_s_c` (
  `sc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_s_c
-- ----------------------------
INSERT INTO `cms_s_c` VALUES ('1', '1', '1');

-- ----------------------------
-- Table structure for `cms_teacher`
-- ----------------------------
DROP TABLE IF EXISTS `cms_teacher`;
CREATE TABLE `cms_teacher` (
  `t_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `college` varchar(30) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`t_id`),
  KEY `username` (`username`),
  KEY `realname` (`realname`),
  KEY `college` (`college`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_teacher
-- ----------------------------
INSERT INTO `cms_teacher` VALUES ('1', '1011', 'd8ebd039c16d867c2b9b62f47399fa08', '袁腾飞', '信息学院', '362978154');
