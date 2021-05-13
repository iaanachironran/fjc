/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50717
Source Host           : 127.0.0.1:3306
Source Database       : news

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2018-03-08 21:21:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'yetong', '46f30cde848a4ada165205475015cf78');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `a_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `uname` varchar(20) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `c_time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('8', '1', '3', '青石渔者', '杨欢杨欢欢', '1519975341');
INSERT INTO `comment` VALUES ('9', '1', '3', '青石渔者', '这是啥', '1519976782');
INSERT INTO `comment` VALUES ('10', '1', '3', '青石渔者', '阿斯顿发士大夫', '1519976885');
INSERT INTO `comment` VALUES ('11', '1', '3', '青石渔者', '阿斯顿发士大夫', null);
INSERT INTO `comment` VALUES ('12', '1', '3', '青石渔者', 'sdfasdf', null);
INSERT INTO `comment` VALUES ('13', '1', '3', '青石渔者', 'dddddddddddddd', null);
INSERT INTO `comment` VALUES ('14', '1', '3', '青石渔者', 'asdfa', null);
INSERT INTO `comment` VALUES ('15', '1', '3', '青石渔者', 'adsf', null);
INSERT INTO `comment` VALUES ('16', '1', '3', '青石渔者', 'afds', null);
INSERT INTO `comment` VALUES ('17', '1', '3', '青石渔者', 'afdsas', null);
INSERT INTO `comment` VALUES ('18', '2', '3', '青石渔者', 'asf', null);
INSERT INTO `comment` VALUES ('19', '16', '3', '青石渔者', '我怎么知道', null);
INSERT INTO `comment` VALUES ('20', '4', '3', '青石渔者', '我怎么知道', null);

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `content` text,
  `status` enum('-1','0') DEFAULT '0' COMMENT '0:默认, 1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', 'dfg', 'df', 'sdfg', '-1');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '新闻标题',
  `img` varchar(255) DEFAULT NULL COMMENT '展示图路径',
  `content` text COMMENT '详情',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间/更新时间',
  `publish_time` int(11) unsigned DEFAULT NULL COMMENT '发布时间',
  `status` enum('-1','1','0') DEFAULT '0' COMMENT '0:待审查(未发布), 1:发布中; -1:删除/关闭',
  `clicked` int(10) unsigned DEFAULT '0' COMMENT '点击率',
  `praise` int(10) unsigned DEFAULT '0' COMMENT '点赞量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', '为什么前端工程师多不愿意用 Bootstrap 框架？15', null, '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(36, 41, 46); font-family: -apple-system, BlinkMacSystemFont, 微软雅黑, &quot;PingFang SC&quot;, Helvetica, Tahoma, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, 宋体, Heiti, 黑体, sans-serif; font-size: 14px; white-space: normal;\">本文通过设置&nbsp;<span style=\"box-sizing: border-box; font-weight: 600;\">Access-Control-Allow-Origin</span>&nbsp;来实现跨域。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(36, 41, 46); font-family: -apple-system, BlinkMacSystemFont, 微软雅黑, &quot;PingFang SC&quot;, Helvetica, Tahoma, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, 宋体, Heiti, 黑体, sans-serif; font-size: 14px; white-space: normal;\">例如：<a href=\"http://xn--client-2h6jl6wv5ip7qnjkom3cc9l.runoob.com/\" style=\"box-sizing: border-box; color: rgb(3, 102, 214); text-decoration-line: none;\">客户端的域名是client.runoob.com</a>，<a href=\"http://xn--server-2h6jl6why8ahymlt0aslzil8a.runoob.com/\" style=\"box-sizing: border-box; color: rgb(3, 102, 214); text-decoration-line: none;\">而请求的域名是server.runoob.com</a>。</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(36, 41, 46); font-family: -apple-system, BlinkMacSystemFont, 微软雅黑, &quot;PingFang SC&quot;, Helvetica, Tahoma, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, 宋体, Heiti, 黑体, sans-serif; font-size: 14px; white-space: normal;\">如果直接使用ajax访问，会有以下错误：</p><pre style=\"box-sizing: border-box; font-family: SFMono-Regular, Consolas, &quot;Liberation Mono&quot;, Menlo, Courier, monospace; font-size: 11.9px; margin-top: 0px; margin-bottom: 16px; font-stretch: normal; line-height: 1.45; word-wrap: normal; padding: 16px; overflow: auto; background-color: rgb(246, 248, 250); border-radius: 3px; color: rgb(36, 41, 46);\">XMLHttpRequest&nbsp;cannot&nbsp;load&nbsp;http://server.runoob.com/server.php.&nbsp;\nNo&nbsp;&#39;Access-Control-Allow-Origin&#39;&nbsp;header&nbsp;is&nbsp;present&nbsp;on&nbsp;the&nbsp;requested&nbsp;resource.\nOrigin&nbsp;&#39;http://client.runoob.com&#39;&nbsp;is&nbsp;therefore&nbsp;not&nbsp;allowed&nbsp;access.</pre><h4 style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 16px; font-size: 1.25em; line-height: 1.25; color: rgb(36, 41, 46); font-family: -apple-system, BlinkMacSystemFont, 微软雅黑, &quot;PingFang SC&quot;, Helvetica, Tahoma, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, 宋体, Heiti, 黑体, sans-serif; white-space: normal;\"><a class=\"markdownIt-Anchor\" href=\"https://note.youdao.com/md/preview/preview.html?file=%2Fyws%2Fapi%2Fpersonal%2Ffile%2FD2C2FCB3B6064571825A289FA82EF1CA%3Fmethod%3Ddownload%26read%3Dtrue%26shareKey%3Dcbf1312b340d1f2bef8afafd9b1a312c#1-允许单个域名访问\" style=\"box-sizing: border-box; color: rgb(3, 102, 214); text-decoration-line: none;\"></a>1、允许单个域名访问</h4><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(36, 41, 46); font-family: -apple-system, BlinkMacSystemFont, 微软雅黑, &quot;PingFang SC&quot;, Helvetica, Tahoma, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, 宋体, Heiti, 黑体, sans-serif; font-size: 14px; white-space: normal;\">指定某域名（<a href=\"http://client.runoob.com/\" style=\"box-sizing: border-box; color: rgb(3, 102, 214); text-decoration-line: none;\">http://client.runoob.com</a>）跨域访问，则只需在http://server.runoob.com/server.php文件头部添加如下代码：</p><pre style=\"box-sizing: border-box; font-family: SFMono-Regular, Consolas, &quot;Liberation Mono&quot;, Menlo, Courier, monospace; font-size: 11.9px; margin-top: 0px; margin-bottom: 16px; font-stretch: normal; line-height: 1.45; word-wrap: normal; padding: 16px; overflow: auto; background-color: rgb(246, 248, 250); border-radius: 3px; color: rgb(36, 41, 46);\">header(&#39;Access-Control-Allow-Origin:http://client.runoob.com&#39;);</pre><h4 style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 16px; font-size: 1.25em; line-height: 1.25; color: rgb(36, 41, 46); font-family: -apple-system, BlinkMacSystemFont, 微软雅黑, &quot;PingFang SC&quot;, Helvetica, Tahoma, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, 宋体, Heiti, 黑体, sans-serif; white-space: normal;\"><a class=\"markdownIt-Anchor\" href=\"https://note.youdao.com/md/preview/preview.html?file=%2Fyws%2Fapi%2Fpersonal%2Ffile%2FD2C2FCB3B6064571825A289FA82EF1CA%3Fmethod%3Ddownload%26read%3Dtrue%26shareKey%3Dcbf1312b340d1f2bef8afafd9b1a312c#2-允许多个域名访问\" style=\"box-sizing: border-box; color: rgb(3, 102, 214); text-decoration-line: none;\"></a>2、允许多个域名访问</h4><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(36, 41, 46); font-family: -apple-system, BlinkMacSystemFont, 微软雅黑, &quot;PingFang SC&quot;, Helvetica, Tahoma, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, 宋体, Heiti, 黑体, sans-serif; font-size: 14px; white-space: normal;\">指定多个域名（<a href=\"http://client1.runoob.com/\" style=\"box-sizing: border-box; color: rgb(3, 102, 214); text-decoration-line: none;\">http://client1.runoob.com</a>、<a href=\"http://client2.runoob.xn--com-pw6h/\" style=\"box-sizing: border-box; color: rgb(3, 102, 214); text-decoration-line: none;\">http://client2.runoob.com等</a>）跨域访问，则只需在http://server.runoob.com/server.php文件头部添加如下代码：</p><pre style=\"box-sizing: border-box; font-family: SFMono-Regular, Consolas, &quot;Liberation Mono&quot;, Menlo, Courier, monospace; font-size: 11.9px; margin-top: 0px; margin-bottom: 16px; font-stretch: normal; line-height: 1.45; word-wrap: normal; padding: 16px; overflow: auto; background-color: rgb(246, 248, 250); border-radius: 3px; color: rgb(36, 41, 46);\">$origin&nbsp;=&nbsp;isset($_SERVER[&#39;HTTP_ORIGIN&#39;])?&nbsp;$_SERVER[&#39;HTTP_ORIGIN&#39;]&nbsp;:&nbsp;&#39;&#39;;&nbsp;&nbsp;\n&nbsp;&nbsp;\n$allow_origin&nbsp;=&nbsp;array(&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;http://client1.runoob.com&#39;,&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;http://client2.runoob.com&#39;&nbsp;&nbsp;);&nbsp;&nbsp;\n&nbsp;&nbsp;\nif(in_array($origin,&nbsp;$allow_origin)){&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;header(&#39;Access-Control-Allow-Origin:&#39;.$origin);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n}</pre><h4 style=\"box-sizing: border-box; margin-top: 24px; margin-bottom: 16px; font-size: 1.25em; line-height: 1.25; color: rgb(36, 41, 46); font-family: -apple-system, BlinkMacSystemFont, 微软雅黑, &quot;PingFang SC&quot;, Helvetica, Tahoma, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, 宋体, Heiti, 黑体, sans-serif; white-space: normal;\"><a class=\"markdownIt-Anchor\" href=\"https://note.youdao.com/md/preview/preview.html?file=%2Fyws%2Fapi%2Fpersonal%2Ffile%2FD2C2FCB3B6064571825A289FA82EF1CA%3Fmethod%3Ddownload%26read%3Dtrue%26shareKey%3Dcbf1312b340d1f2bef8afafd9b1a312c#3-允许所有域名访问\" style=\"box-sizing: border-box; color: rgb(3, 102, 214); text-decoration-line: none;\"></a>3、允许所有域名访问</h4><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 16px; color: rgb(36, 41, 46); font-family: -apple-system, BlinkMacSystemFont, 微软雅黑, &quot;PingFang SC&quot;, Helvetica, Tahoma, Arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, SimSun, 宋体, Heiti, 黑体, sans-serif; font-size: 14px; white-space: normal;\">允许所有域名访问则只需在http://server.runoob.com/server.php文件头部添加如下代码：</p><pre style=\"box-sizing: border-box; font-family: SFMono-Regular, Consolas, &quot;Liberation Mono&quot;, Menlo, Courier, monospace; font-size: 11.9px; margin-top: 0px; font-stretch: normal; line-height: 1.45; word-wrap: normal; padding: 16px; overflow: auto; background-color: rgb(246, 248, 250); border-radius: 3px; color: rgb(36, 41, 46); margin-bottom: 0px !important;\">header(&#39;Access-Control-Allow-Origin:*&#39;);</pre><p><br/></p>', '1519869163', '1519869166', '-1', '103', '2');
