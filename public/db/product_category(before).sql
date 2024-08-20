-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 24, 2014 at 02:32 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `permalink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_header` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalink` (`permalink`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=76 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `parent_id`, `permalink`, `name`, `is_header`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `is_deleted`) VALUES
(1, 0, 'komputer-rakitan', 'Komputer Rakitan', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(2, 0, 'component-pc', 'Component PC', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(3, 0, 'accessories', 'Accessories', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(4, 0, 'gaming-stuff', 'Gaming Stuff', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(5, 0, 'cctv', 'CCTV', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(6, 0, 'hardisk-external', 'Harddisk External', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(7, 0, 'nano-pc', 'Nano PC', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(8, 0, 'notebook', 'Notebook', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(9, 0, 'projector', 'Projector', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(10, 0, 'printer&scanner', 'Printer & Scanner', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(11, 0, 'ups&stabilizer', 'UPS & Stabilizer', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(12, 0, 'pc-branded', 'PC Branded', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(13, 1, 'rakitan-home&office', 'Rakitan Home & Office', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(14, 1, 'rakitan-gaming&design', 'Rakitan Gaming & Design', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(15, 2, 'casing', 'Casing', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(16, 2, 'harddisk', 'Harddisk', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(17, 2, 'keyboard&mouse', 'Keyboard & mouse', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(18, 2, 'memory', 'Memory', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(19, 0, 'monitor', 'Monitor', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(20, 2, 'mother-board', 'Mother Board', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(21, 2, 'processor', 'Processor', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(22, 2, 'vga-card', 'VGA Card', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(23, 3, 'notebook-cooler', 'Notebook Cooler', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(24, 3, 'power-bank', 'Power Bank', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(25, 4, 'razer', 'Razer', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(26, 4, 'roccat', 'Roccat', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(27, 4, 'steel-series', 'Steel Series', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(28, 4, 'tt-esports', 'Tt eSports', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(29, 6, 'external-hdd-2.5', 'External HDD 2.5"', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(30, 6, 'external-hdd-3.5', 'External HDD 3.5"', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(31, 10, 'printer-dot-matrix', 'Printer Dot Matrix', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(32, 10, 'printer-inkjet', 'Printer Inkjet', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(33, 10, 'printer-laser', 'Printer Laser', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(34, 10, 'scanner', 'Scanner', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(35, 11, 'ups', 'UPS', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(36, 11, 'stabilizer', 'Stabilizer', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(37, 15, 'casing-atx', 'Casing ATX', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(38, 15, 'casing-full-tower', 'Casing Full Tower', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(39, 15, 'casing-mini-atx', 'Casing Mini ATX', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(40, 16, 'internal-hdd', 'Internal HDD', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(41, 16, 'server-hdd', 'Server HDD', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(42, 17, 'paket-keyboard+mouse', 'Paket Keyboard + Mouse', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(43, 17, 'mouse_std', 'Mouse Std', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(44, 17, 'keyboard-std', 'Keyboard Std', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(45, 18, 'memory-ddr-2', 'Memory DDR 2', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(46, 18, 'memory-ddr-3', 'Memory DDR 3', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(47, 20, 'motherboard-intel', 'Motherboard Intel', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(48, 20, 'motherboard-amd', 'Motherboard AMD', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(49, 21, 'processor-amd', 'Processor AMD', 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(50, 21, 'processor-intel', 'Processor Intel', 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(51, 22, 'vga-ati-radeon', 'VGA ATI Radeon', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(52, 22, 'vga-nvidia', 'VGA Nvidia', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(53, 0, 'internal-hdd-2.5', 'Internal HDD 2.5"', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(54, 40, 'internal-hdd-3.5', 'Internal HDD 3.5"', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(55, 47, 'motherboard-intel-atom', 'Motherboard Intel Atom', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(56, 47, 'motherboard-intel-socket-775', 'Motherboard Intel Socket 775', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(57, 47, 'motherboard-intel-socket-1150', 'Motherboard Intel Socket 1150', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(58, 47, 'motherboard-intel-socket-1155', 'Motherboard Intel Socket 1155', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(59, 47, 'motherboard-intel-socket-2011', 'Motherboard Intel Socket 2011', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(60, 48, 'motherboard-amd-socket-am2', 'Motherboard AMD Socket AM2', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(61, 48, 'motherboard-amd-socket-am3', 'Motherboard AMD Socket AM3', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(62, 48, 'motherboard-amd-socket-fm1', 'Motherboard AMD Socket FM1', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(63, 48, 'motherboard-amd-socket-fm2', 'Motherboard AMD Socket FM2', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(64, 50, 'intel-socket-775', 'Intel Socket 775', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(65, 50, 'intel-socket-1155', 'Intel Socket 1155', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(66, 50, 'intel-socket-1150', 'Intel Socket 1150', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(67, 50, 'intel-socket-2011', 'Intel Socket 2011', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(68, 50, 'intel-socket-2011-v3', 'Intel Socket 2011 v3', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(69, 50, 'intel-xeon-server', 'Intel Xeon Server', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(70, 49, 'amd-socket-am2-am2+', 'AMD Socket AM2 / AM2+', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(71, 49, 'amd-socket-am3-am3+', 'AMD Socket AM3 / AM3+', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(72, 49, 'amd-socket-am1', 'AMD Socket AM1', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(73, 49, 'amd-socket-fm1', 'AMD Socket FM1', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(74, 49, 'amd-socket-fm2-fm2+', 'AMD Socket FM2 / FM2+', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0),
(75, 49, 'amd-apteron-server', 'AMD Apteron Server', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;