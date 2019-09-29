-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 年 09 月 28 日 15:43
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `test`
--
CREATE DATABASE `test_one` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test_one`;

-- --------------------------------------------------------

--
-- 表的结构 `tg_user`
--

CREATE TABLE IF NOT EXISTS `tg_user` (
  `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户自动编号',
  `tg_uniqid` char(40) CHARACTER SET utf8 NOT NULL COMMENT '验证身份的唯一标识符',
  `tg_active` char(40) CHARACTER SET utf8 NOT NULL COMMENT '激活登录用户',
  `tg_username` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '用户名',
  `tg_password` char(40) CHARACTER SET utf8 NOT NULL COMMENT '密码',
  `tg_question` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '密码提示',
  `tg_answer` char(40) CHARACTER SET utf8 NOT NULL COMMENT '密码回答',
  `tg_email` varchar(40) CHARACTER SET utf8 DEFAULT NULL COMMENT '邮箱',
  `tg_qq` varchar(11) CHARACTER SET utf8 DEFAULT NULL COMMENT 'qq号码',
  `tg_url` varchar(40) CHARACTER SET utf8 DEFAULT NULL COMMENT '网址',
  `tg_sex` char(1) CHARACTER SET utf8 NOT NULL COMMENT '性别',
  `tg_face` char(12) CHARACTER SET utf8 NOT NULL COMMENT '用户头偈',
  `tg_level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '会员等级',
  `tg_reg_time` datetime NOT NULL COMMENT '注册时间',
  `tg_last_time` datetime NOT NULL COMMENT '最后登录的时间',
  `tg_last_ip` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '最后一次登录的IP',
  `tg_login_count` smallint(4) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`tg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `tg_user`
--

