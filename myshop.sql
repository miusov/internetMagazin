-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: myshop
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.26-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `brand` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (6,3,'Samsung'),(7,30,'Apple'),(8,1,'Apple'),(9,30,'Lenovo'),(10,1,'Samsung');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buyproducts`
--

DROP TABLE IF EXISTS `buyproducts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buyproducts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buy_id_order` int(11) NOT NULL,
  `buy_id_product` int(11) NOT NULL,
  `buy_count_product` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyproducts`
--

LOCK TABLES `buyproducts` WRITE;
/*!40000 ALTER TABLE `buyproducts` DISABLE KEYS */;
/*!40000 ALTER TABLE `buyproducts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id_product` int(11) NOT NULL,
  `cart_price` int(11) NOT NULL,
  `cart_count` int(11) NOT NULL,
  `cart_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cart_sid` varchar(128) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Мобильные телефоны'),(3,'Ноутбуки'),(30,'Планшеты');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Акция! Кулон с бриллиантом за 1399 грн!','Не упустите возможность приобрести акционный кулон с бриллиантом за 1399 грн!','2017-04-08'),(2,'Акция! Скидки на акционные детские товары Zazu!','Не упустите возможность приобрести акционные детские товары Zazu со скидками!','2017-04-09'),(3,'Акция! Суперцена на веб-камеру Manhattan Combo + гарнитура!','Не упустите возможность приобрести веб-камеру Manhattan Combo + гарнитура по суперцене!','2017-04-10'),(4,'Акция! К акционным сумкам и рюкзакам Thule - УМБ 5200 mAh в подарок!','Каждый покупатель акционных сумок и рюкзаков Thule получает в подарок УМБ Silicon Power 5200 mAh White*! \r\nПериод проведения акции: 8 апреля — 28 апреля 2017 г. \r\nСпешите, количество подарков ограничено!\r\n','2017-04-11');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL,
  `order_confirm` varchar(10) NOT NULL DEFAULT 'no',
  `order_delivery` varchar(255) NOT NULL,
  `order_pay` varchar(64) NOT NULL,
  `order_type_pay` varchar(128) NOT NULL,
  `order_fio` text NOT NULL,
  `order_address` text NOT NULL,
  `order_tel` varchar(64) NOT NULL,
  `order_note` text NOT NULL,
  `order_email` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regadmin`
--

DROP TABLE IF EXISTS `regadmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `tel` varchar(64) NOT NULL,
  `rev_zak` int(11) DEFAULT '0',
  `wrk_zak` int(11) NOT NULL DEFAULT '0',
  `del_zak` int(11) NOT NULL DEFAULT '0',
  `add_tov` int(11) NOT NULL DEFAULT '0',
  `edt_tov` int(11) NOT NULL DEFAULT '0',
  `del_tov` int(11) NOT NULL DEFAULT '0',
  `mod_otz` int(11) NOT NULL DEFAULT '0',
  `del_otz` int(11) NOT NULL DEFAULT '0',
  `rev_cln` int(11) NOT NULL DEFAULT '0',
  `del_cln` int(11) NOT NULL DEFAULT '0',
  `add_nes` int(11) NOT NULL DEFAULT '0',
  `del_nes` int(11) NOT NULL DEFAULT '0',
  `add_cat` int(11) NOT NULL DEFAULT '0',
  `del_cat` int(11) NOT NULL DEFAULT '0',
  `rev_adm` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regadmin`
--

LOCK TABLES `regadmin` WRITE;
/*!40000 ALTER TABLE `regadmin` DISABLE KEYS */;
INSERT INTO `regadmin` VALUES (2,'admin','$2y$10$3PeOiv4.phJrdKw/XM1UT..A4bQ8CTIu2CCZFA6ari8kykBO13zzC','Миусов Артем','Администратор','miusov86@gmail.com','0977919245',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),(3,'moder','$2y$10$Wh/qH5xIrBC1DaDcmKNauuWKq25O9hv6YE61.fSir1HVjeGNcqmMO','James Bond','Модератор','mail@mail.ru','123456789',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `regadmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `good_review` text NOT NULL,
  `bad_review` text NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL,
  `moderat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,1,'Миусов Артем','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consequatur eum fugiat, iste modi molestiae pariatur quam qui saepe vitae.GOOD','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus animi asperiores cupiditate ducimus eveniet iure, iusto labore maxime modi molestias nostrum nulla qui quidem recusandae, reiciendis reprehenderit totam veniam vero.BAD','Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus accusantium ad adipisci alias atque commodi corporis deleniti deserunt dicta dolore, doloribus eius eos excepturi expedita fugit in ipsum itaque laboriosam magnam minus neque odit officiis quas reiciendis reprehenderit sequi vel. Aut exercitationem magnam officia officiis ratione soluta suscipit temporibus?COMMENT','2017-04-24',1),(2,1,'Миусов Артем2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consequatur eum fugiat, iste modi molestiae pariatur quam qui saepe vitae.GOOD2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus animi asperiores cupiditate ducimus eveniet iure, iusto labore maxime modi molestias nostrum nulla qui quidem recusandae, reiciendis reprehenderit totam veniam vero.BAD2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus accusantium ad adipisci alias atque commodi corporis deleniti deserunt dicta dolore, doloribus eius eos excepturi expedita fugit in ipsum itaque laboriosam magnam minus neque odit officiis quas reiciendis reprehenderit sequi vel. Aut exercitationem magnam officia officiis ratione soluta suscipit temporibus?COMMENT2','2017-04-23',1),(14,9,'Вася Пупкин','Хороший телефон','нет','все ОК','2017-04-24',1),(15,11,'Лена Головач','нет плюсов','куча минусов','а так все хорошо','2017-04-24',1),(17,5,'Лена Бородач','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consequatur eum fugiat, iste modi molestiae pariatur quam qui saepe vitae.GOOD','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consequatur eum fugiat, iste modi molestiae pariatur quam qui saepe vitae.GOOD','Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus accusantium ad adipisci alias atque commodi corporis deleniti deserunt dicta dolore, doloribus eius eos excepturi expedita fugit in ipsum itaque laboriosam magnam minus neque odit officiis quas reiciendis reprehenderit sequi vel. Aut exercitationem magnam officia officiis ratione soluta suscipit temporibus?COMMENT','2017-04-27',1);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tableproducts`
--

DROP TABLE IF EXISTS `tableproducts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tableproducts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `seo_words` text NOT NULL,
  `seo_description` text NOT NULL,
  `mini_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `mini_features` text NOT NULL,
  `features` text NOT NULL,
  `link_video` text NOT NULL,
  `created_at` datetime NOT NULL,
  `new` int(11) NOT NULL DEFAULT '0',
  `leader` int(11) NOT NULL DEFAULT '0',
  `sale` int(11) NOT NULL DEFAULT '0',
  `visible` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `type_tovara` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `like_ok` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tableproducts`
