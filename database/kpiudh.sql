/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : kpiudh

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2018-05-28 22:47:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `properties` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of account
-- ----------------------------

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`) USING BTREE,
  KEY `idx-auth_item-type` (`type`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL COMMENT 'หน่วยงาน',
  `group_id` int(11) DEFAULT NULL COMMENT 'กลุ่มงาน',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='หน่วยงาน';

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES ('1', 'ตึกผู้ป่วยใน(IPD)', '3');
INSERT INTO `departments` VALUES ('2', 'ทันตกรรม', '6');
INSERT INTO `departments` VALUES ('3', 'บริหารทั่วไป', '2');
INSERT INTO `departments` VALUES ('4', 'ผู้ป่วยนอก(OPD)', '3');
INSERT INTO `departments` VALUES ('5', 'ห้องคลอด', '3');
INSERT INTO `departments` VALUES ('6', 'คอมพิวเตอร์(IT)', '7');
INSERT INTO `departments` VALUES ('7', 'อุบัติเหตุฉุกเฉิน (ER)', '3');
INSERT INTO `departments` VALUES ('8', 'เวชระเบียน', '7');
INSERT INTO `departments` VALUES ('9', 'ศูนย์เปล', '3');
INSERT INTO `departments` VALUES ('10', 'ชันสูตร/LAB', '4');
INSERT INTO `departments` VALUES ('11', 'เภสัชกรรม', '5');
INSERT INTO `departments` VALUES ('13', 'X-Ray', '4');
INSERT INTO `departments` VALUES ('14', 'แพทย์แผนไทย', '1');
INSERT INTO `departments` VALUES ('15', 'การเงินและบัญชี', '2');
INSERT INTO `departments` VALUES ('16', 'ธุรการ', '2');
INSERT INTO `departments` VALUES ('17', 'PCU', '8');
INSERT INTO `departments` VALUES ('19', 'คลีนิกเรื้อรัง', '3');
INSERT INTO `departments` VALUES ('23', 'ยานพาหนะและรักษาความปลอดภัย', '2');
INSERT INTO `departments` VALUES ('25', 'จ่ายกลาง', '3');
INSERT INTO `departments` VALUES ('26', 'โรงครัว', '4');
INSERT INTO `departments` VALUES ('27', 'ซักฟอก', '3');
INSERT INTO `departments` VALUES ('28', 'องค์กรแพทย์', '1');
INSERT INTO `departments` VALUES ('29', 'ซ่อมบำรุง', '2');
INSERT INTO `departments` VALUES ('31', 'บ่อบำบัด', '2');
INSERT INTO `departments` VALUES ('33', 'โสตทัศนศึกษา', '2');
INSERT INTO `departments` VALUES ('34', 'ประกันสุขภาพ', '7');
INSERT INTO `departments` VALUES ('35', 'งานการเจ้าหน้าที่', '2');
INSERT INTO `departments` VALUES ('36', 'ห้องผ่าตัด', '3');
INSERT INTO `departments` VALUES ('37', 'พัสดุและงานสวน', '2');
INSERT INTO `departments` VALUES ('38', 'กายภาพบำบัด', '8');
INSERT INTO `departments` VALUES ('39', 'คลังเวชภัณฑ์ไม่ใช่ยา', '3');
INSERT INTO `departments` VALUES ('41', 'ห้องให้คำปรึกษา(COU)', '3');
INSERT INTO `departments` VALUES ('44', 'กลุ่มการพยาบาล', '3');
INSERT INTO `departments` VALUES ('45', 'งานเคหะสถาน(แม่บ้าน)', '2');

-- ----------------------------
-- Table structure for frequency
-- ----------------------------
DROP TABLE IF EXISTS `frequency`;
CREATE TABLE `frequency` (
  `frequencyid` varchar(255) NOT NULL,
  `frequencyname` varchar(250) DEFAULT NULL,
  `frequency_c` varchar(4) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  PRIMARY KEY (`frequencyid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of frequency
-- ----------------------------

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT 'กลุ่มงาน',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'บริการทางการแพทย์');
INSERT INTO `groups` VALUES ('2', 'บริหารทั่วไป');
INSERT INTO `groups` VALUES ('3', 'การพยาบาล');
INSERT INTO `groups` VALUES ('4', 'เทคนิคการแพทย์และรังสี');
INSERT INTO `groups` VALUES ('5', 'เภสัชกรรมและคุ้มครองผู้บริโภค');
INSERT INTO `groups` VALUES ('6', 'ทันตกรรม');
INSERT INTO `groups` VALUES ('7', 'ประกันสุขภาพยุทธศาสตร์และสารสนเทศ');
INSERT INTO `groups` VALUES ('8', 'เวชศาสตร์');

