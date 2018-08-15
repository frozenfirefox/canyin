-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-04-23 18:02:30
-- 服务器版本： 5.5.56-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lvdata`
--

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@admin.com', '$2y$10$2R0mpZxjrMrCGxETUKslBOi4hUtjdoRjkBPYsaFAIi0mGJ6La.DiK', 'zgz6mOMlBPKq6zmf2B4s0aW1GGPQ4wXiFvlGPRLdGLt36URTVXIHUMLGbEXB', '2018-03-28 10:14:21', '2018-04-09 00:31:38'),
(2, 'Editor', 'editor@editor.com', '$2y$10$e3R1xYVyT3p2e7y9qZuiGOeybWSAqDwivlUANqpf2B7n6rnsw8geC', NULL, '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(3, '段惠文', 'dhw@admin.com', '$2y$10$r9MGVeEqWQe4YQcgdfO.Te034Ofex9jQMahmbTt4qoaqhDzGxcW7O', 'YoYG4ZkIVTRM9bagYVpcbJJLGYTvLkFduWmpJ8ieuMhEL5Fb2U5ytC5G93Wr', '2018-03-28 10:27:54', '2018-04-23 03:55:02'),
(4, '无添加', '29320323@qq.com', '$2y$10$jc8Y5oprt.b1Zr/9jq5waujHbR93shP05xAgiOuyqciNHjSO3rCeO', NULL, '2018-04-03 03:55:26', '2018-04-03 03:55:26');

-- --------------------------------------------------------

--
-- 表的结构 `cy_businesses`
--

CREATE TABLE `cy_businesses` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '商家名称',
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商家标签 类似于商家分类',
  `turnover` int(11) NOT NULL COMMENT '营业额 万元',
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商家电话',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '地址',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商家经理',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '商家描述',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单生成时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商户状态 0 默认都是正常的',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商户父id 如果为 0则为顶层商户 否则为子商户'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='餐饮平台商家表';

--
-- 转存表中的数据 `cy_businesses`
--

INSERT INTO `cy_businesses` (`id`, `name`, `tag`, `turnover`, `phone`, `address`, `user_id`, `description`, `create_time`, `update_at`, `other`, `status`, `parent_id`) VALUES
(1, '海底捞饭店', '1,3,9', 299999, '13312056785', '天津市南开区鞍山西道电子大楼707', 3, '天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707天津市南开区鞍山西道电子大楼707', 1523413960, 0, '', 1, 0),
(2, '实习饭店', '4,7,10', 2222, '13312062658', '山西井冈山铣刀片', 4, '山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片山西井冈山铣刀片', 1523413991, 1523606278, '', 2, 0),
(3, '测试饭店', '5,9,14', 2222222, '13312056785', '鞍山西道五大道', 3, '鞍山西道五大道鞍山西道五大道鞍山西道五大道鞍山西道五大道鞍山西道五大道鞍山西道五大道鞍山西道五大道鞍山西道五大道鞍山西道五大道鞍山西道五大道', 1523414167, 1523937145, '', 1, 2),
(4, '大润发顶级商户', '3,7,10', 200000, '13312056785', '天津市南开区鞍山西道电子大楼707', 3, '商户经理么么哒', 1523936737, 1523937386, '', 0, 3),
(5, '海底捞营口道店', '4,5,10', 50000, '13312056785', '天津市和平区滨江道商业街', 3, '这是一个商户 二级的', 1523936800, 1523937121, '', 0, 1),
(6, '四级饭店', '3,5,10', 500000, '13312056785', '鞍山西道五大道', 3, '四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店四级饭店', 1523937636, 1523937649, '', 9, 4);

-- --------------------------------------------------------

--
-- 表的结构 `cy_classes`
--

CREATE TABLE `cy_classes` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '类别名称',
  `class_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类类型 默认为0大类',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父id',
  `businesses_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商户id 默认为0 是大分类',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类状态 0 正常',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '分类描述',
  `create_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='餐饮系统类别表 可能是公共类';

--
-- 转存表中的数据 `cy_classes`
--

