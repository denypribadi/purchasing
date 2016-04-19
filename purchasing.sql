/*
Navicat MySQL Data Transfer

Source Server         : LocalHost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : purchasing

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-04-19 08:11:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_department
-- ----------------------------
DROP TABLE IF EXISTS `m_department`;
CREATE TABLE `m_department` (
  `id_department` varchar(2) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_department
-- ----------------------------
INSERT INTO `m_department` VALUES ('01', 'Accounting');
INSERT INTO `m_department` VALUES ('02', 'Operational');
INSERT INTO `m_department` VALUES ('03', 'Others');

-- ----------------------------
-- Table structure for m_item
-- ----------------------------
DROP TABLE IF EXISTS `m_item`;
CREATE TABLE `m_item` (
  `id_item` varchar(4) NOT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `warehouse` enum('material','beverage','food') DEFAULT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_item
-- ----------------------------
INSERT INTO `m_item` VALUES ('B001', 'AIR MINERAL', 'beverage');
INSERT INTO `m_item` VALUES ('B002', 'SIRUP', 'beverage');
INSERT INTO `m_item` VALUES ('F001', 'BERAS', 'food');
INSERT INTO `m_item` VALUES ('F002', 'GULA', 'food');
INSERT INTO `m_item` VALUES ('M001', 'PESIL', 'material');
INSERT INTO `m_item` VALUES ('M002', 'KERTAS A4', 'material');

-- ----------------------------
-- Table structure for m_supplier
-- ----------------------------
DROP TABLE IF EXISTS `m_supplier`;
CREATE TABLE `m_supplier` (
  `id_supplier` varchar(6) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `telphone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_supplier
-- ----------------------------
INSERT INTO `m_supplier` VALUES ('SUP001', 'TOTOK SUPPLIER', 'Jl. Ngagel Jaya Utara 12', 'SURABAYA', '0987654321');
INSERT INTO `m_supplier` VALUES ('SUP002', 'ROHMAN SUPPLIER', 'Jl. Semampir 2', 'SURABAYA', '0123456789');

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `id_user` varchar(7) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` mediumtext NOT NULL,
  `full_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('EMP0101', 'deny', '05afb6ce69b9cef1bd6ece7e4745f96c', 'deny setiawan');
INSERT INTO `m_user` VALUES ('EMP0102', 'slamet', 'c5a42d9667c760e1b7c064e25536e570', 'Slamet Suharko');
INSERT INTO `m_user` VALUES ('EMP0201', 'helda', '5af96a92cb754586687f6e7cf7a616a6', 'helda himawan');
INSERT INTO `m_user` VALUES ('EMP0202', 'taufik', 'd4305d7ed2ec97107cd6eb8dd4b6f6b7', 'taufik hidayat');

-- ----------------------------
-- Table structure for t_po
-- ----------------------------
DROP TABLE IF EXISTS `t_po`;
CREATE TABLE `t_po` (
  `id_po` varchar(5) NOT NULL,
  `date` datetime NOT NULL,
  `supplier` varchar(6) NOT NULL,
  `pr_header` varchar(5) NOT NULL,
  PRIMARY KEY (`id_po`),
  KEY `pr_header` (`pr_header`),
  KEY `supplier` (`supplier`),
  CONSTRAINT `t_po_ibfk_1` FOREIGN KEY (`pr_header`) REFERENCES `t_pr_header` (`id_pr`),
  CONSTRAINT `t_po_ibfk_2` FOREIGN KEY (`supplier`) REFERENCES `m_supplier` (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_po
-- ----------------------------
INSERT INTO `t_po` VALUES ('PO001', '2016-04-16 00:34:40', 'SUP001', 'PR001');
INSERT INTO `t_po` VALUES ('PO002', '2016-04-16 00:34:56', 'SUP002', 'PR002');

-- ----------------------------
-- Table structure for t_pr_detail
-- ----------------------------
DROP TABLE IF EXISTS `t_pr_detail`;
CREATE TABLE `t_pr_detail` (
  `id_pr_detail` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(4) NOT NULL,
  `qty` int(3) NOT NULL,
  `pr_header` varchar(5) NOT NULL,
  PRIMARY KEY (`id_pr_detail`),
  KEY `item` (`item`),
  KEY `pr_header` (`pr_header`),
  CONSTRAINT `t_pr_detail_ibfk_1` FOREIGN KEY (`item`) REFERENCES `m_item` (`id_item`),
  CONSTRAINT `t_pr_detail_ibfk_2` FOREIGN KEY (`pr_header`) REFERENCES `t_pr_header` (`id_pr`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_pr_detail
-- ----------------------------
INSERT INTO `t_pr_detail` VALUES ('1', 'B001', '2', 'PR001');
INSERT INTO `t_pr_detail` VALUES ('2', 'F001', '5', 'PR001');
INSERT INTO `t_pr_detail` VALUES ('3', 'M001', '10', 'PR001');
INSERT INTO `t_pr_detail` VALUES ('4', 'B002', '1', 'PR002');
INSERT INTO `t_pr_detail` VALUES ('5', 'F002', '2', 'PR002');
INSERT INTO `t_pr_detail` VALUES ('6', 'M002', '3', 'PR002');
INSERT INTO `t_pr_detail` VALUES ('12', 'B002', '5', 'PR001');
INSERT INTO `t_pr_detail` VALUES ('13', 'B002', '5', 'PR001');
INSERT INTO `t_pr_detail` VALUES ('14', 'B002', '5', 'PR001');

-- ----------------------------
-- Table structure for t_pr_header
-- ----------------------------
DROP TABLE IF EXISTS `t_pr_header`;
CREATE TABLE `t_pr_header` (
  `id_pr` varchar(5) NOT NULL,
  `user` varchar(7) NOT NULL,
  `department` varchar(2) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_pr`),
  KEY `user` (`user`),
  KEY `department` (`department`),
  CONSTRAINT `t_pr_header_ibfk_1` FOREIGN KEY (`user`) REFERENCES `m_user` (`id_user`),
  CONSTRAINT `t_pr_header_ibfk_2` FOREIGN KEY (`department`) REFERENCES `m_department` (`id_department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_pr_header
-- ----------------------------
INSERT INTO `t_pr_header` VALUES ('PR001', 'EMP0101', '01', '2016-04-16 00:15:30');
INSERT INTO `t_pr_header` VALUES ('PR002', 'EMP0201', '02', '2016-04-16 00:15:30');
INSERT INTO `t_pr_header` VALUES ('PR003', 'EMP0101', '01', '2016-04-18 14:57:06');

-- ----------------------------
-- Table structure for t_rr_detail
-- ----------------------------
DROP TABLE IF EXISTS `t_rr_detail`;
CREATE TABLE `t_rr_detail` (
  `id_rr_detail` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(4) NOT NULL,
  `qty` int(3) NOT NULL,
  `rr_header` varchar(5) NOT NULL,
  PRIMARY KEY (`id_rr_detail`),
  KEY `item` (`item`),
  KEY `rr_header` (`rr_header`),
  CONSTRAINT `t_rr_detail_ibfk_1` FOREIGN KEY (`item`) REFERENCES `m_item` (`id_item`),
  CONSTRAINT `t_rr_detail_ibfk_2` FOREIGN KEY (`rr_header`) REFERENCES `t_rr_header` (`id_rr`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_rr_detail
-- ----------------------------
INSERT INTO `t_rr_detail` VALUES ('1', 'B001', '2', 'RR001');
INSERT INTO `t_rr_detail` VALUES ('2', 'F001', '3', 'RR001');
INSERT INTO `t_rr_detail` VALUES ('3', 'M001', '4', 'RR001');
INSERT INTO `t_rr_detail` VALUES ('4', 'B002', '1', 'RR002');
INSERT INTO `t_rr_detail` VALUES ('5', 'F002', '2', 'RR002');
INSERT INTO `t_rr_detail` VALUES ('6', 'M002', '3', 'RR002');

-- ----------------------------
-- Table structure for t_rr_header
-- ----------------------------
DROP TABLE IF EXISTS `t_rr_header`;
CREATE TABLE `t_rr_header` (
  `id_rr` varchar(5) NOT NULL,
  `date` datetime NOT NULL,
  `supplier` varchar(6) NOT NULL,
  `id_po` varchar(5) NOT NULL,
  PRIMARY KEY (`id_rr`),
  KEY `id_po` (`id_po`),
  KEY `supplier` (`supplier`),
  CONSTRAINT `t_rr_header_ibfk_1` FOREIGN KEY (`id_po`) REFERENCES `t_po` (`id_po`),
  CONSTRAINT `t_rr_header_ibfk_2` FOREIGN KEY (`supplier`) REFERENCES `m_supplier` (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_rr_header
-- ----------------------------
INSERT INTO `t_rr_header` VALUES ('RR001', '2016-04-16 00:36:22', 'SUP001', 'PO001');
INSERT INTO `t_rr_header` VALUES ('RR002', '2016-04-16 00:36:39', 'SUP002', 'PO002');