-- ----------------------------
-- Table structure for hcode
-- ----------------------------
DROP TABLE IF EXISTS `hcode`;
CREATE TABLE `hcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hcode
-- ----------------------------
INSERT INTO `hcode` VALUES ('1', '11146');
INSERT INTO `hcode` VALUES ('2', '11147');
INSERT INTO `hcode` VALUES ('3', '11148');
INSERT INTO `hcode` VALUES ('4', '11149');
INSERT INTO `hcode` VALUES ('5', '11151');
INSERT INTO `hcode` VALUES ('6', '11152');
INSERT INTO `hcode` VALUES ('7', '11153');
INSERT INTO `hcode` VALUES ('8', '11154');
INSERT INTO `hcode` VALUES ('9', '11155');
INSERT INTO `hcode` VALUES ('10', '11156');

-- ----------------------------
-- Table structure for kpi
-- ----------------------------
DROP TABLE IF EXISTS `kpi`;
CREATE TABLE `kpi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_h_id` varchar(4) DEFAULT NULL COMMENT 'รายการตัวชี้วัดหลัก',
  `kpiname` varchar(300) DEFAULT NULL COMMENT 'ตัวชี้วัด',
  `kpiyear` varchar(4) NOT NULL COMMENT 'ปี kpi',
  `period_id` int(11) DEFAULT NULL COMMENT 'ความถี่การประมวลผล ครั้ง/ปี',
  `d_begin_year` date DEFAULT NULL COMMENT 'วันที่เริ่มตัวชี้วัด',
  `goal` double(12,2) DEFAULT NULL COMMENT 'เกณฑ์เป้าหมาย(ค่าผลลัพธ์ที่กำหนดตามตัวชี้วัด)',
  `goal_des` text COMMENT 'คำอธิบาย เกณฑ์เป้าหมาย(ค่าผลลัพธ์ที่กำหนดตามตัวชี้วัด)',
  `denom` double(12,2) DEFAULT NULL COMMENT 'ตัวตั้ง(ผลงาน)',
  `denom_c` double(12,2) DEFAULT NULL COMMENT 'ตัวตั้งคงที่',
  `denom_c_unit` varchar(100) DEFAULT NULL COMMENT 'หน่วยนับตัวตั้ง',
  `devide` double(12,2) DEFAULT NULL COMMENT 'ตัวหาร(เป้า)',
  `devide_c` double(12,2) DEFAULT NULL COMMENT 'ตัวหารคงที่',
  `devide_c_unit` varchar(100) DEFAULT NULL COMMENT 'หน่วยนับตัวหาร',
  `target` double(12,2) DEFAULT NULL COMMENT 'กลุ่มเป้าหมาย',
  `target_des` text COMMENT 'คำอธิบาย กลุ่มเป้าหมายตามตัวชี้วัด(B ตัวหาร)',
  `critiria_value` text COMMENT 'เกณฑ์การให้คะแนน',
  `kpidepart_id` int(11) DEFAULT NULL COMMENT 'งานที่รับผิดชอบ kpi',
  `user_kpi` varchar(255) DEFAULT NULL COMMENT 'ชื่อผู้รับผิดชอบย่อย kpi',
  `statuskpi` smallint(6) DEFAULT NULL COMMENT 'สถานะ',
  `user_result_id` int(11) DEFAULT NULL COMMENT 'ผู้บันทึกผล kpi',
  `d_add` date DEFAULT NULL,
  `user_edit_result_id` int(11) DEFAULT NULL COMMENT 'ผู้แก้ไข kpi',
  `update_d` timestamp NULL DEFAULT NULL,
  `operation` varchar(2) DEFAULT NULL COMMENT 'ค่าดัชนีทีใช้วัด',
  `formula` varchar(255) DEFAULT NULL COMMENT 'สูตรที่ใช้คำนวนผล',
  `docs` varchar(255) DEFAULT NULL COMMENT 'เอกสารประกอบ',
  `ref` varchar(255) DEFAULT NULL,
  `level_id` varchar(255) DEFAULT NULL,
  `level_id_1` int(1) DEFAULT NULL,
  `level_id_2` int(1) DEFAULT NULL,
  `level_id_3` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kpi
-- ----------------------------
INSERT INTO `kpi` VALUES ('1', '1', '1.ร้อยละของโรงพยาบาลระดับ A, S ที่ผ่านเกณฑ์การประเมินการคลอดมาตรฐาน', '2561', '2', '2017-10-01', '80.00', '', null, null, null, null, null, null, null, 'จำนวนสถานบริการสุขภาพของรัฐระดับ A, S ทั้งหมด', '', '1', 'นางสาวเอ 0911112222', '1', '1', '2018-05-11', null, null, '>=', 'ร้อยละของโรงพยาบาลระดับ A, S ที่ผ่านเกณฑ์การประเมินการคลอดมาตรฐาน    = (A1/B1) x 100', '{\"5284129af0ec84f5d77d1f178d060cc8.doc\":\"Flow RM 61.doc\"}', 'tKjV0Hds_BjA3uBYsDa9vU', null, '1', '1', null);
INSERT INTO `kpi` VALUES ('2', '1', '2.ร้อยละของโรงพยาบาลระดับ M1, M2, F1, F2 ที่ผ่านเกณฑ์การประเมินการคลอดมาตรฐาน', '2561', '2', '2017-10-01', '40.00', 'โรงพยาบาลระดับ M1, M2, F1, F2 ที่ผ่านเกณฑ์การประเมินการคลอดมาตรฐาน', null, null, null, null, null, null, null, 'จำนวนสถานบริการสุขภาพของรัฐระดับ M1, M2, F1, F2 ทั้งหมด', '', '1', 'นางสาวเอ 0911112222', '1', '2', '2018-05-11', null, null, '>=', 'ร้อยละของโรงพยาบาลระดับ M1, M2, F1, F2 ที่ผ่านเกณฑ์การประเมินการคลอดมาตรฐาน    = (A2/B2) x 100', 'null', '', null, null, '1', null);
INSERT INTO `kpi` VALUES ('3', '2', 'อัตราส่วนการตายมารดาไทย', '2561', '5', '2017-10-01', '20.00', 'การตายมารดา หมายถึง \r\nการตายของมารดาไทยตั้งแต่ขณะตั้งครรภ์ คลอดและหลังคลอด ภายใน 42 วัน ไม่ว่าอายุครรภ์จะเป็นเท่าใดหรือการตั้งครรภ์ที่ตำแหน่งใด จากสาเหตุที่เกี่ยวข้องหรือก่อให้เกิดความรุนแรงขึ้น จากการตั้งครรภ์และ/หรือการดูแลรักษาขณะตั้งครรภ์ คลอด และหลังคลอด แต่ไม่ใช่จากอุบัติเหตุต่อการเกิดมีชีพแสนคน', null, '100000.00', null, null, null, null, null, 'หญิงตั้งครรภ์ คลอด และหลังคลอดภายใน 42 วัน', 'A = จำนวนมารดาตายระหว่างการตั้งครรภ์ การคลอด หลังคลอด 42 วันหลังคลอด \r\n      ทุกสาเหตุยกเว้นอุบัติเหตุในช่วงเวลาที่กำหนด (นับตามจังหวัดที่ตาย)\r\nB = จำนวนการเกิดมีชีพทั้งหมดในช่วงเวลาเดียวกัน\r\n', '4', '', '1', '3', '2018-05-13', null, null, '<=', '(A/B) x 100,000', 'null', '', null, null, '1', '1');
INSERT INTO `kpi` VALUES ('4', '3', '1.ร้อยละของเด็กอายุ 9,18, 30 และ 42 เดือน ที่ได้รับการคัดกรองพัฒนาการเด็ก', '2561', '4', null, '90.00', 'B = จำนวนเด็กอายุ 9,18,30 และ 42 เดือน ทั้งหมดในเขตรับผิดชอบ\r\nที่ได้รับการตรวจคัดกรองพัฒนาการจริง ในช่วงเวลาที่กำหนด', null, '100.00', null, null, null, null, null, 'A = เด็กไทยอายุ 9, 18, 30 และ 42 เดือน ทุกคนที่อยู่อาศัยในพื้นที่รับผิดชอบ\r\n(Type1 มีชื่ออยู่ในทะเบียนบ้าน ตัวอยู่จริงและType3 ที่อาศัยอยู่ในเขต แต่ทะเบียนบ้านอยู่นอกเขต)', 'ร้อยละของเด็กอายุ 9,18, 30 และ 42 เดือน ที่ได้รับการคัดกรองพัฒนาการเด็ก(ความครอบคลุม)\r\n= (B/A) x 100\r\n', '4', '', '1', '1', '2018-05-14', null, null, '>=', '= (B/A) x 100', '', '', null, null, null, null);
INSERT INTO `kpi` VALUES ('7', '6', 'test', '2561', '2', null, '65.00', '', null, '100.00', null, null, null, null, null, '', '', '5', '', '1', '1', '2018-05-24', null, null, '>=', '(A/B) x 100', '{\"46d869309923e97be69b51a65f03bed2.docx\":\"ER diagram Program RM.docx\"}', '', null, null, null, null);
INSERT INTO `kpi` VALUES ('8', '6', 'yy', '2561', '4', null, '80.00', '', null, '100.00', null, null, null, null, null, '', '', '4', '', '1', '1', '2018-05-24', null, null, '>=', '', '{\"e1647aeb76a030074f2a5bdb3ac5ac1a.docx\":\"ข้อมูลตัวชี้วัดที่ตามเก็บ.docx\"}', '', null, null, null, null);
INSERT INTO `kpi` VALUES ('16', '6', 'xx', '2561', '2', null, '40.00', '', null, '100.00', null, null, null, null, null, '', '', '3', '', '1', '1', '2018-05-25', null, null, '<=', '(A/B) x 100', 'null', '', null, '1', null, null);
INSERT INTO `kpi` VALUES ('5', '3', '2.ร้อยละของเด็กอายุ 9,18, 30 และ 42 เดือน ที่ได้รับการคัดกรองพัฒนาการพบพัฒนาการสงสัยล่าช้า (ตรวจครั้งแรก)', '2561', '4', null, '20.00', 'C = จำนวนเด็กอายุ 9, 18, 30 และ 42 เดือน มีพัฒนาการสงสัยล่าช้า(ตรวจครั้งแรก) ที่ต้องแนะนำให้พ่อแม่ ผู้ปกครอง ส่งเสริมพัฒนาการตามวัย 30 วัน (1B261) \r\n\r\nD = จำนวนเด็กอายุ 9, 18, 30 และ 42 เดือน มีพัฒนาการสงสัยล่าช้า(ตรวจครั้งแรก) ที่สงสัยล่าช้าส่งต่อทันที(1B262) (เด็กที่พัฒนาการล่าช้า/ความผิดปกติอย่างชัดเจน) ', null, '100.00', null, null, null, null, null, 'B = จำนวนเด็กอายุ 9,18,30 และ 42 เดือน \r\nทั้งหมดในเขตรับผิดชอบที่ได้รับการตรวจคัดกรองพัฒนาการจริง \r\nในช่วงเวลาที่กำหนด', '2. ร้อยละของเด็กอายุ 9, 18, 30 และ 42 เดือน ที่ได้รับการตรวจคัดกรองพบพัฒนาการสงสัยล่าช้า (ตรวจครั้งแรก) \r\n= ((C+D)/B) x 100\r\n', '2', '', '1', '1', '2018-05-14', null, null, '>=', ' ((C+D)/B) x 100', 'null', '', null, null, '1', null);
INSERT INTO `kpi` VALUES ('6', '3', '3.ร้อยละของเด็กอายุ 9, 18, 30 และ 42 เดือน ที่ได้รับการคัดกรองพัฒนาการพบพัฒนาการสงสัยล่าช้า (ตรวจครั้งแรก) และได้รับการติดตาม ภายใน 30 วัน', '2561', '4', null, '100.00', 'C = จำนวนเด็กอายุ 9, 18, 30 และ 42 เดือน มีพัฒนาการสงสัยล่าช้า(ตรวจครั้งแรก) \r\nที่ต้องแนะนำให้พ่อแม่ ผู้ปกครอง ส่งเสริมพัฒนาการตามวัย 30 วัน (1B261)', null, '100.00', null, null, null, null, null, 'E = จำนวนเด็กอายุ 9, 18, 30 และ 42 เดือน มีพัฒนาการสงสัยล่าช้า(ตรวจครั้งแรก)\r\nทั้งเด็กที่ต้องแนะนำให้พ่อแม่ ผู้ปกครอง ส่งเสริมพัฒนาการตามวัย 30 วัน (1B261) \r\nแล้วติดตามกลับมาประเมินคัดกรองพัฒนาการครั้งที่ 2\r\n', 'ร้อยละของเด็กอายุ 9, 18, 30 และ 42 เดือน ที่ได้รับการคัดกรองพัฒนาการพบพัฒนาการสงสัยล่าช้า (ตรวจครั้งแรก)\r\nและได้รับการติดตาม ภายใน 30 วัน\r\n= (E/C) x 100\r\n', '4', '', '1', '1', '2018-05-14', null, null, '>=', '= (E/C) x 100', '', '', null, null, null, null);
INSERT INTO `kpi` VALUES ('17', 'A012', 'ff', '2561', '2', null, '80.00', 'อธิบาย ', null, '100.00', null, null, null, null, null, 'อธิบาย ', 'อธิบาย ', '2', 'นางสาวเอ', '1', '3', '2018-05-27', null, null, '<=', '(A1/B1) x 100', 'null', '', '4,3', null, null, null);
INSERT INTO `kpi` VALUES ('18', 'A101', 'kpiปี2560', '2560', '4', null, '12.00', 'kpiปี2560', null, '100.00', null, null, null, null, null, 'kpiปี2560', 'kpiปี2560', '4', 'inam', '1', '3', '2018-05-28', null, null, '<=', '(A1/B1) x 100', 'null', '', '3', '1', '1', '1');

-- ----------------------------
-- Table structure for kpidata
-- ----------------------------
DROP TABLE IF EXISTS `kpidata`;
CREATE TABLE `kpidata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_id` int(11) NOT NULL COMMENT 'รหัส kpi',
  `frequency_no` int(11) DEFAULT NULL COMMENT 'ครั้งที่บันทึก',
  `d_end_result` date DEFAULT NULL COMMENT 'ภายในวันที่',
  `denom` double(12,2) DEFAULT NULL COMMENT 'ตัวตั้ง(ผลงาน)',
  `devide` double(12,2) DEFAULT NULL COMMENT 'ตัวหาร(เป้า)',
  `devide_c` double(12,2) DEFAULT NULL COMMENT 'ตัวตั้งคงที่',
  `denom_c` double(12,2) DEFAULT NULL COMMENT 'ตัวหารคงที่',
  `result` double(12,2) DEFAULT NULL COMMENT 'ค่าผลลัพธ์(ผลคำนวน)',
  `result_text` varchar(255) DEFAULT NULL COMMENT 'ผลลัพธ์',
  `operation` varchar(2) DEFAULT NULL COMMENT 'ค่าดัชนีทีใช้วัด',
  `calc` double(12,2) DEFAULT NULL COMMENT 'คำนวนได้',
  `user_id_result` int(11) DEFAULT NULL COMMENT 'ผู้บันทึกผล kpi',
  `d_add` date DEFAULT NULL COMMENT 'วันที่บันทึก',
  `d_edit` timestamp NULL DEFAULT NULL COMMENT 'วันที่แก้ไข',
  `docs` varchar(255) DEFAULT NULL COMMENT 'เอกสารแนบ',
  `goal` double(12,2) DEFAULT NULL COMMENT 'เกณฑ์เป้าหมาย',
  `target` double(12,2) DEFAULT NULL COMMENT 'กลุ่มเป้าหมาย',
  `target_des` text COMMENT 'คำเป้าหมายตามตัวชี้วัด(B ตัวหาร)',
  `qty_kan` int(11) DEFAULT NULL COMMENT 'จำนวนกณฑ์',
  `kan` smallint(6) DEFAULT NULL COMMENT 'เกณฑ์',
  `kpilist_id` int(11) DEFAULT NULL COMMENT 'kpi',
  `ref` varchar(255) DEFAULT NULL,
  `period_id` int(11) DEFAULT NULL COMMENT 'ความถี่',
  `t` varchar(2) DEFAULT NULL COMMENT 'trimas',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kpidata
-- ----------------------------
INSERT INTO `kpidata` VALUES ('1', '1', '1', '2018-03-30', '399.00', '500.00', null, null, null, null, '>=', null, null, '2018-05-11', null, null, '80.00', null, 'จำนวนสถานบริการสุขภาพของรัฐระดับ A, S ทั้งหมด', null, null, null, null, '2', null);
INSERT INTO `kpidata` VALUES ('2', '1', '2', '2018-09-26', '267.00', '500.00', null, '100.00', null, null, '>=', null, null, '2018-05-11', null, null, '80.00', null, 'จำนวนสถานบริการสุขภาพของรัฐระดับ A, S ทั้งหมด', null, null, null, null, '2', null);
INSERT INTO `kpidata` VALUES ('3', '2', '1', '2018-03-30', '260.00', '300.00', null, null, null, null, '>=', null, null, '2018-05-11', null, null, '40.00', null, 'จำนวนสถานบริการสุขภาพของรัฐระดับ M1, M2, F1, F2 ทั้งหมด', null, null, null, null, '2', null);
INSERT INTO `kpidata` VALUES ('4', '2', '2', '2018-09-26', null, null, null, null, null, null, '>=', null, null, '2018-05-11', null, null, '40.00', null, 'จำนวนสถานบริการสุขภาพของรัฐระดับ M1, M2, F1, F2 ทั้งหมด', null, null, null, null, '2', null);
INSERT INTO `kpidata` VALUES ('5', '3', '1', '2018-09-26', '1.00', '5890.00', null, '100000.00', null, null, '<=', null, null, '2018-05-13', null, null, '20.00', null, 'หญิงตั้งครรภ์ คลอด และหลังคลอดภายใน 42 วัน', null, null, null, null, '5', null);
INSERT INTO `kpidata` VALUES ('6', '4', '1', '2017-12-30', '228.00', '246.00', null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '90.00', null, 'เด็กอายุ 9, 18, 30 และ 42 เดือน ทุกคนที่อยู่อาศัยในพื้นที่รับผิดชอบ \r\n(Type1 มีชื่ออยู่ในทะเบียนบ้าน ตัวอยู่จริงและType3 ที่อาศัยอยู่ในเขต แต่ทะเบียนบ้านอยู่นอกเขต)', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('7', '4', '2', '2018-03-30', '215.00', '246.00', null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '90.00', null, 'เด็กอายุ 9, 18, 30 และ 42 เดือน ทุกคนที่อยู่อาศัยในพื้นที่รับผิดชอบ \r\n(Type1 มีชื่ออยู่ในทะเบียนบ้าน ตัวอยู่จริงและType3 ที่อาศัยอยู่ในเขต แต่ทะเบียนบ้านอยู่นอกเขต)', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('8', '4', '3', '2018-06-28', '200.00', '246.00', null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '90.00', null, 'เด็กอายุ 9, 18, 30 และ 42 เดือน ทุกคนที่อยู่อาศัยในพื้นที่รับผิดชอบ \r\n(Type1 มีชื่ออยู่ในทะเบียนบ้าน ตัวอยู่จริงและType3 ที่อาศัยอยู่ในเขต แต่ทะเบียนบ้านอยู่นอกเขต)', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('9', '4', '4', '2018-09-26', '195.00', '246.00', null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '90.00', null, 'เด็กอายุ 9, 18, 30 และ 42 เดือน ทุกคนที่อยู่อาศัยในพื้นที่รับผิดชอบ \r\n(Type1 มีชื่ออยู่ในทะเบียนบ้าน ตัวอยู่จริงและType3 ที่อาศัยอยู่ในเขต แต่ทะเบียนบ้านอยู่นอกเขต)', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('10', '5', '1', '2017-12-30', '980.00', '1245.00', null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '20.00', null, 'B = จำนวนเด็กอายุ 9,18,30 และ 42 เดือน \r\nทั้งหมดในเขตรับผิดชอบที่ได้รับการตรวจคัดกรองพัฒนาการจริง \r\nในช่วงเวลาที่กำหนด', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('11', '5', '2', '2018-03-30', '867.00', '1245.00', null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '20.00', null, 'B = จำนวนเด็กอายุ 9,18,30 และ 42 เดือน \r\nทั้งหมดในเขตรับผิดชอบที่ได้รับการตรวจคัดกรองพัฒนาการจริง \r\nในช่วงเวลาที่กำหนด', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('12', '5', '3', '2018-06-28', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '20.00', null, 'B = จำนวนเด็กอายุ 9,18,30 และ 42 เดือน \r\nทั้งหมดในเขตรับผิดชอบที่ได้รับการตรวจคัดกรองพัฒนาการจริง \r\nในช่วงเวลาที่กำหนด', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('13', '5', '4', '2018-09-26', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '20.00', null, 'B = จำนวนเด็กอายุ 9,18,30 และ 42 เดือน \r\nทั้งหมดในเขตรับผิดชอบที่ได้รับการตรวจคัดกรองพัฒนาการจริง \r\nในช่วงเวลาที่กำหนด', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('14', '6', '1', '2017-12-30', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '100.00', null, 'E = จำนวนเด็กอายุ 9, 18, 30 และ 42 เดือน มีพัฒนาการสงสัยล่าช้า(ตรวจครั้งแรก)\r\nทั้งเด็กที่ต้องแนะนำให้พ่อแม่ ผู้ปกครอง ส่งเสริมพัฒนาการตามวัย 30 วัน (1B261) \r\nแล้วติดตามกลับมาประเมินคัดกรองพัฒนาการครั้งที่ 2\r\n', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('15', '6', '2', '2018-03-30', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '100.00', null, 'E = จำนวนเด็กอายุ 9, 18, 30 และ 42 เดือน มีพัฒนาการสงสัยล่าช้า(ตรวจครั้งแรก)\r\nทั้งเด็กที่ต้องแนะนำให้พ่อแม่ ผู้ปกครอง ส่งเสริมพัฒนาการตามวัย 30 วัน (1B261) \r\nแล้วติดตามกลับมาประเมินคัดกรองพัฒนาการครั้งที่ 2\r\n', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('16', '6', '3', '2018-06-28', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '100.00', null, 'E = จำนวนเด็กอายุ 9, 18, 30 และ 42 เดือน มีพัฒนาการสงสัยล่าช้า(ตรวจครั้งแรก)\r\nทั้งเด็กที่ต้องแนะนำให้พ่อแม่ ผู้ปกครอง ส่งเสริมพัฒนาการตามวัย 30 วัน (1B261) \r\nแล้วติดตามกลับมาประเมินคัดกรองพัฒนาการครั้งที่ 2\r\n', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('17', '6', '4', '2018-09-26', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-14', null, null, '100.00', null, 'E = จำนวนเด็กอายุ 9, 18, 30 และ 42 เดือน มีพัฒนาการสงสัยล่าช้า(ตรวจครั้งแรก)\r\nทั้งเด็กที่ต้องแนะนำให้พ่อแม่ ผู้ปกครอง ส่งเสริมพัฒนาการตามวัย 30 วัน (1B261) \r\nแล้วติดตามกลับมาประเมินคัดกรองพัฒนาการครั้งที่ 2\r\n', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('18', '7', '1', '2018-03-30', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-24', null, null, '65.00', null, '', null, null, null, null, '2', null);
INSERT INTO `kpidata` VALUES ('19', '7', '2', '2018-09-26', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-24', null, null, '65.00', null, '', null, null, null, null, '2', null);
INSERT INTO `kpidata` VALUES ('20', '8', '1', '2017-12-30', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-24', null, null, '80.00', null, '', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('21', '8', '2', '2018-03-30', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-24', null, null, '80.00', null, '', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('22', '8', '3', '2018-06-28', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-24', null, null, '80.00', null, '', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('23', '8', '4', '2018-09-26', null, null, null, '100.00', null, null, '>=', null, null, '2018-05-24', null, null, '80.00', null, '', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('31', '16', '2', '2018-09-26', null, null, null, '100.00', null, null, '<=', null, null, '2018-05-25', null, null, '40.00', null, '', null, null, null, null, '2', '5Q');
INSERT INTO `kpidata` VALUES ('30', '16', '1', '2018-03-30', '100.00', '4000.00', null, '100.00', null, null, '<=', null, null, '2018-05-25', null, null, '40.00', null, '', null, null, null, null, '2', '4Q');
INSERT INTO `kpidata` VALUES ('32', '17', '1', '2018-03-30', null, null, null, '100.00', null, null, '<=', null, null, '2018-05-27', null, null, '80.00', null, 'อธิบาย ', null, null, null, null, '2', null);
INSERT INTO `kpidata` VALUES ('33', '17', '2', '2018-09-26', null, null, null, '100.00', null, null, '<=', null, null, '2018-05-27', null, null, '80.00', null, 'อธิบาย ', null, null, null, null, '2', null);
INSERT INTO `kpidata` VALUES ('34', '18', '1', '2016-12-30', null, null, null, '100.00', null, null, '<=', null, null, '2018-05-28', null, null, '12.00', null, 'kpiปี2560', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('35', '18', '2', '2017-03-30', null, null, null, '100.00', null, null, '<=', null, null, '2018-05-28', null, null, '12.00', null, 'kpiปี2560', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('36', '18', '3', '2017-06-28', null, null, null, '100.00', null, null, '<=', null, null, '2018-05-28', null, null, '12.00', null, 'kpiปี2560', null, null, null, null, '4', null);
INSERT INTO `kpidata` VALUES ('37', '18', '4', '2017-09-26', null, null, null, '100.00', null, null, '<=', null, null, '2018-05-28', null, null, '12.00', null, 'kpiปี2560', null, null, null, null, '4', null);

-- ----------------------------
-- Table structure for kpidata_list
-- ----------------------------
DROP TABLE IF EXISTS `kpidata_list`;
CREATE TABLE `kpidata_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frequency_no` int(11) DEFAULT NULL COMMENT 'ครั้งที่บันทึก',
  `kpidata_id` int(11) NOT NULL,
  `kpi_id` int(11) DEFAULT NULL COMMENT 'เกณฑ์',
  `list` varchar(255) DEFAULT NULL COMMENT 'เกณฑ์',
  `value_denom_a` decimal(12,2) DEFAULT NULL COMMENT 'ค่าตัวตั้งa',
  `value_devide_a` decimal(12,2) DEFAULT NULL COMMENT 'ค่าตัวหารa',
  `value_denom_b` decimal(12,2) DEFAULT NULL COMMENT 'ค่าตัวตั้งb',
  `value_devide_b` decimal(12,2) DEFAULT NULL COMMENT 'ค่าตัวหารb',
  `value_text` varchar(255) DEFAULT NULL COMMENT 'ค่าเกณฑ์',
  `d_add` date DEFAULT NULL,
  `d_edit` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_add` int(11) DEFAULT NULL COMMENT 'ผู้บันทึก',
  `user_edit` int(11) DEFAULT NULL COMMENT 'ผู้แก้ไข',
  `kan_no` int(11) DEFAULT NULL COMMENT 'ลำดับเกณฑ์',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kpidata_list
