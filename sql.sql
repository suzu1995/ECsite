CREATE TABLE `t_sale` (
  `sale_code` int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY ,
  `sale_date` timestamp NOT NULL,
  `code_member` int(11) DEFAULT NULL,
  `sale_name` varchar(15) DEFAULT NULL,
  `sale_email` varchar(50) DEFAULT NULL,
  `sale_postal1` varchar(3) DEFAULT NULL,
  `sale_postal2` varchar(4) DEFAULT NULL,
  `sale_address` varchar(50) DEFAULT NULL,
  `sale_tel` varchar(13) DEFAULT NULL
);
CREATE TABLE `t_detail` (
  `detail_code` int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY ,
  `sale_code` int(11) NOT NULL,
  `product_code` int(11) DEFAULT NULL,
  `detail_price` int(11) DEFAULT NULL,
  `detail_quantity` int(11) DEFAULT NULL
);
CREATE TABLE `m_member` (
  `member_code` int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY ,
  `member_date` timestamp NOT NULL,
  `member_password` int(32) DEFAULT NULL,
  `member_name` varchar(15) DEFAULT NULL,
  `member_email` varchar(50) DEFAULT NULL,
  `member_postal1` varchar(3) DEFAULT NULL,
  `member_postal2` varchar(4) DEFAULT NULL,
  `member_address` varchar(50) DEFAULT NULL,
  `member_tel` varchar(13) DEFAULT NULL,
  `member_sex` int(2) DEFAULT NULL,
  `member_birth` int(20) DEFAULT NULL
);