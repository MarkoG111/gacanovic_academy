-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 03:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id_answer` int(11) NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id_answer`, `answer`) VALUES
(1, 'In Person'),
(2, 'Informally'),
(3, 'Professionally'),
(4, 'Online'),
(5, 'Other');

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
(1, 'Test Subject', 'sofija@gmail.com', 'Test Message', '2022-12-19 22:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id_course` int(11) NOT NULL,
  `course_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `total_hours` decimal(4,1) NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_small` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_big` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id_course`, `course_name`, `description`, `price`, `total_hours`, `author`, `image_small`, `image_big`, `id_category`, `created_at`, `updated_at`) VALUES
(36, 'AdobeX Design', 'Adobe professional course.', '255.25', '21.0', 'gacho97 - Admin', '1673822806-uploaded-Adobe.png', 'big-1673822806-uploaded-Adobe.png', 3, '2023-01-15 22:46:47', '2023-01-15 22:46:47'),
(37, 'CSS Basic', 'Basic CSS course for beginners!', '159.00', '43.0', 'milica93', '1673822993-uploaded-CSS.png', 'big-1673822993-uploaded-CSS.png', 2, '2023-01-15 22:49:54', '2023-01-15 22:49:54'),
(38, 'CSS Advanced', 'CSS v2 - Advanced Course', '364.00', '25.0', 'milica93', '1673823106-uploaded-CSS.v2.png', 'big-1673823106-uploaded-CSS.v2.png', 2, '2023-01-15 22:51:46', '2023-01-19 23:30:27'),
(39, 'Designing', 'Designing art', '113.50', '40.0', 'sofija01', '1673823274-uploaded-Design-course.jpg', 'big-1673823274-uploaded-Design-course.jpg', 3, '2023-01-15 22:54:35', '2023-01-15 22:54:35'),
(40, 'Facebook Ads', 'Facebook Ads Ultimate Course. Learn to manage your ads on social media like Facebook.', '422.00', '51.0', 'sofija01', '1673823336-uploaded-Facebook.png', 'big-1673823336-uploaded-Facebook.png', 1, '2023-01-15 22:55:36', '2023-01-15 22:55:36'),
(41, 'Photoshop', 'Photoshop Course where you will learn everything to edit your photos.', '236.00', '34.0', 'sofija01', '1673823411-uploaded-Free-photoshop.png', 'big-1673823411-uploaded-Free-photoshop.png', 3, '2023-01-15 22:56:51', '2023-01-15 22:56:51'),
(42, 'Graphic Design', 'Graphic Design modern course, most complete one.', '499.99', '42.0', 'sofija01', '1673823494-uploaded-Graphic-design.png', 'big-1673823494-uploaded-Graphic-design.png', 3, '2023-01-15 22:58:15', '2023-01-15 22:58:15'),
(44, 'React n Laravel', 'Learn to build modern applications using React with Laravel 9', '698.99', '131.0', 'nikola77', '1673823672-uploaded-React&Laravel.png', 'big-1673823672-uploaded-React&Laravel.png', 2, '2023-01-15 23:01:12', '2023-01-15 23:01:12'),
(45, 'React mini', 'React mini crash course for beginners\r\nJavaScript Library [2023]', '80.00', '9.0', 'nikola77', '1673823735-uploaded-React-mini.png', 'big-1673823735-uploaded-React-mini.png', 2, '2023-01-15 23:02:15', '2023-01-15 23:02:15'),
(46, 'WEB Development Bootcamp', '100+ WEB Development thigs You should know', '789.00', '145.0', 'nikola77', '1673823803-uploaded-webdev_bootcamp.jpg', 'big-1673823803-uploaded-webdev_bootcamp.jpg', 2, '2023-01-15 23:03:23', '2023-01-15 23:03:23'),
(47, 'SEO Optimization', 'Learn SEO optimization very fast and easy', '74.00', '5.5', 'petar88', '1673823906-uploaded-SEO-optimization.png', 'big-1673823906-uploaded-SEO-optimization.png', 1, '2023-01-15 23:05:06', '2023-01-15 23:05:06'),
(48, 'Social Media Marketing', 'Get more experience in social media marketing with this new hot course', '235.00', '17.0', 'petar88', '1673823970-uploaded-Social-media.png', 'big-1673823970-uploaded-Social-media.png', 1, '2023-01-15 23:06:10', '2023-01-15 23:06:10'),
(49, 'Photoshop Training', 'Photoshop training session for experienced users', '99.99', '22.0', 'sofija01', '1674216590-uploaded-Photoshop-training.jpg', 'big-1674216590-uploaded-Photoshop-training.jpg', 3, '2023-01-20 12:09:50', '2023-01-20 12:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `courses_orders`
--

CREATE TABLE `courses_orders` (
  `id_courses_orders` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_course_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses_orders`
--

INSERT INTO `courses_orders` (`id_courses_orders`, `id_course`, `id_course_order`) VALUES
(1, 37, 1),
(2, 46, 1),
(3, 48, 2),
(4, 49, 2),
(5, 44, 3);

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
(217, 36, 4),
(218, 36, 5),
(219, 37, 3),
(221, 39, 4),
(222, 40, 1),
(223, 40, 2),
(224, 41, 5),
(225, 42, 4),
(228, 44, 6),
(229, 45, 6),
(230, 46, 2),
(231, 46, 6),
(232, 47, 2),
(233, 48, 1),
(234, 38, 3),
(235, 49, 5);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id_lesson` int(11) NOT NULL,
  `lesson` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`id_lesson`, `lesson`, `id_course`) VALUES
(99, 'https://www.youtube.com/watch?v=LBPIYvfFEYw', 36),
(100, 'https://www.youtube.com/watch?v=dVNFd39R1YA', 37),
(102, 'https://www.youtube.com/watch?v=KZszj-jiqoQ', 39),
(103, 'https://www.youtube.com/watch?v=8I9jbS4_GxE', 40),
(104, 'https://www.youtube.com/watch?v=IyR_uYsRdPs&t=1s', 41),
(105, 'https://www.youtube.com/watch?v=9QTCvayLhCA&t=27757s', 42),
(106, 'https://www.youtube.com/watch?v=YqQx75OPRa0', 42),
(107, 'https://www.youtube.com/watch?v=l-S2Y3SF3mM', 42),
(111, 'https://www.youtube.com/watch?v=qJq9ZMB2Was&t=9442s', 44),
(112, 'https://www.youtube.com/watch?v=svziC8BblM0', 44),
(113, 'https://www.youtube.com/watch?v=GL48t3lY-tI&list=PLRheCL1cXHrtT6rOSlab8VzMKBlfL-IEA', 44),
(114, 'https://www.youtube.com/watch?v=bMknfKXIFA8&t=17932s', 45),
(115, 'https://www.youtube.com/watch?v=erEgovG9WBs', 46),
(116, 'https://www.youtube.com/watch?v=MYE6T_gd7H0', 47),
(117, 'https://www.youtube.com/watch?v=6FYVm7_5eHU', 48),
(118, 'https://www.youtube.com/watch?v=8MCjAktqZaM', 38),
(119, 'https://www.youtube.com/watch?v=IyR_uYsRdPs&t=2s', 49),
(120, 'https://www.youtube.com/watch?v=g3qe4rDw1XU', 49);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_course_order` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `id_session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_course_order`, `status`, `total_price`, `id_session`, `id_user`, `updated_at`, `created_at`) VALUES
(1, 'paid', '948.00', 'cs_test_b1bbDkLYHfsbQ8n62Os3juxD9zEHdxcGkDV5QhxJyfPTkWpCgas7FRrFCf', 19, '2023-01-20 12:20:25', '2023-01-20 12:20:06'),
(2, 'paid', '334.99', 'cs_test_b1iWh0fZqciej78HD20ZAM3NeDENleLp0oJvvPO1orP7tdaKMinuh0Iy2L', 18, '2023-01-20 12:22:30', '2023-01-20 12:22:02'),
(3, 'paid', '698.99', 'cs_test_a1hSDnMsZMQqOId7nBr4ntHA9QLDGZtDRt0s6oXNwEBJqlL5fe01v1d2Ak', 17, '2023-01-20 12:23:56', '2023-01-20 12:23:39');

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
(6, 'React', '2021-02-08 18:07:47', '2022-12-23 15:14:31');

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
  `is_instructor` tinyint(11) NOT NULL DEFAULT 0,
  `id_role` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `last_logout` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `active`, `is_instructor`, `id_role`, `created_at`, `updated_at`, `last_login`, `last_logout`) VALUES
(1, 'gacho97', 'gacanovic@gmail.com', 'c6758e679c3deb002f86847becb5fdf9', 0, 0, 1, '2021-03-12 17:26:30', '2021-03-12 17:26:30', '2023-01-26 13:52:12', '2023-01-26 13:54:34'),
(13, 'milica93', 'milica@gmail.com', 'c04871e1dd3c1b9e9a93394e91c23ae6', 0, 1, 2, '2023-01-15 22:26:53', '2023-01-15 22:36:06', '2023-01-19 22:30:03', '2023-01-19 22:30:37'),
(14, 'milos94', 'milos@gmail.com', 'e3a885770ca195525fee7106f8c81560', 0, 0, 2, '2023-01-15 22:29:29', '2023-01-15 22:29:29', NULL, NULL),
(15, 'jovana91', 'jovana@gmail.com', 'b643a2b8deda19fa9b156905474bf04a', 0, 0, 2, '2023-01-15 22:29:57', '2023-01-15 22:29:57', '2023-01-17 19:38:45', '2023-01-17 19:56:24'),
(16, 'nevena90', 'nevena@gmail.com', 'ee5faf4e236dd3e9adad6fe20f452410', 0, 1, 2, '2023-01-15 22:30:15', '2023-01-15 22:30:15', '2023-01-19 23:14:30', '2023-01-19 23:39:59'),
(17, 'petar88', 'petar@gmail.com', 'acaf02b95f0716ee6ed9560ec29c07c2', 0, 1, 2, '2023-01-15 22:30:29', '2023-01-15 22:30:29', '2023-01-20 11:23:22', '2023-01-20 11:26:02'),
(18, 'nikola77', 'nikola@gmail.com', '746c151c7af97b5b8f5f818a2b8ab1ce', 0, 1, 2, '2023-01-15 22:30:54', '2023-01-15 22:30:54', '2023-01-20 18:55:27', '2023-01-20 18:56:11'),
(19, 'sofija01', 'sofija@hotmail.com', 'd2ea540625930e9f30e5d70c0a8c89ca', 0, 1, 2, '2023-01-15 22:43:50', '2023-01-15 22:43:50', '2023-01-20 12:36:14', '2023-01-20 12:36:58'),
(20, 'adam92', 'adam@gmail.com', '55da423625dcd4463e1e9a5b49a962f6', 0, 1, 2, '2023-01-26 14:50:13', '2023-01-26 14:50:13', '2023-01-26 13:50:20', '2023-01-26 13:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id_voting` int(11) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id_voting`, `id_answer`, `id_user`) VALUES
(3, 2, 19),
(4, 3, 18),
(5, 5, 17),
(6, 3, 16),
(7, 2, 20);

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
(10, 19, 46, '2023-01-17 20:33:38'),
(11, 19, 45, '2023-01-18 23:38:31'),
(12, 19, 38, '2023-01-18 23:38:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id_answer`);

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
-- Indexes for table `courses_orders`
--
ALTER TABLE `courses_orders`
  ADD PRIMARY KEY (`id_courses_orders`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_course_orders` (`id_course_order`);

--
-- Indexes for table `course_topic`
--
ALTER TABLE `course_topic`
  ADD PRIMARY KEY (`id_course_topic`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_topic` (`id_topic`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id_lesson`),
  ADD KEY `id_course` (`id_course`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_course_order`),
  ADD KEY `id_user` (`id_user`);

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
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id_voting`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_answer` (`id_answer`);

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
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id_answer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_mail`
--
ALTER TABLE `contact_mail`
  MODIFY `id_contact_mail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `courses_orders`
--
ALTER TABLE `courses_orders`
  MODIFY `id_courses_orders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_topic`
--
ALTER TABLE `course_topic`
  MODIFY `id_course_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id_lesson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_course_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id_voting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wish`
--
ALTER TABLE `wish`
  MODIFY `id_wish` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);

--
-- Constraints for table `courses_orders`
--
ALTER TABLE `courses_orders`
  ADD CONSTRAINT `courses_orders_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`),
  ADD CONSTRAINT `courses_orders_ibfk_2` FOREIGN KEY (`id_course_order`) REFERENCES `orders` (`id_course_order`);

--
-- Constraints for table `course_topic`
--
ALTER TABLE `course_topic`
  ADD CONSTRAINT `course_topic_ibfk_1` FOREIGN KEY (`id_topic`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_topic_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`);

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `voting`
--
ALTER TABLE `voting`
  ADD CONSTRAINT `voting_ibfk_1` FOREIGN KEY (`id_answer`) REFERENCES `answer` (`id_answer`),
  ADD CONSTRAINT `voting_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

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
