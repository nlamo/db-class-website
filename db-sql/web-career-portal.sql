-- CREATE DATABASE `web_career_portal`;
-- USE`web_career_portal`;

CREATE TABLE `employer` (
    `employer_ID` INT AUTO_INCREMENT,
    `name` VARCHAR(255),
    `address` VARCHAR(255),
    `phone` VARCHAR(255),
    `email` VARCHAR(255),
    PRIMARY KEY (employer_ID)
);

-- Six Categories w/ Price (Admin, User Basic, User Prime, User Gold, Employer Prime, Employer Gold,)
CREATE TABLE `user_category` (
    `user_category` VARCHAR(255),
    `price` INT,
    PRIMARY KEY (user_category)
);

-- NOTE: `total_jobs_posted` will be used by an employer, and
--       `total_applications_submitted` will be used by a user (who is looking for jobs);
--        they are nothing more than counters

-- NOTE:  default from `employer_ID` is NULL in case the user is not an employer
CREATE TABLE `user` (
    `username` VARCHAR(255),
    `employer_ID` INT NULL,
    `user_category` VARCHAR(255),
    `first_name` VARCHAR(255),
    `last_name` VARCHAR(255),
    `email` VARCHAR(255),
    `password` VARCHAR(255),
    `security_answer` VARCHAR(255),
    `total_jobs_posted` INT,
    `total_applications_submitted` INT,
    `status` VARCHAR(255), -- active, inactive ('active' should be default; for admin use)
    PRIMARY KEY (username),
    FOREIGN KEY (employer_ID) REFERENCES employer (employer_ID),
    FOREIGN KEY (user_category) REFERENCES user_category (user_category)
);

-- Only two payment methods, so they'll always be unique here
CREATE TABLE `payment_method` (
    `payment_method` VARCHAR(255), -- Chequing, Credit
    PRIMARY KEY (payment_method)
);

-- Each payment is unique, and the ID will determine everything, including username
CREATE TABLE `payment_account` (
    `payment_account_ID` INT AUTO_INCREMENT,
    `username` VARCHAR(255),
    `cardholder_name` VARCHAR(255),
    `card_number` VARCHAR(255),
    `expiration_date` DATE,
    `payment_method` VARCHAR(255), -- Chequing, Credit
    `withdrawal_type` VARCHAR(255), -- Manual, Automatic
    `balance` INT,
    `status` VARCHAR(255), -- Settled, Frozen
    PRIMARY KEY (payment_account_ID),
    FOREIGN KEY (username) REFERENCES user (username),
    FOREIGN KEY (payment_method) REFERENCES payment_method (payment_method)
);

-- Each payment is associated with a payment account and a particular user category
CREATE TABLE `payment` (
    `payment_ID` INT AUTO_INCREMENT,
    `payment_account_ID` INT,
    `user_category` VARCHAR(255),
    `total` INT,
    PRIMARY KEY (payment_ID),
    FOREIGN KEY (payment_account_ID) REFERENCES payment_account (payment_account_ID),
    FOREIGN KEY (user_category) REFERENCES user_category (user_category)
);

-- Each job is unique, and so the ID will determine everything
CREATE TABLE `job` (
    `job_ID` INT AUTO_INCREMENT,
    `employer_ID` INT,
    `job_category` VARCHAR(255),
    `title` VARCHAR(255),
    `salary` INT,
    `description` VARCHAR(2000), -- much larger text
    `date_start` DATE,
    PRIMARY KEY (job_ID),
    FOREIGN KEY (employer_ID) REFERENCES employer (employer_ID)
);

-- NOTE: When employer uses 'Update Application', s(he) will send a 'Message to Applicant'
--       which will then update the `application_response` attribute value

-- NOTE: I added job_name, employer_ID, and employer_name. It makes some queries far easier, but it removes the possibility of 3NF as there are now transitive dependencies. Design trade-off, I say!!
CREATE TABLE `job_application` (
    `job_application_ID` INT AUTO_INCREMENT,
    `username` VARCHAR(255),
    `job_ID` INT,
    `job_name` VARCHAR(255),
    `employer_ID` INT,
    `employer_name` VARCHAR(255),
    `application_text` VARCHAR(1000),
    `application_status` VARCHAR(255), -- active, inactive, accepted, rejected
    `application_response` VARCHAR(500),
    PRIMARY KEY (job_application_ID),
    FOREIGN KEY (username) REFERENCES user (username),
    FOREIGN KEY (job_ID) REFERENCES job (job_ID),
    FOREIGN KEY (employer_ID) REFERENCES employer (employer_ID)
);


