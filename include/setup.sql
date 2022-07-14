CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `author` varchar(300) NOT NULL,
  `date` date NOT NULL DEFAULT CURDATE(),
  `keyword` varchar(300) DEFAULT NULL,
  `abstract` varchar(5000) DEFAULT NULL,
  `path` varchar(300) NOT NULL,
  `type` varchar(30) NOT NULL,
  `path_zip` varchar(300) DEFAULT NULL,
  `path_img` varchar(300) DEFAULT NULL,
  `path_url` varchar(300) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `text` MEDIUMTEXT DEFAULT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
