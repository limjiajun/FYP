-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2024-12-19 16:05:48
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `jiajunco_cmd_db2`
--

-- --------------------------------------------------------

--
-- 表的结构 `area`
--

CREATE TABLE `area` (
  `Area_id` int(100) NOT NULL,
  `Block_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `area`
--

INSERT INTO `area` (`Area_id`, `Block_id`, `Status`, `unit`) VALUES
(1, '1', 'unavailable', 'A1'),
(2, '1', 'unavailable', 'A2'),
(3, '1', 'unavailable', 'A3'),
(4, '1', 'unavailable', 'A4'),
(5, '1', 'unavailable', 'A5'),
(6, '1', 'unavailable', 'A6'),
(7, '1', 'unavailable', 'A7'),
(8, '1', 'unavailable', 'A8'),
(9, '1', 'unavailable', 'A9'),
(10, '1', 'unavailable', 'A10'),
(11, '1', 'unavailable', 'A11'),
(12, '1', 'unavailable', 'A12'),
(13, '1', 'unavailable', 'A13'),
(14, '1', 'unavailable', 'A14'),
(15, '1', 'unavailable', 'A15'),
(16, '1', 'unavailable', 'A16'),
(17, '1', 'unavailable', 'A17'),
(18, '1', 'unavailable', 'A18'),
(19, '1', 'unavailable', 'A19'),
(20, '1', 'unavailable', 'A20'),
(21, '1', 'unavailable', 'A21'),
(22, '1', 'unavailable', 'A22'),
(23, '1', 'unavailable', 'A23'),
(24, '1', 'unavailable', 'A24'),
(25, '1', 'unavailable', 'A25'),
(26, '2', 'unavailable', 'B1'),
(27, '2', 'unavailable', 'B2'),
(28, '2', 'unavailable', 'B3'),
(29, '2', 'unavailable', 'B4'),
(30, '2', 'unavailable', 'B5'),
(31, '2', 'unavailable', 'B6'),
(32, '2', 'unavailable', 'B7'),
(33, '2', 'unavailable', 'B8'),
(34, '2', 'unavailable', 'B9'),
(35, '2', 'unavailable', 'B10'),
(36, '2', 'unavailable', 'B11'),
(37, '2', 'unavailable', 'B12'),
(38, '2', 'unavailable', 'B13'),
(39, '2', 'unavailable', 'B14'),
(40, '2', 'unavailable', 'B15'),
(41, '2', 'unavailable', 'B16'),
(42, '2', 'unavailable', 'B17'),
(43, '2', 'unavailable', 'B18'),
(44, '2', 'unavailable', 'B19'),
(45, '2', 'unavailable', 'B20'),
(46, '2', 'Available', 'B21'),
(47, '2', 'Available', 'B22'),
(48, '2', 'Available', 'B23'),
(49, '2', 'Available', 'B24'),
(50, '2', 'unavailable', 'B25'),
(51, '3', 'unavailable', 'C1'),
(52, '3', 'unavailable', 'C2'),
(53, '3', 'unavailable', 'C3'),
(54, '3', 'unavailable', 'C4'),
(55, '3', 'unavailable', 'C5'),
(56, '3', 'unavailable', 'C6'),
(57, '3', 'unavailable', 'C7'),
(58, '3', 'unavailable', 'C8'),
(59, '3', 'unavailable', 'C9'),
(60, '3', 'unavailable', 'C10'),
(61, '3', 'unavailable', 'C11'),
(62, '3', 'unavailable', 'C12'),
(63, '3', 'unavailable', 'C13'),
(64, '3', 'unavailable', 'C14'),
(65, '3', 'unavailable', 'C15'),
(66, '3', 'unavailable', 'C16'),
(67, '3', 'unavailable', 'C17'),
(68, '3', 'unavailable', 'C18'),
(69, '3', 'unavailable', 'C19'),
(70, '3', 'unavailable', 'C20'),
(71, '3', 'Available', 'C21'),
(72, '3', 'Available', 'C22'),
(73, '3', 'Available', 'C23'),
(74, '3', 'Available', 'C24'),
(75, '3', 'Available', 'C25'),
(76, '4', 'unavailable', 'D1'),
(77, '4', 'unavailable', 'D2'),
(78, '4', 'unavailable', 'D3'),
(79, '4', 'unavailable', 'D4'),
(80, '4', 'unavailable', 'D5'),
(81, '4', 'unavailable', 'D6'),
(82, '4', 'unavailable', 'D7'),
(83, '4', 'unavailable', 'D8'),
(84, '4', 'unavailable', 'D9'),
(85, '4', 'unavailable', 'D10'),
(86, '4', 'unavailable', 'D11'),
(87, '4', 'unavailable', 'D12'),
(88, '4', 'unavailable', 'D13'),
(89, '4', 'unavailable', 'D14'),
(90, '4', 'Available', 'D15'),
(91, '4', 'unavailable', 'D16'),
(92, '4', 'unavailable', 'D17'),
(93, '4', 'unavailable', 'D18'),
(94, '4', 'unavailable', 'D19'),
(95, '4', 'unavailable', 'D20'),
(96, '4', 'Available', 'D21'),
(97, '4', 'Available', 'D22'),
(98, '4', 'Available', 'D23'),
(99, '4', 'Available', 'D24'),
(100, '4', 'unavailable', 'D25');

-- --------------------------------------------------------

--
-- 表的结构 `block`
--

CREATE TABLE `block` (
  `Block_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Block_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `block`
--

INSERT INTO `block` (`Block_id`, `Block_name`) VALUES
('1', 'A'),
('2', 'B'),
('3', 'C'),
('4', 'D'),
('5', 'E');

-- --------------------------------------------------------

--
-- 表的结构 `cemeteryrecord`
--

CREATE TABLE `cemeteryrecord` (
  `Grave_ID` int(50) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Image2` varchar(255) NOT NULL,
  `Name_Deceased` varchar(100) NOT NULL,
  `Years_of_Born` date NOT NULL,
  `Years_of_Died` date NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Years_Buried` varchar(100) NOT NULL,
  `Area_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `cemeteryrecord`
--

INSERT INTO `cemeteryrecord` (`Grave_ID`, `Image`, `Image2`, `Name_Deceased`, `Years_of_Born`, `Years_of_Died`, `Location`, `Years_Buried`, `Area_id`) VALUES
(1, '../res/cemeterys/William.jpg', '../res/persons/person_1.jpg', 'WilliamEdwardCuzners', '1865-05-27', '1893-01-11', 'Western Road Cemetery', '28', 1),
(2, '../res/cemeterys/Corp_Percy__Garfield_Reunolds_Eakin.jpg', '../res/persons/Corp_Percy_Garfield.PNG', 'Corp Percy Garfield', '1928-07-16', '1953-12-03', 'Western Road Cemetery', '25', 2),
(3, '../res/cemeterys/Ian_Alexander_Durant.jpg', '../res/persons/Ian Alexander Durant.PNG', 'Ian Alexander Durant 123', '1931-04-25', '1979-06-01', 'Western Road Cemetery', '48', 3),
(4, '../res/cemeterys/', '../res/persons/', 'William Patrick Duffy123', '1938-04-25', '1959-07-26', 'Western Road Cemetery', '21', 0),
(5, '../res/cemeterys/Vivtor_Keith_Alured_Denne.jpg', '../res/persons/VivtorKeith.png', 'Vivtor Keith ', '1915-05-10', '1920-08-01', 'Western Road Cemetery', '5', 5),
(6, '../res/cemeterys/R_I_Beer.jpg', '../res/persons/R_I_Beer.PNG', 'R_I_Beer', '1946-05-15', '1965-07-11', 'Western Road Cemetery', '19', 6),
(7, '../res/cemeterys/M_F_J_Berey.jpg', '../res/persons/L.J.Bane.PNG', 'L.J.Bane', '1970-12-15', '1996-07-01', 'Western Road Cemetery ', '26', 7),
(8, '../res/cemeterys/Alexandar.jpg', '../res/persons/Alexandar.PNG', 'Alexandar', '1921-02-01', '1950-12-02', 'Western Road Cemetery', '29', 8),
(9, '../res/cemeterys/John.jpg', '../res/persons/John.PNG', 'John', '1869-08-15', '1939-06-27', 'Western Road Cemetery', '70', 9),
(10, '../res/cemeterys/George Henry Draper.jpeg', '../res/persons/Helen Elizabeth Draper.PNG', 'George Henry Draper', '1905-04-12', '1960-12-09', 'Western Road Cemetery\r\n', '55', 10),
(11, '../res/cemeterys/Noel_H_T_Frost.jpg', '../res/persons/Noel_H_T_Frost.PNG', 'Noel_H_T_Frost', '1940-08-29', '1961-05-19', 'Western Road Cemetery', '21', 26),
(12, '../res/cemeterys/Cpl W C Byde.jpeg', '../res/persons/Cpl W C Byde.PNG', 'Cpl W C Byde', '1924-05-19', '1949-05-31', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '25', 27),
(13, '../res/cemeterys/WO F. Cain.jpg', '../res/persons/WO F. Cain.PNG', 'WO F. Cain', '1916-11-04', '1951-10-27', '\r\nWestern Road Cemetery\r\nPenang, Penang, Malaysia', '35', 28),
(14, '../res/cemeterys/Corp R. Carus.jpg', '../res/persons/Corp R. Carus.PNG', 'Corp R. Carus', '1929-05-05', '1950-12-25', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '21', 29),
(15, '../res/cemeterys/R. C. F. Cooper.jpg', '../res/persons/R. C. F. Cooper.PNG', 'R. C. F. Cooper', '1929-08-04', '1951-12-28', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '22', 30),
(16, '../res/cemeterys/Hiepke an Crommers.jpeg', '../res/persons/Hiepke Tan Crommers.PNG', 'Hiepke Tan Crommers', '1863-09-09', '1895-08-06', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '32', 31),
(17, '../res/cemeterys/Michael Vaughan Curtis.jpeg', '../res/persons/Michael Vaughan Curtis.PNG', 'Michael Vaughan Curtis', '1934-11-22', '1961-06-16', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '27', 32),
(18, '../res/cemeterys/Zuxin Dai.jpg', '../res/persons/Zuxin Dai.PNG', 'Zuxin Dai', '1986-05-08', '1989-05-22', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '3', 33),
(19, '../res/cemeterys/Joseph Dass.jpg', '../res/persons/Joseph Dass.PNG', 'Joseph Dass', '1934-01-01', '1990-09-05', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '56', 34),
(20, '../res/cemeterys/David Anthony Dass.jpg', '../res/persons/David Anthony Dass.PNG', 'David Anthony Dass', '1907-07-07', '1972-09-05', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '65', 35),
(21, '../res/cemeterys/Kenneth William Davies.jpg', '../res/persons/Kenneth William Davies.PNG', 'Kenneth William Davies', '1928-02-08', '1951-03-21', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '23', 51),
(22, '../res/cemeterys/Clement Christopher Denis.jpg', '../res/persons/Clement Christopher Denis.PNG', 'Clement Christopher Denis', '1915-07-15', '1979-12-18', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '64', 52),
(23, '../res/cemeterys/Victor Keith Alured Denne.jpg', '../res/persons/Victor Keith Alured Denne.PNG', 'Victor Keith Alured Denne', '1915-05-10', '1920-12-18', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '5', 53),
(24, '../res/cemeterys/Able Seaman John Francis Durnin.jpg', '../res/persons/Able Seaman John Francis Durnin.PNG', 'Able Seaman John Francis Durnin', '1899-12-12', '1915-10-29', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '24', 54),
(25, '../res/cemeterys/Francis Henry Hawkins.jpeg', '../res/persons/Francis Henry Hawkins.PNG', 'Francis Henry Hawkins', '1865-03-26', '1916-02-14', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '51', 55),
(26, '../res/cemeterys/Pvt A. J. Fee.jpg', '../res/persons/Pvt A. J. Fee.PNG', 'Pvt A. J. Fee', '1932-01-01', '1951-02-20', 'Western Road Cemetery Penang, Penang, Malaysia', '19', 56),
(27, '../res/cemeterys/W. G. Hignett.jpeg', '../res/persons/W. G. Hignett.PNG', 'W. G. Hignett', '1937-04-07', '1970-12-01', 'Western Road Cemetery Penang, Penang, Malaysia	', '33', 57),
(28, '../res/cemeterys/Khoo Chye Hong.jpeg', '../res/persons/Khoo Chye Hong.PNG', 'Khoo Chye Hong', '1895-03-21', '1985-07-07', 'Western Road Cemetery Penang, Penang, Malaysia	', '90', 58),
(29, '../res/cemeterys/B. Hornby.jpg', '../res/persons/B. Hornby.PNG', 'B. Hornby', '1907-12-19', '1950-12-31', 'Western Road Cemetery Penang, Penang, Malaysia	', '43', 59),
(30, '../res/cemeterys/Sarah Jane Nissen Houston.jpg', '../res/persons/Sarah Jane Nissen Houston.PNG', 'Sarah Jane Nissen Houston', '1875-12-01', '1965-10-23', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '90', 60),
(31, '../res/cemeterys/D. Johnson.jpg', '../res/persons/D. Johnson.PNG', 'D. Johnson', '1940-12-12', '1954-02-12', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '14', 76),
(32, '../res/cemeterys/Pvt H. Kelly.jpg', '../res/persons/Pvt H. Kelly.PNG', 'Pvt H. Kelly', '1926-12-12', '1946-12-03', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '20', 77),
(33, '../res/cemeterys/William Stuart Lecky.jpg', '../res/persons/William Stuart Lecky.PNG', 'William Stuart Lecky', '1867-11-14', '1910-01-15', '\r\nWestern Road Cemetery\r\nPenang, Penang, Malaysia', '43', 78),
(34, '../res/cemeterys/Hannah Cheng Jiau Lee.jpeg', '../res/persons/Hannah Cheng Jiau Lee.PNG', 'Hannah Cheng Jiau Lee', '1929-11-08', '2015-01-31', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '86', 79),
(35, '../res/cemeterys/W. H. Leppard.jpg', '../res/persons/W. H. Leppard.PNG', 'W. H. Leppard', '1936-03-03', '1955-02-15', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '19', 80),
(36, '../res/cemeterys/Michael Lesslar.jpg', '../res/persons/Michael Lesslar.PNG', 'Michael Lesslar', '1919-05-04', '1972-05-12', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '53', 81),
(37, '../res/cemeterys/Francisca Siew Chin Liew.jpg', '../res/persons/Francisca Siew Chin Liew.PNG', 'Francisca Siew Chin Liew', '1918-08-01', '1993-11-30', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '75', 82),
(38, '../res/cemeterys/Lieut P. S. Loveday.jpg', '../res/persons/Lieut P. S. Loveday.PNG', 'Lieut P. S. Loveday', '1945-02-01', '1966-02-10', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '21', 83),
(39, '../res/cemeterys/J. Lyon.jpg', '../res/persons/J. Lyon.PNG', 'J. Lyon', '1934-05-21', '1955-02-28', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '21', 84),
(40, '../res/cemeterys/Geoffrey Francis Mills.jpeg', '../res/persons/Geoffrey Francis Mills.PNG', 'Geoffrey Francis Mills', '1944-06-04', '1966-08-09', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '22', 11),
(41, '../res/cemeterys/Capt David Williams.jpg', '../res/persons/Capt David Williams.PNG', 'Capt David Williams123', '1909-08-02', '1988-11-11', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '79', 12),
(42, '../res/cemeterys/Anna Stewart Wright.jpeg', '../res/persons/Anna Stewart Wright.PNG', 'Anna Stewart Wright', '1793-06-09', '1894-12-19', 'Western Road Cemetery\r\nPenang, Penang, Malaysia ', '101', 13),
(43, '../res/cemeterys/Stacey Louise Rudkin.jpeg', '../res/persons/Stacey Louise Rudkin.PNG', 'Stacey Louise Rudkin', '1959-02-17', '1959-05-26', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '(aged 3 months)', 14),
(44, '../res/cemeterys/Colin John Rowe.jpg', '../res/persons/Colin John Rowe.PNG', 'Colin John Rowe', '1937-04-05', '1959-11-18', 'Western Road Cemetery\r\nPenang, Penang, Malaysia ', '22', 15),
(45, '../res/cemeterys/William Scott.jpeg', '../res/persons/William Scott.PNG', 'William Scott', '1807-04-12', '1807-04-13', 'Western Road Cemetery\r\nPenang, Penang, Malaysia ', '(aged 1 day)', 16),
(46, '../res/cemeterys/Else Schonberg.jpg', '../res/persons/Else Schonberg.PNG', 'Else Schonberg', '1910-01-22', '1910-05-22', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', ' (aged 4 months)', 17),
(47, '../res/cemeterys/Arshak Sarkies.jpg', '../res/persons/Arshak Sarkies.PNG', 'Arshak Sarkies', '1856-06-23', '1931-01-09', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '75', 18),
(48, '../res/cemeterys/joseph smith.jpeg', '../res/persons/joseph smith.PNG', 'joseph smith', '1844-01-12', '1912-12-25', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '68', 19),
(49, '../res/cemeterys/Frederick Stewart.jpg', '../res/persons/Frederick Stewart.PNG', 'Frederick Stewart', '1849-08-01', '1901-03-12', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '52', 20),
(50, '../res/cemeterys/Frederick Mathieu Stewart.jpg', '../res/persons/Frederick Mathieu Stewart.PNG', 'Frederick Mathieu Stewart', '1871-07-28', '1901-03-08', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '30', 21),
(51, '../res/cemeterys/Ghin Hye Tan.jpeg', '../res/persons/Ghin Hye Tan.PNG', 'Ghin Hye Tan', '1906-10-21', '1978-03-21', 'Western Road Cemetery\r\nPenang, Penang, Malaysia ', '72', 36),
(52, '../res/cemeterys/Ghin Chong Tan.jpeg', '../res/persons/Ghin Chong Tan.PNG', 'Ghin Chong Tan', '1920-04-07', '1996-08-07', 'Western Road Cemetery\r\nPenang, Penang, Malaysia ', '76', 37),
(53, '../res/cemeterys/Maria F.F Mathieu Stewart.jpg', '../res/persons/Maria F.F Mathieu Stewart.PNG', 'Maria F.F Mathieu Stewart', '1851-06-19', '1899-06-21', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '48', 38),
(54, '../res/cemeterys/Molly Alice Eckersall Toolseram.jpg', '../res/persons/Molly Alice Eckersall Toolseram.PNG', 'Molly Alice Eckersall Toolseram', '1904-04-02', '1945-09-24', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '41', 39),
(55, '../res/cemeterys/Capt Stephen Charles Toolseram.jpg', '../res/persons/Capt Stephen Charles Toolseram.PNG', 'Capt Stephen Charles Toolseram', '1900-12-12', '1966-11-03', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '66', 40),
(56, '../res/cemeterys/Kanagasabapathy Vanniasingham.jpg', '../res/persons/Kanagasabapathy Vanniasingham.PNG', 'Kanagasabapathy Vanniasingham', '1876-09-04', '1930-06-17', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '54', 41),
(57, '../res/cemeterys/John Charles William Weber.jpg', '../res/persons/John Charles William Weber.PNG', 'John Charles William Weber', '1871-09-07', '1930-06-17', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '59', 42),
(58, '../res/cemeterys/Nathan Kesagar Vanniasingham.jpg', '../res/persons/Nathan Kesagar Vanniasingham.PNG', 'Nathan Kesagar Vanniasingham', '1916-04-13', '1989-06-19', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '73', 43),
(59, '../res/cemeterys/Lucy Nallammah Vanniasingham.jpg', '../res/persons/Lucy Nallammah Vanniasingham.PNG', 'Lucy Nallammah Vanniasingham', '1889-10-26', '1960-01-03', ' Road Cemetery\r\nPenang, Penang, Malaysia', '71', 44),
(60, '../res/cemeterys/Regina Stewart Weber.jpg', '../res/persons/Regina Stewart Weber.PNG', 'Regina Stewart Weber', '1850-11-11', '1920-08-10', 'Western Road Cemetery\r\nPenang, Penang, Malaysia', '70', 45),
(61, '../res/cemeterys/Ethel Mary.png', '../res/persons/Ethel Mary.PNG', 'Ethel Mary', '1930-07-22', '2021-05-28', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '91', 61),
(62, '../res/cemeterys/Raymond Maurice Barrett.png', '../res/persons/Raymond Maurice Barrett.PNG', 'Raymond Maurice Barrett', '1929-11-10', '2002-02-22', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '73', 62),
(63, '../res/cemeterys/Dorothy Bennie.jpeg', '../res/persons/Dorothy Bennie.PNG', 'Dorothy Bennie', '1902-12-15', '1964-11-01', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '62', 63),
(64, '../res/cemeterys/Thomas Lyons Beckingham.jpeg', '../res/persons/Thomas Lyons Beckingham.PNG', 'Thomas Lyons Beckingham', '1884-11-14', '1956-12-06', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '72', 64),
(65, '../res/cemeterys/Mary Elizabeth Booker.jpeg', '../res/persons/Mary Elizabeth Booker.PNG', 'Mary Elizabeth Booker', '1864-01-23', '1939-08-08', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '75', 65),
(66, '../res/cemeterys/Charles William Booker.jpeg', '../res/persons/Charles William Booker.PNG', 'Charles William Booker', '1861-12-10', '1942-04-21', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n\r\n', '81', 66),
(67, '../res/cemeterys/Harriett Brooman.jpeg', '../res/persons/Harriett Brooman.PNG', 'Harriett Brooman', '1882-12-12', '1966-11-18', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '84', 67),
(68, '../res/cemeterys/James Brooman.jpeg', '../res/persons/James Brooman.PNG', 'James Brooman', '1857-07-05', '1928-08-21', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '71', 68),
(69, '../res/cemeterys/Eleanor Edith Brown.jpeg', '../res/persons/Eleanor Edith Brown.PNG', 'Eleanor Edith Brown', '1873-03-07', '1943-09-20', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '70', 69),
(70, '../res/cemeterys/Mary Eliza Canning.jpeg', '../res/persons/Mary Eliza Canning.PNG', 'Mary Eliza Canning', '1883-08-07', '1958-06-05', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '75', 70),
(71, '../res/cemeterys/Susannah Carr.jpeg', '../res/persons/Susannah Carr.PNG', 'Susannah Carr', '1854-04-05', '1937-12-05', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '83', 81),
(72, '../res/cemeterys/Harry Carr.jpeg', '../res/persons/Harry Carr.PNG', 'Harry Carr', '1853-05-03', '1937-04-15', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '84', 82),
(73, '../res/cemeterys/Fred Ivor Court.jpg', '../res/persons/Fred Ivor Court.PNG', 'Fred Ivor Court', '1923-03-02', '1942-09-03', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '19', 83),
(74, '../res/cemeterys/Sarah Elizabeth Cutler.jpeg', '../res/persons/Sarah Elizabeth Cutler.PNG', 'Sarah Elizabeth Cutler', '1866-06-06', '1929-08-04', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '63', 84),
(75, '../res/cemeterys/Charles Edwin Cutler.jpeg', '../res/persons/Charles Edwin Cutler.PNG', 'Charles Edwin Cutler', '1873-03-07', '1957-12-19', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '84', 85),
(76, '../res/cemeterys/George Albert Golding.jpeg', '../res/persons/George Albert Golding.PNG', 'George Albert Golding', '1871-01-07', '1954-06-25', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '83', 86),
(77, '../res/cemeterys/Harold Roy Ellmer.jpg', '../res/persons/Harold Roy Ellmer.PNG', 'Harold Roy Ellmer', '1921-02-01', '1943-09-23', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '22', 87),
(78, '../res/cemeterys/Reginald William Edwards.jpg', '../res/persons/Reginald William Edwards.PNG', 'Reginald William Edwards', '1905-12-14', '1944-11-08', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '39', 88),
(79, '../res/cemeterys/Helen Elizabeth Draper.jpeg', '../res/persons/Helen Elizabeth Draper.PNG', 'Helen Elizabeth Draper', '1939-07-25', '1942-01-30', 'Western Road Cemetery\r\nPenang, Penang, Malaysia\r\n', '3', 89),
(80, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'D15', '0001-01-01', '0001-01-01', 'Western Road Cemetery\r\n', '', 90),
(81, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'A22', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 22),
(82, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'A23', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 23),
(83, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'A24', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 24),
(84, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'A25', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 25),
(85, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'B21', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 46),
(86, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'B22', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 47),
(87, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'B23', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 48),
(88, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'B24', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 49),
(89, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'B25', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 50),
(90, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'C21', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 71),
(91, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'C22', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 72),
(92, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'C23', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 73),
(93, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'C24', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 74),
(94, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'C25', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 75),
(95, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'D21', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 96),
(96, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'D22', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 97),
(97, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'D23', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 98),
(98, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'D24', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 99),
(99, '../res/cemeterys/Default grave.png\n', '../res/persons/user.jpg', 'D25', '0001-01-01', '0001-01-01', 'Western Road Cemetery', '', 100),
(101, '../res/cemeterys/', '../res/persons/', 'William Edward Cuznerss 123', '1865-05-27', '1893-01-11', 'qww', '28', 0),
(102, '../res/cemeterys/', '../res/persons/', 'asdxcb', '0111-11-11', '1111-11-11', 'adsfdvb', '1000', 0),
(103, '../res/cemeterys/', '../res/persons/', 'asdxcb', '0111-11-11', '1111-11-11', 'adsfdvbgvhbjnkmgyhu', '1000', 0),
(104, '../res/cemeterys/', '../res/persons/', 'asdxcb', '0111-11-11', '1111-11-11', 'adsfdvb123', '1000', 0),
(105, '../res/cemeterys/Able Seaman John Francis Durnin.jpg', '../res/persons/Nathan Kesagar Vanniasingham.PNG', 'Nathan', '1870-12-12', '1900-12-12', 'sdada', '30', 0),
(106, '../res/cemeterys/Able Seaman John Francis Durnin.jpg', '../res/persons/Nathan Kesagar Vanniasingham.PNG', 'Nathan K', '1970-01-01', '2023-12-12', 'sdada', '33', 0),
(107, '../res/cemeterys/Able Seaman John Francis Durnin.jpg', '../res/persons/Maria F.F Mathieu Stewart.PNG', 'Maria', '1970-01-01', '1900-10-10', 'asdsfdgfasdsfd', '30', 25);

-- --------------------------------------------------------

--
-- 表的结构 `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email_to` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email_from` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `emails`
--

INSERT INTO `emails` (`id`, `email_to`, `subject`, `message`, `sent_at`, `email_from`) VALUES
(1, 'cms@jiajun0701.com', 'New message from kelvin', 'kelvin@gmail.com', '2023-05-13 14:10:57', 'kelvin@gmail.com'),
(2, 'cms@jiajun0701.com', 'New message from Vivian', 'Vivian@gmail.com', '2023-05-13 14:11:31', 'Vivian@gmail.com'),
(13, 'cms@jiajun0701.com', 'New message from sdsdxv', 'asdv', '2023-06-16 14:07:24', 'cms2@gmail.com'),
(18, 'cms@jiajun0701.com', 'New message from limjiajun', '123', '2023-07-11 08:45:45', 'limov70531@nasskar.com'),
(19, 'cms@jiajun0701.com', 'New message from ali', 'hello', '2023-07-31 06:26:26', 'bemotix953@inkiny.com'),
(20, 'cms@jiajun0701.com', 'New message from ali', 'hi can ', '2023-07-31 06:35:21', 'bemotix953@inkiny.com');

-- --------------------------------------------------------

--
-- 表的结构 `personrecord`
--

CREATE TABLE `personrecord` (
  `Person_ID` int(50) NOT NULL,
  `Image1` varchar(255) NOT NULL,
  `Name_Deceased1` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `personrecord`
--

INSERT INTO `personrecord` (`Person_ID`, `Image1`, `Name_Deceased1`) VALUES
(1, '../res/persons/person_1.jpg', 'WilliamEdwardCuznerss'),
(2, '../res/persons/Corp_Percy_Garfield.PNG', 'Corp_Percy_Garfield'),
(3, '../res/persons/Ian Alexander Durant.PNG', 'Ian Alexander Durant'),
(4, '../res/persons/William Patrick Duffy.PNG', 'William Patrick Duffy'),
(5, '../res/persons/VivtorKeith.png', 'VivtorKeith '),
(6, '../res/persons/R_I_Beer.PNG', 'R_I_Beer'),
(7, '../res/persons/L.J.Bane.PNG', 'L.J.Bane'),
(8, '../res/persons/Alexandar.PNG', 'Alexandar'),
(9, '../res/persons/John.PNG', 'John'),
(10, '../res/persons/I_E_Fitzpatrick.PNG', 'I_E_Fitzpatrick'),
(11, '../res/persons/Noel_H_T_Frost.PNG', 'Noel_H_T_Frost'),
(12, '../res/persons/Cpl W C Byde.PNG', 'Cpl W C Byde'),
(13, '../res/persons/WO F. Cain.PNG', 'WO F. Cain'),
(14, '../res/persons/Corp R. Carus.PNG', 'Corp R. Carus'),
(15, '../res/persons/R. C. F. Cooper.PNG', 'R. C. F. Cooper'),
(16, '../res/persons/Hiepke Tan Crommers.PNG', 'Hiepke Tan Crommers'),
(17, '../res/persons/Michael Vaughan Curtis.PNG', 'Michael Vaughan Curtis'),
(18, '../res/persons/Zuxin Dai.PNG', 'Zuxin Dai'),
(19, '../res/persons/Joseph Dass.PNG', 'Joseph Dass'),
(20, '../res/persons/David Anthony Dass.PNG', 'David Anthony Dass'),
(21, '../res/persons/Kenneth William Davies.PNG', 'Kenneth William Davies'),
(22, '../res/persons/Clement Christopher Denis.PNG', 'Clement Christopher Denis'),
(23, '../res/persons/Victor Keith Alured Denne.PNG', 'Victor Keith Alured Denne'),
(24, '../res/persons/Able Seaman John Francis Durnin.PNG', 'Able Seaman John Francis Durnin'),
(25, '../res/persons/Francis Henry Hawkins.PNG', 'Francis Henry Hawkins'),
(26, '../res/persons/Pvt A. J. Fee.PNG', 'Pvt A. J. Fee'),
(27, '../res/persons/W. G. Hignett.PNG', 'W. G. Hignett'),
(28, '../res/persons/Khoo Chye Hong.PNG', 'Khoo Chye Hong'),
(29, '../res/persons/B. Hornby.PNG', 'B. Hornby'),
(30, '../res/persons/Sarah Jane Nissen Houston.PNG', 'Sarah Jane Nissen Houston'),
(31, '../res/persons/D. Johnson.PNG', 'D. Johnson'),
(32, '../res/persons/Pvt H. Kelly.PNG', 'Pvt H. Kelly'),
(33, '../res/persons/William Stuart Lecky.PNG', 'William Stuart Lecky'),
(34, '../res/persons/Hannah Cheng Jiau Lee.PNG', 'Hannah Cheng Jiau Lee'),
(35, '../res/persons/W. H. Leppard.PNG', 'W. H. Leppard'),
(36, '../res/persons/Michael Lesslar.PNG', 'Michael Lesslar'),
(37, '../res/persons/Francisca Siew Chin Liew.PNG', 'Francisca Siew Chin Liew'),
(38, '../res/persons/Lieut P. S. Loveday.PNG', 'Lieut P. S. Loveday'),
(39, '../res/persons/J. Lyon.PNG', 'J. Lyon'),
(40, '../res/persons/Geoffrey Francis Mills.PNG', 'Geoffrey Francis Mills'),
(41, '../res/persons/Capt David Williams.PNG', 'Capt David Williams'),
(42, '../res/persons/Anna Stewart Wright.PNG', 'Anna Stewart Wright'),
(43, '../res/persons/Stacey Louise Rudkin.PNG', 'Stacey Louise Rudkin'),
(44, '../res/persons/Colin John Rowe.PNG', 'Colin John Rowe'),
(45, '../res/persons/William Scott.PNG', 'William Scott'),
(46, '../res/persons/Else Schonberg.PNG', 'Else Schonberg'),
(47, '../res/persons/Arshak Sarkies.PNG', 'Arshak Sarkies'),
(48, '../res/persons/joseph smith.PNG', 'joseph smith'),
(49, '../res/persons/Frederick Stewart.PNG', 'Frederick Stewart'),
(50, '../res/persons/Frederick Mathieu Stewart.PNG', 'Frederick Mathieu Stewart'),
(51, '../res/persons/Ghin Hye Tan.PNG', 'Ghin Hye Tan'),
(52, '../res/persons/Ghin Chong Tan.PNG', 'Ghin Chong Tan'),
(53, '../res/persons/Maria F.F Mathieu Stewart.PNG', 'Maria F.F Mathieu Stewart'),
(54, '../res/persons/Molly Alice Eckersall Toolseram.PNG', 'Molly Alice Eckersall Toolseram'),
(55, '../res/persons/Capt Stephen Charles Toolseram.PNG', 'Capt Stephen Charles Toolseram'),
(56, '../res/persons/Kanagasabapathy Vanniasingham.PNG', 'Kanagasabapathy Vanniasingham'),
(57, '../res/persons/John Charles William Weber.PNG', 'John Charles William Weber'),
(58, '../res/persons/Nathan Kesagar Vanniasingham.PNG', 'Nathan Kesagar Vanniasingham'),
(59, '../res/persons/Lucy Nallammah Vanniasingham.PNG', 'Lucy Nallammah Vanniasingham'),
(60, '../res/persons/Regina Stewart Weber.PNG', 'Regina Stewart Weber'),
(61, '../res/persons/Ethel Mary.PNG', 'Ethel Mary'),
(62, '../res/persons/Raymond Maurice Barrett.PNG', 'Raymond Maurice Barrett'),
(63, '../res/persons/Dorothy Bennie.PNG', 'Dorothy Bennie'),
(64, '../res/persons/Thomas Lyons Beckingham.PNG', 'Thomas Lyons Beckingham'),
(65, '../res/persons/Mary Elizabeth Booker.PNG', 'Mary Elizabeth Booker'),
(66, '../res/persons/Charles William Booker.PNG', 'Charles William Booker'),
(67, '../res/persons/Harriett Brooman.PNG', 'Harriett Brooman'),
(68, '../res/persons/James Brooman.PNG', 'James Brooman'),
(69, '../res/persons/Eleanor Edith Brown.PNG', 'Eleanor Edith Brown'),
(70, '../res/persons/Mary Eliza Canning.PNG', 'Mary Eliza Canning'),
(71, '../res/persons/Susannah Carr.PNG', 'Susannah Carr'),
(72, '../res/persons/Harry Carr.PNG', 'Harry Carr'),
(73, '../res/persons/Fred Ivor Court.PNG', 'Fred Ivor Court'),
(74, '../res/persons/Sarah Elizabeth Cutler.PNG', 'Sarah Elizabeth Cutler'),
(75, '../res/persons/Charles Edwin Cutler.PNG', 'Charles Edwin Cutler'),
(76, '../res/persons/George Albert Golding.PNG', 'George Albert Golding'),
(77, '../res/persons/Harold Roy Ellmer.PNG', 'Harold Roy Ellmer'),
(78, '../res/persons/Reginald William Edwards.PNG', 'Reginald William Edwards'),
(79, '../res/persons/Helen Elizabeth Draper.PNG', 'Helen Elizabeth Draper'),
(80, '../res/persons/George Henry Draper.PNG', 'George Henry Draper'),
(81, '../res/persons/Edwin Cutler - Copy.PNG', 'Edwin Cutler ');

-- --------------------------------------------------------

--
-- 表的结构 `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 'Jason', 5, 'Good Idea', 1681751405),
(2, 'Kelvin', 4, 'nice', 1682025708),
(3, 'ali', 3, 'well don', 1682107496),
(4, 'dada', 5, '123', 1683474868),
(5, 'William', 1, 'not enough good', 1684765648),
(6, 'angel', 3, 'well done', 1684820281),
(7, 'ali@gmail.com', 3, 'good', 1684830173),
(8, 'cms2@gmail.com', 5, 'sadf', 1686826414),
(9, 'cms2@gmail.com', 5, 'sadf', 1686826419);

-- --------------------------------------------------------

--
-- 表的结构 `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(10) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `First_name` varchar(100) NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Phone_Number` int(100) NOT NULL,
  `Home_Address` varchar(250) NOT NULL,
  `otp` varchar(5) NOT NULL,
  `status` varchar(255) NOT NULL,
  `resettoken` int(50) NOT NULL,
  `resettokenexp` datetime(6) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `Image`, `First_name`, `Last_name`, `Gender`, `Email`, `Password`, `Phone_Number`, `Home_Address`, `otp`, `status`, `resettoken`, `resettokenexp`, `user_type`) VALUES
(1, '../res/users/admin.jpg', 'Admin123', 'Admin', 'Male', 'cms@gmail.com', '480db33749775b1de984ebe26664675f312d87cb', 733315000, '5, Lengkok Barat, George Town,\r\n10450 George Town,\r\nPulau Pinang', '1', 'Active', 0, '0000-00-00 00:00:00.000000', 'admin'),
(2, '../res/users/user.jpg', 'kelvin ', 'LIM', 'Male', 'cms1@gmail.com', '2df20fecc7d714ba84203a50f7c204341ba506f3', 1112797544, 'Jalan Tasik Senangin 9/7, Mahkota Hills, Mantin, Negeri Sembilan', '1', 'Active', 0, '0000-00-00 00:00:00.000000', 'user'),
(3, '../res/users/user2.jpg', 'Vivian ', 'Tan', 'Female', 'Vivian@gmail.com', '9a584cb40af7d98d6ccf731eab8422956c8b7022', 1751294756, 'Unit 14-5A, Persiaran CapSquare, Off Jalan Munshi Abdullah, Kuala Lumpur', '1', '0', 0, '0000-00-00 00:00:00.000000', 'user'),
(9, '../res/users/admin.jpg', 'Admin99', 'Admin', 'Male', 'cms2@gmail.com', '2cbfc05438348e72e91a75ddce6a90c431d597c1', 733315000, '5, Lengkok Barat, George Town,\r\n10450 George Town,\r\nPulau Pinang', '1', 'Active', 185, '2023-07-20 00:00:00.000000', 'user'),
(16, '../res/users/user2.jpg', 'Ali', 'Abu', 'Male', 'ali@gmail.com', 'ccb2b0b2ccd52166f809a71c5f5c3b851c8d7e3e', 0, 'ali@gmail.com', '', 'Inactive', 0, '0000-00-00 00:00:00.000000', 'user'),
(17, '../res/users/Ghin Chong Tan.PNG', 'Chong', 'Tan', 'Male', 'tan@gmail.com', 'b5766bbcfbb886ab089a138421b752e2afe62657', 0, 'tan@gmail.com', '60651', 'inactive', 0, '0000-00-00 00:00:00.000000', 'user'),
(18, '../res/users/Ghin Hye Tan.PNG', 'Ghin Hye Tan', 'Tan', 'Female', 'Tan@gmail.com', '6db988cbefcd593a3623f56ff2f6a1a5ee1d4143', 0, 'Tan@gmail.com', '89237', 'inactive', 0, '0000-00-00 00:00:00.000000', 'user'),
(21, '../res/users/Pulau-Dayang-Bunting.jpg', 'wilton', 'goh', 'Male', '07092gwx@gmail.com', '13bb0c9108b71d452ded9eacebc9d0ea8b7f5f50', 17, 'Penang', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(29, '../res/users/table.jpg', 'asdfb', 'asdfb', 'Male', 'ranobot502@bodeem.com', 'a974d0d03b5b0d6e576c0c0242aad469f3c1be02', 1128797556, ',Malaysia,82000\r\n,82000,Pontian,Johor', '63092', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(31, '../res/users/Charles William Booker.PNG', 'sadsfdbsadv', 'sadsfd df ', 'Male', 'Ww123@gmail.com', '00a1020aabf7760209a8438f465698c774e2fd24', 1728794710, 'Ww123@gmail.com', '76658', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(32, '../res/users/', 'dawdada', 'dawdada', 'Male', 'Dawdada123@gmail.com', '0c8f13e83f70e04a938a749e536e1650436ee350', 1235544844, 'Dawdada@gmail.com', '98492', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(33, '../res/users/', 'ceyab', 'wong', 'Male', 'ceyab99606@bodeem.com', 'cabcb970116325e9784cb74ca57d70151d6a7e66', 175468975, 'sintok,kedah', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(34, 'https://jiajun0701.com/test/res/users/useravatar.png', 'CHUAN QI', 'NG', 'Male', 'hosak82950@byorby.com', 'c291f3029919687bae4e3571edda394c74ff5ba1', 117547896, 'changlun,kedah', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(35, 'https://jiajun0701.com/test/res/users/useravatar.png', 'xabax56461@bodeem.com123', 'xabax56461@bodeem.com', 'Male', 'xabax56461@bodeem.com', '913adfe0bced5ee40c2f0f4860618be2ba17a197', 2147483647, 'Xabax56461@bodeem.com', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(36, '../res/users/Arshak Sarkies.PNG', 'Arshak', 'Sarkies', 'Male', 'benepev845@meogl.com', '9c0119b17317a5c4b992fa3c2705213617e84fea', 2147483647, 'Jalan Tasik Senangin 9/7, Mahkota Hills, Mantin, Negeri Sembilan', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(37, '../res/users/Ethel Mary.PNG', 'Ethel', 'Mary', 'Female', 'limov70531@nasskar.com', '9c0119b17317a5c4b992fa3c2705213617e84fea', 1789645678, 'The Straits View Condominium, Jalan Permas Selatan, Bandar Baru Permas, 81750 Masai, Johor', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(38, '../res/users/Lucy Nallammah Vanniasingham.PNG', 'Lucy', 'Nallam', 'Female', 'caxib38265@sparkroi.com', 'b240bde07ed52329644add2a908e7c0135b13fe7', 2147483647, 'Jalan Galloway, Casa Residency Condominium KL, Bukit Bintang, 50150 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur', '1', '', 451, '2023-07-20 00:00:00.000000', 'user'),
(39, '../res/users/James Brooman.PNG', 'JAMES', 'BROOMAN', 'Male', 'rofonin111@rc3s.com', 'e8be1f2f460e94aa6c13b513d3f4244b4a4cc3bb', 2147483647, '\r\n,82000,Pontian,Johor', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(40, '../res/users/Copy of Copy of cms.drawio.png', 'Ali', 'Abu', 'Male', 'yowiv54410@inkiny.com', 'ec9c72a6214b16b903c3160eb3156cc9d830b1cb', 1128797556, ',Malaysia,82000\r\n,82000,Pontian,Johor', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(41, '../res/users/Harriett Brooman.PNG', 'Harriett', 'Brooman', 'Male', 'bemotix953@inkiny.com', '841a6326832f2b5d10aaaf951bdbd087efe39c43', 2147483647, 'The Straits View Condominium, Jalan Permas Selatan, Bandar Baru Permas, 81750 Masai, Johor', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(42, '../res/users/Michael Lesslar.PNG', 'Michael 123', 'Lesslar', 'Male', 'sabay57538@naymedia.com', '7d45d35ae365281f99f705d1c11b6e4b9e2b7dee', 124757894, 'Universiti Utara ,06010 Uum Sintok, Kedah', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(43, '../res/users/Harry Carr.PNG', 'Harrt', 'Carr', 'Male', 'gicer19055@mliok.com', 'a7ed79ef5f844cbb2252fc4603b541a4c5c3f88e', 13456789, 'Universiti Utara ,06010 Uum Sintok, Kedah', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(44, '../res/users/John.PNG', 'John', 'Ong', 'Male', 'marebox866@mliok.com', '6dfb11108f05e2f65c94bf3f81520b4fc8ad4a84', 123456789, 'Universiti Utara ,06010 Uum Sintok, Kedah', '1', '', 0, '0000-00-00 00:00:00.000000', 'user'),
(45, '../res/users/63aeb503-49c9-43c6-b5f8-7a5a3652204c.jpg', 'LIM', 'JIA JUN', 'Male', 'abc@gmail.com', 'c0d0a32c405c68cb538e3891a3e3bce98887f012', 1128797556, '42,Jalan Pulai Perdana 3/1,Taman Pulai Perdana', '1', '', 0, '0000-00-00 00:00:00.000000', 'user');

--
-- 转储表的索引
--

--
-- 表的索引 `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`Area_id`),
  ADD UNIQUE KEY `Area_id` (`Area_id`),
  ADD KEY `Block_id` (`Block_id`);

--
-- 表的索引 `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`Block_id`);

--
-- 表的索引 `cemeteryrecord`
--
ALTER TABLE `cemeteryrecord`
  ADD PRIMARY KEY (`Grave_ID`),
  ADD KEY `Area_id` (`Area_id`);

--
-- 表的索引 `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `personrecord`
--
ALTER TABLE `personrecord`
  ADD PRIMARY KEY (`Person_ID`);

--
-- 表的索引 `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- 表的索引 `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cemeteryrecord`
--
ALTER TABLE `cemeteryrecord`
  MODIFY `Grave_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- 使用表AUTO_INCREMENT `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用表AUTO_INCREMENT `personrecord`
--
ALTER TABLE `personrecord`
  MODIFY `Person_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- 使用表AUTO_INCREMENT `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- 限制导出的表
--

--
-- 限制表 `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `Area_ibfk_1` FOREIGN KEY (`Block_id`) REFERENCES `block` (`Block_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
