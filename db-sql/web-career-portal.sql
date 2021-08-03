-- COMP 5531 - Web Career Portal

-- NOTE: We create this because we potentially must associate a username with a given employer
--       and we also need to associate an employer with each job posting
CREATE TABLE `employer` (
    `employer_ID` VARCHAR(255),
    `name` VARCHAR(255),
    `address` VARCHAR(255)
    `phone` VARCHAR(255),
    `email` VARCHAR(255),
    PRIMARY KEY (employer_ID)
);

-- NOTE: `total_jobs_posted` will be used by an employer, and
--       `total_applications_submitted` will be used by a user (who is looking for jobs);
--        they are nothing more than counters

--        this might look different after normalization

-- NOTE:  default from `employer_ID` is NULL in case the user is not an employer
CREATE TABLE 'user' (
    `username` VARCHAR(255),
    `employer_ID` VARCHAR(255) NULL,
    `first_name` VARCHAR(255),
    `last_name` VARCHAR(255),
    `email` VARCHAR(255),
    `password` VARCHAR(255),
    `security_answer` VARCHAR(255),
    `total_jobs_posted` INT,
    `total_applications_submitted` INT,
    `status` VARCHAR(255), -- active, inactive ('active' should be default; for admin use)
    PRIMARY KEY (username),
    FOREIGN KEY (employer_ID) REFERENCES employer (employer_ID)
);

-- Only two payment methods, so they'll always be unique here
CREATE TABLE `payment_method` (
    `payment_method` VARCHAR(255), -- chequing, credit
    PRIMARY KEY (payment_method)
);

-- Creating the account separately so that we can associate multiple payment methods with a user
CREATE TABLE `user_account` (
    `username` VARCHAR(255),
    `payment_method` VARCHAR(255),
    PRIMARY KEY (username, payment_method),
    FOREIGN KEY (username) REFERENCES user (username)
);

-- Each payment is unique, and the ID will determine everything, including username
CREATE TABLE `payment` (
    `payment_ID` VARCHAR(255),
    `username` VARCHAR(255) NOT NULL,
    `payment_total` INT(3),
    `payment_method` VARCHAR(255),
    `withdrawal_type` VARCHAR(255), -- manual, auto
    PRIMARY KEY (payment_ID),
    FOREIGN KEY (username) REFERENCES payment_method (payment_method),
    FOREIGN KEY (payment_method) REFERENCES payment_method (payment_method)
);

-- Only two job categories, so they'll always be unique here
CREATE TABLE `job_category` (
    `job_category` VARCHAR(255), -- Prime, Gold
    `price` INT,
    PRIMARY KEY (job_category)
);

-- Each job is unique, and so the ID will determine everything
CREATE TABLE `job` (
    `job_ID` VARCHAR(255),
    `employer_ID` VARCHAR(255),
    `job_category` VARCHAR(255),
    `title` VARCHAR(255),
    `salary` INT,
    `description` VARCHAR(MAX), -- potentially much larger text
    `date_posted` DATE,
    `date_start` DATE,
    PRIMARY KEY (job_ID),
    FOREIGN KEY (employer_ID) REFERENCES employer (employer_ID),
    FOREIGN KEY (job_category) REFERENCES job_category (job_category)
);

-- NOTE: The notion of an application 'status' appears to have too many meanings in the --       --       requirements... For example, the fact that 'users' and 'employers' should 
--       'maintain' the status of an applicaton is a bit unusual. Just a thought.

CREATE TABLE `job_application` (
    `username` VARCHAR(255),
    `job_ID` VARCHAR(255),
    `application_no` INT, -- because we want the user to be able to submit multiple applications
    `application_text` VARCHAR(255),
    `application_status` VARCHAR(255), -- active, inactive, accepted, rejected
    PRIMARY KEY (username, job_ID, application_no),
    FOREIGN KEY (username) REFERENCES user (username),
    FOREIGN KEY (job_ID) REFERENCES job (job_ID)
);

-- Additional notes to inform potential relations to be made:

-- We *might* need an employer relation:
--   we need a way to connect each job to a given employer
--   this information will also eventually be included in each 'job'

-- All users need access to:
--   posted jobs
--   applied jobs
--   accepted jobs
--   history

-- Solution? 
--   probably will have another entire dashbord that sits beneath the user dashboard
--   maybe even a couple