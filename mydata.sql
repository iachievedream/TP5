-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2019-09-11 13:17:30
-- 伺服器版本: 5.7.17-log
-- PHP 版本： 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mydata`
--

-- --------------------------------------------------------

--
-- 資料表結構 `article`
--

CREATE TABLE `article` (
  `id` int(11) UNSIGNED NOT NULL,
  `article` varchar(1000) DEFAULT '' COMMENT '文章',
  `Author` varchar(15) NOT NULL COMMENT '作者',
  `time` varchar(15) DEFAULT '' COMMENT '時間',
  `Remarks` varchar(100) DEFAULT '' COMMENT '備註'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `article`
--

INSERT INTO `article` (`id`, `article`, `Author`, `time`, `Remarks`) VALUES
(1, 'article_exaple1', 'fu', '2019/05/25', 'exaple'),
(2, 'article_exaple2', 'FU', '2019/05/25', 'exaple');

-- --------------------------------------------------------

--
-- 資料表結構 `easyuser`
--

CREATE TABLE `easyuser` (
  `id` int(8) UNSIGNED NOT NULL,
  `nickname` varchar(50) NOT NULL COMMENT '昵称',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `birthday` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '生日',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '注册时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `easyuser`
--

INSERT INTO `easyuser` (`id`, `nickname`, `email`, `birthday`, `status`, `create_time`, `update_time`) VALUES
(1, '流年', 'thinkphp@qq.com', 226339200, 0, 0, 0),
(2, '张三', 'zhanghsan@qq.com', 0, 0, 0, 0),
(3, '李四', 'lisi@qq.com', 0, 0, 0, 0),
(4, '流年', 'thinkphp@qq.com', 226339200, 0, 0, 0),
(5, '张三', 'zhanghsan@qq.com', 0, 0, 0, 0),
(6, '李四', 'lisi@qq.com', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `leave`
--

CREATE TABLE `leave` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(5) DEFAULT '' COMMENT '姓名',
  `date` varchar(16) NOT NULL COMMENT '日期',
  `reason` varchar(30) DEFAULT '' COMMENT '原因',
  `approved` varchar(30) DEFAULT '' COMMENT '上司核准'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `leave`
--

INSERT INTO `leave` (`id`, `name`, `date`, `reason`, `approved`) VALUES
(1, 'abc', '20190911', 'abc', 'cba'),
(2, 'wsx', '20190911', 'wsx', 'wsx');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT '' COMMENT '姓名',
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `password` varchar(30) DEFAULT '' COMMENT '密碼',
  `email` varchar(30) DEFAULT '' COMMENT '邮箱'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `email`) VALUES
(1, '123', '123', '123', '123'),
(2, '1234', '1234', '1234', '1234');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `easyuser`
--
ALTER TABLE `easyuser`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `leave`
--
ALTER TABLE `leave`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用資料表 AUTO_INCREMENT `easyuser`
--
ALTER TABLE `easyuser`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用資料表 AUTO_INCREMENT `leave`
--
ALTER TABLE `leave`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
