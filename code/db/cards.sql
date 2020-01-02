CREATE TABLE `cards` (
`id` int(11) NOT NULL AUTO_INCREMENT, 
  
`name` varchar(100) NOT NULL, 
  
`card_number` varchar(100) NOT NULL,

`datum` varchar(100) NOT NULL,   
  
`csc` varchar(100) NOT NULL,

PRIMARY KEY (id) 
);

INSERT INTO `cards` 
(`id`, `name`, `card_number`, `datum`, `csc`) 
VALUES
(1, 'Goran Kavelj', '12345678', '3/18', '123'),

(2, 'Marko Maric', '87654321', '4/18', '321')