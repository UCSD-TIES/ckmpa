CREATE TABLE `coastkeeper_volunteer` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL,
	`username` varchar(255) NOT NULL,
	`password` varchar(32) NOT NULL,
	`is_admin` smallint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `coastkeeper_location` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`coastkeeper_datasheet_id` int(11) NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `coastkeeper_section` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`coastkeeper_location_id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `coastkeeper_datasheet` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `coastkeeper_datasheet_category` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`coastkeeper_datasheet_id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `coastkeeper_datasheet_entry` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`coastkeeper_datasheet_category_id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	`use_report` smallint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `coastkeeper_patrol`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`coastkeeper_volunteer_id` int(11) NOT NULL,
	`coastkeeper_partner_id` int(11) NULL,
	`coastkeeper_location_id` int(11) NOT NULL,
	`date` DATE NOT NULL,
	`finished` smallint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `coastkeeper_patrol_entry`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`coastkeeper_patrol_id` int(11) NOT NULL,
	`coastkeeper_section_id` int(11) NOT NULL,
	`start_time` TIME NULL,
	`end_time` TIME NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `coastkeeper_patrol_tally`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`coastkeeper_patrol_entry_id` int(11) NOT NULL,
	`coastkeeper_datasheet_entry_id` int(11) NOT NULL,
	`tally` int(11) DEFAULT 0 NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;