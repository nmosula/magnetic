#SXD20|20009|50045|50204|2016.03.29 16:01:04|magnetic_db|0|7|14|
#TA mo_admin`1`88|mo_contact`1`2220|mo_golovna`1`2360|mo_order_list`3`51|mo_orders`2`48|mo_product`4`328|mo_users`2`224
#EOH

#	TC`mo_admin`utf8_general_ci	;
CREATE TABLE `mo_admin` (
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL default 'admin',
  `pass` varchar(50) NOT NULL default '21232f297a57a5a743894a0e4a801fc3',
  `email` varchar(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8	;
#	TD`mo_admin`utf8_general_ci	;
INSERT INTO `mo_admin` VALUES 
('Назар','Мосула','admin','21232f297a57a5a743894a0e4a801fc3','nmosula@yahoo.com','')	;
#	TC`mo_contact`utf8_general_ci	;
CREATE TABLE `mo_contact` (
  `id` int(10) NOT NULL auto_increment,
  `phone` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `skype` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `social_facebook` varchar(250) NOT NULL,
  `social_twitter` varchar(250) NOT NULL,
  `social_pinterest` varchar(250) NOT NULL,
  `social_linkedin` varchar(250) NOT NULL,
  `social_instagram` varchar(250) NOT NULL,
  `social_dribbble` varchar(250) NOT NULL,
  `social_vk` varchar(250) NOT NULL,
  `social_ok` varchar(250) NOT NULL,
  `social_google_plus` varchar(250) NOT NULL,
  `short` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8	;
#	TD`mo_contact`utf8_general_ci	;
INSERT INTO `mo_contact` VALUES 
(1,'+38 (0352) 523831','support@magneticone.com','','Бродівська, 5Б\r\nТернопiль,\r\nУкраїна\r\n46000 ','https://www.facebook.com/pages/MagneticOne/12510181837?ref=sgm','https://twitter.com/magneticone2','','','','','','','','MagneticOne – компанія-розробник інноваційного програмного забезпечення для потреб електронної комерції.','<p>Компанія MagneticOne була заснована в 2001 році у місті Тернополі. Наше програмне забезпечення допоможе вам збільшити об&rsquo;єми продаж та ефективно організувати спілкування з вашими клієнтами. Ми цінуємо час та потреби наших клієнтів. Програмне забезпечення легко інсталювати &ndash; це не потребує особливих технічних навиків.</p>\r\n<p>Клієнти MagneticOne це власники інтернет магазинів &ndash; від початківців до великих підприємств, які встигли зарекомендувати себе на ринку. Вони усвідомлюють потребу свого бізнесу у інноваційних, ефективних рішеннях, які б допомогли їм привабити покупців та збільшити рівень доходів.</p>\r\n<p>Наша команда складається з талановитих програмістів, тестерів та маркетологів. Ми за короткий проміжок часу зуміли зайняти свою нішу на ринку продуктів для електронної комерції та продовжуємо активно розвиватися.&nbsp;</p>\r\n<p>Ми спеціалізуємося на створенні складних веб-додатків, електронних магазинах, порталах, системах оплати та інших сучасних системах мережі Інтернет.</p>')	;
#	TC`mo_golovna`utf8_general_ci	;
CREATE TABLE `mo_golovna` (
  `id` int(10) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8	;
#	TD`mo_golovna`utf8_general_ci	;
INSERT INTO `mo_golovna` VALUES 
(0,'<p>MagneticOne &ndash; компанія-розробник інноваційного програмного забезпечення для потреб електронної комерції.</p>\r\n<p>Компанія MagneticOne була заснована в 2001 році у місті Тернополі. Наше програмне забезпечення допоможе вам збільшити об&rsquo;єми продаж та ефективно організувати спілкування з вашими клієнтами. Ми цінуємо час та потреби наших клієнтів. Програмне забезпечення легко інсталювати &ndash; це не потребує особливих технічних навиків.</p>\r\n<p>Клієнти MagneticOne це власники інтернет магазинів &ndash; від початківців до великих підприємств, які встигли зарекомендувати себе на ринку. Вони усвідомлюють потребу свого бізнесу у інноваційних, ефективних рішеннях, які б допомогли їм привабити покупців та збільшити рівень доходів.</p>\r\n<p>Наша команда складається з талановитих програмістів, тестерів та маркетологів. Ми за короткий проміжок часу зуміли зайняти свою нішу на ринку продуктів для електронної комерції та продовжуємо активно розвиватися.&nbsp;</p>\r\n<p>Ми спеціалізуємося на створенні складних веб-додатків, електронних магазинах, порталах, системах оплати та інших сучасних системах мережі Інтернет.</p>')	;
#	TC`mo_order_list`utf8_general_ci	;
CREATE TABLE `mo_order_list` (
  `id_order` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `cina` float NOT NULL,
  `kilk` int(5) NOT NULL,
  KEY `id_order` (`id_order`,`id_product`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8	;
#	TD`mo_order_list`utf8_general_ci	;
INSERT INTO `mo_order_list` VALUES 
(2,1,45,2),
(2,4,120,1),
(3,1,45,1)	;
#	TC`mo_orders`utf8_general_ci	;
CREATE TABLE `mo_orders` (
  `id` int(10) NOT NULL auto_increment,
  `id_user` int(10) NOT NULL,
  `data` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8	;
#	TD`mo_orders`utf8_general_ci	;
INSERT INTO `mo_orders` VALUES 
(3,2,'1459244085'),
(2,1,'1459242608')	;
#	TC`mo_product`utf8_general_ci	;
CREATE TABLE `mo_product` (
  `id` bigint(20) NOT NULL auto_increment,
  `id_order` int(10) NOT NULL,
  `name` varchar(100) NOT NULL default '',
  `short` text NOT NULL,
  `full` text NOT NULL,
  `cina` float(10,2) NOT NULL default '0.00',
  `image` varchar(100) NOT NULL default 'NO',
  `kilk` int(10) NOT NULL default '0',
  `data` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8	;
#	TD`mo_product`utf8_general_ci	;
INSERT INTO `mo_product` VALUES 
(1,1,'Пантера','Чорна пантера','',45.00,'p_1459096163.jpg',3,'1459096163'),
(2,3,'Дельфін','','',123.00,'p_1459096318.jpg',2,'1459096318'),
(3,2,'Гріфін','короткий опис','',56.00,'p_1459096344.jpg',12,'1459096344'),
(4,4,'Павлін','','',120.00,'p_1459096428.jpg',15,'1459096428')	;
#	TC`mo_users`utf8_general_ci	;
CREATE TABLE `mo_users` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL default '',
  `email` varchar(250) NOT NULL default '',
  `pass` varchar(100) NOT NULL default '',
  `phone` varchar(50) NOT NULL default '',
  `data` varchar(100) NOT NULL default '',
  `ip` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8	;
#	TD`mo_users`utf8_general_ci	;
INSERT INTO `mo_users` VALUES 
(1,'Назар','nmosula@yahoo.com','21232f297a57a5a743894a0e4a801fc3','+380673554141','1459180350','127.0.0.1'),
(2,'Наталя','nataliya@lak-jak.com.ua','e10adc3949ba59abbe56e057f20f883e','+380966971152','1459243075','127.0.0.1')	;