INSERT INTO `cy_classes` (`id`, `name`, `class_type`, `parent_id`, `businesses_id`, `status`, `description`, `create_at`, `update_at`, `other`) VALUES
(1, '甜品饮品', 0, 0, 0, 0, '大分类   ：：： 甜品饮品：：：222 ：：： 3333', 1522828523, 1522832185, ''),
(2, '生日蛋糕', 0, 0, 0, 0, '生日蛋糕', 1522829051, 0, ''),
(3, '火锅', 0, 0, 0, 0, '火锅', 1522829068, 1524043135, ''),
(4, '自助餐', 0, 0, 0, 0, '自助餐', 1522829083, 0, ''),
(5, '小吃快餐', 0, 0, 0, 0, '小吃快餐', 1522829103, 0, ''),
(6, '日韩料理', 0, 0, 0, 0, '日韩料理', 1522829127, 0, ''),
(7, '西餐', 0, 0, 0, 0, '西餐', 1522829143, 0, ''),
(8, '聚餐宴请', 0, 0, 0, 0, '聚餐宴请', 1522829164, 0, ''),
(9, '烧烤烤肉', 0, 0, 0, 0, '烧烤烤肉', 1522829186, 0, ''),
(10, '大闸蟹', 0, 0, 0, 0, '大闸蟹', 1522829206, 0, ''),
(11, '川湘菜', 0, 0, 0, 0, '川湘菜', 1522829223, 0, ''),
(12, '江浙菜', 0, 0, 0, 0, '江浙菜', 1522829242, 0, ''),
(13, '香锅烤鱼', 0, 0, 0, 0, '香锅烤鱼', 1522829262, 0, ''),
(14, '小龙虾', 0, 0, 0, 0, '小龙虾', 1522829279, 0, ''),
(15, '粤菜', 0, 0, 0, 0, '粤菜', 1522829309, 0, ''),
(16, '中式烧烤/烤串', 0, 0, 0, 0, '中式烧烤/烤串', 1522829374, 0, ''),
(17, '西北菜', 0, 0, 0, 0, '西北菜', 1522829394, 0, ''),
(18, '咖啡酒吧', 0, 0, 0, 0, '咖啡酒吧', 1522829412, 0, ''),
(19, '京菜鲁菜', 0, 0, 0, 0, '京菜鲁菜', 1522829431, 0, ''),
(20, '徽菜', 0, 0, 0, 0, '徽菜', 1522829462, 0, ''),
(21, '东北菜', 0, 0, 0, 0, '东北菜', 1522829478, 0, ''),
(22, '生鲜蔬果', 0, 0, 0, 0, '生鲜蔬果', 1522829496, 0, ''),
(23, '云贵菜', 0, 0, 0, 0, '云贵菜', 1522829519, 0, ''),
(24, '东南亚菜', 0, 0, 0, 0, '东南亚菜', 1522829532, 0, ''),
(25, '海鲜', 0, 0, 0, 0, '海鲜', 1522829549, 0, ''),
(26, '素食', 0, 0, 0, 0, '素食', 1522829561, 0, ''),
(27, '台湾/客家菜', 0, 0, 0, 0, '台湾/客家菜', 1522829583, 0, ''),
(28, '创意菜', 0, 0, 0, 0, '创意菜', 1522829602, 0, ''),
(29, '汤/粥/炖菜', 0, 0, 0, 0, '汤/粥/炖菜', 1522829628, 0, ''),
(30, '蒙菜', 0, 0, 0, 0, '蒙菜', 1522829642, 0, ''),
(31, '新疆菜', 0, 0, 0, 0, '新疆菜', 1522829654, 0, ''),
(32, '其他美食', 0, 0, 0, 0, '其他美食', 1522829670, 0, ''),
(35, '这是大分类吗', 0, 0, 0, 0, '这是大分类吗', 1522831774, 0, ''),
(38, '二哈菜', 0, 0, 0, 0, '二哈菜', 1522832355, 0, ''),
(48, '', 1, 0, 2, 9, '', 1523414133, 0, ''),
(49, '', 1, 0, 2, 9, '', 1523414539, 0, ''),
(50, '', 1, 0, 2, 9, '', 1523415830, 0, ''),
(51, '', 1, 0, 3, 0, '', 1523416121, 0, ''),
(52, '', 1, 0, 3, 0, '', 1523416158, 0, ''),
(53, '香锅类', 1, 0, 2, 0, '香锅类', 1523417363, 1523950377, ''),
(54, '', 1, 0, 3, 0, '', 1523417394, 0, ''),
(55, '', 1, 0, 3, 0, '', 1523417411, 0, ''),
(56, '', 1, 0, 2, 9, '', 1523417450, 0, ''),
(57, '香锅', 1, 53, 2, 0, '香锅', 1523505430, 1523950354, ''),
(58, '重庆火锅', 1, 0, 2, 0, '重庆火锅', 1523511860, 0, ''),
(59, '口味属性', 2, 0, 0, 0, '口味属性', 1523598170, 0, ''),
(60, '质量属性', 2, 0, 0, 0, '质量属性', 1523598193, 0, ''),
(61, '蛋糕甜点', 0, 4, 0, 9, '蛋糕甜点', 1523945331, 1523948504, ''),
(62, '牛莽莽火锅', 1, 58, 2, 0, '牛莽莽火锅', 1523949145, 1523949480, ''),
(63, '重庆火锅', 1, 0, 2, 9, '重庆火锅', 1523949349, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_comment`
--

CREATE TABLE `cy_comment` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键',
  `user1_id` int(10) UNSIGNED NOT NULL COMMENT '评论者',
  `user2_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '@的人',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父id',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '评论内容',
  `module_id` int(10) UNSIGNED NOT NULL COMMENT '评论信息 id',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0：产品评论 其他待定',
  `index` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '这个预计是要做一个索引 /25/56/ 方便寻找父和子',
  `create_at` int(11) NOT NULL COMMENT '创建时间',
  `update_at` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '状态 ： 0为正常 9为删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='评论表';

--
-- 转存表中的数据 `cy_comment`
--

INSERT INTO `cy_comment` (`id`, `user1_id`, `user2_id`, `pid`, `content`, `module_id`, `type`, `index`, `create_at`, `update_at`, `status`) VALUES
(1, 3, 0, 0, '我第一条评论', 1, 1, '', 1523859969, 0, 0),
(2, 3, 0, 0, '我第二条评论', 1, 1, '', 1523859969, 0, 0),
(3, 3, 0, 0, '我第三条评论', 1, 1, '', 1523859969, 0, 0),
(4, 3, 0, 0, '我第四条评论', 1, 1, '', 1523859969, 0, 0),
(5, 3, 0, 0, '我第五条评论', 1, 1, '', 1523859969, 0, 0),
(6, 3, 0, 1, '我第一条评论的子评论', 1, 1, '/1/', 1523859969, 0, 0),
(7, 3, 0, 2, '我第二条评论的子评论', 1, 1, '/2/', 1523859969, 0, 0),
(8, 3, 0, 3, '我第三条评论子评论', 1, 1, '/3/', 1523859969, 0, 0),
(9, 3, 0, 6, '我第一条评论的子评论的子评论', 1, 1, '/1/6/', 1523859969, 0, 0),
(10, 3, 0, 1, '我第一条评论的子评论2', 1, 1, '/1/', 1523859969, 0, 0),
(11, 3, 0, 1, '我是大品论', 1, 1, '', 1523963151, 0, 0),
(12, 3, 0, 9, '还是回复你', 1, 1, '', 1523963168, 0, 0),
(13, 3, 3, 7, '我恢复我自己', 1, 1, '', 1524131047, 0, 0),
(14, 3, 3, 13, '我就是要回复你', 1, 1, '', 1524474559, 0, 0),
(15, 3, 3, 14, '大萨达所大', 1, 1, '', 1524474592, 0, 0),
(16, 3, 3, 15, '大萨达所大撒多所', 1, 1, '', 1524474723, 0, 0),
(17, 3, 3, 16, '你说能出来不', 1, 1, '', 1524474772, 0, 0),
(18, 3, 3, 17, '出不来打你', 1, 1, '', 1524474830, 0, 0),
(19, 3, 3, 17, '大萨达所大', 1, 1, '', 1524474836, 0, 0),
(20, 3, 3, 19, '哈哈', 1, 1, '', 1524474855, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_file`
--

CREATE TABLE `cy_file` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键',
  `name` varchar(35) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件原名',
  `size` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '文件尺寸',
  `ext` varchar(9) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展名',
  `md5` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '文件sha1',
  `mime` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '文件mine类型',
  `savename` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '保存文件名',
  `savepath` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '保存路径',
  `location` tinyint(4) NOT NULL DEFAULT '0' COMMENT '文件保存位置 0本地',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '全相对路径',
  `abs_url` varchar(105) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '绝对地址',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态',
  `oss_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'oss服务器路径'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='文件集中管理表';

--
-- 转存表中的数据 `cy_file`
--

INSERT INTO `cy_file` (`id`, `name`, `size`, `ext`, `md5`, `sha1`, `mime`, `savename`, `savepath`, `location`, `path`, `abs_url`, `create_time`, `status`, `oss_path`) VALUES
(46, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-07-44_5ad548e09fc27.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-07-44_5ad548e09fc27.png', '', 1523927264, 9, ''),
(47, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-07-44_5ad548e09fafd.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-07-44_5ad548e09fafd.png', '', 1523927264, 1, ''),
(48, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-09-07-45_5ad548e10e7cf.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-07-45_5ad548e10e7cf.png', '', 1523927265, 1, ''),
(49, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-07-50_5ad548e61649a.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-07-50_5ad548e61649a.png', '', 1523927270, 1, ''),
(50, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-12-55_5ad54a17c0009.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-12-55_5ad54a17c0009.png', '', 1523927575, 1, ''),
(51, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-13-06_5ad54a220348d.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-13-06_5ad54a220348d.png', '', 1523927586, 1, ''),
(52, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-14-06_5ad54a5e253b8.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-14-06_5ad54a5e253b8.png', '', 1523927646, 1, ''),
(53, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-14-39_5ad54a7fb8d2a.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-14-39_5ad54a7fb8d2a.png', '', 1523927679, 1, ''),
(54, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-15-15_5ad54aa35d380.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-15-15_5ad54aa35d380.png', '', 1523927715, 1, ''),
(55, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-16-44_5ad54afc10d01.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-16-44_5ad54afc10d01.png', '', 1523927804, 1, ''),
(56, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-17-01_5ad54b0d50adf.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-17-01_5ad54b0d50adf.png', '', 1523927821, 1, ''),
(57, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-17-20_5ad54b2029c4a.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-17-20_5ad54b2029c4a.png', '', 1523927840, 1, ''),
(58, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-17-41_5ad54b3527b50.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-17-41_5ad54b3527b50.png', '', 1523927861, 1, ''),
(59, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-17-53_5ad54b413fd6f.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-17-53_5ad54b413fd6f.png', '', 1523927873, 1, ''),
(60, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-18-03_5ad54b4b41458.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-18-03_5ad54b4b41458.png', '', 1523927883, 1, ''),
(61, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-18-39_5ad54b6f82d6a.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-18-39_5ad54b6f82d6a.png', '', 1523927919, 1, ''),
(62, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-18-56_5ad54b8099026.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-18-56_5ad54b8099026.png', '', 1523927936, 1, ''),
(63, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-19-13_5ad54b918c43b.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-19-13_5ad54b918c43b.png', '', 1523927953, 1, ''),
(64, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-19-46_5ad54bb217b5d.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-19-46_5ad54bb217b5d.png', '', 1523927986, 1, ''),
(65, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-20-33_5ad54be16bf5b.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-20-33_5ad54be16bf5b.png', '', 1523928033, 1, ''),
(66, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-21-42_5ad54c26f0a86.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-21-42_5ad54c26f0a86.png', '', 1523928103, 1, ''),
(67, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-22-45_5ad54c6506713.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-22-45_5ad54c6506713.png', '', 1523928165, 1, ''),
(68, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-23-18_5ad54c8694d9f.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-23-18_5ad54c8694d9f.png', '', 1523928198, 1, ''),
(69, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-23-40_5ad54c9c22f87.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-23-40_5ad54c9c22f87.png', '', 1523928220, 1, ''),
(70, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-23-56_5ad54cac9a462.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-23-56_5ad54cac9a462.png', '', 1523928236, 1, ''),
(71, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-24-47_5ad54cdf28a14.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-24-47_5ad54cdf28a14.png', '', 1523928287, 1, ''),
(72, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-24-49_5ad54ce1b710c.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-24-49_5ad54ce1b710c.png', '', 1523928289, 1, ''),
(73, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-09-24-52_5ad54ce4c5f7a.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-24-52_5ad54ce4c5f7a.png', '', 1523928292, 1, ''),
(74, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-24-58_5ad54cea70763.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-24-58_5ad54cea70763.png', '', 1523928298, 1, ''),
(75, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-25-00_5ad54cecd0673.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-25-00_5ad54cecd0673.png', '', 1523928300, 1, ''),
(76, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-09-25-03_5ad54cef4e7fd.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-25-03_5ad54cef4e7fd.png', '', 1523928303, 1, ''),
(77, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-25-08_5ad54cf499e90.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-25-08_5ad54cf499e90.png', '', 1523928308, 1, ''),
(78, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-25-11_5ad54cf7168b9.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-25-11_5ad54cf7168b9.png', '', 1523928311, 1, ''),
(79, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-26-19_5ad54d3bb3cb6.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-26-19_5ad54d3bb3cb6.png', '', 1523928379, 1, ''),
(80, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-26-46_5ad54d564978b.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-26-46_5ad54d564978b.png', '', 1523928406, 1, ''),
(81, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-26-48_5ad54d5886bc8.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-26-48_5ad54d5886bc8.png', '', 1523928408, 1, ''),
(82, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-26-51_5ad54d5b61db8.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-26-51_5ad54d5b61db8.png', '', 1523928411, 1, ''),
(83, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-27-05_5ad54d69e001c.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-27-05_5ad54d69e001c.png', '', 1523928425, 1, ''),
(84, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-27-08_5ad54d6cbec50.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-27-08_5ad54d6cbec50.png', '', 1523928428, 1, ''),
(85, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-27-11_5ad54d6fc273d.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-27-11_5ad54d6fc273d.png', '', 1523928431, 1, ''),
(86, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-09-27-15_5ad54d7341c2e.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-27-15_5ad54d7341c2e.png', '', 1523928435, 1, ''),
(87, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-27-48_5ad54d94bfd04.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-27-48_5ad54d94bfd04.png', '', 1523928468, 1, ''),
(88, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-27-51_5ad54d976eda4.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-27-51_5ad54d976eda4.png', '', 1523928471, 1, ''),
(89, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-09-27-54_5ad54d9ad3ce5.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-27-54_5ad54d9ad3ce5.png', '', 1523928474, 1, ''),
(90, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-28-54_5ad54dd64243f.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-28-54_5ad54dd64243f.png', '', 1523928534, 1, ''),
(91, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-09-29-00_5ad54ddc5f08c.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-29-00_5ad54ddc5f08c.png', '', 1523928540, 1, ''),
(92, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-30-03_5ad54e1b1c542.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-30-03_5ad54e1b1c542.png', '', 1523928603, 1, ''),
(93, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-30-05_5ad54e1d61e58.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-30-05_5ad54e1d61e58.png', '', 1523928605, 1, ''),
(94, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-32-26_5ad54eaad46c8.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-32-26_5ad54eaad46c8.png', '', 1523928746, 1, ''),
(95, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-32-28_5ad54eac9242a.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-32-28_5ad54eac9242a.png', '', 1523928748, 1, ''),
(96, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-09-36-05_5ad54f85b2540.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-36-05_5ad54f85b2540.png', '', 1523928965, 1, ''),
(97, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-09-36-07_5ad54f8757bfd.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-36-07_5ad54f8757bfd.png', '', 1523928967, 1, ''),
(98, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-09-36-09_5ad54f89c6435.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-09-36-09_5ad54f89c6435.png', '', 1523928969, 1, ''),
(99, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-15-18-42_5ad59fd2d2c94.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-15-18-42_5ad59fd2d2c94.png', '', 1523949522, 1, ''),
(100, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-22-42_5ad5bce23ca7a.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-22-42_5ad5bce23ca7a.png', '', 1523956962, 1, ''),
(101, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-23-23_5ad5bd0b33e8b.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-23-23_5ad5bd0b33e8b.png', '', 1523957003, 1, ''),
(102, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-23-28_5ad5bd1002ce0.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-23-28_5ad5bd1002ce0.png', '', 1523957008, 1, ''),
(103, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-24-38_5ad5bd5661a9f.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-24-38_5ad5bd5661a9f.png', '', 1523957078, 1, ''),
(104, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-17-24-41_5ad5bd59d8a67.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-24-41_5ad5bd59d8a67.png', '', 1523957081, 1, ''),
(105, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-24-44_5ad5bd5c667fc.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-24-44_5ad5bd5c667fc.png', '', 1523957084, 1, ''),
(106, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-17-25-02_5ad5bd6e1694b.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-25-02_5ad5bd6e1694b.png', '', 1523957102, 1, ''),
(107, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-25-04_5ad5bd7076067.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-25-04_5ad5bd7076067.png', '', 1523957104, 1, ''),
(108, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-17-25-06_5ad5bd72b541b.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-25-06_5ad5bd72b541b.png', '', 1523957106, 1, ''),
(109, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-25-09_5ad5bd7505361.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-25-09_5ad5bd7505361.png', '', 1523957109, 1, ''),
(110, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-17-25-11_5ad5bd7729542.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-25-11_5ad5bd7729542.png', '', 1523957111, 1, ''),
(111, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-25-37_5ad5bd91e9181.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-25-37_5ad5bd91e9181.png', '', 1523957137, 1, ''),
(112, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-25-49_5ad5bd9dc92bc.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-25-49_5ad5bd9dc92bc.png', '', 1523957149, 1, ''),
(113, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-26-18_5ad5bdba59928.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-26-18_5ad5bdba59928.png', '', 1523957178, 1, ''),
(114, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-17-28-08_5ad5be28b644d.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-08_5ad5be28b644d.png', '', 1523957288, 1, ''),
(115, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-28-11_5ad5be2b42e79.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-11_5ad5be2b42e79.png', '', 1523957291, 1, ''),
(116, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-28-14_5ad5be2e0c728.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-14_5ad5be2e0c728.png', '', 1523957294, 1, ''),
(117, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-17-28-16_5ad5be3015a64.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-16_5ad5be3015a64.png', '', 1523957296, 1, ''),
(118, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-28-18_5ad5be321e41c.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-18_5ad5be321e41c.png', '', 1523957298, 1, ''),
(119, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-17-28-20_5ad5be344aab6.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-20_5ad5be344aab6.png', '', 1523957300, 1, ''),
(121, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-17-28-28_5ad5be3c2fc7c.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-28_5ad5be3c2fc7c.png', '', 1523957308, 1, ''),
(122, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-17-28-31_5ad5be3f0587f.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-31_5ad5be3f0587f.png', '', 1523957311, 1, ''),
(123, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-28-36_5ad5be44a086f.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-36_5ad5be44a086f.png', '', 1523957316, 1, ''),
(124, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-17-28-38_5ad5be46c2ed5.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-38_5ad5be46c2ed5.png', '', 1523957318, 1, ''),
(125, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-17-28-40_5ad5be48a58ba.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-40_5ad5be48a58ba.png', '', 1523957320, 1, ''),
(126, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-17-17-28-42_5ad5be4aaad2b.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-42_5ad5be4aaad2b.png', '', 1523957322, 1, ''),
(127, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-17-17-28-47_5ad5be4fe8d90.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-47_5ad5be4fe8d90.png', '', 1523957327, 1, ''),
(128, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-17-17-28-50_5ad5be521d76b.png', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-28-50_5ad5be521d76b.png', '', 1523957330, 1, ''),
(129, '2fdda3cc7cd98d103a6a0d0b2a3fb80e7be', 225149, 'jpg', '73875cbfd860df173b3b535268d000b5', '639f8c235c1799e2844faaa9545a43475697b1ef', 'image/jpeg', '2018-04-17-17-33-18_5ad5bf5e37348.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-33-18_5ad5bf5e37348.jpg', '', 1523957598, 1, ''),
(130, '01c378554541a70000019ae9f84a44.jpg@', 2630352, 'jpg', '47ca738255ff1e5a762139eae91a236f', 'd8e8c04518814da53ecd65dd7e922fa967116c8f', 'image/jpeg', '2018-04-17-17-33-18_5ad5bf5e37327.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-33-18_5ad5bf5e37327.jpg', '', 1523957598, 1, ''),
(131, '3801213fb80e7bec03102bdb242eb9389a5', 219012, 'jpg', '535c5af358fc8eeb734a7edcfcc9b190', '69792fc6b3e2fa3a736962d2b2d250dd0f0fee75', 'image/jpeg', '2018-04-17-17-33-18_5ad5bf5e9995b.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-33-18_5ad5bf5e9995b.jpg', '', 1523957598, 1, ''),
(132, '9341950_123944651000_2.jpg', 295363, 'jpg', '21f5d265956d968532607350944b53aa', 'd06ff950220ab77f8875a355767cc4c3a1e3fc53', 'image/jpeg', '2018-04-17-17-33-18_5ad5bf5eb71f2.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-33-18_5ad5bf5eb71f2.jpg', '', 1523957598, 1, ''),
(133, '16013419-64879c4cc1f56fb9a8273e1fb1', 408530, 'jpg', 'f05d50c194d538e8730548d61e8df9ba', '712b8274c7c0ca51840d835286d9c501759af325', 'image/jpeg', '2018-04-17-17-33-18_5ad5bf5ef4080.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-33-18_5ad5bf5ef4080.jpg', '', 1523957599, 1, ''),
(134, '3801213fb80e7bec03102bdb242eb9389a5', 219012, 'jpg', '535c5af358fc8eeb734a7edcfcc9b190', '69792fc6b3e2fa3a736962d2b2d250dd0f0fee75', 'image/jpeg', '2018-04-17-17-37-55_5ad5c073503b1.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-37-55_5ad5c073503b1.jpg', '', 1523957875, 1, ''),
(135, '16013419-64879c4cc1f56fb9a8273e1fb1', 408530, 'jpg', 'f05d50c194d538e8730548d61e8df9ba', '712b8274c7c0ca51840d835286d9c501759af325', 'image/jpeg', '2018-04-17-17-37-57_5ad5c0759305b.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-37-57_5ad5c0759305b.jpg', '', 1523957877, 1, ''),
(136, '2fdda3cc7cd98d103a6a0d0b2a3fb80e7be', 225149, 'jpg', '73875cbfd860df173b3b535268d000b5', '639f8c235c1799e2844faaa9545a43475697b1ef', 'image/jpeg', '2018-04-17-17-47-22_5ad5c2aa87b75.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-47-22_5ad5c2aa87b75.jpg', '', 1523958442, 1, ''),
(137, '9341950_123944651000_2.jpg', 295363, 'jpg', '21f5d265956d968532607350944b53aa', 'd06ff950220ab77f8875a355767cc4c3a1e3fc53', 'image/jpeg', '2018-04-17-17-47-24_5ad5c2ac425e9.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-17-47-24_5ad5c2ac425e9.jpg', '', 1523958444, 1, ''),
(138, '9341950_123944651000_2.jpg', 295363, 'jpg', '21f5d265956d968532607350944b53aa', 'd06ff950220ab77f8875a355767cc4c3a1e3fc53', 'image/jpeg', '2018-04-17-18-03-14_5ad5c6624c068.jpg', '/public/uploads/20180417', 0, '/uploads/20180417/2018-04-17-18-03-14_5ad5c6624c068.jpg', '', 1523959394, 1, ''),
(139, 'logo.png', 4552, 'png', 'aaa0f3ddd956ae65087755d14479206d', '6d3410d3148c4550edf8f31e49afa697e94d5995', 'image/png', '2018-04-19-17-03-21_5ad85b5939ea5.png', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-17-03-21_5ad85b5939ea5.png', '', 1524128601, 1, ''),
(140, '2fdda3cc7cd98d103a6a0d0b2a3fb80e7be', 225149, 'jpg', '73875cbfd860df173b3b535268d000b5', '639f8c235c1799e2844faaa9545a43475697b1ef', 'image/jpeg', '2018-04-19-18-44-54_5ad87326098b8.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-54_5ad87326098b8.jpg', '', 1524134694, 1, ''),
(141, '01c378554541a70000019ae9f84a44.jpg@', 2630352, 'jpg', '47ca738255ff1e5a762139eae91a236f', 'd8e8c04518814da53ecd65dd7e922fa967116c8f', 'image/jpeg', '2018-04-19-18-44-54_5ad87326098bd.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-54_5ad87326098bd.jpg', '', 1524134694, 1, ''),
(142, '3801213fb80e7bec03102bdb242eb9389a5', 219012, 'jpg', '535c5af358fc8eeb734a7edcfcc9b190', '69792fc6b3e2fa3a736962d2b2d250dd0f0fee75', 'image/jpeg', '2018-04-19-18-44-54_5ad8732689b8f.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-54_5ad8732689b8f.jpg', '', 1524134694, 1, ''),
(143, '9341950_123944651000_2.jpg', 295363, 'jpg', '21f5d265956d968532607350944b53aa', 'd06ff950220ab77f8875a355767cc4c3a1e3fc53', 'image/jpeg', '2018-04-19-18-44-54_5ad873269efae.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-54_5ad873269efae.jpg', '', 1524134694, 1, ''),
(144, '16013419-64879c4cc1f56fb9a8273e1fb1', 408530, 'jpg', 'f05d50c194d538e8730548d61e8df9ba', '712b8274c7c0ca51840d835286d9c501759af325', 'image/jpeg', '2018-04-19-18-44-54_5ad87326e5c27.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-54_5ad87326e5c27.jpg', '', 1524134694, 1, ''),
(145, 'QQ截图20180411160702.png', 112674, 'png', '07aa5ae4ba71702176f312cc29214e87', '63faa6945d9cbe8bae800abdddb9f1ca39d4affc', 'image/png', '2018-04-19-18-44-55_5ad8732706e5d.png', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-55_5ad8732706e5d.png', '', 1524134695, 1, ''),
(146, 'QQ截图20180411160727.png', 113022, 'png', '3198d4b5f1027fb6e30376f54c082bad', 'a78ba3f66cd44c35c5311000d265a9c1d2783da7', 'image/png', '2018-04-19-18-44-55_5ad873275ccb4.png', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-55_5ad873275ccb4.png', '', 1524134695, 1, ''),
(147, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-19-18-44-55_5ad8732761930.png', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-55_5ad8732761930.png', '', 1524134695, 1, ''),
(148, 'timg.jpg', 70668, 'jpg', '4c69178186f4f020b755fd1e096fd9e9', '773f57cce0ff764df17a31da35cbaeece1bb2daf', 'image/jpeg', '2018-04-19-18-44-55_5ad87327a5103.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-55_5ad87327a5103.jpg', '', 1524134695, 1, ''),
(149, '2fdda3cc7cd98d103a6a0d0b2a3fb80e7be', 225149, 'jpg', '73875cbfd860df173b3b535268d000b5', '639f8c235c1799e2844faaa9545a43475697b1ef', 'image/jpeg', '2018-04-19-18-44-59_5ad8732b50cfd.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-59_5ad8732b50cfd.jpg', '', 1524134699, 1, ''),
(150, '01c378554541a70000019ae9f84a44.jpg@', 2630352, 'jpg', '47ca738255ff1e5a762139eae91a236f', 'd8e8c04518814da53ecd65dd7e922fa967116c8f', 'image/jpeg', '2018-04-19-18-44-59_5ad8732b50d01.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-59_5ad8732b50d01.jpg', '', 1524134699, 1, ''),
(151, '3801213fb80e7bec03102bdb242eb9389a5', 219012, 'jpg', '535c5af358fc8eeb734a7edcfcc9b190', '69792fc6b3e2fa3a736962d2b2d250dd0f0fee75', 'image/jpeg', '2018-04-19-18-44-59_5ad8732bac1c5.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-59_5ad8732bac1c5.jpg', '', 1524134699, 1, ''),
(152, '9341950_123944651000_2.jpg', 295363, 'jpg', '21f5d265956d968532607350944b53aa', 'd06ff950220ab77f8875a355767cc4c3a1e3fc53', 'image/jpeg', '2018-04-19-18-44-59_5ad8732bc62cc.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-44-59_5ad8732bc62cc.jpg', '', 1524134699, 1, ''),
(153, 'QQ截图20180411160732.png', 11782, 'png', 'b2bb67d3ee4723a048043cfe88e11b7b', '9de1ac7b05a366f047d3eb171029239cf65e87f4', 'image/png', '2018-04-19-18-45-00_5ad8732c2fe5b.png', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-45-00_5ad8732c2fe5b.png', '', 1524134700, 1, ''),
(154, 'timg.jpg', 70668, 'jpg', '4c69178186f4f020b755fd1e096fd9e9', '773f57cce0ff764df17a31da35cbaeece1bb2daf', 'image/jpeg', '2018-04-19-18-45-00_5ad8732c4f89c.jpg', '/public/uploads/20180419', 0, '/uploads/20180419/2018-04-19-18-45-00_5ad8732c4f89c.jpg', '', 1524134700, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_goods`
--

CREATE TABLE `cy_goods` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `price_id` int(11) NOT NULL COMMENT '价格单id',
  `merchant_id` int(11) NOT NULL COMMENT '商家id',
  `merchant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '商家名称',
  `goods_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '商品名称',
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '关键字',
  `goods_brief` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商品简介',
  `goods_desc` text COLLATE utf8_unicode_ci NOT NULL COMMENT '商品详细说明',
  `goods_typeid` int(11) NOT NULL DEFAULT '0' COMMENT '商品类型 id',
  `goods_img` int(11) NOT NULL DEFAULT '0' COMMENT '品图片略缩图',
  `last_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '更新商品ip',
  `oss_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'oss服务器路径',
  `integral` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '积分返还',
  `discount` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '可使用红券数 单位%',
  `red_return_integral` int(11) NOT NULL DEFAULT '0' COMMENT '红券返积分',
  `yellow_discount` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '黄券使用比例',
  `yellow_return_integral` int(11) NOT NULL DEFAULT '0' COMMENT '黄券返积分',
  `blue_discount` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '蓝券使用比例',
  `is_limit` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否限购',
  `is_integral_buy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否可用积分兑换',
  `is_refer` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否推荐到封面',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品状态 0 默认都是正常的',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品表';

--
-- 转存表中的数据 `cy_goods`
--

INSERT INTO `cy_goods` (`id`, `price_id`, `merchant_id`, `merchant_name`, `goods_name`, `keyword`, `goods_brief`, `goods_desc`, `goods_typeid`, `goods_img`, `last_ip`, `oss_path`, `integral`, `discount`, `red_return_integral`, `yellow_discount`, `yellow_return_integral`, `blue_discount`, `is_limit`, `is_integral_buy`, `is_refer`, `status`, `create_time`, `update_time`) VALUES
(3, 0, 2, '', '四川菜', '餐饮后台', '商品名称 * : 粤菜', '商品名称 * : 粤菜2', 50, 0, '', '', '0.00', '0.00', 0, '0.00', 0, '0.00', 0, 0, 1, 9, 1523496595, 0),
(4, 0, 2, '', '四川菜2', '产品四川菜四川菜四川菜', '四川菜', '四川菜四川菜四川菜四川菜四川菜四川菜', 53, 0, '', '', '0.00', '0.00', 0, '0.00', 0, '0.00', 0, 0, 1, 9, 1523505462, 1523505536),
(5, 0, 2, '', '四川菜2', '产品四川菜四川菜四川菜', '四川菜', '四川菜四川菜四川菜四川菜四川菜四川菜', 53, 154, '', '', '0.00', '0.00', 0, '0.00', 0, '0.00', 0, 0, 1, 0, 1523505523, 1524134719),
(6, 0, 2, '', '我喜欢吃草', '吃草吃草吃草', '吃草吃草吃草吃草吃草', '吃草吃草吃草吃草吃草', 58, 78, '', '', '0.00', '0.00', 0, '0.00', 0, '0.00', 0, 0, 0, 0, 1523927273, 1523957603);

-- --------------------------------------------------------

--
-- 表的结构 `cy_goods_attr`
--

CREATE TABLE `cy_goods_attr` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_attr_id` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商品属性id',
  `goods_attr_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '属性值',
  `goods_attr_assignment` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '复制',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0正常 9 删除',
  `businesses_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商户id',
  `classes_type` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '自定义属性类别'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存储商品规格参数里的动态商品属性和属性值表';

--
-- 转存表中的数据 `cy_goods_attr`
--

INSERT INTO `cy_goods_attr` (`id`, `goods_id`, `goods_attr_id`, `goods_attr_value`, `goods_attr_assignment`, `status`, `businesses_id`, `classes_type`) VALUES
(1, 0, 'super_spicy', '超级辣', '', 0, 2, 60),
(2, 0, '0', '一般辣', '', 9, 2, 0),
(3, 0, 'middle_spicy', '中辣', '', 0, 2, 59),
(4, 0, 'normal_spicy', '普通', '', 0, 2, 59),
(5, 0, 'big', '大份', '', 0, 2, 60),
(6, 0, 'middle', '中份', '', 0, 2, 60),
(7, 0, 'small', '小份', '', 0, 2, 60);

-- --------------------------------------------------------

--
-- 表的结构 `cy_goods_category`
--

CREATE TABLE `cy_goods_category` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT ' 商品id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `short_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '分类简称',
  `cate_img` int(11) NOT NULL DEFAULT '0' COMMENT '分类图标',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父ID',
  `min_rate` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '平台分成比例',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `create_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '创建ip',
  `update_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '修改ip',
  `create_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0正常 9 删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品分类';

--
-- 转存表中的数据 `cy_goods_category`
--

INSERT INTO `cy_goods_category` (`id`, `goods_id`, `name`, `short_name`, `cate_img`, `parent_id`, `min_rate`, `sort`, `create_ip`, `update_ip`, `create_at`, `update_at`, `other`, `status`) VALUES
(1, 1, '好分类', '2222', 111, 11, '111.00', 11, '', '', 1524130899, 1524130905, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_goods_gallery`
--

CREATE TABLE `cy_goods_gallery` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_pictures` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '图片用,隔开',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '商品图片显示顺序',
  `create_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商户状态 0 默认都是正常的'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品相册';

--
-- 转存表中的数据 `cy_goods_gallery`
--

INSERT INTO `cy_goods_gallery` (`id`, `goods_id`, `goods_pictures`, `sort`, `create_at`, `update_at`, `other`, `status`) VALUES
(1, 1, '1,2,3,40', 22222, 1523505785, 0, '', 0),
(2, 6, '47', 0, 1523927273, 0, '', 0),
(3, 6, '46', 1, 1523927273, 0, '', 0),
(4, 6, '48', 2, 1523927273, 0, '', 0),
(5, 6, '129', 0, 1523957603, 0, '', 0),
(6, 6, '130', 0, 1523957603, 0, '', 0),
(7, 6, '131', 0, 1523957603, 0, '', 0),
(8, 6, '132', 0, 1523957603, 0, '', 0),
(9, 6, '133', 0, 1523957603, 0, '', 0),
(10, 5, '', 0, 1524128593, 0, '', 0),
(11, 5, '140', 0, 1524134703, 0, '', 0),
(12, 5, '141', 0, 1524134703, 0, '', 0),
(13, 5, '142', 0, 1524134703, 0, '', 0),
(14, 5, '143', 0, 1524134703, 0, '', 0),
(15, 5, '144', 0, 1524134703, 0, '', 0),
(16, 5, '145', 0, 1524134703, 0, '', 0),
(17, 5, '146', 0, 1524134703, 0, '', 0),
(18, 5, '147', 0, 1524134703, 0, '', 0),
(19, 5, '148', 0, 1524134703, 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_goods_price`
--

CREATE TABLE `cy_goods_price` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `goods_id` int(10) UNSIGNED NOT NULL COMMENT '商品id',
  `goods_specification` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '规格',
  `settlement_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算价格',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价格',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `goods_unit_type` tinyint(3) UNSIGNED NOT NULL COMMENT '商品计件方式 1为重量，2为体积,3为件',
  `goods_weight` decimal(10,3) NOT NULL COMMENT '商品重量单位KG或体积单位L ',
  `goods_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '产品相片 多张用 , 隔开',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0正常.其他待定.9为删除',
  `wy_price` decimal(10,2) NOT NULL COMMENT '无优价',
  `yx_price` decimal(10,2) NOT NULL COMMENT '优享价',
  `integral` int(11) NOT NULL COMMENT '积分价格',
  `discount` int(11) NOT NULL COMMENT '红券使用比例(单位%)',
  `red_rurn_integral` int(11) NOT NULL COMMENT '红券返积分',
  `yellow_discount` int(11) NOT NULL COMMENT '黄券使用比例 (%)',
  `yellow_return_integral` int(11) NOT NULL COMMENT '黄券返积分',
  `blue_discount` int(11) NOT NULL COMMENT '蓝券使用比例(%)',
  `create_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段',
  `goods_attr` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商品价格属性'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `cy_goods_price`
--

INSERT INTO `cy_goods_price` (`id`, `goods_id`, `goods_specification`, `settlement_price`, `shop_price`, `market_price`, `goods_unit_type`, `goods_weight`, `goods_img`, `status`, `wy_price`, `yx_price`, `integral`, `discount`, `red_rurn_integral`, `yellow_discount`, `yellow_return_integral`, `blue_discount`, `create_at`, `update_at`, `other`, `goods_attr`) VALUES
(3, 5, '四川菜大份', '200.00', '190.00', '190.00', 0, '0.000', '', 0, '200.00', '300.00', 400, 10, 10, 20, 20, 50, 1523512796, 1524045533, '', ''),
(4, 5, '四川菜小份', '200.00', '190.00', '210.00', 0, '1.000', '', 9, '200.00', '180.00', 180, 10, 10, 10, 20, 10, 1523521490, 0, '', ''),
(5, 5, '四川菜超级大份', '2000.00', '2222.00', '222.00', 0, '2.000', '', 0, '2222.00', '222.00', 222, 22, 222, 22, 22, 22, 1523522191, 0, '', ''),
(6, 5, '四川麻辣菜', '2.00', '250.00', '2.00', 0, '2.000', '', 0, '2.00', '2.00', 2, 2, 222, 2, 2, 2, 1523522217, 0, '', ''),
(7, 6, '四川菜大份', '2000.00', '250.00', '210.00', 0, '1.000', '138', 0, '2222.00', '300.00', 180, 10, 10, 10, 20, 30, 1523957139, 1523959396, '', '{\"59\":\"3\",\"60\":\"6\"}');

-- --------------------------------------------------------

--
-- 表的结构 `cy_message`
--

CREATE TABLE `cy_message` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户id 如果为0全部用户',
  `msg_type` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '消息类型 0 系统消息 1 订单消息表 扩充后注释说明',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '消息标题',
  `context` text COLLATE utf8_unicode_ci NOT NULL COMMENT '消息内容',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 为正常 其他自行设定',
  `create_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='餐饮平台消息表';

--
-- 转存表中的数据 `cy_message`
--

INSERT INTO `cy_message` (`id`, `user_id`, `msg_type`, `title`, `context`, `status`, `create_at`, `update_at`, `other`) VALUES
(1, 0, 0, '我是站内信修改', '我是站内信2', 9, 1523252968, 1523505746, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_order`
--

CREATE TABLE `cy_order` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `order_sn` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '订单号',
  `merchant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商家名称',
  `merchant_id` int(10) UNSIGNED NOT NULL COMMENT '商家id',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `order_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单类型 订单类型待定',
  `receiver` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人',
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人电话',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人详细地址',
  `pay_type` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '支付方式： 1：微信支付 2：支付宝 3：银联支付 4：余额支付 5：积分支付 6：...',
  `order_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单状态 0：待支付 1：代发货 2：待收货 3：待评价 4：已完成 5：已取消 9：删除',
  `settlement_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0:不需要 1：需要',
  `settlement_time` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT '计划任务执行时间',
  `settlement_end_time` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT '计划任务完成时间',
  `pay_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '支付状态 0 未支付 1 已支付',
  `order_goods_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '订单商品表id',
  `goods_num` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品数量',
  `use_integral` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '使用积分',
  `pay_tickets` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '实际劵支付金额',
  `ticket_color` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0未使用代金券 1红 2黄 3蓝',
  `order_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '订单总价',
  `freight` decimal(10,2) NOT NULL COMMENT '运费',
  `pay_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '支付时间',
  `comment_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单评论状态 0 未评论  1已评论',
  `wx_sn` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '微信支付订单号',
  `return_integral` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '返还积分数',
  `is_tax` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否开具发票',
  `express_fee` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '发票运费',
  `tax_pay` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '发票税金',
  `welfare` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '公益金额',
  `mark` text COLLATE utf8_unicode_ci NOT NULL COMMENT '留言',
  `import_tax` decimal(20,2) NOT NULL COMMENT '进口税总额',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单生成时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `cy_order`
--

INSERT INTO `cy_order` (`id`, `order_sn`, `merchant_name`, `merchant_id`, `user_id`, `order_type`, `receiver`, `phone`, `address`, `pay_type`, `order_status`, `settlement_status`, `settlement_time`, `settlement_end_time`, `pay_status`, `order_goods_id`, `goods_num`, `use_integral`, `pay_tickets`, `ticket_color`, `order_price`, `freight`, `pay_time`, `comment_status`, `wx_sn`, `return_integral`, `is_tax`, `express_fee`, `tax_pay`, `welfare`, `mark`, `import_tax`, `create_time`, `update_at`, `other`) VALUES
(1, '2018123154545', '实习饭店', 2, 1, 0, '段惠文', '1331402545', '鞍山西道西道', 0, 0, 0, '', '', 0, '', 0, 0, '0.00', 0, '0.00', '0.00', 0, 0, '', '0.00', 0, '0.00', '0.00', '0.00', '', '0.00', 0, 1524128569, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_order_goods`
--

CREATE TABLE `cy_order_goods` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `order_id` int(10) UNSIGNED NOT NULL COMMENT '订单id',
  `merchant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商家名称',
  `merchant_id` int(10) UNSIGNED NOT NULL COMMENT '商家id',
  `goods_id` int(10) UNSIGNED NOT NULL COMMENT '商品id',
  `goods_attr` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商品属性组合',
  `settlement_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算价',
  `shop_price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '销售价',
  `market_price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `goods_img` int(11) NOT NULL COMMENT '商品图片',
  `discount` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '红劵使用比例',
  `yellow_discount` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '黄券使用比例',
  `blue_discount` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '蓝券使用比例',
  `red_return_integral` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '红券返回积分比例',
  `yellow_return_integral` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '黄劵返回积分比例',
  `goods_num` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '购买数量',
  `total` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '小计',
  `send_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '配送方式0 不配送 1：蜂鸟配送 2：等其他',
  `send_company` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '快递id',
  `send_nu` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '运单号',
  `delivery_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '配送时间',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '状态 1：已收货 2：未收货 3：延时收货',
  `sure_delivery_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '确认收货时间',
  `after_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '退换货状态 0 正常 1退货',
  `comment_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '评论状态 1为已评价',
  `is_sales` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商家是否同意退货 1：同意 0：否',
  `is_invoice` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否开发票（0否，1是）',
  `invoice_type_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '发票类型id',
  `invoice_rise` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '发票抬头类型（1->个人，2->公司）',
  `rise_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '抬头名',
  `invoice_detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '发票明细',
  `recognition` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '识别号',
  `tax_pay` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '税金金额',
  `express_fee` int(11) NOT NULL DEFAULT '0' COMMENT '发票运费',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单生成时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `cy_order_goods`
--

INSERT INTO `cy_order_goods` (`id`, `order_id`, `merchant_name`, `merchant_id`, `goods_id`, `goods_attr`, `settlement_price`, `shop_price`, `market_price`, `goods_img`, `discount`, `yellow_discount`, `blue_discount`, `red_return_integral`, `yellow_return_integral`, `goods_num`, `total`, `send_type`, `send_company`, `send_nu`, `delivery_time`, `status`, `sure_delivery_time`, `after_type`, `comment_status`, `is_sales`, `is_invoice`, `invoice_type_id`, `invoice_rise`, `rise_name`, `invoice_detail`, `recognition`, `tax_pay`, `express_fee`, `create_time`, `update_at`, `other`) VALUES
(1, 1, '实习饭店', 2, 3, '', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '0.00', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_staff`
--

CREATE TABLE `cy_staff` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '用户Id',
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `businesses_id` int(10) UNSIGNED NOT NULL COMMENT '商户id',
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '员工职位',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父id  0 为顶级员工',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '员工状态 0 正常 9为删除',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '员工描述',
  `create_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `cy_staff`
--

INSERT INTO `cy_staff` (`id`, `user_id`, `phone`, `businesses_id`, `position`, `parent_id`, `status`, `description`, `create_at`, `update_at`, `other`) VALUES
(1, 0, '', 2, 0, 0, 9, '', 1523414031, 0, ''),
(2, 0, '', 2, 0, 0, 9, '', 1523415647, 0, ''),
(3, 0, '', 2, 0, 0, 9, '', 1523415680, 0, ''),
(4, 3, '13312056785', 2, 3, 0, 9, '哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 1523505661, 1523505673, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_ticket`
--

CREATE TABLE `cy_ticket` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `ticket_code` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '优惠券 唯一id',
  `ticket_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '优惠券名称',
  `ticket_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '优惠券的说明',
  `ticket_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '优惠券类型 1 满减 2满折 3满赠',
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '面值 满减（金额） 满赠（goodsid） 满折（1-10）',
  `condition` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 表示无条件使用 其他填写条件金额',
  `merchant_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商家id 默认0 表示后台发放',
  `true_use_num` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '使用数量',
  `limit_num` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0表示不限制 默认为1',
  `ticket_num` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 表示没有上限',
  `use_num` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '被领走数量',
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0表示针对全店',
  `status` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0未发布 1发布 9 删除',
  `start_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '有效期开始时间',
  `end_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '有效期结束时间',
  `create_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='餐饮平台订单商品表';

--
-- 转存表中的数据 `cy_ticket`
--

INSERT INTO `cy_ticket` (`id`, `ticket_code`, `ticket_name`, `ticket_desc`, `ticket_type`, `value`, `condition`, `merchant_id`, `true_use_num`, `limit_num`, `ticket_num`, `use_num`, `goods_id`, `status`, `start_time`, `end_time`, `create_at`, `update_at`, `other`) VALUES
(2, 'J20180410143120319683', '优惠劵', '优惠劵', 0, '0', 0, 0, 23, 1, 0, 23, 0, 9, 1514737500, 1524154200, 1523341880, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_user_ticket`
--

CREATE TABLE `cy_user_ticket` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id',
  `ticket_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '不能为空 这是ticketId 这里想法是要用UUID',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '状态0未使用 1已使用',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '领取时间',
  `update_at` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '扩展字段'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `cy_user_ticket`
--

INSERT INTO `cy_user_ticket` (`id`, `ticket_id`, `user_id`, `status`, `create_time`, `update_at`, `other`) VALUES
(1, '1', 2, 9, 1523411543, 1523411553, '');

-- --------------------------------------------------------

--
-- 表的结构 `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单链接',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '权限名称',
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级菜单id',
  `heightlight_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单高亮',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `slug`, `icon`, `parent_id`, `heightlight_url`, `sort`, `created_at`, `updated_at`) VALUES
(1, '系统配置', 'admin/menus', 'system.manage', 'fa fa-cogs', 0, '', 1, '2018-03-28 10:14:21', '2018-04-23 03:32:17'),
(2, '后台目录管理', 'admin/menus', 'menus.list', '', 1, '', 1, '2018-03-28 10:14:21', '2018-04-23 03:39:29'),
(3, '后台用户管理', 'admin/adminuser', 'adminuser.list', '', 1, '', 2, '2018-03-28 10:14:21', '2018-04-23 03:39:34'),
(4, '权限管理', 'admin/permission', 'permission.list', '', 1, '', 4, '2018-03-28 10:14:21', '2018-04-23 03:39:47'),
(5, '角色管理', 'admin/role', 'role.list', '', 1, '', 3, '2018-03-28 10:14:21', '2018-04-23 03:39:39'),
(8, '商户管理', 'admin/businesses', 'businesses.manage', 'fa fa-users', 0, '', 2, '2018-04-02 07:50:16', '2018-04-23 03:32:26'),
(9, '统计信息', 'admin/statistics', 'statistics.manage', 'fa fa-bar-chart', 0, '', 4, '2018-04-02 07:56:03', '2018-04-23 03:38:29'),
(10, '扩展菜单', 'admin/extends', 'admin.extends', 'fa fa-expand', 0, '', 8, '2018-04-02 07:57:34', '2018-04-23 03:39:05'),
(11, '商户列表', 'admin/businesses', 'businesses.list', 'fa fa-list', 8, '', 0, '2018-04-02 08:03:34', '2018-04-02 09:10:26'),
(12, '查看统计权限', 'admin/statistics', 'statistics.view', 'fa fa-medium', 9, '', 0, '2018-04-02 08:08:24', '2018-04-02 08:08:24'),
(13, '商户类别', 'admin/classes', 'classes.list', 'fa fa-list-ul', 8, '', 0, '2018-04-04 06:55:57', '2018-04-04 06:57:43'),
(14, '消息管理', 'admin/message', 'message.list', '', 1, '', 5, '2018-04-09 05:48:57', '2018-04-23 03:39:54'),
(15, '优惠券管理', 'admin/ticket', 'ticket.manage', 'fa fa-ticket', 0, '', 3, '2018-04-08 22:23:17', '2018-04-23 03:38:15'),
(16, '优惠券列表', 'admin/ticket', 'ticket.list', '', 15, '', 0, '2018-04-08 22:59:02', '2018-04-08 22:59:02'),
(17, '文件管理', 'admin/file', 'file.manage', 'fa  fa-file', 0, '', 5, '2018-04-11 01:41:59', '2018-04-23 03:38:46'),
(18, '文件列表', 'admin/file', 'file.list', 'fa  fa-list', 17, '', 0, '2018-04-11 01:42:26', '2018-04-11 01:42:26'),
(19, '用户优惠劵', 'admin/userticket', 'userticket.list', 'fa  fa-list', 15, '', 0, '2018-04-11 01:45:29', '2018-04-11 01:45:29'),
(20, '商品图片集', 'admin/gallery', 'gallery.list', 'fa  fa-picture-o', 8, '', 0, '2018-04-12 01:02:05', '2018-04-12 01:02:05'),
(21, '评论模块', 'admin/comment', 'comment.info', 'fa  fa-list', 1, '', 6, '2018-04-16 06:04:25', '2018-04-23 03:40:02'),
(22, '回收站', 'admin/dash', 'dash.manager', 'fa fa-bitbucket', 0, '', 6, '2018-04-18 04:09:12', '2018-04-23 03:38:53'),
(23, '文件回收', 'admin/dash', 'filedash.list', 'fa fa-file-code-o', 22, '', 0, '2018-04-18 04:10:36', '2018-04-18 04:10:36'),
(24, '商品分类（测试）', 'admin/goodscategory', 'goodscategory.manage', 'fa fa-cogs', 0, '', 7, '2018-04-19 09:28:15', '2018-04-23 03:38:58'),
(25, '商品分类', 'admin/goodscategory', 'goodscategory.list', 'fa fa-cog', 24, '', 0, '2018-04-19 09:28:45', '2018-04-19 09:28:45');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_tables', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_06_02_131817_create_menus_table', 1),
('2017_06_29_024954_entrust_setup_tables', 1),
('2018_03_30_091349_create_db_file', 2),
('2018_03_30_100255_create_cy_goods', 3),
('2018_03_30_103147_create_cy_goods_attr', 4),
('2018_03_30_104147_create_cy_goods_gallery', 5),
('2018_03_30_105032_creat_cy_goods_category', 6),
('2018_03_30_110212_create_cy_message', 7),
('2018_03_30_112547_create_cy_ticket', 8),
('2018_03_30_114152_create_cy_user_ticket', 8),
('2018_03_30_115832_create_cy_order', 9),
('2018_03_30_120007_create_cy_order_goods', 10),
('2018_04_02_135535_create_cy_businesses', 11),
('2018_04_03_143959_add_field_in_businesses', 12),
('2018_04_03_151425_create_cy_staff', 13),
('2018_04_04_091730_change_field_in_staff', 14),
('2018_04_04_094417_add_field_in_goods', 15),
('2018_04_04_141851_create_cy_calsses', 16),
('2018_04_09_151946_change_columns_in_order_table', 17),
('2018_04_09_152911_add_field_in_cy_businesses', 18),
('2018_04_10_144704_create_cy_goods_price', 19),
('2018_04_11_184113_change_field_in_cy_file', 20),
('2018_04_11_184733_change_field_in_cy_file', 21),
('2018_04_11_111656_add_field_in_table_goods_gallery', 22),
('2018_04_11_140307_add_field_in_table_goods_grallery', 23),
('2018_04_13_142855_change_field_in_goods_attr', 23),
('2018_04_13_145025_change_save_name_in_cy_file', 24),
('2018_04_13_145428_change_save_name_in_cy_files', 25),
('2018_04_13_152515_change_field_goods_attr_id', 26),
('2018_04_16_133402_create_table_comment', 27),
('2018_04_16_122832_add_field_in_table_goods_price', 28),
('2018_04_19_165356_add_field_in_table_goods_category', 29);

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'system.manage', '系统管理', '系统管理', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(2, 'menus.list', '目录列表', '目录列表', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(3, 'menus.add', '添加目录', '添加目录', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(4, 'menus.edit', '修改目录', '修改目录', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(5, 'menus.delete', '删除目录', '删除目录', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(6, 'adminuser.list', '后台用户列表', '后台用户列表', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(7, 'adminuser.add', '添加后台用户', '添加后台用户', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(8, 'adminuser.edit', '修改后台用户', '修改后台用户', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(9, 'adminuser.delete', '删除后台用户', '删除后台用户', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(10, 'permission.list', '权限列表', '权限列表', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(11, 'permission.add', '添加权限', '添加权限', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(12, 'permission.edit', '修改权限', '修改权限', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(13, 'permission.delete', '删除权限', '删除权限', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(14, 'role.list', '角色列表', '角色列表', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(15, 'role.add', '添加角色', '添加角色', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(16, 'role.edit', '修改角色', '修改角色', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(17, 'role.delete', '删除角色', '删除角色', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(18, 'businesses.manage', '商户总权限', '商户权限', '2018-03-29 05:57:15', '2018-04-02 09:09:58'),
(19, 'statistics.manage', '统计总权限', '统计总权限', '2018-04-02 07:59:32', '2018-04-02 07:59:32'),
(20, 'businesses.list', '商户列表权限', '商户列表权限', '2018-04-02 08:06:08', '2018-04-02 09:09:47'),
(21, 'statistics.view', '查看统计权限', '查看统计权限', '2018-04-02 08:08:45', '2018-04-02 08:08:45'),
(22, 'businesses.add', '添加商户', '添加商户', '2018-04-02 09:59:55', '2018-04-02 09:59:55'),
(23, 'businesses.edit', '编辑商户', '编辑商户', '2018-04-03 01:11:06', '2018-04-03 01:21:08'),
(24, 'businesses.delete', '删除商户', '删除商户', '2018-04-03 01:11:41', '2018-04-03 01:21:16'),
(25, 'businesses.info', '查看商户信息', '查看商户详细信息', '2018-04-03 07:37:59', '2018-04-03 07:37:59'),
(26, 'staff.add', '新增员工信息', '新增员工信息', '2018-04-03 07:48:08', '2018-04-03 07:48:08'),
(27, 'staff.edit', '编辑商户员工', '编辑商户员工', '2018-04-03 09:31:48', '2018-04-03 09:31:48'),
(28, 'staff.delete', '删除商户员工', '删除商户员工', '2018-04-03 09:32:07', '2018-04-03 09:32:07'),
(29, 'goods.add', '商品添加', '商品添加', '2018-04-04 01:26:18', '2018-04-04 01:26:40'),
(30, 'goods.edit', '编辑商品', '编辑商品', '2018-04-04 01:49:31', '2018-04-04 01:49:31'),
(31, 'goods.delete', '删除商品', '删除商品', '2018-04-04 01:49:49', '2018-04-04 01:49:49'),
(32, 'classes.add', '分类添加权限', '分类添加权限', '2018-04-04 06:50:38', '2018-04-04 06:50:38'),
(33, 'classes.edit', '分类编辑权限', '分类编辑权限', '2018-04-04 06:51:01', '2018-04-04 06:51:01'),
(34, 'classes.delete', '分类删除权限', '分类删除权限', '2018-04-04 06:51:20', '2018-04-04 06:51:33'),
(35, 'classes.list', '分类列表权限', '分类列表权限', '2018-04-04 06:51:48', '2018-04-04 06:51:48'),
(36, 'order.list', '订单列表', '订单列表', '2018-04-09 02:07:59', '2018-04-09 02:07:59'),
(37, 'order.add', '添加订单', '添加订单', '2018-04-09 02:08:24', '2018-04-09 02:08:24'),
(38, 'order.edit', '订单编辑', '订单编辑', '2018-04-09 02:08:45', '2018-04-09 02:08:45'),
(39, 'order.delete', '订单删除', '订单删除', '2018-04-09 02:09:00', '2018-04-09 02:09:00'),
(40, 'order.info', '订单信息', '订单信息', '2018-04-09 02:09:22', '2018-04-09 02:09:22'),
(41, 'message.list', '消息管理', '管理消息', '2018-04-07 23:32:45', '2018-04-07 23:32:45'),
(42, 'message.add', '消息添加', '消息列表的添加', '2018-04-08 01:02:47', '2018-04-08 01:02:47'),
(43, 'message.edit', '消息编辑', '消息编辑', '2018-04-08 17:39:43', '2018-04-08 17:39:43'),
(44, 'message.delete', '消息删除', '消息删除', '2018-04-08 18:09:28', '2018-04-08 18:09:28'),
(45, 'message.info', '消息查看', '消息查看', '2018-04-08 18:28:33', '2018-04-08 18:28:33'),
(46, 'ticket.manage', '优惠券总权限', '优惠券总权限', '2018-04-08 23:02:15', '2018-04-08 23:10:45'),
(47, 'ticket.list', '优惠券列表权限', '优惠券列表权限', '2018-04-08 23:03:00', '2018-04-08 23:03:00'),
(48, 'ticket.add', '优惠券列表添加', '优惠券添加', '2018-04-09 00:25:30', '2018-04-09 00:27:51'),
(49, 'ticket.edit', '优惠券列表编辑', '优惠券列表编辑', '2018-04-09 00:27:00', '2018-04-09 00:27:00'),
(50, 'ticket.delete', '优惠券列表删除', '优惠券列表删除', '2018-04-09 00:28:36', '2018-04-09 00:28:36'),
(51, 'goods.info', '产品详情查看', '产品详情查看', '2018-04-10 02:30:44', '2018-04-10 02:30:44'),
(52, 'ticket.info', '优惠券查看', '优惠券查看', '2018-04-10 06:27:03', '2018-04-10 06:27:03'),
(53, 'file.manage', '文件管理总权限', '文件管理总权限', '2018-04-11 01:42:58', '2018-04-11 01:42:58'),
(54, 'file.list', '文件列表', '文件列表', '2018-04-11 01:43:10', '2018-04-11 01:43:10'),
(55, 'file.add', '文件列表添加', '文件列表添加', '2018-04-11 01:43:23', '2018-04-11 01:43:23'),
(56, 'file.edit', '文件列表修改', '文件列表修改', '2018-04-11 01:43:35', '2018-04-11 01:43:35'),
(57, 'file.delete', '文件列表删除', '文件列表删除', '2018-04-11 01:43:48', '2018-04-11 01:43:48'),
(58, 'file.info', '文件列表查看', '文件列表查看', '2018-04-11 01:44:02', '2018-04-11 01:44:02'),
(59, 'userticket.list', '用户优惠列表', '用户优惠列表', '2018-04-11 01:46:01', '2018-04-11 01:46:01'),
(60, 'userticket.add', '用户优惠劵添加', '用户优惠劵添加', '2018-04-11 01:46:14', '2018-04-11 01:46:14'),
(61, 'userticket.edit', '用户优惠劵修改', '用户优惠劵修改', '2018-04-11 01:46:24', '2018-04-11 01:46:24'),
(62, 'userticket.delete', '用户优惠劵删除', '用户优惠劵删除', '2018-04-11 01:46:35', '2018-04-11 01:46:35'),
(63, 'userticket.info', '用户优惠劵查看', '用户优惠劵查看', '2018-04-11 01:46:47', '2018-04-11 01:46:47'),
(64, 'gallery.list', '商品图片集列表', '商品图片集列表', '2018-04-12 01:02:21', '2018-04-12 01:02:21'),
(65, 'gallery.edit', '商品图片集修改', '商品图片集修改', '2018-04-12 01:02:33', '2018-04-12 01:02:33'),
(66, 'gallery.add', '商品图片集添加', '商品图片集添加', '2018-04-12 01:02:45', '2018-04-12 01:02:45'),
(67, 'gallery.delete', '商品图片集删除1', '商品图片集删除', '2018-04-12 01:02:54', '2018-04-12 05:11:20'),
(71, 'goodsprice.list', '商品价格权限', '商品价格权限', '2018-04-12 08:03:31', '2018-04-12 08:03:31'),
(72, 'goodsprice.add', '添加商品价格权限', '添加商品价格权限', '2018-04-12 08:04:00', '2018-04-12 08:04:00'),
(73, 'goodsprice.edit', '编辑商品价格权限', '编辑商品价格权限', '2018-04-12 08:04:27', '2018-04-12 08:04:27'),
(74, 'goodsprice.delete', '删除商品价格权限', '删除商品价格权限', '2018-04-12 08:04:47', '2018-04-12 08:04:47'),
(75, 'goodsprice.info', '查看商品价格权限', '查看商品价格权限', '2018-04-12 08:06:09', '2018-04-12 08:06:09'),
(76, 'goodsattr.add', '商品自定义属性添加', '商品自定义属性添加', '2018-04-13 06:00:59', '2018-04-13 06:00:59'),
(77, 'goodsattr.list', '商品自定义属性列表', '商品自定义属性列表', '2018-04-13 06:01:28', '2018-04-13 06:01:28'),
(78, 'goodsattr.edit', '商品自定义属性修改', '商品自定义属性修改', '2018-04-13 06:01:51', '2018-04-13 06:01:51'),
(79, 'goodsattr.delete', '删除自定义属性', '删除自定义属性', '2018-04-13 08:08:37', '2018-04-13 08:08:37'),
(80, 'comment.info', '评论查看权限', '评论查看权限', '2018-04-16 06:04:48', '2018-04-16 06:04:48'),
(81, 'dash.manager', '回收站管理', '回收站管理', '2018-04-18 04:02:37', '2018-04-18 04:02:37'),
(82, 'filedash.list', '文件回收站列表', '文件回收站列表', '2018-04-18 04:04:16', '2018-04-18 04:04:16'),
(83, 'filedash.delete', '回收站删除', '回收站删除', '2018-04-18 07:00:46', '2018-04-18 07:00:46'),
(84, 'goodscategory.list', ' 商品分类权限', ' 商品分类权限', '2018-04-19 09:26:38', '2018-04-19 09:26:38'),
(85, 'goodscategory.add', '添加商品分类权限', '添加商品分类权限', '2018-04-19 09:26:49', '2018-04-19 09:26:49'),
(86, 'goodscategory.edit', '编辑商品分类权限', '编辑商品分类权限', '2018-04-19 09:27:01', '2018-04-19 09:27:01'),
(87, 'goodscategory.delete', '删除商品分类权限', '删除商品分类权限', '2018-04-19 09:27:13', '2018-04-19 09:27:13'),
(88, 'goodscategory.info', '查看商品分类权限', '查看商品分类权限', '2018-04-19 09:27:27', '2018-04-19 09:27:27'),
(89, 'goodscategory.manage', '商品分类总权限', '商品分类总权限', '2018-04-19 09:27:39', '2018-04-19 09:27:39'),
(90, 'ordergoods.add', '订购产品权限添加', '订购产品权限添加', '2018-04-23 10:00:40', '2018-04-23 10:00:40'),
(91, 'ordergoods.edit', '订购产品权限编辑', '订购产品权限编辑', '2018-04-23 10:00:49', '2018-04-23 10:00:49'),
(92, 'ordergoods.delete', '订购产品权限删除', '订购产品权限删除', '2018-04-23 10:01:00', '2018-04-23 10:01:00');

-- --------------------------------------------------------

--
-- 表的结构 `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1);

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', '超级管理员', '管理后台的角色', '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(2, 'editor', '编辑', '编辑', '2018-03-28 10:14:21', '2018-03-28 10:14:21');

-- --------------------------------------------------------

--
-- 表的结构 `role_admin`
--

CREATE TABLE `role_admin` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `role_admin`
--

INSERT INTO `role_admin` (`user_id`, `role_id`) VALUES
(1, 1),
(3, 1),
(4, 1),
(2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'UserName', 'username@username.com', '$2y$10$IZ2KZ5qkKHTrNMNy6aG4KObiidQfPCRT5SVkdRnXy4fVeRV9vWAx6', NULL, '2018-03-28 10:14:21', '2018-03-28 10:14:21'),
(2, '老何', 'hcr@admin.com', '$2y$10$iK2Hl7gtixvW2PtLhRRBQOJWVKb3o4oNTPjrZ.zCD4F61NVkCKjeO', '4CNzYluv6Thp2EoRI34gKQeToMmOyDmoqF3lkVJGm94LmuUlAq9eaGzM3JQU', '2018-03-29 01:41:16', '2018-03-29 01:41:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cy_businesses`
--
ALTER TABLE `cy_businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_classes`
--
ALTER TABLE `cy_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_comment`
--
ALTER TABLE `cy_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_file`
--
ALTER TABLE `cy_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_goods`
--
ALTER TABLE `cy_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_goods_attr`
--
ALTER TABLE `cy_goods_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_goods_category`
--
ALTER TABLE `cy_goods_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_goods_gallery`
--
ALTER TABLE `cy_goods_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_goods_price`
--
ALTER TABLE `cy_goods_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_message`
--
ALTER TABLE `cy_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_order`
--
ALTER TABLE `cy_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_order_goods`
--
ALTER TABLE `cy_order_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_staff`
--
ALTER TABLE `cy_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_ticket`
--
ALTER TABLE `cy_ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cy_ticket_ticket_code_unique` (`ticket_code`);

--
-- Indexes for table `cy_user_ticket`
--
ALTER TABLE `cy_user_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_admin`
--
ALTER TABLE `role_admin`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_admin_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `cy_businesses`
--
ALTER TABLE `cy_businesses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `cy_classes`
--
ALTER TABLE `cy_classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=64;
--
-- 使用表AUTO_INCREMENT `cy_comment`
--
ALTER TABLE `cy_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `cy_file`
--
ALTER TABLE `cy_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=155;
--
-- 使用表AUTO_INCREMENT `cy_goods`
--
ALTER TABLE `cy_goods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `cy_goods_attr`
--
ALTER TABLE `cy_goods_attr`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `cy_goods_category`
--
ALTER TABLE `cy_goods_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cy_goods_gallery`
--
ALTER TABLE `cy_goods_gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `cy_goods_price`
--
ALTER TABLE `cy_goods_price`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `cy_message`
--
ALTER TABLE `cy_message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cy_order`
--
ALTER TABLE `cy_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cy_order_goods`
--
ALTER TABLE `cy_order_goods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cy_staff`
--
ALTER TABLE `cy_staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `cy_ticket`
--
ALTER TABLE `cy_ticket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `cy_user_ticket`
--
ALTER TABLE `cy_user_ticket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- 使用表AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 限制导出的表
--

--
-- 限制表 `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `role_admin`
--
ALTER TABLE `role_admin`
  ADD CONSTRAINT `role_admin_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_admin_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
