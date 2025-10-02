CREATE DATABASE IF NOT EXISTS rk_marriage_hall;
USE rk_marriage_hall;
CREATE TABLE IF NOT EXISTS admins (
 id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(50) NOT NULL,
 password VARCHAR(100) NOT NULL
);
CREATE TABLE IF NOT EXISTS bookings (
 id INT AUTO_INCREMENT PRIMARY KEY,
 customer_name VARCHAR(150) NOT NULL,
 email VARCHAR(150),
 phone VARCHAR(30),
 hall_type VARCHAR(100),
 date DATE,
 from_time TIME,
 to_time TIME,
 payment VARCHAR(20),
 status VARCHAR(20) DEFAULT 'Confirmed'
);
INSERT INTO admins (username,password) VALUES ('admin','admin123');