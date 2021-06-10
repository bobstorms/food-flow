# ************************************************************
# Sequel Ace SQL dump
# Version 3030
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: ID299174_foodflow.db.webhosting.be (MySQL 5.7.33-36-log)
# Database: ID299174_foodflow
# Generation Time: 2021-06-10 00:02:05 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table client
# ------------------------------------------------------------

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL DEFAULT '',
  `address_street` varchar(300) NOT NULL DEFAULT '',
  `address_number` varchar(10) NOT NULL DEFAULT '',
  `city` varchar(300) NOT NULL DEFAULT '',
  `postal_code` varchar(10) NOT NULL DEFAULT '',
  `phone` varchar(15) NOT NULL DEFAULT '',
  `email` varchar(300) NOT NULL DEFAULT '',
  `is_ready` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;

INSERT INTO `client` (`id`, `name`, `address_street`, `address_number`, `city`, `postal_code`, `phone`, `email`, `is_ready`)
VALUES
	(1,'AMAI','Grote Markt','21','Mechelen','2800','','',0),
	(2,'Asiel en Migratie','Sint Romboutskerkhof','1','Mechelen','2800','','',0),
	(3,'Sociaal Centrum','Twaalf Apostelenstraat','17','Mechelen','2800','','',0),
	(4,'OCMW Bornem','Stationsstraat','22','Mechelen','2800','','',0),
	(5,'OCMW Putte','Mechelbaan','547','Putte','2580','','',0),
	(6,'De Keeting','Kroonstraat','64','Mechelen','2800','','',0),
	(7,'De Refuge','Onze-Lieve-Vrouwestraat','52','Mechelen','2800','','',0),
	(8,'CAW Stassart 2','Stassartstraat','2','Mechelen','2800','','',0),
	(9,'Emmaus Juneco','Korte Schipstraat','16','Mechelen','2800','','',0),
	(10,'Emmaus De Hefboom','Steenweg op Heindonck','103','Heffen','2801','','',0),
	(11,'De Nieuwe Weg','Lange Schipstraat','25','Mechelen','2800','','',0),
	(12,'Sint Vincentius Noord','Liersesteenweg','40','Mechelen','2800','','',0),
	(13,'Sint Vincentius Zuid','Antoon Spinoystraat','8','Mechelen','2800','','',0),
	(14,'Bohets Mechelen','Krommestraat','7','Mechelen','2800','','',0),
	(15,'JAM Otterbeek','Tivolilaan','45','Mechelen','2800','','',0);

/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `event_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table order_ticket
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_ticket`;

CREATE TABLE `order_ticket` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `wishlist_id` int(11) unsigned NOT NULL,
  `date` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `client_product_id` (`wishlist_id`),
  CONSTRAINT `order_ticket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `order_ticket_ibfk_2` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlist` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL DEFAULT '',
  `image` varchar(300) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`id`, `name`, `image`)
VALUES
	(1,'Groenten','./images/products/product-groenten.png'),
	(2,'Fruit','./images/products/product-fruit.png'),
	(3,'Zuivel','./images/products/product-zuivel.png'),
	(4,'Snoepgoed','./images/products/product-snoepgoed.png'),
	(5,'Droge voeding','./images/products/product-droge-voeding.png'),
	(6,'Brood','./images/products/product-brood.png'),
	(7,'Diepvries','./images/products/product-diepvries.png'),
	(8,'Vlees','./images/products/product-vlees.png'),
	(9,'Vis','./images/products/product-vis.png'),
	(10,'Conserven','./images/products/product-conserven.png');

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ride
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ride`;

CREATE TABLE `ride` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `is_ready` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `ride_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ride` WRITE;
/*!40000 ALTER TABLE `ride` DISABLE KEYS */;

INSERT INTO `ride` (`id`, `date`, `client_id`, `is_ready`)
VALUES
	(1,'2021-06-09',1,0),
	(2,'2021-06-09',5,0),
	(3,'2021-06-09',3,0),
	(4,'2021-06-09',9,0),
	(5,'2021-06-09',2,0),
	(6,'2021-06-09',4,0),
	(7,'2021-06-09',10,0);

/*!40000 ALTER TABLE `ride` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stop
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stop`;

CREATE TABLE `stop` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `ride_id` int(11) unsigned NOT NULL,
  `time_arrival` datetime NOT NULL,
  `time_departure` datetime NOT NULL,
  `temperature` decimal(19,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ride_id` (`ride_id`),
  CONSTRAINT `stop_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `stop_ibfk_2` FOREIGN KEY (`ride_id`) REFERENCES `ride` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(300) NOT NULL DEFAULT '',
  `last_name` varchar(300) NOT NULL DEFAULT '',
  `email` varchar(300) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `is_approved` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `is_approved`, `is_admin`)
VALUES
	(1,'Bob','Storms','bob.storms@hotmail.be','$2y$12$5KKfM1WjoUrVTHts30SCV.LmEZjoFLNOB4tQFgzoMVVwfYXjWjpFC',1,0),
	(2,'Testgebruiker','Foodflow','testgebruiker.foodflow@bobstorms.be','$2y$12$Vj1qsVSM3BY0Y/BDURo7VOsM/BcB1CZ/WyEnyeRCNbQJgVecDRfDq',1,0),
	(3,'Demo','Jury','jury@bobstorms.be','$2y$12$i2FOgFcRgECn675TdYiE0eXBIdZPy2Li6O8MaGwH8sY.BmNdjGpWu',1,0);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table weight
# ------------------------------------------------------------

DROP TABLE IF EXISTS `weight`;

CREATE TABLE `weight` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_ticket_id` int(11) unsigned NOT NULL,
  `weight` decimal(20,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_ticket_id` (`order_ticket_id`),
  CONSTRAINT `weight_ibfk_1` FOREIGN KEY (`order_ticket_id`) REFERENCES `order_ticket` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table wishlist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wishlist`;

CREATE TABLE `wishlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `quantity` int(2) NOT NULL,
  `is_ready` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;

INSERT INTO `wishlist` (`id`, `client_id`, `product_id`, `quantity`, `is_ready`)
VALUES
	(1,1,1,7,0),
	(2,1,2,7,0),
	(3,1,4,2,0),
	(4,1,3,2,0),
	(5,1,5,2,0),
	(6,2,1,25,0),
	(7,2,1,5,0),
	(8,2,5,3,0),
	(9,2,6,3,0),
	(10,2,4,2,0),
	(11,2,7,6,0),
	(12,3,1,20,0),
	(13,3,2,4,0),
	(14,3,3,1,0),
	(15,3,5,1,0),
	(16,3,4,1,0),
	(18,4,1,10,0),
	(19,4,2,5,0),
	(20,4,5,3,0),
	(21,4,4,2,0),
	(22,5,1,20,0),
	(23,5,2,5,0),
	(24,5,4,2,0),
	(25,5,5,4,0),
	(26,5,7,5,0);

/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
