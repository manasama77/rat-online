/*
 Navicat Premium Data Transfer

 Source Server         : maria 7.3
 Source Server Type    : MariaDB
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : ratonlinedb

 Target Server Type    : MariaDB
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 18/03/2020 19:41:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for anggota
-- ----------------------------
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `jenis_kelamin` enum('laki - laki','perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_ktp` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telp` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_jabatan` int(25) NULL DEFAULT NULL COMMENT 'refer tabel list_kode (a.k.a tbl_parameter)',
  `user_login` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password_login` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of anggota
-- ----------------------------
INSERT INTO `anggota` VALUES (1, 'Master Admin', 'Bogor', '2020-03-17', 'laki - laki', NULL, NULL, NULL, 'default.png', 0, 'admin', '$2y$10$0lwXy2rpbaWMO4lLTiLmWuWX5ynVpxqhA.ui3MA3BQYd/K9QrK3gW');
INSERT INTO `anggota` VALUES (2, 'Adam PM', 'Bogor', '1990-09-05', 'laki - laki', '0123', 'Bogor', '08123', 'ca14565c1abf3a41c8c85a95f6056e68.png', 0, 'adam', '$2y$10$eXrR/kCBWK0ySRl23FgVIOtvsnjC6DIxN/UqSm1PDRqSwefESuwv.');

-- ----------------------------
-- Table structure for file_rat
-- ----------------------------
DROP TABLE IF EXISTS `file_rat`;
CREATE TABLE `file_rat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_laporan` int(255) NULL DEFAULT NULL COMMENT 'refer tabel list_kode (a.k.a tbl_parameter)',
  `id_laporan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_laporan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file_laporan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `flag_respon` enum('ya','tidak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for koperasi
-- ----------------------------
DROP TABLE IF EXISTS `koperasi`;
CREATE TABLE `koperasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_koperasi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of koperasi
-- ----------------------------
INSERT INTO `koperasi` VALUES (1, 'Test', 'Test', '0123', '0123');

-- ----------------------------
-- Table structure for list_kode
-- ----------------------------
DROP TABLE IF EXISTS `list_kode`;
CREATE TABLE `list_kode`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_list` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_list` int(11) NULL DEFAULT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of list_kode
-- ----------------------------
INSERT INTO `list_kode` VALUES (1, 'jabatan', 0, 'Admin');
INSERT INTO `list_kode` VALUES (2, 'jabatan', 1, 'Ketua Pengurus');
INSERT INTO `list_kode` VALUES (3, 'jabatan', 2, 'Sekertaris');
INSERT INTO `list_kode` VALUES (4, 'jabatan', 3, 'Bendahara');
INSERT INTO `list_kode` VALUES (5, 'jabatan', 9, 'Anggota');
INSERT INTO `list_kode` VALUES (7, 'jabatan', 4, 'Test Aja');

-- ----------------------------
-- Table structure for rat
-- ----------------------------
DROP TABLE IF EXISTS `rat`;
CREATE TABLE `rat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_rat` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `th_buku` year NULL DEFAULT NULL,
  `rat_mulai` date NULL DEFAULT NULL,
  `rat_akhir` date NULL DEFAULT NULL,
  `id_ketua_pengurus` int(11) NULL DEFAULT NULL COMMENT 'refer table anggota',
  `kata_pengantar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ketua_sidang` int(11) NULL DEFAULT NULL COMMENT 'refer tabel anggota',
  `status_rat` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rat
-- ----------------------------
INSERT INTO `rat` VALUES (1, 'R0001', 2020, '2020-03-18', '2020-03-26', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, '0');

-- ----------------------------
-- Table structure for respon_rat
-- ----------------------------
DROP TABLE IF EXISTS `respon_rat`;
CREATE TABLE `respon_rat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rat` int(11) NULL DEFAULT NULL,
  `id_laporan` int(11) NULL DEFAULT NULL,
  `id_anggota` int(11) NULL DEFAULT NULL,
  `respon` int(11) NULL DEFAULT NULL COMMENT 'refer tabel list_kode (a.k.a tbl_parameter)',
  `ket_respon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