-- --------------------------------------------------------------------------------------------------------------------------------


-- INSERTION QUERIES (BASELINE DATA FOR THE DATABASE)

INSERT INTO `employer` VALUES (1, 'Alpha Computing', '515 Alpha Way', '555-515-5245', 'alphacomputing@alpha.org');
INSERT INTO `employer` VALUES (2, 'Darryl Electronics', '654 Simba Way', '555-515-6216', 'darrylelectro@darrylelectro.com');
INSERT INTO `employer` VALUES (3, 'Jimba Microprocessors', '721 Jimba Ave', '555-425-5215', 'jimbamicropro@jimba.net');
INSERT INTO `employer` VALUES (4, 'Kettle Coffee', '421 Kettle Boulevard', '555-745-2910', 'kettle@kettlecoffeeisgood.ca');
INSERT INTO `employer` VALUES (5, 'Stan\'s Bagels', '425 Bagel Road', '521-542-4919', 'stanley@stansbagels.com');
INSERT INTO `employer` VALUES (6, 'Tony Pizzeria', '234 Tony Street', '512-492-1928', 'tony@tonypizzanow.org');
INSERT INTO `employer` VALUES (7, 'Denton Photography', '555 Alpha Way', '555-234-8239', 'denton@dentonphoto.ca');
INSERT INTO `employer` VALUES (8, 'Fine Refinishing', '7820 Wood Way', '514-849-2938', 'refinish@finewood.now');
INSERT INTO `employer` VALUES (9, 'James Richardson Brandy', '514 Avenue Decadent', '512-481-2381', 'jrichardson@bestbrandies.org');
INSERT INTO `employer` VALUES (10, 'Smoke Show', '290 Smoker Boulevard', '555-512-1932', 'smokeshow@smokeshowsmokeables.org');

INSERT INTO `user_category` VALUES ('Admin', 0);
INSERT INTO `user_category` VALUES ('Employer Prime', 50);
INSERT INTO `user_category` VALUES ('Employer Gold', 100);
INSERT INTO `user_category` VALUES ('User Basic', 0);
INSERT INTO `user_category` VALUES ('User Prime', 10);
INSERT INTO `user_category` VALUES ('User Gold', 20);

-- Regular users (administrators), need a new table for this also...
INSERT INTO `user` VALUES ('n_lamo', NULL, 'Admin', 'Nicholas', 'LaMothe', 'n_lamo@encs.concordia.ca', 'steppenwolf', 'Vertigo', 0, 0, 'active');
INSERT INTO `user` VALUES ('f_attia', NULL, 'Admin', 'Fady', 'Attia', 'f_attia@encs.concordia.ca', 'password', 'Unknown', 0, 0, 'active');

-- Regular users (looking for work)
-- These user will have all made applications. zeba makes two (2), damo makes two (2), gord makes three (3), just to start.
INSERT INTO `user` VALUES ('zeba', NULL, 'User Basic', 'Jim', 'James', 'jimmyjames@fake.org', 'jimmy', 'Unforgiven', 0, 2, 'active');
INSERT INTO `user` VALUES ('damo', NULL, 'User Prime', 'Damo', 'Suzuki', 'damo@mysticalvoice.org', 'damo', 'Rashomon', 0, 2, 'active');
INSERT INTO `user` VALUES ('gord', NULL, 'User Gold', 'Gord', 'Willard', 'gordwillard@fake.net', 'gordo', 'Munich', 0, 3, 'active');

