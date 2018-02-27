-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2017 at 11:37 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wingsofi_aoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminsitepages`
--

CREATE TABLE `adminsitepages` (
  `adminsitepages_id` int(11) NOT NULL,
  `adminsitepages_name` varchar(255) NOT NULL,
  `adminsitepages_mainmenuname` varchar(255) NOT NULL,
  `adminsitepages_url` varchar(255) NOT NULL,
  `adminsitepages_enabled` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminsitepages`
--

INSERT INTO `adminsitepages` (`adminsitepages_id`, `adminsitepages_name`, `adminsitepages_mainmenuname`, `adminsitepages_url`, `adminsitepages_enabled`) VALUES
(1, 'Main Panel Page', 'Home', 'panel.php', 'e'),
(2, 'Slider > View Slider', 'Slider', 'slider.php', 'e'),
(3, 'Global Swap', 'Global', 'action-swapper.php', 'e'),
(4, 'Global Move to Top', 'Global', 'action-moveToTop.php', 'e'),
(5, 'Global Enable / Disable', 'Global', 'action-enabledisable.php', 'e'),
(6, 'Global Delete', 'Global', 'action-delete.php', 'e'),
(7, 'Slider > View Slider Detail', 'Slider', 'detail-slider.php', 'e'),
(8, 'Slider > Edit / Create Slider', 'Slider', 'action-slider.php', 'e'),
(9, 'Product Class > View Product Class', 'Product Class', 'productclass.php', 'e'),
(10, 'Administrator > View Access Level', 'Administrator', 'rights.php', 'e'),
(11, 'Administrator > View Access Rights', 'Administrator', 'detail-rights.php', 'e'),
(12, 'Administrator > Edit Access Rights', 'Administrator', 'action-rights.php', 'e'),
(13, 'Administrator > View Access Level Detail', 'Administrator', 'detail-accesslevel.php', 'e'),
(14, 'Product Class > View Product Class Detail', 'Product Class', 'detail-productclass.php', 'e'),
(15, 'Product Class > Edit / Create Product Class', 'Product Class', 'action-productclass.php', 'e'),
(16, 'Product Category > View Product Category', 'Product Category', 'productcategory.php', 'e'),
(17, 'Product Category > View Product Category Detail', 'Product Category', 'detail-productcategory.php', 'e'),
(18, 'Product Category > Edit / Create Product Category', 'Product Category', 'action-productcategory.php', 'e'),
(19, 'Administrator > Create Access Level', 'Administrator', 'action-accesslevel.php', 'e'),
(20, 'Product Type > View Product Type', 'Product Type', 'producttype.php', 'e'),
(21, 'Product Type > View Product Type Detail', 'Product Type', 'detail-producttype.php', 'e'),
(22, 'Product Type > Edit / Create Product Type', 'Product Type', 'action-producttype.php', 'e'),
(23, 'Product > View Product', 'Product', 'product.php', 'e'),
(24, 'Product > View Product Detail', 'Product', 'detail-product.php', 'e'),
(25, 'Product Brand > View Product Brand', 'Product Brand', 'productbrand.php', 'e'),
(26, 'Product Brand > View Product Brand Detail', 'Product Brand', 'detail-productbrand.php', 'e'),
(27, 'Product Brand > Edit / Create Product Brand', 'Product Brand', 'action-productbrand.php', 'e'),
(28, 'Product > Edit / Create Product', 'Product', 'action-product.php', 'e'),
(29, 'Product > Image List Detail', 'Product', 'detail-imagelist.php', 'e'),
(30, 'Product > Edit / Create Image List', 'Product', 'action-imagelist.php', 'e'),
(31, 'Product > Set Featured', 'Product', 'action-statusswitch.php', 'e'),
(32, 'Promo > View Promo', 'Promo', 'promo.php', 'e'),
(33, 'Promo > View Promo Detail', 'Promo', 'detail-promo.php', 'e'),
(34, 'Promo > Edit / Create Promo', 'Promo', 'action-promo.php', 'e'),
(35, 'User > View User', 'User', 'user.php', 'e'),
(36, 'User > View User Detail', 'User', 'detail-user.php', 'e'),
(37, 'User > Edit / Create User', 'User', 'action-user.php', 'e'),
(38, 'Bank > View Bank', 'Bank', 'bank.php', 'e'),
(39, 'Bank > View Bank Detail', 'Bank', 'detail-bank.php', 'e'),
(40, 'Bank > Edit / Create Bank', 'Bank', 'action-bank.php', 'e'),
(41, 'Purchase > View Purchase', 'Purchase', 'purchase.php', 'e'),
(42, 'Purchase > View Purchase Detail', 'Purchase', 'detail-purchase.php', 'e'),
(43, 'Purchase > Edit Purchase', 'Purchase', 'action-purchase.php', 'e'),
(44, 'Site Data > View Site Data', 'Site Data', 'sitedata.php', 'e'),
(45, 'Site Data > View Site Data Details', 'Site Data', 'detail-sitedata.php', 'e'),
(46, 'Site Data > Edit Site Data', 'Site Data', 'action-sitedata.php', 'e'),
(47, 'Administrator > Edit / Create Admin List', 'Administrator', 'action-adminlist.php', 'e'),
(48, 'Administrator > View Admin List Details', 'Administrator', 'detail-adminlist.php', 'e'),
(49, 'Administrator > View Admin List', 'Administrator', 'adminlist.php', 'e'),
(50, 'Global Overview', 'Global', 'overview.php', 'e'),
(51, 'Product Group > View Product Group', 'Product Group', 'productgroup.php', 'e'),
(52, 'Product Group > View Product Group Detail', 'Product Group', 'detail-productgroup.php', 'e'),
(53, 'Product Group > Edit / Create Product Group', 'Product Group', 'action-productgroup.php', 'e'),
(54, 'Subscriber > View Subscriber', 'Subscriber', 'subscriber.php', 'e'),
(55, 'Subscriber > View Subscriber Detail', 'Subscriber', 'detail-subscriber.php', 'e'),
(56, 'Subscriber > Edit Subscriber', 'Subscriber', 'action-subscriber.php', 'e'),
(57, 'Purchase > Process Purchase', 'Purchase', 'action-confirmpurchase.php', 'e'),
(58, 'Shipping > View Shipping', 'Shipping', 'shipping.php', 'e'),
(59, 'Shipping > View Shipping Details', 'Shipping', 'detail-shipping.php', 'e'),
(60, 'Shipping > Edit / Create Shipping', 'Shipping', 'action-shipping.php', 'e'),
(61, 'News > View News', 'News', 'news.php', 'e'),
(62, 'News > View News Details', 'News', 'detail-news.php', 'e'),
(63, 'News > Edit / Create News', 'News', 'action-news.php', 'e'),
(64, 'User > View Credit History', 'User', 'creditHistory.php', 'e'),
(65, 'Gallery > View Gallery', 'Gallery', 'gallery.php', 'e'),
(66, 'Gallery > View Gallery Details', 'Gallery', 'detail-gallery.php', 'e'),
(67, 'Gallery > Edit / Create Gallery', 'Gallery', 'action-gallery.php', 'e'),
(68, 'Global Remove Image', 'Global', 'action-removeimage.php', 'e'),
(69, 'Global Multi Check Function', 'Global', 'action-multicheck.php', 'e'),
(70, 'Testimonial > View Testimonial', 'Testimonial', 'testimonial.php', 'e'),
(71, 'Testimonial > View Testimonial Details', 'Testimonial', 'detail-testimonial.php', 'e'),
(72, 'Testimonial > Edit / Create Testimonial', 'Testimonial', 'action-testimonial.php', 'e'),
(73, 'Promo > Create Bulk Promo', 'Promo', 'action-bulkpromo.php', 'e'),
(74, 'Promo > Edit Bulk Promo', 'Promo', 'detail-bulkpromo.php', 'e'),
(75, 'Advertising > View Advertising', 'Advertising', 'advertising.php', 'e'),
(76, 'Advertising > View Advertising Details', 'Advertising', 'detail-advertising.php', 'e'),
(77, 'Advertising > Edit / Create Advertising', 'Advertising', 'action-advertising.php', 'e'),
(78, 'News > View News Author', 'News', 'newsauthor.php', 'e'),
(79, 'News > View News Author Detail', 'News', 'detail-newsauthor.php', 'e'),
(80, 'News > Edit / Create News Author', 'News', 'action-newsauthor.php', 'e'),
(81, 'Purchase > Truncate', 'Purchase', 'action-truncate.php', 'e'),
(82, 'Return > View Returns', 'Return', 'return.php', 'e'),
(83, 'Return > View Return Details', 'Return', 'detail-return.php', 'e'),
(84, 'Administrator > View Access Rights Detail', 'Administrator', 'detail-rightspages.php', 'e'),
(85, 'Global View Profile', 'Global', 'detail-editprofile.php', 'e'),
(86, 'Global Edit Profile', 'Global', 'action-editprofile.php', 'e'),
(87, 'Lookbook > View Lookbook', 'Lookbook', 'lookbook.php', 'e'),
(88, 'Lookbook > View Lookbook Detail', 'Lookbook', 'detail-lookbook.php', 'e'),
(89, 'Lookbook > Edit / Create Lookbook', 'Lookbook', 'action-lookbook.php', 'e'),
(90, 'Lookbook > Edit / Create Lookbook Image', 'Lookbook', 'action-imagelookbook.php', 'e'),
(91, 'Lookbook > View Lookbook Image', 'Lookbook', 'detail-imagelookbook.php', 'e'),
(92, 'Product > Product Sold Detail', 'Product', 'detail-productsold.php', 'e'),
(93, 'Product > Edit Product Sold Status', 'Product', 'action-productsold.php', 'e'),
(94, 'Global Image Editor', 'Global', 'action-imageeditor.php', 'e'),
(95, 'Social Enterprises > View Social Enterprises', 'Social Enterprises', 'startup.php', 'e'),
(96, 'Transaction > View Transaction', 'Transaction', 'transaction.php', 'e'),
(97, 'Transaction > View Transaction Detail', 'Transaction', 'detail-transaction.php', 'e'),
(98, 'Transaction > Edit Transaction Detail', 'Transaction', 'action-transaction.php', 'e'),
(99, 'Transaction > View Transaction List', 'Transaction', 'transactionlist.php', 'e'),
(100, 'Transaction > View Transaction List Detail', 'Transaction', 'detail-transactionlist.php', 'e'),
(101, 'Transaction > Edit Transaction List Detail', 'Transaction', 'action-transactionlist.php', 'e'),
(102, 'Social Enterprises > Detail Social Enterprises', 'Social Enterprises', 'detail-startup.php', 'e'),
(103, 'Social Enterprises > Edit Social Enterprises', 'Social Enterprises', 'action-startup.php', 'e'),
(105, 'Repayment > View Repayment List', 'Repayment', 'repaymentlist.php', 'e'),
(104, 'Repayment > View Repayment', 'Repayment', 'repayment.php', 'e');