-- ----------------------------
INSERT INTO `kpidata_list` VALUES ('1', '1', '3', '2', 'เกณฑ์1', null, null, null, null, null, '2017-11-20', '2017-11-21 09:40:38', null, null, '1');
INSERT INTO `kpidata_list` VALUES ('2', '1', '3', '2', 'เกณฑ์2', null, null, null, null, null, '2017-11-20', '2017-11-21 09:41:17', null, null, '2');
INSERT INTO `kpidata_list` VALUES ('3', '1', '3', '2', 'เกณฑ์3', null, null, null, null, null, '2017-11-20', '2017-11-21 09:41:23', null, null, '3');
INSERT INTO `kpidata_list` VALUES ('4', '2', '4', '2', null, null, null, null, null, null, '2017-11-20', null, null, null, '1');
INSERT INTO `kpidata_list` VALUES ('5', '2', '4', '2', null, null, null, null, null, null, '2017-11-20', null, null, null, '2');
INSERT INTO `kpidata_list` VALUES ('6', '2', '4', '2', null, null, null, null, null, null, '2017-11-20', null, null, null, '3');

-- ----------------------------
-- Table structure for kpidepart
-- ----------------------------
DROP TABLE IF EXISTS `kpidepart`;
CREATE TABLE `kpidepart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_dep` varchar(255) DEFAULT NULL COMMENT 'งานที่รับผิดชอบ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kpidepart
-- ----------------------------
INSERT INTO `kpidepart` VALUES ('1', 'การพยาบาล');
INSERT INTO `kpidepart` VALUES ('2', 'เภสัชกรรม');
INSERT INTO `kpidepart` VALUES ('3', 'ทันตกรรม');
INSERT INTO `kpidepart` VALUES ('4', 'สูตินรีเวช');
INSERT INTO `kpidepart` VALUES ('5', 'ศัลยกรรม');
INSERT INTO `kpidepart` VALUES ('6', 'การเงินและบัญชี');