-- Employers (users match the first five employers)
-- These employers will have all posted a single (1) job to start
INSERT INTO `user` VALUES ('alpha', 1, 'Employer Prime', 'Ali', 'Grandich', 'aligrandy@alpha.org', 'alpha', 'Slackers', 1, 0, 'active');
INSERT INTO `user` VALUES ('darryl', 2, 'Employer Prime', 'Darryl', 'Randal', 'darryl@fakeman.com', 'darryl', 'Clerks', 1, 0, 'active');
INSERT INTO `user` VALUES ('jimba', 3, 'Employer Gold', 'Jim', 'Brando', 'jimbrando@faker.net', 'jimba', 'Akira', 1, 0, 'active');
INSERT INTO `user` VALUES ('kettle', 4, 'Employer Gold', 'Sarah', 'Wilkinson', 'sandra@kettlecoffeeisgood.ca', 'sandra', 'Sleepless in Seattle', 1, 0, 'active');
INSERT INTO `user` VALUES ('stanley', 5, 'Employer Gold', 'Stanley', 'Silverman', 'stanley@fakest.ca', 'stanley', 'The Conversation', 1, 0, 'active');

-- Adding some more regular users, for good measure
INSERT INTO `user` VALUES ('cali', NULL, 'User Basic', 'Karen', 'Alderich', 'karena@fake.org', 'karen', 'Superbad', 0, 1, 'active');
INSERT INTO `user` VALUES ('nana', NULL, 'User Prime', 'Kitty', 'Gray', 'kgray@united.com', 'kitty', 'Chocolat', 0, 0, 'active');
INSERT INTO `user` VALUES ('ebb', NULL, 'User Gold', 'Richard', 'Ebbingsworth', 'richardebbingsworth@fake.net', 'ebb', 'Knives Out', 0, 1, 'active');

INSERT INTO `payment_method` VALUES ('Chequing');
INSERT INTO `payment_method` VALUES ('Credit');

INSERT INTO `payment_account` VALUES (DEFAULT, 'alpha', 'Ali Grandich', '48398180284081', '2021-09-01', 'Chequing', 'Automatic', 9402, 'Settled');
INSERT INTO `payment_account` VALUES (DEFAULT, 'darryl', 'Darryl Randal', '4820842093338402', '2022-02-01', 'Credit', 'Manual', 20391, 'Settled');
INSERT INTO `payment_account` VALUES (DEFAULT, 'gord', 'Gord Willard', '4820842082932223', '2022-04-28', 'Chequing', 'Manual', 4820, 'Settled');
INSERT INTO `payment_account` VALUES (DEFAULT, 'gord', 'Gord Willard', '40028302938209402', '2022-04-28', 'Credit', 'Manual', 603, 'Settled');
INSERT INTO `payment_account` VALUES (DEFAULT, 'stanley', 'Stanley Silverman', '4820492938482882', '2022-06-28', 'Chequing', 'Manual', 302, 'Settled');
INSERT INTO `payment_account` VALUES (DEFAULT, 'stanley', 'Stanley Silverman', '4829029384029382', '2022-06-28', 'Credit', 'Automatic', 48920, 'Settled');
INSERT INTO `payment_account` VALUES (DEFAULT, 'kettle', 'Sarah Wilkinson', '4002832899293323', '2022-01-29', 'Credit', 'Manual', 2201, 'Settled');

INSERT INTO `payment` VALUES (DEFAULT, 2, 'Employer Prime', 50);
INSERT INTO `payment` VALUES (DEFAULT, 6, 'Employer Prime', 50);
INSERT INTO `payment` VALUES (DEFAULT, 9, 'User Prime', 20);