-- --------------------------------------------------------

--
-- Table structure for table `adminuseraccess`
--

CREATE TABLE `adminuseraccess` (
  `adminuseraccess_id` int(11) NOT NULL,
  `adminuserlevel_id` int(11) NOT NULL,
  `adminsitepages_id` int(11) NOT NULL,
  `adminuseraccess_enabled` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminuseraccess`
--

INSERT INTO `adminuseraccess` (`adminuseraccess_id`, `adminuserlevel_id`, `adminsitepages_id`, `adminuseraccess_enabled`) VALUES
(1, 100, 1, 'e'),
(2, 100, 2, 'e'),
(3, 100, 3, 'e'),
(4, 100, 4, 'e'),
(5, 100, 5, 'e'),
(6, 100, 6, 'e'),
(7, 100, 7, 'e'),
(8, 100, 8, 'e'),
(9, 100, 10, 'e'),
(10, 100, 11, 'e'),
(11, 100, 12, 'e'),
(12, 100, 13, 'e'),
(13, 100, 9, 'e'),
(14, 100, 14, 'e'),
(15, 100, 15, 'e'),
(16, 100, 18, 'e'),
(17, 100, 16, 'e'),
(18, 100, 17, 'e'),
(19, 100, 19, 'e'),
(20, 100, 21, 'e'),
(21, 100, 20, 'e'),
(22, 100, 22, 'e'),
(23, 100, 23, 'e'),
(24, 100, 24, 'e'),
(25, 100, 25, 'e'),
(26, 100, 26, 'e'),
(27, 100, 27, 'e'),
(28, 100, 28, 'e'),
(29, 100, 29, 'e'),
(30, 100, 30, 'e'),
(31, 100, 31, 'e'),
(32, 100, 33, 'e'),
(33, 100, 32, 'e'),
(34, 100, 34, 'e'),
(35, 100, 37, 'e'),
(36, 100, 35, 'e'),
(37, 100, 36, 'e'),
(38, 100, 39, 'e'),
(39, 100, 38, 'e'),
(40, 100, 40, 'e'),
(41, 100, 42, 'e'),
(42, 100, 41, 'e'),
(43, 100, 43, 'e'),
(44, 100, 47, 'e'),
(45, 100, 49, 'e'),
(46, 100, 48, 'e'),
(47, 100, 46, 'e'),
(48, 100, 44, 'e'),
(49, 100, 45, 'e'),
(50, 100, 50, 'e'),
(51, 100, 52, 'e'),
(52, 100, 51, 'e'),
(53, 100, 53, 'e'),
(54, 100, 55, 'e'),
(55, 100, 54, 'e'),
(56, 100, 56, 'e'),
(57, 100, 57, 'e'),
(58, 100, 59, 'e'),
(59, 100, 58, 'e'),
(60, 100, 60, 'e'),
(61, 100, 62, 'e'),
(62, 100, 61, 'e'),
(63, 100, 63, 'e'),
(64, 100, 64, 'e'),
(65, 100, 69, 'e'),
(66, 100, 68, 'e'),
(67, 100, 66, 'e'),
(68, 100, 65, 'e'),
(69, 100, 67, 'e'),
(70, 100, 71, 'e'),
(71, 100, 70, 'e'),
(72, 100, 72, 'e'),
(73, 100, 74, 'e'),
(74, 100, 73, 'e'),
(75, 100, 79, 'e'),
(76, 100, 78, 'e'),
(77, 100, 80, 'e'),
(78, 100, 76, 'e'),
(79, 100, 75, 'e'),
(80, 100, 77, 'e'),
(81, 100, 81, 'e'),
(82, 100, 83, 'e'),
(83, 100, 82, 'e'),
(84, 1, 36, 'd'),
(85, 1, 35, 'd'),
(86, 1, 64, 'd'),
(87, 50, 64, 'd'),
(88, 50, 71, 'e'),
(89, 50, 35, 'd'),
(90, 50, 37, 'd'),
(91, 100, 84, 'e'),
(92, 100, 85, 'e'),
(93, 100, 86, 'e'),
(94, 100, 91, 'e'),
(95, 100, 88, 'e'),
(96, 100, 87, 'e'),
(97, 100, 90, 'e'),
(98, 100, 89, 'e'),
(99, 100, 92, 'e'),
(100, 100, 93, 'e'),
(101, 50, 48, 'd'),
(102, 50, 49, 'd'),
(103, 50, 84, 'd'),
(104, 50, 11, 'd'),
(105, 50, 13, 'd'),
(106, 50, 10, 'd'),
(107, 50, 12, 'd'),
(108, 50, 47, 'd'),
(109, 50, 19, 'd'),
(110, 100, 94, 'e'),
(111, 50, 7, 'e'),
(112, 50, 2, 'e'),
(113, 50, 8, 'e'),
(114, 50, 45, 'e'),
(115, 50, 44, 'e'),
(116, 50, 46, 'e'),
(117, 50, 70, 'e'),
(118, 50, 72, 'e'),
(119, 50, 24, 'e'),
(120, 50, 23, 'e'),
(121, 50, 31, 'e'),
(122, 50, 92, 'e'),
(123, 50, 29, 'e'),
(124, 50, 93, 'e'),
(125, 50, 28, 'e'),
(126, 50, 30, 'e'),
(127, 50, 26, 'e'),
(128, 50, 25, 'e'),
(129, 50, 27, 'e'),
(130, 50, 85, 'e'),
(131, 50, 3, 'e'),
(132, 50, 68, 'e'),
(133, 50, 50, 'e'),
(134, 50, 69, 'e'),
(135, 50, 4, 'e'),
(136, 50, 94, 'e'),
(137, 50, 5, 'e'),
(138, 50, 86, 'e'),
(139, 50, 6, 'e'),
(140, 50, 1, 'e'),
(141, 50, 76, 'e'),
(142, 50, 75, 'e'),
(143, 50, 77, 'e'),
(144, 50, 91, 'e'),
(145, 50, 88, 'e'),
(146, 50, 87, 'e'),
(147, 50, 90, 'e'),
(148, 50, 89, 'e'),
(149, 50, 62, 'e'),
(150, 50, 79, 'e'),
(151, 50, 78, 'e'),
(152, 50, 61, 'e'),
(153, 50, 80, 'e'),
(154, 50, 63, 'e'),
(155, 100, 95, 'e'),
(156, 100, 96, 'e'),
(157, 100, 97, 'e'),
(158, 100, 98, 'e'),
(159, 100, 101, 'e'),
(160, 100, 99, 'e'),
(161, 100, 100, 'e'),
(162, 100, 103, 'e'),
(163, 100, 102, 'e'),
(164, 100, 105, 'e'),
(165, 100, 104, 'e');

-- --------------------------------------------------------

--
-- Table structure for table `adminuserlevel`
--

CREATE TABLE `adminuserlevel` (
  `adminuserlevel_id` int(11) NOT NULL,
  `adminuserlevel_entrydate` int(11) NOT NULL,
  `adminuserlevel_editdate` int(11) NOT NULL,
  `adminuserlevel_enabled` varchar(1) NOT NULL,
  `adminuserlevel_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminuserlevel`
--

INSERT INTO `adminuserlevel` (`adminuserlevel_id`, `adminuserlevel_entrydate`, `adminuserlevel_editdate`, `adminuserlevel_enabled`, `adminuserlevel_name`) VALUES
(100, 0, 1489402542, 'e', 'Administrator'),
(50, 0, 1465464828, 'e', 'Site Admin'),
(1, 1335690550, 1424164612, 'd', 'Confirm Payment');

-- --------------------------------------------------------

--
-- Table structure for table `adminuserlogin`
--

CREATE TABLE `adminuserlogin` (
  `adminuserlogin_id` int(11) NOT NULL,
  `adminuserlogin_entrydate` int(11) NOT NULL,
  `adminuserlogin_editdate` int(11) NOT NULL,
  `adminuserlogin_enabled` varchar(1) NOT NULL,
  `adminuserlogin_username` varchar(255) NOT NULL,
  `adminuserlogin_password` varchar(255) NOT NULL,
  `adminuserlevel_id` int(11) NOT NULL,
  `adminuserlogin_image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminuserlogin`
--

INSERT INTO `adminuserlogin` (`adminuserlogin_id`, `adminuserlogin_entrydate`, `adminuserlogin_editdate`, `adminuserlogin_enabled`, `adminuserlogin_username`, `adminuserlogin_password`, `adminuserlevel_id`, `adminuserlogin_image`) VALUES
(1, 0, 1499672719, 'e', 'admin', '21232f297a57a5a743894a0e4a801fc3', 100, '1c4ca4238a0b923820dcc509a6f75849b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_entrydate` int(11) NOT NULL,
  `company_editdate` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_code` varchar(255) NOT NULL,
  `company_website` varchar(255) NOT NULL,
  `company_year` varchar(255) NOT NULL,
  `company_industry` varchar(255) NOT NULL,
  `company_revenue` int(11) NOT NULL,
  `company_impact` varchar(255) NOT NULL,
  `company_interest` varchar(255) NOT NULL,
  `company_mission` varchar(255) NOT NULL,
  `company_probono` varchar(255) NOT NULL,
  `company_newmarket` varchar(255) NOT NULL,
  `company_connection` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_entrydate`, `company_editdate`, `user_id`, `company_name`, `company_code`, `company_website`, `company_year`, `company_industry`, `company_revenue`, `company_impact`, `company_interest`, `company_mission`, `company_probono`, `company_newmarket`, `company_connection`) VALUES
