CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `author` varchar(300) NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `keyword` varchar(300) DEFAULT NULL,
  `abstract` TEXT DEFAULT NULL,
  `path` varchar(300) NOT NULL,
  `pdf_hash` char(64) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `path_zip` varchar(300) DEFAULT NULL,
  `zip_hash` char(64) DEFAULT NULL,
  `path_img` varchar(300) DEFAULT NULL,
  `path_url` varchar(300) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  `text` MEDIUMTEXT DEFAULT NULL,
  `last_modified` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TRIGGER IF NOT EXISTS update_modified_timestamp BEFORE UPDATE
ON publications
FOR EACH row
  SET new.last_modified = CURRENT_TIMESTAMP();