-- For the sake of simplicity, we're just starting off with 10 jobs (1-10), ordered by the first 10 employers (1-10)
INSERT INTO `job` VALUES (1, 1, 'IT', 'System Administrator', 80000, 'This role requires knowledge of the system administration of MS Windows based workstations. A high-degree of proficiency in cmd and Powershell is required, with knowledge of many basic commands, system utilities, security best practices, setting up and disassembling workstations, and the maintenance and supervision of accounts with a variety of permissions. Low-level security knowledge in assembly is considered a major asset.', '2021-08-30');
INSERT INTO `job` VALUES (2, 2, 'Engineering', 'Electrical Engineer', 92000, 'This role requires knowledge of circuit design and a high-degree of familiarity with the major software tools used in designing circuit boards. A BSc in Electrical Engineering is required for this role; an MSc is considered a highly-valuable asset.', '2021-09-02');
INSERT INTO `job` VALUES (3, 3, 'Engineering', 'Computer Architect', 120000, 'This position equires 10+ years of experience in the high-level design of computer architectures, including all of the major software tools required to be competitive in this field. Excellent knowledge of assembly and the C programming language required. Proficiency in LaTeX is seen as a valuble asset. This role is well-suited for someone with an MSc in Computer Science or Electrical Engineering. Exceptionally, we may take on new graduates, but this role ideally requires many years of experience working with a computer hardware manufacturer.', '2021,10-01');
INSERT INTO `job` VALUES (4, 4, 'Food Preparation', 'Barista', 26000, 'The duties of this position are as follows: preparation of food items, coffee, specialty coffee beverages, cleaning duties (including dishwashing), and working the cash register.', '2021-09-14');
INSERT INTO `job` VALUES (5, 5, 'IT', 'Web Developer', 50000, 'As the head web developer for Stan\'s Bagels, you will be required to maintain all activities surrounding the business web application. This includes managing, modifying, and improving the user interface, database, and all of the front/back-end control logic. Proficiency in HTML, CSS, JavaScript, and PHP is required. Knowledge of React and TypeScript are considered assets.', '2021-09-28');
INSERT INTO `job` VALUES (6, 6, 'Food Preparation', 'Line Cook', 32000, 'As line cook, you will be responsible for all apects of food preparation (chopping vegetables, grating cheese, making dough, making sauce), cooking pizzas, answering telephone calls, working at the cash register, washing dishes, mopping the floors, cleaning the washroom, and maintaining a clean and orderly food preparation workspace in accordance with national food safety regulations. If you have a valid driver\'s license, then it is considered as an asset.', '2021-09-01');
INSERT INTO `job` VALUES (7, 7, 'Photography', 'Wedding Photographer', 44000, 'For the role of Wedding Photographer, you will take amazing photos of people at their weddings! Ideally, the qualified candidate will be sociable and charismatic while still maintaining the distance and impartial eye required of a truly exceptional photographer. A formal education in photographer is considered as an asset, but we base our hiring decisions almost entirely on the portfolios of the photographer\'s we interview. We look forward to hearing from you!', '2021-09-15');
INSERT INTO `job` VALUES (8, 8, 'Carpentry', 'Finishing Carpenter', 65000, 'We pride ourselves on our careful, classic finishing carpentry designs. Do you love the fine art of crafting beautiful works from wood? If so, please apply immediately. We are in the midst of searching for someone with several years of experience in fine wood handicraft, and we make no compromises in terms of quality, so please only apply if your capabilities match the work we do. Many examples are available on our website.', '2021-08-16');
INSERT INTO `job` VALUES (9, 9, 'Service', 'Front of House', 45000, 'Are you accustomed to the finer pleasures of life, and do you know what it means to provide a truly wonderful experience as both host and guide? If this sounds like you, then please apply for our position as Front of House. We search for candidates who ideally have over a decade of experience in the fine dining industry. A deep and engaged knowledge of wines, brandies, and cognacs is essential to this position. We provide extensive training regarding the properties of our brandies and our plates, but a deep knowledge of the fine dining experience is essential for this role.', '2021-09-20');
INSERT INTO `job` VALUES (10, 10, 'Service', 'Retail Clerk', 27500, 'Do you love to smoke? Do you know your smokeable accessories? Are you part of the culture? If all of these apply, come see us down at Smoke Show. Drop on in.', '2021-09-15');

