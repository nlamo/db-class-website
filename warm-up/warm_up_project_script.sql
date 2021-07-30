--   Tables to be created:
--   Book, Customer, Publisher, Publisher-Branch, Inventory, Orders, Reader-Interest, Author - potentially more

-- TODO: Change the data types for the ISBN keys??
--       Probably not crucial for the purposes of this assignment.

-- NOTE: All of the tables here are listed in the *order of their dependencies (references)* !
--       As such, you can (and should) execute them in the order in which they are listed.

-- In the assignment we are told to use 'publisher number` but I have opted to 
-- use `publisher_id`, which is much clearer

CREATE TABLE `publisher` (
    `publisher_id` INT NOT NULL,
    `branches` INT,
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

-- I think the way to do this is to make it reference the PRIMARY KEY 'publisher_id' in
-- 'publisher' and combine that with 'branch_name` to form the PRIMARY KEY of *this* table.

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

CREATE TABLE `book` (
    `ISBN` INT NOT NULL,
    `title` VARCHAR(255),
    `author_ID` INT NOT NULL,
    `author_name` VARCHAR(255),
    `cost_price` DECIMAL(10, 2),
    `selling_price` DECIMAL(10, 2),
    PRIMARY KEY (ISBN),
    FOREIGN KEY (author_ID) REFERENCES author (author_ID)
);

-- `inventory` is completely dependent on `book` (one-to-one)

CREATE TABLE `inventory`(
    `ISBN` INT NOT NULL,
    `quantity_on_hand` INT,
    `year_to_date_qty_sold` INT,
    `last_update_date` DATETIME,
    PRIMARY KEY (ISBN),
    FOREIGN KEY (ISBN) REFERENCES book (ISBN)
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
    `amount_of_cumulative_purchases` DECIMAL(10, 2),
    PRIMARY KEY (customer_ID)
);

-- Like before, in the assignment we are told to use 'order number` but I have opted to 
-- use `order_id`, which is much clearer

-- NOTE: before I had the primary key including both `publisher_id` and `branch_name` but
--       it became clear that this was obviously ridiculous. All we need are an
--       `order_id` and an `ISBN` because there can be many books for each order.

CREATE TABLE `orders` (
    `order_id` INT NOT NULL,
    `ISBN` INT NOT NULL,
    `order_date` DATETIME,
    `quantity_ordered` INT,
    `publisher_id` INT NOT NULL,
    `branch_name` VARCHAR(255),
    `customer_id` INT NULL, -- OPTIONAL customer_id, referencing `customer`
    `is_back_order` BIT(1) DEFAULT b'0', -- value of 0: False, value of 1: True
    PRIMARY KEY (order_id, ISBN),
    FOREIGN KEY (ISBN) REFERENCES book (ISBN),
    FOREIGN KEY (publisher_id, branch_name) REFERENCES publisher_branch (publisher_id, branch_name),
    FOREIGN KEY (customer_id) REFERENCES customer (customer_id)
);

-- Modify later -- this is used to create a link between customers and the authors they read, but more information would be useful

CREATE TABLE `reader_interest` (
`customer_id` INT NOT NULL,
`author_id` INT NOT NULL,
PRIMARY KEY (customer_ID, author_ID),
FOREIGN KEY (customer_id) REFERENCES customer (customer_id),
FOREIGN KEY (author_id) REFERENCES author (author_id)
);


-- *****************************************************************
-- ********************** POPULATING TABLES ************************
-- *****************************************************************

-- Publisher
INSERT INTO `publisher` VALUES (100, 1, "Penguin", "555-9090", "555 Penguin Way", "Montreal", "QC", "H5H H5H", "penguin@penguin.com", "https//:www.penguin.com");
INSERT INTO `publisher` VALUES (101, 1, "Elsevier", "555-0101", "555 Elsev Way", "Montreal", "QC", "5H2 2H9", "elsevier@elsevier.com", "https://www.elsevier.ca/");
INSERT INTO `publisher` VALUES (102, 1, "Harper Collins", "555-0202", "555 Vingt Quatres Way", "Montreal", "QC", "HN3 34N", "harpercollins@harpercollins.com", "https://www.harpercollins.ca/");
INSERT INTO `publisher` VALUES (103, 1, "Oreilly", "555-0303", "555 Oreilly Ave", "Montreal", "QC", "H5H 61A", "oreillys@oreilly.com", "https://www.oreilly.com/");
INSERT INTO `publisher` VALUES (104, 1, "Hachette Livre", "555-6622", "555 Avenue d'Hachette", "Montreal", "QC", "H5H 2I2", "hachette@hachette.com", "https//:www.hachette.com");
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
INSERT INTO `publisher_branch` VALUES (100, "Still Branch", "Bill Randolf", "bilL@bill.com", "5554444", "555 Stark Way", "QC", "H2H 222");
INSERT INTO `publisher_branch` VALUES (101, "Elder Branch", "Richard Feynman", "richard@phys.org", "5553333", "000 Vector Ave", "QC", "H2H 333");
INSERT INTO `publisher_branch` VALUES (102, "Hollyboor Branch", "Bob Loblaw", "bob@bob.law", "5553333", "2091 Hollyboor Boulevard", "QC", "H2H 111");
INSERT INTO `publisher_branch` VALUES (103, "Cathington Branch", "Stan Tradowitz", "stan@tradowitz.com", "5556666", "555 Cathington Way", "QC", "H2H B1B");
INSERT INTO `publisher_branch` VALUES (104, "Enron Building", "Carlos Maximus", "carlos@maximalia.org", "5155151", "777 Max Way", "QC", "H2H 212");
INSERT INTO `publisher_branch` VALUES (105, "Calder Branch", "Lucy ", "lucy@hollowplaza.org", "5550055", "2091 Egglington Road", "QC", "H1N N67");
INSERT INTO `publisher_branch` VALUES (106, "Templeton Building", "Greg Stanley", "greg@templeton.org", "4124421", "21 Templeton Road", "QC", "H2H 122");
INSERT INTO `publisher_branch` VALUES (107, "Stanley Center", "Harry Weatherman", "harry@stanley.center", "5523132", "910 Stanley Road", "QC", "H2H 31B");
INSERT INTO `publisher_branch` VALUES (108, "Barrel Branch", "Moishe Bradley", "moishe@barrel.branch", "5331131", "772 Barrel Way", "QC", "H5B 212");
INSERT INTO `publisher_branch` VALUES (109, "Elk Building", "Rick Stanfield", "rick@elk.building", "5553313", "24 Elk Road", "QC", "H1N N22");

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
INSERT INTO `book` VALUES (7890123, "The complete poems", 1, "Emily Dickinson", 12.00, 19.99);
INSERT INTO `book` VALUES (7890124, "Mrs. Dalloway", 2, "Virginia Woolf", 14.00, 19.99);
INSERT INTO `book` VALUES (7890125, "The Sound and the Fury", 3, "William Faulkner", 8.00, 19.99);
INSERT INTO `book` VALUES (7890126, "Under the Volcano", 4, "Malcom Lowry", 11.00, 19.99);
INSERT INTO `book` VALUES (7890127, "Blood Meridian", 5, "Cormac McCarthy", 10.00, 19.99);
INSERT INTO `book` VALUES (7890128, "The Brothers Karamazov", 6, "Fyodor Dostoevsky", 12.99, 24.99);
INSERT INTO `book` VALUES (7890129, "War and Peace", 7, "Leo Tolstoy", 14.99, 22.99);
INSERT INTO `book` VALUES (7890130, "Oryx and Crake", 8, "Margaret Atwood", 8.00, 22.99);
INSERT INTO `book` VALUES (7890131, "100 Days of Solitude", 9, "Gabriel Garcia Marquez", 8.00, 18.99);
INSERT INTO `book` VALUES (7890132, "The Savage Detectives", 10, "Roberto Bolano", 12.00, 29.99);

-- Inventory
INSERT INTO `inventory` VALUES (7890123, 6, 201, '2021-04-13');
INSERT INTO `inventory` VALUES (7890124, 2, 123, '2021-04-13');
INSERT INTO `inventory` VALUES (7890125, 2, 47, '2021-03-22');
INSERT INTO `inventory` VALUES (7890126, 2, 34, '2021-06-12');
INSERT INTO `inventory` VALUES (7890127, 4, 250, '2021-06-13');
INSERT INTO `inventory` VALUES (7890128, 3, 170, '2021-02-03');
INSERT INTO `inventory` VALUES (7890129, 4, 442, '2021-02-03');
INSERT INTO `inventory` VALUES (7890130, 2, 110, '2021-02-03');
INSERT INTO `inventory` VALUES (7890131, 2, 152, '2021-01-10');
INSERT INTO `inventory` VALUES (7890132, 1, 84, '2021-01-15');

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

-- Orders
INSERT INTO `orders` VALUES (100001, 7890123, "2021-06-13 10:00:00", 10, 100, "Still Branch", NULL, 0);
INSERT INTO `orders` VALUES (100002, 7890124, "2021-06-13 10:00:00", 12, 101, "Elder Branch", NULL, 0);
INSERT INTO `orders` VALUES (100003, 7890125, "2021-06-13 10:00:00", 8, 102, "Hollyboor Branch", 5001, 1);
INSERT INTO `orders` VALUES (100004, 7890126, "2021-03-19 10:00:00", 11, 103, "Cathington Branch", NULL, 0);
INSERT INTO `orders` VALUES (100005, 7890127, "2021-02-14 10:00:00", 13, 104, "Enron Building", 5002, 1);
INSERT INTO `orders` VALUES (100006, 7890128, "2021-02-14 10:00:00", 13, 105, "Calder Branch", 5007, 1);
INSERT INTO `orders` VALUES (100007, 7890129, "2021-02-14 10:00:00", 2, 106, "Templeton Building", NULL, 0);
INSERT INTO `orders` VALUES (100008, 7890130, "2021-01-22 10:00:00", 1, 107, "Stanley Center", 5006, 0);
INSERT INTO `orders` VALUES (100009, 7890131, "2021-01-22 10:00:00", 2, 108, "Barrel Branch", NULL, 0);
INSERT INTO `orders` VALUES (100010, 7890132, "2021-01-22 10:00:00", 5, 109, "Elk Building", NULL, 0);


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

-- Query #1
-- Get details of all books in stock.
SELECT book.*
FROM book, inventory
WHERE book.ISBN = inventory.ISBN
AND inventory.quantity_on_hand > 0;


-- Query #2
-- Get details of all back orders.
SELECT orders.*
FROM orders
WHERE orders.is_back_order = b'1';


-- Query #3
-- For a given customer, get details of all his/her back orders.
SELECT orders.*
FROM orders
WHERE orders.customer_id = 5002 
AND orders.is_back_order = b'1';


-- Query #4
-- For a given customer, get details of all his/her purchases made during a specific period of time.
SELECT orders.*
FROM orders, customer
WHERE orders.customer_id = customer.customer_id
AND customer.first_name = 'Ben'
AND customer.last_name = 'Grabbitz'
AND DATE(orders.order_date) BETWEEN '2021-06-11' AND '2021-07-14';


-- Query #5 
-- Give a report of sales during a specific period of time.
SELECT orders.*
FROM orders
WHERE DATE(orders.order_date) BETWEEN '2021-01-01' AND '2021-07-16';


-- Query #6
-- Find the titles of books that have the highest back order.
SELECT book_title, backorder_quantity
FROM
(
    SELECT book.title AS book_title, SUM(orders.quantity_ordered) AS backorder_quantity, RANK() OVER (ORDER BY SUM(orders.quantity_ordered) DESC) as sum_rank
    FROM orders, book
    WHERE orders.ISBN = book.ISBN AND orders.is_back_order = b'1'
    GROUP BY book.title
    ORDER BY backorder_quantity DESC
) AS highest_back_order
WHERE sum_rank = 1;


-- Query #7
-- Give details of books that are supplied by a given publisher.
SELECT book.*
FROM book, orders, publisher
WHERE book.ISBN = orders.ISBN
AND orders.publisher_ID = publisher.publisher_id
AND publisher.company_name = 'Oreilly';


-- Query #8
-- For a given publisher, get details of the head office and all the branches for that publisher.
SELECT publisher_head_office.*, publisher_branch.*
FROM publisher, publisher_head_office, publisher_branch
WHERE publisher_head_office.publisher_id = publisher.publisher_id 
AND publisher_head_office.publisher_id = publisher_branch.publisher_id
AND publisher.company_name = 'Oxford University Press';


-- Query #9
-- Give details of books that are in the inventory but for which there have never been 
-- specific purchases for those books.
SELECT book.*
FROM book, inventory
WHERE book.ISBN = inventory.ISBN
AND inventory.year_to_date_qty_sold = 0;


-- Query #10
-- Get details of all books that are in the inventory for a given author.
SELECT book.*
FROM book, inventory
WHERE book.ISBN = inventory.ISBN
AND book.author_name = "Roberto Bolano";
