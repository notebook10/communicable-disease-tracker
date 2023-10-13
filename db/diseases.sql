-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table communicable_disease_db.diseases
CREATE TABLE IF NOT EXISTS `diseases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `disease` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table communicable_disease_db.diseases: ~7 rows (approximately)
INSERT INTO `diseases` (`id`, `disease`, `created_at`) VALUES
	(2, 'disaease 1', '2023-10-13 17:57:50'),
	(3, 'disaease 2', '2023-10-13 17:58:18'),
	(4, 'disaease 4', '2023-10-13 17:58:32'),
	(5, 'disaease 5', '2023-10-13 17:58:42'),
	(6, 'disaease 6', '2023-10-13 17:58:53'),
	(7, 'disaease 7', '2023-10-13 18:03:16'),
	(8, 'disaease 8', '2023-10-13 18:07:17');

-- Dumping structure for table communicable_disease_db.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table communicable_disease_db.locations: ~7 rows (approximately)
INSERT INTO `locations` (`id`, `location`, `created_at`) VALUES
	(1, 'test', '2023-10-13 00:00:00'),
	(2, 'loca 2', '2023-10-13 17:48:48'),
	(3, 'loc 3', '2023-10-13 17:48:54'),
	(4, 'fourth', '2023-10-13 17:56:22'),
	(5, 'fifth', '2023-10-13 17:56:22'),
	(6, 'ikaanim', '2023-10-13 17:56:53'),
	(7, 'seven', '2023-10-13 17:57:50');

-- Dumping structure for table communicable_disease_db.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location_id` int NOT NULL,
  `disease_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table communicable_disease_db.posts: ~3 rows (approximately)
INSERT INTO `posts` (`id`, `location_id`, `disease_id`, `user_id`, `date`, `time`, `created_at`) VALUES
	(2, 2, 8, 3, '2023-10-13', '1:00 pm', '2023-10-13 18:29:33'),
	(5, 1, 2, 3, '2023-10-13', '2:00 pm', '2023-10-13 20:31:29'),
	(6, 7, 7, 3, '2023-10-13', '7:00 pm', '2023-10-13 20:46:10');

-- Dumping structure for table communicable_disease_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table communicable_disease_db.users: ~7 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `created_at`) VALUES
	(2, 'Admin admin', 'admin@mail.com', '$2y$10$uPbNrqNCMlM04.xs64vioOwaJsoD2pmRcg66sYum.3gyFTdUm4pNy', 1, '2023-10-13 16:34:29'),
	(3, 'User user', 'user@mail.com', '$2y$10$uPbNrqNCMlM04.xs64vioOwaJsoD2pmRcg66sYum.3gyFTdUm4pNy', 0, '2023-10-13 16:35:20'),
	(6, 'test kiko', 'kiko@mail.com', '$2y$10$uPbNrqNCMlM04.xs64vioOwaJsoD2pmRcg66sYum.3gyFTdUm4pNy', 0, '2023-10-13 17:14:01'),
	(8, 'kiko kiko ', 'test@mmmm.com', '$2y$10$uPbNrqNCMlM04.xs64vioOwaJsoD2pmRcg66sYum.3gyFTdUm4pNy', 0, '2023-10-13 17:15:22'),
	(9, 'test create', 'admin@admion.com', '$2y$10$R0khuSHTAadzJI97XjhrQuJ1OnLGOxmn5rMSu1PWaKLha7ZNxXoVm', 1, '2023-10-13 20:37:47'),
	(11, 'kikoadmin', 'test@test.com', '$2y$10$GcFTwJn8iIUchXXbhL2snOzmgU0RLt67n3usEU6fTtEuf6uSpc48u', 0, '2023-10-13 20:40:30'),
	(12, 'test create part 2', 'create@mail.com', '$2y$10$NNiTKgRmgNd4gIaGOhQXqebxCpt3FQT/QMnGzL/RGK9dt/yqrsrma', 0, '2023-10-13 20:45:06');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
