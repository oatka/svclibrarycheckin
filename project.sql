-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2024 at 05:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`, `name`) VALUES
(1, 'admin', '1234', 'ผู้ดูแลระบบ');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `st_name` varchar(255) NOT NULL,
  `st_barcode` varchar(255) NOT NULL,
  `st_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `st_name`, `st_barcode`, `st_img`) VALUES
(1, 'กานต์ฐิติ คงเรือง', '65202040002', 'uploads/65202040002.jpg'),
(2, 'ศศิธร แก้วรัตน์', '65202040028', 'uploads/406403714_675919078009966_86421060000740148_n.jpg'),
(3, 'ณอร เหล่าศรีวรพันธ์', '65202040052', 'uploads/65202040052.jpg'),
(4, 'อัมพวรรณ์ ช่างปาน', '65202040038', 'uploads/inbound2733984777139205182 - 038นางสาวอัมพวรรณ์ ช่างปาน.jpg'),
(5, 'ณัฐริกา แสงสุบรรณ์', '65202040008', 'uploads/B6CB6178-A5FE-4841-A5CE-7E05095CF1D3 - 008นางสาวณัฐริกา แสงสุบรรณ์.jpeg'),
(6, 'นายธนาเทพ นาคทาย', '65202040011', 'uploads/21DD16F7-6262-479F-8558-9F36805557A4 - 011นายธนาเทพ นาคทาย.jpeg'),
(7, 'วรพจน์ แก้วกัญญาติ', '65202040025', 'uploads/428291975_363485693308824_8194535100747341756_n.jpg'),
(8, 'ภูวฤทธิ์ วิชัยดิษฐ', '65202040022', 'uploads/IMG_3685 - 022นายภูวฤทธิ์ วิชัยดิษฐ.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `time_check`
--

CREATE TABLE `time_check` (
  `id` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `st_date` date NOT NULL,
  `st_in` time DEFAULT NULL,
  `st_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_check`
--

INSERT INTO `time_check` (`id`, `st_id`, `st_date`, `st_in`, `st_out`) VALUES
(1, 2, '2024-01-27', '20:01:54', NULL),
(9, 8, '2024-01-31', '08:56:46', NULL),
(10, 7, '2024-01-31', '09:00:46', NULL),
(11, 7, '2024-02-02', '08:23:47', NULL),
(12, 7, '2024-02-07', '09:29:46', NULL),
(13, 1, '2024-02-07', '09:40:25', NULL),
(14, 1, '2024-02-07', '09:53:08', NULL),
(15, 1, '2024-02-21', '09:29:38', NULL),
(16, 1, '2024-02-21', '20:30:53', NULL),
(17, 1, '2024-02-21', '20:31:51', NULL),
(18, 1, '2024-02-22', '09:45:03', NULL),
(19, 22, '2024-02-22', '11:11:45', NULL),
(20, 1, '2024-02-22', '13:01:40', NULL),
(21, 1, '2024-02-22', '13:01:56', NULL),
(22, 1, '2024-02-23', '08:33:33', NULL),
(23, 1, '2024-02-23', '08:40:05', NULL),
(24, 1, '2024-02-23', '08:53:30', NULL),
(25, 1, '2024-02-23', '08:55:44', NULL),
(26, 1, '2024-02-23', '10:52:22', NULL),
(27, 1, '2024-02-23', '10:55:39', NULL),
(28, 1, '2024-06-01', '07:23:37', NULL),
(29, 1, '2024-06-01', '08:06:12', NULL),
(30, 1, '2024-06-10', '10:37:03', NULL),
(31, 1, '2024-06-14', '11:17:23', NULL),
(32, 1, '2024-06-14', '11:31:03', NULL),
(33, 8, '2024-06-14', '11:38:28', NULL),
(34, 1, '2024-06-14', '11:39:07', NULL),
(35, 3, '2024-07-01', '11:12:07', NULL),
(36, 1, '2024-07-22', '10:03:27', NULL),
(37, 1, '2024-08-15', '23:02:58', NULL),
(38, 1, '2024-08-15', '23:04:19', NULL),
(39, 1, '2024-08-17', '10:58:51', NULL),
(40, 3, '2024-08-17', '11:04:00', NULL),
(41, 7, '2024-08-17', '11:55:58', NULL),
(42, 1, '2024-08-18', '18:02:25', NULL),
(43, 3, '2024-08-19', '10:27:15', NULL),
(44, 1, '2024-08-23', '14:45:00', NULL),
(45, 1, '2024-08-23', '14:51:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_check`
--
ALTER TABLE `time_check`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `time_check`
--
ALTER TABLE `time_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
