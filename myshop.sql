-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 02 2017 г., 17:45
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `myshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buyproducts`
--

CREATE TABLE `buyproducts` (
  `id` int(11) NOT NULL,
  `buy_id_order` int(11) NOT NULL,
  `buy_id_product` int(11) NOT NULL,
  `buy_count_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_id_product` int(11) NOT NULL,
  `cart_price` int(11) NOT NULL,
  `cart_count` int(11) NOT NULL,
  `cart_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cart_sid` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `brand` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `type`, `brand`) VALUES
(1, 'mobile', 'Nokia'),
(2, 'mobile', 'Sony'),
(3, 'mobile', 'Samsung'),
(4, 'mobile', 'Apple'),
(5, 'mobile', 'HTC'),
(6, 'mobile', 'Fly'),
(7, 'mobile', 'Lenovo'),
(8, 'mobile', 'Huavei'),
(9, 'notebook', 'Lenovo'),
(10, 'notebook', 'Fujitsu'),
(11, 'notebook', 'HP'),
(12, 'notebook', 'Sony'),
(13, 'notebook', 'Acer'),
(14, 'notebook', 'Asus'),
(15, 'tablet', 'Lenovo'),
(16, 'tablet', 'Sony'),
(17, 'tablet', 'Asus'),
(18, 'tablet', 'Xiaomi'),
(19, 'tablet', 'Cube'),
(20, 'tablet', 'Huawei'),
(21, 'tablet', 'Apple'),
(23, 'mobile', 'TDK');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `date`) VALUES
(1, 'Акция! Кулон с бриллиантом за 1399 грн!', 'Не упустите возможность приобрести акционный кулон с бриллиантом за 1399 грн!', '2017-04-08'),
(2, 'Акция! Скидки на акционные детские товары Zazu!', 'Не упустите возможность приобрести акционные детские товары Zazu со скидками!', '2017-04-09'),
(3, 'Акция! Суперцена на веб-камеру Manhattan Combo + гарнитура!', 'Не упустите возможность приобрести веб-камеру Manhattan Combo + гарнитура по суперцене!', '2017-04-10'),
(4, 'Акция! К акционным сумкам и рюкзакам Thule - УМБ 5200 mAh в подарок!', 'Каждый покупатель акционных сумок и рюкзаков Thule получает в подарок УМБ Silicon Power 5200 mAh White*! \r\nПериод проведения акции: 8 апреля — 28 апреля 2017 г. \r\nСпешите, количество подарков ограничено!\r\n', '2017-04-11');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_confirm` varchar(10) NOT NULL DEFAULT 'no',
  `order_delivery` varchar(255) NOT NULL,
  `order_pay` varchar(64) NOT NULL,
  `order_type_pay` varchar(128) NOT NULL,
  `order_fio` text NOT NULL,
  `order_address` text NOT NULL,
  `order_tel` varchar(64) NOT NULL,
  `order_note` text NOT NULL,
  `order_email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `regadmin`
--

