CREATE DATABASE `mr_better_life_consultancy`;

USE DATABASE `mr_better_life_consultancy`;

/*
-------------------------------------------
----------- DATABASE SCHEMA -----------------
-------------------------------------------
*/

-- this table will have information to save the number of visits to the website
CREATE TABLE user_visits
(
	`visit_id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `visit_time` datetime NOT NULL DEFAULT now(),
    `user_id` int(11) NOT NULL DEFAULT 0,
	`ip_address` varchar(20) DEFAULT NULL,
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- table for user data
CREATE TABLE users
(
	`user_id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`first_name` varchar(50) NOT NULL,
	`middle_name` varchar(50) DEFAULT NULL,
	`last_name` varchar(50) NOT NULL,
	`date_of_birth` DATE NOT NULL, 
	`gender` SET('MALE','FEMALE','OTHER','') NOT NULL,
	`phone` varchar(10) NOT NULL,
	`alternate_phone` varchar(10) DEFAULT NULL,
	`password` VARCHAR(25) NOT NULL,
	`email` varchar(50) NOT NULL,
	`alternate_email` varchar(50) DEFAULT NULL,
	`current_address` varchar(255) DEFAULT NULL,
	`permanent_address` varchar(255) DEFAULT NULL,
	`profile_picture` VARCHAR(50) NOT NULL,
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- education 
-- a user can have more than one entries in this table

CREATE table education
(
	`education_id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`degree_name` varchar(100) NOT NULL,
	`college_university` varchar(100) NOT NULL,
	`is_completed` BOOLEAN NOT NULL COMMENT "1-completed, 0-ongoing",
	`start_year` year NOT NULL,
	`expected_year` year DEFAULT NULL,
	`end_year` year DEFAULT NULL,
	`marks_type` varchar(15) NOT NULL COMMENT "CGPA, MARKS, PERCENTAGE",
	`obtained` decimal NOT NULL,
	`total` decimal NOT NULL,
	`class` varchar(25) NOT NULL COMMENT "DISTINCTION, FIRST CLASS, SECOND CLASS, THIRD CLASS",
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- work_experience
CREATE TABLE work_experience
(
	`experience_id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
    `work_type` varchar(25) NOT NULL COMMENT "1-job, 2-internship",
	`company_name` varchar(50) NOT NULL,
	`role` varchar(50) NOT NULL,
	`designation` varchar(50) NOT NULL,
    `still_working` BOOLEAN NOT NULL COMMENT "1-yes, 0-no",
	`start_date` date NOT NULL,
   	`notice_period` varchar(20) DEFAULT NULL,
	`end_date` date DEFAULT NULL,
	`salary` int(11) DEFAULT NULL,
	`employment_type` varchar(15) NOT NULL COMMENT "Full-time, part-time, contract",
	`office_address` varchar(255) DEFAULT NULL,
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- degrees table is used to store the names of all the degrees available in india, this will be used in dropdown for user education details forms
CREATE TABLE degrees
(
	`degree_id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `description` text DEFAULT NULL,
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- prospect table will have all the entries made by customers to book a free session without creating an account
CREATE TABLE prospect
(
    `prospect_id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `prospect_name` varchar(30) NOT NULL,
    `phone` varchar(15) NOT NULL,
    `email` varchar(60) NOT NULL,
    `subject` varchar(255) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `follow_up_timeline` text DEFAULT '{}',
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- region details
-- here a region will have one or more universities in it
CREATE TABLE region
(
	`region_id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`region_name` varchar(150) NOT NULL,
	`shortcode` VARCHAR(15) NOT NULL,
	`is_country` boolean DEFAULT 1,
	`is_continent` boolean DEFAULT 0,
	`logo` VARCHAR(100) DEFAULT NULL,
	`brief_document` TEXT NULL DEFAULT NULL,
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
)  
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- service details
-- here a service will have one or more universities in it
CREATE TABLE service
(
	`service_id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`service_name` varchar(150) NOT NULL,
	`brief_document` TEXT NULL DEFAULT NULL,
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
)  
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- university details
CREATE TABLE university(
  `university_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `university_name` varchar(150) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alternate_phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alternate_email` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `additional_info` text DEFAULT NULL,
  `logo` VARCHAR(100) DEFAULT NULL,
  `brief_document` TEXT NULL DEFAULT NULL,
  `created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- university course will have all the list of courses that a university has
CREATE TABLE university_course(
	`course_id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`university_id` int(11) NOT NULL,
	`name` varchar(100) NOT NULL,
	`department` varchar(100) NOT NULL,
	`degree` varchar(100) NOT NULL,
	`subject` varchar(100) NOT NULL,
	`type_of_study` varchar(50) NOT NULL,
	`intake` varchar(50) NOT NULL COMMENT "Spring, Fall, Summer, Autumn",
	`eligibility` text DEFAULT NULL,
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- settings table will have values for us to store development related data
CREATE TABLE settings(
	settings_id int(11) PRIMARY KEY AUTO_INCREMENT,
	name varchar(50) NOT NULL,
	value varchar(255) NOT NULL,
	created_on datetime DEFAULT now(),
	last_updated_on datetime DEFAULT NULL,
	status varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- to store session details
CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL PRIMARY KEY,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL KEY,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
-------------------------------------------
----------- DATABASE DATA -------------------
-------------------------------------------
*/

INSERT INTO `region`(`region_name`, `shortcode`, `is_country`, `is_continent`, `logo`) VALUES 
	('United Kingdom', 'UK', 1, 0, 'region-1.png'),
	('United States of America', 'USA', 1, 0, 'region-2.png'),
	('Canada', 'Canada', 1, 0, 'region-3.png'),
	('Europe', 'Europe', 0, 1, 'region-4.png'),
	('Asia', 'Asia', 0, 1, 'region-5.png'),
	('Ireland', 'Ireland', 1, 0, 'region-6.png'),
	('New Zealand', 'New Zealand', 1, 0, 'region-7.png'),
	('Australia', 'Australia', 0, 1, 'region-8.png');


INSERT INTO `service`(`service_name`, `brief_document`) VALUES 
('Student Profile Analysis', ''),
('Career Counselling', ''),
('Test Preparation', ''),
('Course/University Selection', ''),
('Application & Admission Assitance', ''),
('Financial Aid & Scholarship', ''),
('Education Loan', ''),
('Visa Guidance', ''),
('Pre-Departure Briefing', ''),
('Post-Arrival Assitance', '');

INSERT INTO `university`(`region_id`, `university_name`, `country`, `state`, `city`, `address`, `phone`, `alternate_phone`, `email`, `alternate_email`, `website`, `additional_info`, `logo`) VALUES 
	(1, "University of Connecticut, Storrs, Connecticut (Public Ivy) (OnlyUG)", "USA", "", "", "",  "", "", "", "", "", "uconn.edu/", "1.png"),
	(1, "Johns Hopkins University, Baltimore, Maryland (School of Engineering – Only PG)", "USA", "", "", "",  "", "", "", "", "", "https://www.jhu.edu/", "2.png"),
	(1, "Arizona State University, Phoenix, Arizona", "USA", "", "", "",  "", "", "", "", "", "https://www.asu.edu/", "2.png"),
	(1, "University of Massachusetts Amherst, Amherst, Massachusetts (Masters Programs & ECE MS 1+1 Program)", "USA", "", "", "",  "", "", "", "", "", "https://www.umass.edu/", "4.png"),
	(2, "University of California, Riverside, California (Graduate Business Programs & College of Engineering and UCR Extension)", "USA", "", "", "",  "", "", "", "", "", "https://www.business.ucr.edu/graduate.edu/", "5.png"),
	(2, "Virginia Tech Language and Culture Institute, Blacksburg, Virginia (UG and PG Pathways)", "USA", "", "", "",  "", "", "", "", "", "https://www.lci.vt.edu/", "6.png"),
	(3, "University of South Florida, Tampa, Florida (Only UG)", "USA", "", "", "",  "", "", "", "", "", "https://www.usf.edu/", "7.png"),
	(3, "University of Arizona, Tucson, Arizona", "USA", "", "", "",  "", "", "", "", "", "https://www.arizona.edu/", "8.png"),
	(4, "Drexel University, Philadelphia, Pennsylvania (College of Engineering, UG Gateways and IEP)", "USA", "", "", "",  "", "", "", "", "", "https://www.drexel.edu/", "9.png"),
	(5, "University of Delaware, Newark, Delaware (Only UG)", "USA", "", "", "",  "", "", "", "", "", "https://www.udel.edu/", "10.png"),
	(1, "Miami University, Oxford, Ohio (Public Ivy)", "USA", "", "", "",  "", "", "", "", "", "https://www.maiamioh.edu/", "11.png"),
	(1, "University of Vermont, Burlington, Vermont (Only UG)", "USA", "", "", "",  "", "", "", "", "", "https://www.uvm.edu/", "12.png"),
	(1, "University of Wisconsin-Madison, Madison, Wisconsin (Pre College)", "USA", "", "", "",  "", "", "", "", "", "https://precollege.wisc.edu/international/", "13.png"),
	(1, "Lehigh University, Bethlehem, Pennsylvania (Only PG)", "USA", "", "", "",  "", "", "", "", "", "https://www2.lehigh.edu/", "14.png");


CREATE TABLE admin
(
	`admin_id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`first_name` varchar(30) NOT NULL,
	`last_name` varchar(30) NOT NULL,
	`phone` varchar(15) NOT NULL,
	`email` varchar(50) NOT NULL,
	`password` varchar(25) NOT NULL,
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
);

CREATE TABLE testimonial
(
	`testimonial_id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`user_id` varchar(30) NOT NULL,
	`no_of_stars` varchar(30) NOT NULL,
	`review` varchar(15) NOT NULL,
	`created_on` DATETIME NOT NULL DEFAULT now(),
	`last_updated_on` DATETIME NULL DEFAULT NULL,
	`status` VARCHAR(20) NOT NULL DEFAULT 'active'
);

INSERT INTO `testimonial`( `no_of_stars`, `review`, `created_on`) VALUES 
(5, "With all of your questionaries, they provide excellent assistance for higher education, and the calibre of their work far exceeds expectations.", now()),
(5, "MR betterlife consultancy is one of the best If you have a dream of going abroa. They helped​ me throughout the journey and thank you team for your endlessness help.", now()),
(4, "When i decided to come UK I started searching for consultancies many of my friends recommended the MR Betterlife consultancy, they helped me a lot in selecting the universities and visa processing. After coming to the UK they helped me to get right accommodation hoping for the further help after my studies.", now()),
(5, "MR Betterlife Consultancy provided exceptional service throughout my application journey. From shortlisting the universities to finalizing my admission, their support was unwavering. The team’s expertise and encouragement were crucial to my success in getting admitted to a prestigious university in USA.", now());


INSERT INTO university(`university_name`,`address`,`additional_info`,`website`,`region_id`) VALUES
("University of Connecticut", "Storrs", "Connecticut (Public Ivy) (OnlyUG)", "uconn.edu/", 2),
("Johns Hopkins University", "Baltimore", "Maryland (School of Engineering – Only PG)", "https://www.jhu.edu/", 2),
("Arizona State University", "Phoenix, Arizona", "", "www.asu.edu", 2),
("University of Massachusetts Amherst", "Amherst, Massachusetts", "(Masters Programs)", "https://www.umass.edu/", 2),
("University of California", "Riverside, California", "(Graduate Business Programs & College of Engineering and UCR Extension)", "business.ucr.edu/graduate", 2),
("University of Cincinnati", "Cincinnati, Ohio", "", "www.uc.edu", 2),
("University of Utah", "Salt Lake City, Utah", "(Only UG)", "www.utah.edu", 2),
("Auburn University", "Auburn, Alabama", "", "www.auburn.edu", 2),
("Claremont Graduate University", "Claremont, California", "", "www.cgu.edu/", 2),
("The University of Alabama", "Tuscaloosa, Alabama", "", "www.ua.edu/", 2),
("University of Illinois at Chicago", "Chicago, Illinois", "(Only UG)", "www.uic.edu", 2),
("Oregon State University", "Corvallis, Oregon", "", "https://oregonstate.edu/", 2),
("Colorado State University", "Fort Collins, Colorado", "", "www.colostate.edu", 2),
("The University of Oklahoma", "Norman, Oklahoma", "", "https://www.ou.edu/", 2),
("George Mason University", "Fairfax County, Virginia", "", "https://www.gmu.edu/", 2),
("University of Oregon", "Eugene, Oregon", "", "https://uoregon.edu/", 2),
("Lehigh University", "Bethlehem, Pennsylvania", "(Only PG)", "https://www2.lehigh.edu/", 2),
("University of Wisconsin-Madison", "Madison, Wisconsin", "(Pre College)", "https://precollege.wisc.edu/international/", 2),
("University of Vermont", "Burlington, Vermont", "(Only UG)", "https://www.uvm.edu/", 2),
("Miami University", "Oxford, Ohio", "(Public Ivy)", "https://miamioh.edu/", 2),
("University of Delaware", "Newark, Delaware", "(Only UG)", "www.udel.edu", 2),
("Drexel University", "Philadelphia, Pennsylvania", "(College of Engineering, UG Gateways and IEP)", "www.drexel.edu", 2),
("University of Arizona", "Tucson, Arizona", "", "www.arizona.edu", 2),
("University of South Florida", "Tampa, Florida", "(Only UG)", "www.usf.edu", 2),
("Virginia Tech Language and Culture Institute", "Blacksburg, Virginia", "(UG and PG Pathways)", "www.lci.vt.edu", 2);

UPDATE `university` SET `brief_document`='{"header_content" : "", "image_1_url" : "", "image_2_url" : "", "image_3_url" : "", "image_4_url" : ""}' WHERE 1;

CREATE TABLE `scholarships`(
	`scholarship_id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `region_id` int(11) NOT NULL,
    `university_name` varchar(255) NOT NULL,
    `type` varchar(255) NOT NULL,
    `description` text DEFAULT "{}",
    `amount` varchar(50) NOT NULL
);

INSERT INTO `scholarships`(`region_id`, `university_name`, `type`, `description`, `amount`) VALUES 
('2','Full Sail University','Academic Advantage Scholarship','Students receive an award in their first academic year if they have earned cumulative GPA of 3.0 or higher on a 4.0 scale in their  undergraduate degree. Receive an award in a subsequent academic year if their Full Sail University cumulative GPA is 3.0 or higher','Upto $15,000.'),
('2','Colorado State University','Merit based scholarships', 'Students will learn of their admission decision AND scholarship award amount within 14 days after submitting an application. Scholarships are renewable each year as long as the student maintains good academic standing at CSU.','Up to $2,000 to $12,000 per year.','',''),
('2','','','',''),
('2','','','',''),
('2','','','',''),
('2','','','',''),
('2','','','',''),
('2','','','',''),
('2','','','',''),
('2','','','',''),
('2','','','',''),
('2','','','',''),
('2','','','',''),