INSERT INTO `news` VALUES ('2', 'layui 更适合哪些开发者？16', null, 'halkshfaslfklf', '1519869263', '1519869266', '-1', '131', '4');
INSERT INTO `news` VALUES ('3', '贤心是男是女？', null, '<p>阿法士大夫</p>', '1520249344', '1519869366', '0', '0', '3');
INSERT INTO `news` VALUES ('4', '为什么前端工程师多不愿意用 Bootstrap 框架？1', null, null, '1519869163', '1519869166', '1', '6', '2');
INSERT INTO `news` VALUES ('5', '为什么前端工程师多不愿意用 Bootstrap 框架？2', null, null, '1519869163', '1519869166', '1', '5', '4');
INSERT INTO `news` VALUES ('6', '为什么前端工程师多不愿意用 Bootstrap 框架？3', null, null, '1519869163', '1519869166', '1', '5', '9');
INSERT INTO `news` VALUES ('7', '为什么前端工程师多不愿意用 Bootstrap 框架？4', null, null, '1519869163', '1519869166', '1', '3', '5');
INSERT INTO `news` VALUES ('8', '为什么前端工程师多不愿意用 Bootstrap 框架？5', null, null, '1519869163', '1519869166', '1', '260', '4');
INSERT INTO `news` VALUES ('9', '为什么前端工程师多不愿意用 Bootstrap 框架？6', null, null, '1519869163', '1519869166', '1', '3', '6');
INSERT INTO `news` VALUES ('10', '为什么前端工程师多不愿意用 Bootstrap 框架？7', null, null, '1519869163', '1519869166', '1', '3', '5');
INSERT INTO `news` VALUES ('11', '为什么前端工程师多不愿意用 Bootstrap 框架？8', null, null, '1519869163', '1519869166', '1', '3', '7');
INSERT INTO `news` VALUES ('12', '为什么前端工程师多不愿意用 Bootstrap 框架？9', null, null, '1519869163', '1519869166', '1', '3', '5');
INSERT INTO `news` VALUES ('13', '为什么前端工程师多不愿意用 Bootstrap 框架？10', null, null, '1519869163', '1519869166', '1', '3', '6');
INSERT INTO `news` VALUES ('14', '为什么前端工程师多不愿意用 Bootstrap 框架？11', null, null, '1519869163', '1519869166', '1', '3', '8');
INSERT INTO `news` VALUES ('15', '为什么前端工程师多不愿意用 Bootstrap 框架？12', null, null, '1519869163', '1519869166', '1', '3', '8');
INSERT INTO `news` VALUES ('16', '为什么前端工程师多不愿意用 Bootstrap 框架？13', null, null, '1519869163', '1519869166', '1', '801', '7');
INSERT INTO `news` VALUES ('17', '为什么前端工程师多不愿意用 Bootstrap 框架？17', null, null, '1519869163', '1519869166', '-1', '3', '9');
INSERT INTO `news` VALUES ('18', '为什么前端工程师多不愿意用 Bootstrap 框架？18', null, null, '1519869163', '1519869166', '-1', '3', '7');
INSERT INTO `news` VALUES ('19', '为什么前端工程师多不愿意用 Bootstrap 框架？19', null, null, '1519869163', '1519869166', '-1', '3', '22');
INSERT INTO `news` VALUES ('20', '特特殊14', null, '<p>你好啊好&nbsp;</p>', '1520251065', null, '1', '0', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `head_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', null, 'sdfasfas@11.com', '$2y$10$bk41KBha93nL36rcfa1fveDjvNZTNpdOtU4iwQrSBvwktiuvb6pXy', null);
INSERT INTO `user` VALUES ('3', '青石渔者', 'furhacker@163.com', '$2y$10$gI4JBwpjeJbKDknedLxLq.vylyehm7qTRk0hZpxPdaewfMc0kBaV2', null);
INSERT INTO `user` VALUES ('4', null, 'furhackeq@163.com', '$2y$10$cYcPEpSSu9YqmLngF2q0EuOfvp.p5r/CBOIOICXYv14RZQsmODvpG', null);
INSERT INTO `user` VALUES ('5', null, 'sdf@11.com', '$2y$10$waWPKaGUTA7BjpYLzSOojO2zaJudLbzIKcgnSLJc0QrfhPmJc1jIm', null);
INSERT INTO `user` VALUES ('6', 'yetong1', 'furhacker@hotmail.com', '$2y$10$wiSP5NTJa8D7WkcPZV8hCORiMJP2jaG16jFjVJtWuHwzKj8mcipk2', null);
INSERT INTO `user` VALUES ('7', 'nimei', 'nimei@163.com', '$2y$10$C/3IcRiinkbAajOwfSPcLOCv7dJEEfrgrRPbPchUoslqJ6N49dwAe', null);
