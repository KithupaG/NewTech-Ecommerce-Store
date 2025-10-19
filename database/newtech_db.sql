-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.38 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for newtech
CREATE DATABASE IF NOT EXISTS `newtech` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `newtech`;

-- Dumping structure for table newtech.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(50) DEFAULT NULL,
  `admin_pwd` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.admin: ~0 rows (approximately)
INSERT INTO `admin` (`admin_id`, `admin_user`, `admin_pwd`) VALUES
	(1, 'Admin1', '1234567');

-- Dumping structure for table newtech.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.brand: ~4 rows (approximately)
INSERT INTO `brand` (`id`, `name`) VALUES
	(1, 'Dell'),
	(2, 'MSI'),
	(3, 'Acer'),
	(4, 'Alienware'),
	(5, 'Chinese Abacus');

-- Dumping structure for table newtech.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantity` int DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `customer_id` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.cart: ~0 rows (approximately)
INSERT INTO `cart` (`id`, `quantity`, `added_at`, `customer_id`, `product_id`) VALUES
	(21, 1, '2025-05-28 17:30:31', 10, 1),
	(22, 1, '2025-09-22 09:43:33', 1, 2);

-- Dumping structure for table newtech.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.category: ~4 rows (approximately)
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Laptops & Desktop'),
	(2, 'Gaming Chairs'),
	(3, 'PC Components'),
	(4, 'Pheripals'),
	(5, 'Accessories');

-- Dumping structure for table newtech.color
CREATE TABLE IF NOT EXISTS `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.color: ~4 rows (approximately)
INSERT INTO `color` (`id`, `color`) VALUES
	(1, 'White'),
	(2, 'Blue'),
	(3, 'Black'),
	(4, 'Grey'),
	(5, 'Beige');

-- Dumping structure for table newtech.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` text,
  `created_at` timestamp NULL DEFAULT (now()),
  `customer_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`customer_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `commenter_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.comments: ~9 rows (approximately)
INSERT INTO `comments` (`id`, `comment`, `created_at`, `customer_id`, `product_id`) VALUES
	(2, 'Watup dawg', '2024-12-13 05:06:46', 2, 1),
	(3, 'Wass guddd', '2024-12-13 05:07:19', 3, 1),
	(4, 'Wass guuud ma nigga', '2024-12-13 05:32:01', 1, 1),
	(5, 'donkey', '2024-12-13 06:51:57', 1, 2),
	(6, 'This product is ASS, DONT BUY IT WHAT EVER YOU DO', '2024-12-13 16:10:40', 1, 1),
	(7, 'why isnt the rating systm working?', '2024-12-18 05:12:56', 1, 1),
	(8, 'BRO WTF', '2024-12-18 06:09:55', 1, 2),
	(11, 'Bruh', '2025-01-06 04:45:49', 1, 2),
	(12, 'Watup nigga', '2025-05-28 11:59:34', 1, 1),
	(13, 'Watup nigga', '2025-05-28 11:59:38', 1, 1);

-- Dumping structure for table newtech.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.condition: ~2 rows (approximately)
INSERT INTO `condition` (`id`, `name`) VALUES
	(1, 'Used'),
	(2, 'New'),
	(3, 'Not Specified');

