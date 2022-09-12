/*
 Navicat Premium Data Transfer

 Source Server         : web-slip-project
 Source Server Type    : MySQL
 Source Server Version : 100335
 Source Host           : 192.168.0.208:3306
 Source Schema         : sd_den_calendar

 Target Server Type    : MySQL
 Target Server Version : 100335
 File Encoding         : 65001

 Date: 30/05/2022 15:43:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for calendar
-- ----------------------------
DROP TABLE IF EXISTS `calendar`;
CREATE TABLE `calendar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `start` datetime NULL DEFAULT NULL,
  `end` datetime NULL DEFAULT NULL,
  `color` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pname_patient` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `patient_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `patient_tel` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `more` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of calendar
-- ----------------------------
INSERT INTO `calendar` VALUES (6, 'นพ.ทดสอบหมอ  ดีมาก', '2022-05-30 13:48:00', '2022-05-30 14:48:00', '#ff3300', 'นาย', 'ศรายุทธ นวะศรี', '0981234123', 'fbisdbj');
INSERT INTO `calendar` VALUES (7, 'นพ.หมอคนที่2  ทดสอบ', '2022-05-30 14:10:00', '2022-05-30 15:10:00', '#666666', 'นาง', 'ทดสอบ คนไข้', '0981234123', 'testtesttetsts');

-- ----------------------------
-- Table structure for kname
-- ----------------------------
DROP TABLE IF EXISTS `kname`;
CREATE TABLE `kname`  (
  `kumnum_id` int NOT NULL AUTO_INCREMENT,
  `kumnum_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`kumnum_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kname
-- ----------------------------
INSERT INTO `kname` VALUES (1, 'นพ.');
INSERT INTO `kname` VALUES (2, 'นาย');
INSERT INTO `kname` VALUES (3, 'นาง');

-- ----------------------------
-- Table structure for kname_patient
-- ----------------------------
DROP TABLE IF EXISTS `kname_patient`;
CREATE TABLE `kname_patient`  (
  `kumnum_patient_id` int NOT NULL AUTO_INCREMENT,
  `kumnum_patient` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`kumnum_patient_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kname_patient
-- ----------------------------
INSERT INTO `kname_patient` VALUES (1, 'นาย');
INSERT INTO `kname_patient` VALUES (2, 'นาง');
INSERT INTO `kname_patient` VALUES (3, 'น.ส.');

-- ----------------------------
-- Table structure for procedures
-- ----------------------------
DROP TABLE IF EXISTS `procedures`;
CREATE TABLE `procedures`  (
  `procedure_id` int NOT NULL AUTO_INCREMENT,
  `procedure_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `color` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`procedure_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of procedures
-- ----------------------------
INSERT INTO `procedures` VALUES (2, 'อุดฟัน', '#ff3300');
INSERT INTO `procedures` VALUES (3, 'ถอนฟัน', '#CC33FF');
INSERT INTO `procedures` VALUES (4, 'ผ่าฟันคุด', '#66CC33');
INSERT INTO `procedures` VALUES (5, 'รักษารากฟัน', '#996600');
INSERT INTO `procedures` VALUES (6, 'ฟันปลอมฐานพลาสติก/โลหะ', '#6699FF');
INSERT INTO `procedures` VALUES (7, 'อุดปิดฟันห่าง', '#666666');
INSERT INTO `procedures` VALUES (8, 'เคลือบหลุมร่องฟัน', '#000080');
INSERT INTO `procedures` VALUES (9, 'เคลือบฟลูออไรด์', '#FF69B4');
INSERT INTO `procedures` VALUES (10, 'เอ็กซเรย์ฟัน', '#000000');
INSERT INTO `procedures` VALUES (13, 'ครอบฟัน', '#2F4F4F');
INSERT INTO `procedures` VALUES (19, 'ตรวจฟันและให้คำปรึกษา1', '#fdec35');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_level` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (16, 'admin@nueng', 'e10adc3949ba59abbe56e057f20f883e', 'นาย', 'sarayuth', 'navasri', '1400900249352', 'Somdet', 'test@gmail.com', '0870877876', 'admin', '2022-05-20 09:45:00');
INSERT INTO `users` VALUES (18, 'user@nueng', 'e10adc3949ba59abbe56e057f20f883e', 'นพ.', 'หมอคนที่2', 'ทดสอบ', '12345678910', 'Somdet', 'test@gmail.com', '0812345678', 'user', '2022-05-30 11:18:09');
INSERT INTO `users` VALUES (33, 'testden', 'e10adc3949ba59abbe56e057f20f883e', 'นพ.', 'หมอคนที่1', 'ทดสอบ', '12345678910', 'ssdd', 'test@gmail.com', '0812345678', 'user', '2022-05-30 11:17:40');
INSERT INTO `users` VALUES (34, 'test@den', 'e10adc3949ba59abbe56e057f20f883e', 'นพ.', 'ทดสอบหมอ', 'ดีมาก', '12345678910', 'สมเด็จ', 'test@gmail.com', '0812345678', 'user', '2022-05-30 11:16:45');

SET FOREIGN_KEY_CHECKS = 1;
