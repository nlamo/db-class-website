-- COMP 5531 - Web Career Portal

-- Very simple beginnings of the database. Starting slow.

-- Username is the ID, and must always be unique, of course
CREATE TABLE 'user' (
    `username` VARCHAR(255),
    `user_type` VARCHAR(255), -- admin, employer, user
    `first_name` VARCHAR(255),
    `last_name` VARCHAR(255),
    `email_address` VARCHAR(255),
    `password` VARCHAR(255),
    PRIMARY KEY (username)
);

-- Only two payment methods, so they'll always be unique here
CREATE TABLE `payment_method` (
    `payment_method` VARCHAR(255), -- chequing, credit
    PRIMARY KEY (payment_method)
);

-- Each payment is unique, and the ID will determine everything, including username
CREATE TABLE `payment` (
    `payment_ID` VARCHAR(255),
    `username` VARCHAR(255),
    `payment_total` INT(3),
    `payment_method` VARCHAR(255),
    `withdrawal_type` VARCHAR(255), -- manual, auto
    PRIMARY KEY (payment_ID),
    FOREIGN KEY (username) REFERENCES payment_method (payment_method),
    FOREIGN KEY (payment_method) REFERENCES payment_method (payment_method)
);

-- Creating the account separately so that we can associate multiple payment methods with a user
CREATE TABLE `user_account` (
    `username` VARCHAR(255),
    `payment_method` VARCHAR(255),
    PRIMARY KEY (username, payment_method),
    FOREIGN KEY (username) REFERENCES user (username)
);

-- Only two job categories, so they'll always be unique here
CREATE TABLE `job_category` (
    `job_category` VARCHAR(255), -- Prime, Gold
    `price` INT(2),
    PRIMARY KEY (job_category)
);

-- An ID is needed here
CREATE TABLE `job` (
    `job_ID` VARCHAR(255),
    `job_title` VARCHAR(255),
    `job_category` VARCHAR(255),
    `job_description` VARCHAR(MAX), -- potentially much larger text
    PRIMARY KEY (job_ID),
    FOREIGN KEY (job_category) REFERENCES job_category (job_category)
);

-- TODO: add more attributes, potentially a CV, etc.
CREATE TABLE `job_application` (
    `username` VARCHAR(255),
    `job_ID` VARCHAR(255),
    PRIMARY KEY (username, job_ID),
    FOREIGN KEY (username) REFERENCES user (username),
    FOREIGN KEY (job_ID) REFERENCES job (job_ID)
);


-- Additional notes to inform potential relations to be made:

-- All users need access to:
--   posted jobs
--   applied jobs
--   accepeted jobs
--   history
