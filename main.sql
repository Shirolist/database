-- INT 4087
-- group member:Chan Yuen Hou,Tsui Ming Kit, Lau Wing Yin
DROP DATABASE IF EXISTS int4087;
CREATE DATABASE int4087;
USE int4087;
CREATE TABLE `product_maker`(
  `maker_id` int(255) NOT NULL,
  `maker_name` varchar(255) NOT NULL,
  `maker_country` varchar(999) NOT NULL,
  primary key (maker_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product_maker` (`maker_id`, `maker_name`, `maker_country`) VALUES
(1, 'Intel', 'United States'),
(2, 'ASUS', 'Taiwan'),
(3, 'MSI', 'Taiwan'),
(4, 'ADATA', 'Taiwan'),
(5, 'Crucial', 'United States'),
(6, 'Seagate', 'United States'),
(7, 'Western Digital', 'United States'),
(8, 'ASUS', 'Taiwan'),
(9, 'PowerColor', 'Taiwan'),
(10, 'ASUS', 'Taiwan'),
(11, 'ASUS', 'Taiwan'),
(12, 'Zoho', 'Taiwan'),
(13, 'INNOCN', 'Taiwan'),
(14, 'Logitech', 'Switzerland'),
(15, 'Logitech', 'Switzerland'),
(16, 'Logitech', 'Switzerland'),
(17, 'Microsoft', 'United States'),
(18, 'Microsoft', 'United States')
;
CREATE TABLE `product` (
  `product_id` int(255) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `product_name` varchar(900) NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `product_price` varchar(99999) NOT NULL,
  `product_rate` int(5) NOT NULL,
  `product_picture` text NOT NULL,
  `maker_id` int(255) NOT NULL,
  `maker_name` varchar(255) NOT NULL,
  primary key (product_id),
  FOREIGN KEY (maker_id) REFERENCES product_maker(maker_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product` (`product_id`, `product_type`,`product_name`, `product_description`, `product_price`, `product_rate`, `product_picture`, `maker_id`, `maker_name`) VALUES
(1, 'CPU','Intel Core i5-13500', 'Central Processing Unit', '1725', 4, 'Intel Core i5-13500.jpg' , 1, 'Intel'),
(2, 'CPU', 'Intel Core i5-13400F','Central Processing Unit', '1338', 4, 'Intel Core i5-13400F.jpg',2, 'ASUS'),
(3, 'Motherboard','ASUS ROG MAXIMUS Z790 DARK HERO (DDR5)', 'Main circuit board of a computer', '5450', 4, 'ASUS ROG MAXIMUS Z790 DARK HERO (DDR5).jpg',3, 'MSI'),
(4, 'Motherboard','MSI MPG Z790 EDGE WIFI (DDR5)', 'Main circuit board of a computer', '2589', 4, 'MSI MPG Z790 EDGE WIFI (DDR5).jpg',4, 'ADATA'),
(5, 'RAM','ADATA XPG LANCER RGB DDR5 6000 32GB Kit (2x16GB) (AX5U6000C4016G-DCLARBK)', 'Random Access Memory', '840', 4, 'ADATA XPG LANCER RGB DDR5 6000 32GB Kit (2x16GB) (AX5U6000C4016G-DCLARBK).jpg',5, 'Crucial'),
(6, 'RAM','Crucial DDR4 3200 16GB 桌上型記憶體 (CT16G4DFS832A)', 'Random Access Memory', '255', 4, 'Crucial DDR4 3200 16GB 桌上型記憶體 (CT16G4DFS832A).jpg',6, 'Seagate'),
(7, 'Hard Drive','Seagate IronWolf NAS 3.5-inch 5400rpm Hard Drive 4TB (ST4000VN006)', 'Primary storage device of a computer', '650', 4, 'Seagate IronWolf NAS 3.5-inch 5400rpm Hard Drive 4TB (ST4000VN006).jpg',7, 'Western Digital'),
(8, 'Hard Drive','Western Digital Blue PC Desktop 3.5-inch 7200rpm SATA3 Internal Hard Drive 2TB (WD20EZBX)', 'Primary storage device of a computer', '395', 4, 'Western Digital Blue PC Desktop 3.5-inch 7200rpm SATA3 Internal Hard Drive 2TB (WD20EZBX).jpg',8, 'ASUS'),
(9, 'Graphics Card','ASUS ROG Strix GeForce RTX 4080 SUPER 16GB GDDR6X White OC Edition', 'Hardware that generates and renders images', '10700', 5, 'ASUS ROG Strix GeForce RTX 4080 SUPER 16GB GDDR6X White OC Edition.jpg',9, 'PowerColor'),
(10, 'Graphics Card','PowerColor Hellhound AMD Radeon RX 7800 XT 16GB GDDR6', 'Hardware that generates and renders images', '3930', 5, 'PowerColor Hellhound AMD Radeon RX 7800 XT 16GB GDDR6.jpg',10, 'ASUS'),
(11, 'Power Supply','ASUS 1000W 80 Plus Gold Fully Modular PSU 金牌電源供應器 ROG-STRIX-1000G', 'Converts electrical energy into usable power for the computer', '1149', 4, 'ASUS 1000W 80 Plus Gold Fully Modular PSU 金牌電源供應器 ROG-STRIX-1000G.jpg',11, 'ASUS'),
(12, 'Power Supply','ASUS TUF Gaming 650W 80 Plus Bronze PSU TUF-650B-GAMING', 'Converts electrical energy into usable power for the computer', '649', 4, 'ASUS TUF Gaming 650W 80 Plus Bronze PSU TUF-650B-GAMING.jpg',12, 'Zoho'),
(13, 'Monitor','Zoho 14吋 FHD 60Hz 流動顯示器 Z14P-V3', 'Output device that displays information visually', '869', 4, 'Zoho 14吋 FHD 60Hz 流動顯示器 Z14P-V3.jpg',13, 'INNOCN'),
(14, 'Monitor','INNOCN 27吋 IPS 4K UHD 60Hz 顯示器 27C1U-D', 'Output device that displays information visually', '1999', 4, 'INNOCN 27吋 IPS 4K UHD 60Hz 顯示器 27C1U-D.jpg',14, 'Logitech'),
(15, 'Keyboard','Logitech MX Keys S 先進無線炫光鍵盤', 'Input device used for typing and entering commands', '748', 4, 'Logitech MX Keys S 先進無線炫光鍵盤.jpg',15, 'Logitech'),
(16, 'Keyboard','Logitech Wave Keys 無線人體工學鍵盤', 'Input device used for typing and entering commands', '630', 4, 'Logitech Wave Keys 無線人體工學鍵盤.jpg',16, 'Logitech'),
(17, 'Mouse','Logitech MX Master 3s 高性能無線滑鼠', 'Pointing device used to control the cursor on the screen', '730', 4, 'Logitech MX Master 3s 高性能無線滑鼠.jpg',17, 'Microsoft'),
(18, 'Mouse','Microsoft Bluetooth Mouse 無線藍牙滑鼠', 'Pointing device used to control the cursor on the screen', '130', 4, 'Microsoft Bluetooth Mouse 無線藍牙滑鼠.jpg',18, 'Microsoft')
;

CREATE TABLE `customer` (
  `customer_id` int(255) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(999) NOT NULL,
  `customer_email` varchar(999) NOT NULL,
  `customer_password` varchar(999) NOT NULL,
  `customer_address` varchar(999) NOT NULL,
  primary key (customer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customer` (`customer_name`, `customer_email`, `customer_password`, `customer_address`) VALUES
('1', '1', '1','home'),
('2', '2', '2','mcdonald'),
('Jason', '00@00', '123321','street'),
('jason123', 'jasonlik@yahoo.com.hk', '123321','sky'),
('jason1234', 'jasonlik@yahoo.com.hk', '123321','planet'),
('Sunny2', 'abc123@gmail.com', '21800000','database'),
('Sunny3', 'abc1234@gmail.com', '21800000','i-one')
;

UPDATE `customer`
SET `customer_password` = '$2y$10$7et6TnxLJIlAvPWEJ9BSaeaTvlcSvyFyiBRkEMWWwdsbnq/miTqcm'
WHERE `customer_id` = 1;
UPDATE `customer`
SET `customer_password` = '$2y$10$iKejkuCXColG7ccN6t3E.um2j93fVXon7Sa6zF/Qf5b2uXOQhLGfu'
WHERE `customer_id` = 2;
UPDATE `customer`
SET `customer_password` = '$2y$10$oGv9.1RajgiEEjvNFT8tLeLT.RVO1WP2wIkIkXykkR5XTG0PnSndW'
WHERE `customer_id` = 3 ;
UPDATE `customer`
SET `customer_password` = '$2y$10$oGv9.1RajgiEEjvNFT8tLeLT.RVO1WP2wIkIkXykkR5XTG0PnSndW'
WHERE `customer_id` = 4 ;
UPDATE `customer`
SET `customer_password` = '$2y$10$oGv9.1RajgiEEjvNFT8tLeLT.RVO1WP2wIkIkXykkR5XTG0PnSndW'
WHERE `customer_id` = 5 ;
UPDATE `customer`
SET `customer_password` = '$2y$10$29/XpeROQ7QD.LUDrsgy1.uujL2ltL2SpoQpYXqxFqE/lLAbxdwmq'
WHERE `customer_id` = 6 ;
UPDATE `customer`
SET `customer_password` = '$2y$10$29/XpeROQ7QD.LUDrsgy1.uujL2ltL2SpoQpYXqxFqE/lLAbxdwmq'
WHERE `customer_id` = 7 ;

CREATE TABLE `shopping_cart` (
  `order_id` int(255) NOT NULL AUTO_INCREMENT,
  `customer_id` int(255) NOT NULL,
  `product_id`  int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `product_price` int(255) NOT NULL,
  PRIMARY KEY(`order_id`),
  FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `payment` (
  `payment_id` int(255) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(999) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `customer_address` varchar(999) NOT NULL,
  primary key (payment_id),
  FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `payment` (`payment_id`, `payment_type`, `customer_id` , `customer_address`) VALUES
('1', 'Apple Pay', '1', 'home'),
('2', 'Mater Card', '2', 'mcdonald'),
('3', 'Visa Card', '3', 'street'),
('4', 'American Express', '4', 'sky'),
('5', 'Apple Pay','5', 'planet'),
('6', 'Mater Card','6', 'database'),
('7', 'Visa Card','7', 'i-one')
;

CREATE TABLE `shopping_item` (
  `order_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `product_price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `transaction_report` (
  `report_id` int(255) NOT NULL AUTO_INCREMENT,
  `customer_id` int(255) NOT NULL,
  `payment_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  primary key (report_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `manager`(
 `manager_id` varchar(255) NOT NULL,
 `manager_password` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `manager` (`manager_id`, `manager_password`) VALUES
('god', 'god')
;



