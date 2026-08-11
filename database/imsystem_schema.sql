CREATE DATABASE IF NOT EXISTS `imsystem`;
USE `imsystem`;

CREATE TABLE IF NOT EXISTS `location` (
  `location_id` INT(11) NOT NULL AUTO_INCREMENT,
  `location_name` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_name` VARCHAR(250) NOT NULL,
  `condition_item` VARCHAR(250) DEFAULT NULL,
  `category_id` INT(11) DEFAULT NULL,
  `location_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  FOREIGN KEY (`category_id`) REFERENCES `category`(`category_id`) ON DELETE SET NULL,
  FOREIGN KEY (`location_id`) REFERENCES `location`(`location_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `borrower` (
  `borrower_id` INT(11) NOT NULL AUTO_INCREMENT,
  `borrower_name` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`borrower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `borrow` (
  `borrow_id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_id` INT(11) DEFAULT NULL,
  `borrower_id` INT(11) DEFAULT NULL,
  `date_borrow` DATE DEFAULT NULL,
  `date_returned` DATE DEFAULT NULL,
  PRIMARY KEY (`borrow_id`),
  FOREIGN KEY (`item_id`) REFERENCES `item`(`item_id`) ON DELETE CASCADE,
  FOREIGN KEY (`borrower_id`) REFERENCES `borrower`(`borrower_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` INT(11) NOT NULL AUTO_INCREMENT,
  `role_name` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(12) NOT NULL,
  `email` VARCHAR(30) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `otp_verification` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(30) NOT NULL,
  `otp_code` VARCHAR(6) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `requests` (
  `request_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `item_id` INT(11) NOT NULL,
  `request_date` DATE NOT NULL,
  `quantity` INT(11) NOT NULL,
  `status` ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `reports` (
  `report_id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_id` INT(11) NOT NULL,
  `report_date` DATE NOT NULL,
  `description` TEXT NOT NULL,
  `reporter_name` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
