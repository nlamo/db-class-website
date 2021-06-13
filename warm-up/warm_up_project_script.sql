--   Tables to be created:
--   Book, Customer, Publisher, Publisher-Branch, Inventory, Orders, Reader-Interest, Author - potentially more

-- TODO: Change the data types for the ISBN keys??

USE zic55311;

-- In the assignment we are told to use 'publisher number` but I have opted to 
-- use `publisher_id`, which is much clearer

CREATE TABLE `publisher` (
	`publisher_id` INT NOT NULL,
    `branch` INT,
    `company_name` VARCHAR(255),
    `telephone_number` VARCHAR(11),
    `address` VARCHAR(255),
    `city` VARCHAR(255),
    `province` VARCHAR(2),
    `postal_code` VARCHAR(7),
    `email` VARCHAR(255),
    `website` VARCHAR(255),
    PRIMARY KEY (publisher_id)
);

-- Okay, I think the way to do this is to make it reference the PRIMARY KEY 'publisher_id' in
-- 'publisher' and combine that with 'branch_name` to form the PRIMARY KEY of *this* table.

-- TODO: Should `publisher_head_office` reference `publisher_branch`? Ask Parham on Monday.
--       Thing is, if I make it reference only `publisher`, then it's one-to-one, which is what I want

CREATE TABLE `publisher_head_office` (
	`publisher_id` INT NOT NULL,
    `branch_name` VARCHAR(255),
    PRIMARY KEY (publisher_id),
    FOREIGN KEY (publisher_id) REFERENCES publisher (publisher_id)
);

CREATE TABLE `publisher_branch` (
	`publisher_id` INT NOT NULL,
	`branch_name` VARCHAR(255),
    `representative` VARCHAR(255),
    `representative_email` VARCHAR(255),
    `telephone_number` VARCHAR(11),
    `address` VARCHAR(255),
    `province` VARCHAR(2),
    `postal_code` VARCHAR(7),
    PRIMARY KEY (publisher_id, branch_name),
    FOREIGN KEY (publisher_id) REFERENCES publisher (publisher_id)
);

CREATE TABLE `author` (
    `author_ID` INT NOT NULL,
    `name` VARCHAR(255),
    PRIMARY KEY (author_ID)
);

-- referential integrity: there needs to be an author before a book of that author can exist

CREATE TABLE `book` (
	`ISBN` INT NOT NULL,
    `title` VARCHAR(255),
    `author_ID` INT NOT NULL,
    `author_name` VARCHAR(255)
    PRIMARY KEY (ISBN),
    FOREIGN KEY (author_ID) REFERENCES author (author_ID)
);

-- `inventory` is completely dependent on `book`

CREATE TABLE `inventory`(
    `ISBN` INT NOT NULL,
    `cost_price` FLOAT,
    `selling_price` FLOAT,
    `quantity_on_hand` INT,
    `year_to_date_qty_sold` INT,
    `last_update_date` DATETIME,
    PRIMARY KEY(ISBN),
    FOREIGN KEY(ISBN) REFERENCES book (ISBN)
);

-- Like before, in the assignment we are told to use 'order number` but I have opted to 
-- use `order_id`, which is much clearer

-- The `order_id` uniquely identifies an order.

-- Each FOREIGN KEY, both (ISBN) and (publisher_id, branch_name), references the primary
-- of its respective table. 


CREATE TABLE `orders` (
	`order_id` INT NOT NULL,
    `ISBN` INT NOT NULL,
    `order_date` DATE,
    `quantity_ordered` INT,
	`publisher_id` INT NOT NULL,
	`branch_name` VARCHAR(255),
    PRIMARY KEY (order_id),
    FOREIGN KEY (ISBN) REFERENCES book (ISBN),
    FOREIGN KEY (publisher_id, branch_name) REFERENCES publisher_branch (publisher_id, branch_name)
);

-- Added a PRIMARY KEY called `customer_ID`, not in the requirements but it's better this way

CREATE TABLE `customer` (
	`customer_ID` INT NOT NULL,
	`first_name` VARCHAR(255),
    `last_name` VARCHAR(255),
	`telephone_number` VARCHAR(11),
    `address` VARCHAR(255),
    `city` VARCHAR(255),
    `province` VARCHAR(2),
    `postal_code` VARCHAR(7),
    `email` VARCHAR(255),
    `amount_of_cumulative_purchases` DECIMAL,
    PRIMARY KEY (customer_ID)
);

