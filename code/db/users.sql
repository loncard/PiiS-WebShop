CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT, 
  
`name` varchar(100) NOT NULL, 
  
`lastname` varchar(100) NOT NULL,

`address` varchar(100) NOT NULL,   
  
`email` varchar(100) NOT NULL,

`password` varchar(100) NOT NULL,   

`purchase_id` varchar(100) NOT NULL,     
PRIMARY KEY (id) 
);



INSERT INTO `users` 
(`id`, `name`, `lastname`, `address`, `email`, `password`) 
VALUES
(1, 'Goran', 'Kavelj', 'BiH, 88000 Mostar, Ortijes 112', 'goran.kavelj@student.fsr.ba', '1234'),

(2, 'Marko', 'Maric', 'Hrvatska, 1000 Zagreb, Neka ulica 110','kavelj2@gmail.com', '4321')
