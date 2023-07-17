/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1_3306
 Source Server Type    : MySQL
 Source Server Version : 80033 (8.0.33)
 Source Host           : 127.0.0.1:3306
 Source Schema         : skripsi_lia_hotel1

 Target Server Type    : MySQL
 Target Server Version : 80033 (8.0.33)
 File Encoding         : 65001

 Date: 17/07/2023 12:49:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `admin_username` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `admin_nama` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `admin_password` char(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`admin_username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('admin', 'Yusuf Tangkuni S.T', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for ambil
-- ----------------------------
DROP TABLE IF EXISTS `ambil`;
CREATE TABLE `ambil`  (
  `lt_id` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `harga` mediumint NOT NULL,
  PRIMARY KEY (`lt_id`, `id_transaksi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for check_in
-- ----------------------------
DROP TABLE IF EXISTS `check_in`;
CREATE TABLE `check_in`  (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` date NOT NULL,
  `tgl_check_in` date NOT NULL,
  `jumlahorang` tinyint(1) NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'booking = saat baru dipesan, belum diapa2in admin ### tagihan = saat sudah diinput tagihan oleh admin, pelanggan melihat tagihan ### non-valid = saat pelanggan sudah upload bukti bayar tapi belum divalidasi ###, valid, checkin, checkout',
  `keterangan_reservasi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_ktp` char(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `invoice_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `invoice_bukti` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `invoice_status` tinyint(1) NOT NULL DEFAULT 0,
  `invoice_total` int NOT NULL DEFAULT 0,
  `admin_username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `no_ktp` char(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `customer_nama` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `customer_email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `customer_hp` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `customer_alamat` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `customer_password` char(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`no_ktp`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fasilitas_kamar
-- ----------------------------
DROP TABLE IF EXISTS `fasilitas_kamar`;
CREATE TABLE `fasilitas_kamar`  (
  `id_fk` int NOT NULL AUTO_INCREMENT,
  `Shower` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'T' COMMENT '(Ya), (Tidak)',
  `Closet_Jongkok` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'T' COMMENT '(Ya), (Tidak)',
  `Closet_Duduk` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'T' COMMENT '(Ya), (Tidak)',
  `TV` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'T' COMMENT '(Ya), (Tidak)',
  `Wifi` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'T' COMMENT '(Ya), (Tidak)',
  `Breakfast` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'T' COMMENT '(Ya), (Tidak)',
  `Lunch` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'T' COMMENT '(Ya), (Tidak)',
  `Lemari` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'T' COMMENT '(Ya), (Tidak)',
  `AC` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'T' COMMENT '(Ya), (Tidak)',
  `kamar_id` int NOT NULL,
  PRIMARY KEY (`id_fk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kamar
-- ----------------------------
DROP TABLE IF EXISTS `kamar`;
CREATE TABLE `kamar`  (
  `kamar_id` int NOT NULL AUTO_INCREMENT,
  `kamar_nama` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `kamar_ranjang` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `kamar_ukuran` tinyint NOT NULL,
  `kamar_kategori` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `kamar_harga` mediumint NOT NULL,
  `kamar_foto1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `kamar_jumlah` tinyint(1) NOT NULL,
  PRIMARY KEY (`kamar_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for layanan_tambahan
-- ----------------------------
DROP TABLE IF EXISTS `layanan_tambahan`;
CREATE TABLE `layanan_tambahan`  (
  `lt_id` int NOT NULL AUTO_INCREMENT,
  `lt_nama` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lt_harga` mediumint NOT NULL,
  PRIMARY KEY (`lt_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nokamar
-- ----------------------------
DROP TABLE IF EXISTS `nokamar`;
CREATE TABLE `nokamar`  (
  `nokamar` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'karena selalu 3 digit',
  `lantai` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '1,2,3 karena 3 lantai',
  `kosong` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Y' COMMENT 'Y = ya, T = Tidak',
  `kamar_id` int NOT NULL,
  PRIMARY KEY (`nokamar`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for punya
-- ----------------------------
DROP TABLE IF EXISTS `punya`;
CREATE TABLE `punya`  (
  `id_transaksi` int NOT NULL,
  `kamar_id` int NOT NULL,
  `harga` mediumint NOT NULL,
  `lama_inap` tinyint NOT NULL,
  `nokamar` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`, `kamar_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
