-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2021 at 08:53 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET GLOBAL innodb_strict_mode = 0;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_trc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_typeformat`
--

CREATE TABLE `tb_typeformat` (
  `format_id` int(11) NOT NULL,
  `formart_textcode` varchar(50) DEFAULT NULL,
  `formart_textname` varchar(200) DEFAULT NULL,
  `formart_salary` int(11) DEFAULT 1,
  `formart_shutdown` int(11) DEFAULT 1,
  `formart_ot` int(11) DEFAULT 2,
  `formart_assurance_pay` int(11) DEFAULT 4 COMMENT 'คืนเงินประกัน',
  `formart_sevrance` int(11) DEFAULT 3 COMMENT 'เงินค่าชดเชย',
  `formart_declare` int(11) DEFAULT 3 COMMENT 'ค่าบอกกล่าว',
  `text_works1p` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกวันทำงานพิเศษ1',
  `text_works2p` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกวันทำงานพิเศษ2',
  `text_works3p` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกวันทำงานพิเศษ3',
  `formart_ot101p` int(11) DEFAULT 3 COMMENT 'โอทีพิเศษ1',
  `formart_ot115p` int(11) DEFAULT 3 COMMENT 'โอทีพิเศษ1.5',
  `formart_ot102p` int(11) DEFAULT 3 COMMENT 'โอทีพิเศษ2',
  `formart_ot103p` int(11) DEFAULT 3 COMMENT 'โอทีพิเศษ3',
  `formart_ot104p` int(11) DEFAULT 3 COMMENT 'โอทีพิเศษ4',
  `text_ot101p` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกโอทีพิเศษ1',
  `text_ot115p` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกโอทีพิเศษ1.5',
  `text_ot121p` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกโอทีพิเศษ2',
  `text_ot103p` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกโอทีพิเศษ3',
  `text_ot104p` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกโอทีพิเศษ4',
  `formart_shift` int(11) DEFAULT 3 COMMENT 'ค่ากะ',
  `formart_meal` int(11) DEFAULT 3 COMMENT 'ค่าอาหาร',
  `formart_car` int(11) DEFAULT 3 COMMENT 'ค่ารถ',
  `formart_diligent` int(11) DEFAULT 3 COMMENT 'เบี้ยขยัน',
  `formart_etc` int(11) DEFAULT 3 COMMENT 'เบี้ยงเลี้ยง',
  `formart_bonus` int(11) DEFAULT 3 COMMENT 'โบนัส',
  `formart_cola` int(11) DEFAULT 3 COMMENT 'ค่าครองชีพ',
  `formart_telephone` int(11) DEFAULT 3 COMMENT 'ค่าโทร',
  `formart_skill` int(11) DEFAULT 3 COMMENT 'ค่าทักษะ',
  `formart_position` int(11) DEFAULT 3 COMMENT 'ค่าตำแหน่ง',
  `formart_gas` int(11) DEFAULT 3 COMMENT 'ค่าน้ำมัน',
  `formart_Incentive` int(11) DEFAULT 3 COMMENT 'Incentive',
  `formart_profession` int(11) DEFAULT 3 COMMENT 'ค่าวิชาชีพ',
  `formart_license` int(11) DEFAULT 3 COMMENT 'ค่าใบอนุญาติ',
  `formart_childship` int(11) DEFAULT 3 COMMENT 'เงินทุนการศึกษาบุตร',
  `formart_medical` int(11) DEFAULT 3 COMMENT 'ค่ารักษาพยาบาล',
  `formart_carde` int(11) DEFAULT 3 COMMENT 'ค่าเสื่อมสภาพรถ',
  `formart_uptravel` int(11) DEFAULT 3 COMMENT 'ค่าที่พัก/เดินทาง ตจว',
  `formart_stay` int(11) DEFAULT 3 COMMENT 'ค่าที่พักอาศัย',
  `formart_subsidy` int(11) DEFAULT 3 COMMENT 'เงินช่วยเหลือ',
  `formart_other` int(11) DEFAULT 3 COMMENT 'รายได้อื่นๆ',
  `formart_Incom1` int(11) DEFAULT 3 COMMENT 'รายได้อื่นๆIncom1',
  `formart_Incom2` int(11) DEFAULT 3 COMMENT 'รายได้อื่นๆIncom2',
  `formart_Incom3` int(11) DEFAULT 3,
  `formart_Incom4` int(11) DEFAULT 3,
  `formart_Incom5` int(11) DEFAULT 3,
  `formart_Incom6` int(11) DEFAULT 3,
  `formart_Incom7` int(11) DEFAULT 3,
  `formart_Incom8` int(11) DEFAULT 3,
  `formart_Incom9` int(11) DEFAULT 3,
  `formart_Incom10` int(11) DEFAULT 3,
  `formart_Incom11` int(11) DEFAULT 3,
  `formart_Incom12` int(11) DEFAULT 3,
  `formart_Incom13` int(11) DEFAULT 3,
  `formart_Incom14` int(11) DEFAULT 3,
  `formart_Incom15` int(11) DEFAULT 3,
  `formart_Incom16` int(11) DEFAULT 3,
  `formart_Incom17` int(11) DEFAULT 3,
  `formart_Incom18` int(11) DEFAULT 3,
  `formart_Incom19` int(11) DEFAULT 3,
  `formart_Incom20` int(11) DEFAULT 3 COMMENT 'รายได้อื่นๆIncom20',
  `text_Incom1` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกIncom1',
  `text_Incom2` varchar(70) DEFAULT NULL,
  `text_Incom3` varchar(70) DEFAULT NULL,
  `text_Incom4` varchar(70) DEFAULT NULL,
  `text_Incom5` varchar(70) DEFAULT NULL,
  `text_Incom6` varchar(70) DEFAULT NULL,
  `text_Incom7` varchar(70) DEFAULT NULL,
  `text_Incom8` varchar(70) DEFAULT NULL,
  `text_Incom9` varchar(70) DEFAULT NULL,
  `text_Incom10` varchar(70) DEFAULT NULL,
  `text_Incom11` varchar(70) DEFAULT NULL,
  `text_Incom12` varchar(70) DEFAULT NULL,
  `text_Incom13` varchar(70) DEFAULT NULL,
  `text_Incom14` varchar(70) DEFAULT NULL,
  `text_Incom15` varchar(70) DEFAULT NULL,
  `text_Incom16` varchar(70) DEFAULT NULL,
  `text_Incom17` varchar(70) DEFAULT NULL,
  `text_Incom18` varchar(70) DEFAULT NULL,
  `text_Incom19` varchar(70) DEFAULT NULL,
  `text_Incom20` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกIncom20',
  `deformart_assurance` int(11) DEFAULT 4 COMMENT 'หักประกัน',
  `deformart_uniform` int(11) DEFAULT 4 COMMENT 'หักค่าชุด',
  `deformart_card` int(11) DEFAULT 4 COMMENT 'ค่าบัตร',
  `deformart_cooperative` int(11) DEFAULT 4 COMMENT 'หักเงินออมสหกรณ์',
  `deformart_lond` int(11) DEFAULT 4 COMMENT 'เงินกู้บ้าน',
  `deformart_borrow` int(11) DEFAULT 4 COMMENT 'หักเงินกู้ยืม',
  `deformart_elond` int(11) DEFAULT 4 COMMENT 'หักเงินกู้ กยศ',
  `deformart_backtravel` int(11) DEFAULT 4 COMMENT 'หักเงินสำรองจ่ายตจว',
  `deformart_backother` int(11) DEFAULT 4 COMMENT 'หักเงินสำรองจ่ายอื่นๆ',
  `deformart_Selfemp` int(11) DEFAULT 4 COMMENT 'หักค่าตรวจประวัติ',
  `deformart_health` int(11) DEFAULT 4 COMMENT 'หักค่าตรวจสุขภาพ',
  `deformart_debtCase` int(11) DEFAULT 4 COMMENT 'หักเงินกรมบังคับคดี',
  `deformart_pernicious` int(11) DEFAULT 4 COMMENT 'ค่าความเสียหาย',
  `deformart_visa` int(11) DEFAULT 4 COMMENT 'Visa',
  `deformart_work_p` int(11) DEFAULT 4 COMMENT 'Work Permit',
  `deformart_outother` int(11) DEFAULT 4 COMMENT 'หักอื่นๆ',
  `deformart_out1` int(11) DEFAULT 4 COMMENT 'รายการหักอื่น1',
  `deformart_out2` int(11) DEFAULT 4,
  `deformart_out3` int(11) DEFAULT 4,
  `deformart_out4` int(11) DEFAULT 4,
  `deformart_out5` int(11) DEFAULT 4 COMMENT 'รายการหักอื่น5',
  `textde_out1` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกรายการหักอื่น1',
  `textde_out2` varchar(70) DEFAULT NULL,
  `textde_out3` varchar(70) DEFAULT NULL,
  `textde_out4` varchar(70) DEFAULT NULL,
  `textde_out5` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกรายการหักอื่น5',
  `deformart_absent` int(11) DEFAULT 4 COMMENT 'หักขาด',
  `deformart_late` int(11) DEFAULT 4 COMMENT 'หักสาย',
  `deformart_mulct` int(11) DEFAULT 4 COMMENT 'หักค่าปรับ',
  `deformart_workS1p` int(11) DEFAULT 4 COMMENT 'รายการหักวันทำงานพิเศษอื่น1',
  `deformart_workS2p` int(11) DEFAULT 4 COMMENT 'รายการหักวันทำงานพิเศษอื่น2',
  `deformart_workS3p` int(11) DEFAULT 4 COMMENT 'รายการหักวันทำงานพิเศษอื่น3',
  `textde_works1p` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกหักวันทำงานพิเศษ',
  `textde_works2p` varchar(70) DEFAULT NULL,
  `textde_works3p` varchar(70) DEFAULT NULL,
  `engtext_pr1` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกรายได้1',
  `engtext_pr2` varchar(70) DEFAULT NULL,
  `engtext_pr3` varchar(70) DEFAULT NULL,
  `engtext_pr4` varchar(70) DEFAULT NULL,
  `engtext_pr5` varchar(70) DEFAULT NULL,
  `engtext_pr6` varchar(70) DEFAULT NULL,
  `engtext_pr7` varchar(70) DEFAULT NULL,
  `engtext_pr8` varchar(70) DEFAULT NULL,
  `engtext_pr9` varchar(70) DEFAULT NULL,
  `engtext_pr10` varchar(70) DEFAULT NULL,
  `engtext_pr11` varchar(70) DEFAULT NULL,
  `engtext_pr12` varchar(70) DEFAULT NULL,
  `engtext_pr13` varchar(70) DEFAULT NULL,
  `engtext_pr14` varchar(70) DEFAULT NULL,
  `engtext_pr15` varchar(70) DEFAULT NULL,
  `engtext_pr16` varchar(70) DEFAULT NULL,
  `engtext_pr17` varchar(70) DEFAULT NULL,
  `engtext_pr18` varchar(70) DEFAULT NULL,
  `engtext_pr19` varchar(70) DEFAULT NULL,
  `engtext_pr20` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกรายได้20',
  `engtext_de1` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกรายการหัก1',
  `engtext_de2` varchar(70) DEFAULT NULL,
  `engtext_de3` varchar(70) DEFAULT NULL,
  `engtext_de4` varchar(70) DEFAULT NULL,
  `engtext_de5` varchar(70) DEFAULT NULL,
  `engtext_de6` varchar(70) DEFAULT NULL,
  `engtext_de7` varchar(70) DEFAULT NULL,
  `engtext_de8` varchar(70) DEFAULT NULL,
  `engtext_de9` varchar(70) DEFAULT NULL,
  `engtext_de10` varchar(70) DEFAULT NULL,
  `engtext_de11` varchar(70) DEFAULT NULL,
  `engtext_de12` varchar(70) DEFAULT NULL,
  `engtext_de13` varchar(70) DEFAULT NULL,
  `engtext_de14` varchar(70) DEFAULT NULL,
  `engtext_de15` varchar(70) DEFAULT NULL COMMENT 'ชื่อเรียกรายการหัก15'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_typeformat`
