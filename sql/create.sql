CREATE DATABASE IF NOT EXISTS users; 

USE users;

CREATE TABLE customer (
  id  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username     VARCHAR(255)    NOT NULL,
  create_date   DATETIME    NOT NULL,
  password      VARCHAR(255)   NOT NULL,
  last_name     VARCHAR(255),
  first_name    VARCHAR(255),
  phone         VARCHAR(25)
);

ALTER TABLE customer ENGINE=InnoDB;