-- TUPLE (job_application_ID, username, job_ID, job_name, employer_ID, employer_name, application_text, application_status, application_response)
INSERT INTO `job_application` VALUES (1, 'zeba', 1, 'System Administrator', 1, 'Alpha Computing', 'I have 20+ years of Windows System administration, and am a quick learner. I have used Linux for 15 minutes, but then it crashed, and it caused me such anxiety that I went back to Microsoft. As a result of this, I started learning PowerShell to increase my self-esteem, but found that it was insufferable, so I started using bash in Ubuntu after setting up WSL. As such, I am indeed proficient in computer systems. My knowledge of networking is sufficient, as I am capable of running the commands ipconfig and ping. Please reach out soon!', 'active', NULL);
INSERT INTO `job_application` VALUES (2, 'zeba', 5, 'Web Developer', 5, 'Stan\'s Bagels', 'I have 5+ years as a web developer, and I am a very fast learner. I continuously gravitate betweent the front and back-end, but I can\'t say that I\'m good at either. As such, I am full-stack. You will see that my stack is sufficiently stacked that I pack a real smack when it comes to applications that we all think are wack. Other than that... I have used Linux for 15 minutes, but then it crashed, and it caused me such anxiety that I went back to Microsoft. As a result of this, I started learning PowerShell to increase my self-esteem, but found that it was insufferable, so I started using bash in Ubuntu after setting up WSL. As such, I am indeed proficient in computer systems. My knowledge of networking is sufficient, as I am capable of running the commands ipconfig and ping. Please reach out soon!', 'active', NULL);
INSERT INTO `job_application` VALUES (3, 'damo', 4, 'Barista', 4, 'Kettle Coffee', 'Many call me a splendid cook. I have worked many years as a barista, a prep cook, and a line cook. Reach out anytime', 'active', NULL);
INSERT INTO `job_application` VALUES (4, 'damo', 6, 'Line Cook', 6, 'Tony Pizzeria', 'Many call me a splendid cook. I have worked many years as a barista, a prep cook, and a line cook. Reach out anytime', 'active', NULL);
INSERT INTO `job_application` VALUES (5, 'gord', 1, 'System Administrator', 1, 'Alpha Computing', '20+ years experience in computer architecture, including advanced knowledge of assembly, C/C++, Fortran, Pascal, and Python. Advanced knowledge of mathematics and linear algebra. Ample experience working with low-level circuitry, microprocessors, and embedded systems. 5+ years experience working on computer graphics in C++.', 'active', NULL);
INSERT INTO `job_application` VALUES (6, 'gord', 2, 'Electrical Engineer', 2, 'Darryl Electronics', '20+ years experience in computer architecture, including advanced knowledge of assembly, C/C++, Fortran, Pascal, and Python. Advanced knowledge of mathematics and linear algebra. Ample experience working with low-level circuitry, microprocessors, and embedded systems. 5+ years experience working on computer graphics in C++.', 'active', NULL);
INSERT INTO `job_application` VALUES (7, 'gord', 3, 'Computer Architect', 3, 'Jimba Microprocessors', '20+ years experience in computer architecture, including advanced knowledge of assembly, C/C++, Fortran, Pascal, and Python. Advanced knowledge of mathematics and linear algebra. Ample experience working with low-level circuitry, microprocessors, and embedded systems. 5+ years experience working on computer graphics in C++.', 'active', NULL);


-- --------------------------------------------------------------------------------------------------------------------------------


-- TEST QUERIES / JUST FOR WORKING ON THE PHP/FUNCTIONALITY

SELECT * FROM employer;
SELECT * FROM user_category;
SELECT * FROM user;
SELECT * FROM payment_method;
SELECT * FROM payment_account;
SELECT * FROM payment;
SELECT * FROM job;
SELECT * FROM job_application;

UPDATE payment_account SET username='alpha' WHERE payment_account_ID=3;

SELECT user.security_answer AS securityAnswer
FROM user
WHERE user.username = 'zeba';

-- Gets the most recent application for the employer logged in!
SELECT *
FROM job_application, user
WHERE job_application.employer_ID = user.employer_ID
AND user.username = 'alpha'
ORDER BY job_application.job_application_ID
DESC LIMIT 0, 1;

SELECT user.first_name
FROM user, job_application
WHERE user.username = job_application.username
AND job_application_ID = (SELECT job_application.job_application_ID
						  FROM job_application, user
						  WHERE job_application.employer_ID = user.employer_ID
						  AND user.username = 'alpha'
						  ORDER BY job_application.job_application_ID
						  DESC LIMIT 0, 1);

DELETE FROM job_application WHERE job_application_ID = 1;
DELETE FROM user WHERE user.username = 'damo';

ALTER TABLE employer MODIFY employer_ID INT AUTO_INCREMENT;

SELECT * FROM user;
UPDATE user SET user.user_category='User Basic', user.first_name='Damo', user.last_name='Suzuki', user.password='damo', user.email='damo@mysticalvoice.org', user.security_answer='Rashomon', user.total_jobs_posted=0, user.total_applications_submitted=2, user.status='active' WHERE user.username='damo';

SELECT COUNT(*) AS returnValue FROM user WHERE user.username='n_lamo' AND user.user_category='Admin';

