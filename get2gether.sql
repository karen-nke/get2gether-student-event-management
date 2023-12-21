-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2023 at 09:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `get2gether`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------
--
-- Table structure for table `memberships`
--
DROP TABLE IF EXISTS `memberships`;
CREATE TABLE `memberships` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(255) DEFAULT NULL,
  `club_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `user_id`, `club_id`, `role`, `created_at`, `updated_at`, `username`, `club_name`) VALUES
(1, 1, 1, 'pic', '2023-11-27 11:55:11', '2023-12-19 07:51:51', 'CodeClub', 'Coding Club'),
(2, 2, 2, 'pic', '2023-11-27 12:06:03', '2023-12-15 14:34:32', 'PhotographyClub', 'Photography Society'),
(3, 3, 3, 'pic', '2023-11-27 12:16:34', '2023-11-27 12:16:34', 'SportsEnthusiasts', 'Sports Enthusiasts'),
(4, 4, 4, 'pic', '2023-11-27 12:16:38', '2023-11-27 12:16:38', 'ArtEnthusiasts', 'Art Enthusiasts'),
(5, 5, 5, 'pic', '2023-12-16 13:54:25', '2023-12-19 07:51:51', 'FitnessFreak', 'Fitness Freak'),
(8, 6, 6, 'pic', '2023-12-16 14:29:19', '2023-12-16 14:29:19', 'TechInnovators', 'Tech Innovators'),
(9, 7, 1, 'committee', '2023-11-27 11:55:11', '2023-12-19 07:51:51', 'CodeClub', 'Coding Club'),
(10, 8, 1, 'member', '2023-11-27 11:55:11', '2023-12-19 07:51:51', 'CodeClub', 'Coding Club');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--
DROP TABLE IF EXISTS `event_registrations`;
CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_registrations`
--

INSERT INTO `event_registrations` (`id`,`user_id`, `username`, `event_id`)
VALUES 
(1, 8, 'DemoAcc2', 2),
(2, 8, 'DemoAcc2', 9);


-- --------------------------------------------------------

--
-- Table structure for table `events`
--
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_venue` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `event_image_path` varchar(255) DEFAULT NULL,
  `event_description` text NOT NULL,
  `club_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_title`, `event_venue`, `start_time`, `end_time`, `start_date`, `end_date`, `event_image_path`, `event_description`, `club_id`, `user_id`) VALUES
(1, 'Annual Charity Gala', 'Grand Ballroom, XYZ Hotel', '18:00:00', '23:00:00', '2023-12-23', '2023-12-23', 'Image/Event1.png', 'Join us for an elegant evening of fundraising and entertainment.', 4, 4),
(2, 'Tech Symposium 2023', 'Conference Center, Innovation Hub', '09:00:00', '17:00:00', '2024-12-21', '2024-12-21', 'Image/Event2.png', 'Explore the latest trends and innovations in technology.', 1, 1),
(3, 'Art Exhibition: Visionaries', 'Art Gallery, City Museum', '11:00:00', '18:00:00', '2024-02-24', '2024-02-24', 'Image/Event3.png', 'A showcase of visionary artists pushing the boundaries of creativity.', 4, 4),
(4, 'Food Festival: Taste of the World', 'Outdoor Plaza, Downtown', '15:00:00', '22:00:00', '2023-12-25', '2023-12-25', 'Image/Event4.png', 'Savor delicious dishes from around the globe in one place.', 4, 4),
(5, 'Startup Networking Mixer', 'Co-Working Space, Tech Hub', '17:30:00', '20:30:00', '2023-12-10', '2023-12-10', 'Image/Event5.png', 'Connect with fellow entrepreneurs and investors in the startup ecosystem.', 6, 6),
(6, 'Music Festival: Harmony Beats', 'Main Stage, City Park', '12:00:00', '22:00:00', '2023-12-27', '2023-12-27', 'Image/Event6.png', 'Experience a day filled with diverse musical performances and positive vibes.', 4, 4),
(7, 'Beach Cleaning', 'Testing', '16:19:00', '18:20:00', '2023-12-28', '2023-12-28', 'uploads/beach cleaning.png', 'Testing', 5, 5),
(8, 'Tech Expo 2024', 'Innovation Hall', '12:00:00', '14:00:00', '2023-12-29', '2023-12-29', 'Image/Event1.png', 'Explore the latest technological innovations and trends.', 6, 6),
(9, 'Code Jam Championship', 'Coding Arena', '15:00:00', '17:00:00', '2023-12-20', '2023-12-20', 'Image/Event2.png', 'Compete in a coding challenge and showcase your skills.', 1, 1),
(10, 'Startup Networking Night', 'Entrepreneurship Hub', '18:00:00', '20:00:00', '2023-12-31', '2023-12-31', 'Image/Event3.png', 'Connect with fellow entrepreneurs and investors.', 6, 6),
(11, 'Photography Exhibition', 'Art Gallery', '13:00:00', '15:00:00', '2024-01-01', '2024-01-01', 'Image/Event4.png', 'Showcasing stunning photography from our club members.', 2, 2),
(12, 'Camera Techniques Workshop', 'Studio A', '16:00:00', '18:00:00', '2024-01-02', '2024-01-02', 'Image/Event5.png', 'Learn advanced photography techniques from experts.', 2, 2),
(13, 'Nature Photography Expedition', 'Outdoor Locations', '19:00:00', '21:00:00', '2024-01-03', '2024-01-03', 'Image/Event6.png', 'Explore and capture the beauty of nature through photography.', 2, 2),
(14, 'Sports Fest 2024', 'Sports Complex', '14:00:00', '16:00:00', '2024-01-04', '2024-01-04', 'Image/Event1.png', 'An exciting day of sports competitions and games.', 3, 3),
(15, 'Fitness Challenge Day', 'Gymnasium', '17:00:00', '19:00:00', '2024-01-05', '2024-01-05', 'Image/Event2.png', 'Join us for a day of fitness challenges and workouts.', 5, 5),
(16, 'Soccer Tournament', 'Soccer Field', '20:00:00', '22:00:00', '2024-01-06', '2024-01-06', 'Image/Event3.png', 'Compete in our annual soccer tournament.', 3, 3),
(17, 'Tech Symposium 2024', 'Conference Center, Innovation Hub', '09:00:00', '17:00:00', '2024-12-21', '2024-12-21', 'Image/Event2.png', 'Explore the latest trends and innovations in technology.', 1, 7);



-- --------------------------------------------------------



--
-- Table structure for table `clubs`
--
DROP TABLE IF EXISTS `clubs`;
CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `club_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `subscriber_count` int(11) NOT NULL DEFAULT 0,
  `profile_image` varchar(255) DEFAULT NULL,
  `contact_email` varchar(100) NOT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `club_name`, `description`, `subscriber_count`, `profile_image`, `contact_email`, `instagram_link`, `facebook_link`) VALUES
