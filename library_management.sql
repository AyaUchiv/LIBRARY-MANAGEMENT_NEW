-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 01:15 PM
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
-- Database: `library_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookId` int(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `author` varchar(150) NOT NULL,
  `edition` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `quantity` varchar(150) NOT NULL,
  `genre` varchar(150) NOT NULL,
  `quantity_available` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookId`, `name`, `author`, `edition`, `status`, `quantity`, `genre`, `quantity_available`) VALUES
(1, 'A Court of Thorns and Roses', 'Sarah J. Maas', '1st', 'Available', '10', 'Fiction', 6),
(2, 'The Cruel Prince', 'Holly Black', '1st', 'Available', '10', 'Fiction', 10),
(3, 'The Things We Leave Unfinished', 'Rebecca Yarros', '1st', 'Available', '9', 'Fiction', 9),
(4, 'Atomic Habits 4', 'James Clear', '2nd', 'available', '10', 'Non-Fiction', 7),
(5, 'Start with Why', 'Simon Sinek', '1st', 'Available', '9', 'Non-Fiction', 8),
(6, 'Awaken the Giant Within 2', 'Tony Robbins', '1st', 'available', '3', 'Non-Fiction', 3),
(7, 'HTML & CSS: Design and Build Websites', 'Jon Duckett', '1st', 'Available', '4', 'Education', 4),
(8, 'PHP & MySQL: Novice to Ninja', 'Tom Butler', '1st', 'Available', '3', 'Education', 3),
(9, 'Learning PHP, MySQL & JavaScript', 'Robin Nixon', '1st', 'Available', '2', 'Education', 2),
(10, 'The Night Circus', 'Erin Morgenstern', '1st', 'Available', '10', 'Fiction', 10),
(11, 'The Wicked King', 'Holly Black', '1st', 'Available', '9', 'Fiction', 9),
(12, 'The Last Letter from Your Lover', 'Jojo Moyes', '1st', 'Available', '8', 'Fiction', 8),
(13, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', '1st', 'Available', '7', 'Non-Fiction', 7),
(14, 'Educated: A Memoir', 'Tara Westover', '1st', 'Available', '6', 'Non-Fiction', 6),
(15, 'Becoming', 'Michelle Obama', '1st', 'available', '9', 'Non-Fiction', 7),
(16, 'The Subtle Art of Not Giving a F*ck', 'Mark Manson', '1st', 'Available', '4', 'Non-Fiction', 4),
(17, 'The Power of Now', 'Eckhart Tolle', '1st', 'Available', '3', 'Non-Fiction', 3),
(18, 'Mindset: The New Psychology of Success', 'Carol S. Dweck', '1st', 'Available', '2', 'Non-Fiction', 2),
(19, 'The Silent Patient', 'Alex Michaelides', '1st', 'Available', '10', 'Fiction', 10),
(20, 'The Queen of Nothing', 'Holly Black', '1st', 'Available', '9', 'Fiction', 9),
(21, 'The Gilded Wolves', 'Roshani Chokshi', '1st', 'Available', '8', 'Fiction', 8),
(22, 'Outliers: The Story of Success', 'Malcolm Gladwell', '1st', 'Available', '7', 'Non-Fiction', 7),
(23, 'Blink: The Power of Thinking Without Thinking', 'Malcolm Gladwell', '1st', 'Available', '3', 'Non-Fiction', 2),
(24, 'Thinking, Fast and Slow', 'Daniel Kahneman', '1st', 'Available', '5', 'Non-Fiction', 5),
(25, 'Quiet: The Power of Introverts in a World That Can\'t Stop Talking', 'Susan Cain', '1st', 'Available', '4', 'Non-Fiction', 4),
(26, 'The 5 AM Club', 'Robin Sharma', '1st', 'Available', '3', 'Non-Fiction', 3),
(27, 'Dare to Lead', 'Brené Brown', '1st', 'Available', '2', 'Non-Fiction', 2),
(28, 'The Great Gatsby', 'F. Scott Fitzgerald', '1st', 'Available', '10', 'Fiction', 10),
(29, 'To Kill a Mockingbird', 'Harper Lee', '1st', 'Available', '9', 'Fiction', 9),
(30, '1984', 'George Orwell', '1st', 'available', '9', 'Fiction', 8),
(31, 'Moby-Dick', 'Herman Melville', '1st', 'Available', '7', 'Fiction', 7),
(32, 'War and Peace', 'Leo Tolstoy', '1st', 'Available', '6', 'Fiction', 6),
(33, 'Pride and Prejudice', 'Jane Austen', '1st', 'Available', '5', 'Fiction', 5),
(34, 'The Catcher in the Rye', 'J.D. Salinger', '1st', 'Available', '4', 'Fiction', 4),
(35, 'The Hobbit', 'J.R.R. Tolkien', '1st', 'Available', '3', 'Fiction', 3),
(36, 'The Lord of the Rings', 'J.R.R. Tolkien', '1st', 'Available', '2', 'Fiction', 2),
(37, 'The Chronicles of Narnia', 'C.S. Lewis', '1st', 'Available', '1', 'Fiction', 0),
(38, 'The Lean Startup', 'Eric Ries', '1st', 'Available', '10', 'Non-Fiction', 10),
(39, 'The Hard Thing About Hard Things', 'Ben Horowitz', '1st', 'Available', '9', 'Non-Fiction', 9),
(40, 'Zero to One', 'Peter Thiel', '1st', 'Available', '8', 'Non-Fiction', 7),
(41, 'The Art of War', 'Sun Tzu', '1st', 'Available', '7', 'Non-Fiction', 7),
(42, 'The Prince', 'Niccolò Machiavelli', '1st', 'Available', '6', 'Non-Fiction', 6),
(43, 'Principles: Life and Work', 'Ray Dalio', '1st', 'Available', '5', 'Non-Fiction', 5),
(44, 'The Innovator\'s Dilemma', 'Clayton Christensen', '1st', 'Available', '4', 'Non-Fiction', 4),
(45, 'The Myth of the Strong Leader', 'Archie Brown', '1st', 'Available', '3', 'Non-Fiction', 3),
(46, 'The Wisdom of Insecurity', 'Alan Watts', '1st', 'Available', '2', 'Non-Fiction', 2),
(47, 'The Art of Happiness', 'Dalai Lama', '1st', 'Available', '6', 'Non-Fiction', 5),
(48, 'HTML, CSS, and PHP Beginner Basics', 'Janaka Senanayake', '1 edition', 'available', '4', 'Education', 4),
(49, 'Learning Python', 'Mark Lutz', '5th', 'Available', '9', 'Education', 9),
(50, 'Eloquent JavaScript', 'Marijn Haverbeke', '3rd', 'Available', '8', 'Education', 8),
(51, 'Clean Code: A Handbook of Agile Software Craftsmanship', 'Robert C. Martin', '1st', 'Available', '7', 'Education', 5),
(52, 'The Pragmatic Programmer: Your Journey to Mastery', 'Andrew Hunt', '2nd', 'Available', '7', 'Education', 7),
(53, 'You Don\'t Know JS (book series)', 'Kyle Simpson', '1st', 'Available', '6', 'Education', 6),
(54, 'JavaScript: The Good Parts', 'Douglas Crockford', '1st', 'Available', '5', 'Education', 5),
(55, 'Head First Java', 'Kathy Sierra', '2nd', 'Available', '4', 'Education', 4),
(56, 'Python Crash Course', 'Eric Matthes', '2nd', 'Available', '3', 'Education', 3),
(57, 'CSS Secrets: Better Solutions to Everyday Web Design Problems', 'Lea Verou', '1st', 'Available', '2', 'Education', 2),
(58, 'Learning React: Functional Web Development with React and Redux', 'Alex Banks', '1st', 'Available', '8', 'Education', 8),
(59, 'Your Super Power NO!', 'Chadwick Conners', '1', 'available', '7', 'Non-Fiction', 7),
(60, 'Happy Place', 'Happy Freeman', '8th edition', 'available', '4', 'Non-Fiction', 4),
(61, 'silk and steel', 'Cordia Byers', '1st', 'available', '5', 'Fiction', 4),
(67, 'Book 15', 'Author 15', '5 edition', 'available', '5', 'Fiction', 5),
(68, 'Book 13', 'Author 13', '5 edition', '', '6', 'Education', 6),
(69, 'Book 12', 'Author 12', '5 edition', '', '8', 'Education', 8),
(71, 'Book 15', 'Author 15', '4th edition', '', '7', 'Education', 7),
(73, 'Book 1', 'Author 1', '2 edition', '', '3', 'Non-Fiction', 3),
(75, 'Book 2', 'Author 2', '5 edition', '', '3', 'Non-Fiction', 3),
(77, 'Book 5', 'Author 5', '2 edition', '', '5', 'Education', 5),
(78, 'Book 20', 'Author 20', '20 edition', '', '5', 'Education', 5),
(79, 'Book 20', 'Author 20', '5 edition', '', '3', 'Non-Fiction', 3),
(80, 'Book 50', 'Author 50', '50 edition', '', '8', 'Non-Fiction', 8),
(81, 'Book 50', 'Author 50', '5 edition', '', '8', 'Non-Fiction', 8);

-- --------------------------------------------------------

--
-- Table structure for table `book_request`
--

CREATE TABLE `book_request` (
  `request_id` int(150) NOT NULL,
  `bookId` int(150) NOT NULL,
  `issue_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `book_penalty` int(225) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_request`
--

INSERT INTO `book_request` (`request_id`, `bookId`, `issue_date`, `return_date`, `book_penalty`, `UserID`) VALUES
(5, 1, '2025-04-15 15:35:18', '2025-04-22 15:35:18', 0, 9),
(8, 1, '2025-02-02 02:48:34', '2025-02-09 02:48:34', 22, 15),
(9, 4, '2025-04-16 02:48:36', '2025-04-23 02:48:36', 0, 15),
(10, 5, '2025-04-16 07:55:34', '2025-04-23 07:55:34', 0, 17),
(11, 61, '2025-04-16 07:56:04', '2025-04-23 07:56:04', 0, 17),
(20, 37, '2025-04-16 09:23:26', '2025-04-23 09:23:26', 0, 19),
(21, 4, '2025-04-16 09:23:37', '2025-04-23 09:23:37', 0, 19),
(22, 1, '2025-04-16 09:27:56', '2025-04-23 09:27:56', 0, 20),
(23, 47, '2025-04-16 09:28:10', '2025-04-23 09:28:10', 0, 20),
(25, 51, '2025-04-16 09:28:53', '2025-04-23 09:28:53', 0, 20),
(27, 40, '2025-04-16 10:00:57', '2025-04-23 10:00:57', 0, 21),
(28, 30, '2025-04-16 10:01:06', '2025-04-23 10:01:06', 0, 21),
(29, 4, '2025-04-16 10:01:26', '2025-04-23 10:01:26', 0, 21),
(33, 15, '2025-04-16 10:22:18', '2025-04-23 10:22:18', 0, 22),
(34, 1, '2025-04-16 10:22:20', '2025-04-23 10:22:20', 0, 22),
(36, 23, '2025-04-16 10:39:52', '2025-04-23 10:39:52', 0, 23),
(37, 15, '2025-04-16 10:40:00', '2025-04-23 10:40:00', 0, 23),
(38, 51, '2025-04-16 10:40:24', '2025-04-23 10:40:24', 0, 23);

-- --------------------------------------------------------

--
-- Table structure for table `owing_users`
--

CREATE TABLE `owing_users` (
  `owing_id` int(100) NOT NULL,
  `request_id` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `book_penalty` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owing_users`
--

INSERT INTO `owing_users` (`owing_id`, `request_id`, `book_title`, `email`, `name`, `book_penalty`) VALUES
(1, 0, '1984', 'user1@gmail.com', 'user1', 22),
(2, 0, 'A Court of Thorns and Roses', 'user22@gmail.com', 'user20', 22),
(3, 0, '1984', 'user51@gmail.com', 'user51', 6),
(4, 0, 'The Great Gatsby', 'user9000@gmail.com', 'user9000', 14);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `date_joined` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `IsAdmin` int(11) DEFAULT 0,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Name`, `Email`, `Password`, `date_joined`, `IsAdmin`, `UserID`) VALUES
('super_admin1', 'superadmin1@gmail.com', '$2y$10$HR12Q3kUrQOsBl5B4zF6cOAepieEBPmfQkS95uwrEJYSVV.gpc57y', '2025-04-16 02:09:52.225686', 1, 8),
('user1', 'user1@gmail.com', '$2y$10$5ruB8sRk1XFH4vCr2gPZouCyvSPkhLolKkNg2kFFUX0yrT55G0CUK', '2025-04-16 07:11:38.648671', 0, 9),
('user20', 'user22@gmail.com', '$2y$10$v1xsbpbGZXbqsLa5jqZJ8O6KIRfQIXcxesyNh0OfBaqLD/uhUmlRG', '2025-04-16 01:59:22.616735', 0, 15),
('user6', 'user6@gmail.com', '$2y$10$6.RbeduXtB.fpQjGrC5/wOnHT/pAPEB5MUS.ajz5JGwIyNUh/q9kW', '2025-04-16 02:01:00.751876', 0, 16),
('user30', 'user30@gmail.com', '$2y$10$6PR3cmLyu3KvGb84CAOB4eEFqeVIxWhvEfA.MA5mb4r5LASZ2MRYS', '2025-04-16 06:58:29.777354', 0, 17),
('user51', 'user51@gmail.com', '$2y$10$/vxeh/yyEb.yfIfbR/icBeD.TFkKxaPaCaPI1LeF.9dagoysaytoe', '2025-04-16 07:51:00.129041', 0, 18),
('user100', 'user100@gmail.com', '$2y$10$t0ifGQTNsHRqN5o09Wyyc.iz354/35FH3h33qIey.x9L.k5JBi7JK', '2025-04-16 08:22:11.246130', 0, 19),
('user300', 'user300@gmail.com', '$2y$10$0Gi7a.i3jxC.pdAYCJsmSemTYvOg3mHwsti4ETi5JvLmsUVCAGmE2', '2025-04-16 08:35:58.854839', 1, 20),
('user500', 'user500@gmail.com', '$2y$10$0Zxz.LdNv7Kc9hCB1ri/GOpAJR3unnln3BaBFzH4XFRgGHoNz0J8G', '2025-04-16 09:02:44.174144', 0, 21),
('user3000', 'user3000@gmail.com', '$2y$10$P0ozu7UV5HxS77bWyvo3XuqzO69BoNaH/vDt2Ga7EtK8/qhptYPDq', '2025-04-16 09:23:22.811853', 0, 22),
('user8000', 'user8000@gmail.com', '$2y$10$sTuCKZGQyPEfZzTelf5slOFVDCU.3E3a6lLWk.Kw196fCMbgwCwTy', '2025-04-16 09:41:08.964763', 0, 23),
('user9000', 'user9000@gmail.com', '$2y$10$/LUlxG.ELR/BPRKB/Ss8cuLPae4kR0a3lEcip6QbUX830/qQ4zTGq', '2025-04-16 09:57:06.777931', 0, 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookId`);

--
-- Indexes for table `book_request`
--
ALTER TABLE `book_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `bookId` (`bookId`),
  ADD KEY `fk_book_user` (`UserID`);

--
-- Indexes for table `owing_users`
--
ALTER TABLE `owing_users`
  ADD PRIMARY KEY (`owing_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookId` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `book_request`
--
ALTER TABLE `book_request`
  MODIFY `request_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `owing_users`
--
ALTER TABLE `owing_users`
  MODIFY `owing_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_request`
--
ALTER TABLE `book_request`
  ADD CONSTRAINT `book_request_ibfk_1` FOREIGN KEY (`bookId`) REFERENCES `book` (`bookId`),
  ADD CONSTRAINT `fk_book_user` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
