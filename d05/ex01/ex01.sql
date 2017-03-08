CREATE TABLE ft_table 
(
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`login` varchar(8) NOT NULL,
	`group` ENUM('staff', 'student', 'other') NOT NULL,
	`creation_date` date NOT NULL
);