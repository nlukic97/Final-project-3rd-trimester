-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for hillingdonchippie
CREATE DATABASE IF NOT EXISTS `hillingdonchippie` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hillingdonchippie`;

-- Dumping structure for table hillingdonchippie.faq
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(10) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table hillingdonchippie.faq: ~4 rows (approximately)
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
	(1, 'Is your fish fresh?', 'Our fish is freshly frozen. This means that all fish which our suppliers catch are gutted and frozen within 4 minutes of them leaving the water.'),
	(2, ' Do you cook things other than fish?', 'Although we pride ourselves on our fish, we also make some terrific burgers !'),
	(3, 'How do I order?', 'Click on the "order" button in the top right corner of our website. Then, select your food. After that, click checkout, enter all your info and we will have your food prepared and delivered in no time !'),
	(4, 'Does your food contain any alergens?', 'Our non-fish products may contain traces of nuts.');
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;

-- Dumping structure for table hillingdonchippie.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `img` text,
  `price` float NOT NULL DEFAULT '0',
  `extras` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- Dumping data for table hillingdonchippie.items: ~9 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`id`, `title`, `img`, `price`, `extras`) VALUES
	(36, 'Large Cod', 'chippie-item-1597481104cod.jpg', 5.3, 'salt, vinager'),
	(37, 'Regular Cod', 'chippie-item-1597481120cod.jpg', 4.2, 'salt, vinager'),
	(38, 'Burger', 'chippie-item-1597481177burger.jpg', 6.85, 'cheese, onion, BH sauce, ketchup, BBQ sauce'),
	(39, 'Sausage in batter', 'chippie-item-1597481230sausage.jpg', 3, ''),
	(40, 'Large Chips', 'chippie-item-1597481264uk-chips.jpg', 3.5, 'salt, vinager'),
	(41, 'Regular Chips', 'chippie-item-1597481281uk-chips.jpg', 2.8, 'salt, vinager'),
	(42, 'Chicken Nuggets', 'chippie-item-1597481945nuggets.jpg', 4.2, 'mayonnaise, sour cream'),
	(43, 'Ketchup bottle', 'chippie-item-1597571634erik-mclean-l9x4U45VeNw-unsplash.jpg', 1.2, ''),
	(44, 'Fish \'n\' Chips', 'chippie-item-1597482131Fish,_chips_and_mushy_peas.jpg', 6.7, 'mushy peas, curry sauce');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table hillingdonchippie.item_order
CREATE TABLE IF NOT EXISTS `item_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `extras` text NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table hillingdonchippie.item_order: ~12 rows (approximately)
/*!40000 ALTER TABLE `item_order` DISABLE KEYS */;
INSERT INTO `item_order` (`id`, `order_id`, `title`, `extras`, `price`) VALUES
	(1, 1, 'Burger', 'onion, ketchup, BBQ sauce', 6.85),
	(2, 1, 'Large Chips', 'salt', 3.5),
	(3, 2, 'Burger', 'cheese', 6.85),
	(4, 2, 'Burger', 'cheese', 6.85),
	(5, 2, 'Burger', 'onion, BH sauce, ketchup, BBQ sauce', 6.85),
	(6, 2, 'Large Chips', 'salt', 3.5),
	(7, 2, 'Large Chips', 'salt, vinager', 3.5),
	(8, 2, 'Large Chips', 'vinager', 3.5),
	(9, 2, 'Ketchup bottle', '', 1.2),
	(10, 3, 'Large Cod', '', 5.3),
	(11, 4, 'Large Cod', 'vinager', 5.3),
	(12, 5, 'Large Cod', '', 5.3);
/*!40000 ALTER TABLE `item_order` ENABLE KEYS */;

-- Dumping structure for table hillingdonchippie.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table hillingdonchippie.orders: ~2 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `name`, `total`, `address`, `email`, `phone`, `date`, `time`) VALUES
	(1, 'Customer1', 10.35, 'Groove Drive 24, UX74AB London', 'cusomer1@example.com', '555333', '2020-08-17', '10:18:45'),
	(2, 'customer 2', 32.25, 'Customer2 Drive, 11120 Belgrade', 'cust2@example.com', '123456', '2020-08-17', '10:36:18'),
	(5, 'e', 5.3, 'e', 'e@e1111.com', '222', '2020-08-22', '06:32:47');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table hillingdonchippie.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- Dumping data for table hillingdonchippie.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
	(38, 'admin2', 'admin2@admin2.com', 'admin'),
	(41, 'admin', 'admin@admin.com', '$2a$10$2b9cacf0c2b508c472867u/t7G5tUuYCufA.1RyePl1FynFaRGtuK'),
	(43, 'admin3', 'admin3@email.com', '$2a$10$069c9555c5119b9753664OrlM2NMQSjYTH5vj/vSuHHksLVLxO7tK');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
