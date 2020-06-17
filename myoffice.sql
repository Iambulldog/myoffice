-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2020 at 04:31 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myoffice`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_list`
--

CREATE TABLE `tb_list` (
  `id` int(11) NOT NULL,
  `user_id` int(6) NOT NULL,
  `list` int(2) NOT NULL COMMENT '1-deposit, 2-withdraw',
  `total` decimal(10,2) NOT NULL,
  `bonus` decimal(10,2) NOT NULL,
  `admin_id` int(3) NOT NULL,
  `time_create` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0-ลบ /1-ปกติ /2 แก้ไข'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_list`
--

INSERT INTO `tb_list` (`id`, `user_id`, `list`, `total`, `bonus`, `admin_id`, `time_create`, `status`) VALUES
(1, 2, 2, '200.00', '0.00', 1, '2020-06-15 09:32:34', 1),
(2, 2, 1, '51.00', '0.00', 2, '2020-06-15 11:48:50', 1),
(3, 1, 1, '500.00', '0.00', 1, '2020-06-15 21:40:05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_list_log`
--

CREATE TABLE `tb_list_log` (
  `id` int(11) NOT NULL,
  `id_list` int(11) NOT NULL,
  `user_id` int(6) NOT NULL,
  `list` int(2) NOT NULL COMMENT '1-deposit, 2-withdraw',
  `total` decimal(10,2) NOT NULL,
  `bonus` decimal(10,2) NOT NULL,
  `admin_id` int(3) NOT NULL,
  `time_create` datetime NOT NULL DEFAULT current_timestamp(),
  `time_create_log` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_list_log`
--

INSERT INTO `tb_list_log` (`id`, `id_list`, `user_id`, `list`, `total`, `bonus`, `admin_id`, `time_create`, `time_create_log`) VALUES
(1, 3, 1, 1, '501.00', '0.00', 1, '2020-06-15 21:40:05', '2020-06-17 21:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sername` varchar(50) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id`, `username`, `nickname`, `password`, `salt`, `name`, `sername`, `tel`, `last_login`, `last_ip`) VALUES
(1, 'admin', 'อมยิ้ม', '73296e4efb065f9bef030514eff879b29bb9d9a4', 'gQic6G0r5IzAtlCVsbvuGu', 'ชื่อ1', 'สกุล1', '1', '2020-06-17 21:07:44', '::1'),
(2, 'admin2', 'ทราย', '4210c91398aca5765f9bfc3de8d9b9b7b2142ce8', 'vc.DjIo/SnADvd34B8dco.', 'ชื่อ2', 'สกุล2', '1', '2020-06-17 21:22:46', '::1'),
(3, 'test', '', '575bad7d27d40e83850a635990b26c608ab3b3a3', 'ruzVcBT1X9uqORS0r0EyqO', '', '', '', '2020-06-17 21:07:05', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `web_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `web_id`) VALUES
(1, 'mmm', 1),
(2, 'bbb', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_web`
--

CREATE TABLE `tb_web` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_web`
--

INSERT INTO `tb_web` (`id`, `name`) VALUES
(1, 'web1'),
(2, 'web2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_list`
--
ALTER TABLE `tb_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_list_log`
--
ALTER TABLE `tb_list_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_web`
--
ALTER TABLE `tb_web`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_list`
--
ALTER TABLE `tb_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_list_log`
--
ALTER TABLE `tb_list_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_web`
--
ALTER TABLE `tb_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
