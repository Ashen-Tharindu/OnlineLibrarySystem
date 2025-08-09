-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 09, 2025 at 02:39 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `available` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `category`, `available`) VALUES
(1, '1984', 'George Orwell', 'Dystopian', 1),
(2, 'To Kill a Mockingbird', 'Harper Lee', 'Classic', 1),
(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Classic', 1),
(4, 'The Catcher in the Rye', 'J.D. Salinger', 'Classic', 1),
(5, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Fantasy', 1),
(6, 'The Hobbit', 'J.R.R. Tolkien', 'Fantasy', 1),
(7, 'Pride and Prejudice', 'Jane Austen', 'Romance', 1),
(8, 'The Da Vinci Code', 'Dan Brown', 'Thriller', 1),
(9, 'The Alchemist', 'Paulo Coelho', 'Adventure', 1),
(10, 'Moby Dick', 'Herman Melville', 'Adventure', 1),
(12, 'dfsdf', 'dfdf', 'dfdsfs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_records`
--

DROP TABLE IF EXISTS `borrow_records`;
CREATE TABLE IF NOT EXISTS `borrow_records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `borrow_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned') DEFAULT 'borrowed',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `borrow_records`
--

INSERT INTO `borrow_records` (`id`, `user_id`, `book_id`, `borrow_date`, `return_date`, `status`) VALUES
(1, 3, 1, '2025-07-01', '2025-07-10', 'returned'),
(2, 3, 5, '2025-07-15', NULL, 'borrowed'),
(3, 4, 2, '2025-07-05', '2025-07-20', 'returned'),
(4, 5, 7, '2025-07-10', NULL, 'borrowed'),
(5, 5, 3, '2025-07-12', '2025-07-25', 'returned'),
(6, 11, 1, '2025-08-09', '2025-08-09', 'returned'),
(7, 11, 2, '2025-08-09', '2025-08-09', 'returned'),
(8, 11, 1, '2025-08-09', '2025-08-09', 'returned'),
(9, 11, 5, '2025-08-09', '2025-08-09', 'returned'),
(10, 11, 7, '2025-08-09', NULL, 'borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(10, 'Admin', 'admin@library.com', '$2y$10$PFv5maBDSbEq/V0pKeSMs.Tm6nAiCzeSK/4WxlZvhKOHxLm3uCYZC', 'admin'),
(11, 'jon', 'jon@gmail.com', '$2y$10$k6fSD5aPjZTJEorkA1Xn.e4ayaCq.bnsRp72gB125T27GcWxPjajO', 'user'),
(12, 'fdfs', 'dfsdfd@gmail.com', '$2y$10$WodW5TsxQhhbmoWtOo.6DOYFDZErKEaXu.FHfcS8U/uZsJ5GG/PJ.', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
