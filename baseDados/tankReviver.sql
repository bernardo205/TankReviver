-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.0.35 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para main
CREATE DATABASE IF NOT EXISTS `main` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `main`;

-- A despejar estrutura para tabela main.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela main.admin: ~3 rows (aproximadamente)
INSERT INTO `admin` (`id`, `username`, `password`, `email`, `created_at`) VALUES
	(1, 'admin1', 'senha_admin1', 'admin1@tankrevive.com', '2024-01-07 23:51:00'),
	(2, 'admin2', 'senha_admin2', 'admin2@tankrevive.com', '2024-01-07 23:51:00'),
	(3, 'admin3', 'senha_admin3', 'admin3@tankrevive.com', '2024-01-07 23:51:00');

-- A despejar estrutura para tabela main.caliber_type
CREATE TABLE IF NOT EXISTS `caliber_type` (
  `Caliber_Id` int NOT NULL AUTO_INCREMENT,
  `Caliber` varchar(20) NOT NULL,
  PRIMARY KEY (`Caliber_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela main.caliber_type: ~23 rows (aproximadamente)
INSERT INTO `caliber_type` (`Caliber_Id`, `Caliber`) VALUES
	(1, '88mm'),
	(2, '75mm'),
	(3, '128mm'),
	(4, '150mm'),
	(5, '47mm'),
	(6, '37mm'),
	(7, '7.92mm'),
	(8, '20mm'),
	(9, '50mm'),
	(10, '380mm'),
	(11, '85mm'),
	(12, '122mm'),
	(13, '152mm'),
	(14, '100mm'),
	(15, '90mm'),
	(16, '76,2mm'),
	(17, '7.62mm'),
	(18, '12.7mm'),
	(19, '77mm'),
	(20, '40mm'),
	(21, '45mm'),
	(22, '57mm'),
	(23, '15mm');

-- A despejar estrutura para tabela main.carrinho
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tank_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela main.carrinho: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela main.compra
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) NOT NULL DEFAULT '0',
  `Tank_name` varchar(50) NOT NULL DEFAULT '0',
  `date` varchar(50) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT '0',
  `sale_price` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela main.compra: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela main.country_type
CREATE TABLE IF NOT EXISTS `country_type` (
  `Country_Id` int NOT NULL AUTO_INCREMENT,
  `Country` varchar(20) NOT NULL,
  PRIMARY KEY (`Country_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela main.country_type: ~4 rows (aproximadamente)
INSERT INTO `country_type` (`Country_Id`, `Country`) VALUES
	(1, 'Germany'),
	(2, 'USSR'),
	(3, 'USA'),
	(4, 'UK');

-- A despejar estrutura para tabela main.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `Customer_Id` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Phone_Number` int NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Zipcode` varchar(10) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Customer_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela main.customer: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela main.fuel_type
CREATE TABLE IF NOT EXISTS `fuel_type` (
  `Fuel_Id` int NOT NULL AUTO_INCREMENT,
  `Fuel` varchar(20) NOT NULL,
  PRIMARY KEY (`Fuel_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela main.fuel_type: ~2 rows (aproximadamente)
INSERT INTO `fuel_type` (`Fuel_Id`, `Fuel`) VALUES
	(1, 'Gasoline'),
	(2, 'Diesel');

-- A despejar estrutura para tabela main.main_tr
CREATE TABLE IF NOT EXISTS `main_tr` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Tank_Name` varchar(50) NOT NULL,
  `Country_Id` int NOT NULL,
  `Production_Start` int NOT NULL,
  `Production_End` int NOT NULL,
  `Numbers_Made` int NOT NULL,
  `Crew` int NOT NULL,
  `Horsepower` int NOT NULL,
  `Mass` int NOT NULL,
  `Power_to_Weight` float NOT NULL,
  `Max_Speed` int NOT NULL,
  `Fuel_Id` int NOT NULL,
  `Elevation` int NOT NULL,
  `Depression` float NOT NULL,
  `Range_km` int NOT NULL,
  `Tank_Id` int NOT NULL,
  `Hull_Armor` int NOT NULL,
  `Turret_Armor` int NOT NULL,
  `Armor_Penetration` int NOT NULL,
  `Caliber_Id` int NOT NULL,
  `Price` int DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Country_Id` (`Country_Id`),
  KEY `Fuel_Id` (`Fuel_Id`),
  KEY `Tank_Id` (`Tank_Id`),
  KEY `Caliber_Id` (`Caliber_Id`),
  CONSTRAINT `main_tr_ibfk_1` FOREIGN KEY (`Country_Id`) REFERENCES `country_type` (`Country_Id`) ON DELETE CASCADE,
  CONSTRAINT `main_tr_ibfk_2` FOREIGN KEY (`Fuel_Id`) REFERENCES `fuel_type` (`Fuel_Id`) ON DELETE CASCADE,
  CONSTRAINT `main_tr_ibfk_3` FOREIGN KEY (`Tank_Id`) REFERENCES `tank_type` (`Tank_Id`) ON DELETE CASCADE,
  CONSTRAINT `main_tr_ibfk_4` FOREIGN KEY (`Caliber_Id`) REFERENCES `caliber_type` (`Caliber_Id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela main.main_tr: ~142 rows (aproximadamente)
INSERT INTO `main_tr` (`Id`, `Tank_Name`, `Country_Id`, `Production_Start`, `Production_End`, `Numbers_Made`, `Crew`, `Horsepower`, `Mass`, `Power_to_Weight`, `Max_Speed`, `Fuel_Id`, `Elevation`, `Depression`, `Range_km`, `Tank_Id`, `Hull_Armor`, `Turret_Armor`, `Armor_Penetration`, `Caliber_Id`, `Price`) VALUES
	(1, 'Brummbar', 1, 1943, 1945, 306, 5, 300, 28200, 10.6, 38, 1, 30, 5, 210, 4, 60, 130, 61, 4, 100000),
	(2, 'Elefant', 1, 1943, 1943, 90, 6, 600, 65000, 9.2, 30, 1, 14, 8, 150, 4, 105, 210, 237, 1, 120000),
	(3, 'Hetzer', 1, 1944, 1945, 2584, 4, 158, 15750, 10, 42, 1, 12, 6, 178, 4, 78, 12, 145, 2, 80000),
	(4, 'Jagdpanther', 1, 1944, 1945, 392, 5, 700, 45500, 15.4, 55, 1, 14, 8, 250, 4, 104, 139, 237, 1, 150000),
	(5, 'Jagdpanzer IV', 1, 1944, 1944, 769, 4, 300, 24000, 12.5, 40, 1, 15, 5, 210, 4, 87, 93, 145, 2, 90000),
	(6, 'Jagdtiger', 1, 1944, 1945, 77, 6, 700, 71700, 9.8, 38, 1, 15, 7.5, 170, 4, 225, 280, 252, 3, 180000),
	(7, 'Marder II', 1, 1943, 1944, 651, 3, 140, 10800, 12.9, 40, 1, 10, 8, 190, 4, 38, 31, 135, 2, 60000),
	(8, 'Marder III', 1, 1943, 1944, 975, 4, 150, 10500, 14.2, 42, 1, 13, 5, 190, 4, 16, 11, 143, 2, 70000),
	(9, 'Maus', 1, 1944, 1944, 2, 6, 895, 188000, 12.2, 22, 1, 23, 7, 160, 5, 260, 232, 240, 3, 250000),
	(10, 'Nashorn', 1, 1943, 1945, 494, 4, 300, 24000, 12.5, 40, 1, 20, 5, 200, 4, 34, 15, 237, 1, 110000),
	(11, 'Panther Ausf. A', 1, 1943, 1944, 2000, 5, 700, 44800, 15.5, 55, 1, 18, 8, 250, 2, 104, 110, 192, 2, 130000),
	(12, 'Panther Ausf. D', 1, 1943, 1943, 850, 5, 700, 44800, 15.5, 55, 1, 18, 8, 250, 2, 104, 100, 192, 2, 140000),
	(13, 'Panther Ausf. G', 1, 1944, 1945, 3126, 5, 700, 45500, 15.4, 55, 1, 18, 8, 250, 2, 104, 112, 192, 2, 150000),
	(14, 'Panzer IV70(A)', 1, 1944, 1945, 278, 4, 300, 28000, 10.7, 38, 1, 15, 5, 320, 4, 100, 120, 192, 2, 90000),
	(15, 'Panzer IV70(V)', 1, 1944, 1945, 278, 4, 300, 28000, 10.7, 38, 1, 15, 5, 320, 4, 100, 120, 192, 2, 95000),
	(16, 'Panzerjäger 38(t)', 1, 1942, 1942, 363, 4, 140, 10700, 13.1, 42, 1, 25, 14, 185, 4, 52, 52, 133, 2, 65000),
	(17, 'Panzerjäger I', 1, 1940, 1941, 202, 3, 100, 6400, 15.6, 40, 1, 12, 8, 140, 4, 14, 16, 87, 5, 50000),
	(18, 'PzKpfw 35(t)', 1, 1935, 1938, 219, 4, 120, 10500, 11.4, 35, 1, 25, 10, 190, 1, 25, 25, 55, 7, 55000),
	(19, 'PzKpfw 38(t) Ausf. A', 1, 1939, 1939, 150, 4, 125, 9400, 13.3, 42, 1, 25, 10, 230, 1, 30, 25, 62, 7, 60000),
	(20, 'PzKpfw 38(t) Ausf. E', 1, 1940, 1941, 275, 4, 125, 9850, 12.7, 42, 1, 25, 10, 230, 1, 50, 50, 62, 7, 62000),
	(21, 'PzKpfw 38(t) nA', 1, 1942, 1942, 15, 4, 250, 14800, 16.9, 62, 1, 25, 10, 200, 1, 35, 50, 62, 7, 58000),
	(22, 'PzKpfw I Ausf. A', 1, 1934, 1936, 818, 2, 57, 5400, 10.6, 37, 1, 18, 12, 145, 1, 14, 13, 15, 7, 50000),
	(23, 'PzKpfw I Ausf. B', 1, 1935, 1937, 675, 2, 100, 5800, 17.2, 40, 1, 18, 12, 145, 1, 14, 13, 16, 7, 52000),
	(24, 'PzKpfw I Ausf. C', 1, 1942, 1942, 40, 2, 150, 8000, 18.8, 79, 1, 20, 10, 300, 1, 32, 30, 24, 7, 53000),
	(25, 'PzKpfw I Ausf. F', 1, 1942, 1942, 40, 2, 150, 8000, 18.8, 79, 1, 10, 20, 300, 1, 31, 30, 16, 7, 55000),
	(26, 'PzKpfw II Ausf. C', 1, 1937, 1940, 1113, 3, 140, 8900, 15.7, 40, 1, 20, 9, 200, 1, 15, 20, 48, 8, 60000),
	(27, 'PzKpfw II Ausf. F', 1, 1941, 1942, 524, 3, 140, 9500, 14.7, 40, 1, 20, 9.5, 200, 1, 35, 30, 48, 8, 62000),
	(28, 'PzKpfw II Ausf. L', 1, 1943, 1944, 104, 4, 180, 1300, 13.8, 60, 1, 18, 9, 250, 1, 32, 30, 48, 8, 64000),
	(29, 'PzKpfw III Ausf. F', 1, 1939, 1940, 435, 5, 300, 19500, 15.4, 40, 1, 20, 10, 165, 2, 32, 31, 80, 9, 70000),
	(30, 'PzKpfw III Ausf. G', 1, 1940, 1941, 600, 5, 300, 19500, 15.4, 40, 1, 20, 10, 165, 2, 32, 33, 80, 9, 75000),
	(31, 'PzKpfw III Ausf. H', 1, 1940, 1941, 308, 5, 300, 21600, 13.9, 40, 1, 20, 10, 165, 2, 65, 60, 80, 9, 78000),
	(32, 'PzKpfw III Ausf. J', 1, 1941, 1942, 1549, 5, 300, 21500, 14, 40, 1, 20, 10, 145, 2, 53, 55, 80, 9, 80000),
	(33, 'PzKpfw III Ausf. L', 1, 1942, 1942, 653, 5, 300, 21300, 14, 40, 1, 20, 10, 155, 2, 53, 70, 106, 9, 82000),
	(34, 'PzKpfw III Ausf. M', 1, 1942, 1943, 250, 5, 300, 22700, 13.2, 40, 1, 20, 10, 155, 2, 53, 73, 106, 9, 85000),
	(35, 'PzKpfw III Ausf. N', 1, 1942, 1943, 663, 5, 300, 2300, 13, 40, 1, 20, 8, 155, 2, 53, 73, 41, 2, 88000),
	(36, 'PzKpfw IV Ausf. A', 1, 1937, 1938, 35, 5, 250, 18400, 13.6, 31, 1, 30, 10, 150, 2, 15, 15, 52, 2, 90000),
	(37, 'PzKpfw IV Ausf. C', 1, 1938, 1939, 134, 5, 300, 19000, 15.8, 40, 1, 20, 10, 200, 2, 31, 30, 52, 2, 92000),
	(38, 'PzKpfw IV Ausf. D', 1, 1939, 1941, 229, 5, 300, 20000, 15, 42, 1, 20, 8, 200, 2, 31, 30, 52, 2, 95000),
	(39, 'PzKpfw IV Ausf. F', 1, 1941, 1942, 462, 5, 300, 22300, 13.5, 42, 1, 20, 8, 200, 2, 51, 51, 54, 2, 98000),
	(40, 'PzKpfw IV Ausf. F2', 1, 1942, 1942, 200, 5, 300, 23000, 11.3, 40, 1, 20, 8, 210, 2, 51, 51, 137, 2, 100000),
	(41, 'PzKpfw IV Ausf. G', 1, 1942, 1943, 1687, 5, 300, 23500, 11.3, 40, 1, 20, 8, 210, 2, 80, 50, 137, 2, 105000),
	(42, 'PzKpfw IV Ausf. H', 1, 1943, 1944, 3774, 5, 300, 26000, 11.5, 38, 1, 20, 8, 210, 2, 80, 50, 145, 2, 110000),
	(43, 'PzKpfw IV Ausf. J', 1, 1944, 1945, 1758, 5, 300, 25000, 11.5, 38, 1, 20, 8, 320, 2, 80, 80, 145, 2, 115000),
	(44, 'StuG III Ausf. A', 1, 1940, 1940, 30, 4, 300, 19600, 15.3, 30, 1, 20, 10, 160, 4, 53, 51, 54, 2, 95000),
	(45, 'StuG III Ausf. B', 1, 1940, 1941, 320, 4, 300, 2200, 13.6, 40, 1, 20, 10, 165, 4, 53, 51, 54, 2, 97000),
	(46, 'StuG III Ausf. D', 1, 1941, 1941, 150, 4, 300, 20200, 13.6, 40, 1, 20, 10, 165, 4, 53, 51, 54, 2, 100000),
	(47, 'StuG III Ausf. E', 1, 1941, 1942, 272, 4, 300, 20800, 14.4, 40, 1, 20, 10, 165, 4, 53, 51, 54, 2, 105000),
	(48, 'StuG III Ausf. F', 1, 1942, 1042, 359, 4, 300, 21600, 12.3, 40, 1, 20, 6, 165, 4, 44, 50, 137, 2, 110000),
	(49, 'StuG III Ausf. G', 1, 1942, 1945, 7893, 4, 300, 23900, 12.6, 40, 1, 20, 6, 155, 4, 90, 80, 145, 2, 115000),
	(50, 'StuG IV', 1, 1943, 1945, 1139, 4, 300, 23000, 13, 38, 1, 20, 6, 210, 4, 82, 81, 70, 2, 120000),
	(51, 'Sturmtiger', 1, 0, 1944, 18, 5, 700, 65000, 10.8, 40, 1, 85, 0, 120, 4, 165, 212, 83, 10, 200000),
	(52, 'Tiger I', 1, 1942, 1944, 1354, 5, 690, 57000, 12.1, 38, 1, 17, 6.5, 140, 3, 105, 120, 165, 1, 160000),
	(53, 'Tiger II', 1, 1944, 1945, 489, 5, 700, 70000, 10, 42, 1, 15, 7.4, 170, 3, 200, 185, 237, 1, 180000),
	(54, 'BT-2 Model 1932', 2, 1931, 1932, 300, 3, 400, 11000, 36.4, 52, 1, 40, 4, 150, 1, 13, 13, 64, 6, 30000),
	(55, 'BT-5 Model 1934', 2, 1933, 1935, 1800, 3, 400, 11500, 34.8, 53, 1, 40, 4, 365, 1, 30, 30, 70, 6, 35000),
	(56, 'BT-7 Model 1937', 2, 1937, 1939, 1200, 3, 450, 13800, 32.6, 80, 1, 25, 6, 433, 1, 30, 30, 70, 6, 40000),
	(57, 'IS-1', 2, 1943, 1944, 107, 4, 520, 44000, 13.6, 37, 2, 25, 5, 150, 3, 140, 130, 148, 14, 140000),
	(58, 'IS-2m', 2, 1944, 1945, 3475, 4, 460, 46000, 13, 37, 2, 20, 3, 150, 3, 180, 135, 205, 12, 150000),
	(59, 'IS-3', 2, 1945, 1945, 350, 4, 460, 46500, 11, 40, 2, 20, 3, 150, 3, 220, 200, 205, 12, 160000),
	(60, 'ISU-122', 2, 1943, 1944, 645, 5, 460, 46000, 13, 38, 2, 22, 3, 150, 4, 70, 70, 205, 12, 120000),
	(61, 'ISU-122S', 2, 1944, 1945, 1400, 5, 460, 46000, 13, 38, 2, 20, 3, 150, 4, 121, 149, 205, 12, 130000),
	(62, 'ISU-152', 2, 1943, 1945, 2000, 5, 460, 46000, 13, 38, 2, 20, 3, 150, 4, 120, 149, 170, 4, 140000),
	(63, 'KV-1 Model 1939', 2, 1940, 1940, 100, 5, 600, 43500, 13.8, 35, 1, 25, 4, 250, 3, 80, 90, 78, 3, 90000),
	(64, 'KV-1 Model 1941', 2, 1941, 1942, 2609, 5, 600, 45000, 13.3, 35, 2, 25, 4, 250, 3, 110, 110, 86, 3, 95000),
	(65, 'KV-1E Model 1940', 2, 1940, 1941, 2500, 5, 600, 47500, 12.6, 30, 2, 25, 4, 250, 3, 100, 100, 86, 3, 92000),
	(66, 'KV-1s (Model 1942)', 2, 1942, 1943, 1370, 5, 531, 42500, 14.1, 45, 2, 25, 5, 250, 3, 100, 166, 86, 3, 100000),
	(67, 'KV-2 Model 1940', 2, 1940, 1941, 330, 6, 531, 52000, 11.5, 26, 2, 12, 3, 250, 3, 100, 80, 69, 5, 105000),
	(68, 'KV-85', 2, 1943, 1943, 130, 4, 600, 46000, 13, 34, 2, 23, 3, 251, 3, 110, 106, 148, 11, 110000),
	(69, 'SU-100', 2, 1944, 1945, 1675, 4, 520, 31600, 16.5, 50, 2, 20, 3, 280, 4, 75, 75, 218, 14, 130000),
	(70, 'SU-122', 2, 1942, 1944, 1148, 5, 500, 30900, 16.2, 55, 2, 25, 3, 270, 4, 45, 45, 37, 13, 120000),
	(71, 'SU-152', 2, 1943, 1943, 704, 5, 531, 45500, 13.2, 43, 2, 18, 5, 330, 4, 120, 100, 170, 13, 140000),
	(72, 'SU-76', 2, 1942, 1943, 800, 4, 140, 10800, 13, 45, 1, 25, 3, 320, 4, 30, 30, 87, 16, 70000),
	(73, 'SU-76M', 2, 1943, 1945, 11300, 4, 170, 11200, 15.2, 45, 1, 25, 3, 250, 4, 39, 28, 87, 16, 75000),
	(74, 'SU-85', 2, 1943, 1944, 2050, 4, 500, 29600, 16.9, 55, 2, 25, 5, 280, 4, 64, 64, 148, 11, 100000),
	(75, 'T-24', 2, 1929, 1930, 24, 5, 200, 18000, 11.1, 22, 1, 30, 5, 140, 2, 45, 45, 80, 21, 30000),
	(76, 'T-26 Model 1933', 2, 1933, 1936, 5500, 3, 90, 9400, 9.6, 30, 1, 40, 10, 180, 1, 30, 30, 70, 21, 35000),
	(77, 'T-26S Model 1937', 2, 1938, 1939, 2400, 3, 90, 10500, 8.6, 30, 1, 40, 10, 180, 1, 30, 30, 70, 21, 40000),
	(78, 'T-26S Model 1939', 2, 1939, 1940, 2400, 3, 90, 10500, 8.6, 30, 1, 40, 10, 180, 1, 30, 30, 70, 21, 45000),
	(79, 'T-28', 2, 1939, 1941, 503, 6, 450, 28000, 16.1, 35, 1, 25, 5, 220, 2, 30, 20, 31, 16, 50000),
	(80, 'T-28 Model 1934', 2, 1934, 1938, 318, 6, 450, 28000, 16.1, 37, 1, 40, 10, 220, 2, 35, 30, 31, 16, 52000),
	(81, 'T-28 Model 1938', 2, 1938, 1939, 203, 6, 450, 28000, 16.1, 40, 1, 25, 5, 220, 2, 30, 20, 38, 16, 55000),
	(82, 'T-34-76 Model 1940', 2, 1940, 1941, 950, 4, 500, 26000, 19.2, 55, 2, 29, 5, 300, 2, 90, 45, 78, 16, 80000),
	(83, 'T-34-76 Model 1941', 2, 1941, 1942, 9290, 4, 500, 28000, 17.9, 54, 2, 29, 5, 300, 2, 90, 45, 50, 16, 85000),
	(84, 'T-34-76 Model 1942-43', 2, 1942, 1943, 14041, 4, 500, 30000, 16.7, 49, 2, 30, 5, 500, 2, 85, 90, 87, 16, 90000),
	(85, 'T-34-85 Model 1943', 2, 1944, 1944, 800, 5, 500, 32000, 15.6, 55, 2, 22, 5, 340, 2, 45, 90, 90, 11, 95000),
	(86, 'T-34-85 Model 1944', 2, 1944, 19445, 17680, 5, 520, 32000, 16.3, 55, 2, 22, 5, 300, 2, 60, 45, 87, 11, 100000),
	(87, 'T-35 Model 1935', 2, 1935, 1937, 35, 11, 500, 45000, 11.1, 30, 1, 25, 5, 150, 3, 45, 40, 18, 16, 150000),
	(88, 'T-35 Model 1938', 2, 1938, 1939, 6, 11, 500, 500, 10, 30, 1, 25, 5, 150, 3, 49, 40, 18, 16, 160000),
	(89, 'T-37A', 2, 1933, 1936, 1130, 2, 40, 3200, 12.5, 35, 1, 5, 5, 200, 1, 9, 9, 10, 17, 35000),
	(90, 'T-38', 2, 1937, 1938, 400, 2, 40, 3300, 12.1, 40, 1, 5, 5, 230, 1, 9, 9, 10, 17, 30000),
	(91, 'T-40', 2, 1941, 1942, 225, 2, 85, 5500, 15.5, 45, 1, 40, 10, 360, 1, 9, 10, 12, 17, 32000),
	(92, 'T-44', 2, 1945, 1945, 200, 4, 520, 31500, 16.5, 60, 2, 20, 5, 200, 2, 182, 145, 148, 11, 110000),
	(93, 'T-50', 2, 1941, 1941, 65, 4, 300, 14000, 21.4, 64, 2, 40, 10, 350, 1, 60, 60, 70, 21, 40000),
	(94, 'T-60 Model 1941', 2, 1941, 1942, 4200, 2, 70, 5800, 12.1, 45, 1, 40, 10, 600, 1, 30, 40, 32, 8, 45000),
	(95, 'T-60 Model 1942', 2, 1942, 1942, 2000, 2, 85, 6400, 13.3, 45, 1, 40, 10, 600, 1, 30, 40, 32, 8, 47000),
	(96, 'T-70 Model 1942', 2, 1942, 1943, 7500, 2, 140, 9200, 15.2, 45, 1, 20, 6, 360, 1, 54, 55, 78, 21, 50000),
	(97, 'T-70 Model 1943', 2, 1943, 1943, 800, 2, 170, 10000, 17, 45, 1, 20, 6, 300, 1, 54, 55, 78, 21, 52000),
	(98, 'M10 Tank Destroyer', 3, 1942, 1943, 4993, 5, 375, 29600, 12.7, 40, 2, 30, 10, 322, 4, 51, 57, 134, 17, 100000),
	(99, 'M18 Hellcat', 3, 1943, 1944, 2507, 5, 460, 17700, 26, 80, 1, 20, 10, 161, 4, 13, 25, 134, 17, 120000),
	(100, 'M22 Locust', 3, 1943, 1944, 830, 4, 192, 7400, 25.9, 58, 1, 30, 10, 177, 1, 25, 30, 79, 6, 45000),
	(101, 'M24 Chafee', 3, 1944, 1945, 4731, 4, 296, 18400, 16.1, 56, 1, 15, 10, 161, 1, 25, 25, 91, 2, 80000),
	(102, 'M26 Pershing', 3, 1944, 1945, 1436, 5, 500, 41900, 11.9, 40, 1, 20, 10, 161, 2, 76, 102, 175, 15, 130000),
	(103, 'M3 Lee', 3, 1941, 1942, 4924, 7, 400, 27900, 14.3, 34, 1, 60, 7, 193, 2, 51, 51, 79, 2, 60000),
	(104, 'M3 Stuart', 3, 1941, 1942, 4526, 4, 262, 12700, 20.6, 58, 1, 20, 10, 113, 1, 44, 38, 77, 6, 35000),
	(105, 'M36 Tank Destroyer', 3, 1944, 1945, 1413, 5, 500, 28600, 17.5, 46, 1, 20, 10, 249, 4, 38, 76, 162, 15, 110000),
	(106, 'M3A1 Lee', 3, 1942, 1942, 300, 7, 400, 28600, 14, 34, 1, 60, 7, 320, 2, 51, 51, 79, 2, 65000),
	(107, 'M3A1 Stuart', 3, 1942, 1943, 4410, 4, 262, 12900, 20.3, 58, 1, 20, 10, 113, 1, 38, 38, 79, 6, 40000),
	(108, 'M3A3 Lee', 3, 1942, 1942, 322, 7, 410, 27900, 14.7, 40, 2, 60, 7, 241, 2, 51, 51, 79, 2, 70000),
	(109, 'M3A3 Stuart', 3, 1942, 1943, 3427, 4, 262, 14700, 17.8, 50, 1, 20, 10, 217, 1, 44, 38, 79, 6, 45000),
	(110, 'M3A4 Lee', 3, 1942, 1942, 109, 7, 425, 2900, 14.7, 32, 1, 60, 7, 161, 2, 51, 51, 79, 2, 75000),
	(111, 'M4 Sherman', 3, 1942, 1944, 6748, 5, 400, 30300, 13.2, 34, 1, 25, 10, 193, 2, 51, 76, 91, 2, 90000),
	(112, 'M4A1 Sherman', 3, 1942, 1943, 6281, 5, 400, 30300, 13.2, 34, 1, 25, 12, 193, 2, 51, 76, 91, 2, 95000),
	(113, 'M4A1(76)W Sherman', 3, 1944, 1945, 3426, 5, 460, 3200, 14.4, 34, 1, 25, 10, 161, 2, 63, 63, 134, 16, 100000),
	(114, 'M4A2 Sherman', 3, 1942, 1944, 8053, 5, 410, 31800, 12.9, 34, 2, 25, 10, 241, 2, 63, 76, 91, 2, 105000),
	(115, 'M4A2(76)W Sherman', 3, 1944, 1945, 2915, 5, 410, 33300, 12.3, 34, 2, 25, 10, 161, 2, 63, 63, 134, 16, 110000),
	(116, 'M4A3 Sherman', 3, 1942, 1943, 1690, 5, 500, 30300, 16.5, 42, 1, 25, 10, 209, 2, 51, 76, 134, 2, 115000),
	(117, 'M4A3(75)W Sherman', 3, 1944, 1945, 3071, 5, 500, 31600, 15.8, 42, 1, 25, 10, 161, 2, 63, 63, 134, 2, 120000),
	(118, 'M4A3(76)W HVSS Sherman', 3, 1944, 1945, 4542, 5, 500, 33650, 14.9, 42, 1, 25, 10, 161, 2, 63, 63, 134, 16, 130000),
	(119, 'M4A3E2', 3, 1944, 1944, 254, 5, 500, 38100, 13.1, 35, 1, 25, 10, 161, 2, 101, 177, 91, 2, 140000),
	(120, 'M4A4 Sherman', 3, 1942, 1943, 7499, 5, 425, 31600, 13.4, 32, 1, 25, 12, 161, 2, 51, 76, 91, 2, 125000),
	(121, 'M5A1 Stuart', 3, 1942, 1944, 6810, 4, 296, 15500, 19.1, 58, 1, 20, 12, 161, 1, 28, 50, 79, 6, 50000),
	(122, 'Achilles IIC', 4, 1944, 1945, 1100, 5, 363, 29600, 12.7, 41, 2, 30, 10, 322, 4, 75, 51, 171, 16, 95000),
	(123, 'Archer', 4, 1943, 1945, 655, 4, 170, 16300, 10.1, 33, 2, 15, 7, 145, 4, 28, 40, 171, 16, 100000),
	(124, 'A30', 4, 1943, 1945, 200, 5, 531, 33000, 18.2, 52, 1, 20, 10, 241, 2, 60, 124, 171, 16, 120000),
	(125, 'Churchill Mk. I', 4, 1941, 1941, 303, 5, 310, 38000, 9.2, 28, 1, 20, 15, 203, 3, 76, 176, 72, 20, 110000),
	(126, 'Churchill Mk. IV', 4, 1942, 1943, 1622, 5, 350, 39600, 8.8, 25, 1, 20, 12, 259, 3, 77, 180, 91, 2, 115000),
	(127, 'Churchill Mk. VII', 4, 1943, 1945, 1600, 5, 310, 40600, 8.6, 20, 1, 20, 12, 145, 3, 115, 189, 91, 2, 130000),
	(128, 'Comet', 4, 1944, 1944, 1200, 5, 600, 33225, 18.1, 51, 1, 20, 12, 240, 2, 65, 127, 137, 2, 140000),
	(129, 'Cromwell Mk. IV', 4, 1943, 1943, 1070, 5, 531, 28000, 21.4, 52, 1, 20, 12, 265, 2, 60, 102, 91, 19, 100000),
	(130, 'Cruiser Tank Mk. I', 4, 1937, 1938, 125, 6, 150, 12730, 11.8, 40, 1, 20, 15, 150, 2, 28, 28, 72, 20, 40000),
	(131, 'Cruiser Tank Mk. II', 4, 1939, 1940, 175, 5, 150, 14400, 10.4, 26, 1, 25, 15, 161, 2, 22, 30, 72, 20, 45000),
	(132, 'Cruiser Tank Mk. III', 4, 1939, 1940, 65, 4, 340, 14200, 23.9, 48, 1, 20, 15, 169, 2, 14, 14, 30, 20, 50000),
	(133, 'Cruiser Tank Mk. IVA', 4, 1939, 1941, 172, 4, 340, 15000, 22.7, 48, 1, 20, 15, 169, 2, 30, 30, 70, 20, 55000),
	(134, 'Crusader Mk. I', 4, 1940, 1940, 5300, 5, 340, 19100, 17.8, 48, 1, 20, 15, 322, 1, 28, 29, 72, 20, 60000),
	(135, 'Crusader Mk. II', 4, 1940, 1942, 5300, 4, 301, 19300, 17.6, 43, 1, 20, 15, 322, 1, 28, 29, 72, 20, 65000),
	(136, 'Crusader Mk. III', 4, 1942, 1943, 5300, 3, 301, 20100, 16.9, 42, 1, 30, 12, 204, 1, 40, 28, 101, 22, 70000),
	(137, 'Grant I', 4, 1941, 1942, 1685, 6, 354, 28100, 14.2, 39, 1, 60, 7, 193, 2, 76, 102, 79, 2, 75000),
	(138, 'Infantry Tank Mk. I', 4, 1936, 1940, 139, 2, 70, 11200, 6.3, 13, 1, 25, 15, 129, 1, 55, 60, 72, 7, 80000),
	(139, 'Vickers Mark II', 4, 1925, 1930, 100, 5, 90, 12000, 7.5, 21, 1, 16, 7, 193, 2, 8, 8, 57, 5, 85000),
	(140, 'Mark VIB', 4, 1925, 1930, 1682, 3, 88, 4900, 18, 40, 1, 16, 7, 193, 1, 8, 8, 57, 23, 90000),
	(141, 'Matilda Mk. III', 4, 1938, 1943, 2900, 4, 190, 26500, 7.2, 24, 2, 20, 9, 257, 3, 95, 149, 72, 20, 95000),
	(142, 'Valentine Mk. II', 4, 1940, 1942, 700, 3, 131, 16000, 8.1, 24, 2, 20, 15, 177, 2, 60, 119, 72, 20, 100000);

-- A despejar estrutura para tabela main.tank_type
CREATE TABLE IF NOT EXISTS `tank_type` (
  `Tank_Id` int NOT NULL AUTO_INCREMENT,
  `Tank` varchar(20) NOT NULL,
  PRIMARY KEY (`Tank_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela main.tank_type: ~5 rows (aproximadamente)
INSERT INTO `tank_type` (`Tank_Id`, `Tank`) VALUES
	(1, 'Light'),
	(2, 'Medium'),
	(3, 'Heavy'),
	(4, 'Tank Destroyer'),
	(5, 'Super Heavy');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
