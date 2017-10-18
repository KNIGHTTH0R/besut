-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2017 at 06:35 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `besutdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `IDADMIN` int(11) NOT NULL,
  `IDROLE` int(11) NOT NULL,
  `USERNAME` varchar(32) NOT NULL,
  `AEMAIL` varchar(224) NOT NULL,
  `APASSCODE` char(64) NOT NULL,
  `BLOCKED` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`IDADMIN`, `IDROLE`, `USERNAME`, `AEMAIL`, `APASSCODE`, `BLOCKED`) VALUES
(1, 4, 'admin', 'muhammadshodiq165@gmail.com', 'e5651ddca4a38f5659ba3bbe0f3b31e577e071c2ba0221e61845d687b913f2d8', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `IDCOMMENT` int(11) NOT NULL,
  `IDUSER` int(11) NOT NULL,
  `IDREPORT` int(11) NOT NULL,
  `PARENT_COMMENT` int(11) DEFAULT NULL,
  `CCONTENT` text NOT NULL,
  `VOTEUP` int(11) NOT NULL,
  `VOTEDOWN` int(11) NOT NULL,
  `CDATE_TIME` datetime NOT NULL,
  `REPORTED` int(11) NOT NULL,
  `PRIORITY` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`IDCOMMENT`, `IDUSER`, `IDREPORT`, `PARENT_COMMENT`, `CCONTENT`, `VOTEUP`, `VOTEDOWN`, `CDATE_TIME`, `REPORTED`, `PRIORITY`) VALUES
(2, 1, 8, 0, '\'asdasda\'', 0, 6, '2017-10-18 08:41:26', 0, 0),
(3, 1, 8, 2, '\'Typography helps you engage your audience and establish a distinct, unique personality on your website. Knowing how to use fonts to build character in your design is a powerful skill, and exploring the history and use of typefaces, as well as typogra\'', 0, 2, '2017-10-18 08:47:33', 0, 0),
(4, 1, 8, 3, '\'Typography helps you engage your audience and establish a distinct, unique personality on your website. Knowing how to use fonts to build character in your design is a powerful skill, and exploring the history and use of typefaces, as well as typogra\'', 1, 2, '2017-10-18 08:48:29', 0, 0),
(5, 1, 8, 2, '\'Typography helps you engage your audience and establish a distinct, unique personality on your website. Knowing how to use fonts to build character in your design is a powerful skill, and exploring the history and use of typefaces, as well as typogra\'', 0, 1, '2017-10-18 08:50:08', 0, 0),
(6, 1, 8, 0, '\'Typography helps you engage your audience and establish a distinct, unique personality on your website. Knowing how to use fonts to build character in your design is a powerful skill, and exploring the history and use of typefaces, as well as typogra\'', 4, 1, '2017-10-18 08:50:19', 0, 1),
(7, 1, 8, 6, '\'Typography helps you engage your audience and establish a distinct, unique personality on your website. Knowing how to use fonts to build character in your design is a powerful skill, and exploring the history and use of typefaces, as well as typogra\'', 0, 3, '2017-10-18 08:51:03', 0, 0),
(8, 1, 8, 6, '\'Typography helps you engage your audience and establish a distinct, unique personality on your website. Knowing how to use fonts to build character in your design is a powerful skill, and exploring the history and use of typefaces, as well as typogra\'', 2, 1, '2017-10-18 08:51:29', 0, 0),
(9, 1, 8, 8, '\'Typography helps you engage your audience and establish a distinct, unique personality on your website. Knowing how to use fonts to build character in your design is a powerful skill, and exploring the history and use of typefaces, as well as typogra\'', 4, 1, '2017-10-18 08:51:58', 0, 0),
(10, 1, 8, 0, '\'sebuah contoh komen\'', 0, 1, '2017-10-18 10:46:00', 0, 0),
(11, 1, 8, 0, '\'xczvxzgdrsrghcdvgf\'', 0, 1, '2017-10-18 10:47:09', 0, 0),
(12, 1, 8, 0, '\'bdfgdasgfs\'', 0, 1, '2017-10-18 10:47:39', 0, 0),
(13, 1, 8, 0, '\'siap bos\'', 0, 1, '2017-10-18 10:48:01', 0, 0),
(14, 1, 8, 0, '\'lagi\'', 0, 1, '2017-10-18 10:49:20', 0, 0),
(15, 1, 8, 0, '\'zxcasdqwe\'', 0, 1, '2017-10-18 10:51:07', 0, 0),
(16, 1, 8, 0, '\'zxcasdqwe\'', 0, 1, '2017-10-18 10:51:07', 0, 0),
(17, 1, 8, 0, '\'qweasdzxc\'', 0, 1, '2017-10-18 10:51:13', 0, 0),
(18, 1, 8, 0, '\'nm\'', 0, 1, '2017-10-18 10:54:37', 0, 0),
(19, 1, 8, 0, '\'dfgw\'', 0, 1, '2017-10-18 11:04:27', 0, 0),
(20, 1, 8, 0, '\'dia\'', 0, 1, '2017-10-18 11:14:28', 0, 0),
(21, 1, 8, 0, '\'wew\'', 0, 1, '2017-10-18 11:14:39', 0, 0),
(22, 1, 8, 0, '\'ses\'', 0, 1, '2017-10-18 11:15:10', 0, 0),
(23, 1, 8, 0, '\'qwe\'', 0, 1, '2017-10-18 11:15:17', 0, 0),
(24, 1, 8, 0, '\'jiah\'', 0, 1, '2017-10-18 11:17:34', 0, 0),
(25, 1, 8, 0, '\'hmmmmm\'', 0, 1, '2017-10-18 11:18:31', 0, 0),
(26, 1, 8, 0, '\'wewxz\'', 0, 1, '2017-10-18 11:19:08', 0, 0),
(27, 1, 8, 0, '\'ciee\'', 0, 1, '2017-10-18 11:19:28', 0, 0),
(28, 1, 8, 0, '\'fffff\'', 0, 1, '2017-10-18 11:22:07', 0, 0),
(29, 1, 8, 0, '\'cccc\'', 0, 1, '2017-10-18 11:22:35', 0, 0),
(30, 1, 8, 0, '\'teruskan\'', 0, 1, '2017-10-18 11:23:20', 0, 0),
(31, 1, 8, 0, '\'lagiiii\'', 0, 1, '2017-10-18 11:24:20', 0, 0),
(40, 1, 16, 0, '\'pertamax\'', 0, 1, '2017-10-18 11:36:08', 0, 0),
(41, 1, 16, 0, '\'keduax\'', 0, 1, '2017-10-18 11:37:24', 0, 0),
(42, 1, 8, 0, '\'sgfs\'', 0, 1, '2017-10-18 16:04:44', 0, 0),
(43, 1, 8, 0, '\'gak ada masalah\'', 0, 1, '2017-10-18 16:31:18', 0, 0),
(44, 1, 8, 7, '\'mencoba\'', 0, 1, '2017-10-18 17:20:42', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_reports`
--