(1, 'Coding Club', 'Explore the world of coding and programming', 120, 'Image/Logo_Placeholder.png', 'coding@example.com', 'https://instagram.com/codingclub', 'https://facebook.com/codingclub'),
(2, 'Photography Society', 'Capture the beauty around you with us!', 80, 'Image/Logo_Placeholder.png', 'photo@example.com', 'https://instagram.com/photography_society', 'https://facebook.com/photographysociety'),
(3, 'Sports Enthusiasts', 'Stay active, stay healthy. Join us for sports!', 150, 'Image/Logo_Placeholder.png', 'sports@example.com', 'https://instagram.com/sportsenthusiasts', 'https://facebook.com/sportsenthusiasts'),
(4, 'Art Enthusiasts', 'A community passionate about various forms of art, including painting, sculpture, and digital art.', 150, 'Image/Logo_Placeholder.png', 'art@example.com', 'instagram.com/art_enthusiasts', 'facebook.com/ArtEnthusiasts'),
(5, 'Fitness Freaks', 'Join us for fitness and well-being. We organize regular workout sessions, yoga classes, and health-related workshops.', 200, 'Image/Logo_Placeholder.png', 'fitness@example.com', 'instagram.com/fitness_freaks', 'facebook.com/FitnessFreaks'),
(6, 'Tech Innovators', 'Dive into the world of technology and innovation. We explore coding, robotics, and the latest tech trends.', 180, 'Image/Logo_Placeholder.png', 'tech@example.com', 'instagram.com/tech_innovators', 'facebook.com/TechInnovators');

-- --------------------------------------------------------







-- --------------------------------------------------------

--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `code` varchar(155) NOT NULL,
  `status` varchar(155) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `gender`, `contact_number`, `address`, `city`, `state`, `bio`, `code`, `status`, `profile_image`) VALUES
(1, 'CodeClub', 'codeclub@gmail.com', '$2y$10$v/g4hCHBOHqiXZywU92uGOLNDDsefdx6E0w.R/RWUT9uYRa7Kvu4m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Explore the world of coding and programming', '219883', 'verified', NULL),
(2, 'PhotographyClub', 'photographyclub@gmail.com', '$2y$10$v/g4hCHBOHqiXZywU92uGOLNDDsefdx6E0w.R/RWUT9uYRa7Kvu4m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Capture the beauty around you with us!', '0', 'verified', NULL),
(3, 'SportsEnthusiasts', 'sportsenthusiasts@gmail.com', '$2y$10$v/g4hCHBOHqiXZywU92uGOLNDDsefdx6E0w.R/RWUT9uYRa7Kvu4m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Stay active, stay healthy. Join us for sports!', '0', 'verified', NULL),
(4, 'ArtEnthusiasts', 'artenthusiasts@gmail.com', '$2y$10$v/g4hCHBOHqiXZywU92uGOLNDDsefdx6E0w.R/RWUT9uYRa7Kvu4m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A community passionate about various forms of art, including painting, sculpture, and digital art.', '0', 'verified', NULL),
(5, 'FitnessFreak', 'fitnessfreak@gmail.com', '$2y$10$v/g4hCHBOHqiXZywU92uGOLNDDsefdx6E0w.R/RWUT9uYRa7Kvu4m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Join us for fitness and well-being. We organize regular workout sessions, yoga classes, and health-related workshops.', '0', 'verified', NULL),
(6, 'TechInnovators', 'techinovator@gmail.com', '$2y$10$v/g4hCHBOHqiXZywU92uGOLNDDsefdx6E0w.R/RWUT9uYRa7Kvu4m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dive into the world of technology and innovation. We explore coding, robotics, and the latest tech trends.', '0', 'verified', NULL),
(7, 'DemoAcc', 'demoacc@gmail.com', '$2y$10$LBcyT099qn.1PrFLq33CpurL/XfMlIZO8uCxiJK8fbZoR6FoZAGn.', 'Jackson', '', 'male', '', '', '', '', 'Sleeping', '0', 'verified', NULL),
(8, 'DemoAcc2', 'demoacc2@gmail.com', '$2y$10$v/g4hCHBOHqiXZywU92uGOLNDDsefdx6E0w.R/RWUT9uYRa7Kvu4m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'verified', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_registration` (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `event_registrations_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `memberships`
--
ALTER TABLE `memberships`
  ADD CONSTRAINT `memberships_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `memberships_ibfk_2` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
