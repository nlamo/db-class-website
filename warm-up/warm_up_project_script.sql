-- Tables to be created:
--   Book, Customer, Publisher, Publisher Branch, Order

USE zic55311;

-- In the assignment we are told to use 'publisher number` but I have opted to 
-- use `publisher_id`, which is much clearer

CREATE TABLE `publisher` (
	`publisher_id` INT NOT NULL,
    `company_name` VARCHAR(255),
    `branches` INT,
    `telephone_number` VARCHAR(11),
    `address` VARCHAR(255),
    `city` VARCHAR(255),
    `province` VARCHAR(2),
    `postal_code` VARCHAR(7),
    `email` VARCHAR(255),
    `website` VARCHAR(255),
    PRIMARY KEY (publisher_id)
);

-- The assignment is unclear in certain instructions. I think we can assume that a 'branch' is a given
-- entity of type 'publisher', meaning that a 'branch' should just be a specific instance of a
-- 'publisher', of which there may be many.

-- Okay, I think the way to do this is to make it reference the PRIMARY KEY 'publisher_id' in
-- 'publisher' and combine that with 'branch_name` to form the PRIMARY KEY of *this* table.

CREATE TABLE `branch` (
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

CREATE TABLE `book` (
	`ISBN` INT NOT NULL,
    `title` VARCHAR(255),
    `author` VARCHAR(255),
    `cost_price` DECIMAL,
    `selling_price` DECIMAL,
    `subject` VARCHAR(255),
    `quantity_on_hand` INT, 
    `year_to_date_qty_sold` INT,
    PRIMARY KEY (ISBN)
);

-- Like before, in the assignment we are told to use 'order number` but I have opted to 
-- use `order_id`, which is much clearer

-- The `order_id` uniquely identifies an order.

-- Each FOREIGN KEY, both (ISBN) and (publisher_id, branch_name), references the primary
-- of its respective table. 

-- This creates a kind of `referential integrity`, where we can't make an order unless the
-- book actually exists (which is determined by the existence of the ISBN), and furthermore,
-- we can't make an order if a given publisher doesn't exist.

-- I'm only using `orders` because ORDER is a reserved word and it makes my life more difficult
-- It is usually best practice to use singular nouns for table and column names.

CREATE TABLE `orders` (
	`order_id` INT NOT NULL,
    `ISBN` INT NOT NULL,
    `order_date` DATE,
    `quantity_ordered` INT,
	`publisher_id` INT NOT NULL,
	`branch_name` VARCHAR(255),
    PRIMARY KEY (order_id),
    FOREIGN KEY (ISBN) REFERENCES book (ISBN),
    FOREIGN KEY (publisher_id, branch_name) REFERENCES branch (publisher_id, branch_name)
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
