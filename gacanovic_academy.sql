-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2021 at 12:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gacanovic_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_course`, `order_date`) VALUES
(1, 2, 7, '2021-03-12 19:19:12'),
(2, 2, 5, '2021-03-12 19:22:50'),
(3, 2, 5, '2021-03-12 22:03:59'),
(4, 2, 9, '2021-03-12 22:05:15'),
(5, 2, 3, '2021-03-12 22:06:45'),
(6, 3, 12, '2021-03-12 22:12:13'),
(7, 3, 12, '2021-03-12 22:12:50'),
(8, 4, 8, '2021-03-12 22:25:37'),
(11, 5, 12, '2021-03-13 16:55:43'),
(12, 4, 10, '2021-10-29 18:45:54'),
(13, 4, 1, '2021-12-29 21:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `category_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `category_name`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'Marketing', '1615204169-category-Marketing.jpg', '2021-03-08 11:49:29', '2021-03-08 11:49:29'),
(2, 'Development', '1615204185-category-Development .jpg', '2021-03-08 11:49:45', '2021-03-08 11:49:45'),
(3, 'Design', '1615204204-category-Design.jpg', '2021-03-08 11:50:04', '2021-03-08 11:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `contact_mail`
--

CREATE TABLE `contact_mail` (
  `id_contact_mail` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_mail`
--

INSERT INTO `contact_mail` (`id_contact_mail`, `subject`, `email`, `message`, `date`) VALUES
(1, 'Prvi naslov', 'pjer@gmail.com', 'pozzz', '2021-02-06 21:17:15'),
(2, 'Proba kontakt forme', 'gacanoviccc97@gmail.com', 'Pozdrav tamo!', '2021-03-02 10:23:46'),
(3, 'Testic', 'gacanoviccc97@gmail.com', 'Testiranje 22', '2021-03-08 12:10:42'),
(4, 'Proba kontakt forme', 'gacanoviccc97@gmail.com', 'Probaaaa', '2021-03-09 16:07:26'),
(6, 'Nebitno', 'jova@gmail.com', 'Moja porulaaaa', '2021-10-29 19:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id_course` int(11) NOT NULL,
  `course_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `total_hours` decimal(4,1) NOT NULL,
  `image_small` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_big` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id_course`, `course_name`, `price`, `total_hours`, `image_small`, `image_big`, `id_category`, `created_at`, `updated_at`) VALUES
(1, 'CSS Beginner Friendly', '12.00', '6.0', '1615566817-uploaded-CSS.png', 'big-1615566817-uploaded-CSS.png', 2, '2021-03-12 16:33:37', '2021-03-12 16:47:48'),
(2, 'CSS Designing Skills', '15.50', '12.0', '1615566920-uploaded-CSS.v2.png', 'big-1615566920-uploaded-CSS.v2.png', 2, '2021-03-12 16:35:20', '2021-03-12 16:48:10'),
(3, 'Graphic Design Masterclass', '120.00', '40.0', '1615566995-uploaded-Design-course.jpg', 'big-1615566995-uploaded-Design-course.jpg', 3, '2021-03-12 16:36:35', '2021-03-12 16:36:35'),
(4, 'Facebook Marketing, Ads', '99.99', '11.0', '1615567048-uploaded-Facebook.png', 'big-1615567048-uploaded-Facebook.png', 1, '2021-03-12 16:37:29', '2021-03-12 16:37:29'),
(5, 'Photoshop In-Depth', '45.00', '9.0', '1615567135-uploaded-Free-photoshop.png', 'big-1615567135-uploaded-Free-photoshop.png', 3, '2021-03-12 16:38:55', '2021-03-12 16:38:55'),
(6, 'Introduction to Graphic Design', '9.99', '5.0', '1615567186-uploaded-Graphic-design.png', 'big-1615567186-uploaded-Graphic-design.png', 3, '2021-03-12 16:39:47', '2021-03-12 16:39:47'),
(7, 'React & Laravel Authentication', '198.00', '48.0', '1615567265-uploaded-React&Laravel.png', 'big-1615567265-uploaded-React&Laravel.png', 2, '2021-03-12 16:41:05', '2021-03-12 16:41:05'),
(8, 'React From Scratch', '15.00', '22.0', '1615567307-uploaded-React-mini.png', 'big-1615567307-uploaded-React-mini.png', 2, '2021-03-12 16:41:48', '2021-03-12 16:41:48'),
(9, 'Adobe Essentials', '50.00', '15.0', '1615567355-uploaded-Adobe.png', 'big-1615567355-uploaded-Adobe.png', 3, '2021-03-12 16:42:35', '2021-03-12 16:42:35'),
(10, 'Social Media Marketing Mastery', '211.00', '64.0', '1615567410-uploaded-Social-media.png', 'big-1615567410-uploaded-Social-media.png', 1, '2021-03-12 16:43:31', '2021-03-12 16:43:31'),
(11, 'Ultimate Photoshop Training', '114.00', '27.0', '1615567447-uploaded-Photoshop-training.jpg', 'big-1615567447-uploaded-Photoshop-training.jpg', 3, '2021-03-12 16:44:07', '2021-03-12 16:44:07'),
(12, 'WEB Developer Bootcamp', '144.00', '36.0', '1615567480-uploaded-WEB-developer-bootcamp.jpg', 'big-1615567480-uploaded-WEB-developer-bootcamp.jpg', 2, '2021-03-12 16:44:40', '2021-03-12 16:44:40'),
(13, 'SEO 2021: Complete Training', '158.00', '39.0', '1615567544-uploaded-SEO-optimization.png', 'big-1615567544-uploaded-SEO-optimization.png', 1, '2021-03-12 16:45:44', '2021-03-12 16:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `course_topic`
--

CREATE TABLE `course_topic` (
  `id_course_topic` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_topic`
--

INSERT INTO `course_topic` (`id_course_topic`, `id_course`, `id_topic`) VALUES
(4, 3, 4),
(5, 3, 5),
(6, 4, 1),
(7, 4, 2),
(8, 5, 5),
(9, 6, 4),
(10, 7, 6),
(11, 8, 6),
(12, 9, 4),
(13, 9, 5),
(14, 10, 1),
(15, 11, 5),
(16, 12, 2),
(17, 12, 3),
(18, 12, 6),
(19, 13, 2),
(20, 1, 3),
(21, 2, 3),
(22, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id_topic` int(11) NOT NULL,
  `topic_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id_topic`, `topic_name`, `created_at`, `updated_at`) VALUES
(1, 'Social Media Marketing', '2021-02-08 18:07:04', '2021-02-08 18:07:04'),
(2, 'SEO', '2021-02-08 18:07:04', '2021-03-06 12:15:52'),
(3, 'CSS', '2021-02-08 18:07:23', '2021-02-08 18:07:23'),
(4, 'Graphic Design', '2021-02-08 18:07:23', '2021-02-08 18:07:23'),
(5, 'Photoshop', '2021-02-08 18:07:47', '2021-02-08 18:07:47'),
(6, 'React', '2021-02-08 18:07:47', '2021-02-08 18:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `last_logout` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `active`, `id_role`, `created_at`, `updated_at`, `last_login`, `last_logout`) VALUES
(1, 'gacho97', 'gacanovic@gmail.com', 'd0d85110a4e437cdf888d49cb4e20af2', 0, 1, '2021-03-12 17:26:30', '2021-03-12 17:26:30', '2021-10-29 16:24:34', '2021-10-29 16:29:57'),
(2, 'viktor98', 'viktor@gmail.com', 'fc1a79950f1490827c134a9450773478', 0, 2, '2021-03-12 19:14:40', '2021-03-12 19:14:40', '2021-03-13 15:21:23', '2021-03-13 15:21:38'),
(3, 'mirjana333', 'mirjana@gmail.com', '3f9fb0c0be57d4669027d8bf5c96b21b', 0, 2, '2021-03-12 19:28:38', '2021-03-12 19:28:38', '2021-03-12 21:11:06', '2021-03-12 21:13:12'),
(4, 'bojan65', 'bojan@gmail.com', 'c28d5e4f3af2be389094098a2e10d704', 0, 2, '2021-03-12 22:15:31', '2021-03-12 22:15:31', '2021-12-29 20:52:36', '2021-12-29 20:53:55'),
(5, 'teletabis001', 'teletabis@yahoo.com', 'f143d4f5d4c1b2f23914a535aeaa18e1', 0, 2, '2021-03-13 16:29:54', '2021-03-13 16:29:54', '2021-03-13 15:57:41', '2021-03-13 15:58:15'),
(6, 'tester29', 'test29@gmail.com', 'f0cb60e4dfbba5674340ba95d21c3f04', 0, 2, '2021-12-29 21:06:26', '2021-12-29 21:06:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wish`
--

CREATE TABLE `wish` (
  `id_wish` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wish`
--

INSERT INTO `wish` (`id_wish`, `id_user`, `id_course`, `created_at`) VALUES
(2, 2, 5, '2021-03-12 19:17:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_course` (`id_course`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `contact_mail`
--
ALTER TABLE `contact_mail`
  ADD PRIMARY KEY (`id_contact_mail`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id_course`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `course_topic`
--
ALTER TABLE `course_topic`
  ADD PRIMARY KEY (`id_course_topic`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_topic` (`id_topic`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id_topic`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `wish`
--
ALTER TABLE `wish`
  ADD PRIMARY KEY (`id_wish`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_course` (`id_course`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_mail`
--
ALTER TABLE `contact_mail`
  MODIFY `id_contact_mail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_topic`
--
ALTER TABLE `course_topic`
  MODIFY `id_course_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wish`
--
ALTER TABLE `wish`
  MODIFY `id_wish` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);

--
-- Constraints for table `course_topic`
--
ALTER TABLE `course_topic`
  ADD CONSTRAINT `course_topic_ibfk_1` FOREIGN KEY (`id_topic`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_topic_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `wish`
--
ALTER TABLE `wish`
  ADD CONSTRAINT `wish_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `wish_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
