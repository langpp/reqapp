/*
 Navicat Premium Data Transfer

 Source Server         : Server Local MySQL
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : reqapp_db

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 17/12/2020 22:02:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kategori_kebutuhan
-- ----------------------------
DROP TABLE IF EXISTS `kategori_kebutuhan`;
CREATE TABLE `kategori_kebutuhan`  (
  `kategori_kebutuhan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `icon` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  PRIMARY KEY (`kategori_kebutuhan_id`) USING BTREE,
  UNIQUE INDEX `kategori_kebutuhan_id`(`kategori_kebutuhan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori_kebutuhan
-- ----------------------------
INSERT INTO `kategori_kebutuhan` VALUES (1, 'Rumah Tangga', 'fa fa-home', 1, '2020-12-13 20:33:39', '2020-12-13 20:33:41');
INSERT INTO `kategori_kebutuhan` VALUES (4, 'Makanan', 'fa fa-hamburger', 1, '2020-12-14 02:20:02', '2020-12-14 02:20:02');
INSERT INTO `kategori_kebutuhan` VALUES (5, 'Kebutuhan Pokok', 'fa fa-seedling', 1, '2020-12-14 02:20:16', '2020-12-14 02:20:16');

-- ----------------------------
-- Table structure for kebutuhan
-- ----------------------------
DROP TABLE IF EXISTS `kebutuhan`;
CREATE TABLE `kebutuhan`  (
  `kebutuhan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kebutuhan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kategori_kebutuhan_id` int(11) NOT NULL,
  `satuan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  PRIMARY KEY (`kebutuhan_id`) USING BTREE,
  UNIQUE INDEX `kebutuhan_id`(`kebutuhan_id`) USING BTREE,
  INDEX `kategori_kebutuhan_id`(`kategori_kebutuhan_id`) USING BTREE,
  CONSTRAINT `kebutuhan_ibfk_1` FOREIGN KEY (`kategori_kebutuhan_id`) REFERENCES `kategori_kebutuhan` (`kategori_kebutuhan_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kebutuhan
-- ----------------------------
INSERT INTO `kebutuhan` VALUES (4, 'Piring', 'Piring Keramik', 1, 'Lusin', 1, '1607878283_1922c81e63cdd307b7f7.jpeg', '2020-12-13 10:51:23', '2020-12-13 10:58:30');
INSERT INTO `kebutuhan` VALUES (5, 'Meses Coklat', 'Meses Coklat dengan merek Meses Ceres.', 4, 'Pcs', 1, '1607934068_29ea4535c211c885ae16.jpg', '2020-12-14 02:21:08', '2020-12-14 02:21:08');
INSERT INTO `kebutuhan` VALUES (6, 'Roti Tawar Double Soft', 'Roti Tawar Double Soft dengan merek Sari Roti.', 4, 'Pcs', 1, '1607934174_9b56db50739c199e4f6c.png', '2020-12-14 02:22:55', '2020-12-14 02:22:55');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_dinas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_dinas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_telepon` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role_id` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `user_id`(`user_id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Sekretariat Daerah Kab. Purwakarta', 'Jl. Gandanegara No. 25 Purwakarta', '(0264) 2000036', 'sekda@gmail.com', '$2y$10$yb9c4tv2OfbVzymM1Ew6AODeBaMn3vhgm6E6DbQBRmlBpJLtUqtYS', 2, 1, '2020-12-13 19:18:43', '2020-12-13 19:18:45');
INSERT INTO `users` VALUES (2, 'Dinas Perhubungan Kabupaten Purwakarta', 'Jl. Veteran No.1, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118', '(0264) 200105', 'dinas.perhubungan@gmail.com', '$2y$10$yb9c4tv2OfbVzymM1Ew6AODeBaMn3vhgm6E6DbQBRmlBpJLtUqtYS', 3, 1, '2020-12-14 11:08:54', '2020-12-14 11:08:57');

SET FOREIGN_KEY_CHECKS = 1;