-- Modify later -- this is used to create a link between customers and the authors they read, but more information would be useful

CREATE TABLE `reader_interest` (
`customer_id` INT NOT NULL,
`author_id` INT NOT NULL,
PRIMARY KEY(customer_ID, author_ID),
FOREIGN KEY(customer_id) REFERENCES customer (id),
FOREIGN KEY(author_id) REFERENCES author (author_id)
);



-- *****************************************************************
-- ********************** POPULATING TABLES ************************
-- *****************************************************************

-- Publisher
INSERT INTO `publisher` VALUES (100, 1, "Penguin", "555-9090", "555 Penguin Way", "Montreal", "QC", "H5H H5H", "penguin@penguin.com", "https//:www.penguin.com",);
INSERT INTO `publisher` VALUES (101, 1, "Elsevier", "555-0101", "555 Elsev Way", "Montreal", "QC", "5H2 2H9", "elsevier@elsevier.com", "https://www.elsevier.ca/");
INSERT INTO `publisher` VALUES (102, 1, "Harper Collins", "555-0202", "555 Vingt Quatres Way", "Montreal", "QC", "HN3 34N", "harpercollins@harpercollins.com", "https://www.harpercollins.ca/");
INSERT INTO `publisher` VALUES (103, 1, "Oreilly", "555-0303", "555 Oreilly Ave", "Montreal", "QC", "H5H 61A", "oreillys@oreilly.com", "https://www.oreilly.com/");
INSERT INTO `publisher` VALUES (104, 1, "Hachette Livre", "555-6622", "555 Avenue d'Hachette", "Montreal", "QC", "H5H 2I2", "hachette@hachette.com", "https//:www.hachette.com",);
INSERT INTO `publisher` VALUES (105, 1, "Macmillan", "808-5555", "626 Macmillan Ave", "Montreal", "QC", "2HT 2H9", "macmillan@macmillan.com", "https://www.macmillan.com/");
INSERT INTO `publisher` VALUES (106, 1, "McGraw-Hill", "522-1122", "787 McGraw Road", "Montreal", "QC", "T2G 222", "mcgraw@mcgraw.com", "https://www.mheducation.com/");
INSERT INTO `publisher` VALUES (107, 1, "Scholastic", "555-2211", "333 Scholastic Way", "Montreal", "QC", "S2S SHS", "scholastic@scholastic.com", "https://www.scholastic.com/");
INSERT INTO `publisher` VALUES (108, 1, "Wiley", "555-1155", "555 Wiley Way", "Montreal", "QC", "W3W H2H", "wiley@wiley.com", "https://www.wiley.com/");
INSERT INTO `publisher` VALUES (109, 1, "Oxford University Press", "111-1111", "777 Oxford Ave", "London", "UK", "BL0 0DY", "oxford@oxford.com", "https://www.oup.com/");

-- Head office
INSERT INTO `publisher_head_office` VALUES(100, "555 Penguin Way");
INSERT INTO `publisher_head_office` VALUES(101, "555 Elsev Way");
INSERT INTO `publisher_head_office` VALUES(102, "555 Vingt Quatres Way");
INSERT INTO `publisher_head_office` VALUES(103, "555 Avenue d'Hachette");
INSERT INTO `publisher_head_office` VALUES(104, "626 Macmillan Ave");
INSERT INTO `publisher_head_office` VALUES(105, "787 McGraw Road");
INSERT INTO `publisher_head_office` VALUES(106, "333 Scholastic Way");
INSERT INTO `publisher_head_office` VALUES(107, "555 Penguin Way");
INSERT INTO `publisher_head_office` VALUES(108, "555 Wiley Way");
INSERT INTO `publisher_head_office` VALUES(109, "777 Oxford Ave");

