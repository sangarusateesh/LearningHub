-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2023 at 11:16 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progress`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_updates`
--

CREATE TABLE `daily_updates` (
  `id` int(11) NOT NULL,
  `dou` date NOT NULL,
  `build` text NOT NULL,
  `tool` text NOT NULL,
  `module` text NOT NULL,
  `issue` text NOT NULL,
  `modified_files` text NOT NULL,
  `description` text NOT NULL,
  `task_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=>pending,1=>completed,2=>not required',
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `now` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_updates`
--

INSERT INTO `daily_updates` (`id`, `dou`, `build`, `tool`, `module`, `issue`, `modified_files`, `description`, `task_status`, `status`, `updated`, `now`) VALUES
(1, '2022-11-14', 'WR', 'internal', 'update pos and se', 'pos and se Update page is also not uploaded', 'updateRegisterModel.php', 'in updateModel.php all_mapped_pos_se() method was new column validation_limit added to query ', 2, 1, '2022-11-14 14:31:29', '2022-11-14 12:22:32'),
(2, '2022-11-15', 'WR', 'External', 'Contract Management', 'Contract management page is not uploaded', 'Internal\r\n1.web.php\r\nExternal\r\n1.ScheduleManagementcontroller.php,\r\n2.views->scheduleManagementViews->contractManagement.php\r\n3.nav_bar.php', 'View Page Was added and in ScheduleManagementcontroller and web.php controllers added 2 new methods contractManagement(), saveContractManagement()', 2, 1, '2022-11-15 12:43:40', '2022-11-15 12:27:48'),
(3, '2022-11-15', 'WR', 'External', 'Update Contract Management Page', 'Update contract management page is not uploaded.', 'Internal\r\n1.we.php\r\nExternal\r\n1.ScheduleManagementController.php\r\n2.views->scheduleManagementViews->UpdateContractManagement.php(newly added)\r\n3.nav_bar.php', 'updating the contract management', 2, 1, NULL, '2022-11-15 12:43:17'),
(4, '0000-00-00', '', '', '', '', '', '', 0, 1, NULL, '2022-11-15 20:05:04'),
(5, '2022-11-16', 'MH', 'External', 'Showing the Message in Toastr', 'The Toastr Message is not getting ok button and disappearing after 10seconds', 'toastr.js\r\nfiel path:remc_schweb_mhlibraries_extjsconfig-options/toastr.php', 'changing the new toastr.js file in repective file path', 2, 1, NULL, '2022-11-16 12:52:15'),
(6, '2022-11-17', 'MH', 'External', 'UPDATE(CONTRACT SUBMISSION)', 'Verify that contract values are updating for negative values ', 'updateRegister.php(c)', 'added 1 if condition for this and the condition was true the action will redirect to view page with error message', 2, 1, NULL, '2022-11-17 17:44:25'),
(7, '2022-11-17', 'MH', 'External', 'UPDATE(CONTRACT SUBMISSION)', 'Verify log is creating for RTM_PXI contract update', 'updateregister.php(c)', 'few lines of code is added for log', 2, 1, NULL, '2022-11-17 17:45:46'),
(8, '2022-11-17', 'MH', 'Internal', 'UPDATE(CONTRACT SUBMISSION)', 'Verify log is creating for RTM_IEX contract update', 'updateregister.php(c)', 'few lines of code is added for log', 2, 1, NULL, '2022-11-17 17:46:35'),
(9, '2022-11-17', 'MH', 'Internal,Exteranl', 'Contract management', 'Verify contract management update page have option to withdraw the declaration .', 'updateContractManagement.php', '\"1. Update Contract Management  data page is  displayed\r\n2. Declaration field should be enabled to edit. but in declaration field dropdown select option should be present insted of that no option is displayed twice.\r\n3. Submit option should be available\"\r\n\r\nhttps://docs.google.com/spreadsheets/d/1H9P3kPAHaLt3su6tqFePdeC4M4ZpmeeeII1fyfa5l-E/edit#gid=150502198', 2, 1, NULL, '2022-11-17 17:47:53'),
(10, '2022-11-18', 'WR', 'Internal', 'Collabration', 'Event log , giving error.', 'view level changes and controller', 'few lines of code was added', 2, 1, NULL, '2022-11-18 15:22:51'),
(11, '2022-11-18', 'WR', 'Internal', 'collabration', 'PX STOA log giving error. Table WRLDC.DATA_PX_STOA_ERROR_LOG doesnt exist', 'DATA_PX_STOA_ERROR_LOG new table was created', 'copy query for creating a table from NRLDC_V2', 2, 1, NULL, '2022-11-18 15:26:45'),
(12, '2022-11-18', 'WR', 'EXTERNAL', 'Schedule Submission', 'In Schedule submission by Hybrid try to download template giving php error.', 'internal\r\n1.web.php\r\nexternal\r\nhybridexcell.php', 'added few lines of code', 2, 1, NULL, '2022-11-18 15:27:59'),
(13, '2022-11-21', 'SR', 'Internal', 'POS & UTILITY', 'Page is submitted successfully.But capacity field is updating for negative value', 'updateRegisterviews->posutil.php', 'preventing the negative values in both front end and back end also', 2, 1, NULL, '2022-11-21 17:33:29'),
(14, '2022-11-21', 'SR', 'Internal', 'Contract Submission>Manual file upload', 'File should not be uploaded. Contract should not be created.`', 'RegisterController.php', 'Added few lines of code in that method', 2, 1, NULL, '2022-11-21 17:34:26'),
(15, '2022-11-21', 'SR', 'Internal', 'Contract Submission>Manual file upload', 'File is not uploaded and contract is not created but no error message is coming  ', 'registerController.php', 'few lines of code is added for that point', 2, 1, NULL, '2022-11-21 17:35:15'),
(16, '2022-11-25', 'NR', 'Internal', 'Update', 'Update POS and SE , not able to update the validation limit even if we enter less than sum of two dss installed capacity it is showing warning message as validation Limit is', 'updateregister.php', 'adding 1 more column to update query in controller', 2, 1, NULL, '2022-11-25 10:51:51'),
(17, '2022-11-25', 'NR', 'internal', 'nav bar', 'On clicking the RTM log sub menu it does not highlight the rtm log menu(this for all like gdam,dam,stoa)', 'nav_bar.php', 'add some conditions to control the nav bar', 2, 1, NULL, '2022-11-25 16:58:39'),
(18, '2022-11-25', 'NR', 'Internal', 'reports', 'Schedule based report Controls are not working properly.GDAM_REPORT,ENTITY WISE REPORT.NET SCHEDULE.Curtailment.Inter state report', 'nav_bar.php', 'added some conditions to control the av bar', 2, 1, NULL, '2022-11-25 16:59:42'),
(19, '2022-11-25', 'NR', 'internal', 'hybrid schedule', 'Internal/Hybrid schedule submission >Error message for the following scenario needs to be changed >Enter Hybrid_AvC > hybrid limit. Declared Hybrid Avc should not be greator than Hybrid Validation Limit for block1Declared Hybrid Avc should not be greator than Hybrid Validation Limit for block2Declared Hybrid Avc should not be greator than Hybrid Validation Limit for block3Declared Hybrid Avc should not be greator than Hybrid Validation Limit for block4Declared Hybrid Avc', 'hybrid_schedule.php', 'added br tag to error message and avc as changed as limit', 2, 1, NULL, '2022-11-25 17:00:59'),
(20, '2022-11-25', 'NR', 'Internal', 'Battery and Hydro Stroage', 'N.A', 'Updateregister.php,updatModel.php,updateinnerstoragemanagement.php,updatePlantmanagement.php,updateStoragePage.php', 'some new functions and pages are uploaded into server today and update,delete operations are working properly', 2, 1, NULL, '2022-11-25 17:03:47'),
(21, '2022-11-25', 'NR', 'Internal', 'Register', 'Ne Implentation', 'nav_bar.php,registerViews->storageManagement.php,registerViews->plantManagement.php,RegisterController.php,RegisterModel.php,', 'New developed', 2, 1, NULL, '2022-11-26 18:09:06'),
(22, '2022-11-25', 'NR', 'Internal', 'Update', 'New Implementation', 'nav_bar.php,updateRegisterViews->updateinnerstoragemanagement.php,updateRegisterViews->updatePlantmanagement.php,updateRegisterViews->updateStoragePage.php,updateregister.php,updatemodel.php', 'new Methods are added and uploaded into git local', 2, 1, NULL, '2022-11-26 18:12:55'),
(23, '2022-11-28', 'SR', 'Internal', 'Pos & Utility', '\"1)When capacity field is updated with characters success message is displayed but  a)when 10@13 is entered it is storing 10. b)When @10 is entered it is storing 0. c)When 10@ is entered it is storing 10. 2)Capacity is updating for negative value.\"', 'updateregister.php', 'Few lines of code was added for negative value validation', 2, 1, NULL, '2022-11-28 18:02:08'),
(24, '2022-11-28', 'SR', 'Internal', 'POS_UTILITY UPDATE', 'For update in POS & UTILITY log is not created.', 'updateregister.php', 'Few lines of code was added for creating logs', 2, 1, NULL, '2022-11-28 18:03:21'),
(25, '2022-11-28', 'SR', 'Internal', 'Manual file upload', 'File is not uploaded and contract is not created but proper error message is not displayed', 'registerController.php', 'added some conditions for contract creations of MBAS', 2, 1, NULL, '2022-11-28 18:07:18'),
(26, '2022-11-28', 'SR', 'Internal', 'INTERNAL>PX REPORT', 'MBAS_HPX exchange type is  not displayed', 'schedulereportcontroller.php,schedulereportmodel.php', 'some modifications are added into exsting method', 2, 1, NULL, '2022-11-28 18:09:24'),
(27, '2022-11-28', 'SR', 'Internal', 'INTERNAL>POS WISE REPORT', 'ID it is coming for DA even if we select R16 revision it is not displaying values', 'schedulereportcontroller.php,schedulereportModel.php', 'few lines of code was added for modification', 2, 1, NULL, '2022-11-28 18:10:26'),
(28, '2022-11-28', 'SR', 'Internal', 'EXTERNAL>POS WISE REPORT', 'ID it is coming for DA even if we select R16 revision it is not displaying values', 'schedulereportcontroller.php,scheduleReoprtmodel.php', 'few changes are did in existing methods', 2, 1, NULL, '2022-11-28 18:11:39'),
(29, '2022-11-28', 'SR', 'Internal', 'INTERNAL>Reports>Schedule Based Reports>Schedule entity wise report>', 'MBAS_HPX  contracts are  available but DA option is not there in the dropdown .For DA if we select  R16 data it is showing values', 'schedulereportcontroller.php', 'some lines of code added to existing methods', 2, 1, NULL, '2022-11-28 18:12:40'),
(30, '2022-12-07', 'SR', 'EXTERNAL', 'Contract Management', 'While Loding Contract Management Page POS are not loading', 'Internal Tool\r\n/.Registermodel,php', 'added New Method get_all_rtm_pos_names_basedonSE in the model', 2, 1, NULL, '2022-12-07 17:53:06'),
(31, '2022-12-07', 'NR', 'Internal', 'BAttery And Hydro', 'View Level Changes and controller also', 'storageManagement.php\r\nregisterController.php\r\nupdateinnerstoragemanagement.php\r\nupdateStoragePage.php', 'Added Some javascript validation and text changes for functionality and in controller also all validations given what we given in js', 2, 1, NULL, '2022-12-07 17:55:52'),
(32, '2022-12-07', 'NR', 'Internal', 'POS AND SE Map', 'functionality failed to handle the hybrid implementation', 'RegisterController.php', 'in the controller i modified the 2 methods to solve the issue', 2, 1, NULL, '2022-12-07 17:57:56'),
(33, '2022-12-07', 'NR', 'Internal', 'Update POS ans SE MAP', 'while updating the POS and SE the sum of the POS installed capacity is getting null ', 'registercontroller.php\r\nUpdateregister.php', 'Some modifications are added to existing methods', 2, 1, NULL, '2022-12-07 17:59:34'),
(35, '2022-12-12', 'NR', 'Internal', 'Contract Management', 'Submitting the form the data is not inserting into db', 'registerController.php', 'undefined variable was passed to excute the query and for this reason transaction was getting failure.', 2, 1, '2022-12-12 12:50:10', '2022-12-12 12:41:44'),
(36, '2022-12-12', 'NR', 'internal', 'contract management', 'Log in not creating', 'registercontroller.php', 'added log creation code to the respective method saveContractManagement() Method', 2, 1, NULL, '2022-12-12 12:43:12'),
(37, '2022-12-12', 'NR', 'internal', 'update contract management', 'In view page after clicking update button the update form will open in model and declaration and withdrawal input options(yes/no) repeating twice', 'updatecontractmanagement.php under updateregisterviews', 'condtionally added the options in based on field value', 2, 1, '2022-12-12 13:08:16', '2022-12-12 12:46:16'),
(38, '2022-12-13', 'SR', 'External', 'API Reading', 'When we try to create contract in SRLDC,it is storing in NRLDC_V2 db.', 'config.php', 'in config.php file the json_url was given NR internal tool url so the entires are going to insert in NRLDC_V2.', 1, 1, '2022-12-13 15:43:38', '2022-12-13 15:15:53'),
(39, '2022-12-13', 'GJ', 'External', 'schedule submission', 'mail was going to some one so we commented the CC mail in external tool in App.php and method: send_mail_intraday_pos()', 'App.php', 'Commented the CC mail mihir.lad@reconnectenergy.com,impl.sldc@gmail.com', 2, 1, NULL, '2022-12-13 15:20:33'),
(40, '2022-12-13', 'NR', 'Internal', 'Battery And Hydro', 'TIme Blocks issue', 'storagepage.php in registerviews', 'added 1 function to handle the disable the to time block option in javascript', 2, 1, NULL, '2022-12-13 18:16:45'),
(41, '2022-12-21', 'MH', 'Internal', 'dynamic contract creation', 'new implementation', 'dynamicController.php', 'new controller was created for this implentation', 2, 1, NULL, '2022-12-22 16:58:11'),
(42, '2023-01-02', 'NR', 'Internal', 'Schedule Submission by template', 'new implmentation', 'Controllers->excell.php->getPOSbasedonrevision(),\r\nViews->scheduleViews->schedule_manage.php', 'while loading the poses selection are based on energy type ', 2, 1, NULL, '2023-01-02 12:25:24'),
(43, '2023-01-02', 'NR', 'Internal', 'Schedule Submission by template', 'New Implmentation for entries will happen in new tables', 'registercontroller.php->saveCsvData()', 'i create 3 tables of 2023 for schedule submission in internal and schedules are happening based on the current year and schedule for data', 2, 1, NULL, '2023-01-02 18:18:28'),
(44, '2023-01-02', 'NR', 'Internal', 'schedule generarion', 'changing the table names while retrieving the data for schedule generation', 'Controllers->scheduleGenerationController.php\r\nModels->RegisterModel.php', 'while retrieving the data 1 condition we need to add in register model', 1, 1, NULL, '2023-01-02 18:20:31'),
(45, '2023-01-03', 'NR', 'Internal', 'Final submission', 'new implmentation was started and its going on with new tables', 'scheduleGenerationController.php\r\nregisterModel.php', 'NA', 1, 1, NULL, '2023-01-03 13:07:04'),
(46, '2023-01-03', 'NR', 'Internal', 'Schedule Generation', 'new data loading with new tables', 'scheduleGenerationController.php', 'now data was loading based on current year', 2, 1, NULL, '2023-01-03 13:09:18'),
(47, '2023-01-18', 'NR', 'internal', 'STOA Manula file upload', 'data validation and message change', 'controller->registerController.php->saveStoaContractDetails()', 'Added the date validation and added new lines of code was written and comment also added to methods', 2, 1, NULL, '2023-01-19 05:38:57'),
(48, '2023-03-23', 'NR', 'INTERNAL', 'Update POS & SE', 'WBES and wrpc validation', 'updateregister.php', 'added new line', 2, 1, NULL, '2023-03-23 12:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `dob` varchar(11) NOT NULL,
  `doj` varchar(11) NOT NULL,
  `blood_group` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `id_proof` varchar(100) DEFAULT NULL,
  `proofimg` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `insert_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `designation`, `dob`, `doj`, `blood_group`, `email`, `phone`, `address`, `id_proof`, `proofimg`, `status`, `updated`, `insert_date`) VALUES
(1, 'sateesh', 'php developer', '11-12-1996', '02-02-2019', 'b+ve', 'sateesh@gmail.com', '7410258963', 'palasa srikakulam ap', NULL, '1640794727.jpeg', 1, NULL, '2021-12-28 23:33:10'),
(2, 'ajay', 'engineer', '21-08-1992', '05-03-2017', 'a+ve', 'ajay@gmail.com', '7410258963', 'patancheru hyderabad', NULL, '1640794727.jpeg', 1, NULL, '2021-12-29 19:23:32'),
(3, 'sateesh', 'software engineer', '2021-12-30', '2021-12-31', 'b+ve', 'sat@gmail.com', '7410258963', 'hyderabad', '1', '1640794727.jpeg', 1, NULL, '2021-12-29 21:48:47'),
(4, 'ravi', 'team lead', '2003-06-11', '2021-12-29', 'aVe-', 'ravi@gmail.com', '7410258963', 'srikakulam ap', '2', '1640794867.jpeg', 1, NULL, '2021-12-29 21:51:07'),
(5, 'prabhakar', 'data analyst', '1995-12-31', '2019-05-11', 'o+Ve', 'prabhakar@gmail.com', '7896541230', 'kphb colony 3rd phase', '3', '1640794960.jpeg', 1, NULL, '2021-12-29 21:52:40'),
(6, 'rajesh', 'programmer', '1997-12-16', '2020-12-11', 'o-ve', 'rajesh@gmail.com', '9630258741', 'vizianagaram andhra pradesh', '1', '1640795017.jpeg', 1, NULL, '2021-12-29 21:53:37'),
(7, 'ramesh', 'mentor', '2002-02-25', '2019-02-20', 'ab+ve', 'ramesh@gmail.com', '8520147963', 'bobbili vizianagaram andhra pradesh', '2', '1640795079.jpeg', 1, NULL, '2021-12-29 21:54:39'),
(8, 'jeevan', 'software tester', '1996-08-15', '2017-08-20', 'o+ve', 'jeevan@gmail.com', '9874563210', 'viziangaram kottavalasa ap', '3', '1640795133.jpeg', 1, NULL, '2021-12-29 21:55:33'),
(9, 'ashok', 'software engineer', '1995-05-15', '2017-01-02', 'ab-ve', 'ashok@gmail.com', '6541230987', 'icchapur andhra pradesh', '1', '1640795182.jpeg', 1, '2022-10-22 22:07:12', '2021-12-29 21:56:22'),
(10, 'vignesh', 'store keeper', '1995-11-14', '2018-07-15', 'a-ve', 'vignesg@gmail.com', '8412697130', 'amudalavalasa srikakulam ap', '2', '1640795267.jpeg', 1, NULL, '2021-12-29 21:57:47'),
(11, 'revathi', 'hr', '1997-03-23', '2020-04-05', 'a+ve', 'revathi@gmail.com', '9601235874', 'pathatekkali vishkapatnam', '3', '1640795337.jpeg', 1, NULL, '2021-12-29 21:58:57'),
(12, 'uma', 'hr department md', '1995-01-02', '2019-05-07', 'o-ve', 'uma@gmail.com', '7456981230', 'proddutur kapada', '1', '1640795404.jpeg', 1, NULL, '2021-12-29 22:00:04'),
(13, 'sundar', 'angular developer', '1995-08-21', '2015-05-02', 'ab+ve', 'sundar@gmail.com', '9652874103', 'kakinda west godavari ap', '3', '1640795469.jpeg', 1, NULL, '2021-12-29 22:01:09'),
(14, 'hemanth', 'php developer', '1995-07-15', '2017-03-06', 'b-ve', 'hemanth@gmail.com', '9874563210', 'rajam rajastan', '2', '1640795521.jpeg', 1, NULL, '2021-12-29 22:02:01'),
(15, 'parvathi', 'software analyst', '2000-04-04', '2020-02-05', 'b+ve', 'parvathi@gmail.com', '7896541320', 'pendurthi andhra pradesh', '3', '1640795597.jpeg', 1, '2021-12-30 00:00:33', '2021-12-29 22:03:17'),
(16, 'subbalaxmi', 'programmer', '1994-09-01', '2019-06-07', 'b+ve', 'subbalaxmi@gmail.com', '6541230987', 'pondur srikakulam ap', '1', '1640795658.jpeg', 1, NULL, '2021-12-29 22:04:18'),
(17, 'rakesh', 'planner', '1995-05-25', '2018-01-05', 'a-ve', 'rakesh@gmail.com', '9630258741', 'vizianagaram andhra pradesh', '2', '1640795709.jpeg', 1, '2021-12-30 13:56:45', '2021-12-29 22:05:09'),
(18, 'chetana', 'java developer', '1997-12-08', '2019-02-05', 'ab-ve', 'chetana@gmail.com', '7458963210', 'delhi india', '1', '1640795782.jpeg', 1, NULL, '2021-12-29 22:06:22'),
(19, 'rajulu', 'nodejs developer', '1997-05-15', '2019-04-01', 'b+ve', 'rajulu@gmail.com', '9561023784', 'pune india', '2', '1640795841.jpeg', 1, '2022-10-25 20:20:59', '2021-12-29 22:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `database_name` varchar(100) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `query` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `updated` datetime DEFAULT NULL,
  `now` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `database_name`, `table_name`, `query`, `status`, `updated`, `now`) VALUES
(1, 'WRLDC', 'RTM_POS_DETAILS', 'CREATE TABLE `RTM_POS_DETAILS` (\r\n  `sl` int(6) NOT NULL AUTO_INCREMENT,\r\n  `pos_id` varchar(45) NOT NULL,\r\n  `declaration` varchar(10) DEFAULT NULL,\r\n  `declaration_date` date DEFAULT NULL,\r\n  `last_update_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\r\n  `withdraw` varchar(10) DEFAULT NULL,\r\n  PRIMARY KEY (`sl`)\r\n)', 1, NULL, '2022-11-10 15:32:42'),
(2, 'WRLDC', 'Api_Logs', 'CREATE TABLE `Api_Logs` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `date` date NOT NULL,\r\n  `message` text NOT NULL,\r\n  `status` varchar(24) DEFAULT NULL,\r\n  `uploaded_timestamp` datetime DEFAULT NULL,\r\n  `contract_type` varchar(24) NOT NULL,\r\n  `exchange_type` varchar(24) NOT NULL,\r\n  PRIMARY KEY (`sl_no`)\r\n)', 1, NULL, '2022-11-10 15:33:25'),
(3, 'NRLDC_V2', 'DATA_INJECTION_DRWAL_LINK', 'CREATE TABLE DATA_INJECTION_DRWAL_LINK (\r\nsl_no int(11) NOT NULL AUTO_INCREMENT,\r\nINJECTION_CONTRACT_ID varchar(200) NOT NULL,\r\nDRAWAL_CONTRACT_ID varchar(200),\r\nactive_status int(11) NOT NULL DEFAULT 1,\r\nuploaded_timestamp datetime DEFAULT NULL,\r\nPRIMARY KEY (sl_no));\r\ndesc DATA_INJECTION_DRWAL_LINK;', 1, NULL, '2022-11-22 14:56:15'),
(4, 'NRLDC_V2', 'RSM_CONTRACT_DETAILS', 'ALTER TABLE RSM_CONTRACT_DETAILS\r\nADD INJECTION_TYPE varchar(200) NOT NULL;', 1, NULL, '2022-11-22 15:48:55'),
(5, 'NRLDC_V3', 'RSM_CONTRACT_DETAILS_HISTORY', 'ALTER TABLE RSM_CONTRACT_DETAILS_HISTORY\r\nADD INJECTION_TYPE varchar(200) NOT NULL;', 1, NULL, '2022-11-22 15:49:39'),
(6, 'NRLDC_V2', 'RSM_CONTRACT_DETAILS', 'ALTER TABLE RSM_CONTRACT_DETAILS MODIFY COLUMN uploaded varchar(1) default 1;', 1, NULL, '2022-12-08 15:28:53'),
(7, 'NRLDC_V2', 'RSM_CONTRACT_DETAILS', 'ALTER TABLE RSM_CONTRACT_DETAILS MODIFY COLUMN  INJECTION_TYPE varchar(16) default INJECTION;', 1, NULL, '2022-12-08 15:30:55'),
(8, 'NRLDC_V2', 'INTERNAL_USER_SCHEDULE_SUBMISSION_MASTER_2023', 'CREATE TABLE `INTERNAL_USER_SCHEDULE_SUBMISSION_MASTER_2023` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `internal_submission_id` varchar(64) NOT NULL,\r\n  `schedule_entity_id` varchar(24) NOT NULL,\r\n  `pos_id` varchar(24) DEFAULT NULL,\r\n  `schedule_submission_type` varchar(24) DEFAULT NULL,\r\n  `schedule_for_date` date NOT NULL,\r\n  `insert_count` int(11) NOT NULL,\r\n  `source_filename` text NOT NULL,\r\n  `logged_in` varchar(24) NOT NULL,\r\n  `last_updated_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=21724 DEFAULT CHARSET=latin1;', 1, NULL, '2022-12-08 15:53:44'),
(9, 'NRLDC_V2', 'INTERNAL_SCHEDULE_CONTRACT_DATA_2023', 'CREATE TABLE `INTERNAL_SCHEDULE_CONTRACT_DATA_2023` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `internal_submission_id` varchar(64) NOT NULL,\r\n  `pos_id` varchar(32) NOT NULL,\r\n  `contract_id` varchar(32) NOT NULL,\r\n  `timestamp` datetime NOT NULL,\r\n  `contract_power` varchar(32) NOT NULL,\r\n  `upload_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=3374157 DEFAULT CHARSET=latin1;', 1, NULL, '2022-12-08 15:55:06'),
(10, 'NRLDC_V2', 'INTERNAL_SCHEDULE_AVC_DATA_2023', '                                        CREATE TABLE `INTERNAL_SCHEDULE_AVC_DATA_2023` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `internal_submission_id` varchar(64) NOT NULL,\r\n  `pos_id` varchar(32) NOT NULL,\r\n  `timestamp` datetime NOT NULL,\r\n  `avc_power` varchar(32) NOT NULL,\r\n  `upload_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=2091609 DEFAULT CHARSET=latin1;                                        ', 1, '2022-12-12 13:26:00', '2022-12-08 15:56:01'),
(11, 'MSLDC_V2', 'RSM_LOGIN_HISTORY', 'create table RSM_LOGIN_HISTORY(sl_no int not null auto_increment,\r\nuser_id varchar(16) not null,\r\ntimestamp datetime  default current_timestamp,\r\nactivity varchar(8) not null,\r\nlast_updatedtimestamp datetime default current_timestamp,\r\nprimary key(sl_no));                                                                                ', 1, NULL, '2022-12-14 12:20:49'),
(12, 'NRLDc_v2', 'APPROVED_SCHEDULE_DATA_2023', 'CREATE TABLE `APPROVED_SCHEDULE_DATA_2023` (\r\n  `sl_no` int(8) NOT NULL AUTO_INCREMENT,\r\n  `contract_id` varchar(24) NOT NULL,\r\n  `timestamp` timestamp NULL DEFAULT NULL,\r\n  `final_power` float NOT NULL,\r\n  `approval_id` varchar(32) NOT NULL,\r\n  PRIMARY KEY (`sl_no`),\r\n  KEY `FK_APPROVED_SCHEDULE_DATA_2023_and_RSM_CONTRACT_DETAILS` (`contract_id`),\r\n  CONSTRAINT `FK_APPROVED_SCHEDULE_DATA_2023_and_RSM_CONTRACT_DETAILS` FOREIGN KEY (`contract_id`) REFERENCES `RSM_CONTRACT_DETAILS` (`contract_id`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=16703 DEFAULT CHARSET=utf8;                                                                                ', 1, NULL, '2023-01-04 06:58:57'),
(13, 'NRLDc_v2', 'APPROVAL_MASTER_DETAILS_2023', 'CREATE TABLE `APPROVAL_MASTER_DETAILS_2023` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `approval_id` varchar(32) NOT NULL,\r\n  `sch_impl_for_date` date NOT NULL,\r\n  `sch_gen_type` varchar(16) NOT NULL,\r\n  `logged_in` varchar(32) NOT NULL,\r\n  `last_updated_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\r\n  `reason` varchar(50) DEFAULT NULL,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1                                                                                ', 1, NULL, '2023-01-04 07:01:34'),
(14, 'NRLDC_V2', 'RSM_OBLIGATION_LIMIT_2023', 'CREATE TABLE `RSM_OBLIGATION_LIMIT_2023` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `from_time_block` text NOT NULL,\r\n  `to_time_block` text NOT NULL,\r\n  `limit_type` varchar(100) NOT NULL,\r\n  `obligation_limit` varchar(100) NOT NULL,\r\n  `consecutive_block` varchar(100) NOT NULL,\r\n  `mandatory_time_blocks` varchar(100) NOT NULL,\r\n  `uploaded_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,\r\n  `status` int(11) DEFAULT 1,\r\n  `contract_id` varchar(200) NOT NULL,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=1680 DEFAULT CHARSET=latin1;', 1, NULL, '2023-01-05 11:46:27'),
(15, 'NRLDC_V2', 'RSM_OBLIGATION_LIMIT', 'CREATE TABLE `RSM_OBLIGATION_LIMIT` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `from_time_block` text NOT NULL,\r\n  `to_time_block` text NOT NULL,\r\n  `limit_type` varchar(100) NOT NULL,\r\n  `obligation_limit` varchar(100) NOT NULL,\r\n  `consecutive_block` varchar(100) NOT NULL,\r\n  `mandatory_time_blocks` varchar(100) NOT NULL,\r\n  `uploaded_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,\r\n  `status` int(11) DEFAULT 1,\r\n  `contract_id` varchar(200) NOT NULL,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=1680 DEFAULT CHARSET=latin1                                                                                ', 1, NULL, '2023-01-05 11:47:56'),
(16, 'NRLDC_V2', 'DATA_INJECTION_WITHDRAWAL_LINK', 'CREATE TABLE `DATA_INJECTION_WITHDRAWAL_LINK` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `injection_approval_num` text NOT NULL,\r\n  `withdrawal_approval_num` text NOT NULL,\r\n  `uploaded_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,\r\n  `active_status` int(11) DEFAULT 1,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1', 1, NULL, '2023-01-05 11:48:47'),
(17, 'NRLDC_V2', 'DATA_INJECTION_WITHDRAWAL_LINK_2023', 'CREATE TABLE `DATA_INJECTION_WITHDRAWAL_LINK_2023` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `injection_approval_num` text NOT NULL,\r\n  `withdrawal_approval_num` text NOT NULL,\r\n  `uploaded_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,\r\n  `active_status` int(11) DEFAULT 1,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;                                                                                ', 1, NULL, '2023-01-05 11:50:34'),
(18, 'NRLDC_V2', 'DATA_INJECTION_WITHDRAWAL_LINK_HISTORY', 'CREATE TABLE `DATA_INJECTION_WITHDRAWAL_LINK_HISTORY` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `injection_approval_num` text NOT NULL,\r\n  `withdrawal_approval_num` text NOT NULL,\r\n  `uploaded_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,\r\n  `active_status` int(11) DEFAULT 1,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1                                                                                ', 1, NULL, '2023-01-05 14:30:33'),
(19, 'NRLDC_V2', 'RSM_OBLIGATION_LIMIT_HISTORY', 'CREATE TABLE `RSM_OBLIGATION_LIMIT_HISTORY` (\r\n  `sl_no` int(11) NOT NULL AUTO_INCREMENT,\r\n  `from_time_block` text NOT NULL,\r\n  `to_time_block` text NOT NULL,\r\n  `limit_type` varchar(100) NOT NULL,\r\n  `obligation_limit` varchar(100) NOT NULL,\r\n  `consecutive_block` varchar(100) NOT NULL,\r\n  `mandatory_time_blocks` varchar(100) NOT NULL,\r\n  `uploaded_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,\r\n  `status` int(11) DEFAULT 1,\r\n  `contract_id` varchar(200) NOT NULL,\r\n  PRIMARY KEY (`sl_no`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=1680 DEFAULT CHARSET=latin1', 1, NULL, '2023-01-05 14:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1=>super admin,2=>admin,3=>user',
  `name` varchar(100) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` int(11) NOT NULL COMMENT '1=>male,2=>female,3=>others',
  `date_of_birth` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_picture` varchar(64) DEFAULT NULL,
  `signature` varchar(64) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `updated` datetime DEFAULT NULL,
  `insert_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `mobile`, `email`, `address`, `gender`, `date_of_birth`, `password`, `profile_picture`, `signature`, `status`, `updated`, `insert_date`) VALUES
(1, 1, 'Super Admin', '9999999999', 'superadmin@gmail.com', 'palasa srikakulam andhra pradesh', 1, '2021-12-03', 'a01610228fe998f515a72dd730294d87', '1640797559.jpeg', '1640797559.png', 1, '2022-10-25 20:19:21', '2021-12-28 12:50:30'),
(2, 5, 'Admin', '8888888888', 'admin@gmail.com', 'kphb hyderabad telangna', 2, '2021-12-02', 'a01610228fe998f515a72dd730294d87', '1640852169432.png', '1640852169.jpeg', 1, '2021-12-30 13:46:21', '2021-12-28 12:50:30'),
(3, 1, 'sateesh', '7993609859', 'sangaru.satti@gmail.com', 'palasa srikakulam ', 1, '2000-08-21', 'a01610228fe998f515a72dd730294d87', '1640793666.png', '1640793665.png', 1, '2022-10-22 22:09:01', '2021-12-28 17:07:16'),
(4, 3, 'ndnd', '7993609859', 'sangaru.sateesh@gmail.com', 'rssrsrsrh', 1, '2021-12-16', '', NULL, NULL, 1, '2021-12-30 10:41:20', '2021-12-28 17:09:55'),
(5, 3, 'ravik', '7896541230', 'ravik@gmail.com', 'srikakulam andhra pradesh', 1, '1996-05-21', '', '1640839230625.png', '1640839230.jpeg', 1, '2021-12-30 10:21:49', '2021-12-29 23:30:31'),
(6, 3, 'sample@gmail.com', '7896541230', 'sample@gmail.com', 'dilsuknagar hyderabad', 2, '1994-12-02', '', NULL, NULL, 1, '2021-12-30 10:43:29', '2021-12-30 10:42:20'),
(7, 3, 'test', '9874563210', 'test@gmail.com', 'thane mumbai maharastra', 1, '1993-08-15', '', NULL, NULL, 1, '2021-12-30 10:43:25', '2021-12-30 10:43:14'),
(8, 3, 'madhu', '9630852147', 'madhu@gmail.com', 'kota rajastan', 2, '1997-05-21', '', NULL, NULL, 1, '2021-12-30 10:46:25', '2021-12-30 10:44:20'),
(9, 3, 'satya', '6985231470', 'satya@gmail.com', 'kolkata west bengal', 2, '1998-05-04', '', NULL, NULL, 1, '2021-12-30 10:46:23', '2021-12-30 10:45:15'),
(10, 3, 'satyachin', '7539142806', 'satyachin@gmail.com', 'vishakapatnam andhra pradesh', 1, '1995-12-05', '', NULL, NULL, 1, '2021-12-30 10:46:20', '2021-12-30 10:46:10'),
(11, 3, 'samba', '9876543210', 'samba@gmail.com', 'leh j&k india', 1, '1998-12-05', '', NULL, NULL, 0, '2022-10-22 22:03:27', '2021-12-30 10:47:19'),
(12, 3, 'yogi', '7893210456', 'yogi@gmail.com', 'vizianagaram andhra pradesh', 2, '1997-02-14', '', NULL, NULL, 1, '2021-12-30 10:48:17', '2021-12-30 10:48:08'),
(13, 3, 'rajulu', '7410258963', 'rajulu@gmail.com', 'palasa srikakulam ap', 2, '1995-09-15', '', '1640841736951.png', '1640841736.png', 1, '2021-12-30 13:43:41', '2021-12-30 10:52:16'),
(14, 3, 'sem', '9841702635', 'sem@gmail.com', 'kphb hyderabad', 1, '2000-05-15', '', NULL, NULL, 0, NULL, '2021-12-30 13:31:04'),
(15, 3, 'sem', '9841702635', 'sem1@gmail.com', 'kphb hyderabad', 1, '2000-05-15', '', NULL, NULL, 1, '2021-12-30 13:44:52', '2021-12-30 13:31:21'),
(16, 3, 'sem', '9841702635', 'sem12@gmail.com', 'kphb hyderabad', 1, '2000-05-15', '', NULL, NULL, 1, '2021-12-30 13:44:50', '2021-12-30 13:34:27'),
(18, 3, 'sem', '9841702635', 'sem1234@gmail.com', 'kphb hyderabad', 1, '2000-05-15', '', NULL, NULL, 1, '2021-12-30 13:52:17', '2021-12-30 13:36:46'),
(19, 3, 'testing', '789654132', 'testing@gmail.com', 'testing softwares', 2, '2000-05-15', '', '1640852075818.jpeg', '1640852075.png', 0, '2021-12-30 13:45:03', '2021-12-30 13:44:35'),
(20, 3, 'sateesh kumar', '1234567890', '1234567@gmail.com', 'qwertyuio', 1, '2012-11-01', 'a01610228fe998f515a72dd730294d87', NULL, NULL, 1, NULL, '2022-11-07 19:08:49'),
(21, 3, 'sateesh kumar', '1234567890', '1234567@gmail.com', 'qwertyuio', 1, '2012-11-01', 'a01610228fe998f515a72dd730294d87', NULL, NULL, 1, NULL, '2022-11-07 19:08:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_updates`
--
ALTER TABLE `daily_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_updates`
--
ALTER TABLE `daily_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
