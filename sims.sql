-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 06:05 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_desc` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_desc`) VALUES
(1, 'Laptop'),
(3, 'Printer'),
(5, 'Table'),
(7, 'computer set'),
(8, 'computer parts'),
(9, 'table set'),
(10, 'Furniture'),
(11, 'School Vehicle'),
(12, 'pageant Attire'),
(13, 'Kitchen Utensils');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` int(11) NOT NULL,
  `dept_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `dept_name`) VALUES
(3, 'CTE'),
(4, 'CJE'),
(5, 'Cashier'),
(6, 'CBE'),
(7, 'Registrar'),
(8, 'property custodian'),
(9, 'TES'),
(10, 'Accounting Office'),
(11, 'library'),
(12, 'Comlab'),
(13, 'President Office'),
(14, 'guidance');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `inventory_id` int(11) NOT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `issuance_id` int(11) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL,
  `inventory_status` tinyint(4) DEFAULT NULL COMMENT '0 = lost 1 =good condition 2= damaged'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`inventory_id`, `reference_no`, `issuance_id`, `date_inserted`, `inventory_status`) VALUES
(15, '20230702162132', 18, '2023-07-02 16:29:37', 1),
(16, '20230702165802', 20, '2023-07-02 16:58:45', 1),
(17, '20230702224838', 24, '2023-07-02 23:11:18', 1),
(18, '20230702224838', 24, '2023-07-03 00:44:45', 1),
(19, '20230702162215', 19, '2023-07-03 14:11:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issuance_transaction`
--

CREATE TABLE `tbl_issuance_transaction` (
  `issuance_id` int(11) NOT NULL,
  `item_stock_id` int(11) DEFAULT NULL,
  `issued_to` int(11) DEFAULT NULL,
  `issuance_code` varchar(70) DEFAULT NULL,
  `qr` varchar(70) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `date_issued` datetime DEFAULT NULL,
  `issuance_status` tinyint(4) DEFAULT NULL COMMENT '0 = old 1= new 2= damaged',
  `status` tinyint(4) NOT NULL COMMENT '0 = issued 1= returned/replaced',
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_issuance_transaction`
--

INSERT INTO `tbl_issuance_transaction` (`issuance_id`, `item_stock_id`, `issued_to`, `issuance_code`, `qr`, `qr_code`, `date_issued`, `issuance_status`, `status`, `type`) VALUES
(18, 3, 5, 'ITM-20232132', 'qr_images/005_file_dda18c69a0c711df6c255b926e745c56.png', '20230702162132', '2023-07-02 18:21:00', 1, 1, NULL),
(19, 2, 3, 'ITM-20232215', 'qr_images/005_file_2549b8646762df1288ebceeecf2142a0.png', '20230702162215', '2023-07-02 18:22:00', 1, 0, NULL),
(20, 6, 7, 'ITM-20235802', 'qr_images/005_file_123f5504764376878d34e96a07d27410.png', '20230702165802', '2023-07-03 17:57:00', 1, 0, NULL),
(21, 3, 5, 'ITM-20234658', 'qr_images/005_file_54c2321875e73557ca20aa9ca34ce684.png', '20230702204658', '2023-06-30 21:46:00', 1, 0, NULL),
(22, 5, 6, 'ITM-20234726', 'qr_images/005_file_d6d8f9f0bc53167ad4326ca4bbd934b4.png', '20230702204726', '2023-07-05 21:47:00', 1, 0, NULL),
(23, 7, 8, 'ITM-20232350', 'qr_images/005_file_383c83ac81cd7336d88cad28cbf6bf62.png', '20230702222350', '2023-07-02 11:25:00', 1, 0, NULL),
(24, 8, 9, 'ITM-20234838', 'qr_images/005_file_4e52b714d1921009e219f2369cbe04ef.png', '20230702224838', '2023-07-02 10:48:00', 1, 0, NULL),
(25, 3, 7, 'ITM-20232347', 'qr_images/005_file_0122ff2d271bb421a6d2f0cab794341e.png', '20230703132347', '2023-07-03 13:29:00', 1, 0, NULL),
(26, 2, 7, 'ITM-20233452', 'qr_images/005_file_9c843864ef14cc08d207178c429f0a2b.png', '20230703133452', '2023-07-03 13:34:00', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `item_id` int(11) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `raw_stock` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '0 =physical 1= consumable',
  `photo` varchar(70) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `date_inserted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`item_id`, `model`, `category_id`, `brand`, `description`, `raw_stock`, `type`, `photo`, `price`, `date_inserted`) VALUES
(1, 'WHSW12', 1, 'Lenovo', '16GB RAM, 256 SSD', 10, 0, 'uploads/f3ccdd27d2000e3f9255a7e3e2c48800.jpg', '50000.00', '2023-06-27 20:02:54'),
(2, 'G50TY1', 1, 'HUAWEI', 'RYZEN 7, 500GB SSD, 1060Ti', 15, 0, 'uploads/156005c5baf40ff51a327f1c34f2975b.jpg', '60000.00', '2023-06-30 01:02:47'),
(3, 'ASPIRE 5', 1, 'ACER', 'INTEL I5, 500 SSD', 20, 0, 'uploads/799bad5a3b514f096e69bbc4a7896cd9.jpg', '40000.00', '2023-06-30 01:05:47'),
(5, 'HWYS21A', 1, 'ASUS', '500 RAM, 1060TI', 50, 0, 'uploads/799bad5a3b514f096e69bbc4a7896cd9.jpg', '60000.00', '2023-07-02 16:18:30'),
(6, 'wooden magkuno', 5, 'no brand', 'dark brown', 5, 0, NULL, '20000.00', '2023-07-02 16:50:59'),
(7, 'pro 235', 6, 'samsung', '250volts, medium', 100, 0, NULL, '10000.00', '2023-07-02 22:22:56'),
(8, 'curve', 7, 'hp', '21inches, hd display', 100, 0, NULL, '10000.00', '2023-07-02 22:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_stock`
--

CREATE TABLE `tbl_item_stock` (
  `item_stock_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `item_status` tinyint(4) DEFAULT NULL COMMENT '0 = old 1=new 2=damaged',
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_stock`
--

INSERT INTO `tbl_item_stock` (`item_stock_id`, `item_id`, `quantity`, `item_status`, `status`) VALUES
(2, 2, 18, NULL, NULL),
(3, 3, 16, NULL, NULL),
(5, 5, 59, NULL, NULL),
(6, 6, 4, NULL, NULL),
(7, 7, 99, NULL, NULL),
(8, 8, 99, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '1= Female 2 = Male',
  `user_type_id` tinyint(4) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `fname`, `lname`, `email`, `gender`, `user_type_id`, `department_id`, `isActive`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'Jessa', 'Mier', 'ronaldbesinga287@gmail.com', 2, 1, 3, 1),
(3, 'staff', '202cb962ac59075b964b07152d234b70', 'James', 'nadine', 'james@gmail.com', 1, 2, 3, 1),
(4, 'staff1', '4d7d719ac0cf3d78ea8a94701913fe47', 'James', 'Lakeon', 'james@gmail.com', 1, 2, 3, 1),
(5, 'cashier', '6ac2470ed8ccf204fd5ff89b32a355cf', 'awdjhawd', 'awdhawjk', 'awdjkawjkd@gmail.com', 1, 2, 5, 1),
(6, 'irene', '156044609eb527b3b743accc8e7b6d8a', 'Irene', 'Escauso', 'ireneescauso@gmail.com', 1, 2, 4, 1),
(7, 'mel21', '202cb962ac59075b964b07152d234b70', 'melanie', 'laguna', 'mel21@gmail.com', 2, 2, 6, 1),
(8, 'mark21', '202cb962ac59075b964b07152d234b70', 'mark', 'ampis', 'mark@gmail.com', 1, 2, 7, 1),
(9, 'juan21', 'bc59c07523e23c844a29f219a2c92e91', 'juan', 'hand', 'juan@gmail.com', 1, 2, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_types`
--

CREATE TABLE `tbl_user_types` (
  `user_type_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_types`
--

INSERT INTO `tbl_user_types` (`user_type_id`, `name`) VALUES
(1, 'admin'),
(2, 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `tbl_issuance_transaction`
--
ALTER TABLE `tbl_issuance_transaction`
  ADD PRIMARY KEY (`issuance_id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_item_stock`
--
ALTER TABLE `tbl_item_stock`
  ADD PRIMARY KEY (`item_stock_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_issuance_transaction`
--
ALTER TABLE `tbl_issuance_transaction`
  MODIFY `issuance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_item_stock`
--
ALTER TABLE `tbl_item_stock`
  MODIFY `item_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