INSERT INTO `tg_user` (`tg_id`, `tg_uniqid`, `tg_active`, `tg_username`, `tg_password`, `tg_question`, `tg_answer`, `tg_email`, `tg_qq`, `tg_url`, `tg_sex`, `tg_face`, `tg_level`, `tg_reg_time`, `tg_last_time`, `tg_last_ip`, `tg_login_count`) VALUES
(3, '', '', '药灵活', '', '', '', NULL, NULL, NULL, '', 'face/m27.gif', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0),
(4, 'fc6fcafbd239f22177a644d05b1df6f837c25a47', '996b87b67cdf80ccf52eef87c9a869cc9bb4d28b', '药灵1', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '123456789', 'http://www.hao9669.com', '男', 'face/m27.gif', 0, '2019-09-13 10:55:30', '2019-09-13 10:55:30', '::1', 0),
(5, 'be1262de17876f4b8e2daee910b64155514659aa', '5952a507b4d7f36f831eac5d5e289bf3ff5bf972', '药灵2', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '123456789', 'http://www.hao9669.com', '女', 'face/m27.gif', 0, '2019-09-13 10:57:40', '2019-09-13 10:57:40', '::1', 0),
(6, 'cf001b5bccff3c04afd7efc3b34d060e2a10c637', '8cd2efe57c0d7e043a50c5e368219ee89c3f3d24', '药灵2', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '123456789', 'http://www.hao9669.com', '女', 'face/m27.gif', 0, '2019-09-13 11:21:45', '2019-09-13 11:21:45', '::1', 0),
(7, 'cf001b5bccff3c04afd7efc3b34d060e2a10c637', 'f47b57dd3d4812a9e33b7a935bd468eda7d8a40d', '药灵2', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '123456789', 'http://www.hao9669.com', '女', 'face/m27.gif', 0, '2019-09-13 11:26:09', '2019-09-13 11:26:09', '::1', 0),
(8, '342489a8b8928a97e6fd12dc030cea5422c95800', '31f1d9d0c0e1a7af8c67f949794663a4575f1c96', 'root', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', '', '', '', '男', 'face/m27.gif', 0, '2019-09-13 11:38:32', '2019-09-13 11:38:32', '::1', 0),
(9, '273d6c8eafe89ad16299c587fbb554316e650a59', 'e85a179981d9005eae4f265c06a75eee6c9a3c23', 'yaoling11', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '123456', 'http://www.hao9669.com', '女', 'face/m27.gif', 0, '2019-09-13 12:56:07', '2019-09-13 12:56:07', '::1', 0),
(10, '45058c66e0e2ac3c0063894b1150eb1dbc7ff02b', 'a601efce4c2950169d7ca57f33fca62589b06b2d', 'yaoling111', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '', '', '女', 'face/m27.gif', 0, '2019-09-13 13:10:53', '2019-09-13 13:10:53', '::1', 0),
(11, '287490a5dd781b36f1074c05670bd2d4d78ee869', '41a0a680b6360e426aba429153ef9841fcf368e0', '123333', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', '', '', '', '男', 'face/m09.gif', 0, '2019-09-13 13:23:24', '2019-09-13 13:23:24', '::1', 0),
(12, '846b6beb7ce225bfda96295462198759264853b3', '38bbd110ae441f33532c4356e38e89cdbac759ea', '123333123', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', '', '', '', '男', 'face/m27.gif', 0, '2019-09-13 13:23:52', '2019-09-13 13:23:52', '::1', 0),
(13, 'bef04552e88f7db21a866cbf980a0bf8c7a0b020', '7e133849d295ba3246c027e0625b70a0068d3085', '12333312312345678', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', '', '', '', '男', 'face/m27.gif', 0, '2019-09-13 13:53:04', '2019-09-13 13:53:04', '::1', 0),
(14, '546d88d8ea58214e25caf76f2569173beab8ac08', '52514a1fdf88741fdc285c9e10f9e9c3ab1ae0f1', '瓶子小66', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '123456', 'http://www.hao9669.com', '男', 'face/m09.gif', 0, '2019-09-13 13:54:06', '2019-09-13 13:54:06', '::1', 0),
(15, '71ead9dc9e9b53ce39bb402c4fb271100271969a', '86ac43cf3d8aca0fbe45c692763866ec4ee6bfdc', '112211', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', '', '', '', '男', 'face/m27.gif', 0, '2019-09-13 14:01:58', '2019-09-13 14:01:58', '::1', 0),
(16, 'a885db1878ac3988a13d0d6227e6e6203463a9ad', '6dab8cb471d5d25255799de893912863edfaaca6', 'hao', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', '', '', '', '男', 'face/m09.gif', 0, '2019-09-13 14:03:49', '2019-09-13 14:03:49', '::1', 0),
(17, '4140866b5a8f565df3025b589546990f28d1a5b8', 'a179f6d021b866c8aa60b4d09bda1f75681b8ce5', '56', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', '24356@qq.com', '', '', '女', 'face/m27.gif', 0, '2019-09-13 18:16:55', '2019-09-13 18:16:55', '::1', 0),
(18, 'd4eb05aba848e5023b60fb258d011f5817a0afaa', '44ada128bcbc805eb91a3fe6fc284348d863e9b6', 'eqwe', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '', '', '男', 'face/m27.gif', 0, '2019-09-13 18:26:52', '2019-09-13 18:26:52', '::1', 0),
(19, '25a060a0cf56194f0e1e6f8d85ec79e8aaed25b0', 'd8fe318233e460e11a64263e4492e2e58f59ee3b', '1234', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '123456', 'http://hao9669.com', '男', 'face/m27.gif', 0, '2019-09-13 18:39:05', '2019-09-13 18:39:05', '::1', 0),
(20, 'da4bda7402677f87d4f862c3bb09951675d06d11', '34d677ec0ba22b81be1862e11176f9f920f11650', '123466', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '', '', '男', 'face/m27.gif', 0, '2019-09-13 18:40:51', '2019-09-13 18:40:51', '::1', 0),
(21, '918ff2de84fd15eb4d853614ea4d5a86c6e3866e', '099c6b5999bf0863136a1e0a4fccb11c71c4609a', '1234666', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '', '', '男', 'face/m27.gif', 0, '2019-09-13 18:42:18', '2019-09-13 18:42:18', '::1', 0),
(22, 'd0b9795317ce23ade799676f24319c528ad0ca07', 'e7119aa77d533c522be0ad1a1129c7f2aad1dcfc', '12346666', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '', '', '男', 'face/m27.gif', 0, '2019-09-13 18:45:22', '2019-09-13 18:45:22', '::1', 0),
(23, '8c5f84bd80ebbe9ba2dc20e10d946c04968984f1', '', '111111', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', 'wrwerwer@qq.com', '', '', '男', 'face/m27.gif', 0, '2019-09-13 19:22:12', '2019-09-13 19:22:12', '::1', 0),
(24, '00dcbd990c4db39bf3b423cf14b546c795ccbc4c', '', '99999', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', '12jl.@qq.net.com', '123456', 'http://www.hao9669.com', '女', 'face/m08.gif', 0, '2019-09-13 19:54:59', '2019-09-13 19:54:59', '::1', 0),
(25, '43b66fe0944406e1450021a84edfd5d5c337e56a', '', 'pingzi', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '我的学校在哪里？', '1a6d3bf64c420a790319aeb8060d8f320be87d85', '12jl@qq.com.cnt', '123456', 'http://www.hao9669.com', '男', 'face/m27.gif', 1, '2019-09-14 18:28:29', '2019-09-14 18:28:29', '::1', 0),
(26, '4c3aa827de5cf655c269aabfd7f8eb9bd0434b2f', '', 'pyaoling', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 'my name is', '34211c1f89a8be5365895658ae215b56a9f00de4', '12jl.@qq.cnt', '123456789', 'http://www.hao9669.com', '男', 'face/m01.gif', 0, '2019-09-27 22:44:57', '2019-09-27 22:44:57', '::1', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
