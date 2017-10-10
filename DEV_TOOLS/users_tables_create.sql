CREATE TABLE `users_contact_info` (
  `id` int(11)  UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `iranyitoszam` int(11) DEFAULT NULL,
  `varos` varchar(255) DEFAULT NULL,
  `utca_hazszam` varchar(255) DEFAULT NULL,
  `levelezesi_cim_is` TINYINT(1) UNSIGNED DEFAULT NULL,
  `levelezes_iranyitoszam` int(11) DEFAULT NULL,
  `levelezes_varos` varchar(255) DEFAULT NULL,
  `levelezes_utca_hazszam` varchar(255) DEFAULT NULL,
  `mobiltelefonszam` varchar(20) DEFAULT NULL,
  `email_privat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users_sales_codes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `bank_id` SMALLINT(5) UNSIGNED NOT NULL,
  `kapcsolattarto_fiok_neve` varchar(255) DEFAULT NULL,
  `kapcsolattarto_fiok_kodja` varchar(255) DEFAULT NULL,
  `kapcsolattarto_fiok_cime` varchar(255) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `azonosito` varchar(255) DEFAULT NULL,
  `product_categories` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