CREATE TABLE `regadmin` (
  `id` int(11) NOT NULL,
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
  `rev_adm` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `regadmin`
--

INSERT INTO `regadmin` (`id`, `login`, `pass`, `fio`, `role`, `email`, `tel`, `rev_zak`, `wrk_zak`, `del_zak`, `add_tov`, `edt_tov`, `del_tov`, `mod_otz`, `del_otz`, `rev_cln`, `del_cln`, `add_nes`, `del_nes`, `add_cat`, `del_cat`, `rev_adm`) VALUES
(2, 'admin', '$2y$10$3PeOiv4.phJrdKw/XM1UT..A4bQ8CTIu2CCZFA6ari8kykBO13zzC', 'Миусов Артем', 'Администратор', 'miusov86@gmail.com', '0977919245', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'moder', '$2y$10$Wh/qH5xIrBC1DaDcmKNauuWKq25O9hv6YE61.fSir1HVjeGNcqmMO', 'James Bond', 'Модератор', 'mail@mail.ru', '123456789', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `good_review` text NOT NULL,
  `bad_review` text NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL,
  `moderat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `products_id`, `name`, `good_review`, `bad_review`, `comment`, `date`, `moderat`) VALUES
(1, 1, 'Миусов Артем', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consequatur eum fugiat, iste modi molestiae pariatur quam qui saepe vitae.GOOD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus animi asperiores cupiditate ducimus eveniet iure, iusto labore maxime modi molestias nostrum nulla qui quidem recusandae, reiciendis reprehenderit totam veniam vero.BAD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus accusantium ad adipisci alias atque commodi corporis deleniti deserunt dicta dolore, doloribus eius eos excepturi expedita fugit in ipsum itaque laboriosam magnam minus neque odit officiis quas reiciendis reprehenderit sequi vel. Aut exercitationem magnam officia officiis ratione soluta suscipit temporibus?COMMENT', '2017-04-24', 1),
(2, 1, 'Миусов Артем2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consequatur eum fugiat, iste modi molestiae pariatur quam qui saepe vitae.GOOD2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus animi asperiores cupiditate ducimus eveniet iure, iusto labore maxime modi molestias nostrum nulla qui quidem recusandae, reiciendis reprehenderit totam veniam vero.BAD2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus accusantium ad adipisci alias atque commodi corporis deleniti deserunt dicta dolore, doloribus eius eos excepturi expedita fugit in ipsum itaque laboriosam magnam minus neque odit officiis quas reiciendis reprehenderit sequi vel. Aut exercitationem magnam officia officiis ratione soluta suscipit temporibus?COMMENT2', '2017-04-23', 1),
(14, 9, 'Вася Пупкин', 'Хороший телефон', 'нет', 'все ОК', '2017-04-24', 1),
(15, 11, 'Лена Головач', 'нет плюсов', 'куча минусов', 'а так все хорошо', '2017-04-24', 1),
(17, 5, 'Лена Бородач', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consequatur eum fugiat, iste modi molestiae pariatur quam qui saepe vitae.GOOD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consequatur eum fugiat, iste modi molestiae pariatur quam qui saepe vitae.GOOD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus accusantium ad adipisci alias atque commodi corporis deleniti deserunt dicta dolore, doloribus eius eos excepturi expedita fugit in ipsum itaque laboriosam magnam minus neque odit officiis quas reiciendis reprehenderit sequi vel. Aut exercitationem magnam officia officiis ratione soluta suscipit temporibus?COMMENT', '2017-04-27', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tableproducts`
--

CREATE TABLE `tableproducts` (
  `id` int(11) NOT NULL,
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
  `like_ok` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tableproducts`
--

INSERT INTO `tableproducts` (`id`, `title`, `price`, `brand`, `seo_words`, `seo_description`, `mini_description`, `image`, `description`, `mini_features`, `features`, `link_video`, `created_at`, `new`, `leader`, `sale`, `visible`, `count`, `type_tovara`, `brand_id`, `like_ok`) VALUES
(1, 'Apple iPhone 5s 16GB Space Gray', 8500, 'Apple', '', '', '', 'iphone.jpg', 'Незаменим с момента создания Процессор A7 с 64-битной архитектурой. Датчик идентификации по отпечатку пальца. Усовершенствованная камера, которая стала ещё быстрее. Операционная система, разработанная специально для 64-битной архитектуры. Любая из этих функций позволила бы смартфону быть на шаг впереди других. А со всеми этими функциями iPhone просто опережает своё время.', 'Диагональ экрана Подробнее  4\r\nРазрешение дисплея Подробнее  1136x640\r\nТип матрицы Подробнее  IPS Подробнее\r\nКоличество точек касания  10\r\nМатериал экрана  Стекло', '', '', '2017-04-25 14:23:00', 1, 0, 0, 1, 113, 'mobile', 4, 3),
(2, 'Samsung Galaxy S8', 9000, 'Samsung ', '', '', '', 'samsungS8.jpg', '', 'Диагональ экрана Подробнее  6.2\r\nРазрешение дисплея Подробнее  2960x1440\r\nТип матрицы Подробнее  Super AMOLED Подробнее\r\nКоличество точек касания  10\r\nМатериал экрана  Стекло', '', '', '2017-04-24 18:43:00', 0, 0, 0, 1, 6, 'mobile', 3, 1),
(3, 'Ноутбук Asus VivoBook Max X541SA (X541SA-XO041D) Black', 7400, 'Asus', '', '', '', 'asus_x541.jpg', '', 'Экран 15.6\" (1366x768) HD, матовый / Intel Celeron N3060 (1.6 - 2.48 ГГц) / RAM 4 ГБ / HDD 500 ГБ / Intel HD Graphics 400 / DVD SuperMulti / LAN / Wi-Fi / Bluetooth / веб-камера / DOS / 2 кг / черный', '', '', '2017-04-25 11:57:00', 0, 1, 0, 1, 2, 'notebook', 14, 1),
(4, 'Apple M5 2/16GB White ', 3200, 'Apple', '', '', '', 'meizu_m5.jpg', '', 'Экран (5.2\", IPS, 1280x720)/ MediaTek MT6750 (4x1.5 ГГц + 4x1 ГГц)/ основная камера: 13 Мп, фронтальная камера: 5 Мп/ RAM 2 ГБ/ 16 ГБ встроенной памяти + microSD/SDHC (до 128 ГБ)/ 3G/ LTE/ GPS/ поддержка 2х SIM-карт (Nano-SIM)/ YunOS 5.1.1/ 3070 мА*ч', '', '', '2017-04-24 16:51:00', 1, 0, 0, 1, 8, 'mobile', 4, 1),
(5, 'Ноутбук Acer Extensa EX2519-C00V', 3500, 'Acer', '', '', '', 'acer_nx.jpg', '', 'Экран 15.6\'\' (1366x768) HD, матовый / Intel Celeron N3060 (1.6 - 2.48 ГГц) / RAM 4 ГБ / HDD 500 ГБ / Intel HD Graphics 400 / DVD Super Multi / LAN / Wi-Fi / Bluetooth / веб-камера / без ОС / 2.4 кг / черный', '', '', '2017-04-21 15:36:00', 0, 0, 1, 1, 11, 'notebook', 13, 1),
(6, 'Ноутбук Lenovo IdeaPad 510-15IKB', 19500, 'Lenovo', '', '', '', 'lenovo_80.jpg', '', 'Экран 15.6\" IPS (1920x1080) Full HD, матовый / Intel Core i5-7200U (2.5 - 3.1 ГГц) / RAM 8 ГБ / SSD 256 ГБ / nVidia GeForce GT 940MX, 2 ГБ / DVD Super Multi / LAN / Wi-Fi / Bluetooth / веб-камера / DOS / 2.2 кг / черный', '', '', '2017-04-24 16:49:00', 0, 0, 1, 1, 8, 'notebook', 9, 1),
(7, 'Apple A1490 iPad mini 2 Wi-Fi 4G 32GB', 13200, 'Apple', '', '', '', 'apple_ipad_mini.jpg', '', 'Экран 7.9\" (2048 x 1536) емкостной Multi-Touch / Apple A7 (1.3 ГГц) / ОЗУ 1 ГБ / Флеш-память 32 ГБ / Wi-Fi / Bluetooth 4.0 / 3G / EV-DO / AGPS / основная камера 5 Мп, фронтальная 1.2 Мп / ОС iOS 7.0 / вес 341 г / серебряный', '', '', '2017-04-18 10:48:00', 0, 1, 0, 1, 5, 'tablet', 21, 1),
(8, 'Планшет Huawei MediaPad T1 7.0 8GB 3G Silver', 4500, 'Huawei', '', '', '', 'huawei_mediapad.jpg', '', 'Экран 7\" IPS (1024x600) MultiTouch / Spreadtrum SC7731G (1.2 ГГц) / RAM 1 ГБ / 8 ГБ встроенной памяти + microSD / 3G / Wi-Fi b/g/n / Bluetooth 4.0 / основная камера 2 Мп, фронтальная 2 Мп / GPS / ОС Android 4.4 / 278 г / серебристый', '', '', '2017-04-24 15:24:00', 1, 0, 0, 1, 3, 'tablet', 20, 2),
(9, 'Apple iPhone 7 32GB Rose Gold', 22000, 'Apple', '', '', '', 'apple_iphone_7.jpg', '', 'Экран (4.7\", IPS, 1334x750)/ Apple A10 Fusion/ основная камера: 12 Мп, фронтальная камера: 7 Мп/ RAM 2 ГБ/ 32 ГБ встроенной памяти/ 3G/ LTE/ GPS/ Nano-SIM/ iOS 10', '', '', '2017-04-24 16:43:00', 0, 0, 0, 1, 4, 'mobile', 4, 2),
(10, 'Nokia 3 Dual Sim Silver', 4200, 'Nokia', '', '', '', 'nokia_3.jpg', '', '<p>Фронтальная и основная камера 8 Мп с автофокусом Связь LTE 4G Поляризованный дисплей Corning Gorilla Glass с диагональю 5&quot;</p>\r\n', '', '', '2017-04-27 12:31:12', 0, 1, 0, 1, 6, 'mobile', 1, 1),
(11, 'Nokia 6 Dual Sim Silver ', 7000, 'Nokia', '', '', '<p>motorola_sm4372ae7k7_images_1650133685.jpg</p>\r\n', 'nokia_6.jpg', '', '<p>Яркий дисплей Full HD с диагональю 5.5 Реалистичный звук благодаря Dolby Atmos Камера 16 Мп</p>\r\n', '', '', '2017-04-27 12:31:21', 0, 0, 0, 1, 13, 'mobile', 1, 2),
(39, 'Motorola MOTO G4 (XT1622) Black', 4333, 'Nokia', 'Motorola MOTO G4', 'Motorola MOTO G4, Motorola MOTO G4 (XT1622) Black', '<p>*&nbsp;Характеристики и комплектация товара могут изменяться производителем без уведомления</p>\r\n\r\n<p>*&nbsp;Внимание! Все телефоны имеют русские буквы на клавиатуре и русифицированное меню.<br />\r\n<br />\r\n* Объем встроенной памяти зависит от операционной системы, а также предустановленных производителем приложений.</p>\r\n', 'n0sDATOPtVmotorola_sm4372ae7k7_images_1650133685.jpg', '<h2 style=\"text-align:center\"><span style=\"font-size:22px\"><strong>Особенности</strong></span></h2>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"Motorola MOTO G4 (XT1622) Black\" src=\"https://i2.rozetka.ua/goods/961830/motorola_sm4372ae7k7_review_images_961830306.png\" style=\"width:100%\" /></p>\r\n\r\n<p>Процессор, дисплей и память, созданные обеспечивать впечатляющие результаты&nbsp;<br />\r\n<br />\r\nЖизнь отличается бешеным темпом. Будьте впереди.<br />\r\nMoto G создан для вашего быстрого, наполненного мультимедиа образа жизни.</p>\r\n\r\n<p><img alt=\"Motorola MOTO G4 (XT1622) Black\" src=\"https://i1.rozetka.ua/goods/961830/motorola_sm4372ae7k7_review_images_961830313.png\" style=\"width:100%\" /></p>\r\n\r\n<p>Автономная работа в течение целого дня и технология TurboPower<br />\r\n<br />\r\nДлительное время автономной работы. Благодаря аккумулятору 3000 мАч, Moto G будет работать в течение целого дня, и даже дольше.</p>\r\n\r\n<p><img alt=\"Motorola MOTO G4 (XT1622) Black\" src=\"https://i1.rozetka.ua/goods/961830/motorola_sm4372ae7k7_review_images_961830320.png\" style=\"width:100%\" /></p>\r\n\r\n<p>Быстрая работа телефона. Ничего лишнего<br />\r\n<br />\r\nУвеличена производительность устройства благодаря &quot;чистой&quot; версии ОС Andriod, не содержит ненужных программ. Благодаря отсутствию ненужных программ, ваш Moto G работает быстрее. ОС Andriod возможно обновить до версии 7.0 (Nougat).</p>\r\n\r\n<p><img alt=\"Motorola MOTO G4 (XT1622) Black\" src=\"https://i1.rozetka.ua/goods/961830/motorola_sm4372ae7k7_review_images_961830327.png\" style=\"width:100%\" /></p>\r\n\r\n<p>Новый, более тонкий корпус, который лучше помещается в кармане<br />\r\n<br />\r\nС быстрым четырехъядерным процессором Qualcomm Snapdragon 410, 1.4 ГГц, и современной видеокартой Adreno вы сможете переключаться между вашими любимыми приложениями без задержек.</p>\r\n\r\n<p><img alt=\"Motorola MOTO G4 (XT1622) Black\" src=\"https://i2.rozetka.ua/goods/961830/motorola_sm4372ae7k7_review_images_961830334.png\" style=\"width:100%\" /></p>\r\n\r\n<p>Делайте профессиональные снимки &mdash; легко<br />\r\n<br />\r\nВам не нужно быть профессиональным фотографом для того, чтобы делать высококачественные снимки. Moto G оснащен камерой 13 Мпикс с замечательным аппаратным обеспечением, включая двойную LED-вспышку и диафрагму fl2.0, которая помогает делать отличные фото в пасмурные дни.</p>\r\n\r\n<h1>Таблица сравнения мобильных телефонов Motorola серии G4</h1>\r\n\r\n<table border=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Модель</td>\r\n			<td><a href=\"http://rozetka.com.ua/motorola_sm4410ae7k7/p9856648/\" target=\"_blank\">G4 Play</a></td>\r\n			<td><a href=\"http://rozetka.com.ua/motorola_sm4372ae7k7/p9858713/\" target=\"_blank\">G4</a></td>\r\n			<td><a href=\"http://rozetka.com.ua/motorola_sm4377ae7k7/p9859637/\" target=\"_blank\">G4 Plus</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Экран</td>\r\n			<td>5&quot;, IPS, 1280x720</td>\r\n			<td>5.5&quot;, IPS, 1920x1080</td>\r\n			<td>5.5&quot;, IPS, 1920x1080</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Память</td>\r\n			<td>2 ГБ / 16 ГБ</td>\r\n			<td>2 ГБ / 16 ГБ</td>\r\n			<td>2 ГБ / 16 ГБ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Аккумулятор</td>\r\n			<td>2800 мА*ч</td>\r\n			<td>3000 мА*ч</td>\r\n			<td>3000 мА*ч</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Камеры</td>\r\n			<td>8 Мп, 5 Мп</td>\r\n			<td>13 Мп, 5 Мп</td>\r\n			<td>16 Мп, 5 Мп</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Процессор</td>\r\n			<td>Qualcomm Snapdragon 410&nbsp;<br />\r\n			(4 x 1.2 ГГц)</td>\r\n			<td>Qualcomm Snapdragon 617&nbsp;<br />\r\n			(8 x 1.5 ГГц)</td>\r\n			<td>Qualcomm Snapdragon 617&nbsp;<br />\r\n			(8 x 1.5 ГГц)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Экран (5.5&quot;, IPS, 1920x1080)/ Qualcomm Snapdragon 617 (1.5 ГГц)/ основная камера: 13 Мп, фронтальная камера: 5 Мп/ RAM 2 ГБ/ 16 ГБ встроенной памяти + microSD/SDHC (до 128 ГБ)/ 3G/ LTE/ GPS/ поддержка 2х SIM-карт (Micro-SIM)/ Android 6.0 (Marshmallow) / 3000 мА*ч\n', '<h2>Технические характеристики&nbsp;Motorola MOTO G4 (XT1622) Black</h2>\r\n\r\n<p><strong>Диагональ экрана:</strong>&nbsp;5.5</p>\r\n\r\n<p><strong>Разрешение дисплея:</strong>&nbsp;FullHD (1920x1080)</p>\r\n\r\n<p><strong>Количество мегапикселей фронтальной камеры:</strong>&nbsp;5 Мп</p>\r\n\r\n<h3><strong>Процессор:</strong>&nbsp;Qualcomm Snapdragon 617</h3>\r\n\r\n<p><strong>Количество ядер:</strong>&nbsp;8</p>\r\n\r\n<p><strong>Видеоядро:</strong>&nbsp;Qualcomm Adreno 405</p>\r\n\r\n<p><strong>Частота:</strong>&nbsp;1.5 ГГц</p>\r\n\r\n<p><strong>Емкость аккумулятора:</strong>&nbsp;3000 мА*ч</p>\r\n\r\n<p><strong>Возможность беспроводной зарядки:</strong>&nbsp;Нет</p>\r\n\r\n<p><strong>Быстрая зарядка:</strong>&nbsp;Нет</p>\r\n\r\n<p><strong>Съемная АКБ:</strong>&nbsp;Нет</p>\r\n\r\n<p><strong>Стандарт связи:</strong></p>\r\n\r\n<p>2G (EDGE)&nbsp;<br />\r\n3G (WCDMA/UMTS )&nbsp;<br />\r\n4G (LTE)</p>\r\n\r\n<p><strong>Материал корпуса:</strong>&nbsp;Поликарбонат</p>\r\n\r\n<p><strong>Разъем зарядного устройства:</strong>&nbsp;microUSB</p>\r\n\r\n<p><strong>Разъем для подключения к ПК:</strong>&nbsp;microUSB</p>\r\n\r\n<p><strong>Разъем для наушников:</strong>&nbsp;3.5 мм</p>\r\n\r\n<p><strong>GPS:</strong>&nbsp;Есть</p>\r\n\r\n<p><strong>A-GPS:</strong>&nbsp;Есть</p>\r\n\r\n<p><strong>Beidou:</strong>&nbsp;Нет</p>\r\n\r\n<p><strong>ГЛОНАСС:</strong>&nbsp;Есть</p>\r\n\r\n<p><strong>Вес, г:</strong>&nbsp;155</p>\r\n\r\n<p><strong>Ширина:</strong>&nbsp;76.6 мм</p>\r\n\r\n<p><strong>Высота:</strong>&nbsp;153 мм</p>\r\n\r\n<p><strong>Глубина:</strong>&nbsp;9.8 мм</p>\r\n\r\n<p><strong>Наличие&nbsp;FM-радио:</strong>&nbsp;Есть</p>\r\n\r\n<p><strong>Работа без гарнитуры:</strong>&nbsp;Нет</p>\r\n\r\n<p><strong>Беспроводные технологии:</strong></p>\r\n\r\n<p>Wi-Fi 802.11 a/b/g/n&nbsp;<br />\r\nBluetooth 4.2<br />\r\nGPS / A-GPS / ГЛОНАСС</p>\r\n\r\n<p><strong>Дополнительные функции:</strong>&nbsp;Поддержка OTG</p>\r\n\r\n<p><strong>Операционная система:</strong>&nbsp;Android</p>\r\n\r\n<p><strong>Цвет:</strong>&nbsp;Black</p>\r\n\r\n<p><strong>Сканер отпечатков пальцев (Fingerprint):</strong>&nbsp;Нет</p>\r\n\r\n<p><strong>Комплект поставки:</strong></p>\r\n\r\n<p>Мобильный телефон<br />\r\nЗарядное устройство<br />\r\nДокументация</p>\r\n\r\n<p><strong>Гарантия:</strong></p>\r\n\r\n<p><strong>12 месяцев</strong>&nbsp;официальной гарантии от производителя</p>\r\n', '', '2017-04-30 18:23:55', 1, 1, 0, 1, 9, 'mobile', 1, 3),
(40, 'Планшет Lenovo TAB 3-730F 7', 3199, 'Nokia', 'Lenovo TAB 3-730F', 'Планшет Lenovo TAB 3-730F 7\" 16GB (ZA110166UA) Black', '<p>Операционная система: Android;</p>\r\n\r\n<p>Диагональ дисплея: 7&quot;;</p>\r\n\r\n<p>Разрешение дисплея: 1024x600;</p>\r\n\r\n<p>Тип матрицы: IPS;</p>\r\n\r\n<p>Процессор: MTK 8735;</p>\r\n\r\n<p>Количество ядер процессора: 4;</p>\r\n', 'M2OsORo497405089.jpg', '<h2>Обзор Lenovo TAB 3-730F 7&quot; 16GB (ZA110166UA) Black</h2>\r\n\r\n<p><strong>Быстрое и мощное устройство </strong></p>\r\n\r\n<p>Операционная система Android подходит как для работы, так и для развлечений. Она имеет широкие возможности персонализации, отличается высокой скоростью работы, удобством и полной совместимостью с вашими любимыми приложениями Google. Широкий спектр модулей связи - Устройство оснащено разъемом Micro USB для зарядки и подключения периферийных устройств, а также слотом для карты microSD, с помощью которой удобно хранить и переносить данные.</p>\r\n\r\n<p><strong>Самые современные процессоры</strong></p>\r\n\r\n<p>Четырехъядерный процессор Tab 3-730F отлично справляется с режимом многозадачности, обеспечивает быструю работу Android и уменьшает количество пауз. Идеальный выбор для любителей игр и фильмов.</p>\r\n\r\n<p><strong>Широкий спектр модулей связи</strong></p>\r\n\r\n<p>Устройство оснащено разъемом Micro USB для зарядки и подключения периферийных устройств, а также слотом для карты microSD, с помощью которой удобно хранить и переносить данные.</p>\r\n\r\n<p><strong>Продолжительное время автономной работы </strong></p>\r\n\r\n<p>Планшет Tab 3 гарантирует до 8-10 часов работы в Интернете через Wi-Fi без перезарядки аккумулятора. Две камеры - Планшет оснащен задней (2 Мп) и фронтальной камерами, позволяющими делать замечательные снимки. Встроенная флеш-память с возможностью расширения позволит разместить огромное количество фотографий. Купить Lenovo TAB 3-730F 7&quot; 16GB (ZA110166UA) Black Вы можете, оформив заказ у нас на сайте, а также по телефону горячей линии 0-800-300-100.<br />\r\n&nbsp;</p>\r\n', '<p>Операционная система: Android; Диагональ дисплея: 7&quot;; Разрешение дисплея: 1024x600; Тип матрицы: IPS; Процессор: MTK 8735; Количество ядер процессора: 4;<br />\r\n&nbsp;</p>\r\n', '<h2 style=\"text-align:center\">Технические характеристики</h2>\r\n\r\n<p><strong>Дисплей </strong></p>\r\n\r\n<p>Диагональ дисплея: 7&quot;</p>\r\n\r\n<p>Разрешение дисплея: 1024x600</p>\r\n\r\n<p>Тип матрицы: IPS</p>\r\n\r\n<p>Операционная система: Android 6.0</p>\r\n\r\n<p>Процессор Процессор: MTK 8735</p>\r\n\r\n<p>Количество ядер процессора: 4</p>\r\n\r\n<p><strong>Оперативная память </strong></p>\r\n\r\n<p>Объем оперативной памяти: 1 Гб</p>\r\n\r\n<p><strong>Носители информации</strong></p>\r\n\r\n<p>Встроенная память: 16 Гб</p>\r\n\r\n<p><strong>Беспроводные коммуникации </strong></p>\r\n\r\n<p>Беспроводные технологии: Bluetooth, GPS, Wi-Fi</p>\r\n\r\n<p><strong>Камера </strong></p>\r\n\r\n<p>Камера: 5 Мп Web-камера: 2 Мп</p>\r\n\r\n<p><strong>Интерфейсы </strong></p>\r\n\r\n<p>Интерфейсы и подключения: microUSB, Разъем 3.5 мм</p>\r\n\r\n<p><strong>Аккумулятор</strong></p>\r\n\r\n<p>Емкость аккумулятора: Li-Ion 3450 мА*ч</p>\r\n\r\n<p><strong>Гарантия </strong></p>\r\n\r\n<p>Гарантийный срок: 12 месяцев</p>\r\n\r\n<p><strong>Дополнительно</strong>: Характеристики и комплектация товара могут быть изменены производителем без уведомления. Обмен и возврат товара: Обмен и возврат товара осуществляется в течение 14 дней после покупки, согласно закону Украины &quot;О защите прав потребителей Украины&quot;</p>\r\n', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/InIr44_qQYQ\" frameborder=\"0\" allowfullscreen></iframe>', '2017-05-02 15:26:00', 1, 0, 0, 1, 3, 'tablet', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `uploadsimages`
--

CREATE TABLE `uploadsimages` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `uploadsimages`
--

INSERT INTO `uploadsimages` (`id`, `products_id`, `image`) VALUES
(1, 1, 'apple_iphone_5s1.jpg'),
(2, 1, 'apple_iphone_5s2.jpg'),
(3, 1, '123.gif'),
(7, 39, 'motorola_sm4327ae7k7_images_1650133412.jpg'),
(8, 39, 'motorola_sm4327ae7k7_images_1650133503.jpg'),
(9, 39, 'motorola_sm4372ae7k7_images_1650133867.jpg'),
(10, 40, 'LpvGLyDbjc405090.jpg'),
(11, 40, 'LpvGLyDbjc405091.jpg'),
(12, 40, 'LpvGLyDbjc405092.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `fam` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `tel` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL,
  `ip` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buyproducts`
--
ALTER TABLE `buyproducts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `regadmin`
--
ALTER TABLE `regadmin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tableproducts`
--
ALTER TABLE `tableproducts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `uploadsimages`
--
ALTER TABLE `uploadsimages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buyproducts`
--
ALTER TABLE `buyproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `regadmin`
--
ALTER TABLE `regadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `tableproducts`
--
ALTER TABLE `tableproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT для таблицы `uploadsimages`
--
ALTER TABLE `uploadsimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