-- Dumping structure for table newtech.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `joined` datetime DEFAULT NULL,
  `verification` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `district` int DEFAULT NULL,
  `province` int DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile` (`mobile`),
  KEY `FK_customer_districts` (`district`),
  KEY `FK_customer_provinces` (`province`),
  CONSTRAINT `FK_customer_districts` FOREIGN KEY (`district`) REFERENCES `districts` (`id`),
  CONSTRAINT `FK_customer_provinces` FOREIGN KEY (`province`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.customer: ~10 rows (approximately)
INSERT INTO `customer` (`id`, `fname`, `lname`, `pwd`, `email`, `mobile`, `joined`, `verification`, `profile_picture`, `district`, `province`, `street_address`) VALUES
	(1, 'Kithupa', 'Gajanayake', '012345678', 'gkithupa@gmail.com', '0714554466', '2024-11-22 22:36:22', '68ca71', 'uploads/profile_pictures/679cd988a0219_aesthetic.jpg', NULL, NULL, NULL),
	(2, 'Kithupa', 'Gajanayake', '12345678', 'kithupagajanayake77@gmail.com', '0714554336', '2024-11-22 23:22:41', '676259', NULL, NULL, NULL, NULL),
	(3, 'Nimesha', 'Jayawickrama', '123456', 'gkithupag@gmail.com', '0714800105', '2024-11-26 08:25:00', NULL, NULL, NULL, NULL, NULL),
	(4, 'Nimesha', 'Jayawickrama', '12345678', 'gkithupai@gmail.com', '0724800104', '2024-11-26 08:33:55', NULL, NULL, NULL, NULL, NULL),
	(5, 'Nimesha', 'Jayawickrama', '12345678', 'gkithupalo@gmail.com', '0714800107', '2024-11-26 10:39:36', NULL, NULL, NULL, NULL, NULL),
	(6, 'Nimesha', 'Jayawickrama', '12345678', 'gkithupaertet@gmail.com', '0714800101', '2024-11-26 17:24:55', NULL, NULL, NULL, NULL, NULL),
	(7, 'Nimesha', 'Jayawickrama', '12345678', 'hesara@gmail.com', '0714800110', '2024-12-11 10:22:35', NULL, NULL, NULL, NULL, NULL),
	(8, 'Kithupa', 'Trenation', '123456789', 'donkey@gmail.com', '0714800109', '2025-02-01 17:02:20', NULL, NULL, NULL, NULL, '447/4 Lake Rd, Akuregoda, Thalangama South'),
	(9, 'Nim', 'Ja', 'qwerty', 'gikithupa@gmail.com', '0714809988', '2025-03-31 16:45:26', NULL, NULL, NULL, NULL, '447/4 Lake Rd, Akuregoda, Thalangama South'),
	(10, 'Kithupa', 'Gajanayake', 'Root@123!', 'tit@gmail.com', '0714554400', '2025-05-28 17:26:50', NULL, 'uploads/profile_pictures/6836fafa42d47_onlyfans-logo-15228.svg', NULL, NULL, '447/4 Lake Rd, Akuregoda, Thalangama South');

-- Dumping structure for table newtech.districts
CREATE TABLE IF NOT EXISTS `districts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.districts: ~0 rows (approximately)
INSERT INTO `districts` (`id`, `district_name`) VALUES
	(1, 'Colombo');