CREATE TABLE `post_reports` (
  `IDREPORT` int(11) NOT NULL,
  `IDUSER` int(11) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `LINK` text,
  `WEBCONTENT` text,
  `RDESC` text NOT NULL,
  `RPICTURES` text,
  `PDATE_TIME` datetime NOT NULL,
  `BOT_ESTIMATION` decimal(3,2) NOT NULL,
  `VOTESHOAX` int(11) NOT NULL,
  `VOTESNOT` int(11) NOT NULL,
  `COMMENTCOUNTER` int(11) NOT NULL,
  `CLOSED` tinyint(1) NOT NULL,
  `CLOSEDBY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_reports`
--

INSERT INTO `post_reports` (`IDREPORT`, `IDUSER`, `TITLE`, `LINK`, `WEBCONTENT`, `RDESC`, `RPICTURES`, `PDATE_TIME`, `BOT_ESTIMATION`, `VOTESHOAX`, `VOTESNOT`, `COMMENTCOUNTER`, `CLOSED`, `CLOSEDBY`) VALUES
(8, 1, '\'Innalillahi.. Ternyata Presiden Sekarang Sebenarnya Kristen ! Dan Pemerintahan Sekarang Di Kuasai Kristen ! &gt;&gt; Pantas Banyak Kebijakannya Yang Anti Islam !\'', '\'http://duniamuallaf.blogspot.co.id/2015/04/innalillahi-ternyata-presiden-sekarang.html\'', '\'Ketua DPP Partai Gerindra Arief Poyuono mengatakan, langkah Jokowi yang memperluas wewenang Kantor Staf Kepresidenan yang dipimpin oleh Jenderal TNI (Purn) Luhut Binsar Pandjaitan, mirip dengan mandat khusus atau the power attorney dengan wewenang yang sama, dengan tugas seorang the real presiden.\\r\\n\\r\\nIa menjelaskan, Luhut Panjaitan memiliki wewenang pengendalian dan evaluasi kinerja para menteri sesuai dengan Perpres yang ditandatangani pada 26 Februari 2015, Luhut juga berwenang melaksanakan tugas pengendalian program-program prioritas nasional.\\r\\n\\r\\nTidak sampai disitu, Luhut berwenang menjalankan fungsi pengendalian dalam rangka memastikan program-program prioritas nasional sesuai dengan visi dan misi Pemerintah, dan penyelesaian masalah secara komprehensif terhadap program-program prioritas nasional yang dalam pelaksanaannya mengalami hambatan.\\r\\n\\r\\nLuhut panjaitan juga bertugas untuk percepatan pelaksanaan program-program prioritas nasional dan pemantauan kemajuan terhadap pelaksanaan program-program prioritas nasional yang merupakan tugas seorang presiden.\\r\\n\\r\\n\\\"Hampir tugas dan wewenang Luhut Panjaitan adalah yang melekat pada seorang presiden. Makin jelas secara politik bahwa real presiden hari ini adalah Luhut Panjaitan dan Kepala Negara adalah Jokowi,\\\" kata Arief Poyuono dalam rilisnya, Rabu 4 Maret 2015.\\r\\n\\r\\nSementara secara sosiologi, tambah dia, Luhut sebagai real presiden ditandai dengan Luhut berkantor di Istana Jakarta sebagai simbol pusat pemerintahan, sementara Jokowi \\\'pindah\\\' berkantor dan tinggal di Istana Bogor.\\r\\n\\r\\n\\\"Dengan kekuasaan penuh yang diberikan pada Luhut, ia juga memiliki kekuasaan mengendalikan angkatan perang dan Polri, dengan peraturan presiden yang dibuat Jokowi secara politik, dan kewenangan hanya untuk meyatakan perang hanya atas perintah Jokowi,\\\" tandas Ketua Umum Federasi Serikat Pekerja BUMN Bersatu ini. [rmol].\'', '\'mengandung SARA dan tidak rational.. liat saja gambarnya sangat tidak profesional.. kayak poster film saja..\'', '1309681174/25_-_Copy.jpg~1309681174/25.jpg~', '2017-10-14 19:04:58', '0.00', 4, 3, 33, 0, NULL),
(16, 1, '\'Heboh, Ini Dia Akun Bongkar 25 Bukti Jokowi PKI, Benarkah?\'', '\'https://www.intelijen.co.id/heboh-ini-dia-akun-bongkar-25-bukti-jokowi-pki-benarkah/\'', '\'intelijen – Wacana Presiden Joko Widodo akan menyampaikan permintaan maaf kepada Partai Komunis Indonesia (PKI) terus mengundang kontroversi. Bahkan banyak kalangan mulai melancarkan kritik keras hingga berbagai tuduhan kepada mantan Wali Kota Solo dan Gubernur DKI Jakarta tersebut.\\r\\n\\r\\nSalah satu tuduhan yang muncul berasal dari sebuah akun twitter yang menamakan diri “Semar”. Melalui akun @TM2000Semar, pada Senin (13/7/2015), akun tersebut membongkar 25 bukti bahwa Jokowi merupakan seorang PKI. Namun belum diketahui secara pasti kebenaran bukti-bukti dari kultwit dalam akun tersebut.\\r\\n\\r\\nNamun tuduhan ini sebenarnya bukan hal baru. Sebagian dari tuduhan ini sudah muncul sejak Pilpres 2014 lalu.\\r\\n\\r\\nBerikut isi kultwit 25 bukti yang menyebutkan bahwa Jokowi seorang PKI:\\r\\n\\r\\n1. Bukti Jokowi PKI: sembunyikan indentitas asli dan tempat lahirnya. Ngaku2 lahir di Bantaran Kali Pepe, Munggung, Solo. faktanya? tidak\\r\\n\\r\\n2. Bukti Jokowi PKI, semula tidak ngaku berasal dari Giriroto Ngemplak Boyolali, Basis PKI terbesar RI 1955-1965. Raih 21 dari 34 kursi\\r\\n\\r\\n3. Bukti Jokowi PKI, sembunyikan nama asli orang tuanya. Widjiatno, biasa dipanggil Pak Widji oleh tetangga, diganti dengan Noto Mihardjo\\r\\n\\r\\n4. Bukti Jokowi PKI, widji ayah Jokowi Ketua Operasi Perlawanan Rakyat (OPR) Pembunuh puluhan umat Islam 1 Okt 1965 di Giriroto, Boyolali\\r\\n\\r\\n5. Bukti PKI : Tutupi fakta ayahnya melarikan diri saat operasi TNI. Ayah jokowi sembunyi 4 thn di Wonogiri, bersama Supardi Tokoh PKI\\r\\n\\r\\n6. Bukti Jokowi PKI : sembunyikan fakta ayahnya, Widji sembunyi ngumpet di Makam Raden Umar Said bersama Supardi, skrg nyamar kuncen makam\\r\\n\\r\\n7. Bukti Jokowi PKI : Jokowi rutin kunjungi Supardi aka Mbah Pardi yg skrg nyamar jadi kuncen Makam Keramat R Umar Said di Wonogiri.\\r\\n\\r\\n8. Bukti Jokowi PKI : Jokowi didoktrin PKI dan dimentor Mbah Pardi tokoh PKI yg juga mentor satgas2 PDIP Boyolali, Klaten dan Solo. Ngeri !\\r\\n\\r\\n9. Bukti Jokowi PKI : jokowi muncul jd cawalkot Solo dan direkomendasi Seno Kumuharsdjo tokoh LEKRA PKI atas permintaan Mbah Pardi.\\r\\n\\r\\n10. Bukti Jokowi PKI : dia tak pernah tunjukan akte lahir, buku nikah, kartu keluarga asli dll. Takut jadi bukti nama ayahnya : widjiatno\'', '\'parah isinya\'', '819783964/Akun-yang-menunjukkan-25-bukti-Jokowi-seorang-PKI-595x279.jpg~', '2017-10-17 20:30:19', '0.00', 1, 0, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `IDROLE` int(11) NOT NULL,
  `RNAME` varchar(128) NOT NULL,
  `USER` tinyint(1) NOT NULL,
  `DIRECT_VOTE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`IDROLE`, `RNAME`, `USER`, `DIRECT_VOTE`) VALUES
(1, 'Stamdard User', 1, 0),
(2, 'Journalist User', 1, 1),
(3, 'Editor', 0, 0),
(4, 'Administrator', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `IDUSER` int(11) NOT NULL,
  `USERKEY` varchar(32) NOT NULL,
  `IDROLE` int(11) NOT NULL,
  `UNAME` varchar(128) NOT NULL,
  `PROFILE_PIC` text NOT NULL,
  `UEMAIL` varchar(224) NOT NULL,
  `UPASSCODE` char(64) NOT NULL,
  `ULOCATION` text,
  `URATE` decimal(3,2) NOT NULL,
  `REGISTRATION_DATE` datetime NOT NULL,
  `ACTIVE_STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`IDUSER`, `USERKEY`, `IDROLE`, `UNAME`, `PROFILE_PIC`, `UEMAIL`, `UPASSCODE`, `ULOCATION`, `URATE`, `REGISTRATION_DATE`, `ACTIVE_STATUS`) VALUES
(1, '522830b2f6f816caad18c46b887d516d', 1, 'Shodiq Muhammad', '106370679817697174198.jpg', 'muhammadshodiq165@gmail.com', 'f3c6002984950cf8027a020758e544576e28ae82ce0ca4b0d4de512c12897f8d', 'Surabaya City, East Java, Indonesia', '0.00', '0000-00-00 00:00:00', 1),
(4, '4d0929dfadbc208d7c43ee89652d5acf', 1, 'Muhammad Shodiq', '1457015491056536.jpg', 'muhammadshodiq165@gmail.com', '5d6f3a6ca66b8a0d9388d3c9a47fb27788f777635f6421dede1f9a52f7bedcb9', 'Surabaya City, East Java, Indonesia', '0.00', '2017-10-12 18:36:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `votes_comment`
--

CREATE TABLE `votes_comment` (
  `IDCOMMENT` int(11) NOT NULL,
  `IDUSER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes_comment`
--

INSERT INTO `votes_comment` (`IDCOMMENT`, `IDUSER`) VALUES
(40, 1),
(41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `votes_report`
--

CREATE TABLE `votes_report` (
  `IDREPORT` int(11) NOT NULL,
  `IDUSER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes_report`
--

INSERT INTO `votes_report` (`IDREPORT`, `IDUSER`) VALUES
(16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `IDWEBSITE` int(11) NOT NULL,
  `DOMAIN` varchar(224) NOT NULL,
  `REPORTED` int(11) NOT NULL,
  `WEBDESC` text NOT NULL,
  `WEBACTIVE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`IDWEBSITE`, `DOMAIN`, `REPORTED`, `WEBDESC`, `WEBACTIVE`) VALUES
(1, 'www.youtube.com', 1, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.\r\n\r\nUt wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.\r\n\r\nNam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.\r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.\r\n\r\nAt vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat. \r\n\r\nConsetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n', 1),
(2, 'www.google.com', 2, 'full with hoax', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`IDADMIN`),
  ADD KEY `FK_ADMIN_ROLE` (`IDROLE`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`IDCOMMENT`),
  ADD KEY `FK_PHAS` (`IDREPORT`),
  ADD KEY `FK_POSTING` (`IDUSER`);

--
-- Indexes for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD PRIMARY KEY (`IDREPORT`),
  ADD KEY `FK_REPORTING` (`IDUSER`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IDROLE`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IDUSER`,`USERKEY`),
  ADD KEY `FK_USER_ROLE` (`IDROLE`);

--
-- Indexes for table `votes_comment`
--
ALTER TABLE `votes_comment`
  ADD KEY `FK_CVOTER` (`IDUSER`),
  ADD KEY `FK_CVOTING` (`IDCOMMENT`);

--
-- Indexes for table `votes_report`
--
ALTER TABLE `votes_report`
  ADD KEY `FK_RVOTER` (`IDUSER`),
  ADD KEY `FK_RVOTING` (`IDREPORT`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`IDWEBSITE`),
  ADD UNIQUE KEY `DOMAIN` (`DOMAIN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `IDADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `IDCOMMENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `IDREPORT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `IDROLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `IDUSER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `IDWEBSITE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `FK_ADMIN_ROLE` FOREIGN KEY (`IDROLE`) REFERENCES `roles` (`IDROLE`);

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `FK_PHAS` FOREIGN KEY (`IDREPORT`) REFERENCES `post_reports` (`IDREPORT`),
  ADD CONSTRAINT `FK_POSTING` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`);

--
-- Constraints for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD CONSTRAINT `FK_REPORTING` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_USER_ROLE` FOREIGN KEY (`IDROLE`) REFERENCES `roles` (`IDROLE`);

--
-- Constraints for table `votes_comment`
--
ALTER TABLE `votes_comment`
  ADD CONSTRAINT `FK_CVOTER` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`),
  ADD CONSTRAINT `FK_CVOTING` FOREIGN KEY (`IDCOMMENT`) REFERENCES `post_comments` (`IDCOMMENT`);

--
-- Constraints for table `votes_report`
--
ALTER TABLE `votes_report`
  ADD CONSTRAINT `FK_RVOTER` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`),
  ADD CONSTRAINT `FK_RVOTING` FOREIGN KEY (`IDREPORT`) REFERENCES `post_reports` (`IDREPORT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
