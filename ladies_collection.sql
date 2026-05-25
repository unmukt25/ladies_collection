-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2026 at 08:51 PM
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
-- Database: `ladies_collection`
--

-- --------------------------------------------------------

--
-- Table structure for table `dresses`
--

CREATE TABLE `dresses` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `cat` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 0.0,
  `reviews` int(11) DEFAULT 0,
  `badge` varchar(50) DEFAULT '',
  `style` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`style`)),
  `colors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`colors`)),
  `sizes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sizes`)),
  `img` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dresses`
--

INSERT INTO `dresses` (`id`, `product_name`, `cat`, `price`, `old_price`, `rating`, `reviews`, `badge`, `style`, `colors`, `sizes`, `img`, `created_at`, `updated_at`) VALUES
(1, 'Aurora Floral Midi', 'Casual', 2499.00, 3299.00, 4.7, 238, 'New', '[\"Floral\",\"Printed\"]', '[\"#e8c4b8\",\"#8ab89a\",\"#fff\"]', '[\"XS\",\"S\",\"M\",\"L\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(2, 'Velvet Noir Evening Gown', 'Evening', 8999.00, NULL, 4.9, 87, '', '[\"Solid\"]', '[\"#2e2622\",\"#6a8caf\"]', '[\"S\",\"M\",\"L\",\"XL\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(3, 'Ivory Lace Bridal Gown', 'Bridal', 14500.00, NULL, 5.0, 42, '', '[\"Embroidered\"]', '[\"#fff\",\"#e8c4b8\"]', '[\"XS\",\"S\",\"M\",\"L\",\"XL\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(4, 'Rose Petal Wrap Dress', 'Casual', 1899.00, 2499.00, 4.4, 312, 'Sale', '[\"Solid\"]', '[\"#c9716a\",\"#e8c4b8\"]', '[\"XS\",\"S\",\"M\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(5, 'Cobalt Sequin Mini', 'Party', 4299.00, 5499.00, 4.6, 154, 'Sale', '[\"Floral\",\"Printed\"]', '[\"#6a8caf\",\"#2e2622\"]', '[\"S\",\"M\",\"L\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(6, 'Sage Linen Sundress', 'Casual', 1599.00, NULL, 4.3, 426, 'New', '[\"Solid\"]', '[\"#8ab89a\",\"#c8a96e\"]', '[\"XS\",\"S\",\"M\",\"L\",\"XL\",\"XXL\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(7, 'Champagne Off-Shoulder', 'Evening', 6799.00, 8200.00, 4.8, 99, '', '[\"Printed\"]', '[\"#c8a96e\",\"#fff\"]', '[\"S\",\"M\",\"L\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(8, 'Oxford Pencil Dress', 'Office', 3199.00, NULL, 4.5, 203, '', '[\"Floral\",\"Printed\"]', '[\"#2e2622\",\"#7a5c52\",\"#6a8caf\"]', '[\"XS\",\"S\",\"M\",\"L\",\"XL\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(9, 'Fuchsia Ruffle Maxi', 'Party', 3799.00, NULL, 4.2, 67, 'New', '[\"Solid\"]', '[\"#c9716a\",\"#e8c4b8\",\"#fff\"]', '[\"S\",\"M\",\"L\",\"XL\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(10, 'Pearl Embroidered Kurta', 'Casual', 2799.00, 3400.00, 4.6, 511, 'Sale', '[\"Solid\"]', '[\"#fff\",\"#c8a96e\",\"#e8c4b8\"]', '[\"XS\",\"S\",\"M\",\"L\",\"XL\",\"XXL\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(11, 'Midnight Halter Gown', 'Evening', 11200.00, 13500.00, 4.9, 58, '', '[\"Solid\"]', '[\"#2e2622\"]', '[\"S\",\"M\",\"L\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28'),
(12, 'Blush Satin A-Line', 'Bridal', 12800.00, NULL, 4.8, 34, 'New', '[\"Solid\"]', '[\"#e8c4b8\",\"#fff\"]', '[\"XS\",\"S\",\"M\",\"L\"]', 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75', '2026-05-23 14:37:28', '2026-05-23 14:37:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dresses`
--
ALTER TABLE `dresses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dresses`
--
ALTER TABLE `dresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