-- ----------------------------
-- Table structure for kpiitem
-- ----------------------------
DROP TABLE IF EXISTS `kpiitem`;
CREATE TABLE `kpiitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpiname` varchar(300) DEFAULT NULL COMMENT 'ชื่อ kpi',
  `kpidesc` text COMMENT 'คำอธิบาย kpi',
  `sourcekpi` varchar(255) DEFAULT NULL COMMENT 'แหล่งข้อมูล',
  `useradd_id` int(11) DEFAULT NULL COMMENT 'ผู้บันทึก kpi',
  `dateadd` date DEFAULT NULL,
  `statuskpi` smallint(6) DEFAULT NULL COMMENT 'สถานะ',
  `center_kpi` smallint(1) DEFAULT NULL COMMENT 'kpiส่วนกลาง',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kpiitem
-- ----------------------------
INSERT INTO `kpiitem` VALUES ('1', 'อัตราตายของผู้ป่วยโรคหลอดเลือดหัวใจ (AMI; STEMI/ NSTEMI)', 'อัตราตายของผู้ป่วยโรคหลอดเลือดหัวใจ (AMI; STEMI/ NSTEMI)', '', null, null, null, null);
INSERT INTO `kpiitem` VALUES ('2', 'อัตราตายของผู้ป่วยโรคหลอดเลือดสมอง (Cerebral hemo, Infarc)', 'อัตราตายของผู้ป่วยโรคหลอดเลือดสมอง (Cerebral hemo, Infarc)', '', null, null, null, null);
INSERT INTO `kpiitem` VALUES ('3', 'อัตราตายของทารกแรกเกิดภายใน 28 วัน ต่อ 1,000 LB', 'อัตราตายของทารกแรกเกิดภายใน 28 วัน ต่อ 1,000 LB', '', null, null, null, null);
INSERT INTO `kpiitem` VALUES ('4', 'อัตราตายจาก Trauma (triss score > 0.75)', 'อัตราตายจาก Trauma (triss score > 0.75)', '', null, null, null, null);
INSERT INTO `kpiitem` VALUES ('5', 'อัตราตายจาก Head Injury (S000-S069)', 'อัตราตายจาก Head Injury (S000-S069)', '', null, null, null, null);
INSERT INTO `kpiitem` VALUES ('6', 'อัตราตายจาก Sepsis ต่อ 100,000 ปชก. นิยามตามทีม Sepsis', 'อัตราตายจาก Sepsis ต่อ 100,000 ปชก. นิยามตามทีม Sepsis', '', null, null, null, null);

