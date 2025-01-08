-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 12:22 AM
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
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `email`, `password`, `phone_number`) VALUES
(1, 'doctor', 'doctor@gmail.com', '$2y$10$CpSurqHsY.s.mbF9jj3BaeEAzC/Iq4RmJPBSH1MlMXNTgE4bSVRbW', '0592741480');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dosage` double DEFAULT NULL,
  `productionDate` date DEFAULT NULL,
  `expiryDate` date DEFAULT NULL,
  `pharmacists_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `dosage`, `productionDate`, `expiryDate`, `pharmacists_id`) VALUES
(1, 'Dexamol', 12.5, '2024-12-01', '2025-01-15', 1),
(2, 'Banadol', 14.5, '2024-12-08', '2025-01-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patientdoctor`
--

CREATE TABLE `patientdoctor` (
  `pat_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientdoctor`
--

INSERT INTO `patientdoctor` (`pat_id`, `doc_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patientdrug`
--

CREATE TABLE `patientdrug` (
  `pat_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientdrug`
--

INSERT INTO `patientdrug` (`pat_id`, `drug_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `problem` text DEFAULT NULL,
  `entranceDate` date DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `email`, `password`, `age`, `gender`, `problem`, `entranceDate`, `phoneNumber`) VALUES
(1, 'patient', 'patient@gmail.com', '$2y$10$T4RculAWErhPCmgaxoKI4efXrTi9b2tpyvlMECid7SReekRNPs9ia', 21, 'Male', 'Provident assumenda test.....', '2024-12-10', '+1 (972) 834-69');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`id`, `name`, `email`, `password`, `phone_number`) VALUES
(1, 'pharm', 'pharm@gmail.com', '$2y$10$m/DmcN.IDDt/mqnhH3NzculhuNegsLjNUZW1ws8vhSr3nOmmqqq2m', '0592741486');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `type`) VALUES
('doctor@gmail.com', '$2y$10$CpSurqHsY.s.mbF9jj3BaeEAzC/Iq4RmJPBSH1MlMXNTgE4bSVRbW', 'Doctor'),
('patient@gmail.com', '$2y$10$T4RculAWErhPCmgaxoKI4efXrTi9b2tpyvlMECid7SReekRNPs9ia', 'patient'),
('pharm@gmail.com', '$2y$10$m/DmcN.IDDt/mqnhH3NzculhuNegsLjNUZW1ws8vhSr3nOmmqqq2m', 'pharmaceutical');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pharmacists_id` (`pharmacists_id`);

--
-- Indexes for table `patientdoctor`
--
ALTER TABLE `patientdoctor`
  ADD PRIMARY KEY (`pat_id`,`doc_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `patientdrug`
--
ALTER TABLE `patientdrug`
  ADD PRIMARY KEY (`pat_id`,`drug_id`),
  ADD KEY `patientdrug_ibfk_2` (`drug_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `fk_pharmacists_id` FOREIGN KEY (`pharmacists_id`) REFERENCES `pharmacists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patientdoctor`
--
ALTER TABLE `patientdoctor`
  ADD CONSTRAINT `patientdoctor_ibfk_1` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patientdoctor_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `patientdrug`
--
ALTER TABLE `patientdrug`
  ADD CONSTRAINT `patientdrug_ibfk_1` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patientdrug_ibfk_2` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD CONSTRAINT `fk_pharmacists_email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
