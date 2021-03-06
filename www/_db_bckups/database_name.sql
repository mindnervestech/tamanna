-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2013 at 08:33 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fancy29`
--

-- --------------------------------------------------------

--
-- Table structure for table `country_code`
--

CREATE TABLE IF NOT EXISTS `country_code` (
  `Country` varchar(80) NOT NULL,
  `Code` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fc_admin`
--

CREATE TABLE IF NOT EXISTS `fc_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fc_admin`
--

INSERT INTO `fc_admin` (`id`, `created`, `modified`, `admin_name`, `admin_password`, `email`, `admin_type`, `privileges`, `last_login_date`, `last_logout_date`, `last_login_ip`, `is_verified`, `status`) VALUES
(1, '2013-07-17', '2013-09-24', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'vinu@teamtweaks.com', 'super', 'a:10:{s:5:"users";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:8:"category";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:11:"subcategory";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:7:"product";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:6:"slider";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:5:"video";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:3:"cms";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:5:"order";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:10:"statistics";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:10:"newsletter";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}}', '2013-09-26 01:23:45', '2013-09-26 03:20:41', '192.168.1.18', 'Yes', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fc_admin_settings`
--

CREATE TABLE IF NOT EXISTS `fc_admin_settings` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `site_contact_mail` varchar(200) NOT NULL,
  `site_contact_number` varchar(50) NOT NULL,
  `email_title` varchar(400) NOT NULL,
  `google_verification` varchar(500) NOT NULL,
  `google_verification_code` longtext NOT NULL,
  `facebook_link` varchar(200) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `pinterest` varchar(500) NOT NULL,
  `googleplus_link` varchar(100) NOT NULL,
  `linkedin_link` varchar(500) NOT NULL,
  `rss_link` varchar(500) NOT NULL,
  `youtube_link` varchar(500) NOT NULL,
  `footer_content` varchar(255) NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_keyword` varchar(150) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `fevicon_image` varchar(255) NOT NULL,
  `facebook_api` varchar(100) NOT NULL,
  `facebook_secret_key` varchar(100) NOT NULL,
  `paypal_api_name` varchar(100) NOT NULL,
  `paypal_api_pw` varchar(100) NOT NULL,
  `paypal_api_key` varchar(100) NOT NULL,
  `authorize_net_key` varchar(100) NOT NULL,
  `paypal_id` varchar(500) NOT NULL,
  `paypal_live` enum('1','2') NOT NULL,
  `smtp_port` int(200) NOT NULL,
  `smtp_uname` varchar(200) NOT NULL,
  `smtp_password` varchar(200) NOT NULL,
  `consumer_key` varchar(500) NOT NULL,
  `consumer_secret` varchar(500) NOT NULL,
  `google_client_secret` varchar(500) NOT NULL,
  `google_client_id` varchar(500) NOT NULL,
  `google_redirect_url` varchar(500) NOT NULL,
  `google_developer_key` varchar(500) NOT NULL,
  `facebook_app_id` text NOT NULL,
  `facebook_app_secret` text NOT NULL,
  `like_text` mediumtext NOT NULL,
  `unlike_text` mediumtext NOT NULL,
  `liked_text` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fc_admin_settings`
--

INSERT INTO `fc_admin_settings` (`id`, `site_contact_mail`, `site_contact_number`, `email_title`, `google_verification`, `google_verification_code`, `facebook_link`, `twitter_link`, `pinterest`, `googleplus_link`, `linkedin_link`, `rss_link`, `youtube_link`, `footer_content`, `logo_image`, `meta_title`, `meta_keyword`, `meta_description`, `fevicon_image`, `facebook_api`, `facebook_secret_key`, `paypal_api_name`, `paypal_api_pw`, `paypal_api_key`, `authorize_net_key`, `paypal_id`, `paypal_live`, `smtp_port`, `smtp_uname`, `smtp_password`, `consumer_key`, `consumer_secret`, `google_client_secret`, `google_client_id`, `google_redirect_url`, `google_developer_key`, `facebook_app_id`, `facebook_app_secret`, `like_text`, `unlike_text`, `liked_text`) VALUES
(1, 'info@admire.com', '', 'Admire', '<meta name='' google-site-verification''='''' content=''uGg5pXbCg8ACJwpSYwqbGPWNyKsV5CafyXG2u9irZx4''>', '', 'http://www.facebook.com/fancyclone', 'http://twitter.com/fancyclone', '', 'http://google.com', '', '', '', '&copy;  2013 Rights Reserved by Admire', '9af176223139f6d59e7ee627d7966ad2.png', 'Admire for google', 'Admire', 'Admire', 'cc2ed7d98505681a281e61c34279c3ca.png', '', '', '', '', '', '', 'gopinath@teamtweaks.com', '2', 465, 'admin@teamtweaks.com', '', '3dYFNrBG8e5ycLsNzug', '0TX7zWA3VcFFNY5pANu7oYEVmHTL0k5Cy996Y18BI', 'sdfsa', 'sadf', 'sdfdsa', 'sfdasdf', '594286240609468', 'da4fee8760cbee65c330687f5eb54a06', 'Like', 'Unlike', 'Like''d');

-- --------------------------------------------------------

--
-- Table structure for table `fc_attribute`
--

CREATE TABLE IF NOT EXISTS `fc_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attribute_seourl` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fc_attribute`
--

INSERT INTO `fc_attribute` (`id`, `attribute_name`, `status`, `dateAdded`, `attribute_seourl`) VALUES
(1, 'color', 'Active', '2013-08-16 07:21:38', 'color'),
(2, 'price', 'Active', '2013-08-16 07:21:44', 'price');

-- --------------------------------------------------------

--
-- Table structure for table `fc_banner_category`
--

CREATE TABLE IF NOT EXISTS `fc_banner_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_category`
--

CREATE TABLE IF NOT EXISTS `fc_category` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(500) NOT NULL,
  `rootID` int(20) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `cat_position` int(11) NOT NULL,
  `seo_title` longblob NOT NULL,
  `seo_keyword` longblob NOT NULL,
  `seo_description` longblob NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fc_category`
--

INSERT INTO `fc_category` (`id`, `cat_name`, `rootID`, `seourl`, `image`, `status`, `cat_position`, `seo_title`, `seo_keyword`, `seo_description`, `dateAdded`) VALUES
(1, 'Mens', 0, 'mens', '', 'Active', 0, '', '', '', '2013-09-26 15:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `fc_cms`
--

CREATE TABLE IF NOT EXISTS `fc_cms` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(500) NOT NULL,
  `page_title` varchar(200) NOT NULL,
  `seourl` blob NOT NULL,
  `hidden_page` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category` enum('Main','Sub') NOT NULL DEFAULT 'Main',
  `parent` int(11) NOT NULL DEFAULT '0',
  `meta_tag` varchar(500) NOT NULL,
  `meta_description` blob NOT NULL,
  `description` blob NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_country`
--

CREATE TABLE IF NOT EXISTS `fc_country` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `contid` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `seourl` varchar(750) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_type` char(3) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_symbol` text NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `shipping_tax` decimal(10,2) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `description` longblob NOT NULL,
  `status` enum('Active','InActive') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'Active',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `currency_default` enum('No','Yes') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `fc_country`
--

INSERT INTO `fc_country` (`id`, `contid`, `country_code`, `name`, `seourl`, `currency_type`, `currency_symbol`, `shipping_cost`, `shipping_tax`, `meta_title`, `meta_keyword`, `meta_description`, `description`, `status`, `dateAdded`, `currency_default`) VALUES
(1, 'EU', 'AD', 'Andorra', 'andorra', 'EUR', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-09-06 10:33:27', 'No'),
(2, 'AS', 'AE', 'United Arab Emirates', 'united-arab-emirates', 'AED', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(3, 'AS', 'AF', 'Afghanistan', 'afghanistan', 'AFN', '₱', '3.00', '0.00', '', '', '', '', 'Active', '2013-09-14 03:38:13', 'No'),
(4, 'NA', 'AG', 'Antigua And Barbuda', 'antigua-and-barbuda', 'XCD', '$', '2.00', '3.00', '', '', '', '', 'Active', '2013-08-22 05:08:52', 'No'),
(5, 'EU', 'AL', 'Albania', 'albania', 'ALL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(6, 'AS', 'AM', 'Armenia', 'armenia', 'AMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(7, 'AF', 'AO', 'Angola', 'angola', 'AOA', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(8, 'AN', 'AQ', 'Antarctica', 'antarctica', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(9, 'SA', 'AR', 'Argentina', 'argentina', 'ARS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(10, 'OC', 'AS', 'American Samoa', 'american-samoa', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(11, 'EU', 'AT', 'Austria', 'austria', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(12, 'OC', 'AU', 'Australia', 'australia', 'AUD', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-09-06 07:40:37', 'No'),
(13, 'NA', 'AW', 'Aruba', 'aruba', 'AWG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(14, '', 'AX', 'Aland Islands', 'aland-islands', 'EUR', '€', '0.00', '0.00', '', '', '', '', 'Active', '2013-09-11 00:39:28', 'No'),
(15, 'AS', 'AZ', 'Azerbaijan', 'azerbaijan', 'AZN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(16, '', 'BA', 'Bosnia And Herzegovina', 'bosnia-and-herzegovina', 'BAM', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(17, 'NA', 'BB', 'Barbados', 'barbados', 'BBD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(18, 'AS', 'BD', 'Bangladesh', 'bangladesh', 'BDT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(19, 'EU', 'BE', 'Belgium', 'belgium', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(20, 'AF', 'BF', 'Burkina Faso', 'burkina-faso', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(21, 'EU', 'BG', 'Bulgaria', 'bulgaria', 'BGN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(22, 'AS', 'BH', 'Bahrain', 'bahrain', 'BHD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(23, 'AF', 'BI', 'Burundi', 'burundi', 'BIF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(24, 'AF', 'BJ', 'Benin', 'benin', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(25, 'NA', 'BM', 'Bermuda', 'bermuda', 'BMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(26, '', 'BN', 'Brunei', 'brunei', 'BND', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(27, 'SA', 'BO', 'Bolivia', 'bolivia', 'BOB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(28, '', 'BQ', 'Bonaire, Saint Eustatius And Saba ', 'bonaire,-saint-eustatius-and-saba', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(29, 'SA', 'BR', 'Brazil', 'brazil', 'BRL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(30, 'NA', 'BS', 'Bahamas', 'bahamas', 'BSD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(31, 'AS', 'BT', 'Bhutan', 'bhutan', 'BTN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(32, 'AN', 'BV', 'Bouvet Island', 'bouvet-island', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(33, 'AF', 'BW', 'Botswana', 'botswana', 'BWP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(34, 'EU', 'BY', 'Belarus', 'belarus', 'BYR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(35, 'NA', 'BZ', 'Belize', 'belize', 'BZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(36, 'NA', 'CA', 'Canada', 'canada', 'CAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(37, '', 'CD', 'Democratic Republic Of The Congo', 'democratic-republic-of-the-congo', 'DRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(38, 'AF', 'CF', 'Central African Republic', 'central-african-republic', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(39, '', 'CG', 'Republic Of The Congo', 'republic-of-the-congo', 'DRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(40, 'EU', 'CH', 'Switzerland', 'switzerland', 'CHF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(41, '', 'CI', 'Ivory Coast', 'ivory-coast', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(42, 'SA', 'CL', 'Chile', 'chile', 'CLP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(43, 'AF', 'CM', 'Cameroon', 'cameroon', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(44, 'AS', 'CN', 'China', 'china', 'CNY', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(45, 'SA', 'CO', 'Colombia', 'colombia', 'COP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(46, 'NA', 'CR', 'Costa Rica', 'costa-rica', 'CRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(47, 'NA', 'CU', 'Cuba', 'cuba', 'CUP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(48, 'AF', 'CV', 'Cape Verde', 'cape-verde', 'CVE', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(49, 'EU', 'CY', 'Cyprus', 'cyprus', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(50, 'EU', 'CZ', 'Czech Republic', 'czech-republic', 'CZK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(51, 'EU', 'DE', 'Germany', 'germany', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(52, 'AF', 'DJ', 'Djibouti', 'djibouti', 'DJF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(53, 'EU', 'DK', 'Denmark', 'denmark', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(54, 'NA', 'DM', 'Dominica', 'dominica', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(55, 'NA', 'DO', 'Dominican Republic', 'dominican-republic', 'DOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(56, 'AF', 'DZ', 'Algeria', 'algeria', 'DZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(57, 'SA', 'EC', 'Ecuador', 'ecuador', 'ECS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(58, 'EU', 'EE', 'Estonia', 'estonia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(59, 'AF', 'EG', 'Egypt', 'egypt', 'EGP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(60, 'AF', 'EH', 'Western Sahara', 'western-sahara', 'MAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(61, 'AF', 'ER', 'Eritrea', 'eritrea', 'ERN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(62, 'EU', 'ES', 'Spain', 'spain', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(63, 'AF', 'ET', 'Ethiopia', 'ethiopia', 'ETB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(64, 'EU', 'FI', 'Finland', 'finland', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(65, 'OC', 'FJ', 'Fiji', 'fiji', 'FJD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(66, '', 'FM', 'Micronesia', 'micronesia', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(67, 'EU', 'FO', 'Faroe Islands', 'faroe-islands', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(68, 'EU', 'FR', 'France', 'france', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(69, 'AF', 'GA', 'Gabon', 'gabon', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(70, 'EU', 'GB', 'United Kingdom', 'united-kingdom', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(71, 'NA', 'GD', 'Grenada', 'grenada', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(72, 'AS', 'GE', 'Georgia', 'georgia', 'GEL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(73, 'SA', 'GF', 'French Guiana', 'french-guiana', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(74, '', 'GG', 'Guernsey', 'guernsey', 'GGP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(75, 'AF', 'GH', 'Ghana', 'ghana', 'GHS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(76, 'NA', 'GL', 'Greenland', 'greenland', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(77, 'AF', 'GM', 'Gambia', 'gambia', 'GMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(78, 'AF', 'GN', 'Guinea', 'guinea', 'GNF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(79, 'NA', 'GP', 'Guadeloupe', 'guadeloupe', 'EUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(80, 'AF', 'GQ', 'Equatorial Guinea', 'equatorial-guinea', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(81, 'EU', 'GR', 'Greece', 'greece', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(82, 'NA', 'GT', 'Guatemala', 'guatemala', 'QTQ', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(83, 'OC', 'GU', 'Guam', 'guam', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(84, 'AF', 'GW', 'Guinea-Bissau', 'guineabissau', 'GWP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(85, 'SA', 'GY', 'Guyana', 'guyana', 'GYD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(86, 'AS', 'HK', 'Hong Kong', 'hong-kong', 'HKD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(87, 'NA', 'HN', 'Honduras', 'honduras', 'HNL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(88, 'EU', 'HR', 'Croatia', 'croatia', 'HRK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(89, 'NA', 'HT', 'Haiti', 'haiti', 'HTG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(90, 'EU', 'HU', 'Hungary', 'hungary', 'HUF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(91, 'AS', 'ID', 'Indonesia', 'indonesia', 'IDR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(92, 'EU', 'IE', 'Ireland', 'ireland', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(93, 'AS', 'IL', 'Israel', 'israel', 'ILS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(94, '', 'IM', 'Isle Of Man', 'isle-of-man', 'GBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(95, 'AS', 'IN', 'India', 'india', 'INR', 'Rs', '15.00', '10.00', '', '', '', '', 'Active', '2013-08-22 05:09:55', 'No'),
(96, 'AS', 'IO', 'British Indian Ocean Territory', 'british-indian-ocean-territory', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(97, 'AS', 'IQ', 'Iraq', 'iraq', 'IQD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(98, '', 'IR', 'Iran', 'iran', 'IRR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(99, 'EU', 'IS', 'Iceland', 'iceland', 'ISK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(100, 'EU', 'IT', 'Italy', 'italy', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(101, '', 'JE', 'Jersey', 'jersey', 'GBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(102, 'NA', 'JM', 'Jamaica', 'jamaica', 'JMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(103, 'AS', 'JO', 'Jordan', 'jordan', 'JOD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(104, 'AS', 'JP', 'Japan', 'japan', 'JPY', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(105, 'AF', 'KE', 'Kenya', 'kenya', 'KES', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(106, 'AS', 'KG', 'Kyrgyzstan', 'kyrgyzstan', 'KGS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(107, 'AS', 'KH', 'Cambodia', 'cambodia', 'KHR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(108, 'OC', 'KI', 'Kiribati', 'kiribati', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(109, 'AF', 'KM', 'Comoros', 'comoros', 'KMF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(110, 'NA', 'KN', 'Saint Kitts And Nevis', 'saint-kitts-and-nevis', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(111, '', 'KP', 'North Korea', 'north-korea', 'KPW', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(112, '', 'KR', 'South Korea', 'south-korea', 'KRW', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(113, 'AS', 'KW', 'Kuwait', 'kuwait', 'KWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(114, 'AS', 'KZ', 'Kazakhstan', 'kazakhstan', 'KZT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(115, '', 'LA', 'Laos', 'laos', 'LAK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(116, 'AS', 'LB', 'Lebanon', 'lebanon', 'LBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(117, 'NA', 'LC', 'Saint Lucia', 'saint-lucia', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(118, 'EU', 'LI', 'Liechtenstein', 'liechtenstein', 'CHF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(119, 'AS', 'LK', 'Sri Lanka', 'sri-lanka', 'LKR', 'Rs', '20.00', '12.00', '', '', '', '', 'Active', '2013-08-22 05:35:34', 'No'),
(120, 'AF', 'LR', 'Liberia', 'liberia', 'LRD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(121, 'AF', 'LS', 'Lesotho', 'lesotho', 'LSL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(122, 'EU', 'LT', 'Lithuania', 'lithuania', 'LTL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(123, 'EU', 'LU', 'Luxembourg', 'luxembourg', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(124, 'EU', 'LV', 'Latvia', 'latvia', 'LVL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(125, '', 'LY', 'Libya', 'libya', 'LYD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(126, 'AF', 'MA', 'Morocco', 'morocco', 'MAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(127, 'EU', 'MC', 'Monaco', 'monaco', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(128, '', 'MD', 'Moldova', 'moldova', 'MDL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(129, '', 'ME', 'Montenegro', 'montenegro', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(130, 'AF', 'MG', 'Madagascar', 'madagascar', 'MGF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(131, 'OC', 'MH', 'Marshall Islands', 'marshall-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(132, '', 'MK', 'Macedonia', 'macedonia', 'MKD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(133, 'AF', 'ML', 'Mali', 'mali', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(134, 'AS', 'MM', 'Myanmar', 'myanmar', 'MMK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(135, 'AS', 'MN', 'Mongolia', 'mongolia', 'MNT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(136, '', 'MO', 'Macao', 'macao', 'MOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(137, 'OC', 'MP', 'Northern Mariana Islands', 'northern-mariana-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(138, 'NA', 'MQ', 'Martinique', 'martinique', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(139, 'AF', 'MR', 'Mauritania', 'mauritania', 'MRO', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(140, 'NA', 'MS', 'Montserrat', 'montserrat', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(141, 'AF', 'MU', 'Mauritius', 'mauritius', 'MUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(142, 'AS', 'MV', 'Maldives', 'maldives', 'MVR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(143, 'AF', 'MW', 'Malawi', 'malawi', 'MWK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(144, 'NA', 'MX', 'Mexico', 'mexico', 'MXN', '', '0.00', '0.00', '', '', '', 0x3c703e3c7374726f6e673e54726176656c696e6720746f204d657869636f3c2f7374726f6e673e3c2f703e0d0a3c703e4d657869636f207661636174696f6e2072656e74616c7320616e64204d657869636f207661636174696f6e20686f6d6573206861766520696e6372656173656420696e20766f6c756d652c206173206861732074686520746f757269736d20696e64757374727920696e2074686520617265612e2054686973206973206f6e65206f6620746865206d6f737420706f70756c617220706c6163657320746f20766973697420696e207468652077686f6c65206f66204e6f7274682020416d657269636120616e64206974206973206561737920746f20736565207768792e204d657869636f20636f766572732061206875676520737572666163652061726561206f662061726f756e64203736302c30303020737175617265206d696c65732c207768696368206d65616e73207468657265206973206365727461696e6c79206e6f7420612073686f7274616765206f66207468696e677320746f2073656520616e6420646f20686572652e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e5468696e677320746f20646f20696e204d657869636f3c2f7374726f6e673e3c2f703e0d0a3c703e416674657220636865636b696e6720696e746f204d657869636f207661636174696f6e2072656e74616c7320616e64204d657869636f207661636174696f6e20686f6d65732c206c697374696e672074686520706c6163657320746f207669736974206973206365727461696e6c79206120776f727468207768696c65207468696e6720746f20646f2e204f6e65207468696e672074686174207468697320706c616365206973206b6e6f776e20666f7220697320686176696e6720736f6d65206772656174207369746573206f66206172636861656f6c6f676963616c20696e7465726573742c2077686963682061726520677265617420776974682070656f706c652074686174206c6f766520746f206578706c6f72652e2049742077617320686572652074686174206d616e7920646966666572656e7420666f726d73206f6620636f6d6d756e69636174696f6e207765726520646576656c6f7065642c20696e636c7564696e672077726974696e672e20416c6f6e677369646520746869732c206c6f7473206f662061726974686d6574696320616e6420617374726f6e6f6d7920626173656420646973636f7665726965732068617665206265656e206d6164652068657265206f766572207468652063656e7475726965732c207768696368206d616b6573207468697320616e20696e746572657374696e6720706c61636520746f20766973697420666f7220616c6c206f66207468652066616d696c792e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e4f6620636f757273652c206120766973697420746f2061204d657869636f207661636174696f6e2072656e74616c2077696c6c20616c6c6f772070656f706c6520746f206578706c6f726520736f6d65206f6620746865206d616e792062656163686573207468617420617265206f6e206f666665722e20546865207265616c6974792069732074686174207468657265206973206365727461696e6c79206e6f7420612073686f7274616765206f6620746f70207175616c697479206265616368657320746f206578706c6f72652e204d657869636f20697320686f6d6520746f2061726f756e6420362c303030206d696c6573206f6620636f617374206c696e652c207768696368206d65616e7320746861742074686572652061726520612067726561742072616e6765206f6620646966666572656e7420626561636865732c20696e636c7564696e6720636f7665732c2063617665732062757420616c736f20736d616c6c20626179732e20546865207761766573206865726520617265206e6f7420706172746963756c61726c79206c617267652c20627574206d616e79206f66207468652062656163686573206172652077656c6c206b6e6f776e20666f7220696e636f72706f726174696e67206578636974696e672077617465722073706f72747320696e746f20657665727920646179206c6966652e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e416c6f6e677369646520746865206265616368657320616e6420746865206d616e79206172636861656f6c6f676963616c20646973636f76657269657320746861742061726520776f727468206578706c6f72696e672c20616e6f74686572206f7074696f6e20697320746f20657870657269656e6365206d616e79206f662074686520616476656e7475726573207468617420617265206f6e206f666665722e204d657869636f2069732066756c6c206f6620746f7572206775696465732074686174207370656369616c69736520696e20616c6c207479706573206f66207468696e67732e205468697320696e636c7564657320746865206c696b6573206f662034783420746f7572732c2062757420616c736f206775696465642077616c6b7320616e64206d6f756e7461696e2062696b652072696465732e205468697320616c6c6f77732070656f706c6520746f206578706c6f7265207468697320677265617420706c616365207573696e6720646966666572656e7420666f726d73206f66207472616e73706f72742c20776869636820616c6c6f7773207468656d20746f20736565204d657869636f20696e20612077686f6c65206e6577206c696768742e204f6620636f757273652c2074686572652061726520706c656e7479206f66206f7074696f6e7320746f2063686f6f73652066726f6d20686572652e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e4163636f6d6d6f646174696f6e7320696e204d657869636f3c2f7374726f6e673e3c2f703e0d0a3c703e4163636f6d6d6f646174696f6e7320696e204d657869636f2068617665206265656e206120687567652070617274206f662068656c70696e6720746f2067726f772074686520746f757269736d20696e64757374727920686572652e20546865205269747a204361726c746f6e206973206365727461696e6c79206f6e65206f6620746865206772656174657220686f74656c7320696e2074686520617265612e204a75737420696e2066726f6e74206f662069742c2069732061726f756e6420312c3230306674206f662077686974652073616e64792062656163682c207768696368206d65616e732072656c6178696e672068657265206973206365727461696e6c79206e6f7420676f696e6720746f20626520646966666963756c742e20497420697320636f6e76656e69656e746c79206c6f63617465642c207768696368206d65616e73207468617420616c6c20746865206d616a6f722061747472616374696f6e73206172652077697468696e20612073686f72742064697374616e6365206f662074686520686f74656c20686572652e2054686520666163696c6974696573206865726520617265206d6f7265207468616e206c75787572696f757320616e6420746865792068656c702070656f706c6520746f2073656520746865207472756520626561757479206f66204d657869636f2e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c7374726f6e673e5765617468657220696e204d657869636f3c2f7374726f6e673e3c2f703e0d0a3c703e546865207765617468657220696e204d657869636f206973206b6e6f776e20666f72206265696e6720657863657074696f6e616c20647572696e67207468652073756d6d6572206d6f6e7468732c207768696368206d616b6573206974207065726665637420666f7220612073756d6d6572207661636174696f6e2e20447572696e67207468652073756d6d6572206d6f6e7468732c207468726f7567686f757420746869732067726561742064657374696e6174696f6e2c2076697369746f72732073686f756c64206578706563742074656d706572617475726573206f662061726f756e6420323820266465673b43207768696368206973207761726d2c20627574206365727461696e6c7920636f6d666f727461626c65206174207468652073616d652074696d652e20497420697320647572696e67207468652073756d6d6572206d6f6e746873207468617420746865206d616a6f72697479206f662074686520746f757269737473207468617420766973697420686572652e3c2f703e, 'Active', '2013-08-22 04:57:12', 'No'),
(145, 'AS', 'MY', 'Malaysia', 'malaysia', 'MYR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(146, 'AF', 'MZ', 'Mozambique', 'mozambique', 'MZN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(147, 'AF', 'NA', 'Namibia', 'namibia', 'NAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(148, 'OC', 'NC', 'New Caledonia', 'new-caledonia', 'CFP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(149, 'AF', 'NE', 'Niger', 'niger', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(150, 'AF', 'NG', 'Nigeria', 'nigeria', 'NGN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(151, 'NA', 'NI', 'Nicaragua', 'nicaragua', 'NIO', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(152, 'EU', 'NL', 'Netherlands', 'netherlands', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(153, 'EU', 'NO', 'Norway', 'norway', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(154, 'AS', 'NP', 'Nepal', 'nepal', 'NPR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(155, 'OC', 'NR', 'Nauru', 'nauru', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(156, 'OC', 'NZ', 'New Zealand', 'new-zealand', 'NZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(157, 'AS', 'OM', 'Oman', 'oman', 'OMR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(158, 'NA', 'PA', 'Panama', 'panama', 'PAB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(159, 'SA', 'PE', 'Peru', 'peru', 'PEN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(160, 'OC', 'PF', 'French Polynesia', 'french-polynesia', 'CFP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(161, 'OC', 'PG', 'Papua New Guinea', 'papua-new-guinea', 'PGK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(162, 'AS', 'PH', 'Philippines', 'philippines', 'PHP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(163, 'AS', 'PK', 'Pakistan', 'pakistan', 'PKR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(164, 'EU', 'PL', 'Poland', 'poland', 'PLN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(165, '', 'PM', 'Saint Pierre And Miquelon', 'saint-pierre-and-miquelon', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(166, 'NA', 'PR', 'Puerto Rico', 'puerto-rico', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(167, '', 'PS', 'Palestinian Territory', 'palestinian-territory', 'PAB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(168, 'EU', 'PT', 'Portugal', 'portugal', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(169, 'OC', 'PW', 'Palau', 'palau', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(170, 'SA', 'PY', 'Paraguay', 'paraguay', 'PYG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(171, 'AS', 'QA', 'Qatar', 'qatar', 'QAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(172, 'AF', 'RE', 'Reunion', 'reunion', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(173, 'EU', 'RO', 'Romania', 'romania', 'RON', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(174, '', 'RS', 'Serbia', 'serbia', 'RSD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(175, '', 'RU', 'Russia', 'russia', 'RUB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(176, 'AF', 'RW', 'Rwanda', 'rwanda', 'RWF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(177, 'AS', 'SA', 'Saudi Arabia', 'saudi-arabia', 'SAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(178, 'OC', 'SB', 'Solomon Islands', 'solomon-islands', 'SBD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(179, 'AF', 'SC', 'Seychelles', 'seychelles', 'SCR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(180, 'AF', 'SD', 'Sudan', 'sudan', 'SDG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(181, 'EU', 'SE', 'Sweden', 'sweden', 'SEK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(182, 'AS', 'SG', 'Singapore', 'singapore', 'SGD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(183, '', 'SH', 'Saint Helena', 'saint-helena', 'SHP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(184, 'EU', 'SI', 'Slovenia', 'slovenia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(185, '', 'SJ', 'Svalbard And Jan Mayen', 'svalbard-and-jan-mayen', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(186, '', 'SK', 'Slovakia', 'slovakia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(187, 'AF', 'SL', 'Sierra Leone', 'sierra-leone', 'SLL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(188, 'EU', 'SM', 'San Marino', 'san-marino', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(189, 'AF', 'SN', 'Senegal', 'senegal', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(190, 'AF', 'SO', 'Somalia', 'somalia', 'SOS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(191, 'SA', 'SR', 'Suriname', 'suriname', 'SRD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(192, '', 'SS', 'South Sudan', 'south-sudan', 'SSP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(193, 'AF', 'ST', 'Sao Tome And Principe', 'sao-tome-and-principe', 'STD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(194, 'NA', 'SV', 'El Salvador', 'el-salvador', 'SVC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(195, '', 'SY', 'Syria', 'syria', 'SYP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(196, 'AF', 'SZ', 'Swaziland', 'swaziland', 'SZL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(197, 'AF', 'TD', 'Chad', 'chad', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(198, 'AN', 'TF', 'French Southern Territories', 'french-southern-territories', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(199, 'AF', 'TG', 'Togo', 'togo', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(200, 'AS', 'TH', 'Thailand', 'thailand', 'THB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(201, 'AS', 'TJ', 'Tajikistan', 'tajikistan', 'TJS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(202, 'OC', 'TK', 'Tokelau', 'tokelau', 'NZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(203, 'OC', 'TL', 'East Timor', 'east-timor', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(204, 'AS', 'TM', 'Turkmenistan', 'turkmenistan', 'TMT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(205, 'AF', 'TN', 'Tunisia', 'tunisia', 'TND', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(206, 'OC', 'TO', 'Tonga', 'tonga', 'TOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(207, 'AS', 'TR', 'Turkey', 'turkey', 'TRY', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(208, 'NA', 'TT', 'Trinidad And Tobago', 'trinidad-and-tobago', 'TTD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(209, 'OC', 'TV', 'Tuvalu', 'tuvalu', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(210, 'AS', 'TW', 'Taiwan', 'taiwan', 'TWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(211, '', 'TZ', 'Tanzania', 'tanzania', 'TZS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(212, 'EU', 'UA', 'Ukraine', 'ukraine', 'UAH', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(213, 'AF', 'UG', 'Uganda', 'uganda', 'UGX', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(214, 'OC', 'UM', 'United States Minor Outlying Islands', 'united-states-minor-outlying-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(215, 'NA', 'US', 'United States', 'united-states', 'USD', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-09-14 03:38:13', 'Yes'),
(216, 'SA', 'UY', 'Uruguay', 'uruguay', 'UYU', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(217, 'AS', 'UZ', 'Uzbekistan', 'uzbekistan', 'UZS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(218, 'NA', 'VC', 'Saint Vincent And The Grenadines', 'saint-vincent-and-the-grenadines', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(219, 'SA', 'VE', 'Venezuela', 'venezuela', 'VEF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(220, '', 'VI', 'U.S. Virgin Islands', 'u.s.-virgin-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(221, '', 'VN', 'Vietnam', 'vietnam', 'VND', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(222, 'OC', 'VU', 'Vanuatu', 'vanuatu', 'VUV', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(223, '', 'WF', 'Wallis And Futuna', 'wallis-and-futuna', 'XPF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(224, 'OC', 'WS', 'Samoa', 'samoa', 'WST', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(225, '', 'XK', 'Kosovo', 'kosovo', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(226, 'AS', 'YE', 'Yemen', 'yemen', 'YER', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(227, 'AF', 'YT', 'Mayotte', 'mayotte', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(228, 'AF', 'ZA', 'South Africa', 'south-africa', 'ZAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(229, 'AF', 'ZM', 'Zambia', 'zambia', 'ZMW', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No'),
(230, 'AF', 'ZW', 'Zimbabwe', 'zimbabwe', 'ZWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-22 04:57:12', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `fc_couponcards`
--

CREATE TABLE IF NOT EXISTS `fc_couponcards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `price_type` enum('1','2','3') NOT NULL DEFAULT '1',
  `coupon_type` varchar(500) NOT NULL,
  `price_value` float(10,2) NOT NULL,
  `quantity` int(100) NOT NULL,
  `description` blob NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `product_id` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `purchase_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_fancybox`
--

CREATE TABLE IF NOT EXISTS `fc_fancybox` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `excerpt` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `image` longtext NOT NULL,
  `price` float(10,2) NOT NULL,
  `likes` bigint(20) NOT NULL,
  `comments` bigint(20) NOT NULL,
  `shipping_cost` float(10,2) NOT NULL,
  `tax` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `seourl` mediumtext NOT NULL,
  `category_id` longtext NOT NULL,
  `price_range` mediumtext NOT NULL,
  `purchased` bigint(20) NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `meta_title` mediumtext NOT NULL,
  `meta_keyword` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_fancybox_temp`
--

CREATE TABLE IF NOT EXISTS `fc_fancybox_temp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `fancybox_id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `price` float(10,2) NOT NULL,
  `fancy_ship_cost` float(10,2) NOT NULL,
  `fancy_tax_cost` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seourl` mediumtext NOT NULL,
  `category_id` longtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `invoice_no` varchar(150) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_fancybox_uses`
--

CREATE TABLE IF NOT EXISTS `fc_fancybox_uses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `fancybox_id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `price` float(10,2) NOT NULL,
  `fancy_ship_cost` float(10,2) NOT NULL,
  `fancy_tax_cost` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seourl` mediumtext NOT NULL,
  `category_id` longtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `status` enum('Pending','Paid','Expired') NOT NULL DEFAULT 'Pending',
  `shipping_id` int(11) NOT NULL,
  `invoice_no` varchar(150) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `trans_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_giftcards`
--

CREATE TABLE IF NOT EXISTS `fc_giftcards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient_name` varchar(200) NOT NULL,
  `recipient_mail` varchar(200) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `sender_mail` varchar(200) NOT NULL,
  `price_value` float(10,2) NOT NULL,
  `description` blob NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `used_amount` decimal(10,2) NOT NULL,
  `payer_email` varchar(500) NOT NULL,
  `paypal_transaction_id` varchar(500) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_giftcards_settings`
--

CREATE TABLE IF NOT EXISTS `fc_giftcards_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `amounts` varchar(200) NOT NULL,
  `default_amount` varchar(100) NOT NULL,
  `expiry_days` int(11) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_giftcards_temp`
--

CREATE TABLE IF NOT EXISTS `fc_giftcards_temp` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient_name` varchar(200) NOT NULL,
  `recipient_mail` varchar(200) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `sender_mail` varchar(200) NOT NULL,
  `price_value` float(10,2) NOT NULL,
  `description` blob NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_languages`
--

CREATE TABLE IF NOT EXISTS `fc_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lang_code` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `fc_languages`
--

INSERT INTO `fc_languages` (`id`, `name`, `lang_code`, `status`) VALUES
(1, 'English', 'en', 'Active'),
(2, 'Català', 'ca', 'Active'),
(4, 'dansk', 'da', 'Inactive'),
(5, 'Deutsch', 'de', 'Active'),
(7, 'Español', 'es', 'Inactive'),
(8, 'Eesti', 'et', 'Inactive'),
(9, 'Basque', 'eu', 'Active'),
(10, 'Filipino', 'fil', 'Inactive'),
(11, 'français', 'fr', 'Inactive'),
(12, 'Indonesian', 'id', 'Inactive'),
(13, 'Íslenska', 'is', 'Inactive'),
(14, 'Italiano', 'it', 'Inactive'),
(15, 'Lithuanian', 'lt', 'Inactive'),
(16, 'Nederlands', 'nl', 'Inactive'),
(17, 'norsk', 'no', 'Inactive'),
(18, 'Polski', 'pl', 'Inactive'),
(19, 'Português (br)', 'br', 'Inactive'),
(20, 'Português (pt)', 'pt', 'Inactive'),
(23, 'Slovenský', 'sk', 'Inactive'),
(24, 'Suomi', 'fi', 'Inactive'),
(27, 'Türkçe', 'tr', 'Inactive'),
(30, 'srpski (latinica)', 'sr-latn', 'Inactive'),
(31, 'svenska', 'sv', 'Inactive'),
(32, 'Thai', 'th', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `fc_lists`
--

CREATE TABLE IF NOT EXISTS `fc_lists` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` longtext NOT NULL,
  `followers` longtext NOT NULL,
  `banner` varchar(200) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `contributors` longtext NOT NULL,
  `contributors_invited` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_list_values`
--

CREATE TABLE IF NOT EXISTS `fc_list_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `list_value` varchar(200) NOT NULL,
  `products` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers` longtext NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `list_value_seourl` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `fc_list_values`
--

INSERT INTO `fc_list_values` (`id`, `list_id`, `list_value`, `products`, `product_count`, `followers`, `followers_count`, `list_value_seourl`) VALUES
(1, 1, 'blue', '', 0, '', 0, 'blue'),
(2, 1, 'white', '', 0, '', 0, 'white'),
(3, 1, 'red', '', 0, '', 0, 'red'),
(4, 1, 'pink', '', 0, '', 0, 'pink'),
(5, 1, 'purple', '', 0, '', 0, 'purple'),
(6, 1, 'skyblue', '', 0, '', 0, 'skyblue'),
(7, 1, 'green', '', 0, '', 0, 'green'),
(8, 1, 'yellow', '', 0, '', 0, 'yellow'),
(9, 1, 'orange', '', 0, '', 0, 'orange'),
(10, 1, 'brown', '', 0, '', 0, 'brown'),
(11, 1, 'black', '', 0, '', 0, 'black'),
(12, 1, 'silver', '', 0, '', 0, 'silver'),
(13, 1, 'gold', '', 0, '', 0, 'gold'),
(14, 2, '1-20', '', 0, '', 0, '1-20'),
(15, 2, '21-100', '', 0, '', 0, '21-100'),
(16, 2, '101-200', '', 0, '', 0, '101-200'),
(17, 2, '201-500', '', 0, '', 0, '201-500'),
(18, 2, '501+', '', 0, '', 0, '501');

-- --------------------------------------------------------

--
-- Table structure for table `fc_location`
--

CREATE TABLE IF NOT EXISTS `fc_location` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(1000) NOT NULL,
  `location_code` varchar(500) NOT NULL,
  `iso_code2` varchar(500) NOT NULL,
  `iso_code3` varchar(500) NOT NULL,
  `country_tax` float(10,2) NOT NULL,
  `country_ship` decimal(10,2) NOT NULL,
  `seourl` varchar(1000) NOT NULL,
  `currency_type` varchar(500) NOT NULL,
  `currency_symbol` varchar(500) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `fc_location`
--

INSERT INTO `fc_location` (`id`, `location_name`, `location_code`, `iso_code2`, `iso_code3`, `country_tax`, `country_ship`, `seourl`, `currency_type`, `currency_symbol`, `status`, `dateAdded`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 'IN', '', '', '', 5.00, '15.00', 'india', 'INR', 'Rs', 'InActive', '2013-07-26 04:10:15', '', '', ''),
(3, 'USA', '', 'US', 'USA', 1.00, '0.00', 'usa', 'USD', '$', 'Active', '2013-07-26 12:00:00', 0x555341, 0x555341, 0x555341),
(6, 'Uk', '', '', '', 10.00, '10.00', 'uk', 'USD', '$', 'InActive', '2013-07-29 13:00:00', '', '', ''),
(7, 'Australia', '', 'AU', '', 10.00, '20.00', 'australia', 'AUD', '$', 'InActive', '2013-08-21 11:00:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fc_newsletter`
--

CREATE TABLE IF NOT EXISTS `fc_newsletter` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(5000) NOT NULL,
  `news_descrip` blob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `news_image` varchar(500) NOT NULL,
  `news_subject` varchar(1000) NOT NULL,
  `sender_name` varchar(500) NOT NULL,
  `sender_email` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_notifications`
--

CREATE TABLE IF NOT EXISTS `fc_notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `activity` mediumtext COLLATE utf8_bin NOT NULL,
  `activity_id` bigint(20) NOT NULL,
  `activity_ip` mediumtext COLLATE utf8_bin NOT NULL,
  `comment_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_payment`
--

CREATE TABLE IF NOT EXISTS `fc_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(100) NOT NULL,
  `sell_id` bigint(20) NOT NULL,
  `product_id` int(100) NOT NULL,
  `price` varchar(500) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `coupon_id` varchar(200) NOT NULL,
  `discountAmount` varchar(500) NOT NULL,
  `couponCode` varchar(500) NOT NULL,
  `coupontype` varchar(500) NOT NULL,
  `shippingid` int(16) NOT NULL,
  `indtotal` varchar(500) NOT NULL,
  `sumtotal` decimal(10,2) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shippingcost` varchar(500) NOT NULL,
  `shippingcountry` varchar(500) NOT NULL,
  `shippingcity` varchar(500) NOT NULL,
  `shippingstate` varchar(500) NOT NULL,
  `paidVoucherStatus` enum('Not Verified','Verified') NOT NULL,
  `paypal_transaction_id` varchar(500) NOT NULL,
  `dealCodeNumber` varchar(500) NOT NULL,
  `inserttime` varchar(65) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL,
  `shipping_date` date NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `shipping_status` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `attribute_values` text NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `note` blob NOT NULL,
  `order_gift` enum('0','1') NOT NULL DEFAULT '0',
  `payer_email` varchar(500) NOT NULL,
  `received_status` enum('Not received yet','Product received','Need refund') NOT NULL,
  `review_status` enum('Not open','Opened','Closed') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_payment_gateway`
--

CREATE TABLE IF NOT EXISTS `fc_payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(200) NOT NULL,
  `settings` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fc_payment_gateway`
--

INSERT INTO `fc_payment_gateway` (`id`, `gateway_name`, `settings`, `status`) VALUES
(1, 'Paypal IPN', 'a:3:{s:4:"mode";s:7:"sandbox";s:14:"merchant_email";s:26:"sivaprakash@teamtweaks.com";s:14:"paypal_ipn_url";s:11:"www.ipn.net";}', 'Enable'),
(2, 'Credit Card (Paypal)', 'a:4:{s:4:"mode";s:7:"sandbox";s:19:"Paypal_API_Username";s:40:"sandbo_1215254764_biz_api1.angelleye.com";s:19:"paypal_api_password";s:10:"1215254774";s:20:"paypal_api_Signature";s:56:"AiKZhEEPLJjSIccz.2M.tbyW5YFwAb6E3l6my.pY9br1z2qxKx96W18v";}', 'Disable'),
(3, 'Credit Card (Authorize.net)', 'a:3:{s:4:"mode";s:7:"sandbox";s:8:"Login_ID";s:8:"3Vf82YuX";s:15:"Transaction_Key";s:16:"47UfHXH638bbH26m";}', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `fc_product`
--

CREATE TABLE IF NOT EXISTS `fc_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `price_range` varchar(100) NOT NULL,
  `sale_price` decimal(20,2) NOT NULL,
  `image` longtext NOT NULL,
  `description` longtext NOT NULL,
  `weight` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchasedCount` int(11) NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL DEFAULT 'Publish',
  `shipping_type` enum('Shippable','Not Shippable') NOT NULL,
  `shipping_cost` decimal(6,2) NOT NULL,
  `taxable_type` enum('Taxable','Not Taxable') NOT NULL,
  `tax_cost` decimal(6,2) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `option` longtext NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `comment_count` bigint(20) NOT NULL,
  `ship_immediate` enum('false','true') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_category`
--

CREATE TABLE IF NOT EXISTS `fc_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_comments`
--

CREATE TABLE IF NOT EXISTS `fc_product_comments` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `product_id` int(200) NOT NULL,
  `comments` longblob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_product_likes`
--

CREATE TABLE IF NOT EXISTS `fc_product_likes` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `product_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_review_comments`
--

CREATE TABLE IF NOT EXISTS `fc_review_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `deal_code` mediumtext NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `commentor_id` bigint(20) NOT NULL,
  `comment` blob NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_from` enum('user','seller','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_shipping_address`
--

CREATE TABLE IF NOT EXISTS `fc_shipping_address` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `nick_name` varchar(200) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone` bigint(9) NOT NULL,
  `primary` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_shopping_carts`
--

CREATE TABLE IF NOT EXISTS `fc_shopping_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL DEFAULT 'No',
  `couponID` int(200) NOT NULL,
  `couponCode` varchar(100) NOT NULL,
  `coupontype` varchar(100) NOT NULL,
  `cate_id` varchar(100) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `attribute_values` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_state_tax`
--

CREATE TABLE IF NOT EXISTS `fc_state_tax` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(500) NOT NULL,
  `state_code` varchar(500) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `state_tax` float(10,2) NOT NULL,
  `country_id` int(100) NOT NULL,
  `country_code` varchar(500) NOT NULL,
  `country_name` varchar(500) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_subadmin`
--

CREATE TABLE IF NOT EXISTS `fc_subadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_subscribers_list`
--

CREATE TABLE IF NOT EXISTS `fc_subscribers_list` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `subscrip_mail` varchar(500) NOT NULL,
  `active` int(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` date NOT NULL,
  `verification_mail` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_users`
--

CREATE TABLE IF NOT EXISTS `fc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginUserType` enum('normal','twitter','facebook','google') NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `group` enum('User','Seller') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `is_verified` enum('Yes','No') NOT NULL,
  `is_brand` enum('no','yes') NOT NULL DEFAULT 'no',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(50) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(20) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `s_address` varchar(100) NOT NULL,
  `s_city` varchar(50) NOT NULL,
  `s_district` varchar(50) NOT NULL,
  `s_state` varchar(50) NOT NULL,
  `s_country` varchar(20) NOT NULL,
  `s_postal_code` int(11) NOT NULL,
  `s_phone_no` varchar(20) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_description` text NOT NULL,
  `commision` int(11) NOT NULL,
  `web_url` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_no` varchar(100) NOT NULL,
  `bank_code` varchar(100) NOT NULL,
  `request_status` enum('Not Requested','Pending','Approved','Rejected') NOT NULL DEFAULT 'Not Requested',
  `verify_code` varchar(10) NOT NULL,
  `feature_product` int(100) NOT NULL,
  `followers_count` int(11) NOT NULL,
  `following_count` int(11) NOT NULL,
  `followers` varchar(200) NOT NULL,
  `following` varchar(200) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `google` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `about` varchar(200) NOT NULL,
  `age` enum('','13 to 17','18 to 24','25 to 34','35 to 44','45 to 54','55+') NOT NULL,
  `gender` enum('Male','Female','Unspecified') NOT NULL DEFAULT 'Unspecified',
  `language` varchar(10) NOT NULL DEFAULT 'en',
  `visibility` enum('Everyone','Only you') NOT NULL,
  `display_lists` enum('Yes','No') NOT NULL,
  `email_notifications` longtext NOT NULL,
  `notifications` longtext NOT NULL,
  `updates` enum('1','0') NOT NULL,
  `products` int(11) NOT NULL,
  `lists` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `location` mediumtext NOT NULL,
  `following_user_lists` longtext NOT NULL,
  `following_giftguide_lists` longtext NOT NULL,
  `api_id` bigint(20) NOT NULL,
  `own_products` longtext NOT NULL,
  `own_count` bigint(20) NOT NULL,
  `referId` int(11) NOT NULL,
  `want_count` bigint(20) NOT NULL,
  `refund_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `paypal_email` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_user_activity`
--

CREATE TABLE IF NOT EXISTS `fc_user_activity` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(200) NOT NULL,
  `activity_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `activity_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_user_product`
--

CREATE TABLE IF NOT EXISTS `fc_user_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_name` varchar(100) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `image` longtext NOT NULL,
  `description` longtext NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL DEFAULT 'Publish',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `web_link` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_vendor_payment_table`
--

CREATE TABLE IF NOT EXISTS `fc_vendor_payment_table` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` mediumtext COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_type` mediumtext COLLATE utf8_bin NOT NULL,
  `amount` float(20,2) NOT NULL,
  `status` enum('pending','success','failed') COLLATE utf8_bin NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fc_wants`
--

CREATE TABLE IF NOT EXISTS `fc_wants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `product_id` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
