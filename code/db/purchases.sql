CREATE TABLE `purchases` (
`id` int(11) NOT NULL AUTO_INCREMENT, 
  
`date` DATE, 
  
`nacin_placanja` varchar(100) NOT NULL,

`price` float(11) NOT NULL,   
  
`user_id` int(11) NOT NULL ,  
  
PRIMARY KEY (id) 
);