-- Branch
INSERT INTO `publisher_branch` VALUES (1, "Still Branch", "Bill Randolf", "bilL@bill.com", "5554444", "555 Stark Way", "QC", "H2H 222");
INSERT INTO `publisher_branch` VALUES (2, "Elder Branch", "Richard Feynman", "richard@phys.org", "5553333", "000 Vector Ave", "QC", "H2H 333");
INSERT INTO `publisher_branch` VALUES (3, "Hollyboor Branch", "Bob Loblaw", "bob@bob.law", "5553333", "2091 Hollyboor Boulevard", "QC", "H2H 111");
INSERT INTO `publisher_branch` VALUES (4, "Cathington Branch", "Stan Tradowitz", "stan@tradowitz.com", "5556666", "555 Cathington Way", "QC", "H2H B1B");
INSERT INTO `publisher_branch` VALUES (5, "Enron Building", "Carlos Maximus", "carlos@maximalia.org", "5155151", "777 Max Way", "QC", "H2H 212");
INSERT INTO `publisher_branch` VALUES (6, "Calder Branch", "Lucy ", "lucy@hollowplaza.org", "5550055", "2091 Egglington Road", "QC", "H1N N67");
INSERT INTO `publisher_branch` VALUES (7, "Templeton Building", "Greg Stanley", "greg@templeton.org", "4124421", "21 Templeton Road", "QC", "H2H 122");
INSERT INTO `publisher_branch` VALUES (8, "Stanley Center", "Harry Weatherman", "harry@stanley.center", "5523132", "910 Stanley Road", "QC", "H2H 31B");
INSERT INTO `publisher_branch` VALUES (9, "Barrel Branch", "Moishe Bradley", "moishe@barrel.branch", "5331131", "772 Barrel Way", "QC", "H5B 212");
INSERT INTO `publisher_branch` VALUES (10, "Elk Building", "Rick Stanfield", "rick@elk.building", "5553313", "24 Elk Road", "QC", "H1N N22");

-- Author
INSERT INTO `author` VALUES (1, "Emily Dickinson");
INSERT INTO `author` VALUES (2, "Virginia Woolf");
INSERT INTO `author` VALUES (3, "William Falkner");
INSERT INTO `author` VALUES (4, "Malcom Lowry");
INSERT INTO `author` VALUES (5, "Cormac McCarthy");
INSERT INTO `author` VALUES (6, "Fyodor Dostoevsky");
INSERT INTO `author` VALUES (7, "Leo Tolstoy");
INSERT INTO `author` VALUES (8, "Margaret Atwood");
INSERT INTO `author` VALUES (9, "John Steinbeck");
INSERT INTO `author` VALUES (10, "Gabriel Garcia Marquez");
INSERT INTO `author` VALUES (11, "Roberto Bolano");

-- Book
INSERT INTO `book` VALUES (1234567890123, "The complete poems", 1, "Emily Dickinson");
INSERT INTO `book` VALUES (1234567890124, "Mrs. Dalloway", 2, "Virginia Woolf");
INSERT INTO `book` VALUES (1234567890125, "The Sound and the Fury", 3, "William Faulkner");
INSERT INTO `book` VALUES (1234567890126, "Under the Volcano", 4, "Malcom Lowry");
INSERT INTO `book` VALUES (1234567890127, "Blood Meridian", 5, "Cormac McCarthy");
INSERT INTO `book` VALUES (1234567890128, "The Brothers Karamazov", 6, "Fyodor Dostoevsky");
INSERT INTO `book` VALUES (1234567890129, "War and Peace", 7, "Leo Tolstoy");
INSERT INTO `book` VALUES (1234567890130, "Oryx and Crake", 8, "Margaret Atwood");
INSERT INTO `book` VALUES (1234567890131, "100 Days of Solitude", 9, "Gabriel Garcia Marquez");
INSERT INTO `book` VALUES (1234567890132, "The Savage Detectives", 10, "Roberto Bolano");

-- Inventory
INSERT INTO `inventory` VALUES (1234567890123, 12.00, 19.99, 6, 201, '2021-04-13');
INSERT INTO `inventory` VALUES (1234567890124, 14.00, 19.99, 2, 123, '2021-04-13');
INSERT INTO `inventory` VALUES (1234567890125, 8.00, 19.99, 2, 47, '2021-03-22');
INSERT INTO `inventory` VALUES (1234567890126, 11.00, 19.99, 2, 34, '2021-06-12');
INSERT INTO `inventory` VALUES (1234567890127, 10.00, 19.99, 4, 250, '2021-06-13');
INSERT INTO `inventory` VALUES (1234567890128, 12.99, 24.99, 3, 170, '2021-02-03');
INSERT INTO `inventory` VALUES (1234567890129, 14.99, 22.99, 4, 442, '2021-02-03');
INSERT INTO `inventory` VALUES (1234567890130, 8.00, 22.99, 2, 110, '2021-02-03');
INSERT INTO `inventory` VALUES (1234567890131, 8.00, 18.99, 2, 152, '2021-01-10');
INSERT INTO `inventory` VALUES (1234567890132, 12.00, 29.99, 1, 84, '2021-01-15');