(1, 1477991847, 0, 1, 'hanz', '1han522', 'hansen.com', '0', 'Education and Skills training', 0, '0', 'Clean energy', 'Accessible and affordable health care,Responsible production and consumption', 'desc1', 'desc2', 'desc3'),
(2, 1478067599, 0, 3, 'hansen', '2han278', 'hansen.com', '2016-11-30', 'Fashion, Arts and Handicraft', 0, '22', '', '', '', '', ''),
(3, 1479183686, 0, 4, 'hanzen', '3han390', 'hanzen.com', '2016-11-30', 'Fashion, Arts and Handicraft', 0, 'tester', '', '', '', '', ''),
(4, 1479455311, 0, 5, 'dell corp', '4del668', 'dell.com', '2016-11-30', 'Food and Agriculture', 0, 'banyak', '', '', '', '', ''),
(5, 1480047431, 0, 6, 'ASsdasdfa', '5ASs770', 'asdf.com', '2016-11-23', 'Fashion, Arts and Handicraft', 0, 'asdfasdf', '', '', '', '', ''),
(6, 1484729718, 0, 7, 'hansen', '6han205', 'hansen.com', '2017-01-31', 'Fashion, Arts and Handicraft', 0, '5', '', '', '', '', ''),
(7, 1484729851, 0, 8, 'hansne', '7han781', 'hansen.com', '2017-01-25', 'Fashion, Arts and Handicraft', 0, '6', '', '', '', '', ''),
(8, 1484730257, 0, 9, 'halowww', '8hal234', 'halow.com', '0', 'Finance and Technology', 0, '0', 'Education and Skills training', 'Responsible production and consumption, Skills mastery', 'bono', 'market', 'part'),
(9, 1484730732, 0, 10, 'asdfasdf', '9asd305', 'asdfasd', '0', 'Education and Skills training', 0, '0', 'Education and Skills training', 'Responsible production and consumption, Education', 'asdf', '11111', '22222'),
(10, 1488529815, 0, 17, 'tester', '10tes946', 'tester', '2017-03-29', 'Fashion, Arts and Handicraft', 0, '44', '', '', '', '', ''),
(11, 1489144597, 0, 19, 'asdfasf', '11asd429', 'asdf.com', '2017-03-28', 'Food and Agriculture', 0, '55', '', '', '', '', ''),
(12, 1489144815, 0, 20, 'hanszen', '12han997', 'asldkjf.com', '2017-03-28', 'Fashion, Arts and Handicraft', 0, '55', '', '', '', '', ''),
(13, 1489144939, 0, 21, 'hanzen', '13han331', 'hansen.com', '2017-03-30', 'Finance and Technology', 0, '33', '', '', '', '', ''),
(14, 1489156974, 0, 22, 'Angels of Impact  ', '14Ang231', 'angelsofimpact.com', '', 'Finance and Technology', 0, '', 'Food and Agriculture', 'No poverty,Gender equality,Responsible production and consumption', 'Market access, Funding for social enterprises, ', 'Singapore, ASEAN, Japan, Bay area ', ''),
(15, 1489157439, 0, 23, 'Social Enterprise Demo ', '15Soc362', 'www.socialenterprise.com', '2017-03-01', 'Food and Agriculture', 0, '1000', '', '', '', '', ''),
(16, 1489203042, 0, 29, 'PM Social Entrprise Demo ', '16PM 631', 'pmdemo.com', '2009-12-01', 'Education and Skills training', 0, '5000', '', '', '', '', ''),
(17, 1489208034, 0, 30, 'Angels of Impact ', '17Ang560', 'angelsofimpact.com', '', 'Finance and Technology', 0, '', 'Food and Agriculture', 'No poverty,Gender equality,Responsible production and consumption,Innovation and infrastructure development', 'Market access, Funding for social enterprises, ', 'Singapore, ASEAN, Japan, Bay area ', 'Corporates eg Tech companies, Financial institutions '),
(18, 1489209501, 0, 28, 'Inzen studios', '18Inz723', 'Inzenstudios.com', '', 'Finance and Technology', 0, '', 'Food and Agriculture', 'No poverty,Responsible production and consumption,Education,Social justice', 'Fundraising, Access to investors ', 'Indonesia, Australia, China', ''),
(19, 1489376534, 0, 31, 'dxtr test', '19dxt980', 'http://dxtr.asia/', '2015-03-01', 'Finance and Technology', 0, '100', '', '', '', '', ''),
(20, 1489631726, 0, 33, 'IXID', '20IXI567', 'interiorexchangeid.com', '2016-10-30', 'Fashion, Arts and Handicraft', 0, '1', '', '', '', '', ''),
(21, 1490597530, 0, 35, 'The Batik Boutique', '21The644', 'www.thebatikboutique.com', '2013-01-01', 'Fashion, Arts and Handicraft', 0, '15', '', '', '', '', ''),
(22, 1498037370, 0, 40, 'TestingSE', '22Tes831', 'Testingse.com', '2017-06-01', 'Food and Agriculture', 0, '10', '', '', '', '', ''),
(23, 1499478681, 0, 42, 'COLOR SILK ENTERPRISE', '23COL703', 'http://colorsilkcommunity.wix.com/colorsilk-cambodia', '2013-11-14', 'Fashion, Arts and Handicraft', 0, '12', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `inbox_id` int(11) NOT NULL,
  `inbox_entrydate` int(11) NOT NULL,
  `inbox_editdate` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `startup_id` int(11) NOT NULL,
  `inbox_name` varchar(255) NOT NULL,
  `inbox_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`inbox_id`, `inbox_entrydate`, `inbox_editdate`, `user_id`, `startup_id`, `inbox_name`, `inbox_desc`) VALUES
(1, 0, 0, 1, 0, 'Welcome', 'halo, welcome to aoi'),
(2, 1479373191, 0, 4, 2, 'Your startup information - November 17, 2016, 3:59pm', '==========================================<br />									Your startup information - November 17, 2016, 3:59pm <br />									Hello, hansentest <br />									You have just requested a funding for your startup <br />									==========================================<br />									IP Address : ::1 <br />									Startup ID : 2 <br />									Startup name: hanzen <br />									Amount: 8000 <br />									Funding Deadline: 2016-12-01 <br />									Repayment Period: 12 <br />									Repayment Start date: 2017-01-01 <br />									==========================================<br />									END OF MESSAGE <br />									==========================================									'),
(3, 1479465085, 0, 5, 4, 'Your startup information - November 18, 2016, 5:31pm', '==========================================<br />\n									Hello, hansen zhen <br />\n									You have just requested a funding for your startup <br />\n									==========================================<br />\n									IP Address : 127.0.0.1 <br />\n									Startup ID : 4 <br />\n									Startup name: dell corp <br />\n									Amount: $ 5000 <br />\n									Funding Deadline: 2016-11-30 <br />\n									Repayment Period: 1 Months <br />\n									Repayment Start date: 2016-12-01 <br />\n									==========================================<br />\n									END OF MESSAGE <br />\n									==========================================\n									'),
(4, 1480303675, 0, 3, 5, 'We have received a Funding Request! ', 'Dearest hanzen startup,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(5, 1480310001, 0, 0, 0, 'Enabling Impact through the flow of money', 'Dearest ,\n											Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(6, 1480310001, 0, 0, 0, 'Flow of funds confirmed', 'Dearest , <br />\n											Congrats on receiving the monies for your funding needs! <br /> \n											The monies will be disbursed to your account in due course and <br /> \n											instructions will be further sent for you to send your bank account details.<br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(7, 1480310032, 0, 0, 0, 'Enabling Impact through the flow of money', 'Dearest ,\n											Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(8, 1480310032, 0, 0, 0, 'Flow of funds confirmed', 'Dearest , <br />\n											Congrats on receiving the monies for your funding needs! <br /> \n											The monies will be disbursed to your account in due course and <br /> \n											instructions will be further sent for you to send your bank account details.<br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(9, 1480313026, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n											Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(10, 1480313027, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n											Congrats on receiving the monies for your funding needs! <br /> \n											The monies will be disbursed to your account in due course and <br /> \n											instructions will be further sent for you to send your bank account details.<br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(11, 1480313120, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n											Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(12, 1480313121, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n											Congrats on receiving the monies for your funding needs! <br /> \n											The monies will be disbursed to your account in due course and <br /> \n											instructions will be further sent for you to send your bank account details.<br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(13, 1480313274, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n											Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(14, 1480313274, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n											Congrats on receiving the monies for your funding needs! <br /> \n											The monies will be disbursed to your account in due course and <br /> \n											instructions will be further sent for you to send your bank account details.<br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(15, 1480314110, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(16, 1480314110, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(17, 1480314389, 0, 2, 1, 'Angel Pledge Funding Received!', 'Dearest hanzen,\n											We have received your funding pledge of $ 2000 to hansen corp social enterprise. <br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(18, 1480314389, 0, 3, 1, 'You have received a funding pledge from an Angel Funder!', 'Dearest hanzen startup,\n											We have received a funding pledge of $ 2000 for your funds request by hanzen. <br /> \n											<br />\n											<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account and track the progress of your funding needs. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(19, 1480390135, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(20, 1480390135, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(21, 1480390290, 0, 2, 4, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(22, 1480390291, 0, 5, 4, 'Flow of funds confirmed', 'Dearest hansen zhen, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(23, 1480390301, 0, 1, 4, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(24, 1480390301, 0, 5, 4, 'Flow of funds confirmed', 'Dearest hansen zhen, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(25, 1480390347, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(26, 1480390348, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(27, 1480390586, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(28, 1480390586, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(29, 1480390590, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(30, 1480390590, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(31, 1480390594, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(32, 1480390594, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(33, 1480390597, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(34, 1480390597, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(35, 1480390644, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(36, 1480390644, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(37, 1480390701, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(38, 1480390701, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(39, 1480390736, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(40, 1480390736, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(41, 1480390949, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(42, 1480390949, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(43, 1480391054, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(44, 1480391054, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(45, 1480391068, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(46, 1480391068, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(47, 1480391071, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(48, 1480391071, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(49, 1480391074, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(50, 1480391074, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(51, 1480391076, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(52, 1480391076, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(53, 1480391078, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(54, 1480391078, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(55, 1480391205, 0, 2, 1, 'Enabling Impact through the flow of money', 'Dearest hanzen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(56, 1480391205, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(57, 1480391212, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(58, 1480391212, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(59, 1480391220, 0, 1, 1, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(60, 1480391220, 0, 3, 1, 'Flow of funds confirmed', 'Dearest hanzen startup, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(61, 1484729718, 0, 0, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest , <br />\r\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \r\n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \r\n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \r\n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \r\n												<br /> \r\n												Here are the following areas that we will be championing, supporting and serving you: <br /> \r\n												<ul>\r\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\r\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\r\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\r\n												</ul>\r\n												<br />\r\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \r\n												enterprise member and hit reply to this email if you have any specific questions! <br />\r\n												We welcome you onboard the movement! <br />\r\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \r\n												(Link to http://www.angelsofimpact.com/news--events) <br />\r\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\r\n												<br />\r\n												With gratitude, <br />\r\n												Audrey & Laina'),
(62, 1484729851, 0, 8, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest hansen, <br />\r\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \r\n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \r\n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \r\n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \r\n												<br /> \r\n												Here are the following areas that we will be championing, supporting and serving you: <br /> \r\n												<ul>\r\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\r\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\r\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\r\n												</ul>\r\n												<br />\r\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \r\n												enterprise member and hit reply to this email if you have any specific questions! <br />\r\n												We welcome you onboard the movement! <br />\r\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \r\n												(Link to http://www.angelsofimpact.com/news--events) <br />\r\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\r\n												<br />\r\n												With gratitude, <br />\r\n												Audrey & Laina'),
(63, 1484730258, 0, 9, 0, 'Angels of Impact welcomes you our Angel Member', 'Dearest hanseninv, <br />\r\n												Thank you for signing up to be a Angels member! You will meet angel social entrepreneurs, <br />\r\n												funders and mentors. Angels of impact supports women led social entrepreneurs who are <br /> \r\n												focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \r\n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br />\r\n												<br />\r\n												Here are some of the social enterprises who are looking to receive funding support <br />\r\n												<ul>\r\n													<li>Torajamelo (Click through to the page where they can see the funding options) If you are inspired to</li>\r\n													<li>Open doors to new markets, networks and potential customers </li>\r\n													<li>Be more involved in supporting social enterprises with funding needs</li>\r\n													<li>Mentor social enterprise in areas of finance, marketing, hiring or any other operational areas</li>\r\n												</ul>\r\n												<br />\r\n												Feel free to be in touch with us and hit reply to this email! <br /> \r\n												Read more about our events, news and how we support our social enterprises in our <br /> \r\n												network. (Link to http://www.angelsofimpact.com/news--events)  <br />\r\n												<br />\r\n												We welcome you onboard the movement! <br /> \r\n												<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account and meet some of your fellow Angel funder members too!.<br />\r\n												<br />\r\n												With gratitude, <br />\r\n												Audrey & Laina\r\n												'),
(64, 1484730732, 0, 10, 0, 'Angels of Impact welcomes you onboard the community! ', 'Dearest hansen, <br />\r\n												Welcome to the Angels of Impact community! You will meet angel social entrepreneurs, <br />\r\n												funders and mentors. Angels of impact supports women led social entrepreneurs who are <br /> \r\n												focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, #1 No <br /> \r\n												Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br />\r\n												<br />\r\n												We support women led enterprises with access to <br />\r\n												<ul>\r\n													<li>New market networks as we champion your products and services into supply chain of organisations we call this corporate shared values</li>\r\n													<li>Funding needs that come in the form of prepaid credits for your working capital needs</li>\r\n													<li>Connect you to domain experts and mentors who can help you business overcome</li>\r\n												</ul>\r\n												<br />\r\n												<ul>\r\n													<li>Open doors to new markets, networks and potential customers</li>\r\n													<li>Be more involved in supporting social enterprises with funding needs</li>\r\n													<li>Mentor social enterprise in areas of finance, marketing, hiring or any other operational areas</li>\r\n												</ul>\r\n												<br />\r\n												Feel free to be in touch with us and hit reply to this email if you will like to be more involved. <br /> \r\n												Read more about our events, news and how we support our social enterprises in our network. <br />\r\n												(Link to http://www.angelsofimpact.com/news--events)  <br /> \r\n												We welcome you onboard the movement! <br />\r\n												<br />\r\n												<a href=\'angelofimpact.com/login\'>[Click here]</a> login to your account.<br />\r\n												<br />\r\n												With gratitude, <br />\r\n												Audrey & Laina\r\n												'),
(65, 1486447810, 0, 0, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest , <br />\r\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \r\n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \r\n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \r\n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \r\n												<br /> \r\n												Here are the following areas that we will be championing, supporting and serving you: <br /> \r\n												<ul>\r\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\r\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\r\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\r\n												</ul>\r\n												<br />\r\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \r\n												enterprise member and hit reply to this email if you have any specific questions! <br />\r\n												We welcome you onboard the movement! <br />\r\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \r\n												(Link to http://www.angelsofimpact.com/news--events) <br />\r\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\r\n												<br />\r\n												With gratitude, <br />\r\n												Audrey & Laina'),
(66, 1486448441, 0, 0, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest , <br />\r\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \r\n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \r\n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \r\n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \r\n												<br /> \r\n												Here are the following areas that we will be championing, supporting and serving you: <br /> \r\n												<ul>\r\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\r\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\r\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\r\n												</ul>\r\n												<br />\r\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \r\n												enterprise member and hit reply to this email if you have any specific questions! <br />\r\n												We welcome you onboard the movement! <br />\r\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \r\n												(Link to http://www.angelsofimpact.com/news--events) <br />\r\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\r\n												<br />\r\n												With gratitude, <br />\r\n												Audrey & Laina'),
(67, 1486448758, 0, 0, 0, 'Angels of Impact welcomes you to the network!', 'Dearest , <br />\r\n												Welcome to the Angels of Impact community! You will meet angel funders, mentors and <br />\r\n												fellow angel social entrepreneurs. Angels of impact supports women led social <br /> \r\n												entrepreneurs who are focused on impact first with an aim to fulfill the 3 UN Sustainable <br /> \r\n												Development goals, #1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br />\r\n												<br />\r\n												We support women led enterprises with access to <br />\r\n												<ul>\r\n													<li>New market networks as we champion your products and services into supply chain of organisations we call this corporate shared values</li>\r\n													<li>Funding needs that come in the form of prepaid credits for your working capital needs</li>\r\n													<li>Connect you to domain experts and mentors who can help you business overcome</li>\r\n												</ul>\r\n												<br />\r\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \r\n												enterprise member and hit reply to this email if you have any specific questions! <br /> \r\n												We welcome you onboard the movement! <br />\r\n												<br />\r\n												Read more about our events, news and how we support our social enterprises in our <br /> \r\n												network. (Link to http://www.angelsofimpact.com/news--events) <br />\r\n												<br />\r\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account.<br />\r\n												<br />\r\n												With gratitude, <br />\r\n												Audrey & Laina\r\n												'),
(68, 1488529816, 0, 17, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest tetser, <br />\r\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \r\n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \r\n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \r\n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \r\n												<br /> \r\n												Here are the following areas that we will be championing, supporting and serving you: <br /> \r\n												<ul>\r\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\r\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\r\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\r\n												</ul>\r\n												<br />\r\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \r\n												enterprise member and hit reply to this email if you have any specific questions! <br />\r\n												We welcome you onboard the movement! <br />\r\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \r\n												(Link to http://www.angelsofimpact.com/news--events) <br />\r\n												<a href=\"http://103.53.197.234/~geraikom/aoi/login?f=automail\">[Click here]</a> login to your account. <br />\r\n												<br />\r\n												With gratitude, <br />\r\n												Audrey & Laina'),
(69, 1488772699, 0, 8, 6, 'We have received a Funding Request! ', 'Dearest hansen,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"http://103.53.197.234/~geraikom/aoi/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(70, 1488772826, 0, 1, 6, 'Angel Pledge Funding Received!', 'Dearest hansen,\r\n											We have received your funding pledge of $ 2500 to baru bikin social enterprise. <br /> \r\n											<br />\r\n											<a href=\"http://103.53.197.234/~geraikom/aoi/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(71, 1488772826, 0, 8, 6, 'You have received a funding pledge from an Angel Funder!', 'Dearest hansen,\r\n											We have received a funding pledge of $ 2500 for your funds request by hansen. <br /> \r\n											<br />\r\n											<a href=\"http://103.53.197.234/~geraikom/aoi/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(72, 1488772968, 0, 1, 6, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(73, 1488772969, 0, 8, 6, 'Flow of funds confirmed', 'Dearest hansen, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(74, 1488947803, 0, 8, 7, 'We have received a Funding Request! ', 'Dearest hansen,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"http://103.53.197.234/~geraikom/aoi/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(75, 1488948120, 0, 8, 8, 'We have received a Funding Request! ', 'Dearest hansen,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"http://103.53.197.234/~geraikom/aoi/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(76, 1488949347, 0, 8, 9, 'We have received a Funding Request! ', 'Dearest hansen,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"http://103.53.197.234/~geraikom/aoi/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(77, 1489144597, 0, 19, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest hansenlive, <br />\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \n												<br /> \n												Here are the following areas that we will be championing, supporting and serving you: <br /> \n												<ul>\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\n												</ul>\n												<br />\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \n												enterprise member and hit reply to this email if you have any specific questions! <br />\n												We welcome you onboard the movement! <br />\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \n												(Link to http://www.angelsofimpact.com/news--events) <br />\n												<a href=\"wingsofimpact.com/login?f=automail\">[Click here]</a> login to your account. <br />\n												<br />\n												We will get back shortly to inform you regarding your payment details. Please wait for our next email.<br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina');
INSERT INTO `inbox` (`inbox_id`, `inbox_entrydate`, `inbox_editdate`, `user_id`, `startup_id`, `inbox_name`, `inbox_desc`) VALUES
(78, 1489158774, 0, 23, 10, 'We have received a Funding Request! ', 'Dearest Social Enterprise Demo ,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(79, 1489161741, 0, 22, 10, 'Angel Pledge Funding Received!', 'Dearest Audrey Tan,\r\n											We have received your funding pledge of $ 1000 to Social Enterprise Demo  social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(80, 1489161741, 0, 23, 10, 'You have received a funding pledge from an Angel Funder!', 'Dearest Social Enterprise Demo ,\n											We have received a funding pledge of $ 1000 for your funds request by Audrey Tan. <br /> \n											<br />\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\n											<br />\n											With gratitude, <br />\n											Audrey & Laina'),
(81, 1489201383, 0, 28, 10, 'Angel Pledge Funding Received!', 'Dearest Gerald Tock,\r\n											We have received your funding pledge of $ 5000 to Social Enterprise Demo  social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(82, 1489201383, 0, 23, 10, 'You have received a funding pledge from an Angel Funder!', 'Dearest Social Enterprise Demo ,\r\n											We have received a funding pledge of $ 5000 for your funds request by Gerald Tock. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(83, 1489201413, 0, 22, 10, 'Enabling Impact through the flow of money', 'Dearest Audrey Tan,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(84, 1489201413, 0, 23, 10, 'Flow of funds confirmed', 'Dearest Social Enterprise Demo , <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(85, 1489203042, 0, 29, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest Joy, <br />\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \n												<br /> \n												Here are the following areas that we will be championing, supporting and serving you: <br /> \n												<ul>\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\n												</ul>\n												<br />\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \n												enterprise member and hit reply to this email if you have any specific questions! <br />\n												We welcome you onboard the movement! <br />\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \n												<br />\n												<a href=\"wingsofimpact.com/login?f=automail\">[Click here]</a> login to your account. <br />\n												<br />\n												We will get back shortly to inform you regarding your payment details. Please wait for our next email.<br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(86, 1489205114, 0, 22, 10, 'Angel Pledge Funding Received!', 'Dearest Audrey Tan,\r\n											We have received your funding pledge of $ 1000 to Social Enterprise Demo  social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(87, 1489205114, 0, 23, 10, 'You have received a funding pledge from an Angel Funder!', 'Dearest Social Enterprise Demo ,\r\n											We have received a funding pledge of $ 1000 for your funds request by Audrey Tan. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(88, 1489206081, 0, 23, 11, 'We have received a Funding Request! ', 'Dearest Social Enterprise Demo ,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(89, 1489206325, 0, 28, 11, 'Angel Pledge Funding Received!', 'Dearest Gerald Tock,\r\n											We have received your funding pledge of $ 3000 to Social Enterprise Demo  social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(90, 1489206325, 0, 23, 11, 'You have received a funding pledge from an Angel Funder!', 'Dearest Social Enterprise Demo ,\r\n											We have received a funding pledge of $ 3000 for your funds request by Gerald Tock. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(91, 1489208583, 0, 30, 11, 'Angel Pledge Funding Received!', 'Dearest Audrey Joy Tan ,\r\n											We have received your funding pledge of $ 2500 to Social Enterprise Demo  social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(92, 1489208583, 0, 23, 11, 'You have received a funding pledge from an Angel Funder!', 'Dearest Social Enterprise Demo ,\r\n											We have received a funding pledge of $ 2500 for your funds request by Audrey Joy Tan . <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(93, 1489208749, 0, 28, 11, 'Enabling Impact through the flow of money', 'Dearest Gerald Tock,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(94, 1489208750, 0, 23, 11, 'Flow of funds confirmed', 'Dearest Social Enterprise Demo , <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(95, 1489208754, 0, 30, 11, 'Enabling Impact through the flow of money', 'Dearest Audrey Joy Tan ,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(96, 1489208754, 0, 23, 11, 'Flow of funds confirmed', 'Dearest Social Enterprise Demo , <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"angelofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(97, 1489211737, 0, 30, 11, 'Angel Pledge Funding Received!', 'Dearest Audrey Joy Tan ,\r\n											We have received your funding pledge of $ 2000 to Social Enterprise Demo  social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(98, 1489211737, 0, 23, 11, 'You have received a funding pledge from an Angel Funder!', 'Dearest Social Enterprise Demo ,\r\n											We have received a funding pledge of $ 2000 for your funds request by Audrey Joy Tan . <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(99, 1489376534, 0, 31, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest testaccount, <br />\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \n												<br /> \n												Here are the following areas that we will be championing, supporting and serving you: <br /> \n												<ul>\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\n												</ul>\n												<br />\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \n												enterprise member and hit reply to this email if you have any specific questions! <br />\n												We welcome you onboard the movement! <br />\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \n												<br />\n												<a href=\"wingsofimpact.com/login?f=automail\">[Click here]</a> login to your account. <br />\n												<br />\n												We will get back shortly to inform you regarding your payment details. Please wait for our next email.<br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(100, 1489377151, 0, 31, 12, 'We have received a Funding Request! ', 'Dearest testaccount,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(101, 1489392715, 0, 31, 13, 'We have received a Funding Request! ', 'Dearest testaccount,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(102, 1489393453, 0, 1, 13, 'Angel Pledge Funding Received!', 'Dearest hansen,\r\n											We have received your funding pledge of $ 2000 to hansentest social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(103, 1489393454, 0, 31, 13, 'You have received a funding pledge from an Angel Funder!', 'Dearest testaccount,\r\n											We have received a funding pledge of $ 2000 for your funds request by hansen. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(104, 1489394087, 0, 1, 13, 'Angel Pledge Funding Received!', 'Dearest hansen,<br /> <br />\r\n											We have received your funding pledge of $ 2500 to hansentest social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(105, 1489394087, 0, 31, 13, 'You have received a funding pledge from an Angel Funder!', 'Dearest testaccount, <br /> <br />\r\n											We have received a funding pledge of $ 2500 for your funds request by hansen. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(106, 1489394596, 0, 1, 13, 'Enabling Impact through the flow of money', 'Dearest hansen,\n												Thank you for your pledge, it has enabled the social enterprise to meet their funding needs! <br /> \n												<br />\n												<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(107, 1489394596, 0, 31, 13, 'Flow of funds confirmed', 'Dearest testaccount, <br />\n												Congrats on receiving the monies for your funding needs! <br /> \n												The monies will be disbursed to your account in due course and <br /> \n												instructions will be further sent for you to send your bank account details.<br /> \n												<br />\n												<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account. <br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(108, 1489631726, 0, 33, 0, 'Angels of Impact welcomes you to the network!', 'Dearest Vanessa Intan, <br />\n												Welcome to the Angels of Impact community! You will meet angel funders, mentors and <br />\n												fellow angel social entrepreneurs. Angels of impact supports women led social <br /> \n												entrepreneurs who are focused on impact first with an aim to fulfill the 3 UN Sustainable <br /> \n												Development goals, #1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br />\n												<br />\n												We support women led enterprises with access to <br />\n												<ul>\n													<li>New market networks as we champion your products and services into supply chain of organisations we call this corporate shared values</li>\n													<li>Funding needs that come in the form of prepaid credits for your working capital needs</li>\n													<li>Connect you to domain experts and mentors who can help you business overcome</li>\n												</ul>\n												<br />\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \n												enterprise member and hit reply to this email if you have any specific questions! <br /> \n												We welcome you onboard the movement! <br />\n												<br />\n												Read more about our events, news and how we support our social enterprises in our <br /> \n												network.<br />\n												<br />\n												<a href=\"wingsofimpact.com/login?f=automail\">[Click here]</a> login to your account.<br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina\n												'),
(109, 1490083135, 0, 34, 11, 'Angel Pledge Funding Received!', 'Dearest Anson Zeall,<br /> <br />\r\n											We have received your funding pledge of $ 500 to Social Enterprise Demo  social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(110, 1490083135, 0, 21, 11, 'You have received a funding pledge from an Angel Funder!', 'Dearest hanzen, <br /> <br />\r\n											We have received a funding pledge of $ 500 for your funds request by Anson Zeall. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(111, 1490597530, 0, 35, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest Laia, <br />\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \n												<br /> \n												Here are the following areas that we will be championing, supporting and serving you: <br /> \n												<ul>\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\n												</ul>\n												<br />\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \n												enterprise member and hit reply to this email if you have any specific questions! <br />\n												We welcome you onboard the movement! <br />\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \n												<br />\n												<a href=\"wingsofimpact.com/login?f=automail\">[Click here]</a> login to your account. <br />\n												<br />\n												We will get back shortly to inform you regarding your payment details. Please wait for our next email.<br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(112, 1491379049, 0, 30, 11, 'Angel Pledge Funding Received!', 'Dearest Audrey Joy Tan ,<br /> <br />\r\n											We have received your funding pledge of $ 500 to Social Enterprise Demo  social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(113, 1491379050, 0, 21, 11, 'You have received a funding pledge from an Angel Funder!', 'Dearest hanzen, <br /> <br />\r\n											We have received a funding pledge of $ 500 for your funds request by Audrey Joy Tan . <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(114, 1498037370, 0, 40, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest SeTesting, <br />\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \n												<br /> \n												Here are the following areas that we will be championing, supporting and serving you: <br /> \n												<ul>\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\n												</ul>\n												<br />\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \n												enterprise member and hit reply to this email if you have any specific questions! <br />\n												We welcome you onboard the movement! <br />\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \n												<br />\n												<a href=\"wingsofimpact.com/login?f=automail\">[Click here]</a> login to your account. <br />\n												<br />\n												We will get back shortly to inform you regarding your payment details. Please wait for our next email.<br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(115, 1499075109, 0, 28, 11, 'Angel Pledge Funding Received!', 'Dearest Gerald Tock,<br /> <br />\r\n											We have received your funding pledge of $ 500 to Social Enterprise Demo  social enterprise. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the other Angel funders who are supporting the social enterprise you have supported. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(116, 1499075109, 0, 21, 11, 'You have received a funding pledge from an Angel Funder!', 'Dearest hanzen, <br /> <br />\r\n											We have received a funding pledge of $ 500 for your funds request by Gerald Tock. <br /> \r\n											<br />\r\n											<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account and track the progress of your funding needs. <br />\r\n											<br />\r\n											With gratitude, <br />\r\n											Audrey & Laina'),
(117, 1499478681, 0, 42, 0, 'Angels of Impact welcomes you our Angel Social Entrepreneur Member', 'Dearest NGORN VANNTHA, <br />\n												Welcome to the Angels of Impact community! Thank you for signing up to be a paid Angel <br /> \n												social enterprise member! Angels of impact supports women led social entrepreneurs who <br /> \n												are focused on impact first with an aim to fulfill the 3 UN Sustainable Development goals, <br /> \n												#1 No Poverty, #5 Gender Equality and #12 Responsible Production & Consumption. <br /> \n												<br /> \n												Here are the following areas that we will be championing, supporting and serving you: <br /> \n												<ul>\n													<li>New market networks as we champion your products and services into supply chains of organisations who practice corporate shared value</li>\n													<li>Funding needs that come in the form of prepaid credits for your cash flow needs</li>\n													<li>Connect you to domain experts and mentors who can help your business overcome specific and strategic challenges</li>\n												</ul>\n												<br />\n												Feel free to be in touch with us if you will like to learn more about becoming a social <br /> \n												enterprise member and hit reply to this email if you have any specific questions! <br />\n												We welcome you onboard the movement! <br />\n												Read more about our events, news and how we support our social enterprises in our network. <br /> \n												<br />\n												<a href=\"wingsofimpact.com/login?f=automail\">[Click here]</a> login to your account. <br />\n												<br />\n												We will get back shortly to inform you regarding your payment details. Please wait for our next email.<br />\n												<br />\n												With gratitude, <br />\n												Audrey & Laina'),
(118, 1499484826, 0, 42, 14, 'We have received a Funding Request! ', 'Dearest NGORN VANNTHA,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina'),
(119, 1499672854, 0, 21, 15, 'We have received a Funding Request! ', 'Dearest hanzen,\n										We have received your funding request and we have shared it with the Angel funders in the <br /> \n										Angels of Impact network. We ask for your patience and will be in touch with you on how we <br /> \n										can support your funding needs. <br />\n										<br />\n										<a href=\"wingsofimpact.com/login\">[Click here]</a> login to your account to see the progress of your funding requests. <br />\n										<br />\n										With gratitude, <br />\n										Audrey & Laina');

-- --------------------------------------------------------

--
-- Table structure for table `sitedata`
--

CREATE TABLE `sitedata` (
  `sitedata_id` int(11) NOT NULL,
  `sitedata_editdate` int(11) NOT NULL,
  `sitedata_title` varchar(255) NOT NULL,
  `sitedata_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sitedata`
--

INSERT INTO `sitedata` (`sitedata_id`, `sitedata_editdate`, `sitedata_title`, `sitedata_content`) VALUES
(1, 1424858275, 'adminnewstitle', 'Lorem ipsum'),
(2, 1424858280, 'adminnewscontent', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ut augue eros, vel faucibus tortor. Nullam dapibus commodo dolor ac porttitor. Etiam placerat, dui eleifend sollicitudin dictum, erat tortor porta diam, vel suscipit odio libero eget sem. Suspendisse eros quam, sodales non blandit venenatis, bibendum ut odio. Aliquam erat volutpat. Integer a nibh vel nibh pharetra faucibus eu et turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Quisque vitae elit sit amet quam condimentum molestie sit amet nec urna. Vestibulum arcu nisi, dapibus vel faucibus sed, tempus non velit. Aliquam nec sapien nec urna mollis mollis.&lt;br /&gt;Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam commodo urna id massa hendrerit in gravida ante tempus. Donec aliquet purus tincidunt ligula aliquet viverra.'),
(7, 1415854679, 'howtobuy', 'Lorem ipsum'),
(13, 0, 'offlineevents', 'lorem ipsum'),
(14, 1415853915, 'faq', 'Lorem Ipsum'),
(9, 0, 'shippingpolicy', 'lorem ipsum'),
(10, 1424157967, 'termsandconditions', 'lorem ipsum'),
(11, 1415854866, 'returnpolicy', 'Lorem ipsum'),
(12, 1415854734, 'howtoorder', 'Lorem ipsum'),
(3, 1425462237, 'analytics', '<!-- Copy Google Analytics Code Here -->'),
(4, 1467195004, 'watermark', 'watermark.png');

-- --------------------------------------------------------

--
-- Table structure for table `startup`
--

CREATE TABLE `startup` (
  `startup_id` int(11) NOT NULL,
  `startup_showorder` int(11) NOT NULL,
  `startup_entrydate` int(11) NOT NULL,
  `startup_editdate` int(11) NOT NULL,
  `startup_enabled` varchar(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `startup_name` varchar(255) NOT NULL,
  `startup_desc` text NOT NULL,
  `startup_longdesc` text NOT NULL,
  `startup_amount` int(11) NOT NULL,
  `startup_deadline` int(11) NOT NULL,
  `startup_logo` varchar(255) NOT NULL,
  `startup_image1` varchar(255) NOT NULL,
  `startup_image2` varchar(255) NOT NULL,
  `startup_image3` varchar(255) NOT NULL,
  `startup_youtube` varchar(255) NOT NULL,
  `startup_pdf` varchar(255) NOT NULL,
  `startup_report` varchar(255) NOT NULL,
  `startup_cover` varchar(255) NOT NULL,
  `startup_fundingpurpose` varchar(255) NOT NULL,
  `startup_fundingimpact` varchar(255) NOT NULL,
  `startup_repaymentperiod` varchar(255) NOT NULL,
  `startup_repaymentstart` int(11) NOT NULL,
  `startup_active` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `startup`
--

INSERT INTO `startup` (`startup_id`, `startup_showorder`, `startup_entrydate`, `startup_editdate`, `startup_enabled`, `user_id`, `startup_name`, `startup_desc`, `startup_longdesc`, `startup_amount`, `startup_deadline`, `startup_logo`, `startup_image1`, `startup_image2`, `startup_image3`, `startup_youtube`, `startup_pdf`, `startup_report`, `startup_cover`, `startup_fundingpurpose`, `startup_fundingimpact`, `startup_repaymentperiod`, `startup_repaymentstart`, `startup_active`) VALUES
(13, 13, 1489392715, 1490344521, 'd', 31, 'hansentest', 'hansentest lagi', 'lagi testing long description nih', 10000, 1493485200, '13c51ce410c124a10e0db5e4b97fc2af39.png', '13c51ce410c124a10e0db5e4b97fc2af391.png', '13c51ce410c124a10e0db5e4b97fc2af392.png', '13c51ce410c124a10e0db5e4b97fc2af393.png', '', 'ANZ_Information_201606_v1.pdf', '7010306317020002034.pdf', '13c51ce410c124a10e0db5e4b97fc2af39.jpg', 'ada deee', 'banyak', '12', 1493571600, 'd'),
(14, 14, 1499484826, 1499654746, 'e', 42, 'Silk weaving center ', 'Create new weaving center for women in rural can acccess and weave to create income ', 'The center aim to provide safe place / good working environment for group of women in rural  who do not have space to set up loom at their house ', 60000, 1553878800, '', '', '', '', '', '', '', '', 'Set  up weaving center and loom set equipment for women ', 'Create job for rural women\r\nSustainable Income generation in rural \r\nRural economic development \r\nReduce illegal immediate of women \r\nPreserving Cambodian silk weaving heritage \r\n', '18', 1522342800, 'd'),
(15, 15, 1499672854, 1499672896, 'd', 21, 'tester', 'tester', 'asdfas', 55000, 1501002000, '159bf31c7ff062936a96d3c8bd1f8f2ff3.jpg', '159bf31c7ff062936a96d3c8bd1f8f2ff31.jpg', '', '', '', '', '', '159bf31c7ff062936a96d3c8bd1f8f2ff3.jpg', 'tester', 'tester', '6', 1501434000, 'd');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `subscriber_id` int(11) NOT NULL,
  `subscriber_entrydate` int(11) NOT NULL,
  `subscriber_editdate` int(11) NOT NULL,
  `subscriber_enabled` varchar(1) NOT NULL,
  `subscriber_name` varchar(255) NOT NULL,
  `subscriber_source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_entrydate` int(11) NOT NULL,
  `transaction_editdate` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `startup_id` int(11) NOT NULL,
  `transaction_gift` varchar(255) NOT NULL,
  `transaction_amount` int(11) NOT NULL,
  `transaction_status` varchar(255) NOT NULL,
  `transaction_expiry` int(11) NOT NULL,
  `transaction_confirmdate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_entrydate`, `transaction_editdate`, `user_id`, `startup_id`, `transaction_gift`, `transaction_amount`, `transaction_status`, `transaction_expiry`, `transaction_confirmdate`) VALUES
(16, 1489206325, 1489208749, 28, 11, '', 3000, 'paid', 0, 1489208749),
(20, 1489394086, 1489394596, 1, 13, '', 2500, 'paid', 0, 1489394596),
(21, 1490083135, 0, 34, 11, '', 500, 'unpaid', 0, 0),
(22, 1491379049, 0, 30, 11, '', 500, 'unpaid', 0, 0),
(23, 1499075109, 0, 28, 11, '', 500, 'unpaid', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactiondetail`
--

CREATE TABLE `transactiondetail` (
  `transactiondetail_id` int(11) NOT NULL,
  `transactiondetail_entrydate` int(11) NOT NULL,
  `transactiondetail_editdate` int(11) NOT NULL,
  `transactiondetail_amount` float NOT NULL,
  `transactiondetail_status` varchar(255) NOT NULL,
  `transactiondetail_confirmdate` int(11) NOT NULL,
  `transactiondetail_repaymentdue` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactiondetail`
--

INSERT INTO `transactiondetail` (`transactiondetail_id`, `transactiondetail_entrydate`, `transactiondetail_editdate`, `transactiondetail_amount`, `transactiondetail_status`, `transactiondetail_confirmdate`, `transactiondetail_repaymentdue`, `transaction_id`) VALUES
(37, 1480390290, 0, 1000, 'unpaid', 0, 1480525200, 9),
(38, 1480390300, 0, 3000, 'unpaid', 0, 1480525200, 8),
(171, 1480391071, 0, 166.67, 'unpaid', 0, 1479099831, 11),
(172, 1480391071, 0, 166.67, 'unpaid', 0, 1481648400, 11),
(173, 1480391071, 0, 166.67, 'unpaid', 0, 1484326800, 11),
(174, 1480391071, 0, 166.67, 'unpaid', 0, 1487005200, 11),
(175, 1480391071, 0, 166.67, 'unpaid', 0, 1489424400, 11),
(176, 1480391071, 0, 166.67, 'unpaid', 0, 1492102800, 11),
(177, 1480391071, 0, 166.67, 'unpaid', 0, 1494694800, 11),
(178, 1480391071, 0, 166.67, 'unpaid', 0, 1497373200, 11),
(179, 1480391071, 0, 166.67, 'unpaid', 0, 1499965200, 11),
(180, 1480391071, 0, 166.67, 'unpaid', 0, 1502643600, 11),
(181, 1480391071, 0, 166.67, 'unpaid', 0, 1505322000, 11),
(182, 1480391071, 0, 166.67, 'unpaid', 0, 1507914000, 11),
(219, 1480391205, 0, 83.33, 'unpaid', 0, 1479099831, 10),
(220, 1480391205, 0, 83.33, 'unpaid', 0, 1481648400, 10),
(221, 1480391205, 0, 83.33, 'unpaid', 0, 1484326800, 10),
(222, 1480391205, 0, 83.33, 'unpaid', 0, 1487005200, 10),
(223, 1480391205, 0, 83.33, 'unpaid', 0, 1489424400, 10),
(224, 1480391205, 0, 83.33, 'unpaid', 0, 1492102800, 10),
(225, 1480391205, 0, 83.33, 'unpaid', 0, 1494694800, 10),
(226, 1480391205, 0, 83.33, 'unpaid', 0, 1497373200, 10),
(227, 1480391205, 0, 83.33, 'unpaid', 0, 1499965200, 10),
(228, 1480391205, 0, 83.33, 'unpaid', 0, 1502643600, 10),
(229, 1480391205, 0, 83.33, 'unpaid', 0, 1505322000, 10),
(230, 1480391205, 0, 83.33, 'unpaid', 0, 1507914000, 10),
(231, 1480391212, 0, 833.33, 'unpaid', 0, 1479099831, 7),
(232, 1480391212, 0, 833.33, 'unpaid', 0, 1481648400, 7),
(233, 1480391212, 0, 833.33, 'unpaid', 0, 1484326800, 7),
(234, 1480391212, 0, 833.33, 'unpaid', 0, 1487005200, 7),
(235, 1480391212, 0, 833.33, 'unpaid', 0, 1489424400, 7),
(236, 1480391212, 0, 833.33, 'unpaid', 0, 1492102800, 7),
(237, 1480391212, 0, 833.33, 'unpaid', 0, 1494694800, 7),
(238, 1480391212, 0, 833.33, 'unpaid', 0, 1497373200, 7),
(239, 1480391212, 0, 833.33, 'unpaid', 0, 1499965200, 7),
(240, 1480391212, 0, 833.33, 'unpaid', 0, 1502643600, 7),
(241, 1480391212, 0, 833.33, 'unpaid', 0, 1505322000, 7),
(242, 1480391212, 0, 833.33, 'unpaid', 0, 1507914000, 7),
(243, 1480391220, 0, 333.33, 'unpaid', 0, 1479099831, 1),
(244, 1480391220, 0, 333.33, 'unpaid', 0, 1481648400, 1),
(245, 1480391220, 0, 333.33, 'unpaid', 0, 1484326800, 1),
(246, 1480391220, 0, 333.33, 'unpaid', 0, 1487005200, 1),
(247, 1480391220, 0, 333.33, 'unpaid', 0, 1489424400, 1),
(248, 1480391220, 0, 333.33, 'unpaid', 0, 1492102800, 1),
(249, 1480391220, 0, 333.33, 'unpaid', 0, 1494694800, 1),
(250, 1480391220, 0, 333.33, 'unpaid', 0, 1497373200, 1),
(251, 1480391220, 0, 333.33, 'unpaid', 0, 1499965200, 1),
(252, 1480391220, 0, 333.33, 'unpaid', 0, 1502643600, 1),
(253, 1480391220, 0, 333.33, 'unpaid', 0, 1505322000, 1),
(254, 1480391220, 0, 333.33, 'unpaid', 0, 1507914000, 1),
(255, 1488772968, 1488773794, 208.33, 'paid', 0, 1490893200, 12),
(256, 1488772968, 0, 208.33, 'unpaid', 0, 1493571600, 12),
(257, 1488772968, 0, 208.33, 'unpaid', 0, 1496250000, 12),
(258, 1488772968, 0, 208.33, 'unpaid', 0, 1498842000, 12),
(259, 1488772968, 1488773011, 208.33, 'paid', 0, 1501520400, 12),
(260, 1488772968, 0, 208.33, 'unpaid', 0, 1504198800, 12),
(261, 1488772968, 0, 208.33, 'unpaid', 0, 1506790800, 12),
(262, 1488772968, 0, 208.33, 'unpaid', 0, 1509469200, 12),
(263, 1488772968, 0, 208.33, 'unpaid', 0, 1512061200, 12),
(264, 1488772968, 0, 208.33, 'unpaid', 0, 1514739600, 12),
(265, 1488772968, 0, 208.33, 'unpaid', 0, 1517418000, 12),
(266, 1488772968, 0, 208.33, 'unpaid', 0, 1519837200, 12),
(267, 1489201413, 1489202054, 83.33, 'paid', 0, 1506790800, 13),
(268, 1489201413, 0, 83.33, 'unpaid', 0, 1509469200, 13),
(269, 1489201413, 0, 83.33, 'unpaid', 0, 1512061200, 13),
(270, 1489201413, 0, 83.33, 'unpaid', 0, 1514739600, 13),
(271, 1489201413, 0, 83.33, 'unpaid', 0, 1517418000, 13),
(272, 1489201413, 0, 83.33, 'unpaid', 0, 1519837200, 13),
(273, 1489201413, 0, 83.33, 'unpaid', 0, 1522515600, 13),
(274, 1489201413, 0, 83.33, 'unpaid', 0, 1525107600, 13),
(275, 1489201413, 0, 83.33, 'unpaid', 0, 1527786000, 13),
(276, 1489201413, 0, 83.33, 'unpaid', 0, 1530378000, 13),
(277, 1489201413, 0, 83.33, 'unpaid', 0, 1533056400, 13),
(278, 1489201413, 0, 83.33, 'unpaid', 0, 1535734800, 13),
(279, 1489208749, 1489477015, 166.67, 'paid', 0, 1509469200, 16),
(280, 1489208749, 0, 166.67, 'unpaid', 0, 1512061200, 16),
(281, 1489208749, 0, 166.67, 'unpaid', 0, 1514739600, 16),
(282, 1489208749, 0, 166.67, 'unpaid', 0, 1517418000, 16),
(283, 1489208749, 0, 166.67, 'unpaid', 0, 1519837200, 16),
(284, 1489208749, 0, 166.67, 'unpaid', 0, 1522515600, 16),
(285, 1489208749, 0, 166.67, 'unpaid', 0, 1525107600, 16),
(286, 1489208749, 0, 166.67, 'unpaid', 0, 1527786000, 16),
(287, 1489208749, 0, 166.67, 'unpaid', 0, 1530378000, 16),
(288, 1489208749, 0, 166.67, 'unpaid', 0, 1533056400, 16),
(289, 1489208749, 0, 166.67, 'unpaid', 0, 1535734800, 16),
(290, 1489208749, 0, 166.67, 'unpaid', 0, 1538326800, 16),
(291, 1489208749, 0, 166.67, 'unpaid', 0, 1541005200, 16),
(292, 1489208749, 0, 166.67, 'unpaid', 0, 1543597200, 16),
(293, 1489208749, 0, 166.67, 'unpaid', 0, 1546275600, 16),
(294, 1489208749, 0, 166.67, 'unpaid', 0, 1548954000, 16),
(295, 1489208749, 0, 166.67, 'unpaid', 0, 1551373200, 16),
(296, 1489208749, 0, 166.67, 'unpaid', 0, 1554051600, 16),
(297, 1489208753, 0, 138.89, 'unpaid', 0, 1509469200, 17),
(298, 1489208753, 0, 138.89, 'unpaid', 0, 1512061200, 17),
(299, 1489208753, 0, 138.89, 'unpaid', 0, 1514739600, 17),
(300, 1489208753, 0, 138.89, 'unpaid', 0, 1517418000, 17),
(301, 1489208753, 0, 138.89, 'unpaid', 0, 1519837200, 17),
(302, 1489208753, 0, 138.89, 'unpaid', 0, 1522515600, 17),
(303, 1489208753, 0, 138.89, 'unpaid', 0, 1525107600, 17),
(304, 1489208753, 0, 138.89, 'unpaid', 0, 1527786000, 17),
(305, 1489208753, 0, 138.89, 'unpaid', 0, 1530378000, 17),
(306, 1489208753, 0, 138.89, 'unpaid', 0, 1533056400, 17),
(307, 1489208753, 0, 138.89, 'unpaid', 0, 1535734800, 17),
(308, 1489208753, 0, 138.89, 'unpaid', 0, 1538326800, 17),
(309, 1489208753, 0, 138.89, 'unpaid', 0, 1541005200, 17),
(310, 1489208753, 0, 138.89, 'unpaid', 0, 1543597200, 17),
(311, 1489208753, 0, 138.89, 'unpaid', 0, 1546275600, 17),
(312, 1489208753, 0, 138.89, 'unpaid', 0, 1548954000, 17),
(313, 1489208753, 0, 138.89, 'unpaid', 0, 1551373200, 17),
(314, 1489208753, 0, 138.89, 'unpaid', 0, 1554051600, 17),
(315, 1489394596, 0, 208.33, 'unpaid', 0, 1493571600, 20),
(316, 1489394596, 0, 208.33, 'unpaid', 0, 1496250000, 20),
(317, 1489394596, 0, 208.33, 'unpaid', 0, 1498842000, 20),
(318, 1489394596, 0, 208.33, 'unpaid', 0, 1501520400, 20),
(319, 1489394596, 0, 208.33, 'unpaid', 0, 1504198800, 20),
(320, 1489394596, 0, 208.33, 'unpaid', 0, 1506790800, 20),
(321, 1489394596, 0, 208.33, 'unpaid', 0, 1509469200, 20),
(322, 1489394596, 0, 208.33, 'unpaid', 0, 1512061200, 20),
(323, 1489394596, 0, 208.33, 'unpaid', 0, 1514739600, 20),
(324, 1489394596, 0, 208.33, 'unpaid', 0, 1517418000, 20),
(325, 1489394596, 0, 208.33, 'unpaid', 0, 1519837200, 20),
(326, 1489394596, 0, 208.33, 'unpaid', 0, 1522515600, 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_entrydate` int(11) NOT NULL,
  `user_editdate` int(11) NOT NULL,
  `user_enabled` varchar(1) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_bankname` varchar(255) NOT NULL,
  `user_bankaccountname` varchar(255) NOT NULL,
  `user_bankaccountnumber` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_passport` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_address` text NOT NULL,
  `user_telp` varchar(255) NOT NULL,
  `user_gender` varchar(1) NOT NULL,
  `user_postal` varchar(255) NOT NULL,
  `user_credit` int(11) NOT NULL,
  `user_rememberkey` varchar(255) NOT NULL,
  `user_country` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_membershiptype` varchar(255) NOT NULL,
  `user_membershipid` int(11) NOT NULL,
  `user_publicprofile` varchar(1) NOT NULL,
  `user_emailnotify` varchar(1) NOT NULL,
  `user_expiry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_entrydate`, `user_editdate`, `user_enabled`, `company_id`, `user_bankname`, `user_bankaccountname`, `user_bankaccountnumber`, `user_email`, `user_passport`, `user_name`, `user_password`, `user_address`, `user_telp`, `user_gender`, `user_postal`, `user_credit`, `user_rememberkey`, `user_country`, `user_image`, `user_membershiptype`, `user_membershipid`, `user_publicprofile`, `user_emailnotify`, `user_expiry`) VALUES
(1, 1477991847, 1489393101, 'e', 1, 'ayeee', 'asdfasf', '13123123', 'hansen@lighthouse.co.id', '123123123', 'hansen', '812e4bfbf919978d2ac7f5cff004c0b1', 'yeaaaaa', '123123555', '', '', 0, '', 'India', '1c4ca4238a0b923820dcc509a6f75849b.png', 'investors', 2, 'e', 'e', 1490893200),
(21, 1489144939, 1499672768, 'e', 13, '', '', '', 'hansen.pramanta@gmail.com', '', 'hanzen', '812e4bfbf919978d2ac7f5cff004c0b1', '', '084684684', '', '', 0, '', 'Algeria', '213c59dc048e8850243be8079a5c74d079.jpg', 'startup', 1, 'e', 'e', 1514653200),
(23, 1489157439, 0, 'e', 15, '', '', '', 'audreytanyx@gmail.com', '', 'Social Enterprise Demo ', '40be4e59b9a2a2b5dffb918c0e86b3d7', '', '91013381', '', '', 0, '', 'Singapore', '2337693cfc748049e45d87b8c7d8b9aacd.jpeg', 'startup', 1, 'e', 'e', 1520701200),
(24, 1489161441, 1489207845, 'e', 0, '', '', '', 'laina@angelsofimpact.com', '', 'Laina Raveendran Greene', '5dfca99fc5bc43528e33c475863061a0', '', '', '', '', 0, '', '', '', 'investors', 1, 'e', 'e', 1520614800),
(25, 1489161527, 1489208131, 'e', 0, '', '', '', 'christy@angelsofimpact.com', '', 'Christy Wong', '38dc348e5b822af5d31fed8f1458e42f', '', '', '', '', 0, '', '', '', 'investors', 1, 'e', 'e', 1520614800),
(26, 1489191996, 1489208177, 'd', 0, '', '', '', 'emina@hotmail.it', '', 'Newinvestor', '1ee2cee1d0825b54b317f270b3a756e4', '', '', '', '', 0, '', '', '', 'investors', 1, 'e', 'e', 1520701200),
(27, 1489193384, 1489193763, 'e', 0, '', '', '', 'emanuelalongoalaimo@gmail.com', '12345', 'Emanuela', '8e1085d916c72776c1e9aff1395ae59c', '11 lorem ipsum', '23456789', '', '', 0, '', 'Italy', '2702e74f10e0327ad868d138f2b4fdd6f0.jpg', 'investors', 0, 'e', 'e', 1520701200),
(28, 1489200540, 1489200913, 'e', 18, '', '', '', 'geraldtock@gmail.com', 'S1234567A', 'Gerald Tock', '40be4e59b9a2a2b5dffb918c0e86b3d7', '141 middle road GSM building\r\n05-05', '96629750', '', '', 0, '', 'Singapore', '2833e75ff09dd601bbe69f351039152189.png', 'investors', 1, 'e', 'e', 1525107600),
(29, 1489203042, 0, 'e', 16, '', '', '', 'audrey@playmoolah.com', '', 'Joy', '40be4e59b9a2a2b5dffb918c0e86b3d7', '', '91013381', '', '', 0, '', 'Singapore', '', 'startup', 1, 'e', 'e', 1520701200),
(30, 1489207935, 1489208111, 'e', 17, '', '', '', 'audrey@angelsofimpact.com', 'S1234567A', 'Audrey Joy Tan ', '40be4e59b9a2a2b5dffb918c0e86b3d7', '141 middle road GSM building\r\n05-05', '91013381', '', '', 0, '', 'Singapore', '3034173cb38f07f89ddbebc2ac9128303f.jpg', 'investors', 1, 'e', 'e', 1520701200),
(31, 1489376534, 0, 'e', 19, '', '', '', 'dxtrtesting@gmail.com', '', 'testaccount', '66d3fa85e89d4cee330cf8b8bc6379de', '', '123456789012', '', '', 0, '', 'Indonesia', '', 'startup', 1, 'e', 'e', 1520874000),
(32, 1489388691, 0, 'e', 0, '', '', '', 'sleepingdragoon89@gmail.com', '', 'testerdxtr', '387063e9d02691f4ae5edbca15424fcc', '', '', '', '', 0, '', '', '', 'investors', 2, 'e', 'e', 0),
(33, 1489631726, 0, 'e', 20, '', '', '', 'vanessa.intan@gmail.com', '', 'Vanessa Intan', '7e5e1d9054b7fd2e18db5975dc589fbf', '', '+6281251358037', '', '', 0, '', 'Indonesia', '', 'startup', 0, 'e', 'e', 0),
(34, 1490082859, 1490083081, 'e', 0, '', '', '', 'anson.zeall@gmail.com', 'N8249243', 'Anson Zeall', 'c4704fb460cab089e41fa67a3e7dcb6b', '97 Meyer Road, #09-08', '92333058', '', '', 0, '', 'Singapore', '', 'investors', 1, 'e', 'e', 1521565200),
(35, 1490597530, 1490666307, 'e', 21, '', '', '', 'laia@thebatikboutique.com', '', 'Laia', '6b3e23982046d64b7d05e6148f5167b5', '', '6032303052', '', '', 0, '', 'Malaysia', '', 'startup', 1, 'e', 'e', 1512061200),
(36, 1492119115, 1492122564, 'e', 0, '', '', '', 'Vincent@valdmann.com', '', ' Vincent Valdmann', 'e2f84cbdb853dc8979a03408ad1be324', '', '', '', '', 0, '', '', '', 'investors', 0, 'e', 'e', 0),
(37, 1492580528, 0, 'e', 0, '', '', '', 'matias@hands.ai', '', 'matias', '038c39cd3940e745a058bd2abb9fe775', '', '', '', '', 0, '', '', '', 'investors', 0, 'e', 'e', 0),
(38, 1493614307, 0, 'e', 0, '', '', '', 'bernadette.cho@gmail.com', '', 'Bernadette Cho', '2867364d7f15e3309b077f01354a8a27', '', '', '', '', 0, '', '', '', 'investors', 0, 'e', 'e', 0),
(39, 1495694281, 0, 'e', 0, '', '', '', 'peiyue.lee@gmail.com', '', 'Peiyue Lee', 'ddbb8db45ba2c8347ee47cfd12fd1de9', '', '', '', '', 0, '', '', '', 'investors', 2, 'e', 'e', 0),
(40, 1498037370, 0, 'e', 22, '', '', '', 'Testingse@gmail.com', '', 'SeTesting', '40be4e59b9a2a2b5dffb918c0e86b3d7', '', '123456789', '', '', 0, '', 'Singapore', '', 'startup', 1, 'e', 'e', 0),
(41, 1498038678, 0, 'e', 0, '', '', '', 'Testingindvi@gmail.com', '', 'Indvitesting', 'd023110842ebca7cfe4bc15f3c87f96a', '', '', '', '', 0, '', '', '', 'investors', 0, 'e', 'e', 0),
(42, 1499478681, 0, 'e', 23, '', '', '', 'colorsilk.community@gmail.com', '', 'NGORN VANNTHA', '4268231730dd752d24a99791fd75396f', '', '85512769069', '', '', 0, '', 'Cambodia', '42a1d0c6e83f027327d8461063f4ac58a6.jpg', 'startup', 1, 'e', 'e', 1530982800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminsitepages`
--
ALTER TABLE `adminsitepages`
  ADD PRIMARY KEY (`adminsitepages_id`),
  ADD KEY `ue_idx` (`adminsitepages_mainmenuname`,`adminsitepages_enabled`);

--
-- Indexes for table `adminuseraccess`
--
ALTER TABLE `adminuseraccess`
  ADD PRIMARY KEY (`adminuseraccess_id`),
  ADD KEY `ue_idx` (`adminuserlevel_id`,`adminsitepages_id`);

--
-- Indexes for table `adminuserlevel`
--
ALTER TABLE `adminuserlevel`
  ADD PRIMARY KEY (`adminuserlevel_id`),
  ADD KEY `ue_idx` (`adminuserlevel_enabled`);

--
-- Indexes for table `adminuserlogin`
--
ALTER TABLE `adminuserlogin`
  ADD PRIMARY KEY (`adminuserlogin_id`),
  ADD KEY `ue_idx` (`adminuserlogin_enabled`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`inbox_id`),
  ADD KEY `ue_idx` (`user_id`,`startup_id`);

--
-- Indexes for table `sitedata`
--
ALTER TABLE `sitedata`
  ADD PRIMARY KEY (`sitedata_id`),
  ADD KEY `ue_idx` (`sitedata_title`);

--
-- Indexes for table `startup`
--
ALTER TABLE `startup`
  ADD PRIMARY KEY (`startup_id`),
  ADD KEY `ue_idx` (`user_id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`subscriber_id`),
  ADD KEY `ue_idx` (`subscriber_source`,`subscriber_enabled`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `ue_idx` (`transaction_id`,`user_id`,`startup_id`,`transaction_gift`,`transaction_status`);

--
-- Indexes for table `transactiondetail`
--
ALTER TABLE `transactiondetail`
  ADD PRIMARY KEY (`transactiondetail_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `ue_idx` (`user_enabled`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminsitepages`
--
ALTER TABLE `adminsitepages`
  MODIFY `adminsitepages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `adminuseraccess`
--
ALTER TABLE `adminuseraccess`
  MODIFY `adminuseraccess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `adminuserlevel`
--
ALTER TABLE `adminuserlevel`
  MODIFY `adminuserlevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `adminuserlogin`
--
ALTER TABLE `adminuserlogin`
  MODIFY `adminuserlogin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT for table `sitedata`
--
ALTER TABLE `sitedata`
  MODIFY `sitedata_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `startup`
--
ALTER TABLE `startup`
  MODIFY `startup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `subscriber_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `transactiondetail`
--
ALTER TABLE `transactiondetail`
  MODIFY `transactiondetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
