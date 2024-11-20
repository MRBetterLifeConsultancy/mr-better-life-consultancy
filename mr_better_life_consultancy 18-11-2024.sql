-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 05:16 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mr_better_life_consultancy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_on` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `phone`, `email`, `password`, `created_on`, `last_updated_on`, `status`) VALUES
(1, 'Dushyanth', 'Kumar', '8497975675', 'neelimag459@gmail.com', 'neel1234', '2024-11-05 01:52:26', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('2v2tr344pncj9d0ibiac06n9s4tvdopr', '::1', 2024, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733303438333031363b5f63695f70726576696f75735f75726c7c733a32383a2268747470733a2f2f6c6f63616c686f73742f6e65775f70616765732f223b);

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `degree_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `education_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `degree_name` varchar(100) NOT NULL,
  `college_university` varchar(100) NOT NULL,
  `is_completed` tinyint(1) NOT NULL COMMENT '1-completed, 0-ongoing',
  `start_year` year(4) NOT NULL,
  `expected_year` year(4) DEFAULT NULL,
  `end_year` year(4) DEFAULT NULL,
  `marks_type` varchar(15) NOT NULL COMMENT 'CGPA, MARKS, PERCENTAGE',
  `obtained` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `class` varchar(25) NOT NULL COMMENT 'DISTINCTION, FIRST CLASS, SECOND CLASS, THIRD CLASS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prospect`
--