SELECT * FROM job_application;
SELECT DISTINCT job_application.job_application_ID, job_application.job_ID, job_application.job_name, job_application.employer_name
FROM job_application, user
WHERE job_application.employer_ID = (SELECT user.employer_ID
									 FROM user
									 WHERE user.username = 'alpha');
                                     
SELECT DISTINCT job.job_ID, job.employer_ID, job.title
FROM job, user
WHERE job.employer_ID = (SELECT user.employer_ID
						 FROM user
						 WHERE user.username = 'alpha') 
ORDER BY job.job_ID;
              
SELECT * FROM job WHERE job.employer_ID = 1;

SELECT * 
FROM job
WHERE job.employer_ID=1;

SELECT * 
FROM job_application
WHERE job_application.employer_ID = (SELECT user.employer_ID 
                                     FROM user
									 WHERE user.username = 'alpha')
AND job_application.application_status = 'accepted';
						
SELECT DISTINCT job_application.job_application_ID, job_application.job_ID, job_application.job_name, job_application.username
FROM job_application
WHERE job_application.username='zeba';


-- --------------------------------------------------------------------------------------------------------------------------------


-- SQL QUERIES FOR ASSIGNMENT
-- Simply just examples, not to be used for the database as such

-- IMPORTANT NOTE: Might adopt a 'SET NULL' policy for deletions from 'user' and 'employer'
--                 such that these names ('username' and 'employer_ID') become null in child rows upon deletion of parent table

-- i.
-- Create/delete/edit/display an employer
INSERT INTO `employer` VALUES (DEFAULT, 'Business Name', '555 Falsehood Boulevard', '555-515-2314', 'businessname@notreal.fake');
UPDATE `employer` SET employer.name = 'Different Business Name' WHERE employer.name = 'Business Name';
SELECT * FROM `employer` WHERE employer.name = 'Different Business Name';
DELETE FROM `employer` WHERE employer.name = 'Different Business Name';

-- ii.
-- Create/delete/edit/display a category by an employer
INSERT INTO `employer` VALUES (DEFAULT, 'Different Business Name', '555 Falsehood Boulevard', '555-515-2314', 'businessname@notreal.fake');
UPDATE `employer` SET employer.email = 'differentbusiness@fake.notreal' WHERE employer.name = 'Different Business Name';
SELECT * FROM `employer` WHERE employer.email = 'differentbusiness@fake.notreal';
DELETE FROM `employer` WHERE employer.email = 'differentbusiness@fake.notreal';

