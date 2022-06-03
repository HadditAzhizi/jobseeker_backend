/*
 Navicat Premium Data Transfer

 Source Server         : Mysql Local
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : jobseeker_db

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 04/06/2022 04:36:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dt_admin
-- ----------------------------
DROP TABLE IF EXISTS `dt_admin`;
CREATE TABLE `dt_admin`  (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dt_admin
-- ----------------------------
INSERT INTO `dt_admin` VALUES (4, 'admin', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `dt_admin` VALUES (8, 'Muhammad Haddit', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for history
-- ----------------------------
DROP TABLE IF EXISTS `history`;
CREATE TABLE `history`  (
  `stock_code` int(255) NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `inventory_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `final_stock` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of history
-- ----------------------------
INSERT INTO `history` VALUES (1, '2020-01-01', 'A', '2');
INSERT INTO `history` VALUES (2, '2020-01-02', 'A', '5');
INSERT INTO `history` VALUES (3, '2020-01-02', 'B', '1');
INSERT INTO `history` VALUES (4, '2020-01-03', 'A', '3');
INSERT INTO `history` VALUES (5, '2020-01-03', 'B', '3');
INSERT INTO `history` VALUES (6, '2020-01-04', 'A', '5');
INSERT INTO `history` VALUES (7, '2020-01-04', 'A', '4');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `harga` int(255) NULL DEFAULT NULL,
  `kateg_id` int(11) NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_delete` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (16, 'Teh Manis Panas', '<p>Minuman teh manis</p>', 12000, 3, '1654104718.jpg', 0);
INSERT INTO `product` VALUES (17, 'Kopi', '<p>Kopi enak</p>', 5000, 3, '1654101538.jpg', 0);
INSERT INTO `product` VALUES (18, 'Bakso', '<p>Bakso Sip</p>', 12000, 2, '1654101563.jpg', 0);
INSERT INTO `product` VALUES (19, 'Mie ayam', '<p>Mie ayam</p>', 15000, 2, '1654101587.jpg', 0);
INSERT INTO `product` VALUES (20, 'Boba', '<p>Boba</p>', 20000, 3, '1654101613.jpg', 0);
INSERT INTO `product` VALUES (21, 'ADit132', '<p>asddasd12312</p>', 23123123, 3, '1654289061.jpg', 1);

-- ----------------------------
-- Table structure for product_kateg
-- ----------------------------
DROP TABLE IF EXISTS `product_kateg`;
CREATE TABLE `product_kateg`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_kateg
-- ----------------------------
INSERT INTO `product_kateg` VALUES (2, 'Makanan');
INSERT INTO `product_kateg` VALUES (3, 'Minuman');

-- ----------------------------
-- Table structure for product_stock
-- ----------------------------
DROP TABLE IF EXISTS `product_stock`;
CREATE TABLE `product_stock`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NULL DEFAULT NULL,
  `stock` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_stock
-- ----------------------------
INSERT INTO `product_stock` VALUES (2, 16, 81);
INSERT INTO `product_stock` VALUES (3, 17, 85);
INSERT INTO `product_stock` VALUES (4, 18, -4);
INSERT INTO `product_stock` VALUES (5, 19, -5);
INSERT INTO `product_stock` VALUES (6, 20, 4);
INSERT INTO `product_stock` VALUES (7, 21, 123);

-- ----------------------------
-- Table structure for transaksi_jual
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_jual`;
CREATE TABLE `transaksi_jual`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_penjualan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total` int(11) NULL DEFAULT NULL,
  `tgl_jual` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of transaksi_jual
-- ----------------------------
INSERT INTO `transaksi_jual` VALUES (5, '123123123', 56000, '2022-06-23');
INSERT INTO `transaksi_jual` VALUES (6, '324234', 180000, NULL);
INSERT INTO `transaksi_jual` VALUES (7, '43234234234', 135000, '2022-06-17');
INSERT INTO `transaksi_jual` VALUES (8, '424234234', 45000, '2022-06-04');
INSERT INTO `transaksi_jual` VALUES (9, '424234234', 45000, '2022-06-04');
INSERT INTO `transaksi_jual` VALUES (10, '424234234', 12000, '2022-06-04');

-- ----------------------------
-- Table structure for transaksi_jual_detail
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_jual_detail`;
CREATE TABLE `transaksi_jual_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `harga` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of transaksi_jual_detail
-- ----------------------------
INSERT INTO `transaksi_jual_detail` VALUES (9, '5', 16, '12000', 3);
INSERT INTO `transaksi_jual_detail` VALUES (10, '5', 17, '5000', 4);
INSERT INTO `transaksi_jual_detail` VALUES (11, '6', 16, '12000', 15);
INSERT INTO `transaksi_jual_detail` VALUES (12, '7', 19, '150000', 1);
INSERT INTO `transaksi_jual_detail` VALUES (13, '8', NULL, '50000', 1);
INSERT INTO `transaksi_jual_detail` VALUES (14, '9', NULL, '50000', 1);
INSERT INTO `transaksi_jual_detail` VALUES (15, '10', 18, '12000', 1);

SET FOREIGN_KEY_CHECKS = 1;
