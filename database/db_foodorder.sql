-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 01:01 PM
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
-- Database: `db_foodorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(58, 'ADMINISTRATOR', 'admin', '704b037a97fa9b25522b7c014c300f8a');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(45, 'Nasi', 'Food_Category_15154.jpg', 'Yes', 'Yes'),
(46, 'Jajanan', 'Food_Category_96336.jpeg', 'Yes', 'Yes'),
(47, 'Minuman', 'Food_Category_93520.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(24, 'Nasi Campur', 'Nasi dengan berbagai macam lauk.', 25.000, 'Food_Name_28346.jpg', 45, 'No', 'Yes'),
(25, 'Nasi Liwet', 'Nasi liwet dengan berbagai macam lauk.', 25.000, 'Food_Name_37919.jpeg', 45, 'Yes', 'Yes'),
(26, 'Nasi Kuning', 'Nasi kuning dengan berbagai macam lauk.', 25.000, 'Food_Name_18463.jpg', 45, 'Yes', 'Yes'),
(27, 'Risol', 'Risol berisi telur dan mayonnaise.', 5.000, 'Food_Name_25360.jpg', 46, 'Yes', 'Yes'),
(28, 'Brownies', 'Kue rasa coklat yang manis dan enak.', 10.000, 'Food_Name_5617.jpg', 46, 'No', 'Yes'),
(29, 'Lemper', 'Ketan berisi ayam yang dibungkus daun pisang.', 5.000, 'Food_Name_10303.jpg', 46, 'Yes', 'Yes'),
(30, 'Es Kelapa', 'es dari buah kelapa asli dengan gula murni.', 10.000, 'Food_Name_7299.jpg', 47, 'Yes', 'Yes'),
(31, 'Es Teh Manis', 'Minuman dengan teh terbaik dari alam.', 5.000, 'Food_Name_41282.jpg', 47, 'Yes', 'Yes'),
(32, 'Es Cendol', 'Es dengan santan, gula merah, dan beras ketan.', 10.000, 'Food_Name_63909.webp', 47, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,3) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(7, 'Nasi Kuning', 25.000, 1, 25.000, '2023-09-24 01:13:10', 'Finish', 'admin', '0123456789', 'admin@gmail.com', 'jl administrator'),
(8, 'Es Teh Manis', 5.000, 1, 5.000, '2023-09-24 13:16:07', 'Finish', 'mekina', '0987654321', 'mekina@gmail.com', 'jl mekina'),
(9, 'Es Cendol', 10.000, 10, 100.000, '2023-09-24 21:07:14', 'Finish', 'rafi', '081212121212', 'rafi@gmail.com', 'jl rafi 1'),
(10, 'Lemper', 5.000, 10, 50.000, '2023-09-24 21:14:55', 'Delivery', 'qad', 'asd', 'asdsad@a', 'asd'),
(17, 'Nasi Liwet', 25.000, 2, 50.000, '2023-09-24 21:39:04', 'Order', 'harli', '012345678', 'harli@gmail.com', 'jl harli'),
(34, 'Nasi Campur', 25.000, 1, 25.000, '2023-09-25 19:19:18', 'Order', 'asd', 'asd', 'asd@asd', 'asd'),
(37, 'Nasi Liwet', 25.000, 1, 25.000, '2023-09-26 20:26:00', 'Order', '&lt;script&gt;', '&lt;script&gt;', 'script@asd', '&lt;script&gt;'),
(38, 'Risol', 5.000, 1, 5.000, '2023-09-26 20:33:33', 'Order', '&lt;script&gt;', '&lt;script&gt;', 'asd@asd', '&lt;?php echo $id; ?&gt;'),
(40, 'Nasi Liwet', 25.000, 1, 25.000, '2023-09-26 21:46:13', 'Cancel', 'asd', 'aasd', 'asd@asd', 'asd'),
(41, 'Risol', 5.000, 60, 300.000, '2023-10-04 08:23:22', 'Delivery', 'harli', '088888', 'harliiiiiii@mui.com', 'jl xiaomi'),
(42, 'Nasi Liwet', 25.000, 1, 25.000, '2023-10-12 08:41:55', 'Order', 'rafi', '678', '345235@ASD', 'ASDT'),
(44, 'Brownies', 10.000, 1, 10.000, '2023-10-19 15:48:52', 'Finish', 'khplisd', '512', 'sds@gmail', 'hkn'),
(45, 'Es Teh Manis', 5.000, 1, 5.000, '2023-10-26 15:23:05', 'Order', 'asd', 'asd', 'asd@asd', 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
