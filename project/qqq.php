CREATE TABLE `board` (
	`idx` INT(10,0) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`pw` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`title` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`content` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`date` DATE NOT NULL,
	`hit` INT(10,0) NOT NULL,
	PRIMARY KEY (`idx`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=28
;

CREATE TABLE `product` (
	`index` INT(10,0) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`reference` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`price` INT(10,0) NOT NULL,
	`content` TEXT(65535) NOT NULL COLLATE 'utf8_general_ci',
	`date` DATE NOT NULL,
	`hit` INT(10,0) NOT NULL,
	PRIMARY KEY (`index`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=4
;