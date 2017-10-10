CREATE TABLE `products` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) UNSIGNED DEFAULT NULL,
  `bank_id` smallint(5)  UNSIGNED NOT NULL,
  `product_category` char(2)  NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `term` int(11) UNSIGNED DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `account_creation_fee` int(11) UNSIGNED DEFAULT NULL,
  `account_creation_fee_discount` varchar(255) DEFAULT NULL,
  `monthly payment` int(11) UNSIGNED DEFAULT NULL,
  `account_fee` varchar(255) DEFAULT NULL,
  `contract_amount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_id` (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`);
