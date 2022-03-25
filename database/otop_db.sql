-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: otop_shop_db
-- ------------------------------------------------------
-- Server version	5.7.34-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_cart` (
  `CartID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Prize` decimal(15,2) DEFAULT NULL,
  `Total_price` decimal(15,2) DEFAULT '0.00',
  `Ispurchased` int(11) DEFAULT '0',
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CartID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cart`
--

LOCK TABLES `tbl_cart` WRITE;
/*!40000 ALTER TABLE `tbl_cart` DISABLE KEYS */;
INSERT INTO `tbl_cart` VALUES (1,4,4,2,5000.00,10000.00,1,'2021-11-21 17:10:57'),(2,4,1,1,4000.00,4000.00,1,'2021-11-21 19:01:20'),(3,4,1,1,4000.00,4000.00,0,'2021-11-22 04:47:09');
/*!40000 ALTER TABLE `tbl_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_category` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryCode` int(8) unsigned zerofill NOT NULL,
  `Name` varchar(500) DEFAULT NULL,
  `IsActive` int(11) NOT NULL DEFAULT '1',
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` VALUES (1,00000001,'Category 1',1,'2021-11-21 16:10:56',6),(2,00000002,'Category 2',1,'2021-11-21 16:11:06',6),(3,00000003,'Nike  version 1',1,'2021-11-21 17:07:05',7),(4,00000004,'Nike version 2',1,'2021-11-21 17:07:13',7);
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_followers`
--

DROP TABLE IF EXISTS `tbl_followers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_followers` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `VendorID` int(11) DEFAULT NULL,
  `FollowedBy` int(11) DEFAULT NULL,
  `DateFollowed` datetime DEFAULT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_followers`
--

LOCK TABLES `tbl_followers` WRITE;
/*!40000 ALTER TABLE `tbl_followers` DISABLE KEYS */;
INSERT INTO `tbl_followers` VALUES (3,6,4,'2021-11-22 11:14:39');
/*!40000 ALTER TABLE `tbl_followers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product_image`
--

DROP TABLE IF EXISTS `tbl_product_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_product_image` (
  `ImageID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  `FileName` varchar(545) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Created_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ImageID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product_image`
--

LOCK TABLES `tbl_product_image` WRITE;
/*!40000 ALTER TABLE `tbl_product_image` DISABLE KEYS */;
INSERT INTO `tbl_product_image` VALUES (1,1,'1637511135_dcd6c6de4cd48423efe4.png','2021-11-21 16:12:15','6'),(2,1,'1637511135_5123d36914db4c9fc691.jpg','2021-11-21 16:12:15','6'),(3,2,'1637511166_53dc3b8a72315f05a2d1.jpg','2021-11-21 16:12:46','6'),(4,2,'1637511166_ac1bc41e7083b31f2b20.jpg','2021-11-21 16:12:46','6'),(5,2,'1637511166_2457139a2b956e23b348.jpg','2021-11-21 16:12:46','6'),(6,3,'1637511290_7a1071d01c26a7417d38.jpg','2021-11-21 16:14:50','6'),(7,3,'1637511290_e7d9ee3b6b259eb12a31.jpg','2021-11-21 16:14:50','6'),(8,4,'1637514483_e6d765dc9f2e48a5c4bb.jpg','2021-11-21 17:08:03','7'),(9,5,'1637514502_8026ee20564e3dea71e4.jpg','2021-11-21 17:08:22','7'),(10,6,'1637514524_236d68b0be47a869474d.jpg','2021-11-21 17:08:44','7');
/*!40000 ALTER TABLE `tbl_product_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_products` (
  `ProducID` int(11) NOT NULL AUTO_INCREMENT,
  `ProducCode` int(8) unsigned zerofill NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(345) NOT NULL,
  `Prize` decimal(15,2) NOT NULL,
  `Description` varchar(1500) DEFAULT NULL,
  `stocks` int(11) DEFAULT '0',
  `IsActive` int(11) NOT NULL DEFAULT '1',
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`ProducID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_products`
--

LOCK TABLES `tbl_products` WRITE;
/*!40000 ALTER TABLE `tbl_products` DISABLE KEYS */;
INSERT INTO `tbl_products` VALUES (1,00000001,1,'Product 1',4000.00,'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.',999,1,'2021-11-21 19:01:47',6),(2,00000002,2,'Product 2',40000.00,'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.',10,1,'2021-11-21 16:12:46',6),(3,00000003,2,'Product 3',100000.00,'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.',3,1,'2021-11-21 16:14:50',6),(4,00000004,3,'Nike air 1',5000.00,'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.',998,1,'2021-11-21 18:15:58',7),(5,00000005,4,'Nike air 2',6000.00,'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.',1787,1,'2021-11-21 17:08:22',7),(6,00000006,4,'Nike air 3',7000.00,'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.',1332,1,'2021-11-21 17:08:44',7);
/*!40000 ALTER TABLE `tbl_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_purchased_orders`
--

DROP TABLE IF EXISTS `tbl_purchased_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_purchased_orders` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `OrderCode` int(10) unsigned zerofill NOT NULL,
  `AddressID` int(11) NOT NULL,
  `PaymentMethod` varchar(245) NOT NULL,
  `CartID` int(11) NOT NULL,
  `Status` varchar(245) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CancelRemarks` varchar(1500) DEFAULT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_purchased_orders`
--

LOCK TABLES `tbl_purchased_orders` WRITE;
/*!40000 ALTER TABLE `tbl_purchased_orders` DISABLE KEYS */;
INSERT INTO `tbl_purchased_orders` VALUES (1,4,0000000001,5,'COD',1,'Completed','2021-11-21 18:42:09',NULL),(2,4,0000000002,5,'COD',2,'Completed','2021-11-21 19:02:04',NULL);
/*!40000 ALTER TABLE `tbl_purchased_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rates`
--

DROP TABLE IF EXISTS `tbl_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_rates` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) DEFAULT NULL,
  `RatedBy` int(11) DEFAULT NULL,
  `Rate` float DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rates`
--

LOCK TABLES `tbl_rates` WRITE;
/*!40000 ALTER TABLE `tbl_rates` DISABLE KEYS */;
INSERT INTO `tbl_rates` VALUES (1,4,4,3.5,'2021-11-22 02:42:20'),(2,1,4,3,'2021-11-22 03:02:14');
/*!40000 ALTER TABLE `tbl_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_address`
--

DROP TABLE IF EXISTS `tbl_user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_address` (
  `AddresID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `PhoneNumber` varchar(145) DEFAULT NULL,
  `Full_Address` varchar(545) DEFAULT NULL,
  `PostalCode` int(11) DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT NULL,
  `IsDefault` int(11) DEFAULT '0',
  PRIMARY KEY (`AddresID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_address`
--

LOCK TABLES `tbl_user_address` WRITE;
/*!40000 ALTER TABLE `tbl_user_address` DISABLE KEYS */;
INSERT INTO `tbl_user_address` VALUES (1,3,'0942534565','Dadap Luna Isabela',3304,'2021-08-11 01:26:23',0),(2,3,'0942534565','Purok Luna Isabela',3304,'2021-08-11 01:27:06',0),(4,3,'09750148734','brgy. dadap luna isabela, mahogany st.024',3304,'2021-08-10 19:57:23',0),(5,4,'09750148734','brgy. dadap luna isabela, mahogany st.024',3304,'2021-11-21 17:10:38',1);
/*!40000 ALTER TABLE `tbl_user_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_access`
--

DROP TABLE IF EXISTS `user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_access` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `firtname` varchar(345) DEFAULT NULL,
  `lastname` varchar(345) DEFAULT NULL,
  `middlename` varchar(345) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `username` varchar(245) DEFAULT NULL,
  `password` varchar(345) DEFAULT NULL,
  `user_type` varchar(245) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lang` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `company_name` varchar(345) DEFAULT NULL,
  `logo` varchar(345) DEFAULT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_access`
--

LOCK TABLES `user_access` WRITE;
/*!40000 ALTER TABLE `user_access` DISABLE KEYS */;
INSERT INTO `user_access` VALUES (1,'John javier','Romero','Romero','johnjavieridmilao12@gmail.com','jhayjhay','f0a226b7092c7bc6b1fff499d62630a0d6ac9ea0','admin',16.9578,121.731,'2021-08-09 15:24:01',NULL,NULL),(3,'Reggie','Ngenge','R.','johnjavieridmilao12@gmail.com','reggie','f0a226b7092c7bc6b1fff499d62630a0d6ac9ea0','vendor',16.9578,121.731,'2021-08-10 02:58:38',NULL,NULL),(4,'Clarise','Dana','Dana','clarise@gmail.com','clarise','f0a226b7092c7bc6b1fff499d62630a0d6ac9ea0','user',16.9578,121.731,'2021-08-12 03:07:08',NULL,'1637517508_ca30795d16cfc3becd1e.jpg'),(5,'Maribel','Idmilao','Romero','maribel@gmail.com','maribel','f0a226b7092c7bc6b1fff499d62630a0d6ac9ea0','user',16.9411,121.743,'2021-08-13 00:54:53',NULL,NULL),(6,'Vendor 2','Vendor 2','Vendor 2','johnjavieridmilao12@gmail.com','vdr2','4028a0e356acc947fcd2bfbf00cef11e128d484a','vendor',16.9578,121.731,'2021-11-21 15:35:30','Vendor 2',NULL),(7,'Vendor 3','Vendor 3','Vendor 3','johnjavieridmilao12@gmail.com','vdr3','4028a0e356acc947fcd2bfbf00cef11e128d484a','vendor',16.9578,121.731,'2021-11-21 16:45:37','Vendor 3','1637516531_3ac9a86eadef0f4adedc.jpg'),(8,'Vendor 4','Vendor 4','Vendor 4','johnjavieridmilao12@gmail.com','vdr4','4028a0e356acc947fcd2bfbf00cef11e128d484a','vendor',NULL,NULL,'2021-11-22 04:27:53','Vendor 4',NULL),(9,'Vendor 5','Vendor 5','Vendor 5','johnjavieridmilao12@gmail.com','vdr5','4028a0e356acc947fcd2bfbf00cef11e128d484a','vendor',16.9578,121.731,'2021-11-22 04:31:44','Vendor 5',NULL);
/*!40000 ALTER TABLE `user_access` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-23 14:47:57