--

LOCK TABLES `tableproducts` WRITE;
/*!40000 ALTER TABLE `tableproducts` DISABLE KEYS */;
INSERT INTO `tableproducts` VALUES (1,'Apple iPhone 5s 16GB Space Gray',8500,'Apple','','','','iphone.jpg','Незаменим с момента создания Процессор A7 с 64-битной архитектурой. Датчик идентификации по отпечатку пальца. Усовершенствованная камера, которая стала ещё быстрее. Операционная система, разработанная специально для 64-битной архитектуры. Любая из этих функций позволила бы смартфону быть на шаг впереди других. А со всеми этими функциями iPhone просто опережает своё время.','Диагональ экрана Подробнее  4\r\nРазрешение дисплея Подробнее  1136x640\r\nТип матрицы Подробнее  IPS Подробнее\r\nКоличество точек касания  10\r\nМатериал экрана  Стекло','','','2017-04-25 14:23:00',1,0,0,1,113,'Мобильные телефоны',7,3),(2,'Samsung Galaxy S8',9000,'Samsung ','','','','samsungS8.jpg','','Диагональ экрана Подробнее  6.2\r\nРазрешение дисплея Подробнее  2960x1440\r\nТип матрицы Подробнее  Super AMOLED Подробнее\r\nКоличество точек касания  10\r\nМатериал экрана  Стекло','','','2017-04-24 18:43:00',0,0,0,1,6,'Мобильные телефоны',10,1),(4,'Apple M5 2/16GB White ',3200,'Apple','','','','meizu_m5.jpg','','Экран (5.2\", IPS, 1280x720)/ MediaTek MT6750 (4x1.5 ГГц + 4x1 ГГц)/ основная камера: 13 Мп, фронтальная камера: 5 Мп/ RAM 2 ГБ/ 16 ГБ встроенной памяти + microSD/SDHC (до 128 ГБ)/ 3G/ LTE/ GPS/ поддержка 2х SIM-карт (Nano-SIM)/ YunOS 5.1.1/ 3070 мА*ч','','','2017-04-24 16:51:00',1,0,0,1,8,'Мобильные телефоны',7,1),(7,'Apple A1490 iPad mini 2 Wi-Fi 4G 32GB',13200,'Apple','','','','apple_ipad_mini.jpg','','Экран 7.9\" (2048 x 1536) емкостной Multi-Touch / Apple A7 (1.3 ГГц) / ОЗУ 1 ГБ / Флеш-память 32 ГБ / Wi-Fi / Bluetooth 4.0 / 3G / EV-DO / AGPS / основная камера 5 Мп, фронтальная 1.2 Мп / ОС iOS 7.0 / вес 341 г / серебряный','','','2017-04-18 10:48:00',0,1,0,1,5,'Планшеты',1,1),(9,'Apple iPhone 7 32GB Rose Gold',22000,'Apple','','','','apple_iphone_7.jpg','','Экран (4.7\", IPS, 1334x750)/ Apple A10 Fusion/ основная камера: 12 Мп, фронтальная камера: 7 Мп/ RAM 2 ГБ/ 32 ГБ встроенной памяти/ 3G/ LTE/ GPS/ Nano-SIM/ iOS 10','','','2017-04-24 16:43:00',0,0,0,1,5,'Мобильные телефоны',4,3),(40,'Планшет Lenovo TAB 3-730F 7',3199,'Lenovo','Lenovo TAB 3-730F','Планшет Lenovo TAB 3-730F 7\" 16GB (ZA110166UA) Black','<p>Операционная система: Android;</p>\r\n\r\n<p>Диагональ дисплея: 7&quot;;</p>\r\n\r\n<p>Разрешение дисплея: 1024x600;</p>\r\n\r\n<p>Тип матрицы: IPS;</p>\r\n\r\n<p>Процессор: MTK 8735;</p>\r\n\r\n<p>Количество ядер процессора: 4;</p>\r\n','M2OsORo497405089.jpg','<h2>Обзор Lenovo TAB 3-730F 7&quot; 16GB (ZA110166UA) Black</h2>\r\n\r\n<p><strong>Быстрое и мощное устройство </strong></p>\r\n\r\n<p>Операционная система Android подходит как для работы, так и для развлечений. Она имеет широкие возможности персонализации, отличается высокой скоростью работы, удобством и полной совместимостью с вашими любимыми приложениями Google. Широкий спектр модулей связи - Устройство оснащено разъемом Micro USB для зарядки и подключения периферийных устройств, а также слотом для карты microSD, с помощью которой удобно хранить и переносить данные.</p>\r\n\r\n<p><strong>Самые современные процессоры</strong></p>\r\n\r\n<p>Четырехъядерный процессор Tab 3-730F отлично справляется с режимом многозадачности, обеспечивает быструю работу Android и уменьшает количество пауз. Идеальный выбор для любителей игр и фильмов.</p>\r\n\r\n<p><strong>Широкий спектр модулей связи</strong></p>\r\n\r\n<p>Устройство оснащено разъемом Micro USB для зарядки и подключения периферийных устройств, а также слотом для карты microSD, с помощью которой удобно хранить и переносить данные.</p>\r\n\r\n<p><strong>Продолжительное время автономной работы </strong></p>\r\n\r\n<p>Планшет Tab 3 гарантирует до 8-10 часов работы в Интернете через Wi-Fi без перезарядки аккумулятора. Две камеры - Планшет оснащен задней (2 Мп) и фронтальной камерами, позволяющими делать замечательные снимки. Встроенная флеш-память с возможностью расширения позволит разместить огромное количество фотографий. Купить Lenovo TAB 3-730F 7&quot; 16GB (ZA110166UA) Black Вы можете, оформив заказ у нас на сайте, а также по телефону горячей линии 0-800-300-100.<br />\r\n&nbsp;</p>\r\n','<p>Операционная система: Android; Диагональ дисплея: 7&quot;; Разрешение дисплея: 1024x600; Тип матрицы: IPS; Процессор: MTK 8735; Количество ядер процессора: 4;<br />\r\n&nbsp;</p>\r\n','<h2 style=\"text-align:center\">Технические характеристики</h2>\r\n\r\n<p><strong>Дисплей </strong></p>\r\n\r\n<p>Диагональ дисплея: 7&quot;</p>\r\n\r\n<p>Разрешение дисплея: 1024x600</p>\r\n\r\n<p>Тип матрицы: IPS</p>\r\n\r\n<p>Операционная система: Android 6.0</p>\r\n\r\n<p>Процессор Процессор: MTK 8735</p>\r\n\r\n<p>Количество ядер процессора: 4</p>\r\n\r\n<p><strong>Оперативная память </strong></p>\r\n\r\n<p>Объем оперативной памяти: 1 Гб</p>\r\n\r\n<p><strong>Носители информации</strong></p>\r\n\r\n<p>Встроенная память: 16 Гб</p>\r\n\r\n<p><strong>Беспроводные коммуникации </strong></p>\r\n\r\n<p>Беспроводные технологии: Bluetooth, GPS, Wi-Fi</p>\r\n\r\n<p><strong>Камера </strong></p>\r\n\r\n<p>Камера: 5 Мп Web-камера: 2 Мп</p>\r\n\r\n<p><strong>Интерфейсы </strong></p>\r\n\r\n<p>Интерфейсы и подключения: microUSB, Разъем 3.5 мм</p>\r\n\r\n<p><strong>Аккумулятор</strong></p>\r\n\r\n<p>Емкость аккумулятора: Li-Ion 3450 мА*ч</p>\r\n\r\n<p><strong>Гарантия </strong></p>\r\n\r\n<p>Гарантийный срок: 12 месяцев</p>\r\n\r\n<p><strong>Дополнительно</strong>: Характеристики и комплектация товара могут быть изменены производителем без уведомления. Обмен и возврат товара: Обмен и возврат товара осуществляется в течение 14 дней после покупки, согласно закону Украины &quot;О защите прав потребителей Украины&quot;</p>\r\n','<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/InIr44_qQYQ\" frameborder=\"0\" allowfullscreen></iframe>','2017-09-24 18:56:56',1,0,0,1,3,'Планшеты',4,2),(48,'Samsung ProBook 250',5999,'Samsung','keywords','','','../noimage.png','','','','','2017-10-07 19:35:06',0,0,0,1,0,'Ноутбуки',6,1),(49,'iPhone',9000,'Apple','keywords','','','../noimage.png','','','','','2017-10-07 19:42:01',0,0,0,1,0,'Мобильные телефоны',1,1),(50,'iPad3',12000,'Apple','','','','../noimage.png','','','','','2017-10-07 19:47:29',0,0,0,1,0,'Планшеты',7,1);
/*!40000 ALTER TABLE `tableproducts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploadsimages`
--

DROP TABLE IF EXISTS `uploadsimages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploadsimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploadsimages`
--

LOCK TABLES `uploadsimages` WRITE;
/*!40000 ALTER TABLE `uploadsimages` DISABLE KEYS */;
INSERT INTO `uploadsimages` VALUES (1,1,'apple_iphone_5s1.jpg'),(2,1,'apple_iphone_5s2.jpg'),(3,1,'123.gif'),(7,39,'motorola_sm4327ae7k7_images_1650133412.jpg'),(8,39,'motorola_sm4327ae7k7_images_1650133503.jpg'),(9,39,'motorola_sm4372ae7k7_images_1650133867.jpg'),(10,40,'LpvGLyDbjc405090.jpg'),(11,40,'LpvGLyDbjc405091.jpg'),(12,40,'LpvGLyDbjc405092.jpg');
/*!40000 ALTER TABLE `uploadsimages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `fam` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `tel` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL,
  `ip` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-07 21:54:04
