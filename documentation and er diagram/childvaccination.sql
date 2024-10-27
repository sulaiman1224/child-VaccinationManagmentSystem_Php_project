-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql113.byetcluster.com
-- Generation Time: Oct 27, 2024 at 05:52 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37588909_childvaccination`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_hospital`
--

CREATE TABLE `add_hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `hospital_location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_hospital`
--

INSERT INTO `add_hospital` (`id`, `name`, `hospital_location`) VALUES
(37, 'Civil Hospital ', 'Baba-e-Urdu Road, Karachi.'),
(40, 'Sindh Govt. Hospital Liaquatabad', 'Liaquatabad, Karachi'),
(42, 'Sindh Govt. Hospital New Karachi ', 'New Karachi.'),
(43, 'Sindh Govt. Qatar Hospital', 'Orangi Town, Karachi.'),
(50, 'NICVD', 'Shoukat Khanum M Hospital'),
(52, 'A.O Clinic', 'Nazimabad No.7, Karachi.'),
(53, 'Aga Khan Maternity Home Karimabad', 'Karimabad, F. B Area, Karachi'),
(54, 'Aga Khan Maternity Home Kharadar', 'Kharadar, Karachi.'),
(55, 'Akhtar Eye Hospital ', 'Gulshan-e Iqbal, Karachi.'),
(56, 'Al-Ain Eye Hospital', 'P.E.C.H.S. Karachi.');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(5, 'Sulaiman', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `status` enum('pending','booked','canceled','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `request_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 6, 'booked', '2024-09-22 17:55:10', '2024-09-22 17:57:56'),
(13, 7, 'booked', '2024-09-24 08:18:15', '2024-09-24 08:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `date_of_birth` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gender` enum('male','female','other') NOT NULL,
  `weight_kg` int(11) NOT NULL,
  `height_cm` int(11) NOT NULL,
  `blood_group` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `parent_id`, `child_name`, `age`, `date_of_birth`, `gender`, `weight_kg`, `height_cm`, `blood_group`, `created_at`, `updated_at`) VALUES
(47, 106, 'ali', 14, '2024-09-17 00:00:00', 'female', 16, 135, 'O+ve', '2024-09-22 17:54:01', '2024-09-22 17:54:01'),
(48, 106, 'sami', 12, '2024-10-03 00:00:00', 'male', 24, 30, 'B+ve', '2024-09-24 08:16:34', '2024-09-24 08:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile_number` varchar(250) NOT NULL,
  `parent_hospital` varchar(250) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile_number` int(15) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `add_hospital_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `email`, `password`, `mobile_number`, `pincode`, `address`, `add_hospital_id`, `status`) VALUES
(9, 'CivilHospital@gmail.com', 'CIVILh1!', 2147483647, '1243241', 'ear Civil Hospital Masjid, New Labour Colony Nanakwara, Karachi', 37, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `parent_name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `parent_name`, `email`, `password`, `mobile_number`, `gender`) VALUES
(106, 'Sulaiman', 'sulaiman122436480@gmail.com', 'SKBALo1!', '1234567890', 'male'),
(107, 'Sulaiman', 'sulaiman123@gmail.com', 'SKBALoc!', '03427947313', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `doctor_name` varchar(50) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` enum('pending','approved','rejected','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `parent_id`, `hospital_id`, `child_id`, `vaccine_id`, `doctor_name`, `appointment_date`, `status`, `created_at`, `updated_at`) VALUES
(6, 106, 9, 47, 11, 'ahmad', '2024-09-25 23:55:00', 'approved', '2024-09-22 17:54:39', '2024-09-22 17:55:10'),
(7, 106, 9, 48, 11, 'ahmad', '2024-09-12 13:19:00', 'approved', '2024-09-24 08:17:08', '2024-09-24 08:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_reminders`
--

CREATE TABLE `vaccination_reminders` (
  `id` int(11) NOT NULL,
  `report_id` int(11) DEFAULT NULL,
  `reminder_date` date NOT NULL,
  `status` enum('Pending','Sent','Failed','Acknowledged') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination_reminders`
--

INSERT INTO `vaccination_reminders` (`id`, `report_id`, `reminder_date`, `status`) VALUES
(8, 11, '0000-00-00', 'Sent'),
(9, 12, '0000-00-00', 'Sent');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_reports`
--

CREATE TABLE `vaccination_reports` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `vaccination_date` datetime DEFAULT NULL,
  `status` enum('vaccinated','not vaccinated') DEFAULT 'not vaccinated',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination_reports`
--

INSERT INTO `vaccination_reports` (`id`, `booking_id`, `vaccination_date`, `status`, `created_at`, `updated_at`) VALUES
(11, 12, '2003-06-06 00:00:00', 'vaccinated', '2024-09-22 17:55:55', '2024-09-22 17:58:36'),
(12, 13, '1970-01-13 00:00:00', 'vaccinated', '2024-09-24 08:18:34', '2024-09-24 08:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` int(11) NOT NULL,
  `availability` varchar(50) NOT NULL,
  `upcoming_date` date DEFAULT NULL,
  `vaccines_name` varchar(255) NOT NULL,
  `descreption` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `availability`, `upcoming_date`, `vaccines_name`, `descreption`, `created_at`, `updated_at`) VALUES
(11, 'available', '0000-00-00', 'Influenza (flu)', '', '2024-09-22 09:46:58', '2024-09-22 10:06:06'),
(12, 'not available', '0000-00-00', 'Varicella (chickenpox)', '', '2024-09-22 09:58:53', '2024-09-22 10:06:30'),
(13, 'available', '0000-00-00', 'Rotavirus (RV)', '', '2024-09-22 10:04:07', '2024-09-22 10:04:07'),
(14, 'available', '0000-00-00', 'Hepatitis A (HepA)', '', '2024-09-22 10:04:31', '2024-09-22 10:04:31'),
(15, 'available', '0000-00-00', 'Meningococcal B (MenB)', '', '2024-09-22 10:04:44', '2024-09-22 10:04:44'),
(16, 'not available', '0000-00-00', 'Typhoid', '', '2024-09-22 10:04:54', '2024-09-22 10:04:54'),
(17, 'not available', '0000-00-00', 'Japanese Encephalitis (JE)', '', '2024-09-22 10:05:06', '2024-09-22 10:05:06'),
(18, 'available', '0000-00-00', 'Tuberculosis (BCG)', '', '2024-09-22 10:05:20', '2024-09-22 10:05:20'),
(19, 'not available', '0000-00-00', 'Shingles (varicella-zoster)', '', '2024-09-22 10:05:43', '2024-09-22 10:05:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_hospital`
--
ALTER TABLE `add_hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `add_hospital_id` (`add_hospital_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `vaccine_id` (`vaccine_id`);

--
-- Indexes for table `vaccination_reminders`
--
ALTER TABLE `vaccination_reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`);

--
-- Indexes for table `vaccination_reports`
--
ALTER TABLE `vaccination_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccination_reports_ibfk_2` (`booking_id`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_hospital`
--
ALTER TABLE `add_hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vaccination_reminders`
--
ALTER TABLE `vaccination_reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vaccination_reports`
--
ALTER TABLE `vaccination_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `add_hospital_id` FOREIGN KEY (`add_hospital_id`) REFERENCES `add_hospital` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_ibfk_4` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vaccination_reminders`
--
ALTER TABLE `vaccination_reminders`
  ADD CONSTRAINT `vaccination_reminders_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `vaccination_reports` (`id`);

--
-- Constraints for table `vaccination_reports`
--
ALTER TABLE `vaccination_reports`
  ADD CONSTRAINT `vaccination_reports_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