CREATE TABLE `prospect` (
  `prospect_id` int(11) NOT NULL,
  `prospect_name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `follow_up_timeline` text DEFAULT '{}',
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_on` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prospect`
--

INSERT INTO `prospect` (`prospect_id`, `prospect_name`, `phone`, `email`, `subject`, `description`, `follow_up_timeline`, `created_on`, `last_updated_on`, `status`) VALUES
(1, 'Neelima', '8497975675', 'neelimag459@gmail.com', '', 'zsxdrctfv dtfgyh esdrtfyg derftgy edrfg drfg dfgy', '[{\"datetime\":\"2024-11-12 00:03:31\",\"message\":\"hello\"},{\"datetime\":\"2024-11-12 00:10:50\",\"message\":\"Customer is interested in US universities for computer science degrees\"}]', '2024-11-05 00:54:51', '2024-11-12 00:10:50', 'active'),
(2, 'Neel', '8497975675', 'neelimag459@gmail.com', '', 'wertyui', '{}', '2024-11-14 00:05:12', NULL, 'active'),
(3, 'Nee', '8497975675', 'neelimag459@gmail.com', '', 'hello', '{}', '2024-11-14 00:39:10', NULL, 'active'),
(4, 'Neelima', '8497975675', 'neelimag459@gmail.com', 'hello', 'OMG', '{}', '2024-11-15 01:18:05', NULL, 'active'),
(5, 'sai', '8367325535', 'neelimag459@gmail.com', 'Hello', 'omg ha ha', '{}', '2024-11-15 01:21:22', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(150) NOT NULL,
  `shortcode` varchar(15) NOT NULL,
  `is_country` tinyint(1) DEFAULT 1,
  `is_continent` tinyint(1) DEFAULT 0,
  `logo` varchar(100) DEFAULT NULL,
  `brief_document` text DEFAULT NULL,
  `status` varchar(10) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `region_name`, `shortcode`, `is_country`, `is_continent`, `logo`, `brief_document`, `status`) VALUES
(1, 'United Kingdom', 'UK', 1, 0, 'region-1.png', '{\n            \"header_content\" : \"With an academic reputation built on centuries old heritage, The UK is home to some of the world’s oldest universities that consistently rank among the highest in the world. Universities in UK have a rich legacy of welcoming international students for centuries and are known to offer an unforgettable student experience as they know the needs and aspirations of their students very well.\",\n\n            \"why_content\" : \"Learn from some of the world\'s best academics and experts in some of world’s most prestigious universities and benefit from their exceptional academic support. Study alongside some of the finest and brilliant minds and hone your skills using state-of-the-art technology. Avail placements, internships and volunteering positions that are your right fit through strong industry links of UK universities and apply your knowledge and skills in a real-world professional environment. Graduate with skills and expertise that are in high demand around the world and get hired by your dream employers.\",\n\n            \"key_points\" : [\n                \"The UK undertakes 5% of the world’s scientific research and produces 14% of the world’s most frequently cited papers\",\n                \"UK welcomes over 400,000 students every year\",\n                \"Post study work visa of 2 years\",\n                \"12 of world’s top 100 universities are in The UK (QS World Rankings 2024)\",\n                \"14 of the best student cities in the world are in The UK (QS Best Student Cities 2024)\",\n                \"UK offers 131 universities of international repute to study from\",\n                \"Admission without IELTS possible\",\n                \"Masters courses with 1 year work placements are available\"\n            ],\n\n            \"cost\" : {\n                \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in GBP\"],\n                \"rows\" : [\n                    [\"Tution fees for one-year(Indicative)*\", \"14000\"],\n                    [\"Living and Accomodation\", \"9207\"],\n                    [\"Airfare from India to UK\", \"500\"],\n                    [\"Immigration Health Surcharge/National Health Surcharge\", \"1164\"],\n                    [\"Visa Fees\", \"490\"]\n                ],\n                \"footer_cells\" : [\"Total Expenses\", \"41535\"]\n            },\n\n            \"career_and_industry\" : \"The UK is one of the most globalised economies comprising of England, Scotland, Wales and Northern Ireland and is among the world’s biggest economies. The sectors that dominate UK’s economy include service sector, financial services, higher education, aerospace, pharmaceuticals, manufacturing and production. Best paid jobs in the UK include Information Technology Managers, Engineering Professionals, Business and Financial Management Professionals, Legal Professionals, Aircraft Pilots & Flight Engineers, Higher Education Teaching Professionals and Medical Practitioners.\",\n\"home_image_url\":\"uk-home.jpg\",\n            \"image_1_url\" : \"uk-1.jpg\",\n            \"image_2_url\" : \"uk-2.jpg\",\n            \"image_3_url\" : \"uk-3.jpg\",\n            \"image_4_url\" : \"uk-4.jpg\"\n        }', 'active'),
(2, 'United States of America', 'USA', 1, 0, 'region-2.png', '{\n            \"header_content\" : \"The United States of America has been a global leader in the field of education and boasts of a lion’s share of top ranked universities according to all major international rankings. Few countries offer as many high ranked universities and noble laureate academia, as USA does.\",\n\n            \"why_content\" : \"Study in one of the most prestigious higher education systems globally and access some high-end technology and cutting-edge research for an immersive, engaging & collaborative study experience. Choose from an extensive range of schools, numerous study disciplines and niche qualifications that are difficult to find by in other parts of the world and experience a uniquely flexible education system allowing you to apply to a variety of programs suiting your academic & career goals. Graduate with a truly global outlook and real-world skills for the future.\",\n\n            \"key_points\" : [\n                \"USA hosts more than a million international students\",\n                \"Over 25% of world’s top 100 universities are in the USA\",\n                \"Post-study stay back visas (OPT) up to 3 years for STEM programs\",\n                \"Internships (CPT) up to 12 months while studying\",\n                \"Merit Based & Need Based Scholarships\",\n                \"Over 4500 accredited universities & institutions to choose from\",\n                \"12 of the best student cities in the world (QS Best Student Cities 2024)\",\n                \"Opportunities for Research, Teaching & Graduate Assistantships\"\n            ],\n\n            \"cost\" : {\n                \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in USD\"],\n                \"rows\" : [\n                    [\"Tution fees for one-year(Indicative)*\", \"25000\"],\n                    [\"Living and Accomodation\", \"15000\"],\n                    [\"Airfare from India to USA\", \"1000\"],\n                    [\"Visa Fees (Visa & SEVIS)\", \"535\"]\n                ],\n                \"footer_cells\" : [\"Total Expenses\", \"41535\"]\n            },\n\n            \"career_and_industry\" : \"One of the most technologically powerful and dynamic countries, USA is the largest & most dominant economy globally. Sectors that empower this world’s most productive economy include Healthcare, Technology, Construction, Retail, Manufacturing, Finance & Insurance and Real Estate. Top jobs with high remuneration prospects for international students include Medicine, Computer & Information Systems Managers, Architectural & Engineering Managers and Marketing & Financial Managers. Standard of living in the USA is among the highest in the world with high per capita income. This nation performs very well in many measures of well-being such as income & wealth, health status, jobs and earnings, education & skills and environmental quality.\",\n\"home_image_url\":\"usa-home.jpg\",\n            \"image_1_url\" : \"usa-1.png\",\n            \"image_2_url\" : \"usa-2.png\",\n            \"image_3_url\" : \"usa-3.png\",\n            \"image_4_url\" : \"usa-4.png\"\n        }', 'active'),
(3, 'Canada', 'Canada', 1, 0, 'region-3.png', '{\n            \"header_content\" : \"A country that offers a truly dynamic education system with some of the world’s best universities, a high standard of living & a promising future, Canada is undoubtedly amongst the most popular and ideal study destinations in the world.\",\n\n            \"why_content\" : \"Study in a country that has tripled its international student population over the past decade, thanks to its globally recognized universities offering a world class education, highly practical programs with hands-on learning and some of the most affordable tuition fees among English-speaking countries. Enjoy top quality life in the ‘most liveable cities’ of Vancouver and Toronto and advance your career in one of the very resource rich, industrialized and stable economies.\",\n\n            \"key_points\" : [\n                \"Among the Safest Countries Globally\",\n                \"Hands-on learning\",\n                \"Paid Internships Available\",\n                \"Post Study Work Visa up to 3 Years\",\n                \"Excellent Immigration Opportunities\"\n            ],\n\n            \"cost\" : {\n                \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in CAD (Diploma)\", \"Annual Expenses in CAD (Degree)\"],\n                \"rows\" : [\n                    [\"Tution fees for one-year (Indicative)*\", \"17000\", \"20000\"],\n                    [\"Living and Accomodation\", \"20635\", \"20635\"],\n                    [\"Airfare from India to Canada\", \"2500\", \"2500\"],\n                    [\"Visa Fees (Including Biometric fees)\", \"235\", \"235\"]\n                ],\n                \"footer_cells\" : [\"Total Expenses\", \"40370\", \"43370\"]\n            },\n\n            \"career_and_industry\" : \"Among the wealthiest nations in the world, Canada is a land of opportunities for those who wish to study, live and prosper. Canada’s highly sophisticated economy is fuelled by sectors such as Agriculture, Energy, Technology, Manufacturing & Services. Top careers international students can look forward to include Engineering, Construction, IT, Healthcare, Law and Banking & Finance. This country enjoys a job growth rate well above its population growth rate and offers a high standard of living to all its residents including international students.\",\n\"home_image_url\":\"canada-home.jpg\",\n            \"image_1_url\" : \"canada-1.jpg\",\n            \"image_2_url\" : \"canada-2.webp\",\n            \"image_3_url\" : \"canada-3.jpg\",\n            \"image_4_url\" : \"canada-4.jpg\"\n        }', 'active'),
(4, 'Europe', 'Europe', 0, 1, 'region-4.png', '{\n            \"header_content\" : \"European universities combine rich traditions with high-tech facilities and unique research opportunities.\",\n\n            \"multiple\" : true,\n\n            \"countries\" : \n            {\n                \"France\": {\n                  \"header_content\": \"France is home to one of the most prestigious educational systems in the world. No matter what subjects or degrees you wish to pursue, there are plenty of universities and institutions that are a perfect match to your academic pursuits in France.\",\n              \n                  \"why_content\": \"Studying in France comes with a plethora of advantages such as accredited research laboratories, veteran professors committed to help you excel in your academics and institutions of world repute with excellent learning capabilities & infrastructure. Paris, France’s leading education destination is a hub for innovation, tech start-ups and Europe’s savvy entrepreneurs who are leading exciting ventures to tackle world’s biggest challenges. This country also offers an excellent multicultural study experience bringing together students from different parts of the world.\",\n              \n                  \"key_points\": [\n                    \"64 Nobel Laureates and 15 Fields Medals\",\n                    \"Post Study Work Visa up to 2 Years (post Masters’ degree)\",\n                    \"France is home to 3,500 higher education institutions\",\n                    \"4 French universities in top 100 in the world (QS World Rankings 2024)\",\n                    \"Affordable tuition fee and living expenses\",\n                    \"French – A popular language which is spoken across the globe\",\n                    \"Paris – one among top 10 student cities globally\",\n                    \"French public institutes & The French Foreign Ministry awards many different scholarships to international students\"\n                  ],\n              \n                  \"cost\": {\n                    \"header_cells\": [\"Types of Expenses\", \"Annual Expenses in €\"],\n                    \"rows\": [\n                      [\"Tution fees for one-year(Indicative)*\", \"10000\"],\n                      [\"Living and Accomodation\", \"12000\"],\n                      [\"Airfare from India to France\", \"450\"],\n                      [\"Visa Fees\", \"50\"]\n                    ],\n                    \"footer_cells\": [\"Total Expenses\", \"22500\"]\n                  },\n              \n                  \"career_and_industry\": \"France is the world\'s fifth largest economy and is home to 31 of the world\'s 500 most powerful companies. Airbus, LVMH, Orange, Danone, Total, L’Oréal & Sanofi are some of leading French organizations of international repute. France is also actively involved in global affairs as a member of leading organizations such as the European Union, The Group of Seven (G7), NATO & The World Trade Organization (WTO). Industries that dominate the employment market include health and social care, wholesale and retail trade, manufacturing, automotive, metallurgy, and aerospace. There is a high demand of professionals in the domains of Business & Management, Teaching, Information Technology, Health, Law and Aviation.\",\n              \n                  \"image_1_url\": \"europe1.svg\",\n                  \"image_2_url\": \"europe2.svg\",\n                  \"image_3_url\": \"europe3.svg\",\n                  \"image_4_url\": \"europe4.svg\"\n                },\n              \n                \"Germany\": {\n                  \"header_content\": \"Germany is fast becoming one of the most favoured choices for international education with hundreds of thousands of students seeking an entry in German universities. This country offers an unparalleled learning ecosystem known for producing high quality graduates who achieve high employability and better salaries in the global job market.\",\n              \n                  \"why_content\": \"Immerse in Germany’s unique education system where theory and practicum go hand in hand. Achieve your academic objectives and realize your true potential to build a strong foundation for your future career prospects. Study programs that are structured and delivered to meet world standards and acquire skills that future graduates are expected of. Develop innovative and practical solutions to real-world problems and carve your own niche in technologies for the real world.\",\n              \n                  \"key_points\": [\n                    \"More than 400 state-recognised institutions of higher education\",\n                    \"20,000 different study programmes to choose from\",\n                    \"Germany boasts of having over 400,000 international students\",\n                    \"Post Study Work Visa up to 1.5 Years\",\n                    \"Study in Europe’s strongest economy\",\n                    \"Free/affordable education coupled with affordable cost of living\",\n                    \"Programs available in English language\",\n                    \"Safe and happy environment for International Students\"\n                  ],\n              \n                  \"cost\": {\n                    \"header_cells\": [\"Types of Expenses\", \"Annual Expenses in €\"],\n                    \"rows\": [\n                      [\"Tution fees for one-year(Indicative)*\", \"10000\"],\n                      [\"Living and Accomodation\", \"11208\"],\n                      [\"Airfare from India to Germany\", \"300\"],\n                      [\"Visa Fees (Visa & SEVIS)\", \"75\"]\n                    ],\n                    \"footer_cells\": [\"Total Expenses\", \"21583\"]\n                  },\n              \n                  \"career_and_industry\": \"A founding member of the European Union, Germany is one of the most powerful and influential economies in the world and is the largest manufacturing economy in Europe. German companies such as Siemens, Volkswagen, BMW, Daimler & Allianz are known to be global leaders and have a world-wide network of branches. Leading sectors looking for international professionals include chemicals, engineering, electronics, IT, machinery, automobiles & manufacturing. Areas with high growth prospects include telecommunication, high-tech manufactured products, automotive industry, banking & finance.\",\n              \n                  \"image_1_url\": \"germany1.svg\",\n                  \"image_2_url\": \"germany2.svg\",\n                  \"image_3_url\": \"germany3.svg\",\n                  \"image_4_url\": \"germany4.svg\"\n                },\n              \n                \"Netherlands\": {\n                  \"header_content\": \"With Netherlands hosting students from as many as 160 countries, you can experience an excellent international culture in Dutch universities, which is complemented by an education ecosystem that is student centered and industry oriented at the same time.\",\n              \n                  \"why_content\": \"Study in Dutch universities that are known for offering carefully designed contemporary courses and infrastructure that matches global standards. Excel in your academics with a teaching style that emphasizes on teamwork allowing you to collaborate with like-minded Dutch and international students in an education system that inculcates analytical and problem-solving skills for the real world. Study practical elements embedded in your curriculum that will prepare you for the industry and benefit from excellent industry partnerships of Dutch universities with local and international companies allowing you to find internship opportunities related to your domain.\",\n              \n                  \"key_points\": [\n                    \"9 universities among top 200 in the world (QS World Rankings 2024)\",\n                    \"Multicultural country -One in every 10 university students is an international student\",\n                    \"Post Study Work Visa up to 1 Year\",\n                    \"Amsterdam, the capital city, is among the best student cities worldwide\",\n                    \"Over 2000 English taught programs to choose from\",\n                    \"Economical cost of education and living expenses\",\n                    \"One of the safest countries in the world (2018 Global Peace Index)\",\n                    \"Netherlands offers excellent career opportunities to international students\"\n                  ],\n              \n                  \"cost\": {\n                    \"header_cells\": [\"Types of Expenses\", \"Annual Expenses in €\"],\n                    \"rows\": [\n                      [\"Tution fees for one-year(Indicative)*\", \"11000\"],\n                      [\"Living and Accomodation\", \"11500\"],\n                      [\"Airfare from India to Netherlands\", \"570\"],\n                      [\"Visa Fees (Visa & SEVIS)\", \"210\"]\n                    ],\n                    \"footer_cells\": [\"Total Expenses\", \"23280\"]\n                  },\n              \n                  \"career_and_industry\": \"Netherlands has one of Europe’s most competitive economies and is the world’s 18th largest economy. Top sectors driving Netherland’s economy include Agriculture & Food, Clean Energy & Environment Technology, Creative & High Tech Industries, Logistics, and Water Industries. Popular job sectors in Netherlands include Energy Sector, Water Resource Management, Aerospace & Mechanical Sector, Information & Communications Technology and Banking & Finance. Netherlands is home to some of the world’s leading multinationals such as Philips, Heineken, KLM, Shell, ING and Unilever. In addition, MNCs such as Sony, Sara Lee and Microsoft have their European headquarters in this country. According to the Better Life Index, Netherlands ranks top in work-life balance and performs well in other parameters such as jobs & earnings, housing, education & skills environmental quality & health status.\",\n              \n                  \"image_2_url\": \"netherland2.svg\",\n                  \"image_1_url\": \"netherland1.svg\",\n                  \"image_3_url\": \"netherland3.svg\",\n                  \"image_4_url\": \"netherland4.svg\"\n                },\n              \n                \"Sweden\": {\n                  \"header_content\": \"With an education system that fosters creativity and emphasizes more on academic pursuits than just achieving higher grades and home to universities that instil ambition, innovation and critical thinking, Sweden is among the most innovative study destinations in the world.\",\n              \n                  \"why_content\": \"Swedish universities appreciate initiative and encourage students to actively contribute to collective learning efforts through lectures, seminars and group discussions. This approach gives students an opportunity to develop independent thinking and strengthens their academic abilities. Studies and practical work often go hand-in-hand in Swedish universities enabling their students to have some real-world experience when they graduate and enter the industry. Some notable successful innovations by Swedish universities and industries that are a result of this culture are computer mouse, the pacemaker, the dialysis machine, Bluetooth, Spotify & Skype.\",\n              \n                  \"key_points\": [\n                    \"Around 40 universities to study from\",\n                    \"Over 900 programs to choose from\",\n                    \"6 Swedish universities among world’s top 200 (QS World Rankings 2024)\",\n                    \"Post Study Work Visa up to 1 Year\",\n                    \"Capital city of Stockholm is among the best student cities\",\n                    \"\"\n                  ],\n              \n                  \"cost\": {\n                    \"header_cells\": [\"Types of Expenses\", \"Annual Expenses in SEK\"],\n                    \"rows\": [\n                      [\"Tution fees for one-year(Indicative)*\", \"145000\"],\n                      [\"Living and Accomodation\", \"102816\"],\n                      [\"Airfare from India to Sweden\", \"700\"],\n                      [\"Visa Fees (Visa & SEVIS)\", \"1500\"]\n                    ],\n                    \"footer_cells\": [\"Total Expenses\", \"250016\"]\n                  },\n              \n                  \"career_and_industry\": \"The economy of Sweden is a developed, export driven economy. The top industries that drive Swedish economy include automobiles, chemicals, home goods & appliances, iron & steel, pharmaceuticals, precision equipment and telecommunications. Sweden is known to have some large multinational organizations that are at the forefront of innovation and technology such as Ericsson, Volvo, Scania, Electrolux, SKF, Sandvik, Atlas Copco & IKEA. Top paid professions in Sweden include law, banking & finance, education, aviation, management, healthcare & tourism. Sweden performs very well in chief indicators of standard of living such as environmental quality, education and skills, work-life balance, health status, jobs and earnings and personal safety.\",\n              \n                  \"image_1_url\": \"sweden1.png\",\n                  \"image_2_url\": \"sweden2.png\",\n                  \"image_3_url\": \"sweden3.png\",\n                  \"image_4_url\": \"sweden4.png\"\n                },\n              \n                \"Austria\": {\n                  \"header_content\": \"Austria offers considerable cultural diversity and depth, as well as exceptional academic and social exposure for international students. To top it all, Austria is bordered by eight distinct countries, all of which are relatively simple to get to because of the country\'s effective and extensive rail system. The country has a thriving industry base and high employment ratio.\",\n              \n                  \"why_content\": \"Austria is home to universities and higher education facilities well acknowledged worldwide. This European country provides good quality education and supportive learning environment. It is a popular choice for students looking to study abroad due to its relatively low cost of study and living. The education system in this nation is more laid-back and accommodating, allowing pupils to take their time. Most universities offer courses taught in English which gives international students additional convenience. Exchange students have the option to enrol in exclusively specialized study tracks. Learning German helps students become more employable in Austria.\",\n              \n                  \"key_points\": [\n                    \"Strategic location in Europe\",\n                    \"3 Universities in Top 300 in the World (QS World Ranking 2023)\",\n                    \"Stay back option of 6 months for all International Students\",\n                    \"English Taught Courses\",\n                    \"Affordable tuition fee and living expenses\",\n                    \"Scholarships and Part-Time Job Opportunities for International Students\"\n                  ],\n              \n                  \"cost\": {\n                    \"header_cells\": [\"Types of Expenses\", \"Annual Expenses in €\"],\n                    \"rows\": [\n                      [\"Tution fees for one-year(Indicative)*\", \"10000\"],\n                      [\"Living and Accomodation\", \"9000\"],\n                      [\"Airfare from India to Austria\", \"350\"],\n                      [\"Visa Fees (Visa & SEVIS)\", \"160\"]\n                    ],\n                    \"footer_cells\": [\"Total Expenses\", \"19510\"]\n                  },\n              \n                  \"career_and_industry\": \"Austria offers a simple work permit system compared to other European countries. The country\'s job market is dominated by medium-sized businesses, as opposed to much of Europe, where the market is dominated by large businesses. Austria has a high minimum wage of €1,500 per month as of February 2023, for all sectors and Austrians make an average of €48,317 a year. Austria releases a list of jobs with a scarcity each year. Some of the professions which have a scarcity in the nation as of February 2023 are Power Engineers, Mechanical Engineers, Chemical Engineers, Cost Accountants, Specialists in Business Administration, Welders and Cutting Torch Operators, Floor and Wall Tilers, Chefs, Hotel Staff Members, Physicians and Medical Technologists. • Anaesthesiology & Intensive care medicine • Cardiology • Dermatology & Venerology • Endodontic • Gastroenterology\",\n              \n                  \"image_1_url\": \"austria1.png\",\n                  \"image_2_url\": \"austria2.png\",\n                  \"image_3_url\": \"austria3.png\",\n                  \"image_4_url\": \"austria4.png\"\n                },\n              \n                \"Denmark\" : \n                              {\n                                  \"header_content\" : \"The quality of education in Denmark is astounding, spanning a wide spectrum of academic disciplines like Health, Engineering, and Social Sciences. The school system in Denmark promotes creativity, imagination, analytical thinking, and critical thinking. Students in Denmark, experience a cutting-edge learning environment where they may pick the brains of business experts and apply for internships at well-known companies across the worl\",\n              \n                                  \"why_content\" : \"Denmark is a treasure trove of top-notch universities, with a few listed in the QS World University Rankings. Denmark\'s highly regarded universities, such as the University of Copenhagen and the University of Southern Denmark, are among the top universities here. Institutions like Aarhus University and Roskilde University are also among the select few preferred by international students. The degree a student receives from a Danish university or college will be valued and recognised globally. Most of the universities in Denmark offer excellent educational programmes and world-class facilities. Denmark offers great professional exposure to international students in addition to top-notch education. They can continue working while studying, but the best part is that even after receiving their degree, colleges and institutions assist students in finding internship opportunities at reputable organizations. Additionally, based on their qualifications and knowledge, students may be hired on a permanent basis.\",\n              \n                                  \"key_points\" : [\n                                      \"Top-Ranked Universities\",\n                                      \"3 Universities in Top 300 in the World (QS World Ranking 2023)\",\n                                      \"Stay back options available for International Students\",\n                                      \"Part-time job opportunities for students\",\n                                      \"Numerous grants and scholarships\",\n                                      \"Reasonable cost of living\"\n                                  ],\n              \n                                  \"cost\" : {\n                                      \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in EUR\"],\n                                      \"rows\" : [\n                                          [\"Tution fees for one-year(Indicative)*\", \"11000\"],\n                                          [\"Living and Accomodation\", \"12000\"],\n                                          [\"Airfare from India to Denmark\", \"550\"],\n                                          [\"Visa Fees (Visa & SEVIS)\", \"70\"]\n                                      ],\n                                      \"footer_cells\" : [\"Total Expenses\", \"23620\"]\n                                  },\n              \n                                  \"career_and_industry\" : \"The employment rate in Denmark has risen over the past few years, making it one of the highest in Europe in 2021. Similar to other developed countries, Denmark had an increase in the number of employed persons during the past ten years and was predicted to surpass 2.9 million in 2022. Some of the essential phrases that describe the Danish labour market include flexibility, security, flat hierarchical structures, and a team-oriented mindset. In general, the so-called Danish model, also known as the flexicurity model, combines social security and active labour market policies with high levels of employment mobility.\",\n              \n                                  \"image_1_url\" : \"denmark1.svg\",\n                                  \"image_2_url\" : \"denmark2.svg\",\n                                  \"image_3_url\" : \"denmark3.svg\",\n                                  \"image_4_url\" : \"denmark4.svg\"\n                              },\n              \n                \"Finland\" : \n                              {\n                                  \"header_content\" : \"A country with pristine natural beauty and landscapes, Finland is among Europe’s most modern and innovative countries. With an education system that is at par with global standards, it is also a popular choice of international students due to the academic reputation of Finnish Universities.\",\n              \n                                  \"why_content\" : \"Finnish education system adopts a multi-disciplinary approach of combining self-studies with problem solving and well-rounded learning experience. Study in universities if research is your prime focus or enroll in universities of applied sciences for programs with more professional approach. High-tech laboratories, well-stock libraries, high-level infrastructure and technology along with top quality teaching that is accessible to all – Finnish universities impart necessary transferable skills to their students to prepare them for the academia and industry. There are good scholarship opportunities for international students with each university or university of applied sciences (UAS) having their own scholarship system.\",\n              \n                                  \"key_points\" : [\n                                      \"7 universities among top 500 in the world (QS World Rankings 2024)\",\n                                      \"Post Study Work Visa up to 1 Year\",\n                                      \"Helsinki – among the most popular student cities\",\n                                      \"Finland hosts over 20,000 international students\",\n                                      \"13 universities and 22 universities of applied sciences (UAS) to choose from\",\n                                      \"500 English-taught bachelor\'s and master\'s degree programmes\",\n                                      \"Affordable Tuition Fees\",\n                                      \"Pathways to Permanent Residency\"\n                                  ],\n              \n                                  \"cost\" : {\n                                      \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in \"],\n                                      \"rows\" : [\n                                          [\"Tution fees for one-year(Indicative)*\", \"10000\"],\n                                          [\"Living and Accomodation\", \"10000\"],\n                                          [\"Airfare from India to Finland\", \"570\"],\n                                          [\"Visa Fees (Visa & SEVIS)\", \"350\"]\n                                      ],\n                                      \"footer_cells\" : [\"Total Expenses\", \"20920\"]\n                                  },\n              \n                                  \"career_and_industry\" : \"Finland has a highly industrialized economy with services being the largest sector followed by manufacturing and refining. Electronics, Machinery, Automobiles, Forest & Energy are some of the largest industries in Finland. Career prospects are bright in the areas of Software Engineering, Nursing, Early Childhood Teaching, Accounting, Medicine & Law. Finland is a member of The United Nations, The Council of Europe and the World Trade Organization. Finland is also a top performer in many metrics of performance such as education, economic competitiveness, quality of life and human development.\",\n              \n                                  \"image_1_url\" : \"finland1.svg\",\n                                  \"image_2_url\" : \"finland2.svg\",\n                                  \"image_3_url\" : \"finland3.svg\",\n                                  \"image_4_url\" : \"finland4.svg\"\n                              },\n              \n                \"Italy\" : \n                              {\n                                  \"header_content\" : \"Italy is widely known for being an education hub of Europe and is home to an impressive 40 universities which feature in the QS World University Rankings 2021. But there’s more to Italy than exceptional education - delicious food to beautiful museums and most importantly the career opportunities.\",\n              \n                                  \"why_content\" : \"\",\n              \n                                  \"key_points\" : [\n                                      \"Home to some of the oldest universities in the world\",\n                                      \"Cost of living and tuition fees in Italy is budget-friendly\",\n                                      \"Courses offered in the field of Architecture, Arts, Design and Fashion, Italy is very fluent in the language of Research and Science\",\n                                      \"Wide offer of courses in English language\",\n                                      \"Post study work visa of upto 1 year post completion of education\"\n                                  ],\n              \n                                  \"cost\" : {\n                                      \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in \"],\n                                      \"rows\" : [\n                                          [\"Tution fees for one-year(Indicative)*\", \"\"],\n                                          [\"Living and Accomodation\", \"\"],\n                                          [\"Airfare from India to \", \"\"],\n                                          [\"Visa Fees (Visa & SEVIS)\", \"\"]\n                                      ],\n                                      \"footer_cells\" : [\"Total Expenses\", \"\"]\n                                  },\n              \n                                  \"career_and_industry\" : \"\",\n              \n                                  \"image_1_url\" : \"italy1.png\",\n                                  \"image_2_url\" : \"italy2.png\",\n                                  \"image_3_url\" : \"italy3.png\",\n                                  \"image_4_url\" : \"italy4.png\"\n                              },\n              \n                \"Hungary\" : \n                              {\n                                  \"header_content\" : \"Hungarian higher education has been representing academic excellence for more than 650 years with its first university founded in 1367. Now, there are 65 higher education institutions in Hungary. Hungarian institutions offer more than 500 courses in English, German, French and other languages. The foreign language programmes are of a high standard and tuition fees are very favourable when compared to its competitors.\",\n              \n                                  \"why_content\" : \"\",\n              \n                                  \"key_points\" : [\n                                      \"Students can earn double degrees at many universities through joint degree programmes\",\n                                      \"Students can combine studies with professional practice by taking an Erasmus internship in Hungary\",\n                                      \"Globally accepted degrees\",\n                                      \"Many local and international companies offer internship positions to students\",\n                                      \"The tuition fee and living costs in Hungary are relatively affordable, compared to most other parts of Europe\",\n                                      \"Post study work visa of 9 months post completion of education\"\n                                  ],\n              \n                                  \"cost\" : {\n                                      \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in \"],\n                                      \"rows\" : [\n                                          [\"Tution fees for one-year(Indicative)*\", \"\"],\n                                          [\"Living and Accomodation\", \"\"],\n                                          [\"Airfare from India to \", \"\"],\n                                          [\"Visa Fees (Visa & SEVIS)\", \"\"]\n                                      ],\n                                      \"footer_cells\" : [\"Total Expenses\", \"\"]\n                                  },\n              \n                                  \"career_and_industry\" : \"\",\n              \n                                  \"image_1_url\" : \"hungary1.png\",\n                                  \"image_2_url\" : \"hungary2.png\",\n                                  \"image_3_url\" : \"hungary3.png\",\n                                  \"image_4_url\" : \"hungary4.png\"\n                              }\n                            },\n\n            \"image_1_url\" : \"europe-1.png\",\n            \"image_2_url\" : \"europe-2.png\",\n            \"home_image_url\" : \"europe-home.jpg\"\n        }', 'active');
INSERT INTO `region` (`region_id`, `region_name`, `shortcode`, `is_country`, `is_continent`, `logo`, `brief_document`, `status`) VALUES
(5, 'Asia', 'Asia', 0, 1, 'region-5.png', '{\n            \"header_content\" : \"Asian universities combine rich traditions with high-tech facilities and unique research opportunities.\",\n            \"multiple\" : true,\n            \"countries\":\n            {\n                \"Singapore\" : {\n                    \"header_content\" : \"Study in Singapore to experience one of the best education systems in the world, to earn a globally recognized qualification from high ranked institutions and to experience a multicultural society with a very high quality of life.\",\n\n                    \"why_content\" : \"A city of skyscrapers, Singapore is fast emerging as Asia’s leading international study destination and is attracting students from all parts of the world, thanks to its reputation for being a center of academic excellence, universities and institutions that are highly placed in all major global rankings and this country being the IT & Business hub of Asia. Singapore ranks high on other crucial parameters such as student satisfaction and safety and affordability. Singapore’s status of being an economic powerhouse with excellent job opportunities across a diverse range of sectors complements its education system of international repute and makes this city country one of the most sought after study destinations globally.\",\n\n                    \"key_points\" : [\n                        \"Ranked as the second-best country to live and work in, according to an HSBC ranking in 2019\",\n                        \"2 universities ranked among the top 20 in the world\",\n                        \"One of the financial capitals of the world\",\n                        \"Institutions affiliated with top international universities in the USA, the UK, Canada & Australia\",\n                        \"Transfer opportunities to parent campus\",\n                        \"Masters of 1 Year and Bachelors of 2 or 3 years\",\n                        \"Paid - Unpaid Internship opportunities for the students\",\n                        \"Lower tuition fee and living expenses with plenty of scholarships on offer\"\n                    ],\n\n                    \"cost\" : {\n                        \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in SGD\"],\n                        \"rows\" : [\n                            [\"Tution fees for one-year(Indicative)*\", \"20000\"],\n                            [\"Living and Accomodation\", \"10000\"],\n                            [\"Airfare from India to \", \"500\"],\n                            [\"Visa Fees\", \"90\"]\n                        ],\n                        \"footer_cells\" : [\"Total Expenses\", \"30590\"]\n                    },\n\n                    \"career_and_industry\" : \"Singapore’s economy has been ranked as the most open and most pro-business economy in the world. Top sectors driving Singapore’s economy include Information Technology, Pharmaceuticals, Biotechnology, Precision Engineering, Aerospace & Professional Services. A lot of multinational companies such as Twitter, Dyson, Tencent, LinkedIn & Facebook have established their regional headquarters and global RnD laboratories in Singapore. Singapore is a prominent business hub of Asia owing to its connectivity, robust economy and strong influence in the region. Singapore has also been ranked as the Asian city with highest quality of life by Mercer, world\'s leading human resource management consulting agency.\",\n\n                    \"image_1_url\" : \"singapore-1.jpg\",\n                    \"image_2_url\" : \"singapore-2.jpg\",\n                    \"image_3_url\" : \"singapore-3.jpg\",\n                    \"image_4_url\" : \"singapore-4.webp\"\n                },\n\n                \"Dubai\" : {\n                    \"header_content\" : \"Study in Dubai, a futuristic city that is home to over 60 world renowned university campuses and colleges and that offers plenty of higher education opportunities meeting your aspirations. Pursue a world class undergraduate or postgraduate degree from this destination and advance your career globally.\",\n\n                    \"why_content\" : \"Studying in Dubai comes with a dual benefit of accessing global campuses of universities of world repute and job opportunities of a booming economy at the same time. Institutions in Dubai have affiliations with international universities, offer a wide range of programs suiting your academic pursuits and have world class learning facilities. Dubai is among the fastest growing world economies and has an entrepreneurial ecosystem that creates hundreds of thousands of new jobs in diverse areas. Presence of renowned global universities and a robust economy makes studying in Dubai a very lucrative choice.\",\n\n                    \"key_points\" : [\n                        \"Dubai – a popular student city\",\n                        \"Institutions in Dubai are affiliated with top international universities in Australia and The UK\",\n                        \"Global tourism and entertainment hub\",\n                        \"A safe city and a modern design capital\",\n                        \"Excellent full time and part time job opportunities for international students\",\n                        \"Global knowledge hub\",\n                        \"Paid - Unpaid Internship opportunities for the students\",\n                        \"Affordable tuition fee and living expenses with plenty of scholarships\"\n                    ],\n\n                    \"cost\" : {\n                        \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in AED\"],\n                        \"rows\" : [\n                            [\"Tution fees for one-year(Indicative)*\", \"50000\"],\n                            [\"Living and Accomodation\", \"30000\"],\n                            [\"Airfare from India to \", \"1500\"],\n                            [\"Visa Fees\", \"7000\"]\n                        ],\n                        \"footer_cells\" : [\"Total Expenses\", \"88500\"]\n                    },\n\n                    \"career_and_industry\" : \"Second wealthiest emirate in the UAE, Dubai is known as the top business doorway for African and middle eastern countries. Top sector that drives growth of this economy is tourism though Dubai is fast developing an epicentre for service industries including Information Technology and Finance. Dubai Internet City and Dubai Media City are known for housing top IT firms and media organizations such as Microsoft, Oracle Corporation, IBM, HP, BBC, CNN and Sky News. Top jobs/sectors to look forward in Dubai include E-Commerce, Digital Marketing Specialists, Business Development & Sales, Education and Engineering & Technology.\",\n\n                    \"image_1_url\" : \"dubai-1.jpg\",\n                    \"image_2_url\" : \"dubai-2.jpg\",\n                    \"image_3_url\" : \"dubai-3.jpeg\",\n                    \"image_4_url\" : \"dubai-4.png\"\n                },\n\n                \"Malaysia\" : {\n                    \"header_content\" : \"Want to study in top international universities but have a low budget? Then, Malaysia is the best study destination for you. Known for its tag line “Truly Asia”, the country has a diverse culture and multicultural society. Cities with modern facilities and infrastructures along with celebrations and festivals all year round make the country famous among international students.\",\n\n                    \"why_content\" : \"Malaysia is known as the hub of international universities. The cost of living and food of the country is lower than other countries, which makes it an ideal place for international students. English is the widely spoken language in the country which makes it easier for international students to communicate. The country’s thriving industries provide promising employment opportunities for international students. The visa procedures for the country are simple\",\n\n                    \"key_points\" : [\n                        \"8 Malaysian universities in the 2023 QS World University ranking top 500\",\n                        \"Affordable living expenses and food costs\",\n                        \"Seamless immigration procedures\",\n                        \"IELTS waiver is possible\",\n                        \"Hub of international universities including universities of Australia, United Kingdom, Singapore and Canada.\",\n                        \"English is the widely spoken language\",\n                        \"City life with modern facilities and infrastructures\",\n                        \"Scholarships are available for international students\"\n                    ],\n\n                    \"cost\" : {\n                        \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in RM\"],\n                        \"rows\" : [\n                            [\"Tution fees for one-year(Indicative)*\", \"60000\"],\n                            [\"Living and Accomodation\", \"25500\"],\n                            [\"Airfare from India to \", \"467\"],\n                            [\"Visa Fees\", \"3500\"],\n                            [\"Application Fees\", \"5000\"]\n                        ],\n                        \"footer_cells\" : [\"Total Expenses\", \"94467\"]\n                    },\n\n                    \"career_and_industry\" : \"Apart from the tourism and hospitality industry, the country is also known for its innovative financial sector, palm oil exportation, manufacturing industry, automotive industry and sector of oil, gas and energy. Malaysia’s fully developed economy opens doors for a diverse range of employment and business opportunities including start-ups for international students. International students can work part-time for a maximum of 20 hours per week during semester breaks or holidays of more than 7 days. Most internship opportunities in Malaysia come with stipend.\",\n\n                    \"image_1_url\" : \"malaysia-1.jpg\",\n                    \"image_2_url\" : \"malaysia-2.webp\",\n                    \"image_3_url\" : \"malaysia-3.jpg\",\n                    \"image_4_url\" : \"malaysia-4.webp\"\n                },\n\n                \"Mauritius\" : \n                {\n                    \"header_content\" : \"Mauritius is a located in the Indian Ocean which is best known for its white beaches, reefs and fascinating forests. It is one of the best countries to pursue an education at an affordable price in South Asia. The country has developed one of the finest education systems that have led to students enrolling in universities from various parts of the world. It provides world-class and internationally recognised education followed by affordable living costs for international students.\",\n\n                    \"key_points\" : [\n                        \"Home to many foreign Universities\",\n                        \"International Students can work part time for 20 hours per week\",\n                        \"It has carved a reputation of being socially, economically and politically stable\",\n                        \"Plethora of opportunities for career-growth\"\n                    ],\n\n                    \"image_1_url\" : \"mauritius-1.jpg\",\n                    \"image_2_url\" : \"mauritius-2.jpg\",\n                    \"image_3_url\" : \"mauritius-3.png\",\n                    \"image_4_url\" : \"mauritius-4.png\"\n                },\n\n                \"Japan\" : \n                {\n                    \"header_content\" : \"Japan is renowned for its excellent education system and is one of the top-performing country in reading literacy, math and sciences. Excellent safety, accessibility, and high quality of life standards make Japan a top location for students. Studying abroad in Japan means that the students will further studies in a well-rounded education system, experience a unique new culture, and gain a more international perspective. Japan is a popular study abroad destination and offers many advantages for students. International students in Japan can engage with Japanese culture, cuisine, and language. Japan is widely considered a safe country for students, with efficient public transportation.\",\n\n                    \"key_points\" : [\n                        \"1st City GDP (USD 1.8 Trill.)\",\n                        \"76% of foreign companies’ HQs\",\n                        \"3rd Global power City Index 2017\",\n                        \"4th Global City Ranking 2017\",\n                        \"Tokyo is among the best student cities (QS 2019)\",\n                        \"Most extensive, dependable, and affordable transport system in the world\"\n                    ],\n\n                    \"image_1_url\" : \"japan-1.webp\",\n                    \"image_2_url\" : \"japan-2.jpg\",\n                    \"image_3_url\" : \"japan-3.png\",\n                    \"image_4_url\" : \"japan-4.png\"\n                },\n\n                \"Vietnam\" : \n                {\n                    \"header_content\" : \"Vietnam is known for its rigorous curriculum that is deemed competitive for students. Vietnam is the home to many world heritage sites recognized by UNESCO. Vietnam is known for its endless natural beauty and its famous attraction. Vietnam’s economy is growing steadily at near 7% which will make it fastest growing markets in the world. Vietnam offers a variety of programs while the student will study in a multi- cultural environment\",\n\n                    \"key_points\" : [\n                        \"Increasing economic growth creates strong demand in Manpower resources\",\n                        \"One of the safest countries and is among the 11 world countries those are free from conflict\",\n                        \"Cost of Living and Tuition fee is much affordable compared to study in Australia and UK\",\n                        \"Degrees are globally recognised\"\n                    ],\n\n                    \"image_1_url\" : \"vietnam-1.webp\",\n                    \"image_2_url\" : \"vietnam-2.jpg\",\n                    \"image_3_url\" : \"vietnam-3.png\",\n                    \"image_4_url\" : \"vietnam-4.png\"\n                },\n\n                \"China\" : \n                {\n                    \"header_content\" : \"The number of higher education institutions in China has doubled in the last decade, and there are almost 3,000 institutions now. 6 Chinese universities rank within the top 100 as per the QS World University Rankings 2021. Overall, 40 Chinese institutions received a ranking. China has also made numerous partnerships with renowned, reputed universities of the UK and the U.S.\",\n\n                    \"key_points\" : [\n                        \"6 of Chinese Universities are ranked in top 100 in the world (QS World Rankings 2023)\",\n                        \"Due to its growing economy over the past three decades numerous Fortune 500 companies are based in China\",\n                        \"500,000 international students studying at Chinese universities\",\n                        \"Tuition fees is almost 5 times lower than the UK or the US Universities\",\n                        \"Popular courses in field of Engineering, Computer Science, International Business, MBA, Medicine to Chinese Language, Calligraphy, and Martial Arts\"\n                    ],\n\n                    \"image_1_url\" : \"china-1.jpg\",\n                    \"image_2_url\" : \"china-2.jpg\",\n                    \"image_3_url\" : \"china-3.png\",\n                    \"image_4_url\" : \"china-4.png\"\n                },\n\n                \"South Korea\" : \n                {\n                    \"header_content\" : \"Study in South Korea to get the world-class education at the most affordable cost and experience the perfect blend of innovation and rich-traditional culture. The country is safe and student friendly. Apart from providing numerous scholarships, the country is offering a plethora of job opportunities to international students. International students can work unlimited hours during holidays to aid their studies.\",\n\n                    \"key_points\" : [\n                        \"Highly affordable tuition fees and living expenses.\",\n                        \"Ranked as one of the leading OECD countries for academic achievement and competitiveness.\",\n                        \"Stands high in the global index of cognitive skills and educational attainment rankings.\",\n                        \"You can work up to 20 hours per week and indefinite/unlimited hours during holidays.\",\n                        \"Known as the Hub of innovative and advanced technology.\",\n                        \"Learn Korean Language free or at negligible cost.\"\n                    ],\n\n                    \"image_1_url\" : \"south-korea-1.jpg\",\n                    \"image_2_url\" : \"south-korea2.webp\",\n                    \"image_3_url\" : \"south-korea-3.png\",\n                    \"image_4_url\" : \"south-korea-4.png\"\n                }\n            },\n\n            \"image_1_url\" : \"asia-1.webp\",\n            \"image_2_url\" : \"asia-2.jpg\",\n            \"image_3_url\" : \"asia-3.png\",\n            \"image_4_url\" : \"asia-4.png\",\n            \"home_image_url\" : \"asia-home.png\"\n        }', 'active'),
(6, 'Ireland', 'Ireland', 1, 0, 'region-6.png', '{\n            \"header_content\" : \"Set yourself on a path of a global career with one of the world’s most dynamic & advanced education systems. Foster your creativity & entrepreneurship in universities that are developing world class graduates to address challenges of today and the future.\",\n\n            \"why_content\" : \"Home to 9 of 10 global ICT companies, 8 of the 10 global pharmaceutical companies, a global financial services powerhouse and a centre of international banking excellence, Ireland is the European hub to over 1,000 leading multinational corporations across multiple sectors. Potential career opportunities in a host of global giants including Microsoft, Google, PayPal, Apple, Twitter, Microsoft, LinkedIn, Pfizer, GSK and Genzyme make studying in Ireland a very lucrative opportunity. High academic standards of Irish universities are enabling their graduates to make an impact on academia, research and the global business world.\",\n\n            \"key_points\" : [\n                \"Europe’s fastest growing economy\",\n                \"Ranked #10 Globally for High-Quality Scientific Research\",\n                \"Post Study Work Visa up to 2 Years\",\n                \"All Universities Globally Ranked among top 5%\",\n                \"Ranked as the 13th most peaceful place on Earth\",\n                \"Qualifications quality assured by Quality & Qualifications Ireland, an Irish State Agency\",\n                \"Among the top 20 education systems worldwide\",\n                \"Ireland is ranked 11th in the 2018 Global Innovation Index\"\n            ],\n\n            \"cost\" : {\n                \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in €\"],\n                \"rows\" : [\n                    [\"Tution fees for one-year (Indicative)*\", \"15000\"],\n                    [\"Living and Accomodation\", \"12000\"],\n                    [\"Airfare from India to Ireland (Indicative)\", \"700\"],\n                    [\"Visa Fees\", \"195\"]\n                ],\n                \"footer_cells\" : [\"Total Expenses\", \"27895\"]\n            },\n            \n            \"career_and_industry\" : \"Ireland has made huge strides in economic development in the last few decades and has improved its living conditions better than most of the countries in the world. Ireland has a highly-advanced ‘knowledge economy’ emphasizing on the sectors of agribusiness, life sciences and financial services & technology. This country ranks first for high-value foreign direct investment (FDI) flows and performs better than most countries measure of well-being such as jobs & earnings, health status, education & skills and work-life balance in the Better Life Index. IT Services, Financial Services, Renewable Energy, Business Services, Medical/Health & Pharmaceutical Industry are the top industries for employment opportunities.\",\n\"home_image_url\":\"ireland-home.jpg\",\n            \"image_1_url\" : \"ireland-1.png\",\n            \"image_2_url\" : \"ireland-2.png\",\n            \"image_3_url\" : \"ireland-3.png\",\n            \"image_4_url\" : \"ireland-4.png\"\n        }', 'active'),
(7, 'New Zealand', 'New Zealand', 1, 0, 'region-7.png', '{\n            \"header_content\" : \"New Zealand offers world class education system, qualifications that are valued globally, an unmatchable lifestyle and friendly & welcoming natives. This island country has abundant natural beauty, breathtaking landscapes and picturesque coastlines that make studying in New Zealand an adventurous experience.\",\n\n            \"why_content\" : \"Study in a high-quality education system closely monitored and regulated by the NZ government. Experience practical teaching style and hands-on learning to inculcate real-world skills that will open doors of global opportunities. Gain impeccable English language abilities to be effective in multicultural and challenging work environments. Stay ahead in the competition with NZ qualifications that are highly sought after in the international job market.\",\n\n            \"key_points\" : [\n                \"New Zealand universities are ranked in the top 3% in the world\",\n                \"Only country in the world to have all its universities in the global top 500\",\n                \"Over 20,000 international students from 160 countries\",\n                \"8 state-funded universities, 16 Institutes of Technology and Polytechnics (ITPs) & 550 Private Training Establishments (PTEs)\",\n                \"Post-study work visa up to three years and good permanent residency prospects\",\n                \"Ranked as the top English-speaking country at preparing students for the future (The Economist Intelligence Unit in 2019)\",\n                \"A member of the Lisbon Qualification Recognition Convention – NZ qualifications are recognised in over 50 countries\",\n                \"Lower tuition fee with plenty of scholarships on offer\"\n            ],\n\n            \"cost\" : {\n                \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in NZD\"],\n                \"rows\" : [\n                    [\"Tution fees for one-year(Indicative)*\", \"25000\"],\n                    [\"Living and Accomodation\", \"20000\"],\n                    [\"Airfare from India to \", \"2000\"],\n                    [\"Visa Fees\", \"430\"]\n                ],\n                \"footer_cells\" : [\"Total Expenses\", \"47430\"]\n            },\n\n            \"career_and_industry\" : \"New Zealand is one of the Asia–Pacific region’s most prosperous countries and has been experiencing a rapid economic growth over the past few decades. NZ has the 2nd freest & one of the most globalized economies that depends greatly on international trade. NZ’s economy is primarily driven by sectors of services, mining & manufacturing, forestry, agriculture & dairy, while IT is making big strides to gain a major share. Industries that have excellent employment prospects include Engineering, Business & Finance, Health & Social Services, and IT & Hospitality. Standard of living in NZ is relatively higher but is worth the opportunities and peaceful and high-quality life this country offers.\",\n\"home_image_url\":\"new-zealand-home.jpg\",\n            \"image_1_url\" : \"new-zealand-1.png\",\n            \"image_2_url\" : \"new-zealand-2.png\",\n            \"image_3_url\" : \"new-zealand-3.png\",\n            \"image_4_url\" : \"new-zealand-4.png\"\n        }', 'active'),
(8, 'Australia', 'Australia', 1, 0, 'region-8.png', '{\n            \"header_content\" : \"A network of world leading universities, outstanding learning & research facilities, inspiring lectures from brilliant instructors & unparalleled academic excellence, Australian education system offers them all with an exceptional student experience & qualifications that are valued world over.\",\n\n            \"why_content\" : \"Study in a country that has produced over 2.5 million global graduates and has set exceptional standards for global education. Pursue high-quality & globally recognized qualifications from world class institutions. Enhance your career prospects by gaining hands-on industry experience through placements and internships, make connections with global employers, and succeed in the global workforce. Feel welcomed & inspired in some of the most liveable cities that are rich with people from diverse nationalities and cultures from all over the world.\",\n\n            \"key_points\" : [\n                \"9 of World’s Top 100 Universities\",\n                \"Choose from over 22,000 Courses across 1,100 Institutions\",\n                \"5 out of 30 Best Student Cities in the world are in Australia (QS Best Student Cities 2024)\",\n                \"More than A$300 Million Invested in Scholarships for International Students\",\n                \"Australian Universities have Produced 15 Nobel Laureates\",\n                \"More than Half a Million International Students from 192 Countries\",\n                \"Post Study Work Visa up to 5 years*\",\n                \"Good Permanent Residency Prospects\"\n            ],\n\n            \"cost\" : {\n                \"header_cells\" : [\"Types of Expenses\", \"Annual Expenses in AUD\"],\n                \"rows\" : [\n                    [\"Tution fees for one-year(Indicative)*\", \"35000\"],\n                    [\"Living and Accomodation\", \"29710\"],\n                    [\"Airfare from India to Australia\", \"2000\"],\n                    [\"Visa Fees\", \"1600\"]\n                ],\n                \"footer_cells\" : [\"Total Expenses\", \"68310\"]\n            },\n\n            \"career_and_industry\" : \"Australia, the 12th-largest economy, is one of the wealthiest Asia–Pacific nations. After having enjoyed over two decades of economic expansion, Australia has become internationally competitive in financial and insurance services, technologies, and high-value-added manufactured goods. International students can look forward to high remuneration career prospects such as Medicine & Healthcare, Finance, IT, Mining & other Engineering Trades, Teaching & Social Work. Australian enjoy one of the highest standards of living in the world owing to a robust economy and a high employment rate with good quality of jobs.\",\n\"home_image_url\":\"australia-home.jpg\",\n            \"image_1_url\" : \"australia-1.png\",\n            \"image_2_url\" : \"australia-2.png\",\n            \"image_3_url\" : \"australia-3.png\",\n            \"image_4_url\" : \"australia-4.png\"\n        }', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `scholarship_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text DEFAULT '{}',
  `amount` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `brief_document` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_on` datetime DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `brief_document`, `created_on`, `last_updated_on`, `status`) VALUES
(1, 'Student Profile Analysis', '{             \"header_content\" : \"Our profile analysis sessions will immensely help you analyze and improve your profile and to know your oppurtunities.\",             \"offerings\" : [                 \"Personalized profile evaluation\",                 \"Academic and Career Alignment\",                 \"Profile Building and Skill Enhancement\"             ],             \"image_1_url\" : \"service-1-1.jpg\",             \"image_2_url\" : \"service-1-2.png\",             \"image_3_url\" : \"service-1-3.png\",             \"image_4_url\" : \"service-1-4.png\", \"home_page_icon\":\"person-badge-fill\"         }', '2024-11-12 22:28:15', NULL, 'active'),
(2, 'Career Counselling', '{             \"header_content\" : \"Our counselling sessions will immensely benefit you in making the best academic decision suiting your career choices.\",             \"offerings\" : [                 \"Career-oriented counselling\",                 \"Emphasis on futuristic courses and careers\",                 \"Interactive sessions with university delegates\"             ],             \"image_1_url\" : \"service-2-1.jpg\",             \"image_2_url\" : \"service-2-2.png\",             \"image_3_url\" : \"service-2-3.png\",             \"image_4_url\" : \"service-2-4.png\"  , \"home_page_icon\":\"briefcase\"       }', '2024-11-12 22:28:15', NULL, 'active'),
(3, 'Test Preparation', '{             \"header_content\" : \"Effortlessly reach your highest potential test score with our certified, adept and dedicated tutors who will efficiently prepare you for your desired tests.\",             \"offerings\" : [                 \"Interactive classrooms & free demo sessions\",                 \"Study material that’s simple yet highly effective\",                 \"Score oriented tutorials & mock tests\"             ],             \"image_1_url\" : \"service-3-1.jpg\",             \"image_2_url\" : \"service-3-2.png\",             \"image_3_url\" : \"service-3-3.png\",             \"image_4_url\" : \"service-3-4.png\"  , \"home_page_icon\":\"list-check\"       }', '2024-11-12 22:28:15', NULL, 'active'),
(4, 'Course/University Selection', '{             \"header_content\" : \"We help you choose the ideal course, university & country that perfectly match your career, academic and budget preferences.\",             \"offerings\" : [                 \"Make precise academic and career decisions\",                 \"University comparison – rankings, courses & scholarships\",                 \"Course options across 850+ universities in 33 countries\"             ],             \"image_1_url\" : \"service-4-1.jpg\",             \"image_2_url\" : \"service-4-2.png\",             \"image_3_url\" : \"service-4-3.png\",             \"image_4_url\" : \"service-4-4.png\" , \"home_page_icon\":\"building\"        , \"show_more_link\" : \"universities\", \"show_more_link_text\":\"Select University\"}', '2024-11-12 22:28:15', NULL, 'active'),
(5, 'Application & Admission Assitance', '{             \"header_content\" : \"Choose the right intake, apply timely and smartly in courses and universities that are your right fit and receive admits/offers in no time.\",             \"offerings\" : [                 \"Flawless applications - assured admits\",                 \"High quality SOPs, LORs and Resumes\",                 \"Real time application tracking & follow through with universities\"             ],             \"image_1_url\" : \"service-5-1.jpg\",             \"image_2_url\" : \"service-5-2.png\",             \"image_3_url\" : \"service-5-3.png\",             \"image_4_url\" : \"service-5-4.png\" , \"home_page_icon\":\"files\"        }', '2024-11-12 22:28:15', NULL, 'active'),
(6, 'Financial Aid & Scholarship', '{             \"header_content\" : \"Our global universities have plenty of scholarships on offer and we will help you identify and apply for the ones you deserve the most.\",             \"offerings\" : [                 \"Alerts on latest and high value scholarships\",                 \"Guidance on ‘how’ to apply for scholarships\",                 \"Assistance for scholarship essays\"             ],             \"image_1_url\" : \"service-6-1.jpg\",             \"image_2_url\" : \"service-6-2.png\",             \"image_3_url\" : \"service-6-3.png\",             \"image_4_url\" : \"service-6-4.png\" , \"home_page_icon\":\"mortarboard-fill\"        }', '2024-11-12 22:28:15', NULL, 'active'),
(7, 'Education Loan', '{             \"header_content\" : \"Availing an education loan to study in your dream university has never been easier!\",             \"offerings\" : [                 \"Study Loans through HDFC, Avanse, Auxilo and more\",                 \"Financial structuring to suit your university\",                 \"Hassle free documentation\"             ],             \"image_1_url\" : \"service-7-1.jpg\",             \"image_2_url\" : \"service-7-2.png\",             \"image_3_url\" : \"service-7-3.png\",             \"image_4_url\" : \"service-7-4.png\"  , \"home_page_icon\":\"piggy-bank\",       \"show_more_link\":\"view_loans\", \"show_more_link_text\":\"Know more\"}', '2024-11-12 22:28:15', NULL, 'active'),
(8, 'Visa Guidance', '{             \"header_content\" : \"Our skilled visa experts will help you prepare and present your visa documents to Embassies and High Commissions to ensure a successful visa outcomes in minimal time.\",             \"offerings\" : [                 \"Impeccable guidance on visa documentation\",                 \"Excellent visa success ratio across all countries\",                 \"Mock visa interviews\"             ],             \"image_1_url\" : \"service-8-1.jpg\",             \"image_2_url\" : \"service-8-2.png\",             \"image_3_url\" : \"service-8-3.png\",             \"image_4_url\" : \"service-8-4.png\"   , \"home_page_icon\":\"passport\"      }', '2024-11-12 22:28:15', NULL, 'active'),
(9, 'Pre-Departure Briefing', '{             \"header_content\" : \"Pre-departure orientation sessions are designed to help you navigate personal and cultural growth opportunities during your time abroad.\",             \"offerings\" : [                 \"You\'ll gain insights into local culture, Student life in your new country, Culture shock, Support and well-being\",                 \"Practical insights on Banking and foreign exchange, Working while studying and internship advice, A network of advice\"             ],             \"image_1_url\" : \"service-9-1.jpg\",             \"image_2_url\" : \"service-9-2.png\",             \"image_3_url\" : \"service-9-3.png\",             \"image_4_url\" : \"service-9-4.png\"    , \"home_page_icon\":\"luggage-fill\"     }', '2024-11-12 22:28:15', NULL, 'active'),
(10, 'Post-Arrival Assitance', '{             \"header_content\" : \"Post-Arrival assiatnce plays an important role in helping international students to have a successful study abroad experience\",             \"offerings\" : [                 \"booking an accommodation, Remittance process\",                 \"Remittance process, Education Loan\",                 \"Minimum premium, maximum cover\"             ],             \"image_1_url\" : \"service-10-1.jpg\",             \"image_2_url\" : \"service-10-2.png\",             \"image_3_url\" : \"service-10-3.png\",             \"image_4_url\" : \"service-10-4.png\"   , \"home_page_icon\":\"person-workspace\"      }', '2024-11-12 22:28:15', '2024-11-13 00:49:15', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `last_updated_on` datetime DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `testimonial_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `no_of_stars` varchar(30) NOT NULL,
  `review` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_on` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`testimonial_id`, `user_id`, `no_of_stars`, `review`, `created_on`, `last_updated_on`, `status`) VALUES
(5, '1', '5', 'With all of your questionaries, they provide excellent assistance for higher education, and the calibre of their work far exceeds expectations.', '2024-11-11 20:28:19', NULL, 'active'),
(6, '2', '5', 'MR betterlife consultancy is one of the best If you have a dream of going abroa. They helped​ me throughout the journey and thank you team for your endlessness help.', '2024-11-11 20:28:19', NULL, 'active'),
(7, '3', '4', 'When i decided to come UK I started searching for consultancies many of my friends recommended the MR Betterlife consultancy, they helped me a lot in selecting the universities and visa processing. After coming to the UK they helped me to get right accommodation hoping for the further help after my studies.', '2024-11-11 20:28:19', NULL, 'active'),
(8, '4', '5', 'MR Betterlife Consultancy provided exceptional service throughout my application journey. From shortlisting the universities to finalizing my admission, their support was unwavering. The team’s expertise and encouragement were crucial to my success in getting admitted to a prestigious university in USA.', '2024-11-11 20:28:19', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `university_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `university_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `additional_info` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brief_document` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_on` datetime DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`university_id`, `region_id`, `university_name`, `country`, `state`, `city`, `address`, `phone`, `alternate_phone`, `email`, `alternate_email`, `website`, `additional_info`, `logo`, `brief_document`, `created_on`, `last_updated_on`, `status`) VALUES
(1, 1, 'University of Bristol', '', '', '', 'Bristol England', '', '', '', NULL, 'www.bristol.ac.uk', '', '1.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(2, 1, 'University of Glasgow', '', '', '', 'Glasgow Scotland', '', '', '', NULL, 'www.gla.ac.uk', '', '2.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(3, 1, 'University of Southampton', '', '', '', 'Southampton England', '', '', '', NULL, 'https://www.southampton.ac.uk/', '', '3.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(4, 1, 'University of Birmingham', '', '', '', 'Birmingham England', '', '', '', NULL, 'www.birmingham.ac.uk', '', '4.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(5, 1, 'University of Leeds', '', '', '', 'Leeds England', '', '', '', NULL, 'www.leeds.ac.uk/', '', '5.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(6, 1, 'Durham University', '', '', '', 'Durham England', '', '', '', NULL, 'www.dur.ac.uk/', '', '6.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(7, 1, 'The University of Sheffield', '', '', '', 'Sheffield England', '', '', '', NULL, 'www.sheffield.ac.uk/', '', '7.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(8, 1, 'University of Nottingham', '', '', '', 'Nottingham England', '', '', '', NULL, 'www.nottingham.ac.uk/', '', '8.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(9, 1, 'Queen Mary University of London', '', '', '', 'London England', '', '', '', NULL, 'www.qmul.ac.uk', '', '9.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(10, 1, 'Newcastle University', '', '', '', 'Newcastle upon Tyne England', '', '', '', NULL, 'www.ncl.ac.uk', '', '10.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(11, 1, 'Lancaster University', '', '', '', 'Lancaster England', '', '', '', NULL, 'www.lancaster.ac.uk/', '', '11.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(12, 1, 'University of Bath', '', '', '', 'Bath England', '', '', '', NULL, 'https://www.bath.ac.uk/', '', '12.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(13, 1, 'University of Liverpool', '', '', '', 'Liverpool England', '', '', '', NULL, 'www.liv.ac.uk', '', '13.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(14, 1, 'The University of Exeter', '', '', '', 'Exeter England', '', '', '', NULL, 'www.exeter.ac.uk/', '', '14.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(15, 1, 'Cranfield University', '', '', '', 'Cranfield England', '', '', '', NULL, 'www.cranfield.ac.uk', '', '15.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(16, 1, 'University of York', '', '', '', 'York, England', '', '', '', NULL, 'www.york.ac.uk/', '', '16.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(17, 1, 'Cardiff University', '', '', '', 'Cardiff, Wales', '', '', '', NULL, 'https://www.cardiff.ac.uk/', '', '17.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(18, 1, 'Queen`s University Belfast', '', '', '', 'Belfast, Northern Ireland', '', '', '', NULL, 'www.qub.ac.uk', '', '18.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(19, 1, 'Loughborough University', '', '', '', 'Loughborough & London, England', '', '', '', NULL, 'https://www.lboro.ac.uk/', '', '19.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(20, 1, 'University of Aberdeen', '', '', '', 'Aberdeen, Scotland', '', '', '', NULL, 'www.abdn.ac.uk/', '', '20.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(21, 1, 'University of Sussex', '', '', '', 'Brighton, England', '', '', '', NULL, 'https://www.sussex.ac.uk/', '', '21.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(22, 1, 'Heriot Watt University', '', '', '', 'Edinburgh, Scotland', '', '', '', NULL, 'www.hw.ac.uk', '', '22.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(23, 1, 'University of Strathclyde', '', '', '', 'Glasgow, Scotland', '', '', '', NULL, 'www.strath.ac.uk', '', '23.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(24, 1, 'University of Surrey ', '', '', '', 'Guildford, England', '', '', '', NULL, 'www.surrey.ac.uk', '', '24.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(25, 1, 'University of Leicester', '', '', '', 'Leicester, England', '', '', '', NULL, 'www.le.ac.uk', '', '25.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(26, 1, 'Swansea University', '', '', '', 'Swansea, Wales', '', '', '', NULL, 'www.swansea.ac.uk', '', '26.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(27, 1, 'University of East Anglia', '', '', '', 'Norwich, England', '', '', '', NULL, 'www.uea.ac.uk/', '', '27.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(28, 1, 'Brunel University of London', '', '', '', 'London, England', '', '', '', NULL, 'www.brunel.ac.uk/', '', '28.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(29, 1, 'City, University of London', '', '', '', 'London, England', '', '', '', NULL, 'https://www.city.ac.uk/', '', '29.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(30, 1, 'Oxford Brookes University', '', '', '', 'Oxford, England', '', '', '', NULL, 'www.brookes.ac.uk', '', '30.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(31, 1, 'University of Dundee', '', '', '', 'Dundee, Scotland', '', '', '', NULL, 'www.dundee.ac.uk', '', '31.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(32, 1, 'Aston University', '', '', '', 'Birmingham, England', '', '', '', NULL, 'www.aston.ac.uk/', '', '32.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(33, 1, 'University of Stirling', '', '', '', 'Stirling, Scotland', '', '', '', NULL, 'www.stir.ac.uk', '', '33.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(34, 1, 'University of Essex', '', '', '', 'Colchester, England', '', '', '', NULL, 'www.essex.ac.uk/about/colchester/', '', '34.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(35, 1, 'Bangor University', '', '', '', 'Bangor, Wales', '', '', '', NULL, 'www.bangor.ac.uk', '', '35.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(36, 1, 'Royal Holloway, University of London', '', '', '', 'Egham, England', '', '', '', NULL, 'www.royalholloway.ac.uk/', '', '36.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(37, 1, 'The University of Huddersfield', '', '', '', 'Huddersfield, England', '', '', '', NULL, 'www.hud.ac.uk', '', '37.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(38, 1, 'SOAS University of London', '', '', '', 'London, England', '', '', '', NULL, 'https://www.soas.ac.uk/', '', '38.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(39, 1, 'University of Hull', '', '', '', ' Hull, England', '', '', '', NULL, 'https://www.hull.ac.uk/', '', '39.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(40, 1, 'University of Hull', '', '', '', ' London Campus, England', '', '', '', NULL, 'https://london.hull.ac.uk/', '', '40.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(41, 1, 'Coventry University', '', '', '', 'Coventry & London, England', '', '', '', NULL, 'www.coventry.ac.uk', '', '41.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(42, 1, 'University of Bradford', '', '', '', 'Bradford, England', '', '', '', NULL, 'www.bradford.ac.uk', '', '42.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(43, 1, 'Northumbria University', '', '', '', 'Newcastle upon Tyne & London, England', '', '', '', NULL, 'www.northumbria.ac.uk', '', '43.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(44, 1, 'Nottingham Trent University', '', '', '', ' Nottingham, England', '', '', '', NULL, 'www.ntu.ac.uk', '', '44.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(45, 1, 'Manchester Metropolitan University', '', '', '', 'Manchester, England', '', '', '', NULL, 'www2.mmu.ac.uk', '', '45.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(46, 1, 'Kingston University', '', '', '', 'Kingston, England', '', '', '', NULL, 'www.kingston.ac.uk', '', '46.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(47, 1, 'University of Portsmouth', '', '', '', 'Portsmouth & London, England', '', '', '', NULL, 'www.port.ac.uk', '', '47.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(48, 1, 'University of Plymouth', '', '', '', ' Plymouth, England', '', '', '', NULL, 'www.plymouth.ac.uk', '', '48.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(49, 1, 'Aberystwyth University', '', '', '', 'Aberystwyth, Wales', '', '', '', NULL, 'https://aber.ac.uk/en/', '', '49.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(50, 1, 'Goldsmiths, University of London', '', '', '', ' London, England', '', '', '', NULL, 'https://www.gold.ac.uk/', '', '50.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(51, 1, 'University of Greenwich', '', '', '', ' London, England', '', '', '', NULL, 'www.gre.ac.uk', '', '51.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(52, 1, 'De MontFort University', '', '', '', ' Leicester, England', '', '', '', NULL, 'www.dmu.ac.uk', '', '52.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(53, 1, 'Middlesex University', '', '', '', ' London, England', '', '', '', NULL, 'www.mdx.ac.uk', '', '53.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(54, 1, 'University of the West of England', '', '', '', 'Bristol, England', '', '', '', NULL, 'www.uwe.ac.uk/', '', '54.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(55, 1, 'Keele University', '', '', '', ' Keele, England', '', '', '', NULL, 'www.keele.ac.uk/', '', '55.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(56, 1, 'University of Brighton', '', '', '', ' Brighton, England', '', '', '', NULL, 'www.brighton.ac.uk/index.aspx', '', '56.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(57, 1, 'Edinburgh Napier University', '', '', '', ' Edinburgh, Scotland', '', '', '', NULL, 'www.napier.ac.uk', '', '57.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(58, 1, 'London South Bank University', '', '', '', ' London, England', '', '', '', NULL, 'www.lsbu.ac.uk', '', '58.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(59, 1, 'University of Hertfordshire', '', '', '', ' Hatfield, England', '', '', '', NULL, 'www.herts.ac.uk', '', '59.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(60, 1, 'University of Lincoln', '', '', '', ' Lincoln, England', '', '', '', NULL, 'https://www.lincoln.ac.uk/', '', '60.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(61, 1, 'University of East London', '', '', '', ' London, England', '', '', '', NULL, 'www.uel.ac.uk', '', '61.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(62, 1, 'University of Salford', '', '', '', ' Manchester, England', '', '', '', NULL, 'www.salford.ac.uk', '', '62.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(63, 1, 'Robert Gordon University', '', '', '', ' Aberdeen, Scotland', '', '', '', NULL, 'https://www.rgu.ac.uk/', '', '63.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(64, 1, 'University of Central Lancashire', '', '', '', ' Preston, England', '', '', '', NULL, 'www.uclan.ac.uk', '', '64.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(65, 1, 'London Metropolitan University', '', '', '', ' London, England', '', '', '', NULL, 'https://www.londonmet.ac.uk/', '', '65.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(66, 1, 'Birmingham City University', '', '', '', 'Birmingham, England', '', '', '', NULL, 'www.bcu.ac.uk', '', '66.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(67, 1, 'Sheffield Hallam University', '', '', '', ' Sheffield, England', '', '', '', NULL, 'www.shu.ac.uk', '', '67.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(68, 1, 'The University of Northampton', '', '', '', ' Northampton, England', '', '', '', NULL, 'www.northampton.ac.uk', '', '68.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(69, 1, 'Leeds Beckett University', '', '', '', ' Leeds, England', '', '', '', NULL, 'www.leedsbeckett.ac.uk', '', '69.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(70, 1, 'University of Derby', '', '', '', ' Derby, England', '', '', '', NULL, 'https://www.derby.ac.uk/', '', '70.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(71, 1, 'Canterbury Christ Church University', '', '', '', ' Canterbury, England', '', '', '', NULL, 'https://www.canterbury.ac.uk/', '', '71.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(72, 1, 'University of Wolverhampton', '', '', '', ' Wolverhampton, England', '', '', '', NULL, 'www.wlv.ac.uk', '', '72.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(73, 1, 'Anglia Ruskin University', '', '', '', ' Cambridge & Chelmsford, England (Except Punjab and Haryana)', '', '', '', NULL, 'www.anglia.ac.uk/', '', '73.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(74, 1, 'Teesside University ', '', '', '', ' Middlesbrough and London Campus', '', '', '', NULL, 'www.tees.ac.uk', '(Except Namakkal & Punjab)', '74.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(75, 1, 'University of the West of Scotland', '', '', '', 'Paisley, Scotland', '', '', '', NULL, 'www.uws.ac.uk', '', '75.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(76, 1, 'University of the West of Scotland', '', '', '', ' London Campus, England', '', '', '', NULL, 'https://www.uwslondon.ac.uk/', '', '76.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(77, 1, 'University of South Wales ', '', '', '', ' Cardiff, Wales', '', '', '', NULL, 'www.southwales.ac.uk', '(Except Punjab & Haryana)', '77.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(78, 1, 'University of Roehampton', '', '', '', ' London, England', '', '', '', NULL, 'www.roehampton.ac.uk', '', '78.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(79, 1, 'University of Staffordshire', '', '', '', 'Stoke-on-Trent, England', '', '', '', NULL, 'www.staffs.ac.uk', '', '79.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(80, 1, 'University of Sunderland', '', '', '', ' Sunderland & London, England', '', '', '', NULL, 'www.sunderland.ac.uk', '', '80.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(81, 1, 'University of Bedfordshire', '', '', '', ' Luton, England', '', '', '', NULL, 'www.beds.ac.uk', '', '81.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(82, 1, 'Cardiff Metropolitan University', '', '', '', 'Cardiff , Wales', '', '', '', NULL, 'www.cardiffmet.ac.uk', '', '82.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(83, 1, 'University of Chester, Chester', '', '', '', 'England', '', '', '', NULL, 'www.chester.ac.uk', '', '83.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(84, 1, 'University of Gloucestershire', '', '', '', ' Gloucester, England', '', '', '', NULL, 'www.glos.ac.uk/', '', '84.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(85, 1, 'University of West London', '', '', '', ' London, England', '', '', '', NULL, 'www.uwl.ac.uk/', '', '85.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(86, 1, 'York St John University', '', '', '', ' York, England', '', '', '', NULL, 'www.yorksj.ac.uk/', '', '86.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(87, 1, 'University of Bolton', '', '', '', 'Bolton, England', '', '', '', NULL, 'https://www.bolton.ac.uk/', '', '87.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(88, 1, 'Abertay University', '', '', '', ' Dundee, Scotland', '', '', '', NULL, 'https://www.abertay.ac.uk/', '', '88.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(89, 1, 'Liverpool Hope University', '', '', '', ' Liverpool, England', '', '', '', NULL, 'www.hope.ac.uk', '', '89.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(90, 1, 'University of Wales Trinity Saint David', '', '', '', ' London, Birmingham and Swansea Campus, England & Wales', '', '', '', NULL, 'https://www.uwtsd.ac.uk/', '', '90.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(91, 1, 'University of Chichester', '', '', '', 'Chichester, England', '', '', '', NULL, 'https://www.chi.ac.uk/', '', '91.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(92, 1, 'St. Mary’s University', '', '', '', ' Twickenham, England', '', '', '', NULL, 'https://www.stmarys.ac.uk/', '', '92.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(93, 1, 'Solent University', '', '', '', ' Southampton, England', '', '', '', NULL, 'www.qahighereducation.com/solent-university-pathway', '', '93.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(94, 1, 'Leeds Trinity University', '', '', '', ' Leeds, England', '', '', '', NULL, 'https://www.leedstrinity.ac.uk/', '', '94.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(95, 1, 'University for the Creative Arts', '', '', '', 'Farnham, England', '', '', '', NULL, 'www.uca.ac.uk', '', '95.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(96, 1, 'Bishop Grosseteste University', '', '', '', 'Lincoln, England', '', '', '', NULL, 'https://www.bgu.ac.uk/', '', '96.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(97, 1, 'BPP University (Except students from Andhra Pradesh', '', '', '', 'Gujarat, Haryana, Jammu, Maharashtra, Punjab, UP, Uttarakhand, Tamil Nadu & Telangana), London, England', '', '', '', NULL, 'www.bpp.com', '', '97.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(98, 1, 'University of Law', '', '', '', ' Guildford, England', '', '', '', NULL, 'https://www.law.ac.uk/', '', '98.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(99, 1, 'Ravensbourne University', '', '', '', 'London, England', '', '', '', NULL, 'https://www.ravensbourne.ac.uk/', '', '99.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(100, 1, 'Leeds Arts University', '', '', '', ' Leeds, England', '', '', '', NULL, 'https://www.leeds-art.ac.uk/', '', '100.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(101, 1, '(Study Group) Bellerbys College', '', '', '', 'Brighton, England', '', '', '', NULL, 'www.bellerbys.com', '', '101.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(102, 1, 'Norwich University of Arts', '', '', '', 'Norwich, England', '', '', '', NULL, 'https://www.nua.ac.uk/', '', '102.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(103, 1, 'Regent’s University London', '', '', '', ' London, England', '', '', '', NULL, 'www.regents.ac.uk', '', '103.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(104, 1, 'St George\'s University of London', '', '', '', 'London, England', '', '', '', NULL, 'https://www.sgul.ac.uk/', '', '104.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(105, 1, 'University Academy 92', '', '', '', ' Manchester, England', '', '', '', NULL, 'ua92.ac.uk/', '', '105.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(106, 1, 'University of Kent International College', '', '', '', 'Canterbury, England', '', '', '', NULL, 'https://www.kent.ac.uk/international-college', '', '106.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(107, 1, 'Glion Institute of Higher Education', '', '', '', ' London, England', '', '', '', NULL, 'https://www.glion.edu/', '', '107.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(108, 1, 'Regent College London, Middlesex', '', '', '', ' England', '', '', '', NULL, 'https://www.rcl.ac.uk/', '', '108.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(109, 1, 'University of Hull (UG & PG Transfer Programs)', '', '', '', ' Hull, England', '', '', '', NULL, 'www.oncampus.global/uk/campuses/oncampus-hull/welcome.htm', '', '109.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(110, 1, 'University College Birmingham', '', '', '', ' Birmingham, England (Except Punjab and Haryana)', '', '', '', NULL, 'www.ucb.ac.uk/', '', '110.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(111, 1, 'Bloomsbury Institute', '', '', '', ' London', '', '', '', NULL, 'https://www.bil.ac.uk/', '', '111.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(112, 1, 'Hult International Business School', '', '', '', 'London, England', '', '', '', NULL, 'www.hult.edu', '', '112.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(113, 1, 'Cambridge School of Visual & Performing Arts (CSVPA)', '', '', '', 'Cambridge, England', '', '', '', NULL, 'www.csvpa.com', '', '113.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(114, 1, 'Le - Cordon Bleu', '', '', '', ' London, England', '', '', '', NULL, 'www.lcblondon.com', '', '114.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(115, 1, 'Istituto Marangoni', '', '', '', ' London, England', '', '', '', NULL, 'www.istitutomarangoni.com/en/campuses/london', '', '115.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(116, 1, 'SP Jain London School of Management', '', '', '', ' London, England', '', '', '', NULL, 'https://www.spjain.ac.uk/', '', '116.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(117, 1, 'The Engineering & Design Institute of London (TEDI-London)', '', '', '', 'England', '', '', '', NULL, 'https://tedi-london.ac.uk/', '', '117.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(118, 1, 'University of Reading ', '', '', '', ' Reading, England', '', '', '', NULL, 'www.oncampus.global/uk/campuses/oncampus-reading/welcome.htm', '(UG & PG Transfer Programs)', '118.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(119, 1, 'Online Business School', '', '', '', ' Conventry, England', '', '', '', NULL, 'https://www.onlinebusinessschool.com/', '', '119.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(120, 1, 'Birkbeck, University of London ', '', '', '', ' London, England', '', '', '', NULL, 'www.oncampus.global/uk/campuses/oncampus-london/birkbeck/about.htm', '(UG & PG Transfer Programs)', '120.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(121, 1, 'QAHE- Ulster University', '', '', '', ' Birmingham, London & Manchester, England', '', '', '', NULL, 'www.qabs.ulster.ac.uk', '', '121.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(122, 1, '(Study Group) Liverpool John Moores University', '', '', '', ' Liverpool, England', '', '', '', NULL, 'www.ljmuisc.com', '', '122.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(123, 1, 'Royal Veterinary College, University of London ', '', '', '', ' London, England', '', '', '', NULL, 'www.oncampus.global/uk/campuses/oncampus-london/royal-veterinary-college/about.htm', '(UG Transfer Programs)', '123.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(124, 3, 'University of Alberta in Partnership with Kaplan', '', '', '', 'Edmonton, Alberta ', '', '', '', NULL, 'www.ualberta.ca/index.html', '(Only UG)', '124.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(125, 3, 'University of Waterloo', '', '', '', 'Waterloo, Ontario', '', '', '', NULL, 'uwaterloo.ca', '', '125.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(126, 3, 'Queen\'s University', '', '', '', 'Kingston, Ontario', '', '', '', NULL, 'www.queensu.ca/', ' (Only UG)', '126.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(127, 3, 'University of Calgary Continuing Education', '', '', '', ' Calgary, Alberta', '', '', '', NULL, 'https://conted.ucalgary.ca/', '', '127.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(128, 3, 'Dalhousie University', '', '', '', 'Halifax, Nova Scotia', '', '', '', NULL, 'www.dal.ca', '', '128.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(129, 3, 'University of Victoria in Partnership with Kaplan', '', '', '', ' Victoria, British Columbia', '', '', '', NULL, 'www.uvic.ca', '', '129.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(130, 3, 'York University, School of Continuing Education', '', '', '', 'Toronto, Ontario', '', '', '', NULL, 'www.yorku.ca', '', '130.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(131, 3, 'University of Guelph', '', '', '', ' Guelph and Ridgetown Campus, Ontario', '', '', '', NULL, 'www.uoguelph.ca', '', '131.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(132, 3, 'University of Windsor', '', '', '', ' Windsor, Ontario', '', '', '', NULL, 'www.uwindsor.ca', '', '132.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(133, 3, 'University of Manitoba', '', '', '', 'Winnipeg, Manitoba', '', '', '', NULL, 'www.umanitoba.ca', '', '133.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(134, 3, 'Memorial University of Newfoundland', '', '', '', ' St. John\'s, Newfoundland and Labrador ', '', '', '', NULL, 'www.mun.ca', '(Only PG)', '134.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(135, 3, 'Memorial University of Newfoundland', '', '', '', 'Grenfell Campus, Newfoundland and Labrador ', '', '', '', NULL, 'https://www.grenfell.mun.ca/Pages/home.aspx', '(Only UG)', '135.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(136, 3, 'University of New Brunswick', '', '', '', ' Fredericton, New Brunswick', '', '', '', NULL, 'www.unb.ca', '', '136.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(137, 3, 'University of New Brunswick', '', '', '', 'Saint John, New Brunswick', '', '', '', NULL, 'https://www.unb.ca/saintjohn/sjcollege/', '(Except Students from India)', '137.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(138, 3, 'Carleton University', '', '', '', ' Ottawa, Ontario', '', '', '', NULL, 'carleton.ca/', '', '138.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(139, 3, 'Toronto Metropolitan University', '', '', '', ' Toronto, Ontario', '', '', '', NULL, 'www.torontomu.ca/', '', '139.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(140, 3, 'University of Regina', '', '', '', ' Regina, Saskatchewan', '', '', '', NULL, 'www.uregina.ca', '', '140.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(141, 3, 'Brock University', '', '', '', 'St. Catharines, Ontario', '', '', '', NULL, 'www.brocku.ca', '', '141.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(142, 3, 'Wilfrid Laurier University', '', '', '', 'Waterloo, Ontario', '', '', '', NULL, 'www.wlu.ca', '', '142.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(143, 3, 'University of Lethbridge', '', '', '', ' Lethbridge, Alberta ', '', '', '', NULL, 'www.uleth.ca', '(Only UG)', '143.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(144, 3, 'Lakehead University', '', '', '', 'Thunder Bay, Ontario', '', '', '', NULL, 'www.lakeheadu.ca', '', '144.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(145, 3, 'Lakehead University through Georgian College', '', '', '', ' Barrie, Ontario', '', '', '', NULL, 'www.lakeheadgeorgian.ca', '', '145.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(146, 3, 'University of Winnipeg', '', '', '', 'Winnipeg, Manitoba', '', '', '', NULL, 'www.uwinnipeg.ca', '', '146.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(147, 3, 'University of Prince Edward Island', '', '', '', 'Charlottetown, Prince Edward Island', '', '', '', NULL, 'www.upei.ca', '', '147.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(148, 3, 'Acadia University', '', '', '', 'Wolfville, Nova Scotia ', '', '', '', NULL, 'www.acadiau.ca', '(Only UG)', '148.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(149, 3, 'St. Francis Xavier University', '', '', '', 'Antigonish, Nova Scotia', '', '', '', NULL, 'https://www.stfx.ca/', '', '149.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(150, 3, 'University of Northern British Columbia', '', '', '', ' Prince George, British Columbia', '', '', '', NULL, 'www.unbc.ca', '', '150.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(151, 3, 'Laurentian University', '', '', '', ' Sudbury, Ontario (Except students from South Asia)', '', '', '', NULL, 'https://laurentian.ca/', '', '151.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(152, 3, 'Thompson Rivers University', '', '', '', ' Kamloops, British Columbia', '', '', '', NULL, 'www.tru.ca', '', '152.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(153, 3, 'Ontario Tech University', '', '', '', 'Oshawa, Ontario', '', '', '', NULL, 'ontariotechu.ca/', '', '153.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(154, 3, 'Mount Saint Vincent University', '', '', '', 'Halifax, Nova Scotia', '', '', '', NULL, 'www.msvu.ca/en/home/default.aspx', '', '154.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(155, 3, 'Trent University, Peterborough', '', '', '', ' Ontario', '', '', '', NULL, 'www.trentu.ca', '', '155.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(156, 3, 'Trinity Western University', '', '', '', ' Langley, British Columbia', '', '', '', NULL, 'www.twu.ca', '', '156.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(157, 3, 'Royal Roads University, Victoria', '', '', '', 'British Columbia', '', '', '', NULL, 'www.royalroads.ca', '', '157.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(158, 3, 'Fairleigh Dickinson University', '', '', '', ' Vancouver, British Columbia', '', '', '', NULL, 'www.fdu.edu/vancouver', '', '158.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(159, 3, 'Simon Fraser University through Fraser International College', '', '', '', 'Burnaby, British Columbia ', '', '', '', NULL, 'www.sfu.ca', '(Only UG)', '159.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(160, 3, 'Wilfrid Laurier University through Wilfrid Laurier International College', '', '', '', ' Brantford, Ontario ', '', '', '', NULL, 'www.laurieric.ca/', '(Only UG)', '160.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(161, 3, 'University of Manitoba through International College of Manitoba, Winnipeg', '', '', '', 'Manitoba ', '', '', '', NULL, 'www.umanitoba.ca', '(Only UG)', '161.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(162, 3, 'University of Lethbridge through ULethbridge International College Calgary (UICC)', '', '', '', 'Calgary, Alberta ', '', '', '', NULL, 'https://www.uicc.ca/', '(Only UG)', '162.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(163, 3, 'Toronto Metropolitan University through Toronto Metropolitan International College', '', '', '', ' Toronto, Ontario ', '', '', '', NULL, 'www.ryersonuic.ca/', '(Only UG)', '163.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(164, 3, 'Vancouver Island University', '', '', '', ' Nanaimo, British Columbia', '', '', '', NULL, 'www.viu.ca', '', '164.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(165, 3, 'St. Thomas University', '', '', '', 'Fredericton, New Brunswick (Only UG)', '', '', '', NULL, 'www.stu.ca', '', '165.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(166, 3, 'University Canada West', '', '', '', ' Vancouver, British Columbia', '', '', '', NULL, 'www.ucanwest.ca', '', '166.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(167, 3, 'New York Institute of Technology', '', '', '', 'Vancouver, British Columbia', '', '', '', NULL, 'https://vancouver.nyit.edu/', '', '167.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(168, 3, 'Nipissing University', '', '', '', 'North Bay, Ontario', '', '', '', NULL, 'www.nipissingu.ca', '', '168.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(169, 3, 'Adler University, Vancouver', '', '', '', ' British Columbia', '', '', '', NULL, 'www.adler.edu/page/campuses/vancouver', '', '169.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(170, 3, 'King’s University College (University of Western Ontario)', '', '', '', ' London, Ontario', '', '', '', NULL, 'www.kings.uwo.ca', '', '170.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(171, 3, 'Cape Breton University', '', '', '', 'Sydney, Nova Scotia', '', '', '', NULL, 'www.cbu.ca', '', '171.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(172, 3, 'Capilano University', '', '', '', 'North Vancouver, British Columbia', '', '', '', NULL, 'www.capilanou.ca', '', '172.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(173, 3, 'Kwantlen Polytechnic University', '', '', '', 'Surrey, British Columbia', '', '', '', NULL, 'www.kpu.ca', '', '173.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(174, 3, 'University of the Fraser Valley', '', '', '', 'Abbotsford, British Columbia', '', '', '', NULL, 'www.ufv.ca', '', '174.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(175, 3, 'Mount Allison University', '', '', '', ' Sackville, New Brunswick', '', '', '', NULL, 'www.mta.ca', '', '175.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(176, 3, 'MacEwan University', '', '', '', 'Edmonton, Alberta (Only UG)', '', '', '', NULL, 'www.macewan.ca', '', '176.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(177, 3, 'University of Niagara Falls', '', '', '', 'Niagara, Ontario', '', '', '', NULL, 'https://unfc.com/', '', '177.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(178, 3, 'Crandall University', '', '', '', ' Moncton and Sussex, New Brunswick', '', '', '', NULL, 'https://www.crandallu.ca/', '', '178.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(179, 3, 'City University in Canada', '', '', '', ' Calgary and Edmonton, Alberta ', '', '', '', NULL, 'https://www.cityuniversity.ca/', '(Master of Education in Leadership program only)', '179.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(180, 3, 'Providence University College', '', '', '', 'Winnipeg, Manitoba ', '', '', '', NULL, 'https://www.prov.ca/', '(Master of Management program only)', '180.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(181, 3, 'Niagara University', '', '', '', 'Vaughan, Ontario ', '', '', '', NULL, 'https://niagarau.ca/', '(Only PG)', '181.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(182, 3, 'International Business University', '', '', '', ' Toronto, Ontario ', '', '', '', NULL, 'https://ibu.ca/', '(Except students from South Asia and Africa)', '182.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(183, 3, 'Algoma University', '', '', '', 'Sault Ste. Marie, Ontario ', '', '', '', NULL, 'https://algomau.ca/', '(Except students from South Asia)', '183.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(184, 3, 'Seneca Polytechnic', '', '', '', 'Toronto, Ontario', '', '', '', NULL, 'www.senecac.on.ca', '', '184.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(185, 3, 'Humber Polytechnic', '', '', '', 'Toronto, Ontario', '', '', '', NULL, 'https://www.humber.ca/', '', '185.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(186, 3, 'George Brown College', '', '', '', 'Toronto, Ontario', '', '', '', NULL, 'www.georgebrown.ca', '', '186.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(187, 3, 'Sheridan College', '', '', '', 'Oakville, Ontario', '', '', '', NULL, 'www.sheridancollege.ca', '', '187.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(188, 3, 'Bow Valley College', '', '', '', 'Calgary, Alberta', '', '', '', NULL, 'bowvalleycollege.ca/', '', '188.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(189, 3, 'St. Clair College of Applied Arts & Technology', '', '', '', 'Windsor, Ontario', '', '', '', NULL, 'https://www.stclaircollege.ca/', '', '189.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(190, 3, 'Douglas College', '', '', '', ' New Westminster, British Columbia ', '', '', '', NULL, 'www.douglascollege.ca', '(Except students from Punjab, Haryana and Chandigarh)', '190.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(191, 3, 'Southern Alberta Institute of Technology', '', '', '', 'Calgary, Alberta', '', '', '', NULL, 'www.sait.ca/', '', '191.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(192, 3, 'Northern Alberta Institute of Technology (NAIT), Edmonton', '', '', '', 'Alberta', '', '', '', NULL, 'www.nait.ca', '', '192.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(193, 3, 'Niagara College', '', '', '', ' Welland, Ontario', '', '', '', NULL, 'www.niagaracollege.ca', '', '193.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(194, 3, 'Fanshawe College', '', '', '', ' London, Ontario', '', '', '', NULL, 'www.fanshawec.ca', '', '194.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(195, 3, 'Durham College', '', '', '', 'Oshawa, Ontario', '', '', '', NULL, 'www.durhamcollege.ca', '', '195.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(196, 3, 'Fleming College', '', '', '', ' Peterborough, Ontario', '', '', '', NULL, 'flemingcollege.ca/', '', '196.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(197, 3, 'North Island College', '', '', '', ' Vancouver Island, British Columbia', '', '', '', NULL, 'www.nic.bc.ca', '', '197.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(198, 3, 'Georgian College', '', '', '', 'Barrie, Ontario', '', '', '', NULL, 'www.georgianc.on.ca', '', '198.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(199, 3, 'Langara College, Vancouver', '', '', '', 'British Columbia ', '', '', '', NULL, 'https://langara.ca/', '(Except students from Punjab and Haryana)', '199.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(200, 3, 'Lakeland College', '', '', '', ' Lloydminster and Vermilion, Alberta', '', '', '', NULL, 'www.lakelandcollege.ca', '', '200.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(201, 3, 'Cambrian College, Sudbury', '', '', '', ' Ontario', '', '', '', NULL, 'www.cambriancollege.ca', '', '201.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(202, 3, 'Manitoba Institute of Trades and Technology', '', '', '', ' Winnipeg, Manitoba', '', '', '', NULL, 'www.mitt.ca', '', '202.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(203, 3, 'Conestoga College', '', '', '', ' Kitchener, Ontario', '', '', '', NULL, 'www.conestogac.on.ca', '', '203.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(204, 3, 'College of New Caledonia', '', '', '', 'Prince George, British Columbia', '', '', '', NULL, 'www.cnc.bc.ca', '', '204.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(205, 3, 'Saskatchewan Polytechnic', '', '', '', 'Saskatoon, Saskatchewan', '', '', '', NULL, 'www.saskpolytech.ca', '', '205.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(206, 3, 'LaSalle College', '', '', '', ' Montreal and Vancouver', '', '', '', NULL, 'www.lasallecollegevancouver.com', '', '206.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(207, 3, 'College of the Rockies', '', '', '', ' Cranbrook, British Columbia', '', '', '', NULL, 'www.cotr.bc.ca', '', '207.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(208, 3, 'Northern Lights College', '', '', '', 'Dawson Creek, British Columbia', '', '', '', NULL, 'www.nlc.bc.ca', '', '208.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(209, 3, 'Northern College', '', '', '', 'Timmins, Ontario', '', '', '', NULL, 'www.northernc.on.ca', '', '209.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(210, 3, 'Booth University College', '', '', '', 'Winnipeg, Manitoba', '', '', '', NULL, 'https://boothuc.ca/', '', '210.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(211, 3, 'St. Lawrence College', '', '', '', 'Kingston, Ontario', '', '', '', NULL, 'www.stlawrencecollege.ca', '', '211.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(212, 3, 'Lambton College', '', '', '', 'Sarnia and Ottawa, Ontario', '', '', '', NULL, 'www.lambtoncollege.ca', '', '212.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(213, 3, 'Selkirk College', '', '', '', 'Castlegar, British Columbia', '', '', '', NULL, 'www.selkirk.ca', '', '213.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(214, 3, 'Assiniboine College', '', '', '', 'Brandon, Winnipeg and Dauphin Campus, Manitoba', '', '', '', NULL, 'www.assiniboine.net', '', '214.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(215, 3, 'Keyano College', '', '', '', 'Fort McMurray, Alberta', '', '', '', NULL, 'https://www.keyano.ca/en/index.aspx', '', '215.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(216, 3, 'Canadore College', '', '', '', 'North Bay, Ontario ', '', '', '', NULL, 'www.canadorecollege.ca', '(Except students from Punjab and Haryana)', '216.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(217, 3, 'Acsenda School of Management', '', '', '', 'Vancouver, British Columbia', '', '', '', NULL, 'www.acsenda.com', '', '217.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(218, 3, 'Le Cordon Bleu', '', '', '', 'Ottawa, Ontario', '', '', '', NULL, 'www.lcbottawa.com', '', '218.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(219, 3, 'Alexander College', '', '', '', 'Vancouver, British Columbia', '', '', '', NULL, 'www.alexandercollege.ca', '', '219.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(220, 3, 'Vancouver Film School', '', '', '', 'Vancouver, British Columbia', '', '', '', NULL, 'www.vfs.edu', '', '220.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(221, 3, 'Vancouver Community College', '', '', '', 'Vancouver, British Columbia', '', '', '', NULL, 'www.vcc.ca', '', '221.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(222, 3, 'British Columbia Institute of Technology', '', '', '', 'Burnaby, British Columbia', '', '', '', NULL, 'www.bcit.ca', '', '222.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(223, 3, 'Medicine Hat College', '', '', '', 'Medicine Hat, Alberta', '', '', '', NULL, 'www.mhc.ab.ca', '', '223.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(224, 3, 'NorQuest College', '', '', '', 'Edmonton, Alberta', '', '', '', NULL, 'www.norquest.ca', '', '224.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(225, 3, 'Coquitlam College', '', '', '', 'Coquitlam, British Columbia', '', '', '', NULL, 'www.coquitlam.ca', '', '225.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(226, 3, 'Olds College, Olds', '', '', '', 'Alberta', '', '', '', NULL, 'https://www.oldscollege.ca/', '', '226.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(227, 3, 'Confederation College', '', '', '', 'Thunder Bay, Ontario', '', '', '', NULL, 'https://www.confederationcollege.ca/', '', '227.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(228, 3, 'Justice Institute of British Columbia', '', '', '', ' New Westminster, British Columbia', '', '', '', NULL, 'https://www.jibc.ca/', '', '228.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(229, 3, 'Great Plains College', '', '', '', 'Swift Current, Saskatchewan', '', '', '', NULL, 'https://www.greatplainscollege.ca/', '', '229.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(230, 3, 'North West College', '', '', '', 'North Battleford, Saskatchewan', '', '', '', NULL, 'https://www.northwestcollege.ca/', '', '230.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(231, 3, 'Suncrest College', '', '', '', 'Yorkton, Saskatchewan', '', '', '', NULL, 'https://parklandcollege.sk.ca/', '', '231.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(232, 3, 'Vancouver Premier College', '', '', '', 'Vancouver, British Columbia', '', '', '', NULL, 'https://vpcollege.com/', '', '232.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(233, 3, 'Oxford International College Halifax', '', '', '', 'Halifax, Nova Scotia', '', '', '', NULL, 'https://oicolleges.com/halifax/', '(CCA Program only)', '233.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(234, 3, 'Oxford International College Vancouver', '', '', '', 'Vancouver, British Columbia', '', '', '', NULL, 'https://oicolleges.com/vancouver/', '', '234.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(235, 6, 'Trinity College Dublin', '', '', '', 'Dublin', '', '', '', NULL, 'www.tcd.ie', '', '235.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(236, 6, 'University College Dublin', '', '', '', 'Dublin', '', '', '', NULL, 'www.ucd.ie', '', '236.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(237, 6, 'University of Galway', '', '', '', 'Galway', '', '', '', NULL, 'www.nuigalway.ie', '', '237.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(238, 6, 'University College Cork', '', '', '', 'Cork', '', '', '', NULL, 'www.ucc.ie', '', '238.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(239, 6, 'Dublin City University', '', '', '', 'Dublin', '', '', '', NULL, 'www.dcu.ie', '', '239.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(240, 6, 'University of Limerick', '', '', '', 'Limerick', '', '', '', NULL, 'www.ul.ie', '', '240.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(241, 6, 'Maynooth University', '', '', '', 'Maynooth', '', '', '', NULL, 'www.maynoothuniversity.ie', '', '241.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(242, 6, 'Technological University Dublin', '', '', '', ' Dublin', '', '', '', NULL, 'www.tudublin.ie', '', '242.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(243, 6, 'Munster Technological University', '', '', '', '', '', '', '', NULL, 'https://www.mtu.ie/', 'Cork and Kerry Campus', '243.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(244, 6, 'South East Technological University ', '', '', '', '', '', '', '', NULL, 'https://www.tuse.ie/', '(Waterford and Carlow Campus)', '244.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(245, 6, 'Atlantic Technological University ', '', '', '', '', '', '', '', NULL, 'https://www.atu.ie/', '(Galway and Letterkenny Campus)', '245.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(246, 6, 'Dundalk Institute of Technology', '', '', '', ' Dundalk', '', '', '', NULL, 'www.dkit.ie', '', '246.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(247, 6, 'Technological University of the Shannon: Midlands Midwest', '', '', '', ' Shannon ', '', '', '', NULL, 'https://tus.ie/', '(Limerick and Athlone Campus)', '247.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(248, 6, 'National College of Ireland', '', '', '', ' Dublin', '', '', '', NULL, 'www.ncirl.ie', '', '248.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(249, 6, 'Dublin Business School', '', '', '', ' Dublin', '', '', '', NULL, 'www.dbs.ie', '', '249.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(250, 6, 'Griffith College', '', '', '', ' Dublin, Cork and Limerick (Campus in 3 cities)', '', '', '', NULL, 'www.griffith.ie', '', '250.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(251, 6, 'Shannon College of Hotel Management', '', '', '', ' A college of NUI Galway, Galway', '', '', '', NULL, 'www.shannoncollege.com', '', '251.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(252, 6, 'Dublin International Foundation College', '', '', '', 'Dublin', '', '', '', NULL, 'https://www.difc.ie/', '', '252.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(253, 6, 'American College Dublin', '', '', '', 'Dublin', '', '', '', NULL, 'https://iamu.edu/', '', '253.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(254, 6, 'UniHaven College', '', '', '', 'Maynooth', '', '', '', NULL, 'https://www.oncampus.global/europe/campuses/oncampus-ireland/unihaven-college/about-unihaven-college.htm', '(On Campus)', '254.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(255, 6, 'IBAT College Dublin', '', '', '', 'Dublin', '', '', '', NULL, 'https://www.ibat.ie/', '', '255.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(256, 6, 'Independent College', '', '', '', 'Dublin', '', '', '', NULL, 'https://independentcollege.ie/', '', '256.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(257, 6, 'CCT College Dublin', '', '', '', 'Dublin', '', '', '', NULL, 'https://www.cct.ie/', '', '257.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(258, 7, 'University of Auckland', '', '', '', 'Auckland', '', '', '', NULL, 'https://www.auckland.ac.nz/en.html', '', '258.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(259, 7, 'University of Otago', '', '', '', 'Dunedin', '', '', '', NULL, 'https://www.otago.ac.nz/', '', '259.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(260, 7, 'Massey University', '', '', '', ' Palmerston North', '', '', '', NULL, 'www.massey.ac.nz/', '', '260.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(261, 7, 'Victoria University of Wellington', '', '', '', 'Wellington', '', '', '', NULL, 'www.victoria.ac.nz', '', '261.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(262, 7, 'University of Waikato', '', '', '', 'Hamilton', '', '', '', NULL, 'www.waikato.ac.nz', '', '262.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(263, 7, 'University of Canterbury', '', '', '', 'Christchurch', '', '', '', NULL, 'www.canterbury.ac.nz', '', '263.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(264, 7, 'Lincoln University', '', '', '', 'Lincoln', '', '', '', NULL, 'www.lincoln.ac.nz', '', '264.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(265, 7, 'Auckland University of Technology', '', '', '', ' Auckland', '', '', '', NULL, 'www.aut.ac.nz', '', '265.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(266, 7, 'Unitec Institute of Technology', '', '', '', 'Auckland', '', '', '', NULL, 'www.unitec.ac.nz', '', '266.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(267, 7, 'Otago Polytechnic', '', '', '', 'Dunedin & Auckland', '', '', '', NULL, 'www.otagopolytechnic.ac.nz', '', '267.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(268, 7, 'Manukau Institute of Technology - Te Pūkenga', '', '', '', 'Auckland', '', '', '', NULL, 'www.manukau.ac.nz', '', '268.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(269, 7, 'Ara Institute of Canterbury', '', '', '', 'Christchurch', '', '', '', NULL, 'www.ara.ac.nz', '', '269.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(270, 7, 'Eastern Institute of Technology', '', '', '', 'Napier', '', '', '', NULL, 'www.eit.ac.nz', '', '270.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(271, 7, 'Waikato Institute of Technology (Wintec)', '', '', '', 'Hamilton', '', '', '', NULL, 'https://www.wintec.ac.nz/', '', '271.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(272, 7, 'Nelson Marlborough Institute of Technology (NMIT)', '', '', '', ' Nelson & Blenheim', '', '', '', NULL, 'www.nmit.ac.nz', '', '272.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(273, 7, 'Whitireia New Zealand', '', '', '', 'Porirua', '', '', '', NULL, 'www.whitireia.ac.nz', '', '273.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(274, 7, 'Southern Institute of Technology', '', '', '', 'Invercargill', '', '', '', NULL, 'www.sit.ac.nz', '', '274.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(275, 7, 'Wellington Institute of Technology (WelTec)', '', '', '', 'Wellington', '', '', '', NULL, 'www.weltec.ac.nz', '', '275.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(276, 7, 'Western Institute of Technology at Taranaki (WITT)', '', '', '', ' New Plymouth', '', '', '', NULL, 'www.witt.ac.nz', '', '276.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(277, 7, 'North Tec', '', '', '', 'Whangarei', '', '', '', NULL, 'www.northtec.ac.nz', '', '277.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(278, 7, 'The Universal College of Learning (UCOL)', '', '', '', 'almerston North', '', '', '', NULL, 'https://www.ucol.ac.nz/', '', '278.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(279, 7, 'Toi Ohomai Institute of Technology', '', '', '', 'Rotorua & Tauranga', '', '', '', NULL, 'https://www.toiohomai.ac.nz/', '', '279.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(280, 7, 'New Zealand Skills and Education Group', '', '', '', 'Auckland', '', '', '', NULL, 'https://www.nzseg.com/', '', '280.png', NULL, '2024-11-18 14:48:08', NULL, 'active');
INSERT INTO `university` (`university_id`, `region_id`, `university_name`, `country`, `state`, `city`, `address`, `phone`, `alternate_phone`, `email`, `alternate_email`, `website`, `additional_info`, `logo`, `brief_document`, `created_on`, `last_updated_on`, `status`) VALUES
(281, 7, 'Pacific International Hotel Management School', '', '', '', 'New Plymouth', '', '', '', NULL, 'www.pihms.ac.nz', '', '281.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(282, 7, 'New Zealand Tertiary College (NZTC)', '', '', '', 'Auckland', '', '', '', NULL, 'https://www.nztertiarycollege.ac.nz/', '', '282.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(283, 7, 'Future Skills Academy', '', '', '', 'Auckland', '', '', '', NULL, 'https://www.futureskills.co.nz', '', '283.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(284, 7, 'UC International College', '', '', '', 'Christchurch', '', '', '', NULL, 'www.ucic.ac.nz', '', '284.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(285, 7, 'Taylors College', '', '', '', 'Auckland', '', '', '', NULL, 'www.taylorscollege.edu.au', '', '285.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(286, 7, 'University of Waikato College', '', '', '', 'Hamilton', '', '', '', NULL, 'www.waikato.ac.nz', '', '286.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(287, 7, 'Whitecliffe College of Arts and Design', '', '', '', 'Auckland & Christchurch', '', '', '', NULL, 'www.whitecliffe.ac.nz', '', '287.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(288, 7, 'Whitecliffe College of Fashion and Sustainability', '', '', '', 'Auckland & Wellington', '', '', '', NULL, 'https://www.whitecliffe.ac.nz/fashion', '', '288.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(289, 7, 'Whitecliffe College of Technology & Innovation', '', '', '', 'Auckland, Wellington & Christchurch', '', '', '', NULL, 'https://www.whitecliffe.ac.nz/technology', '', '289.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(290, 7, 'Le Cordon Bleu', '', '', '', 'Wellington', '', '', '', NULL, 'www.cordonbleu.edu/new-zealand/welcome-to-new-zealand/en', '', '290.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(291, 7, 'New Zealand Airline Academy', '', '', '', 'Oamaru', '', '', '', NULL, 'www.nzaal.co.nz', '', '291.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(292, 7, 'AcademyEX Education', '', '', '', 'Auckland', '', '', '', NULL, 'https://academyex.com/', '', '292.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(293, 7, 'New Zealand Management Academies (NZMA)', '', '', '', 'Auckland', '', '', '', NULL, 'https://www.nzma.ac.nz/', '', '293.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(294, 8, 'The University of New South Wales', '', '', '', ' Sydney ', '', '', '', NULL, 'www.unsw.edu.au', '(CRICOS Code 00098G)', '294.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(295, 8, 'Monash University', '', '', '', 'Melbourne ', '', '', '', NULL, 'www.monash.edu', '(CRICOS Code 00008C)', '295.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(296, 8, 'The University of Queensland', '', '', '', 'Brisbane )', '', '', '', NULL, 'www.uq.edu.au/', '(CRICOS Code 00025B', '296.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(297, 8, 'University of Western Australia', '', '', '', 'Perth ', '', '', '', NULL, 'https://www.uwa.edu.au/', '(CRICOS Code: 00126G)', '297.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(298, 8, 'The University of Adelaide', '', '', '', ' Adelaide ', '', '', '', NULL, 'www.adelaide.edu.au', '(CRICOS Code 00123M)', '298.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(299, 8, 'University of Technology Sydney', '', '', '', ' Sydney ', '', '', '', NULL, 'international.uts.edu.au', '(CRICOS Provider No. 00099F, TEQSA: PRV12060)', '299.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(300, 8, 'RMIT University', '', '', '', ' Melbourne ', '', '', '', NULL, 'www.rmit.edu.au', '(CRICOS Code 00122A)', '300.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(301, 8, 'Macquarie University', '', '', '', 'Sydney ', '', '', '', NULL, 'www.mq.edu.au', '(CRICOS Code 00002J)', '301.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(302, 8, 'University of Wollongong', '', '', '', ' Wollongong ', '', '', '', NULL, 'https://www.uow.edu.au/', '(CRICOS Code 00102E)', '302.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(303, 8, 'The University of Newcastle', '', '', '', ' Newcastle ', '', '', '', NULL, 'www.newcastle.edu.au', '(CRICOS Code 00109J)', '303.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(304, 8, 'University of Wollongong', '', '', '', ' GIFT City Campus ', '', '', '', NULL, 'https://www.uow.edu.au/india/', '(CRICOS Code 00102E)', '304.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(305, 8, 'Deakin University', '', '', '', ' Melbourne, Geelong & Warrnambool Campus ', '', '', '', NULL, 'www.deakin.edu.au', '(CRICOS Code 00113B)', '305.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(306, 8, 'Deakin University', '', '', '', ' GIFT City Campus ', '', '', '', NULL, 'https://www.deakin.edu.au/gift-city-campus-india', '(CRICOS Code 00113B)', '306.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(307, 8, 'Queensland University of Technology', '', '', '', 'Brisbane ', '', '', '', NULL, 'www.qut.edu.au', '(CRICOS Code 00213J)', '307.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(308, 8, 'La Trobe University', '', '', '', 'Melbourne & Sydney ', '', '', '', NULL, 'www.latrobe.edu.au/', '(CRICOS Codes 00115M)', '308.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(309, 8, 'Griffith University', '', '', '', 'Gold Coast & Brisbane ', '', '', '', NULL, 'www.griffith.edu.au', '(CRICOS Code 00233E)', '309.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(310, 8, 'Swinburne University of Technology', '', '', '', 'Melbourne ', '', '', '', NULL, 'www.swinburne.edu.au', '(CRICOS Code 00111D)', '310.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(311, 8, 'Swinburne University of Technology', '', '', '', 'Sydney Campus ', '', '', '', NULL, 'https://www.swinburne.edu.au/sydney/', '(CRICOS Code 00111D)', '311.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(312, 8, 'University of Tasmania', '', '', '', 'Hobart, Launceston, Sydney ', '', '', '', NULL, 'www.utas.edu.au', '(CRICOS Code 00586B)', '312.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(313, 8, 'University of Tasmania', '', '', '', ' Melbourne ', '', '', '', NULL, 'https://www.utas.edu.au/community-and-partners/partner/educational/melbourne', '(CRICOS Code 00586B)', '313.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(314, 8, 'Flinders University', '', '', '', 'Adelaide ', '', '', '', NULL, 'www.flinders.edu.au', '(CRICOS Code 00114A)', '314.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(315, 8, 'University of South Australia', '', '', '', 'Adelaide ', '', '', '', NULL, 'www.unisa.edu.au', '(CRICOS Code 00121B)', '315.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(316, 8, 'Western Sydney University', '', '', '', 'Sydney City Campus ', '', '', '', NULL, 'www.westernsydney.edu.au', '(CRICOS Code 00917K)', '316.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(317, 8, 'Western Sydney University', '', '', '', '', '', '', '', NULL, 'https://www.westernsydney.edu.au/future/our-campuses/melbourne-campus', '', '317.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(318, 8, 'University of Canberra', '', '', '', ' Sydney Hills ', '', '', '', NULL, 'https://eca.edu.au/', '(CRICOS Code 00212K)', '318.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(319, 8, 'James Cook University', '', '', '', 'Townsville, Cairns & Brisbane 011(CRICOS Code: 07J)', '', '', '', NULL, 'www.jcu.edu.au/', '', '319.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(320, 8, 'CQUniversity Australia', '', '', '', 'Sydney, Melbourne, Brisbane & Perth ', '', '', '', NULL, 'www.cqu.edu.au', '(CRICOS Code 00219C)', '320.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(321, 8, 'Charles Darwin University', '', '', '', ' Darwin ', '', '', '', NULL, 'https://www.cdu.edu.au/', '(CRICOS Code 00300K)', '321.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(322, 8, 'Victoria University', '', '', '', 'Brisbane Campus ', '', '', '', NULL, 'https://www.vu.edu.au/', '(CRICOS Code 02475D)', '322.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(323, 8, 'Victoria University', '', '', '', ' Sydney Campus ', '', '', '', NULL, 'https://eca.edu.au/', '(CRICOS Code 02475D)', '323.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(324, 8, 'Charles Sturt University', '', '', '', ' Wagga Wagga ', '', '', '', NULL, 'www.csu.edu.au', '(CRICOS Code 00005F)', '324.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(325, 8, 'Charles Sturt University', '', '', '', 'Sydney & Melbourne ', '', '', '', NULL, 'www.csu.edu.au', '(CRICOS Code 00005F)', '325.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(326, 8, 'University of the Sunshine Coast', '', '', '', 'Adelaide ', '', '', '', NULL, 'https://www.usc.edu.au/', '(CRICOS Code 01595D)', '326.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(327, 8, 'The University of Notre Dame Australia', '', '', '', 'Fremantle ', '', '', '', NULL, 'https://www.notredame.edu.au/', '(CRICOS Code 01032F)', '327.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(328, 8, 'TasTAFE GETI', '', '', '', 'Hobart, ', '', '', '', NULL, 'https://study.tas.gov.au/', '(CRICOS Code 03041M)', '328.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(329, 8, 'S P Jain School of Global Management', '', '', '', 'Sydney Campus ', '', '', '', NULL, 'https://www.spjain.org/global-campus/sydney', '(CRICOS Code 03335G)', '329.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(330, 8, 'UNSW College', '', '', '', 'Sydney (CRICOS Code 00098G)', '', '', '', NULL, 'www.unswglobal.unsw.edu.au/', '', '330.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(331, 8, 'The University of Adelaide College', '', '', '', '', '', '', '', NULL, 'college.adelaide.edu.au', '(CRICOS Code 00123M)', '331.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(332, 8, 'UTS College', '', '', '', 'Sydney', '', '', '', NULL, 'utscollege.edu.au/', '(CRICOS Codes UTS College 00859D, UTS 00099F)', '332.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(333, 8, 'Charles Darwin University International College ', '', '', '', '', '', '', '', NULL, 'www.cdu.edu.au/international/charles-darwin-university-international-college', '(CRICOS Code 00300K)', '333.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(334, 8, 'Engineering Institute of Technology', '', '', '', 'Perth, Melbourne and Brisbane ', '', '', '', NULL, 'www.eit.edu.au', '(CRICOS Code 03567C)', '334.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(335, 8, 'ECA College of Health Sciences', '', '', '', ' Brisbane & Sydney ', '', '', '', NULL, 'https://eca.edu.au/', '(CRICOS Code 03932J)', '335.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(336, 8, 'Asia Pacific International College', '', '', '', 'Sydney & Melbourne ', '', '', '', NULL, 'https://eca.edu.au/', '(CRICOS Code 03048D)', '336.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(337, 8, 'Higher Education Leadership Institute', '', '', '', 'Melbourne', '', '', '', NULL, 'https://eca.edu.au/', '(CRICOS Code 03845H)', '337.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(338, 8, 'Le Cordon Bleu', '', '', '', 'Adelaide, Sydney, Melbourne & Perth ', '', '', '', NULL, 'www.cordonbleu.edu/australia/home/en', '(CRICOS Code 02380M)', '338.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(339, 8, 'Kaplan Business School', '', '', '', 'Sydney', '', '', '', NULL, 'https://www.kbs.edu.au/', '(CRICOS Code 02426B)(Only PG)', '339.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(340, 8, 'International College of Management', '', '', '', ' Sydney', '', '', '', NULL, 'www.icms.edu.au', '(CRICOS Code 01484M)', '340.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(341, 8, 'Academy of Interactive Technology', '', '', '', 'Sydney', '', '', '', NULL, 'https://ait.edu.au/', '215(CRICOS Code: 05J)', '341.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(342, 8, 'Excelsia College', '', '', '', 'Sydney ', '', '', '', NULL, 'https://excelsia.edu.au/', '(CRICOS Code 02664K)', '342.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(343, 8, 'Ironwood Institute Adelaide', '', '', '', 'Adelaide ', '', '', '', NULL, 'https://ironwood.edu.au/', '(CRICOS Code: 03039E)', '343.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(344, 8, 'The Hotel School', '', '', '', 'Sydney, Melbourne, Brisbane & Hayman Island ', '', '', '', NULL, 'https://hotelschool.scu.edu.au/', '(CRICOS Code 01241G)', '344.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(345, 8, 'Australian College of Applied Professions', '', '', '', 'Sydney ', '', '', '', NULL, 'www.acap.edu.au/', '(CRICOS Code 01328A)', '345.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(346, 8, 'The University of Newcastle College of International Education', '', '', '', 'Newcastle nte(CRICOS 00109J)', '', '', '', NULL, 'irnationalcollege.newcastle.edu.au/contact.html', '', '346.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(347, 8, 'Curtin College', '', '', '', 'Perth ', '', '', '', NULL, 'www.curtincollege.edu.au', '(CRICOS Code 02042G)', '347.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(348, 8, 'Deakin College', '', '', '', 'Melbourne ', '', '', '', NULL, 'www.deakincollege.edu.au', '(CRICOS Code 01590J)', '348.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(349, 8, 'South Australia Institute of Business & Technology', '', '', '', 'Adelaide ', '', '', '', NULL, 'www.saibt.sa.edu.au', '(CRICOS Code 02193C)', '349.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(350, 8, 'Griffith College', '', '', '', ' Gold Coast & Brisbane ', '', '', '', NULL, 'www.griffith.edu.au/college', '(CRICOS Code 01737F)', '350.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(351, 8, 'La Trobe College', '', '', '', 'Melbourne ', '', '', '', NULL, 'www.latrobecollegeaustralia.edu.au', '(CRICOS Code 03312D)', '351.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(352, 8, 'Sydney Institute of Business & Technology', '', '', '', 'Sydney ', '', '', '', NULL, 'www.sibt.nsw.edu.au', '(CRICOS code 01576G)', '352.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(353, 8, 'Edith Cowan College ', '', '', '', '', '', '', '', NULL, 'www.edithcowancollege.edu.au', '(CRICOS Code 01312J)', '353.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(354, 8, 'Eynesbury College', '', '', '', 'Adelaide ', '', '', '', NULL, 'www.eynesbury.navitas.com', '(CRICOS Code 00561M)', '354.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(355, 8, 'University of Canberra College', '', '', '', 'Canberra ', '', '', '', NULL, 'www.canberra.edu.au/uc-college', '(CRICOS Code 00212K)', '355.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(356, 8, 'Russo Business School', '', '', '', 'Brisbane 344(CRICOS Code – 01F)', '', '', '', NULL, 'www.russo.qld.edu.au/', '', '356.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(357, 8, 'LaSalle College', '', '', '', 'Melbourne ', '', '', '', NULL, 'www.lcimelbourne.edu.au/', '(CRICOS Code 02201G)', '357.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(358, 8, 'Sarina Russo Institute', '', '', '', 'Brisbane ', '', '', '', NULL, 'www.sri.edu.au', '(CRICOS Code 00607B)', '358.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(359, 8, 'Analytics Institute of Australia', '', '', '', 'Melbourne ', '', '', '', NULL, 'https://analyticsinstitute.edu.au/', '(CRICOS Code 04059D)', '359.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(360, 8, 'Kent Institute Australia', '', '', '', 'Sydney ', '', '', '', NULL, 'https://kent.edu.au/', '(CRICOS Code - 00161E)', '360.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(361, 2, 'University of Connecticut', '', '', '', ' Storrs Connecticut ', '', '', '', NULL, 'uconn.edu/', '(Public Ivy) (OnlyUG)', '361.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(362, 2, 'Johns Hopkins Unlversity', '', '', '', ' BaltImore Maryland ', '', '', '', NULL, 'httpx://wwwjhuedu/', '(School of Engineering - Only PG)', '362.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(363, 2, 'Arlzona State Unlversity', '', '', '', ' Phoenix Arizona', '', '', '', NULL, 'www.nuLedu', '', '363.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(364, 2, 'University of Massachusetts Amherst', '', '', '', ' Amherst Massachusetts ', '', '', '', NULL, 'httpx://wwwmcas.adu/', '(Masters Programe)', '364.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(365, 2, 'University of Callfomia', '', '', '', ' Riverside Callfornia ', '', '', '', NULL, 'business.ucr.edu/graduate', '(Graduate Business Programs & College of Engineering and UCR Extension)', '365.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(366, 2, 'Virginia Tech Language and Culture Institute', '', '', '', ' Blacksburg VirgInla ', '', '', '', NULL, 'wwwldl.t.edu', '(UG and PG Pathways)', '366.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(367, 2, 'University of South Florida', '', '', '', ' Tampa Florida', '', '', '', NULL, 'wwwunt.adu', ' (Only UG)', '367.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(368, 2, 'University of Artzona', '', '', '', ' Tucson Arizona', '', '', '', NULL, 'www.araona.edu', '', '368.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(369, 2, 'Drexel University', '', '', '', ' Fhiladelphin Pennsylvania ', '', '', '', NULL, 'www.drwowLecu', '(College of EngIneering UG Gateways and IEP)', '369.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(370, 2, 'University of Delaware', '', '', '', ' Newark Delaware ', '', '', '', NULL, 'www.udeledu', '(Only UG)', '370.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(371, 2, 'Miaml University', '', '', '', ' Oxford Ohlo ', '', '', '', NULL, 'httpx://mlamlohuedal', '(Public Ivy)', '371.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(372, 2, 'University of Vermont', '', '', '', ' Burlington Vermont ', '', '', '', NULL, 'httpx://wwwarw.edu/', '(Only UG)', '372.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(373, 2, 'University of Wisconsin-Madison', '', '', '', ' Madison Wsconsin', '', '', '', NULL, 'https://precollege.wisc.edu/international/', ' (Pre College)', '373.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(374, 2, 'Lehigh Unlversity', '', '', '', ' Bethlehem Fennsylvanla ', '', '', '', NULL, 'https://www2.lehigh.edu/', '(Only PG)', '374.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(375, 2, 'Unlversity of Oregon', '', '', '', ' Bugene Oregon', '', '', '', NULL, 'https://uoregon.edu/', '', '375.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(376, 2, 'George Mason University', '', '', '', ' Falrfax County VirgInla', '', '', '', NULL, 'httpx:/wwwgruadu!', '', '376.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(377, 2, 'The University of Oklahama', '', '', '', ' Norman Oklahoma', '', '', '', NULL, 'https://www.ou.edu/', '', '377.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(378, 2, 'Colorado State University', '', '', '', ' Fort Collins Colorado', '', '', '', NULL, 'www.coloutate.edu', '', '378.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(379, 2, 'Oregon State University', '', '', '', ' Corvallls Oregon', '', '', '', NULL, 'https://oregonstate.edu/', '', '379.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(380, 2, 'University of Ilinols at Chicaga', '', '', '', ' Chicago Illinols ', '', '', '', NULL, 'www.ulc.adu', '(Only UG)', '380.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(381, 2, 'The Unlversity of Alabama', '', '', '', ' Tuscaloasa Alabama', '', '', '', NULL, 'www.ua.ecky', '', '381.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(382, 2, 'Claremont Graduate University', '', '', '', ' Claremont Callfornka', '', '', '', NULL, 'www.cguedul', '', '382.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(383, 2, 'Auburn Unlversity', '', '', '', ' Auburn Alnbama', '', '', '', NULL, 'www.maburruedu', '', '383.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(384, 2, 'University of Utah', '', '', '', ' Salt Lake Clty Utah ', '', '', '', NULL, 'wwwutrhedu', '(Only UG)', '384.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(385, 2, 'University of Clncinnatl', '', '', '', ' Clncinnati Ohlo', '', '', '', NULL, 'www.uc.adu', '', '385.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(386, 2, 'Ohlo Unlversity', '', '', '', 'Athens, Ohlo', '', '', '', NULL, 'httpa:/wwwahlo.eclu/', '(Only UG)', '386.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(387, 2, 'University of South Carolina', '', '', '', 'Columbla, South Carolina', '', '', '', NULL, 'www.ac.edu', '', '387.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(388, 2, 'University of the Pacific', '', '', '', 'Stockton, Callfornlia', '', '', '', NULL, 'www.pacihc.edu', '', '388.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(389, 2, 'University of Kansas', '', '', '', ' Lawrence, Kansas ', '', '', '', NULL, 'www.ku.edu', '(Only UG)', '389.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(390, 2, 'University of Tulsa', '', '', '', 'Tulsa, Oklahoma', '', '', '', NULL, 'https://utulsa.edu/', '', '390.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(391, 2, 'Montclalr State Unlversity', '', '', '', 'Montclalr, New Jersey', '', '', '', NULL, 'httpa:/wwwmantclal.ecu/', '', '391.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(392, 2, 'University of Maryland', '', '', '', 'BaltImore County, Maryland', '', '', '', NULL, 'hittp:/urbc.adul', '', '392.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(393, 2, 'Univeraity of Tennessee at Chattanooga', '', '', '', 'Chattanooga, Tennescee', '', '', '', NULL, 'hittpa:/wwwtr.wdul', '', '393.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(394, 2, 'University at Albany', '', '', '', 'The State Unlversity of New York at Albany ', '', '', '', NULL, 'https://www.albany.edu/', '(SUNY Albany)', '394.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(395, 2, 'University of Dayton', '', '', '', 'Dayton, Ohlo', '', '', '', NULL, 'www.adayton.edu', '', '395.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(396, 2, 'University of Colorado Denver', '', '', '', 'Denver, Colorado', '', '', '', NULL, 'www.ucderwwradu', '', '396.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(397, 2, 'Southern Illinols University', '', '', '', 'Carbondale, Ilinols', '', '', '', NULL, 'http:/akuedul', '', '397.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(398, 2, 'University of Colorada', '', '', '', 'Calorado Springs, Colarado', '', '', '', NULL, 'www.uccudu', '', '398.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(399, 2, 'State University of New York at Geneseo (SUNY Genesea)', '', '', '', 'Geneseo, New York', '', '', '', NULL, 'www.prwawodu', '', '399.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(400, 2, 'SUNY Polytechnic Institute ', '', '', '', 'Utica, New York', '', '', '', NULL, 'https://sunypoly.edu/', '(SUNY Poly)', '400.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(401, 2, 'The State Unlversity of New York at New Paltz', '', '', '', '', '', '', '', NULL, 'https://www.newpaltz.edu/', '(SUNY New Paltz)', '401.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(402, 2, 'State University of New York at Fredonia ', '', '', '', 'Fredonla, New York', '', '', '', NULL, 'www.fredonia.edu/', '(SUNY Fredonla)', '402.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(403, 2, 'State Unlversity of New York at Plattsburgh ', '', '', '', ' Plattsburgh, New York', '', '', '', NULL, 'www.plattaburgh.adu', '(SUNY Plattsburgh)', '403.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(404, 2, 'State Unlversity of New York College at Old Westbury', '', '', '', 'Old Westbury, New York', '', '', '', NULL, 'https://www.oldwestbury.edu/', '(SUNY Old Westbury)', '404.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(405, 2, 'State Unlversity of New York at Oswego', '', '', '', ' Oswego, New York', '', '', '', NULL, 'https://ww1.oswego.edu/', '(SUNY Oswego)', '405.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(406, 2, 'Queens College, Clty Unversity of New York', '', '', '', 'New York', '', '', '', NULL, 'www.qc.cuny.edu', '', '406.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(407, 2, 'Cullnary Institute of America', '', '', '', 'New York, Callfornia, and Texas Campus ', '', '', '', NULL, 'http:/wwwclachetadu/', '(Only UG)', '407.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(408, 2, 'Loulslana State University', '', '', '', 'Baton Rouge, Loulslana ', '', '', '', NULL, 'wwwluLedu', '(Only UG)', '408.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(409, 2, 'Worcester Polytechnic Institute', '', '', '', ' Worcester, Masoachusetts', '', '', '', NULL, 'https://www.wpi.edu/', '', '409.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(410, 2, 'Washingto State University - Pullman', '', '', '', 'Tri Citles, Everett, Vancouver, and Spokane Campus', '', '', '', NULL, 'www.wauadu', '', '410.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(411, 2, 'University of Nebraska-Lincoln', '', '', '', ' Lincoln Nebraska ', '', '', '', NULL, 'www.unl.edu', '(Only UG)', '411.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(412, 2, 'University of Alabama at Birmingham', '', '', '', ' Birmingham Alabama', '', '', '', NULL, 'www.uab.edu', '', '412.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(413, 2, 'Virginia Commonwealth University', '', '', '', ' Richmond Virginia', '', '', '', NULL, 'https://www.vcu.edu/', '', '413.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(414, 2, 'Saint Louis University', '', '', '', ' St. Louis Missouri', '', '', '', NULL, 'www.slu.edu', '', '414.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(415, 2, 'Missouri University of Science and Technology', '', '', '', ' Rolla Missouri', '', '', '', NULL, 'www.mst.edu', '', '415.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(416, 2, 'University of Massachusetts Lowell', '', '', '', ' Lowell Massachusetts', '', '', '', NULL, 'www.uml.edu', '', '416.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(417, 2, 'Massachusetts College of Pharmacy and Health Sciences', '', '', '', ' Boston Massachusetts (MCPHS University)', '', '', '', NULL, 'www.mcphs.edu', '', '417.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(418, 2, 'University of Massachusetts', '', '', '', ' Boston Massachusetts ', '', '', '', NULL, 'www.umb.edu', '(UG PG Pathway and Direct Entry)', '418.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(419, 2, 'University of Massachusetts', '', '', '', ' Dartmouth Massachusetts', '', '', '', NULL, 'www.umassd.edu', '', '419.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(420, 2, 'Suffolk University', '', '', '', ' Boston Massachusetts', '', '', '', NULL, 'www.suffolk.edu', '', '420.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(421, 2, 'University of New Hampshire', '', '', '', ' Durham New Hampshire', '', '', '', NULL, 'www.unh.edu', '', '421.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(422, 2, 'Adelphi University', '', '', '', ' New York- Garden City and Manhattan Campus', '', '', '', NULL, 'www.adelphi.edu', '', '422.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(423, 2, 'University of Idaho', '', '', '', ' Mosco Idaho', '', '', '', NULL, 'www.uidaho.edu', '', '423.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(424, 2, 'San Jose State University', '', '', '', ' San Jose California', '', '', '', NULL, 'https://www.sjsu.edu/', '', '424.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(425, 2, 'San Francisco State University', '', '', '', ' San Francisco California', '', '', '', NULL, 'www.sfsu.edu/', '', '425.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(426, 2, 'California State University', '', '', '', ' Los Angeles California', '', '', '', NULL, 'https://www.calstatela.edu/', '', '426.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(427, 2, 'California State University', '', '', '', ' Northridge California', '', '', '', NULL, 'go.csun.edu/international', '', '427.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(428, 2, 'California State University', '', '', '', ' Fresno California', '', '', '', NULL, 'www.fresnostate.edu/', '', '428.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(429, 2, 'California State University', '', '', '', ' East Bay California', '', '', '', NULL, 'www.csueastbay.edu/', '', '429.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(430, 2, 'California State University', '', '', '', ' Channel Islands California', '', '', '', NULL, 'www.csuci.edu/', '', '430.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(431, 2, 'California State University', '', '', '', ' Sacramento California', '', '', '', NULL, 'https://www.csus.edu/', '', '431.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(432, 2, 'California State University', '', '', '', ' Bakersfield California', '', '', '', NULL, 'https://www.csub.edu/', '', '432.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(433, 2, 'California State University', '', '', '', ' Dominguez Hills California', '', '', '', NULL, 'www.csudh.edu/', '', '433.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(434, 2, 'California State University', '', '', '', ' Stanislaus California', '', '', '', NULL, 'https://www.csustan.edu/', '', '434.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(435, 2, 'California State University', '', '', '', ' San Bernardino California', '', '', '', NULL, 'https://www.csusb.edu/', '', '435.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(436, 2, 'Sonoma State University', '', '', '', ' Rohnert Park California', '', '', '', NULL, 'www.sonoma.edu/', '', '436.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(437, 2, 'California State Polytechnic University', '', '', '', ' Pomona ', '', '', '', NULL, 'www.cpp.edu/index.shtml', '(College of the Extended University)', '437.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(438, 2, 'University of California', '', '', '', ' Irvine California ', '', '', '', NULL, 'https://ce.uci.edu/', '(Division of Continuing Education)', '438.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(439, 2, 'University of California', '', '', '', ' Berkeley Extension California', '', '', '', NULL, 'https://extension.berkeley.edu/', '', '439.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(440, 2, 'University of California', '', '', '', ' Santa Cruz Silicon Valley Extension (Professional Education)', '', '', '', NULL, 'https://www.ucsc.edu/', '', '440.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(441, 2, 'Seattle University', '', '', '', ' Seattle Washington', '', '', '', NULL, 'www.seattleu.edu/', '', '441.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(442, 2, 'University of Central Florida', '', '', '', ' Orlando Florida ', '', '', '', NULL, 'https://www.ucf.edu/', '(Only PG)', '442.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(443, 2, 'New Jersey Institute of Technology', '', '', '', ' Newark New Jersey', '', '', '', NULL, 'www.njit.edu', '', '443.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(444, 2, 'Rochester Institute of Technology', '', '', '', ' Rochester New York', '', '', '', NULL, 'https://www.rit.edu/', '', '444.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(445, 2, 'Fairleigh Dickinson University', '', '', '', ' Teaneck New Jersey', '', '', '', NULL, 'www.fdu.edu/', '', '445.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(446, 2, 'Portland State University', '', '', '', ' Portland, Oregon ', '', '', '', NULL, 'https://www.pdx.edu/', '(Only UG)', '446.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(447, 2, 'Florida Institute of Technology', '', '', '', ' Melbourne Florida', '', '', '', NULL, 'www.fit.edu', '', '447.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(448, 2, 'Pace University', '', '', '', ' Westchester & New York City Campus', '', '', '', NULL, 'www.pace.edu', '', '448.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(449, 2, 'Drew University', '', '', '', ' Madison New Jersey', '', '', '', NULL, 'www.drew.edu', '', '449.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(450, 2, 'Lycoming College', '', '', '', ' Williamsport Pennsylvania ', '', '', '', NULL, 'https://www.lycoming.edu/', '(Only UG)', '450.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(451, 2, 'Whittier College', '', '', '', ' Whittier California ', '', '', '', NULL, 'https://whittier.edu/', '(Only UG)', '451.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(452, 2, 'Savannah College of Art and Design', '', '', '', ' Savannah and Atlanta Campus Georgia', '', '', '', NULL, 'www.scad.edu/', '', '452.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(453, 2, 'DePaul University', '', '', '', ' Chicago Illinois', '', '', '', NULL, 'www.depaul.edu', '', '453.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(454, 2, 'University of South Dakota', '', '', '', ' Vermillion South Dakota', '', '', '', NULL, 'https://www.usd.edu/', '', '454.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(455, 2, 'University of Hartford', '', '', '', ' West Hartford Connecticut (Direct Entry and UG/PG Pathway)', '', '', '', NULL, 'www.hartford.edu', '', '455.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(456, 2, 'Sacred Heart University', '', '', '', ' Fairfield Connecticut', '', '', '', NULL, 'www.sacredheart.edu/', '', '456.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(457, 2, 'Florida International University', '', '', '', ' Miami Florida ', '', '', '', NULL, 'www.fiu.edu', '(All UG Programs) (PG Programs - Chapman Graduate School of Business)', '457.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(458, 2, 'Kent State University', '', '', '', ' Kent Ohio', '', '', '', NULL, 'www.kent.edu', '', '458.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(459, 2, 'The University of Toledo', '', '', '', ' Toledo Ohio ', '', '', '', NULL, 'https://www.utoledo.edu/', '(Only UG)', '459.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(460, 2, 'University of Denver', '', '', '', ' Colorado ', '', '', '', NULL, 'https://daniels.du.edu/', '(Daniel’s College of Business only)', '460.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(461, 2, 'Nebraska Wesleyan Unlversity', '', '', '', ' Lincoln Nebraska ', '', '', '', NULL, 'www.nabrweslwyardu', '(Only UG)', '461.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(462, 2, 'Embry Riddle Aeronautical University', '', '', '', ' Daytona Beach (Flarida) & Prescatt (Arizona) Campus', '', '', '', NULL, 'https://erau.edu/', '', '462.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(463, 2, 'Mississippl State University', '', '', '', ' Oktibbeha County Mississlppll', '', '', '', NULL, 'www.msataie.edu', '', '463.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(464, 2, 'University of New Mexico', '', '', '', ' Albuquerque New Mexico', '', '', '', NULL, 'www.unm.edu', '', '464.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(465, 2, 'IlUnols State University', '', '', '', ' Normal IWnols', '', '', '', NULL, 'www.inoastatwedu', '', '465.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(466, 2, 'The Cathollc Unlversity of America', '', '', '', ' Washington D.C.', '', '', '', NULL, 'httpx:/wwwcathollc.eclu/nclw.html.', '', '466.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(467, 2, 'Oklahoma State University', '', '', '', ' Stillwater Oklahoma ', '', '', '', NULL, 'http://go.oatatmedul', '(Only UG)', '467.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(468, 2, 'Rowan Unlversity', '', '', '', ' Glassboro New Jersey', '', '', '', NULL, 'httpx:/wwwzowarvdul\'', '', '468.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(469, 2, 'University of Wisconsin Milwaukee', '', '', '', ' Milwaukee Wisconsin', '', '', '', NULL, 'wwwuwimudu', '', '469.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(470, 2, 'Marquette Unlversity', '', '', '', ' Milwaukee Wsconsin', '', '', '', NULL, 'https://www.marquette.edu/', '', '470.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(471, 2, 'University of Nevada', '', '', '', ' Reno Nevada', '', '', '', NULL, 'wwwunr.adu', '', '471.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(472, 2, 'Ball State University', '', '', '', ' Muncle Indana', '', '', '', NULL, 'httpa:/wwwdbauachal', '', '472.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(473, 2, 'Cleveland State Unlversity', '', '', '', ' Cleveland Ohlo', '', '', '', NULL, 'www.csuohio.edu', '', '473.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(474, 2, 'Indlana Unlversity of Fennsylvanla', '', '', '', ' Indiana PA', '', '', '', NULL, 'www.lup.edu', '', '474.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(475, 2, 'Wright State Unlversity', '', '', '', ' Dayton Ohlo', '', '', '', NULL, 'www.wrightadu', '', '475.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(476, 2, 'Wichita State Unlversity', '', '', '', ' Wichita Kansas', '', '', '', NULL, 'www.wlchlta.edu', '', '476.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(477, 2, 'Northern Arizona University', '', '', '', ' Flagstatf Arizona', '', '', '', NULL, 'www.nauedu', '', '477.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(478, 2, 'University of North Texns', '', '', '', ' Denton Texns', '', '', '', NULL, 'www.unt.edu', '', '478.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(479, 2, 'University of North Texns at Frisco Texns', '', '', '', '', '', '', '', NULL, 'https://frisco.unt.edu/', '', '479.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(480, 2, 'University of Missourl', '', '', '', ' St. Louls Missourl', '', '', '', NULL, 'https://www.umsl.edu/', '', '480.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(481, 2, 'Middle Tennessee State University', '', '', '', ' Murfreesboro Tennessee', '', '', '', NULL, 'www.mtsu.edu/', '', '481.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(482, 2, 'University of Nebraska at Omaha', '', '', '', ' Omaha Nebraska', '', '', '', NULL, 'httpx:/wwwanomchcuedu/', '', '482.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(483, 2, 'The Unlversity of Memphis', '', '', '', ' Memphis Tennessee', '', '', '', NULL, 'www.memphla.edu', '', '483.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(484, 2, 'Tennessee Tech Unlversity', '', '', '', ' Cookeville Tennessee', '', '', '', NULL, 'www.tntech.adu', '', '484.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(485, 2, 'Texas State Unlversity', '', '', '', ' San Marcos and Rock Round Campus Texas', '', '', '', NULL, 'www.txstate.edu', '', '485.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(486, 2, 'University of North Florida', '', '', '', ' Jacksonville Florida', '', '', '', NULL, 'httpa:/wwwnf.adul', '', '486.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(487, 2, 'Florida Atlantic University', '', '', '', ' Boca Raton Florida', '', '', '', NULL, 'httpx://wwwfouadu/', '', '487.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(488, 2, 'Nova Southeastern Unlversity', '', '', '', ' Davle Florida', '', '', '', NULL, 'www.nova.edu', '', '488.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(489, 2, 'University of South Alabama', '', '', '', ' Moblie Alabama', '', '', '', NULL, 'www.southalnbama.adul', '', '489.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(490, 2, 'Montana State University', '', '', '', ' Bozeman Montana', '', '', '', NULL, 'www.montuna.edu', '', '490.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(491, 2, 'The University of Scranton', '', '', '', ' Scranton Pennsylvanla', '', '', '', NULL, 'www.acranton.edu!', '', '491.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(492, 2, 'Milwaukee School of Engineering', '', '', '', ' Milwaukee Wisconaln', '', '', '', NULL, 'www.msow.edu', '', '492.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(493, 2, 'Auburn University at Montgomery', '', '', '', ' Montgomery Alabama', '', '', '', NULL, 'www.muLedu', '', '493.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(494, 2, 'Hofstra Unlversity', '', '', '', ' Long Island New York ', '', '', '', NULL, 'www.hofatra.wdu', '(UG, PG Pathway and Direct Entry)', '494.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(495, 2, 'Kennesaw State University', '', '', '', ' Kennesaw Georgla', '', '', '', NULL, 'www.kennesaw.edu/', '', '495.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(496, 2, 'Roocevelt Unlversity', '', '', '', ' Chicago and Schaumburg IlUnals', '', '', '', NULL, 'http:/wwwrooowvelt.edul', '', '496.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(497, 2, 'Purdue Unlversity Northwest', '', '', '', ' Hammond Indiana', '', '', '', NULL, 'https://www.pnw.edu/', '', '497.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(498, 2, 'Long Island University', '', '', '', ' Fost New York', '', '', '', NULL, 'wwwlkdu/pcat', '', '498.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(499, 2, 'Long Island University', '', '', '', ' Brooklyn New York', '', '', '', NULL, 'wwwlluedu', '', '499.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(500, 2, 'Texas A &. M University', '', '', '', ' Corpus Christi Texns', '', '', '', NULL, 'https://www.tamucc.edu/', '', '500.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(501, 2, 'Western Kentucky Unlversity', '', '', '', ' Bowling Green Kentucky', '', '', '', NULL, 'www.wkLedu', '', '501.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(502, 2, 'Southeast Missourl State University', '', '', '', ' Cape Glrardeau Missourl', '', '', '', NULL, 'www.semo.edu', '', '502.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(503, 2, 'Youngstown State Unlversity', '', '', '', ' Youngstown Ohlo', '', '', '', NULL, 'www.yauedu', '', '503.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(504, 2, 'Callfornia Baptist University', '', '', '', ' Riverside Callfornia', '', '', '', NULL, 'www.colboptht.adu', '', '504.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(505, 2, 'Pacific Lutheran Unlversity', '', '', '', ' Tacoma Washington', '', '', '', NULL, 'www.pluedu', '(Dlrect Entry and UG/PG Pathway)', '505.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(506, 2, 'Arkansas State University', '', '', '', ' Jonesbaro Arkansas', '', '', '', NULL, 'wwwnstatwedu', '', '506.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(507, 2, 'University of Illinols Springheld', '', '', '', ' Springheld Illinols', '', '', '', NULL, 'httpx:/www.la.ech!', '', '507.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(508, 2, 'McMurry Unlversity', '', '', '', ' Abllene Texns ', '', '', '', NULL, 'https://mcm.edu/', '(Only UG)', '508.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(509, 2, 'Care Hope College', '', '', '', ' Jupiter Florida ', '', '', '', NULL, 'httpx:/wwwcarwhope.adu/', '(Only UG)', '509.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(510, 2, 'Lewis University', '', '', '', ' Romeoville (illinois) and Albuquerque (New Mexico) Campus', '', '', '', NULL, 'wwwdwwluudul', '', '510.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(511, 2, 'Governors State Unlversity', '', '', '', ' Chicago IlUnols', '', '', '', NULL, 'http:/wwwgowt.adul', '', '511.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(512, 2, 'Sauth Dakota School of Mines & Technology', '', '', '', ' Rapld City South Dakota ', '', '', '', NULL, 'https://www.sdsmt.edu/', '(Only UG)', '512.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(513, 2, 'Woodbury Unlversity', '', '', '', ' Burbank Callfornia', '', '', '', NULL, 'https://woodbury.edu/', '', '513.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(514, 2, 'Southern Illlnols University', '', '', '', ' Edwardsville Illinols', '', '', '', NULL, 'www.abn.edul', '', '514.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(515, 2, 'Western IWnols Unlversity', '', '', '', ' Macomb and Quad Cities Campus IWnols', '', '', '', NULL, 'www.wlu.edu!', '', '515.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(516, 2, 'University of New Haven', '', '', '', ' West Haven Connectlcut', '', '', '', NULL, 'www.nwwhavervedu', '', '516.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(517, 2, 'Dakota State Unlversity', '', '', '', ' Madison South Dakotn', '', '', '', NULL, 'www.dsu.edu', '', '517.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(518, 2, 'Pittsburg State Unlversity', '', '', '', ' Pittsburg Kansas', '', '', '', NULL, 'www.plttatotmedu', '', '518.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(519, 2, 'Missourl Southern State University', '', '', '', ' Joplin Missourl', '', '', '', NULL, 'httpx://wwwmasuadu/', '', '519.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(520, 2, 'University of Bridgeport', '', '', '', ' Bridgeport Connecticut', '', '', '', NULL, 'www.bridgeport.edu', '', '520.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(521, 2, 'Murrny State Unlversity', '', '', '', ' Murray Kentucky', '', '', '', NULL, 'https://www.murraystate.edu/', '', '521.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(522, 2, 'Marshall Unlversity Huntington', '', '', '', ' Huntington West VirgInia', '', '', '', NULL, 'https://www.marshall.edu/', '', '522.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(523, 2, 'Duquesne University', '', '', '', ' Fittsburgh Pennaylvanla', '', '', '', NULL, 'https://www.duq.edu/', '', '523.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(524, 2, 'Yeshiva University', '', '', '', ' New York City', '', '', '', NULL, 'https://potomac.edu/', '', '524.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(525, 2, 'Bryant Unliversity', '', '', '', ' Smithheld Rhode Island ', '', '', '', NULL, 'httpx:/wwwbryant.edu!', '(Only PG)', '525.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(526, 2, 'Southern Utnh Unlversity', '', '', '', ' Cedar Utah', '', '', '', NULL, 'httpx:/wwwauuadu!', '', '526.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(527, 2, 'Midwestern State University', '', '', '', ' Wichita Falls Texns', '', '', '', NULL, 'www.mwauadu', '', '527.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(528, 2, 'NY Tech', '', '', '', ' New York (NYIT)', '', '', '', NULL, 'www.nylt.wdu', '', '528.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(529, 2, 'Bay Atlantic University', '', '', '', ' WashIngton D.C.', '', '', '', NULL, 'https://bau.edu/', '', '529.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(530, 2, 'Roger Willlams Unlversity', '', '', '', ' Bristol Rhode Island', '', '', '', NULL, 'httpx://wwwrwuadu!', '', '530.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(531, 2, 'University Of Central Oklahoma', '', '', '', ' Edmond Oklahoma', '', '', '', NULL, 'www.uco.wdu', '', '531.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(532, 2, 'Central Methodist University', '', '', '', ' Fayette Missourl', '', '', '', NULL, 'http:/wwwcwntralmetodat.adu/', '', '532.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(533, 2, 'Central Michigan Unlversity', '', '', '', ' Mount Pleasant Michigan', '', '', '', NULL, 'www.cmlch.dlu!', '', '533.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(534, 2, 'University of the Potomac', '', '', '', ' Washington DC and Virginia Campus', '', '', '', NULL, 'httpx://potomac.adu/', '', '534.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(535, 2, 'University of LoulsvIlle', '', '', '', ' Loulsville Kentucky', '', '', '', NULL, 'http:Moulwvila.scku!', '', '535.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(536, 2, 'Eastern Michigan University', '', '', '', ' Ypsllanti Michigan', '', '', '', NULL, 'wwwamichadu/', '', '536.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(537, 2, 'Grand Valley State Unlversity', '', '', '', ' Allendale Michigan', '', '', '', NULL, 'www.gvsu.edu/', '', '537.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(538, 2, 'Lawrence Technological University', '', '', '', ' Southfteld Michligan', '', '', '', NULL, 'www.ltu.edu', '', '538.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(539, 2, 'University of Michigan-Flint', '', '', '', ' Flint Michigan', '', '', '', NULL, 'https://www.umflint.edu/', '', '539.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(540, 2, 'Texas A&M Unlversity - KingsvIlle', '', '', '', ' Kingsville Texas', '', '', '', NULL, 'httpx://wwwinmuk.eda/', '', '540.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(541, 2, 'University of Central Arkansas', '', '', '', ' Conway Arkansas', '', '', '', NULL, 'http:/ucrz.aclu/', '', '541.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(542, 2, 'Felician Unlversity', '', '', '', ' Rutherford New Jersey', '', '', '', NULL, 'https://felician.edu/', '', '542.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(543, 2, 'Salnt Leo University', '', '', '', ' St. Leo Florida', '', '', '', NULL, 'www.scintleo.adu', '', '543.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(544, 2, 'Midway University', '', '', '', ' Midway Kentucky', '', '', '', NULL, 'httpx://wwwmldwoy.edu!', '', '544.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(545, 2, 'University of North Carolina Wilmington', '', '', '', ' Wilmington North Carolina', '', '', '', NULL, 'http:/uncwcedu/', '', '545.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(546, 2, 'Johnson & Wales Unlversity', '', '', '', ' Providence (Rhode Island) and Charlotte (North Carolina) Campus', '', '', '', NULL, 'www.jww.edu', '', '546.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(547, 2, 'Northwest Missourl State University', '', '', '', ' Maryville Missourl', '', '', '', NULL, 'www.nwmlxxourLecu', '', '547.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(548, 2, 'South Unlversity', '', '', '', ' Savannah, Geargla and Tampa Florida', '', '', '', NULL, 'https://www.southuniversity.edu/', '', '548.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(549, 2, 'Missourl State University', '', '', '', ' Springheld Missourl', '', '', '', NULL, 'www.mlascuriatote.edu', '', '549.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(550, 2, 'Maryville University', '', '', '', ' St. Louls Missourl', '', '', '', NULL, 'http://wwwmaryvllmedu/', '', '550.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(551, 2, 'Callfornia Lutheran University', '', '', '', ' Thousand Oaks Callfornia (Schoal of Management)', '', '', '', NULL, 'https://www.callutheran.edu/', '', '551.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(552, 2, 'Salnt Mary College of Callfornia', '', '', '', ' Moraga Callfarnlia', '', '', '', NULL, 'httpx://wwwaimarys-cu.acu!', '', '552.png', NULL, '2024-11-18 14:48:08', NULL, 'active');
INSERT INTO `university` (`university_id`, `region_id`, `university_name`, `country`, `state`, `city`, `address`, `phone`, `alternate_phone`, `email`, `alternate_email`, `website`, `additional_info`, `logo`, `brief_document`, `created_on`, `last_updated_on`, `status`) VALUES
(553, 2, 'Weber State Unlversity', '', '', '', ' Ogden Utah', '', '', '', NULL, 'www.wwbr.edul', '', '553.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(554, 2, 'University of Tampa', '', '', '', ' Tampa Flarida', '', '', '', NULL, 'wwwut.edw', '', '554.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(555, 2, 'Xavier Untversity', '', '', '', ' Cincinnat Ohlo', '', '', '', NULL, 'http:/www.xavler.edu', '', '555.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(556, 2, 'Willlam Jessup Unlversity', '', '', '', ' Rocklin & San Jose Campus Callfornia', '', '', '', NULL, 'httpaxc/ijemaup.edul', '', '556.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(557, 2, 'Southern New Hampshire Unlversity', '', '', '', ' Manchester New Hampchire', '', '', '', NULL, 'www.anhu.edu', '', '557.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(558, 2, 'Troy Unlversity', '', '', '', ' Troy Alnbama', '', '', '', NULL, 'www.troyedu', '', '558.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(559, 2, 'Texas Wesleyan Unlversity', '', '', '', ' Fort Worth Texas', '', '', '', NULL, 'www.txwws.edu', '', '559.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(560, 2, 'Dallas Baptist Unlversity', '', '', '', ' Dallas Texas', '', '', '', NULL, 'httpx://wwwdbuadu/', '', '560.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(561, 2, 'Thomas Jefferson University', '', '', '', ' Philadelphia Pennsylvania', '', '', '', NULL, 'www.jffwraonadu', '', '561.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(562, 2, 'York College of Pennsylvania', '', '', '', ' York Pennsylvania ', '', '', '', NULL, 'httpx://wwwycpadu/', '(Only UG)', '562.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(563, 2, 'University of South Carolina Upstate', '', '', '', ' Spartanburg South Carolina', '', '', '', NULL, 'http://ucupatrte.acka/', '', '563.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(564, 2, 'University of St. Thomas', '', '', '', ' Saint Paul Minnesota', '', '', '', NULL, 'www.atthomas.edu!', '', '564.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(565, 2, 'Southwest Minnesota State University', '', '', '', ' Marshall Minnesota', '', '', '', NULL, 'www.amuedl', '', '565.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(566, 2, 'City University of Seattle', '', '', '', ' Seattle WashIngton', '', '', '', NULL, 'http://wwwzityuadu/', '', '566.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(567, 2, 'Western New England University', '', '', '', ' Spring held Massachusetts', '', '', '', NULL, 'www.wne.edu', '', '567.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(568, 2, 'River University', '', '', '', ' Nashua New Hampshire', '', '', '', NULL, 'www.rivler.edu', '', '568.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(569, 2, 'Northwood University', '', '', '', ' Midland Michigan', '', '', '', NULL, 'www.northwood.edu', '', '569.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(570, 2, 'Rider University', '', '', '', ' Lawrence Township New Jersey', '', '', '', NULL, 'www.rlder.ecu', '', '570.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(571, 2, 'Atlantis University', '', '', '', ' Miami Florida', '', '', '', NULL, 'https://atlantisuniversity.edu/', '', '571.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(572, 2, 'Valparaiso University', '', '', '', ' Valparaiso Indiana', '', '', '', NULL, 'wwwvalpa.adu', '', '572.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(573, 2, 'Trine University', '', '', '', ' Angola Indiana', '', '', '', NULL, 'www.trina.ecka!', '', '573.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(574, 2, 'Saginaw Valley State University', '', '', '', ' Saginaw Michigan', '', '', '', NULL, 'www.avaw.wdu', '', '574.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(575, 2, 'Slippery Rock University', '', '', '', ' Slippery Rock Penneylvania', '', '', '', NULL, 'www.aru.edu', '', '575.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(576, 2, 'Golden Gate University', '', '', '', ' San Francisca California ', '', '', '', NULL, 'www.pgu.edu', '(Only PG)', '576.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(577, 2, 'Westcliff University', '', '', '', ' Irvine California', '', '', '', NULL, 'www.wwatcl.achal', '', '577.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(578, 2, 'University of Wisconsin-Superior', '', '', '', ' Superior Wisconsin ', '', '', '', NULL, 'https://www.uwsuper.edu/', '(Only UG)', '578.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(579, 2, 'University of Wisconsin-Eau Clalre', '', '', '', ' Eau Clalre and Barran County Campus Wisconsin', '', '', '', NULL, 'https://www.uwec.edu/profiles/', '', '579.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(580, 2, 'University of Wisconsin-La Croase', '', '', '', ' La Crosce Wisconsin', '', '', '', NULL, 'www.wlax.wdu', '', '580.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(581, 2, 'University of Wisconsin-Stout', '', '', '', 'Stout Wisconsin', '', '', '', NULL, 'wwwuwatout.edu!', '', '581.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(582, 2, 'Western Oregon University', '', '', '', ' Monmouth and Salem Oregon ', '', '', '', NULL, 'http:/wou.edul', '(Only UG)', '582.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(583, 2, 'Charleston Southern University', '', '', '', ' Charleston South CarolIna', '', '', '', NULL, 'www.csunlcadu', '', '583.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(584, 2, 'Marymount Unlversity', '', '', '', ' Arlington Virginia', '', '', '', NULL, 'https://marymount.edu/', '', '584.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(585, 2, 'Devry University', '', '', '', ' Downers Grove ILlinols', '', '', '', NULL, 'www.devry.edu', '', '585.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(586, 2, 'East Carolina University', '', '', '', ' Greenville North Carolina ', '', '', '', NULL, 'www.ecu.acha!', '(Only UG)', '586.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(587, 2, 'James Madison University', '', '', '', ' Harrisonburg Virginia ', '', '', '', NULL, 'www.jmuedu', '(Only UG)', '587.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(588, 2, 'Tiffin University', '', '', '', ' Tiffin Ohio', '', '', '', NULL, 'www.tltfindal', '', '588.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(589, 2, 'Franklin University', '', '', '', ' Columbus Ohio', '', '', '', NULL, 'www.franklirdul', '', '589.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(590, 2, 'post University', '', '', '', ' Waterbury Connecticut ', '', '', '', NULL, 'httpx://paut.edu!', '(Only UG)', '590.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(591, 2, 'Academy of Art University', '', '', '', ' San Francisco California', '', '', '', NULL, 'www.ncademyart.adu', '', '591.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(592, 2, 'Full Sail University', '', '', '', ' Winter Park Florida', '', '', '', NULL, 'www.fullaalLedu', '', '592.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(593, 2, 'New York Film Academy', '', '', '', ' New York City', '', '', '', NULL, 'www.nyfa.wdu', '', '593.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(594, 2, 'Upper lowa Unlversity', '', '', '', ' Fayette lowa', '', '', '', NULL, 'wwwuledu', '', '594.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(595, 2, 'Oklahoma City University', '', '', '', ' Oklahoma City Oklahoma', '', '', '', NULL, 'www.okcuadu', '', '595.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(596, 2, 'Franklin College', '', '', '', ' Franklin Indiana ', '', '', '', NULL, 'http:/frankiincolegwedul', '(Only UG)', '596.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(597, 2, 'Webster University', '', '', '', ' St. Louis (Missouri) and San Antonio (Texas) Campus', '', '', '', NULL, 'https://webster.edu/', '', '597.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(598, 2, 'Truman State University', '', '', '', ' Kirksville Missouri', '', '', '', NULL, 'www.trumanedu/', '', '598.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(599, 2, 'Augustana University', '', '', '', ' Sioux Falls South Dakota ', '', '', '', NULL, 'www.mugle.edul', '(Only UG)', '599.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(600, 2, 'Park University', '', '', '', ' Parkville (Missourl) and Gilbert (Arizona) Campus', '', '', '', NULL, 'www.park.edu', '', '600.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(601, 2, 'The University of Findlay', '', '', '', ' Findlay Ohio', '', '', '', NULL, 'wwwhndlayuedu', '', '601.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(602, 2, 'Hult International Business School', '', '', '', ' Boston & San Francisco campus', '', '', '', NULL, 'wwwhult.edu', '', '602.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(603, 2, 'Simmons University', '', '', '', ' Boston Massachusetts (Only UG women-focused)', '', '', '', NULL, 'www.simmons.edu/', '', '603.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(604, 2, 'University of Mary Hardin-Baylor', '', '', '', ' Belton Texas', '', '', '', NULL, 'https://www.umhb.edu/', '', '604.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(605, 2, 'Lipscomb University', '', '', '', ' Nashville Tennessee ', '', '', '', NULL, 'wwwlipacombudu', '(Only UG)', '605.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(606, 2, 'Western Washington University', '', '', '', ' Bellingham Washington', '', '', '', NULL, 'www.wwwwdu', '', '606.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(607, 2, 'Miami University', '', '', '', ' Hamilton & Middletown Campus Ohio ', '', '', '', NULL, 'https://miamioh.edu/regionals/', '(Only UG)', '607.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(608, 2, 'New England Institute of Technology', '', '', '', ' Warwick Rhode Island', '', '', '', NULL, 'www.nalt.ecku', '', '608.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(609, 2, 'Marist College', '', '', '', ' Poughkeepsie New York', '', '', '', NULL, 'www.morlatedu', '', '609.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(610, 2, 'Spartan College of Aeronautics and Technology', '', '', '', ' Tulsa Oklahoma ', '', '', '', NULL, 'https://www.spartan.edu/', '(Only UG)', '610.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(611, 2, 'Ottawa University', '', '', '', 'Ottawa Kansas', '', '', '', NULL, 'http:/wwwattawaadwbus/home', ' campus(Only MBA-IT)', '611.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(612, 2, 'Mississippi College', '', '', '', ' Clinton Mississippi', '', '', '', NULL, 'www.mc.edu', '', '612.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(613, 2, 'Monroe College', '', '', '', ' Bronx New York', '', '', '', NULL, 'www.monroecollega.ecu', '', '613.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(614, 2, 'New England College', '', '', '', ' Henniker New Hampshire', '', '', '', NULL, 'www.nwc.eclu', '', '614.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(615, 2, 'Berkeley College', '', '', '', ' New Jersey & New York', '', '', '', NULL, 'http://berkelwycollagnadul', '', '615.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(616, 2, 'Richard Bland College of William & Mary', '', '', '', ' Petersburg Virginia ', '', '', '', NULL, 'https://www.rbc.edu/', '(Only UG)', '616.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(617, 2, 'Fisher College', '', '', '', ' Boston Massachusetts', '', '', '', NULL, 'www.fisher.edu', '', '617.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(618, 2, 'Santa Monica College', '', '', '', ' Santa Monica California', '', '', '', NULL, 'https://www.smc.edu/', '', '618.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(619, 2, 'Green River College', '', '', '', ' Auburn Washington', '', '', '', NULL, 'www.greenriver.edu', '', '619.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(620, 2, 'Seattle Colleges', '', '', '', ' Seattle Washington', '', '', '', NULL, 'www.seattlecentral.edu', '', '620.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(621, 2, 'San Mateo Colleges of Silicon Valley San Mateo', '', '', '', ' California', '', '', '', NULL, 'https://www.smccd.edu/international/', '(Cañada College, College of San Mateo, & Skyline College)', '621.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(622, 2, 'Santa Ana College', '', '', '', ' Santa Ana California', '', '', '', NULL, 'www.sac.edu', '', '622.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(623, 2, 'Santa Rosa Junior College', '', '', '', ' Santa Rosa California', '', '', '', NULL, 'www.santarosa.edu/', '', '623.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(624, 2, 'The Contra Costa Community College District', '', '', '', ' Martinez California', '', '', '', NULL, 'www.contracosta.edu/', '', '624.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(625, 2, 'Shoreline Community College', '', '', '', ' Shoreline, Washington', '', '', '', NULL, 'https://www.shoreline.edu/', '', '625.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(626, 2, 'Foothill De Anza Community College', '', '', '', ' Los Altos Hills California', '', '', '', NULL, 'https://www.fhda.edu/', '', '626.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(627, 2, 'Finger Lakes Community College Canandaigua', '', '', '', ' New York', '', '', '', NULL, 'https://www.flcc.edu/', '', '627.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(628, 2, 'Georgia State University', '', '', '', ' Atlanta Georgia (ESL Programs only)', '', '', '', NULL, 'www.gsu.edu/', '', '628.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(629, 2, 'Minnesota State University', '', '', '', ' Mankato Minnesota (Center for English Language Programs)', '', '', '', NULL, 'https://www.mnsu.edu/', '', '629.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(630, 2, 'Summer Discovery. Discovery Internship and Jr. Internship', '', '', '', ' Roslyn, New York', '', '', '', NULL, 'www.summerdiscovery.com', '', '630.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(631, 2, 'Lawrence Technological University (Michigan) and PIBM (Pune) Joint Degree Program (Global MBA)', '', '', '', '', '', '', '', NULL, 'https://www.pibm.in/global-joint-degree-dual-program/admissions-2023.aspx', '', '631.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(632, 2, 'North Broward Preparatory School', '', '', '', ' Florida', '', '', '', NULL, 'https://www.nordangliaeducation.com/nbps-florida', '', '632.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(633, 2, 'Windermere Preparatory Boarding School', '', '', '', ' Florida', '', '', '', NULL, 'https://www.nordangliaeducation.com/wps-florida/boarding', '', '633.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(634, 2, 'The Village Boarding School', '', '', '', ' Texas', '', '', '', NULL, 'https://www.nordangliaeducation.com/village-houston', '', '634.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(635, 4, 'INSEEC Business School', '', '', '', ' Paris', '', '', '', NULL, 'https://www.inseec.com/en/', '', '635.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(636, 4, 'NEOMA Business School', '', '', '', ' Rouen', '', '', '', NULL, 'www.neoma-bs.com', '', '636.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(637, 4, 'ESCE International Business School', '', '', '', ' Paris', '', '', '', NULL, 'https://www.esce.fr/en/', '', '637.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(638, 4, 'ECE Engineering School', '', '', '', ' Paris', '', '', '', NULL, 'https://www.ece.fr/en/', '', '638.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(639, 4, '(Navitas) ICN International College', '', '', '', ' Paris', '', '', '', NULL, 'https://www.icn-internationalcollege.com/', '', '639.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(640, 4, 'SupdePub School of Creation and Communication', '', '', '', ' Paris', '', '', '', NULL, 'https://www.supdepub.com/en/about-us/paris-campus/', '', '640.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(641, 4, 'HEIP, School of International and Political Studies', '', '', '', ' Paris', '', '', '', NULL, 'https://www.heip.fr/en/', '', '641.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(642, 4, 'Excelia Group', '', '', '', ' La Rochelle', '', '', '', NULL, 'www.excelia-group.com/?allow_language=true', '', '642.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(643, 4, 'ICN Business School', '', '', '', ' Nancy', '', '', '', NULL, 'https://www.icn-artem.com/en/', '', '643.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(644, 4, 'Kedge Business School', '', '', '', ' Talence', '', '', '', NULL, 'https://student.kedge.edu/', '', '644.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(645, 4, 'Montpellier Business School', '', '', '', ' Montpellier', '', '', '', NULL, 'https://www.montpellier-bs.com/international/', '', '645.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(646, 4, 'ESSCA School of Management', '', '', '', ' Angers', '', '', '', NULL, 'https://www.essca.fr/en/', '', '646.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(647, 4, 'EM Normandie Business School', '', '', '', ' Paris', '', '', '', NULL, 'www.ecole-management-normandie.fr/uk/', '', '647.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(648, 4, 'Clermont School of Business', '', '', '', ' Clermont-Ferrand', '', '', '', NULL, 'https://www.esc-clermont.fr/en/', '', '648.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(649, 4, 'Rennes School of Business', '', '', '', ' Rennes', '', '', '', NULL, 'www.rennes-sb.com', '', '649.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(650, 4, 'Skema Business School', '', '', '', ' Paris', '', '', '', NULL, 'www.skema.edu', '', '650.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(651, 4, 'Ecole Nationale Supérieure des Mines d\'Alès - IMT Mines', '', '', '', ' Alès (MSc in Disaster Management and Environmental Impact)', '', '', '', NULL, 'www.mines-ales.fr/', '', '651.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(652, 4, 'Burgundy School of Business', '', '', '', ' Dijon', '', '', '', NULL, 'global.bsb-education.com/', '', '652.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(653, 4, 'Institut supérieur d`électronique de Paris (ISEP)', '', '', '', ' Paris', '', '', '', NULL, 'www.isep.org', '', '653.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(654, 4, 'EPITA - School of Engineering and Computer Science', '', '', '', ' Paris', '', '', '', NULL, 'www.epita.fr/en/', '', '654.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(655, 4, 'ESIGELEC', '', '', '', ' Rouen', '', '', '', NULL, 'www.esigelec.fr/en', '', '655.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(656, 4, 'Institut supérieur du commerce de Paris - ISC', '', '', '', ' Paris', '', '', '', NULL, 'www.iscparis.com', '', '656.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(657, 4, 'Le Cordon Bleu', '', '', '', ' Paris', '', '', '', NULL, 'www.lcbparis.com', '', '657.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(658, 4, 'De Vinci Higher Education', '', '', '', ' Paris', '', '', '', NULL, 'www.devinci.fr', '', '658.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(659, 4, 'College de Paris', '', '', '', ' Paris', '', '', '', NULL, 'www.collegedeparis.com', '', '659.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(660, 4, 'Queen Mary University of London', '', '', '', ' Paris', '', '', '', NULL, 'www.qmul.ac.uk/about/howtofindus/studyparis/', '', '660.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(661, 4, 'Instituto Marangoni Fashion and Design School', '', '', '', ' Paris', '', '', '', NULL, 'www.istitutomarangoni.com/en/campus/paris/', '', '661.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(662, 4, 'The American Business School of Paris', '', '', '', ' Paris', '', '', '', NULL, 'www.absparis.org/en/', '', '662.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(663, 4, 'Ecole Ducasse', '', '', '', ' Paris', '', '', '', NULL, 'www.ecoleducasse.com/en/campus-en/paris-campus', '', '663.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(664, 4, 'Berlin School of Business and Innovation', '', '', '', ' Paris', '', '', '', NULL, 'www.berlinsbi.com/international-student-guide/living-in-paris-france/the-campus-in-paris-france', '', '664.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(665, 4, 'IDRAC Business School', '', '', '', ' Paris', '', '', '', NULL, 'idrac-business-school.com/', '', '665.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(666, 4, 'ICD Business School', '', '', '', ' Paris', '', '', '', NULL, 'https://www.icd-bs.com/', '', '666.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(667, 4, 'Schiller International University', '', '', '', ' Paris Campus', '', '', '', NULL, 'https://schiller.edu/paris', '', '667.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(668, 4, 'École de Management Appliqué', '', '', '', ' Paris', '', '', '', NULL, 'https://www.ema.education/', '', '668.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(669, 4, 'Paris School of Business', '', '', '', ' Paris', '', '', '', NULL, 'https://www.psbedu.paris/en', '', '669.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(670, 4, 'ESDES School of Business and Management', '', '', '', ' Lyon', '', '', '', NULL, 'https://www.esdes.fr/', '', '670.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(671, 4, 'EPITECH', '', '', '', ' Paris', '', '', '', NULL, 'https://www.epitech.eu/', '', '671.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(672, 4, 'University of Antwerp', '', '', '', ' Antwerp', '', '', '', NULL, 'https://www.uantwerpen.be/en/', '', '672.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(673, 4, 'Thomas More, University of Applied Science, Antwerp', '', '', '', '', '', '', '', NULL, 'https://www.thomasmore.be/en/', '', '673.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(674, 4, 'Modul University, Vienna', '', '', '', '', '', '', '', NULL, 'www.modul.ac.at', '', '674.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(675, 4, 'International Business School (IBS)', '', '', '', ' Vienna ', '', '', '', NULL, 'www.ibs-b.hu', '(Except students from Punjab & South India)', '675.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(676, 4, 'Webster Vienna Private University', '', '', '', 'Vienna', '', '', '', NULL, 'https://www.webster.ac.at/', '', '676.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(677, 5, 'George Mason University', '', '', '', ' Korea Campus', '', '', '', NULL, 'https://masonkorea.gmu.edu/', '', '677.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(678, 5, 'University of Nottingham Ningbo China', '', '', '', 'china', '', '', '', NULL, 'www.nottingham.edu.cn/en/index.aspx', '', '678.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(679, 5, 'United International College', '', '', '', ' Zhuhai ', '', '', '', NULL, 'https://www.uic.edu.cn/en/', '(Only UG)', '679.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(680, 5, 'RMIT University, Vietnam Campus', '', '', '', 'Vietnam', '', '', '', NULL, 'www.rmit.edu.vn/', '', '680.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(681, 5, 'International College of Liberal Arts', '', '', '', ' Kofu', '', '', '', NULL, 'https://www.icla.ygu.ac.jp/en/', '', '681.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(682, 5, 'Tokyo International University', '', '', '', 'Kawagoe', '', '', '', NULL, 'www.tiu.ac.jp/etrack/', '', '682.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(683, 5, 'Kudan Institute of Japanese language & Culture', '', '', '', ' Tokyo', '', '', '', NULL, 'www.kudan-japanese-school.com/', '', '683.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(684, 5, 'Middlesex University', '', '', '', ' Mauritius Campus', '', '', '', NULL, 'www.middlesex.mu', '', '684.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(685, 5, 'Monash University', '', '', '', ' Malaysia Campus', '', '', '', NULL, 'www.monash.edu.my/', '', '685.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(686, 5, 'University of Southampton', '', '', '', ' Malaysia Campus', '', '', '', NULL, 'https://www.southampton.ac.uk', '', '686.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(687, 5, 'University of Nottingham', '', '', '', ' Malaysia Campus', '', '', '', NULL, 'www.nottingham.edu.my/index.aspx', '', '687.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(688, 5, 'University of Wollongong', '', '', '', ' Malaysia Campus', '', '', '', NULL, 'https://www.uow.edu.my/', '', '688.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(689, 5, 'Heriot-Watt University', '', '', '', ' Malaysia Campus', '', '', '', NULL, 'www.hw.ac.uk/malaysia.htm', '', '689.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(690, 5, 'Taylor`s University', '', '', '', ' Malaysia', '', '', '', NULL, 'university.taylors.edu.my', '', '690.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(691, 5, 'Swinburne University', '', '', '', 'Malaysia Campus', '', '', '', NULL, 'www.swinburne.edu.my', '', '691.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(692, 5, 'UCSI University', '', '', '', 'Kuala Lumpur', '', '', '', NULL, 'www.ucsiuniversity.edu.my/', '', '692.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(693, 5, 'Asia Pacific University of Technology And Innovation', '', '', '', 'Kuala Lumpur', '', '', '', NULL, 'https://www.apu.edu.my/', '', '693.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(694, 5, 'University of Kuala Lumpur', '', '', '', 'Malaysia', '', '', '', NULL, 'www.unikl.edu.my/', '', '694.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(695, 5, 'Sunway Le Cordon Bleu', '', '', '', ' Malaysia', '', '', '', NULL, 'www.cordonbleu.edu/malaysia/home/en', '', '695.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(696, 5, 'Raffles University', '', '', '', ' Malaysia Campus', '', '', '', NULL, 'https://raffles-university.edu.my/', '', '696.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(697, 5, 'Raffles College of Higher Education', '', '', '', ' Malaysia Campus', '', '', '', NULL, 'https://raffles.edu.my/', '', '697.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(698, 5, 'MDIS Malaysia', '', '', '', ' Gelang Patah', '', '', '', NULL, 'https://www.mdis.edu.my/', '', '698.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(699, 5, 'University of Birmingham', '', '', '', 'Dubai Campus', '', '', '', NULL, 'www.birmingham.ac.uk/dubai/index.aspx', '', '699.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(700, 5, 'University of Wollongong', '', '', '', ' Dubai Campus', '', '', '', NULL, 'www.uowdubai.ac.ae', '', '700.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(701, 5, 'Curtin University', '', '', '', ' Dubai Campus', '', '', '', NULL, 'https://curtindubai.ac.ae/', '', '701.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(702, 5, 'Heriot Watt University', '', '', '', ' Dubai Campus', '', '', '', NULL, 'www.hw.ac.uk', '', '702.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(703, 5, 'University of Stirling', '', '', '', ' Dubai Campus', '', '', '', NULL, 'www.stir.ae/', '', '703.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(704, 5, 'Murdoch University', '', '', '', ' Dubai Campus', '', '', '', NULL, 'www.murdochdubai.ac.ae', '', '704.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(705, 5, 'Ajman University', '', '', '', ' Ajman', '', '', '', NULL, 'https://www.ajman.ac.ae/en', '', '705.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(706, 5, 'Canadian University', '', '', '', 'Dubai', '', '', '', NULL, 'www.cud.ac.ae', '', '706.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(707, 5, 'Abu Dhabi University', '', '', '', ' Abu Dhabi & Dubai', '', '', '', NULL, 'www.adu.ac.ae', '', '707.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(708, 5, 'Symbiosis International University', '', '', '', ' Dubai Campus', '', '', '', NULL, 'https://siu-dubai.ac.ae/', '', '708.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(709, 5, 'Middlesex University', '', '', '', ' Dubai Campus', '', '', '', NULL, 'www.mdx.ac.ae', '', '709.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(710, 5, 'De MontFort University', '', '', '', ' Dubai Campus', '', '', '', NULL, 'www.dmu.ac.uk/dubai/index.aspx', '', '710.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(711, 5, 'Birla Institute of Technology and Science (BITS Pilani)', '', '', '', 'Dubai Campus', '', '', '', NULL, 'https://www.bits-pilani.ac.in/Dubai/', '', '711.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(712, 5, 'Manipal Academy of Higher Education (MAHE)', '', '', '', ' Dubai Campus', '', '', '', NULL, 'www.manipal.edu/', '', '712.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(713, 5, 'Rochester Institute of Technology', '', '', '', 'Dubai (RIT Dubai)', '', '', '', NULL, 'www.rit.edu/dubai', '', '713.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(714, 5, 'Hult International Business School', '', '', '', ' Dubai Campus', '', '', '', NULL, 'www.hult.edu', '', '714.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(715, 5, 'S P Jain School of Global Management', '', '', '', 'Dubai Campus', '', '', '', NULL, 'https://www.spjain.org/global-campus/dubai', '', '715.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(716, 5, 'University of Bolton Academic Centre', '', '', '', 'Ras Al Khaimah', '', '', '', NULL, 'https://www.boltonac.ae/', '', '716.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(717, 5, 'EM Normandie', '', '', '', ' Dubai Campus', '', '', '', NULL, 'https://www.em-normandie.com/en/dubai-campus', '', '717.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(718, 5, 'HTMI Switzerland', '', '', '', ' Dubai Campus', '', '', '', NULL, 'www.htmidubai.com/', '', '718.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(719, 5, 'American University of Ras Al Khaimah', '', '', '', 'Ras Al Khaimah', '', '', '', NULL, 'www.aurak.ac.ae/en/', '', '719.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(720, 5, 'The Emirates Academy of Hospitality Management', '', '', '', ' Dubai', '', '', '', NULL, 'www.emiratesacademy.edu', '', '720.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(721, 5, 'Synergy University', '', '', '', 'Dubai Campus', '', '', '', NULL, 'https://synergydubai.ae/', '', '721.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(722, 5, 'Emirates Aviation University', '', '', '', ' Dubai', '', '', '', NULL, 'www.eau.ac.ae', '', '722.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(723, 5, 'University of Europe for Applied Sciences', '', '', '', ' Dubai', '', '', '', NULL, 'https://www.ue-germany.com/about-us/locations/dubai', '', '723.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(724, 5, 'Istituto Marangoni Fashion and Design School', '', '', '', ' Dubai', '', '', '', NULL, 'https://www.istitutomarangoni.com/en/campus/dubai-school-of-fashion-and-design', '', '724.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(725, 5, 'Abu Dhabi Hospitality Academy - Les Roches', '', '', '', ' Abu Dhabi Campus', '', '', '', NULL, 'https://lesroches.edu/campuses/abu-dhabi/', '', '725.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(726, 5, 'Institute of Management Technology (IMT)', '', '', '', ' Dubai', '', '', '', NULL, 'www.imt.edu/imt-dubai/', '', '726.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(727, 5, 'Global Business Studies - GBS', '', '', '', ' Dubai', '', '', '', NULL, 'https://gbs.ac.ae/', '', '727.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(728, 5, 'UK College of Business and Computing', '', '', '', ' Dubai Campus', '', '', '', NULL, 'https://ukcbc.ac.ae/', '', '728.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(729, 5, 'Regent College', '', '', '', ' Dubai Campus', '', '', '', NULL, 'https://regenteducation.ae/', '', '729.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(730, 5, 'National University of Singapore ', '', '', '', 'singapore', '', '', '', NULL, 'www.nus.edu.sg/', '(SCALE and ISS courses)', '730.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(731, 5, 'Technical University of Munich Asia ', '', '', '', 'singapore', '', '', '', NULL, 'tum-asia.edu.sg/', '(Only PG)', '731.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(732, 5, 'Singapore University of Technology and Design (SUTD)', '', '', '', 'singapore', '', '', '', NULL, 'https://www.sutd.edu.sg/', '', '732.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(733, 5, 'Curtin Singapore', '', '', '', 'singapore', '', '', '', NULL, 'www.curtin.edu.sg', '', '733.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(734, 5, 'James Cook University (JCU)', '', '', '', 'singapore', '', '', '', NULL, 'www.jcu.edu.au', '', '734.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(735, 5, 'Embry Riddle Aeronautical University Asia', '', '', '', 'singapore', '', '', '', NULL, 'https://asia.erau.edu/', '', '735.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(736, 5, 'SIM Global Education', '', '', '', 'singapore', '', '', '', NULL, 'www.simge.edu.sg', '', '736.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(737, 5, 'S P Jain School of Global Management', '', '', '', 'singapore', '', '', '', NULL, 'www.spjain.org', '', '737.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(738, 5, 'Management Development Institute of Singapore (MDIS)', '', '', '', 'singapore', '', '', '', NULL, 'www.mdis.edu.sg', '', '738.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(739, 5, 'PSB Academy', '', '', '', 'singapore', '', '', '', NULL, 'www.psb-academy.edu.sg', '', '739.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(740, 5, 'Raffles College of Higher Education', '', '', '', 'singapore', '', '', '', NULL, 'www.studyatraffles.com/singapore/', '', '740.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(741, 5, 'Kaplan Higher Education Academy (KHEA)', '', '', '', 'singapore', '', '', '', NULL, 'www.kaplan.com.sg', '', '741.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(742, 5, 'William Angliss Institute', '', '', '', 'singapore', '', '', '', NULL, 'www.angliss.edu.sg', '', '742.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(743, 5, 'Nanyang Institute of Management', '', '', '', 'singapore', '', '', '', NULL, 'www.nanyang.edu.sg', '', '743.png', NULL, '2024-11-18 14:48:08', NULL, 'active'),
(744, 5, 'East Asia Institute of Management', '', '', '', 'singapore', '', '', '', NULL, 'https://www.eaim.edu.sg/en/', '', '744.png', NULL, '2024-11-18 14:48:08', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `university_course`
--

CREATE TABLE `university_course` (
  `course_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `type_of_study` varchar(50) NOT NULL,
  `intake` varchar(50) NOT NULL COMMENT 'Spring, Fall, Summer, Autumn',
  `eligibility` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` set('MALE','FEMALE','OTHER','') COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_phone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_on` datetime DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `gender`, `phone`, `alternate_phone`, `password`, `email`, `alternate_email`, `current_address`, `permanent_address`, `profile_picture`, `created_on`, `last_updated_on`, `status`) VALUES
(1, 'Sateesh', '', 'Dogga', '1999-07-23', 'MALE', '12345678', NULL, 'Dummy@213', '', NULL, NULL, NULL, '', '2024-11-06 23:59:14', '2024-11-07 02:14:17', 'active'),
(2, 'Pavani', '', 'Ummarasetti', '2024-11-13', 'FEMALE', '12345678', NULL, 'Dummy@213', '', NULL, NULL, NULL, '', '2024-11-14 01:44:31', NULL, 'active'),
(3, 'Lokesh', '', 'Reddy', '2024-11-09', 'MALE', '8497975675', NULL, 'Dummy@213', 's@gmail.com', NULL, NULL, NULL, '', '2024-11-14 01:50:34', '2024-11-18 15:49:48', 'active'),
(4, 'Sanjay', 'Reddy', 'Kaki', '2024-11-01', 'MALE', '8497975674', NULL, 'Neelima@213', 'neelimag459@gmail.com', NULL, NULL, NULL, '4.jpg', '2024-11-14 01:52:51', '2024-11-18 02:46:20', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_visits`
--

CREATE TABLE `user_visits` (
  `visit_id` int(11) NOT NULL,
  `visit_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL DEFAULT 0,
  `ip_address` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE `work_experience` (
  `experience_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `work_type` varchar(25) NOT NULL COMMENT '1-job, 2-internship',
  `company_name` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `still_working` tinyint(1) NOT NULL COMMENT '1-yes, 0-no',
  `start_date` date NOT NULL,
  `notice_period` varchar(20) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `employment_type` varchar(15) NOT NULL COMMENT 'Full-time, part-time, contract',
  `office_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `prospect`
--
ALTER TABLE `prospect`
  ADD PRIMARY KEY (`prospect_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`scholarship_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`university_id`);

--
-- Indexes for table `university_course`
--
ALTER TABLE `university_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_visits`
--
ALTER TABLE `user_visits`
  ADD PRIMARY KEY (`visit_id`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD PRIMARY KEY (`experience_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `degree_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prospect`
--
ALTER TABLE `prospect`
  MODIFY `prospect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `scholarship_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `university_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=745;

--
-- AUTO_INCREMENT for table `university_course`
--
ALTER TABLE `university_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_visits`
--
ALTER TABLE `user_visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `experience_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