--

INSERT INTO `tb_typeformat` (`format_id`, `formart_textcode`, `formart_textname`, `formart_salary`, `formart_shutdown`, `formart_ot`, `formart_assurance_pay`, `formart_sevrance`, `formart_declare`, `text_works1p`, `text_works2p`, `text_works3p`, `formart_ot101p`, `formart_ot115p`, `formart_ot102p`, `formart_ot103p`, `formart_ot104p`, `text_ot101p`, `text_ot115p`, `text_ot121p`, `text_ot103p`, `text_ot104p`, `formart_shift`, `formart_meal`, `formart_car`, `formart_diligent`, `formart_etc`, `formart_bonus`, `formart_cola`, `formart_telephone`, `formart_skill`, `formart_position`, `formart_gas`, `formart_Incentive`, `formart_profession`, `formart_license`, `formart_childship`, `formart_medical`, `formart_carde`, `formart_uptravel`, `formart_stay`, `formart_subsidy`, `formart_other`, `formart_Incom1`, `formart_Incom2`, `formart_Incom3`, `formart_Incom4`, `formart_Incom5`, `formart_Incom6`, `formart_Incom7`, `formart_Incom8`, `formart_Incom9`, `formart_Incom10`, `formart_Incom11`, `formart_Incom12`, `formart_Incom13`, `formart_Incom14`, `formart_Incom15`, `formart_Incom16`, `formart_Incom17`, `formart_Incom18`, `formart_Incom19`, `formart_Incom20`, `text_Incom1`, `text_Incom2`, `text_Incom3`, `text_Incom4`, `text_Incom5`, `text_Incom6`, `text_Incom7`, `text_Incom8`, `text_Incom9`, `text_Incom10`, `text_Incom11`, `text_Incom12`, `text_Incom13`, `text_Incom14`, `text_Incom15`, `text_Incom16`, `text_Incom17`, `text_Incom18`, `text_Incom19`, `text_Incom20`, `deformart_assurance`, `deformart_uniform`, `deformart_card`, `deformart_cooperative`, `deformart_lond`, `deformart_borrow`, `deformart_elond`, `deformart_backtravel`, `deformart_backother`, `deformart_Selfemp`, `deformart_health`, `deformart_debtCase`, `deformart_pernicious`, `deformart_visa`, `deformart_work_p`, `deformart_outother`, `deformart_out1`, `deformart_out2`, `deformart_out3`, `deformart_out4`, `deformart_out5`, `textde_out1`, `textde_out2`, `textde_out3`, `textde_out4`, `textde_out5`, `deformart_absent`, `deformart_late`, `deformart_mulct`, `deformart_workS1p`, `deformart_workS2p`, `deformart_workS3p`, `textde_works1p`, `textde_works2p`, `textde_works3p`, `engtext_pr1`, `engtext_pr2`, `engtext_pr3`, `engtext_pr4`, `engtext_pr5`, `engtext_pr6`, `engtext_pr7`, `engtext_pr8`, `engtext_pr9`, `engtext_pr10`, `engtext_pr11`, `engtext_pr12`, `engtext_pr13`, `engtext_pr14`, `engtext_pr15`, `engtext_pr16`, `engtext_pr17`, `engtext_pr18`, `engtext_pr19`, `engtext_pr20`, `engtext_de1`, `engtext_de2`, `engtext_de3`, `engtext_de4`, `engtext_de5`, `engtext_de6`, `engtext_de7`, `engtext_de8`, `engtext_de9`, `engtext_de10`, `engtext_de11`, `engtext_de12`, `engtext_de13`, `engtext_de14`, `engtext_de15`) VALUES
(1, 'C1', 'รายได้เป็นรายได้ประจำ ค่าครองชีพ คิด สปส.', 1, 1, 2, 4, 4, 3, '', '', '', 3, 3, 3, 3, 0, '', '', '', '', '', 2, 3, 3, 3, 3, 3, 1, 3, 3, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 1, 1, 1, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 'เงินพิเศษ (สปส.)', 'เงินพิเศษ', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 3, 3, '', '', '', '', '', 0, 0, 0, 1, 1, 1, 'หักลา/ขาด', '', '', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r'),
(2, 'D1', 'รายได้เป็นรายได้ประจำ', 1, 3, 3, 4, 4, 3, '', '', '', 3, 3, 3, 3, 0, '', '', '', '', '', 3, 3, 3, 3, 3, 3, 3, 3, 3, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, '', '', '', '', '', 0, 0, 0, 4, 4, 4, '', '', '', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r'),
(3, 'D2', 'รายได้เป็นรายได้ประจำ Shut Down คิด สปส.', 1, 1, 3, 4, 4, 3, '', '', '', 3, 3, 3, 3, 0, '', '', '', '', '', 3, 3, 3, 3, 3, 3, 3, 3, 3, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, '', '', '', '', '', 0, 0, 0, 4, 4, 4, '', '', '', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r'),
(4, 'D3', 'รายได้เป็นรายได้ประจำ (นอร์เมริก้า)', 1, 3, 2, 4, 4, 3, '', '', '', 3, 3, 3, 3, 0, '', '', '', '', '', 3, 3, 2, 2, 3, 3, 2, 2, 3, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 1, 1, 1, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 3, 3, '', '', '', '', '', 0, 0, 0, 1, 1, 1, 'หักลา/ขาด', '', '', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r'),
(5, 'D4', 'รายได้เป็นรายได้ประจำ (สวัสดิ์การคิด สปส.)', 1, 3, 2, 4, 4, 3, '', '', '', 3, 3, 3, 3, 0, '', '', '', '', '', 1, 1, 3, 3, 1, 3, 1, 1, 1, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 1, 1, 1, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 3, 3, '', '', '', '', '', 0, 0, 0, 1, 1, 1, 'หักลา/ขาด', '', '', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r'),
(6, 'D5', 'Shut Down และ สวัสดิ์การคิด สปส.', 1, 1, 2, 4, 4, 3, '', '', '', 3, 3, 3, 3, 0, '', '', '', '', '', 1, 3, 3, 3, 3, 3, 1, 3, 1, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 1, 1, 1, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 3, 3, '', '', '', '', '', 0, 0, 0, 1, 1, 1, 'หักลา/ขาด', '', '', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r'),
(7, 'M1', 'รายได้และโอทีเป็นรายได้ประจำ', 1, 3, 2, 4, 4, 3, 'สลับหยุด', 'วันเกิด', '', 3, 3, 3, 3, 0, '', '', '', '', '', 3, 2, 2, 3, 2, 3, 2, 2, 2, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 'หักค่าโทรศัพท์', 'หักกยศ', '', '', '', 0, 0, 0, 4, 4, 4, '', '', '', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r'),
(8, 'M2', 'รายได้และโอทีเป็นรายได้ประจำ ค่าชดเชยคิดภาษี', 1, 3, 2, 4, 3, 3, '', '', '', 3, 3, 3, 3, 0, '', '', '', '', '', 3, 3, 2, 2, 3, 3, 2, 2, 3, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 3, 3, '', '', '', '', '', 0, 0, 0, 2, 2, 4, 'หักลา/ขาด', '', '', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r'),
(9, 'M3', 'รายได้และโอทีเป็นรายได้ประจำ วันหักคิด สปส.', 1, 3, 2, 4, 4, 3, '', '', '', 3, 3, 3, 3, 0, '', '', '', '', '', 3, 3, 2, 2, 3, 3, 2, 2, 3, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', 'ปรับปรุง อื่นๆ', '', '', '', '', '', '', 'Birthday (Non-tax)', 'Others (Non-tax)', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 3, 3, '', '', '', '', '', 0, 0, 0, 1, 1, 4, 'หักลา/ขาด', '', 'หักขาด พนง.ออก', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r'),
(10, 'M4', 'รายได้และโอทีเป็นรายได้ประจำ (TI)', 1, 3, 2, 4, 4, 3, '', '', '', 3, 3, 3, 3, 0, '', '', '', '', '', 3, 3, 2, 2, 1, 3, 2, 2, 3, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 3, 1, 1, 4, 4, 4, 4, 4, 0, 0, 0, 0, 0, 0, '', '', '', 'ปรับปรุง อื่นๆ', '', '', '', '', '', '', 'Birthday (Non-tax)', 'Others (Non-tax)', '', '', '', '', '', '', '', '', 4, 4, 4, 0, 4, 0, 0, 0, 0, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, '', '', '', '', '', 0, 0, 0, 1, 1, 4, 'หักลา/ขาด', '', 'หักขาด พนง.ออก', 'Shift', 'Meal', 'Car', 'Diligent', 'Allowance', 'Bonus', 'Cola', 'Telephone', 'Skill', 'Other', '', '', '', '', '', '', '', '', '', '', 'Assurance', 'Lond', 'Uniform', 'Card', 'Crime-Check', 'Health-Check', 'Visa', 'Work Permit', 'DebtCase', 'Pernicious', 'Other', '', '', '', '\r');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_typeformat`
--
ALTER TABLE `tb_typeformat`
  ADD PRIMARY KEY (`format_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_typeformat`
--
ALTER TABLE `tb_typeformat`
  MODIFY `format_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
