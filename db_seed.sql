CREATE DATABASE mailing_list DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE mailing_list;

CREATE TABLE IF NOT EXISTS email_list (
	first_name VARCHAR(20),
	last_name VARCHAR(20),
	email VARCHAR(60)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;