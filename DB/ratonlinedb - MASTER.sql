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

 Date: 24/03/2020 07:11:17
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
  `flag_ketua_sidang` enum('ya','tidak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of anggota
-- ----------------------------
INSERT INTO `anggota` VALUES (1, 'Master Admin', 'Bogor', '2020-03-17', 'laki - laki', NULL, NULL, NULL, 'default.png', 0, 'admin', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (2, 'Ex Ketua Pengurus', 'Bogor', '2020-03-17', 'laki - laki', '123456', 'test alamat', '123456', 'default.png', 1, 'ex_ketua_pengurus', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'ya');
INSERT INTO `anggota` VALUES (3, 'Ex Sekertaris', 'Bogor', '2020-03-17', 'laki - laki', '123456', 'test alamat', '123456', 'default.png', 2, 'ex_sekertaris', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (4, 'Ex Bendahara', 'Bogor', '2020-03-17', 'laki - laki', '123456', 'test alamat', '123456', 'default.png', 3, 'ex_bendahara', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (5, 'Anggota1', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota1', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (6, 'Anggota2', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota2', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (7, 'Anggota3', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota3', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (8, 'Anggota4', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota4', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (9, 'Anggota5', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota5', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (10, 'Anggota6', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota6', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (11, 'Anggota7', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota7', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (12, 'Anggota8', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota8', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (13, 'Anggota9', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota9', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (14, 'Anggota10', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'anggota10', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (15, 'Karyawan1', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan1', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (16, 'Karyawan2', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan2', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (17, 'Karyawan3', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan3', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (18, 'Karyawan4', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan4', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (19, 'Karyawan5', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan5', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (20, 'Karyawan6', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan6', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (21, 'Karyawan7', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan7', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (22, 'Karyawan8', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan8', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (23, 'Karyawan9', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan9', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');
INSERT INTO `anggota` VALUES (24, 'Karyawan10', 'Bogor', '2020-03-17', 'laki - laki', '1234567890', 'Test Alamat', '08123456789', 'default.png', 9, 'karyawan10', '$2y$10$DgHrkyl.nELfv9HiXpZ2Ieau9RGwCNYhIsg1duVUEk/vDNQMnjila', 'tidak');

-- ----------------------------
-- Table structure for anggota_polling
-- ----------------------------
DROP TABLE IF EXISTS `anggota_polling`;
CREATE TABLE `anggota_polling`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rat` int(11) NULL DEFAULT NULL,
  `id_pemilih` int(11) NULL DEFAULT NULL,
  `id_pilihan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for anggota_polling_pengurus
-- ----------------------------
DROP TABLE IF EXISTS `anggota_polling_pengurus`;
CREATE TABLE `anggota_polling_pengurus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rat` int(11) NULL DEFAULT NULL,
  `id_pemilih` int(11) NULL DEFAULT NULL,
  `id_pilihan` int(11) NULL DEFAULT NULL,
  `id_jabatan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for file_rat
-- ----------------------------
DROP TABLE IF EXISTS `file_rat`;
CREATE TABLE `file_rat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rat` int(11) NULL DEFAULT NULL COMMENT 'refer tabel rat',
  `id_jenis_laporan` int(255) NULL DEFAULT NULL COMMENT 'refer tabel list_kode (a.k.a tbl_parameter)',
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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of list_kode
-- ----------------------------
INSERT INTO `list_kode` VALUES (1, 'Jabatan', 0, 'Admin');
INSERT INTO `list_kode` VALUES (2, 'jabatan', 1, 'Ketua Pengurus');
INSERT INTO `list_kode` VALUES (3, 'jabatan', 2, 'Sekertaris');
INSERT INTO `list_kode` VALUES (4, 'jabatan', 3, 'Bendahara');
INSERT INTO `list_kode` VALUES (5, 'jabatan', 9, 'Anggota');
INSERT INTO `list_kode` VALUES (8, 'jenis_laporan', 1, 'Laporan Keuangan');
INSERT INTO `list_kode` VALUES (9, 'jenis_laporan', 2, 'Laporan Kinerja');
INSERT INTO `list_kode` VALUES (10, 'jenis_laporan', 3, 'Laporan Rencana Kerja');
INSERT INTO `list_kode` VALUES (11, 'respon', 1, 'Menyetujui Laporan');
INSERT INTO `list_kode` VALUES (12, 'respon', 2, 'Menolak Laporan');
INSERT INTO `list_kode` VALUES (13, 'respon', 3, 'Tidak Berpendapat');

-- ----------------------------
-- Table structure for polling
-- ----------------------------
DROP TABLE IF EXISTS `polling`;
CREATE TABLE `polling`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rat` int(11) NULL DEFAULT NULL,
  `id_anggota` int(11) NULL DEFAULT NULL,
  `vote` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for polling_pengurus
-- ----------------------------
DROP TABLE IF EXISTS `polling_pengurus`;
CREATE TABLE `polling_pengurus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rat` int(11) NULL DEFAULT NULL,
  `id_anggota` int(11) NULL DEFAULT NULL,
  `vote` int(11) NULL DEFAULT NULL,
  `id_jabatan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
  `id_ketua_sidang` int(11) NULL DEFAULT NULL COMMENT 'refer table anggota',
  `kata_pengantar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_rat` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `flag_aktif` enum('ya','tidak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `berita_acara` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_prev_ketua_pengurus` int(11) NULL DEFAULT NULL,
  `id_prev_sekertaris` int(11) NULL DEFAULT NULL,
  `id_prev_bendahara` int(11) NULL DEFAULT NULL,
  `id_new_ketua_pengurus` int(11) NULL DEFAULT NULL,
  `id_new_sekertaris` int(11) NULL DEFAULT NULL,
  `id_new_bendahara` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for respon_rat
-- ----------------------------
DROP TABLE IF EXISTS `respon_rat`;
CREATE TABLE `respon_rat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rat` int(11) NULL DEFAULT NULL,
  `id_file_rat` int(11) NULL DEFAULT NULL,
  `id_anggota` int(11) NULL DEFAULT NULL,
  `id_respon` int(11) NULL DEFAULT NULL COMMENT 'refer tabel list_kode (a.k.a tbl_parameter)',
  `ket_respon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
