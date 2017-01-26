CREATE TABLE IF NOT EXISTS `car` (
	`car_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`year` char(4) NOT NULL,
	`make` varchar(50) NOT NULL,
	`model` varchar(50) NOT NULL,
	`created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`created_user_id` smallint(5) unsigned NOT NULL DEFAULT '0',
	`modified_datetime` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	`modified_user_id` smallint(5) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (`car_id`),
	UNIQUE KEY `car_idx` (`year`,`make`,`model`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT = 'This table is used to store car details';

CREATE TABLE IF NOT EXISTS `owner` (
	`owner_id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`firstname` varchar(70) NOT NULL,
	`lastname` varchar(70) NOT NULL,
	`phone` varchar(50) DEFAULT NULL,
	`city` varchar(50) DEFAULT NULL,
	`state` varchar(25) DEFAULT NULL,
	`zipcode` varchar(15) DEFAULT NULL,
	`address` TEXT NOT NULL,
	`created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`created_user_id` smallint(5) unsigned NOT NULL DEFAULT '0',
	`modified_datetime` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	`modified_user_id` smallint(5) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT = 'This table is used to store owner details';

CREATE TABLE IF NOT EXISTS `car_owner` (
	`car_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
	`owner_id` bigint(11) UNSIGNED NOT NULL DEFAULT 0,
	`active` enum('0','1') NOT NULL DEFAULT 1,
	UNIQUE KEY `car_owner_idx` (`car_id`,`owner_id`),
	FOREIGN KEY `fk_car`(car_id) REFERENCES car(car_id),
	FOREIGN KEY `fk_owner`(owner_id) REFERENCES owner(owner_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT = 'store relation between owner and car';

CREATE TABLE IF NOT EXISTS `invoice` (
	`invoice_id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`owner_id` bigint(11) UNSIGNED NOT NULL DEFAULT 0,
	`car_id` int(11) UNSIGNED NOT NULL DEFAULT 0,	
	`service_date` date NOT NULL ,
	`amount` DECIMAL(7,2) NOT NULL DEFAULT '0.00' ,
	`created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`created_user_id` smallint(5) unsigned NOT NULL DEFAULT '0',
	`modified_datetime` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	`modified_user_id` smallint(5) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (`invoice_id`),
	UNIQUE KEY `car_owner_idx` (`car_id`,`owner_id`),
	FOREIGN KEY `fk_car`(car_id) REFERENCES car(car_id),
	FOREIGN KEY `fk_owner`(owner_id) REFERENCES owner(owner_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT = 'This table is used to store invoice details';