-- Orders
INSERT INTO `orders` (100001, 1234567890123, "2021-06-13 10:00:00", 10, 100, 1);
INSERT INTO `orders` (100002, 1234567890124, "2021-06-13 10:00:00", 10, 101, 2);
INSERT INTO `orders` (100003, 1234567890125, "2021-06-13 10:00:00", 10, 102, 3);
INSERT INTO `orders` (100004, 1234567890126, "2021-06-13 10:00:00", 10, 103, 4);
INSERT INTO `orders` (100005, 1234567890127, "2021-06-13 10:00:00", 10, 104, 5);
INSERT INTO `orders` (100006, 1234567890128, "2021-06-13 10:00:00", 10, 105, 6);
INSERT INTO `orders` (100007, 1234567890129, "2021-06-13 10:00:00", 10, 106, 7);
INSERT INTO `orders` (100008, 1234567890130, "2021-06-13 10:00:00", 10, 107, 8);
INSERT INTO `orders` (100009, 1234567890131, "2021-06-13 10:00:00", 10, 108, 9);
INSERT INTO `orders` (100010, 1234567890132, "2021-06-13 10:00:00", 10, 109, 10);

-- Customer
INSERT INTO `customer` VALUES (5001, "Ben", "Grabbitz", "5147132231", "555 Grabbitz Way", "Montreal", "QC", "H1H231", "ben@grabbitz.org", 306.45);
INSERT INTO `customer` VALUES (5002, "Rick", "Calen", "5147394131", "555 Calen Way", "Montreal", "QC", "H1H23J", "rickcalen@calen.org", 1100.22);
INSERT INTO `customer` VALUES (5003, "Cindy", "Storbotwiz", "5147309192", "555 Cindy Way", "Montreal", "QC", "H1H212", "storowitz@cindy.com", 444.99);
INSERT INTO `customer` VALUES (5004, "Ahmad", "Bakir", "5144820102", "555 Bakir Way", "Montreal", "QC", "H1H2H4", "ahmad@bakir.org", 32.90);
INSERT INTO `customer` VALUES (5005, "Francois", "Caillot", "5147134910", "555 Bouvlevard de Caillot", "Montreal", "QC", "H1H2HJ", "francois@caillot.fr", 42.20);
INSERT INTO `customer` VALUES (5006, "Eva", "Robbins", "5147131233", "555 Robbins Street", "Montreal", "QC", "H1H2H1", "eva@robbins.dev", 2091.84);
INSERT INTO `customer` VALUES (5007, "Simin", "Sadeghi", "5147131292", "555 Sadeghi Ave", "Montreal", "QC", "H1H2HJ", "simin@sadeghi.org", 500.01);
INSERT INTO `customer` VALUES (5008, "Jacob", "Robertson", "5147131244", "555 Robertson Ave", "Montreal", "QC", "H1H2HJ", "robertson@fake.org", 6.95);
INSERT INTO `customer` VALUES (5009, "Caleb", "Frank", "5147131255", "555 Frank Way", "Montreal", "QC", "H1H2H1", "caleb@frank.com", 8.47);
INSERT INTO `customer` VALUES (5010, "Elisa", "Sandoz", "5147131255", "555 Sandoz Ave", "Montreal", "QC", "H1H2H2", "elisasandoz@sandoz.notreal", 230.02);

-- Reader interest
INSERT INTO `reader_interest` VALUES (5001, 1);
INSERT INTO `reader_interest` VALUES (5002, 2);
INSERT INTO `reader_interest` VALUES (5003, 5);
INSERT INTO `reader_interest` VALUES (5004, 7);
INSERT INTO `reader_interest` VALUES (5005, 2);
INSERT INTO `reader_interest` VALUES (5006, 3);
INSERT INTO `reader_interest` VALUES (5007, 4);
INSERT INTO `reader_interest` VALUES (5008, 1);
INSERT INTO `reader_interest` VALUES (5009, 2);
INSERT INTO `reader_interest` VALUES (5010, 1);


-- *****************************************************************
-- ************************** QUERIES ******************************
-- *****************************************************************