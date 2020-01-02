CREATE TABLE `categories` (
`id` int(11) NOT NULL AUTO_INCREMENT, 
  
`name` varchar(100) NOT NULL, 

PRIMARY KEY (id) 
);

INSERT INTO `categories` 
(`id`, `name`) 
VALUES
(1, 'CPU'),

(2, 'Case'),

(3, 'Mouse'),

(4, 'RAM'),

(5, 'Keayboard'),

(6, 'Hard drive')