-- ----------------------------
-- Table structure for kpiperiod
-- ----------------------------
DROP TABLE IF EXISTS `kpiperiod`;
CREATE TABLE `kpiperiod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` int(2) DEFAULT NULL COMMENT 'จำนวนครั้งการประมวลผล/ปี',
  `d_total` int(11) DEFAULT NULL COMMENT 'จำนวนวันของงวด(ทุกกี่วัน)',
  `description` varchar(255) DEFAULT NULL COMMENT 'คำอธิบาย',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kpiperiod
-- ----------------------------
INSERT INTO `kpiperiod` VALUES ('2', '2', '180', 'รายงานผลทุก6เดือน(ปีละ2ครั้ง)');
INSERT INTO `kpiperiod` VALUES ('4', '4', '90', 'รายงานผลทุก3เดือน(ปีละ4ครั้ง-รายไตรมาส)');
INSERT INTO `kpiperiod` VALUES ('5', '1', '360', 'รายงานผลเป็นปีละ1ครั้ง');

-- ----------------------------
-- Table structure for kpitype
-- ----------------------------
DROP TABLE IF EXISTS `kpitype`;
CREATE TABLE `kpitype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpitype` varchar(255) DEFAULT NULL COMMENT 'ลักษณะตัวชี้วัด',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kpitype
-- ----------------------------
INSERT INTO `kpitype` VALUES ('1', 'เชิงปริมาณ(ร้อยละ)');
INSERT INTO `kpitype` VALUES ('2', 'เชิงคุณภาพ');

