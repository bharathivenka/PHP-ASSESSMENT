CREATE TABLE products(
  Id int(8) PRIMARY KEY,
  Name varchar(30) NOT NULL,
  Sku int(10) NOT NULL,
  Price double(10,2) NOT NULL,
  Description varchar(500) NOT NULL,
  image text NOT NULL
);

INSERT INTO products (Id, Name, Sku, Price, Description, image) VALUES
     (1,'BROOCH',8769, 12.22,'IT IS VERY ATTRACTIVE AND AESTHETIC','images/accessories1.jpg'),
     (2,'CHAIN',5643, 20.00,'IT IS VERY ATTRACTIVE AND AESTHETIC','images/accessories2.jpg'),
     (3,'CHOKER',2435, 22.12,'IT IS VERY ATTRACTIVE AND AESTHETIC','images/accessories3.jpg'),
     (4,'EARRING',6785, 16.66,'IT IS VERY ATTRACTIVE AND AESTHETIC','images/accessories4.jpg'),
     (5,'CHAIN SET',4567, 40.24,'IT IS VERY ATTRACTIVE AND AESTHETIC','images/accessories5.jpg'),
     (6,'MICROWAVE OVEN',6757,90.01,'Resistant to voltage fluctuation up to 1500 volts  ','images/appliances1.jpg'),
     (7,'ELECTRIC KETTLE',5432, 105.90,'Resistant to voltage fluctuation up to 1500 volts  ','images/appliances2.jpg'),
     (8,'MIXER',7823, 14.44,'Resistant to voltage fluctuation up to 1500 volts  ','images/appliances3.jpg'),
     (9,'ELECTRIC STOVE','5473', 13.77,'Resistant to voltage fluctuation up to 1500 volts  ','images/appliances4.jpg'),
     (10,'VACUUM CLEANER',8756, 19.99,'Resistant to voltage fluctuation up to 1500 volts  ','images/appliances5.jpg'),
     (11,'DRESS',9008, 12.22,'HIGHLY COMFORTABLE AND CONVINIENT ','images/dress1.jpg'),
     (12,'TRACK PANT',9004, 15.55,'HIGHLY COMFORTABLE AND CONVINIENT ','images/dress2.jpg'),
     (13,'TSHIRT',2344, 21.56,'HIGHLY COMFORTABLE AND CONVINIENT ','images/dress3.jpg'),
     (14,'JEAN',2453, 8.90,'HIGHLY COMFORTABLE AND CONVINIENT ','images/dress4.jpg'),
     (15,'SHIRT',2567, 17.77,'HIGHLY COMFORTABLE AND CONVINIENT ','images/dress5.jpg'),
     (16,'HEADPHONE',5321, 23.43,'Unique sound experience','images/electronics1.jpg'),
     (17,'SMART WATCH',6543, 25.55,'1.1” Full touch AMOLED color display','images/electronics2.jpg'),
     (18,'KEYBOARD',7654, 25.99,'Multicolor LED ( 4 modes - 3 light modes and 1 off mode ),Integrated media control Windows key Disable / Enable function ','images/electronics3.jpg'),
     (19,'WIFI-BAND',5849, 33.33,'COMPATIBLE TO TABLET,LAPTOPS,MOBILE PHONES','images/electronics4.jpg'),
     (20,'PENDRIVE',6544, 20.80,'Memory Storage Capacity 32 GB','images/electronics5.jpg');

ALTER TABLE products
  ADD UNIQUE KEY Sku (Sku);

