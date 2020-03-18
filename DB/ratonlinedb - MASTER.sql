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

 Date: 19/03/2020 04:30:05
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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of anggota
-- ----------------------------
INSERT INTO `anggota` VALUES (1, 'Master Admin', 'Bogor', '2020-03-17', 'laki - laki', NULL, NULL, NULL, 'default.png', 0, 'admin', '$2y$10$0lwXy2rpbaWMO4lLTiLmWuWX5ynVpxqhA.ui3MA3BQYd/K9QrK3gW');
INSERT INTO `anggota` VALUES (3, 'Anggota 1', '', '2020-03-18', 'laki - laki', '', '', '', 'default.png', 9, 'anggota1', '$2y$10$R3t8MUEYsafY/dajHiJ1vu.KepFGqMg1bn0WYOh78WnSTl9sHXIaC');
INSERT INTO `anggota` VALUES (4, 'anggota2', '', '2020-03-18', 'laki - laki', '', '', '', 'default.png', 1, 'anggota2', '$2y$10$EG9oeERTs/7Y69QA0PsOmuvK0G3oowPNbxbcIZ.PEFAg9O922dEZy');
INSERT INTO `anggota` VALUES (5, 'anggota3', 'Bogor', '2020-03-18', 'laki - laki', '014198491', 'nskgnsgbiosbio', '07916591', '30cf3a825dcd177e01f514ca831f399c.png', 9, 'anggota3', '$2y$10$34hK2iTe10L58W0whSbWe.rbA5CA2MbKcArKG199v7a.OqRm5uVRW');

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of anggota_polling
-- ----------------------------
INSERT INTO `anggota_polling` VALUES (5, 2, 3, 4);

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of file_rat
-- ----------------------------
INSERT INTO `file_rat` VALUES (3, 2, 3, 'SKB Revisi Libur Nasional 2020', 'SKB_Revisi_Libur_Nasional_2020__pdf.pdf', 'ya');
INSERT INTO `file_rat` VALUES (4, 2, 1, 'Surat Pemberitahuan Peserta (Owner)', 'Surat_Pemberitahuan_Peserta_(Owner).pdf', 'tidak');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of polling
-- ----------------------------
INSERT INTO `polling` VALUES (3, 2, 4, 1);

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
  `polling_mulai` date NULL DEFAULT NULL,
  `polling_akhir` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rat
-- ----------------------------
INSERT INTO `rat` VALUES (2, 'R0001', 2020, '2020-03-19', '2020-03-25', 4, 'Ini Judul Kata Pengantar<br />\r\nSedangkan ini isi Kata pengantarnya, yang akan menghantarkan anda tertidur lelap dalam kenangan sepanjang masa, yang abadi. Tak kukira ini akan segera berakhir dalam waktu 1 malam saja. Ingin ku merenung sejenak di kegelapan malam ini, menanti fajar kan datang, lalu senja berganti. Begitu lah kisah hidup anak muda yang sedang melewati ujian kehidupan ini. Semoga akhir yang indah menjadi nyata, dan disana tempat ku beristirahat selamanya, bukan di tempat ini. Semangat...', '1', '2020-03-19', '2020-03-20');

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of respon_rat
-- ----------------------------
INSERT INTO `respon_rat` VALUES (5, 2, 3, 3, 1, 'Ya saya sangat Setuju Sekali');

SET FOREIGN_KEY_CHECKS = 1;
