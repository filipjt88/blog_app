-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 09:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Sport'),
(2, 'Biznis'),
(3, 'Zdravlje'),
(4, 'Tehnologija'),
(5, 'Automobili'),
(6, 'Putovanja');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `user_id`, `created_at`, `category_id`, `image`) VALUES
(34, 'Novak Đoković u finalu Ženeve: Najveći ikada srušio Britanca, bori se za 100. titulu u karijeri!', 'Srpski teniser Novak Đoković boriće se za svoj 100. trofej u karijeri, pošto se plasirao u finale ATP turnira u Ženevi. On je nakon tri seta pobedio Britanca Kamerona Norija 6:4, 6:7, 6:1, a u finalu će igrati protiv Poljaka Huberta Hurkača.\r\nOd samog starta meča viđena je velika borba. Obojica tenisera bila su veoma sigurna u svojim servis gemovima, a onda je Novak slomio Norija u sedmom gemu i osvojio brejk. Ispostaviće se da je on bio dovoljan kako bi Srbin poveo 1:0 u setovima.', 3, '2025-05-24 11:26:32', 1, 'uploads/1748085992_37832_profimedia-1001726923_f.jpg'),
(35, 'Novi Audi Q8', 'The facelifted Q8 was unveiled on 5 September 2023 for the 2024 model year.[15] Subtle in nature, the exterior changes included larger air inlets in the front bumper, and a new exhaust setup which is fitted across the lineup. The Singleframe grille now has octagonal elements and flows smoothly into the headlamps. The SQ8 features a redesigned front spoiler and rear diffuser, while the grille, side view mirrors, and air intakes feature aluminium for an aesthetic appeal. The design of the Matrix LED headlights has been changed, and the Q8 will be available with the high-tech laser lights that increase the range of the high beams. The daytime running lights on range-topping variants be swapped four different lighting signatures via the infotainment screen, and the rear light bar has a more simple design', 3, '2025-05-24 11:39:33', 5, 'uploads/1748086773_2018_Audi_Q8.jpg'),
(36, 'Code programming', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, '2025-05-24 11:40:26', 4, 'uploads/1748086826_pexels-pixabay-270488.jpg'),
(37, 'Novi post', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2025-05-24 16:23:20', 6, 'uploads/1748103800_windows-11-landscape-scenery-2k-wallpaper-uhdpaper.com-557@0@i.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'filip88', 'filip88ks@gmail.com', '$2y$10$TJrgZkr.lmZSkrZ.hBKqjuUN6KiG9OupC/OZo.zQywE6giJuaL8cq', 'user', '2025-05-11 20:36:59'),
(2, 'petar86', 'pera@gmail.com', '$2y$10$1ngwnAqpDoYF.EAjAxlCveBDRqqnpX0xJPrRNv3TJ7L6mrGgPOM6m', 'user', '2025-05-12 18:11:50'),
(3, 'Dejan Zivkovic zile', 'dexi88@gmail.com', '$2y$10$0WWcub5juAgFZ.HRr5q6CeOzrRIIfUkE7hkYRb2W9TtnDHTd35Y2W', 'user', '2025-05-12 20:34:51'),
(4, 'mita', 'mita@gmail.com', '$2y$10$tfqw4dJWWGjgSVilt2957OdDQei59MOfmT.bTw1DFRLdaRKU78VZG', 'user', '2025-05-20 10:45:04'),
(5, 'deja', 'deja@gmail.com', '$2y$10$Xr9LLoV3vYmyjbYok/5GIeZoH83ulixaCNS0.YoV5GYOpTSudOIOK', 'user', '2025-05-20 10:46:07'),
(6, 'nidza', 'nidza@gmail.com', '$2y$10$yC14snj2/jw.aesAMYovwekuyX9rpUfoymaZJfBFdOJjUe6lLnwBi', 'user', '2025-05-20 10:49:59'),
(7, 'mica66', 'mica66@gmail.com', '$2y$10$0OPKnpyKfsUSJCy711S3bOGJY0dO1KkDVWhPOkAmMOWvKj08HMZXi', 'user', '2025-05-20 19:30:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`user_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