-- ----------------------------
-- Table structure for kpiyear
-- ----------------------------
DROP TABLE IF EXISTS `kpiyear`;
CREATE TABLE `kpiyear` (
  `kpiyear` varchar(4) NOT NULL COMMENT 'ปี kpi',
  `d_begin` date DEFAULT NULL COMMENT 'เริ่มปีงบ',
  `d_end` date DEFAULT NULL COMMENT 'สิ้นปีงบ',
  `range` varchar(255) DEFAULT NULL COMMENT 'ช่วงเวลา',
  PRIMARY KEY (`kpiyear`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kpiyear
-- ----------------------------
INSERT INTO `kpiyear` VALUES ('2560', '2016-10-01', '2017-09-30', '01-10-2016 30-09-2017');
INSERT INTO `kpiyear` VALUES ('2561', '2017-10-01', '2018-09-30', '01-10-2017 30-09-2018');

-- ----------------------------
-- Table structure for kpi_head
-- ----------------------------
DROP TABLE IF EXISTS `kpi_head`;
CREATE TABLE `kpi_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mond_id` int(11) DEFAULT NULL,
  `pan_id` int(11) DEFAULT NULL,
  `kong_id` int(11) DEFAULT NULL,
  `level_id` varchar(255) DEFAULT NULL,
  `name_h` varchar(300) DEFAULT NULL COMMENT 'ตัวชี้วัด',
  `kpitype_id` int(11) DEFAULT NULL COMMENT 'ลักษณะตัวชี้วัด',
  `kpidesc` text COMMENT 'คำนิยาม',
  `perfomance` text COMMENT 'วัตถุประสงค์',
  `target` text COMMENT 'กลุ่มเป้าหมาย',
  `fomula` text COMMENT 'สูตรคำนวนตัวชี้วัด',
  `source` varchar(255) DEFAULT NULL COMMENT 'แหล่งข้อมูล',
  `kpiyear` varchar(4) NOT NULL COMMENT 'ปี kpi',
  `kpidepart_id` int(11) DEFAULT NULL COMMENT 'งานที่รับผิดชอบ kpi',
  `user_kpi_h` varchar(255) DEFAULT NULL COMMENT 'ชื่อผู้รับผิดชอบหลัก kpi',
  `statuskpi` smallint(6) DEFAULT NULL COMMENT 'สถานะ',
  `user_id` int(11) DEFAULT NULL COMMENT 'ผู้บันทึกรายการ',
  `docs` varchar(255) DEFAULT NULL COMMENT 'เอกสารประกอบ',
  `ref` varchar(255) DEFAULT NULL,
  `create_d` date DEFAULT NULL COMMENT 'วันที่บันทึก',
  `upadte_d` timestamp NULL DEFAULT NULL COMMENT 'วันที่แก้ไข',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kpi_head
-- ----------------------------
INSERT INTO `kpi_head` VALUES ('1', '1', '1', '44', '2', '1. ร้อยละสถานบริการสุขภาพที่มีการคลอดมาตรฐาน', '1', 'การคลอดมาตรฐาน หมายถึง\r\n1.มีสถานที่และอุปกรณ์ ที่ได้ตามมาตรฐาน\r\n2.มีบุคลากรที่สามารถให้การดูแลผู้คลอดที่มีความเสี่ยงต่ำ/ความเสี่ยงสูง\r\n3.มีระบบการให้บริการตามเกณฑ์\r\n3.1 การค้นหากลุ่มเสี่ยงด้วย admission record ที่มีการบูรณาการส่วนที่เป็นข้อมูลพื้นฐาน การจำแนกความเสี่ยง แนวทางการดูแลรักษา และเกณฑ์การส่งต่อ เมื่อพบความเสี่ยงต่างๆ เข้าด้วยกัน ดังตัวอย่าง admission record ของกรมการแพทย์\r\n3.2 ระบบการดูแลผู้คลอด ในระยะคลอด-หลังคลอด ด้วยกราฟดูแลการคลอด / แบบประเมิน EFM ตามคู่มือเวชปฏิบัติการคลอดมาตรฐาน ซึ่งรวมถึงการมีแนวทางในการดูแลภาวะตกเลือดหลังคลอด ดังตัวอย่าง PPH checklist guidelines หรือ PPH order set ของกรมการแพทย์\r\n3.3 ระบบการส่งต่อผู้คลอดที่มีภาวะเสี่ยง หรือเมื่อเกิดภาวะแทรกซ้อน ด้วยเกณฑ์การส่งต่อที่เป็นลายลักษณ์อักษร (จากโรงพยาบาลแม่ข่าย) มีการบรรจุเกณฑ์การส่งต่อดังกล่าวไว้ใน admission record และกราฟดูแลการคลอด เป็นต้น\r\n4.มีการติดตามและประเมินผลการคลอดมาตรฐาน\r\n5.มีการทบทวน การดูแลรักษามารดาที่เสียชีวิตจากการคลอด\r\n(รายละเอียดในคู่มือเวชปฏิบัติการคลอดมาตรฐาน กรมการแพทย์)', 'มารดาที่ตั้งครรภ์ทุกรายได้รับการดูแลตลอดการคลอดอย่างมีคุณภาพได้มาตรฐาน\r\nโดยเฉพาะมารดาที่ตั้งครรภ์ความเสี่ยงสูงได้รับการดูแลในระหว่างการคลอดโดยผู้เชี่ยวชาญ\r\nด้านสูติกรรมในสภาวะที่พร้อมรับเหตุฉุกเฉิน', 'สถานบริการสุขภาพของรัฐทุกระดับ ทั่วประเทศ', '1.ร้อยละของโรงพยาบาลระดับ A, S ที่ผ่านเกณฑ์การประเมินการคลอดมาตรฐาน\r\n   = (A1/B1) x 100\r\n2.ร้อยละของโรงพยาบาลระดับ M1, M2, F1, F2 ที่ผ่านเกณฑ์การประเมินการคลอดมาตรฐาน\r\n   = (A2/B2) x 100', 'สำรวจและประเมินตามเกณฑ์มาตรฐาน', '2561', '1', '', null, null, '', '', null, null);
INSERT INTO `kpi_head` VALUES ('2', '1', '1', '44', '1', '2. อัตราส่วนการตายมารดาไทย', '1', '               การตายมารดา หมายถึง การตายของมารดาไทยตั้งแต่ขณะตั้งครรภ์ คลอดและหลังคลอด ภายใน 42 วัน ไม่ว่าอายุครรภ์จะเป็นเท่าใดหรือการตั้งครรภ์ที่ตำแหน่งใด จากสาเหตุที่เกี่ยวข้องหรือก่อให้เกิดความรุนแรงขึ้น จากการตั้งครรภ์และ/หรือการดูแลรักษาขณะตั้งครรภ์ คลอด และหลังคลอด แต่ไม่ใช่จากอุบัติเหตุต่อการเกิดมีชีพแสนคน\r\n\r\n		การเยี่ยมเสริมพลัง  เป็นการเสริมพลังใจพลังความคิดให้ผู้บริหาร ผู้ให้บริการ ตลอดจนภาคีเครือข่าย ให้ใช้ศักยภาพของตัวเองและทีมงานอย่างเต็มกำลังในการดำเนินงานพัฒนาระบบบริการอนามัยแม่และเด็กให้ได้ตามมาตรฐานสอดคล้องตามบริบท  เช่น การเสริมพลังในการนิเทศติดตาม การไปเยี่ยมหน้างานการประเมินมาตรฐานอนามัยแม่และเด็กเพื่อการพัฒนา\r\n', '1. พัฒนาระบบบริการของสถานบริการสาธารณสุขทุกระดับให้ได้มาตรฐานอนามัยแม่และ\r\n    เด็กคุณภาพ\r\n2. เฝ้าระวังหญิงช่วงตั้งครรภ์ คลอด และหลังคลอดเพื่อลดการตายของมารดาจากการ   \r\n    ตั้งครรภ์และการคลอดอย่างมีประสิทธิภาพ\r\n3. จัดระบบการส่งต่อหญิงตั้งครรภ์ภาวะฉุกเฉินอย่างมีประสิทธิภาพ\r\n', 'หญิงตั้งครรภ์ คลอด และหลังคลอดภายใน 42 วัน', 'A = จำนวนมารดาตายระหว่างการตั้งครรภ์ การคลอด หลังคลอด 42 วันหลังคลอด \r\n      ทุกสาเหตุยกเว้นอุบัติเหตุในช่วงเวลาที่กำหนด (นับตามจังหวัดที่ตาย)\r\nB = จำนวนการเกิดมีชีพทั้งหมดในช่วงเวลาเดียวกัน\r\n(A/B) x 100,000', 'หน่วยบริการสาธารณสุขทุกระดับ', '2561', '4', '', '1', null, '', '', null, null);
INSERT INTO `kpi_head` VALUES ('3', '1', '1', '44', '3', '3. ร้อยละของเด็กอายุ 0-5 ปี มีพัฒนาการสมวัย', '1', 'เด็กอายุ 0 - 5 ปี หมายถึง เด็กแรกเกิด จนถึงอายุ 5 ปี 11 เดือน 29 วัน\r\n- การคัดกรองพัฒนาการเด็ก หมายถึง ความครอบคลุมของการคัดกรองเด็กอายุ 9, 18, 30 และ 42 เดือน ณ ช่วงเวลาที่มีการคัดกรองโดยเป็นเด็กในพื้นที่ (Type1 มีชื่ออยู่ในทะเบียนบ้าน ตัวอยู่จริงและ Type3 ที่อาศัยอยู่ในเขต แต่ทะเบียนบ้านอยู่นอกเขต)\r\n- เด็กพัฒนาการสงสัยล่าช้า หมายถึง เด็กที่ได้รับตรวจคัดกรองพัฒนาการโดยใช้คู่มือเฝ้าระวังและส่งเสริมพัฒนาการเด็กปฐมวัย(DSPM)และผลการตรวจคัดกรองพัฒนาการตามอายุของเด็กในการประเมินพัฒนาการครั้งแรกผ่านไม่ครบ 5ด้าน ทั้งเด็กที่ต้องแนะนำให้พ่อแม่ ผู้ปกครอง ส่งเสริมพัฒนาการตามวัย 30 วัน (1B261) รวมกับเด็กที่สงสัยล่าช้า ส่งต่อทันที(1B262) (เด็กที่พัฒนาการล่าช้า/ความผิดปกติอย่างชัดเจน)\r\n- เด็กพัฒนาการสงสัยล่าช้าได้รับการติดตาม หมายถึง เด็กที่ได้รับการตรวจคัดกรองพัฒนาการตามอายุของเด็กในการประเมินพัฒนาการครั้งแรกผ่านไม่ครบ 5 ด้าน เฉพาะกลุ่มที่แนะนำให้พ่อแม่ ผู้ปกครอง ส่งเสริมพัฒนาการตามวัย 30 วัน (1B261) แล้วติดตามกลับมาประเมินคัดกรองพัฒนาการครั้งที่ 2\r\n- เด็กพัฒนาการสมวัย หมายถึง เด็กที่ได้รับตรวจคัดกรองพัฒนาการโดยใช้คู่มือเฝ้าระวังและส่งเสริมพัฒนาการเด็กปฐมวัย(DSPM) แล้วผลการตรวจคัดกรอง ผ่านครบ 5 ด้าน ในการตรวจคัดกรองพัฒนาการครั้งแรก รวมกับเด็กที่พบพัฒนาการสงสัยล่าช้าและได้รับการติดตามให้ได้รับการกระตุ้นพัฒนาการ และประเมินซ้ำแล้วผลการประเมิน ผ่านครบ 5 ด้านภายใน 30 วัน(1B260)\r\n- เด็กพัฒนาการล่าช้า หมายถึง เด็กที่ได้รับตรวจคัดกรองพัฒนาการโดยใช้คู่มือเฝ้าระวังและส่งเสริมพัฒนาการเด็กปฐมวัย(DSPM) แล้วผลการตรวจคัดกรอง ไม่ผ่านครบ 5 ด้าน ในการตรวจคัดกรองพัฒนาการครั้งแรกและครั้งที่ 2 (1B202, 1B212, 1B222, 1B232, 1B242)\r\n', '1. ส่งเสริมให้เด็กเจริญเติบโต พัฒนาการสมวัย พร้อมเรียนรู้ ตามช่วงวัย \r\n2. พัฒนาระบบบริการตามมาตรฐานอนามัยแม่และเด็กคุณภาพของหน่วยบริการทุกระดับ\r\n3. ส่งเสริมให้ประชาชนมีความตระหนักรู้ เรื่อง การเลี้ยงดูเด็กอย่างมีคุณภาพ\r\n', 'เด็กอายุ 9, 18, 30 และ 42 เดือน ทุกคนที่อยู่อาศัยในพื้นที่รับผิดชอบ \r\n(Type1 มีชื่ออยู่ในทะเบียนบ้าน ตัวอยู่จริงและType3 ที่อาศัยอยู่ในเขต แต่ทะเบียนบ้านอยู่นอกเขต)', '1. ร้อยละของเด็กอายุ 9,18, 30 และ 42 เดือน ที่ได้รับการคัดกรองพัฒนาการเด็ก\r\n(ความครอบคลุม)\r\n= (B/A) x 100\r\n2. ร้อยละของเด็กอายุ 9, 18, 30 และ 42 เดือน ที่ได้รับการตรวจคัดกรองพบพัฒนาการสงสัยล่าช้า (ตรวจครั้งแรก) \r\n= ((C+D)/B) x 100\r\n3. ร้อยละของเด็กอายุ 9, 18, 30 และ 42 เดือน ที่ได้รับการคัดกรองพัฒนาการพบพัฒนาการสงสัยล่าช้า (ตรวจครั้งแรก) และได้รับการติดตาม ภายใน 30 วัน\r\n= (E/C) x 100\r\n4. ร้อยละของเด็กอายุ 0-5 ปี มีพัฒนาการสมวัย\r\n=  (F/B) x 100\r\n', 'สถานบริการสาธารณสุขทุกแห่ง/ สำนักงานสาธารณสุขจังหวัด', '2561', '2', '', '1', null, '', '', null, null);
INSERT INTO `kpi_head` VALUES ('6', '2', '2', '2', '1,3', 'test', '1', 'test', 'test', 'test', '', '', '2561', '6', '', '1', null, '', '', null, null);

-- ----------------------------
-- Table structure for k_kong
-- ----------------------------
DROP TABLE IF EXISTS `k_kong`;
CREATE TABLE `k_kong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_kong` varchar(255) DEFAULT NULL COMMENT 'โครงการ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of k_kong
-- ----------------------------
INSERT INTO `k_kong` VALUES ('1', '1. โครงการปรับโครงสร้างและพัฒนากฎหมายด้านสุขภาพ');
INSERT INTO `k_kong` VALUES ('2', '2. โครงการพัฒนาและสร้างเสริมศักยภาพคนไทยกลุ่มวัยเรียนและวัยรุ่น');
INSERT INTO `k_kong` VALUES ('3', '3. โครงการพัฒนาและสร้างเสริมศักยภาพคนไทยกลุ่มวัยทำงาน');
INSERT INTO `k_kong` VALUES ('4', '4. โครงการพัฒนาและสร้างเสริมศักยภาพคนไทยกลุ่มวัยผู้สูงอายุ');
INSERT INTO `k_kong` VALUES ('5', '2. โครงการควบคุมโรคติดต่อ');
INSERT INTO `k_kong` VALUES ('6', '3. โครงการควบคุมโรคไม่ติดต่อและภัยสุขภาพ');
INSERT INTO `k_kong` VALUES ('7', '4. โครงการส่งเสริมและพัฒนาความปลอดภัยด้านอาหาร');
INSERT INTO `k_kong` VALUES ('8', '5. โครงการคุ้มครองผู้บริโภคด้านผลิตภัณฑ์สุขภาพและบริการสุขภาพ');
INSERT INTO `k_kong` VALUES ('9', '1. โครงการบริหารจัดการสิ่งแวดล้อม');
INSERT INTO `k_kong` VALUES ('10', '2. โครงการคุ้มครองสุขภาพประชาชนจากมลพิษสิ่งแวดล้อมในพื้นที่เสี่ยง (Hot Zone)');
INSERT INTO `k_kong` VALUES ('11', '1. โครงการพัฒนาระบบการแพทย์ปฐมภูมิ');
INSERT INTO `k_kong` VALUES ('12', '1. โครงการพัฒนาระบบบริการสุขภาพ สาขาโรคไม่ติดต่อเรื้อรัง');
INSERT INTO `k_kong` VALUES ('13', '2. โครงการป้องกันและควบคุมการดื้อยาต้านจุลชีพและการใช้ยาอย่างสมเหตุสมผล');
INSERT INTO `k_kong` VALUES ('14', '3. โครงการพัฒนาศูนย์ความเป็นเลิศทางการแพทย์');
INSERT INTO `k_kong` VALUES ('15', '4. โครงการพัฒนาระบบบริการสุขภาพ สาขาทารกแรกเกิด');
INSERT INTO `k_kong` VALUES ('16', '5. โครงการพัฒนาระบบการดูแลแบบประคับประคอง  (Palliative Care)');
INSERT INTO `k_kong` VALUES ('17', '6. โครงการพัฒนาระบบบริการการแพทย์แผนไทยฯ');
INSERT INTO `k_kong` VALUES ('18', '7. โครงการพัฒนาระบบบริการสุขภาพ สาขาสุขภาพจิตและจิตเวช');
INSERT INTO `k_kong` VALUES ('19', '8. โครงการพัฒนาระบบบริการสุขภาพ 5 สาขาหลัก (สูตินารีเวช ศัลยกรรม อายุรกรรม กุมารเวชกรรม และออร์โธปิดิกส์)');
INSERT INTO `k_kong` VALUES ('20', '9. โครงการพัฒนาระบบบริการสุขภาพ สาขาโรคหัวใจ');
INSERT INTO `k_kong` VALUES ('21', '10. โครงการพัฒนาระบบบริการสุขภาพ สาขาโรคมะเร็ง');
INSERT INTO `k_kong` VALUES ('22', '11. โครงการพัฒนาระบบบริการสุขภาพ สาขาโรคไต');
INSERT INTO `k_kong` VALUES ('23', '12. โครงการพัฒนาระบบบริการสุขภาพ สาขาจักษุวิทยา');
INSERT INTO `k_kong` VALUES ('24', '13. โครงการพัฒนาระบบบริการสุขภาพ สาขาปลูกถ่ายอวัยวะ');
INSERT INTO `k_kong` VALUES ('25', '14. โครงการพัฒนาระบบบริการบำบัดรักษาผู้ป่วยยาเสพติด');
INSERT INTO `k_kong` VALUES ('26', '15. โครงการพัฒนาระบบบริการดูแลระยะกลาง (Intermediate Care)');
INSERT INTO `k_kong` VALUES ('27', '16. โครงการพัฒนาระบบบริการ one day surgery');
INSERT INTO `k_kong` VALUES ('28', '17. โครงการพัฒนาระบบบริการ Minimally Invasive Surgery');
INSERT INTO `k_kong` VALUES ('29', '1. โครงการพัฒนาระบบบริการการแพทย์ฉุกเฉินครบวงจรและระบบการส่งต่อ');
INSERT INTO `k_kong` VALUES ('30', '1. โครงการเฉลิมพระเกียรติ');
INSERT INTO `k_kong` VALUES ('31', '2. โครงการพัฒนาพื้นที่พิเศษ');
INSERT INTO `k_kong` VALUES ('32', '1.โครงการพัฒนาการท่องเที่ยวเชิงสุขภาพและการแพทย์');
INSERT INTO `k_kong` VALUES ('33', '1. โครงการผลิตและพัฒนากำลังคนด้านสุขภาพสู่ความเป็นมืออาชีพ');
INSERT INTO `k_kong` VALUES ('34', '2. โครงการ Happy MOPH กระทรวงสาธารณสุข กระทรวงแห่งความสุข');
INSERT INTO `k_kong` VALUES ('35', '3. โครงการพัฒนาเครือข่ายกำลังคนด้านสุขภาพ');
INSERT INTO `k_kong` VALUES ('36', '1. โครงการประเมินคุณธรรม ความโปร่งใส และบริหารความเสี่ยง');
INSERT INTO `k_kong` VALUES ('37', '2. โครงการพัฒนาองค์กรคุณภาพ');
INSERT INTO `k_kong` VALUES ('38', '1. โครงการพัฒนาระบบข้อมูลข่าวสารเทคโนโลยีสุขภาพแห่งชาติ (NHIS)');
INSERT INTO `k_kong` VALUES ('39', '2. โครงการพัฒนาสุขภาพด้วยเศรษฐกิจดิจิทัล (Digital Economy)');
INSERT INTO `k_kong` VALUES ('40', '1. โครงการลดความเหลื่อมล้ำของ 3 กองทุน');
INSERT INTO `k_kong` VALUES ('41', '2. โครงการบริหารจัดการด้านการเงินการคลัง');
INSERT INTO `k_kong` VALUES ('42', '1. โครงการพัฒนางานวิจัย/นวัตกรรม ผลิตภัณฑ์สุขภาพและเทคโนโลยีทางการแพทย์');
INSERT INTO `k_kong` VALUES ('43', '1. โครงการปรับโครงสร้างและพัฒนากฎหมายด้านสุขภาพ');
INSERT INTO `k_kong` VALUES ('44', '1. โครงการพัฒนาและสร้างเสริมศักยภาพคนไทยกลุ่มสตรีและเด็กปฐมวัย');

-- ----------------------------
-- Table structure for k_level
-- ----------------------------
DROP TABLE IF EXISTS `k_level`;
CREATE TABLE `k_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_pon_level` varchar(255) DEFAULT NULL COMMENT 'ระดับการแสดงผล',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of k_level
-- ----------------------------
INSERT INTO `k_level` VALUES ('1', 'กระทรวง');
INSERT INTO `k_level` VALUES ('4', 'HA');
INSERT INTO `k_level` VALUES ('2', 'ตรวจราชการ');
INSERT INTO `k_level` VALUES ('3', 'โรงพยาบาล');

-- ----------------------------
-- Table structure for k_mond
-- ----------------------------
DROP TABLE IF EXISTS `k_mond`;
CREATE TABLE `k_mond` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_mond` varchar(255) DEFAULT NULL COMMENT 'หมวด',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of k_mond
-- ----------------------------
INSERT INTO `k_mond` VALUES ('1', 'ยุทธศาสตร์ด้านส่งเสริมสุขภาพ ป้องกันโรค และคุ้มครองผู้บริโภคเป็นเลิศ');
INSERT INTO `k_mond` VALUES ('2', 'ยุทธศาสตร์ด้านบริการเป็นเลิศ');
INSERT INTO `k_mond` VALUES ('3', 'ยุทธศาสตร์บุคลากรเป็นเลิศ');
INSERT INTO `k_mond` VALUES ('4', 'ยุทธศาสตร์บริหารเป็นเลิศด้วยธรรมาภิบาล');

-- ----------------------------
-- Table structure for k_pan
-- ----------------------------
DROP TABLE IF EXISTS `k_pan`;
CREATE TABLE `k_pan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_pan` varchar(255) DEFAULT NULL COMMENT 'แผน',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of k_pan
-- ----------------------------
INSERT INTO `k_pan` VALUES ('1', '1. การพัฒนาคุณภาพชีวิตคนไทยทุกกลุ่มวัย (ด้านสุขภาพ)');
INSERT INTO `k_pan` VALUES ('2', '2. การพัฒนาคุณภาพชีวิตระดับอำเภอ');
INSERT INTO `k_pan` VALUES ('3', '3. การป้องกันควบคุมโรคและลดปัจจัยเสี่ยงด้านสุขภาพ');
INSERT INTO `k_pan` VALUES ('4', '4. การบริหารจัดการสิ่งแวดล้อม');
INSERT INTO `k_pan` VALUES ('5', '5. การพัฒนาระบบการแพทย์ปฐมภูมิ (Primary Care Cluster)');
INSERT INTO `k_pan` VALUES ('6', '6. การพัฒนาระบบบริการสุขภาพ (Service Plan)');
INSERT INTO `k_pan` VALUES ('7', '7. การพัฒนาระบบบริการการแพทย์ฉุกเฉินครบวงจรและระบบการส่งต่อ');
INSERT INTO `k_pan` VALUES ('8', '8. การพัฒนาตามโครงการเฉลิมกระเกียรติและพื้นที่เฉพาะ');
INSERT INTO `k_pan` VALUES ('9', '9. อุตสาหกรรมทางการแพทย์');
INSERT INTO `k_pan` VALUES ('10', '10. การพัฒนาระบบบริหารจัดการกำลังคนด้านสุขภาพ');
INSERT INTO `k_pan` VALUES ('11', '11. การพัฒนาระบบธรรมาภิบาลและองค์กรคุณภาพ');
INSERT INTO `k_pan` VALUES ('12', '12. การพัฒนาระบบข้อมูลสารสนเทศด้านสุขภาพ');
INSERT INTO `k_pan` VALUES ('13', '13. การบริหารจัดการด้านการเงินการคลังสุขภาพ');
INSERT INTO `k_pan` VALUES ('14', '14. การพัฒนางานวิจัย และนวัตกรรมด้านสุขภาพ');
INSERT INTO `k_pan` VALUES ('15', '15. การปรับโครงสร้างและการพัฒนากฎหมายด้านสุขภาพ');

-- ----------------------------
-- Table structure for occupations
-- ----------------------------
DROP TABLE IF EXISTS `occupations`;
CREATE TABLE `occupations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'ระดับ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='ระดับ';

-- ----------------------------
-- Records of occupations
-- ----------------------------
INSERT INTO `occupations` VALUES ('1', 'ข้าราชการ');
INSERT INTO `occupations` VALUES ('2', 'ลูกจ้างประจำ');
INSERT INTO `occupations` VALUES ('3', 'พนักงานราชการ');
INSERT INTO `occupations` VALUES ('4', 'พกส(นักเรียนทุน)');
INSERT INTO `occupations` VALUES ('5', 'พกส(ลูกจ้างชั่วคราว)');
INSERT INTO `occupations` VALUES ('6', 'ลูกจ้างเหมาบริการ');
INSERT INTO `occupations` VALUES ('7', 'ลูกจ้างชั่วคราว');
INSERT INTO `occupations` VALUES ('8', 'ลูกจ้างชั่วคราว(นักเรียนทุน)');

-- ----------------------------
-- Table structure for positions
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'ตำแหน่ง',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='กลุ่มตำแหน่ง';

-- ----------------------------
-- Records of positions
-- ----------------------------
INSERT INTO `positions` VALUES ('1', 'พยาบาลวิชาชีพ');
INSERT INTO `positions` VALUES ('2', 'จพ.ทันตสาธารณสุข');
INSERT INTO `positions` VALUES ('3', 'จพ.ธุรการ');
INSERT INTO `positions` VALUES ('4', 'ทันตแพทย์');
INSERT INTO `positions` VALUES ('5', 'นักวิชาการสาธารณสุข');
INSERT INTO `positions` VALUES ('6', 'นายแพทย์');
INSERT INTO `positions` VALUES ('7', 'เภสัชกร');
INSERT INTO `positions` VALUES ('8', 'จพ.โสตทัศนศึกษา');
INSERT INTO `positions` VALUES ('9', 'จพ.เภสัชกรรม');
INSERT INTO `positions` VALUES ('10', 'จพ.สาธารณสุขชุมชน');
INSERT INTO `positions` VALUES ('11', 'จพ.เวชกิจฉุกเฉิน');
INSERT INTO `positions` VALUES ('12', 'จพ.การเงินและบัญชี');
INSERT INTO `positions` VALUES ('13', 'จพ.เวชสถิติ');
INSERT INTO `positions` VALUES ('14', 'พนักงานช่วยเหลือคนไข้');
INSERT INTO `positions` VALUES ('15', 'นักกายภาพบำบัด');
INSERT INTO `positions` VALUES ('16', 'แพทย์แผนไทย');
INSERT INTO `positions` VALUES ('17', 'จนท.บันทึกข้อมูล');
INSERT INTO `positions` VALUES ('18', 'พนักงานเปล');
INSERT INTO `positions` VALUES ('19', 'นักเทคนิคการแพทย์');
INSERT INTO `positions` VALUES ('20', 'จพ.รังสีการแพทย์');
INSERT INTO `positions` VALUES ('21', 'นักวิชาการคอมพิวเตอร์');
INSERT INTO `positions` VALUES ('22', 'พนักงานขับรถยนต์');
INSERT INTO `positions` VALUES ('23', 'พนักงานทำความสะอาด');
INSERT INTO `positions` VALUES ('24', 'พนักงานรักษาความปลอดภัย');
INSERT INTO `positions` VALUES ('25', 'พนักงานสถิติ');
INSERT INTO `positions` VALUES ('26', 'จพง.เผยแพร่และประชาสัมพันธ์');
INSERT INTO `positions` VALUES ('27', 'ช่างไฟฟ้าและอิเล็กทรอนิกส์');
INSERT INTO `positions` VALUES ('28', 'พนักงานห้องบัตร');
INSERT INTO `positions` VALUES ('29', 'พนักงานธุรการ');
INSERT INTO `positions` VALUES ('30', 'คนครัว');
INSERT INTO `positions` VALUES ('31', 'นักการภารโรง');
INSERT INTO `positions` VALUES ('32', 'จพ.งานสิทธิบัตร');
INSERT INTO `positions` VALUES ('33', 'จพ.พัสดุ');
INSERT INTO `positions` VALUES ('34', 'นักวิชาการการเงินและบัญชี');
INSERT INTO `positions` VALUES ('35', 'พนักงานบริการ');
INSERT INTO `positions` VALUES ('36', 'จพ.วิทยาศาสตร์การแพทย์');
INSERT INTO `positions` VALUES ('37', 'คนงาน');
INSERT INTO `positions` VALUES ('38', 'พนักงานทั่วไป');
INSERT INTO `positions` VALUES ('39', 'พนักงานพยาบาล');
INSERT INTO `positions` VALUES ('40', 'พนักงานช่วยการพยาบาล');
INSERT INTO `positions` VALUES ('41', 'ผู้ช่วยแพทย์แผนไทย');
INSERT INTO `positions` VALUES ('42', 'พนักงานห้องผ่าตัด');
INSERT INTO `positions` VALUES ('43', 'พนักงานบริการอัดสำเนา');
INSERT INTO `positions` VALUES ('44', 'นักวิชาการพัสดุ');
INSERT INTO `positions` VALUES ('45', 'พนักงานประจำห้องยา');
INSERT INTO `positions` VALUES ('46', 'จพง.เครื่องคอมพิวเตอร์');
INSERT INTO `positions` VALUES ('47', 'นักโภชนาการ');
INSERT INTO `positions` VALUES ('48', 'พยาบาลวิชาชีพปฏิบัติการ');
INSERT INTO `positions` VALUES ('49', 'พนักงานการเงินและบัญชี');
INSERT INTO `positions` VALUES ('50', 'จพ.สาธารณสุข');

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES ('1', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('2', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', 'Asia/Bangkok');
INSERT INTO `profile` VALUES ('3', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('4', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('5', null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for social_account
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`) USING BTREE,
  UNIQUE KEY `account_unique_code` (`code`) USING BTREE,
  KEY `fk_user_account` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of social_account
-- ----------------------------

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES ('1', 'eEkmHLanKzSe35r_Nde6BCTGFQWyeUkW', '1511782606', '0');
INSERT INTO `token` VALUES ('2', '1dZgQLswO0FdeSAaptfBLYiXR0ePBUid', '1511782685', '0');
INSERT INTO `token` VALUES ('3', 'VNwFnN5euGdFOhhFX2cl1oDgav2z_DcN', '1511782710', '0');
INSERT INTO `token` VALUES ('4', 'xtXmy4gptPz7pysKdKpGzylvb274fFal', '1511782728', '0');
INSERT INTO `token` VALUES ('5', 'x4i5qbr6QZzw7j9dTV3QnLq0Hcul6kHt', '1511939978', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `pos_id` int(11) DEFAULT NULL,
  `occ_id` int(11) DEFAULT NULL,
  `pos_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`) USING BTREE,
  UNIQUE KEY `user_unique_email` (`email`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'admin@local.com', '$2y$12$DdqLA3TIhVp23UQnZObxku67FeeyucK0j7S.9j8la3FBB.SZec99O', 'nXpRD304mxawx2u-FBEOhmxk-4i_riiI', null, null, null, '::1', '1511782605', '1511880795', '0', '1527436117', null, null, '1', '', 'Mr.Administrator', '1', '21', '1', '');
INSERT INTO `user` VALUES ('2', 'manager', 'manager@local.com', '$2y$12$sTVJgl9fOxbQdVZnm1G6A./FcdR75QAZFeYDAWS3VTw4hp/auPM5S', 'OHiR3u3KYQ65wFe4bpYzH94RfX-fRKI-', null, null, null, '::1', '1511782685', '1511791278', '0', '1512035179', null, null, '20', null, null, '4', null, null, null);
INSERT INTO `user` VALUES ('3', 'editor', 'editor@local.com', '$2y$12$eBFCD.ltXDVKpPTQqnbv..lMaK9dUw1vbJ4hIa.P35qGjYrMC7JPO', 'KA7boPI_EF54rFxfEPAK3cD_VOuxQfj6', null, null, null, '::1', '1511782710', '1511782710', '0', '1527502899', null, null, '20', null, null, '6', null, null, null);
INSERT INTO `user` VALUES ('4', 'user', 'user@local.com', '$2y$12$9EE/Sc71S0hQUOQZLZhYfe2B8iYgobjKd/dcLGqK.rnzJgSHIPIam', 'cmpA15--wNczFogQE0SSqU5iGNfrCi2f', null, null, null, '::1', '1511782728', '1511782728', '0', '1513237485', null, null, '10', null, null, null, null, null, null);
INSERT INTO `user` VALUES ('5', 'lawan', 'lawa09@hotmail.com', '$2y$12$w/yrY.4u4Unw4jQUHtGhfueY1CR8yax.m3murNmjpAt9w.HBnIt4S', 'SGIkpbOvnbfCLht-xscEDdHqEsn0g7K4', null, null, null, '1.1.203.249', '1511939978', '1511939978', '0', null, null, null, null, null, null, null, null, null, null);
