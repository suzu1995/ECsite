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