-- iii.
-- Post a new job by an employer
INSERT INTO `job` VALUES (DEFAULT, 1, 'IT', 'Network Analyst', 110000, 'Here at Alpha Computing, we are on the lookout for a network analyst who posesses at least 
10 years of experience in networking solutiosn. A MSc in Computer Science, Information Technology, or Cybersecurity is required.', '2021-09-07');

-- iv.
-- Provide a job offer for an employee by an employerr
UPDATE `job_application` SET application_status='accepted', 
application_response='It is with pleasure that you contacting you to provide a job offer. Based on your credentials, experience, 
and your performance on the tests, we believe that you have the requisite qualifications for this positions. We are so certain of 
this that we intend to offer you $120000 per year for this position. Please provide us with your response within a week\'s time' 
WHERE (job_application_ID = 7 AND username = 'gord' AND job_ID = 3);

-- v.
-- Report of a posted job by an employer (job title, job description, date posted, list of employees applied to job, status of each application)
SELECT job.title, job.description, job.date_start, job_application.username, job_application.application_status
FROM `job`, `job_application`
WHERE job.job_ID = job_application.job_ID
AND job.title = 'System Administrator';

-- vi.
-- Report of posted jobs by an employer during a specific period of time (job title, date posted, short description, number of needed employees, number of accepted offers)
SELECT DISTINCT job.title, job.date_start, job.description, job_application.application_status
FROM job, job_application
WHERE date_start BETWEEN '2021-06-01' AND '2021-08-31'
AND job_application.application_status = 'accepted';

-- vii.
-- Create/delete/edit/display a category by an employer
INSERT INTO `user` VALUES ('new_user', NULL, 'User Basic', 'UserFirstName', 'UserLastName', 'UserEmail' ,'Password12!' ,'MySecurityAnswer', 0, 0,'active');
UPDATE `user` SET user.first_name = 'Updated first_name' WHERE user.first_name = 'UserFirstName';
SELECT * FROM `user` WHERE user.first_name = 'Updated first_name';
DELETE FROM `user` WHERE user.first_name = 'Updated first_name';

-- viii.
-- Search for a job by an employee
SELECT *
FROM `job`
WHERE job.title = 'Technical Support';

-- ix.
-- Apply for a job by an employee
INSERT INTO `job_application` VALUES (DEFAULT, 'zeba', 4, 'Barista', 4, 'Kettle Coffee', 
'Barista has always been my passion. The art of creating something form basic ingredients is a wow for me.', 'active', NULL);

-- x. 
-- Accept/deny a job offer by an employee
UPDATE `job_application` SET application_status='accepted' WHERE (job_application.job_application_ID = 4 AND job_application.username = 'damo');
UPDATE `job_application` SET application_status='rejected' WHERE (job_application.job_application_ID = 4 AND job_application.username = 'damo');

-- xi.
-- Withdraw from an applied job by an employee 
UPDATE `job_application` SET username=NULL, job_ID=NULL, job_name=NULL, employer_ID=NULL, employer_name=NULL, application_text=NULL, application_status=NULL, 
application_response=NULL WHERE (job_application.job_application_ID = 8 AND job_application.username = 'zeba');

-- xii.
-- Delete a profile by an employee
UPDATE `user` SET employer_ID=NULL, user_category=NULL, first_name=NULL, last_name=NULL, email=NULL, password=NULL, security_answer=NULL, 
total_jobs_posted=NULL, total_applications_submitted=NULL, status='inactive' WHERE user.username='j_randal';

-- xiii
-- Report of applied jobs by an employee during a specific period of time (job title, date applied, short description, status)
SELECT job_application.job_name, job_application.application_text, job_application.application_status
FROM job_application, job
WHERE job_application.job_ID = job.job_ID
AND job.date_start BETWEEN '2021-06-01' AND '2021-08-31'
AND job_application.username = 'gord';

SELECT * FROM job_application;
-- xiv.
-- Add/delete/edit a method of payment by a user.
INSERT INTO `payment_account` VALUES (DEFAULT, 'alpha', 'Ali Grandich', '4839818028408122', '2021-09-01', 'Chequing', 'Automatic', 8400, 'Settled');
UPDATE `payment_account` SET payment_account.payment_method ='Credit' WHERE payment_account.payment_method = 'Chequing' AND payment_account.username = 'alpha';
SELECT * FROM `payment_account` WHERE payment_account.payment_method = 'Credit' AND payment_account.username = 'alpha';
UPDATE `payment_account` SET username = NULL, cardholder_name = NULL, card_number = NULL, expiration_date = NULL, payment_method = NULL, withdrawal_type = NULL,
balance = NULL, status = NULL WHERE payment_account_ID = 13;

-- xv. 
-- Add/delete/edit an automatic payment by a user
INSERT INTO `payment_account` VALUES (DEFAULT, 'alpha', 'Ali Grandich', '48398180284081', '2021-09-01', 'Chequing', 'Automatic', 2200, 'Settled');
UPDATE `payment_account` SET payment_account.withdrawal_type ='Manual' WHERE payment_account.withdrawal_type = 'Automatic' AND payment_account.username = 'alpha';
SELECT * FROM `payment_account` WHERE payment_account.withdrawal_type = 'Manual' AND payment_account.username = 'alpha';
UPDATE `payment_account` SET username = NULL, cardholder_name = NULL, card_number = NULL, expiration_date = NULL, payment_method = NULL, withdrawal_type = NULL,
balance = NULL, status = NULL WHERE payment_account_ID = 14 AND payment_account.withdrawal_type = 'Automatic';

-- xvi.
-- Make a manual payment by a user.
INSERT INTO `payment` VALUES (DEFAULT, 1, 'User Gold', 20);

-- xvii.
-- Report of all users by the administrator for employers or employees (Name, email, category, status, balance)
SELECT user.first_name, user.last_name, user.email, user.user_category, user.status, payment_account.balance
FROM `user`, `payment_account`
WHERE user.username = payment_account.username;

-- xviii.
-- Report of all outstanding balance accounts (e.g. where money is owing, where there is debt)
SELECT * FROM payment_account
WHERE balance < 0;


