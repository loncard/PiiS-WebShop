CREATE TABLE `products` (
`id` int(11) NOT NULL AUTO_INCREMENT, 
  
`name` varchar(100) NOT NULL, 
  
`image` varchar(100) NOT NULL,

`category` varchar(100) NOT NULL,   
  
`price` float NOT NULL, 

`stocked` varchar(100) NOT NULL,  

`date_altered` DATE, 
  
PRIMARY KEY (id) 
);



INSERT INTO `products` 
(`id`, `name`, `price`, `category`, `image`, `stocked`) 
VALUES
(1, 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', 414.99, 'CPU', 'img/corei7.jpg', 'yes'),

(2, 'Corsair Crystal 570X RGB ATX Mid Tower Case', 179.99, 'Case','img/corsair570xrgb.jpg', 'yes'),

(3, 'Corsair Gaming Mouse SCIMITAR PRO RGB', 79.99, 'Mouse', 'img/Corsair-Gaming-SCIMITAR-PRO-RGB.jpg', 'yes'),

(4, 'G.SKILL TridentZ RGB Series 32GB DDR4', 439.99, 'RAM', 'img/gskill-tridentz-rgb.jpg', 'yes');



INSERT INTO `products` 
(`id`, `name`, `price`, `category`, `image`, `stocked`) 
VALUES
(5, 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', 299.99,'CPU', 'img/ryzen7.jpg', 'yes'),

(6, 'NZXT H700i Mid Tower Chassis Tempered Glass Case', 199.99, 'Case', 'img/nzxth700i.jpg', 'no'),

(7, 'Razer Blackwidow Gaming  Mechanical Keyboard', 109.99, 'Keyboard', 'img/razer-blackwidow.jpg', 'yes'),

(8, 'Samsung 850EVO BULK Solid State Drive', 108.45, 'Hard Drive', 'img/samsung-850evo.jpg', 'yes');