-- Dumping structure for table newtech.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.password_resets: ~17 rows (approximately)
INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expires_at`) VALUES
	(4, 1, '70156e3aeab0e8d1c2cf92ce703fc1c4', '2025-01-31 16:09:14'),
	(5, 1, 'd842c0737849069aba7b1b67af400825', '2025-01-31 16:09:20'),
	(6, 1, 'cd82d0fc181c7efada312f3cd6c3650f', '2025-01-31 16:09:23'),
	(7, 1, 'efdbbffa916f12b439458a395e429f9a', '2025-01-31 16:09:27'),
	(8, 1, 'dc89dc417b204450e596b0ef6fa9bb6f', '2025-01-31 16:09:32'),
	(9, 1, '5939f01fb47c370d9975ecb8c6c1b8a1', '2025-01-31 16:09:41'),
	(10, 1, 'f1372eba8fb0daabe0dfdb72d260c557', '2025-01-31 16:09:45'),
	(11, 1, 'b6342aa8d3ce06980be990664eb6a9ae', '2025-01-31 16:14:37'),
	(12, 1, 'f09e2f9630836ca77cd995fe983a22d2', '2025-01-31 16:15:19'),
	(13, 1, '2eb4de82a660f6d9d9e779e51ea475a0', '2025-01-31 16:16:07'),
	(14, 1, '1f7441bf967d8a2213c424998e2384d8', '2025-01-31 16:16:53'),
	(15, 1, '0af26c16d564956276dca85e9bd12759', '2025-01-31 16:22:19'),
	(17, 1, '20b10f2d5c40959a0d0e4ab8070cc554', '2025-02-01 04:35:42'),
	(20, 1, '8fc2ca1b5c1b639223eae905083c7a0a', '2025-02-01 05:27:51'),
	(21, 1, '34d7d6ef92458d7222a821387a99817f', '2025-02-01 05:31:26'),
	(22, 1, '20a425cad4c37dc2b1c2dcbd366a83bc', '2025-02-01 05:32:05'),
	(23, 1, '123', '2025-02-01 09:10:56');

-- Dumping structure for table newtech.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `quantity` int DEFAULT NULL,
  `price` decimal(20,6) DEFAULT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image_url1` varchar(255) DEFAULT NULL,
  `image_url2` varchar(255) DEFAULT NULL,
  `image_url3` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `brands_id` int DEFAULT NULL,
  `condition_id` int DEFAULT NULL,
  `warranty_time` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `seller_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category_id`),
  KEY `brands` (`brands_id`),
  KEY `condition` (`condition_id`),
  KEY `warranty` (`warranty_time`),
  KEY `seller` (`seller_id`) USING BTREE,
  CONSTRAINT `brands` FOREIGN KEY (`brands_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `condition` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `seller` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`),
  CONSTRAINT `warranty` FOREIGN KEY (`warranty_time`) REFERENCES `warranty` (`warranty_time`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.products: ~7 rows (approximately)
INSERT INTO `products` (`id`, `name`, `description`, `quantity`, `price`, `image_url`, `image_url1`, `image_url2`, `image_url3`, `category_id`, `brands_id`, `condition_id`, `warranty_time`, `created`, `seller_id`) VALUES
	(1, 'Laptop\r\n', 'A laptop', 1, 340.000000, '', NULL, NULL, NULL, 1, 1, 2, '3 months', '2024-11-21 19:45:00', 1),
	(2, 'mobile', 'mobile', 17, 2345.000000, '', NULL, NULL, NULL, 5, 5, 1, '5 years', '2024-11-21 19:45:01', 1),
	(3, 'Mouse', 'A mouse', 10, 100.000000, '', NULL, NULL, NULL, 4, 4, 2, '1 year', '2024-12-03 17:04:59', 1),
	(4, 'Table', 'Table', 12, 120000.000000, '1758263042_UselassDiagram.png', '1758263042_UMLUseCaseAeroDesk.png', '1758263042_hehe.jpg', '1758263042_red hornet.jpg', 5, 5, 1, '6 months', '2024-12-03 17:08:33', 1),
	(15, 'Magenta Headset', 'Magenta Headset', 12, 12000.000000, '', '', '', '', 5, 5, 2, '6 months', '2025-09-19 11:19:19', 1),
	(16, 'Magenta Headset', 'Magenta Headset', 12, 12311313.000000, '68ccf0fb4db629.23823812_2024-Lamborghini-Huracan-Sterrato-007-1080.jpg', '68ccf0fb4f1b23.36070881_2024-Lamborghini-Huracan-Sterrato-010-1080.jpg', '68ccf0fb4f8ee7.90305148_wp11269289-f1-racing-2022-wallpapers.jpg', '68ccf0fb4ff442.73583371_wp12443415-f1-black-wallpapers.jpg', 5, 4, 3, '6 months', '2025-09-19 11:28:19', 1),
	(17, 'Puncher', '12312313', 123, 4000.000000, '68ccf1e35f5c29.20572454_timmie-ahl-p6xE80b4K1c-unsplash.jpg', '68ccf1e35fa9e1.14193804_765LT-engagement-banner-1920x1050-1_crop-16x9.png', '68ccf1e35fdfa6.81388042_765LT-engagement-banner-1920x1050-1_crop-16x9.png', '68ccf1e3605ab9.35395443_wp12443415-f1-black-wallpapers.jpg', 5, 4, 1, '5 years', '2025-09-19 11:32:11', 1);

-- Dumping structure for table newtech.provinces
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.provinces: ~0 rows (approximately)
INSERT INTO `provinces` (`id`, `province_name`) VALUES
	(1, 'Sabaragamuwa');

-- Dumping structure for table newtech.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `customer_email` varchar(50) DEFAULT NULL,
  `total_value` double DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `seller_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_purchases_products` (`product_id`),
  KEY `FK_purchases_customer` (`customer_email`),
  KEY `FK_purchases_seller` (`seller_id`),
  CONSTRAINT `FK_purchases_customer` FOREIGN KEY (`customer_email`) REFERENCES `customer` (`email`),
  CONSTRAINT `FK_purchases_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_purchases_seller` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.purchases: ~2 rows (approximately)
INSERT INTO `purchases` (`id`, `product_id`, `customer_email`, `total_value`, `transaction_date`, `seller_id`) VALUES
	(1, 1, 'gkithupa@gmail.com', 400000, '2025-09-16 14:43:27', 1),
	(2, 4, 'kithupagajanayake77@gmail.com', 60000, '2025-09-16 14:43:46', 1);

-- Dumping structure for table newtech.ratings
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rating` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT (now()),
  `productssss_id` int NOT NULL,
  `customer_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productssss_id` (`productssss_id`,`customer_id`) USING BTREE,
  KEY `customer_id` (`customer_id`),
  KEY `productsssss_id` (`productssss_id`),
  CONSTRAINT `customers_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `productsssss_id` FOREIGN KEY (`productssss_id`) REFERENCES `products` (`id`),
  CONSTRAINT `ratings_chk_1` CHECK ((`rating` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.ratings: ~3 rows (approximately)
INSERT INTO `ratings` (`id`, `rating`, `created_at`, `productssss_id`, `customer_id`) VALUES
	(28, 5, '2024-12-18 05:59:55', 1, 2),
	(30, 2, '2024-12-18 06:05:49', 2, 1),
	(36, 3, '2025-01-30 16:14:50', 1, 1),
	(37, 3, '2025-05-28 11:59:20', 1, 10);

-- Dumping structure for table newtech.seller
CREATE TABLE IF NOT EXISTS `seller` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `joined` datetime DEFAULT NULL,
  `verification` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `district` int DEFAULT NULL,
  `province` int DEFAULT NULL,
  `street_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_seller_districts` (`district`),
  KEY `FK_seller_provinces` (`province`),
  CONSTRAINT `FK_seller_districts` FOREIGN KEY (`district`) REFERENCES `districts` (`id`),
  CONSTRAINT `FK_seller_provinces` FOREIGN KEY (`province`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.seller: ~1 rows (approximately)
INSERT INTO `seller` (`id`, `fname`, `lname`, `email`, `pwd`, `mobile`, `joined`, `verification`, `district`, `province`, `street_address`) VALUES
	(1, 'Seller no1', 'Seller surname', 'seller@gmail.com', '123456', '0714800104', '2025-09-17 14:06:38', NULL, 1, 1, '447/4 Lake Rd, Akuregoda, Thalangama South');

-- Dumping structure for table newtech.vouchers
CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `voucher_code` varchar(50) DEFAULT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `voucher_code` (`voucher_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.vouchers: ~0 rows (approximately)
INSERT INTO `vouchers` (`id`, `voucher_code`, `discount_percentage`, `created_at`, `updated_at`) VALUES
	(1, 'DONKEY', 15.00, '2024-12-22 15:26:23', '2024-12-22 15:26:23');

-- Dumping structure for table newtech.warranty
CREATE TABLE IF NOT EXISTS `warranty` (
  `warranty_time` varchar(50) NOT NULL,
  PRIMARY KEY (`warranty_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.warranty: ~8 rows (approximately)
INSERT INTO `warranty` (`warranty_time`) VALUES
	('1 month'),
	('1 year'),
	('2 years'),
	('3 months'),
	('3 years'),
	('4 years'),
	('5 years'),
	('6 months');

-- Dumping structure for table newtech.wishlists
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `seller_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_wishlists_seller` (`seller_id`),
  KEY `FK_wishlists_customer` (`user_id`),
  KEY `FK_wishlists_products` (`product_id`),
  CONSTRAINT `FK_wishlists_customer` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `FK_wishlists_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_wishlists_seller` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table newtech.wishlists: ~2 rows (approximately)
INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `seller_id`) VALUES
	(32, 2, 1, '2024-12-09 13:58:36', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
