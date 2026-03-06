-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 01:53 PM
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
-- Database: `gym_fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_records`
--

CREATE TABLE `event_records` (
  `er_id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `event_name` varchar(100) NOT NULL,
  `achievement` varchar(255) DEFAULT NULL,
  `lifted_weight` text DEFAULT NULL,
  `date` date NOT NULL,
  `lifted_reps` int(100) NOT NULL,
  `w_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_records`
--

INSERT INTO `event_records` (`er_id`, `day_of_week`, `event_name`, `achievement`, `lifted_weight`, `date`, `lifted_reps`, `w_name`) VALUES
(1, 'Monday', 'BPA', 'dsffgh', '165', '0000-00-00', 1, 'Deadlift'),
(2, 'Wednesday', 'IUPC', 'gold medalist', '100', '0000-00-00', 1, 'squat'),
(3, 'Wednesday', 'BPA2', 'too heavy', '80', '0000-00-00', 3, 'bench press');

-- --------------------------------------------------------

--
-- Table structure for table `personal_records`
--

CREATE TABLE `personal_records` (
  `pr_id` int(11) NOT NULL,
  `exercise_name` varchar(100) NOT NULL,
  `max_weight_kg` decimal(6,2) DEFAULT 0.00,
  `record_date` int(11) DEFAULT 1,
  `W_note` varchar(100) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_records`
--

INSERT INTO `personal_records` (`pr_id`, `exercise_name`, `max_weight_kg`, `record_date`, `W_note`, `day_of_week`) VALUES
(2, 'Deadlift', 165.00, 17, 'gdgs', 'Monday'),
(3, 'bench press', 80.00, 17, '3 reps higher', 'Monday');

-- --------------------------------------------------------

--
-- Table structure for table `pr_goals`
--

CREATE TABLE `pr_goals` (
  `prg_id` int(11) NOT NULL,
  `exercise_name` varchar(100) NOT NULL,
  `target_weight_kg` decimal(6,2) DEFAULT 0.00,
  `target_reps` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('Pending','Achieved') DEFAULT 'Pending',
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pr_goals`
--

INSERT INTO `pr_goals` (`prg_id`, `exercise_name`, `target_weight_kg`, `target_reps`, `deadline`, `status`, `day_of_week`) VALUES
(1, 'bench press', 52.00, 2, '0000-00-00', '', 'Monday'),
(2, 'squat', 110.00, 1, '0000-00-00', '', 'Thursday');

-- --------------------------------------------------------

--
-- Table structure for table `signup_users`
--

CREATE TABLE `signup_users` (
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT 'Other',
  `dob` date NOT NULL,
  `height_cm` float NOT NULL,
  `weight_kg` float NOT NULL,
  `fitness_goal` enum('Weight Loss','Muscle Gain','Strength Training','General Fitness') NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup_users`
--

INSERT INTO `signup_users` (`username`, `full_name`, `email`, `passwords`, `gender`, `dob`, `height_cm`, `weight_kg`, `fitness_goal`, `u_id`) VALUES
('A', 'SPPA', 'bro28835@gmail.com', ' $2y$10$a/Q2gNsJt9EKvpu.SEgvMed4PCLrBJbgSD28WFrqoZr1FUUZbh3xW', 'Male', '2003-01-01', 163, 73, 'Muscle Gain', 6);

-- --------------------------------------------------------

--
-- Table structure for table `workout_schedule`
--

CREATE TABLE `workout_schedule` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 1,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `workout_type` varchar(100) NOT NULL,
  `workout_time` varchar(11) NOT NULL,
  `W_note` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_schedule`
--

INSERT INTO `workout_schedule` (`id`, `user_id`, `day_of_week`, `workout_type`, `workout_time`, `W_note`, `created_at`) VALUES
(10, 1, 'Tuesday', 'chest', '19:15', 'cable fly', '2025-11-13 13:15:27'),
(11, 1, 'Wednesday', 'back', '18:00', 'lat pull down', '2025-11-13 15:05:14'),
(12, 1, 'Thursday', 'leg', '16:00', 'asdfg', '2025-11-18 12:03:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_records`
--
ALTER TABLE `event_records`
  ADD PRIMARY KEY (`er_id`);

--
-- Indexes for table `personal_records`
--
ALTER TABLE `personal_records`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `pr_goals`
--
ALTER TABLE `pr_goals`
  ADD PRIMARY KEY (`prg_id`);

--
-- Indexes for table `signup_users`
--
ALTER TABLE `signup_users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workout_schedule`
--
ALTER TABLE `workout_schedule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_records`
--
ALTER TABLE `event_records`
  MODIFY `er_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_records`
--
ALTER TABLE `personal_records`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pr_goals`
--
ALTER TABLE `pr_goals`
  MODIFY `prg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `signup_users`
--
ALTER TABLE `signup_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `workout_schedule`
--
ALTER TABLE `workout_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
