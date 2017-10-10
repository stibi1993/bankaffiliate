-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 24, 2017 at 04:04 PM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expatlive`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attribute_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attributes_custom_labels`
--

CREATE TABLE `attributes_custom_labels` (
  `attribute_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `label` int(11) NOT NULL,
  `lang_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attributes_default_labels`
--

CREATE TABLE `attributes_default_labels` (
  `attribute_id` int(11) NOT NULL,
  `label` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `company_description` text,
  `default_language` int(11) NOT NULL,
  `company_logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_description`, `default_language`, `company_logo`) VALUES
(1, 'Level 1', '', 0, '43371f960d3b667cfed04742cb166bc9.png'),
(4, 'Level 2', '', 0, '245035bffce8a4af48e5ec8a5e798dc0.png'),
(5, 'Level 4', '', 0, '1db34561782f70ea15371a60b0a353b3.jpg'),
(6, 'Level 5', '', 0, 'db42f8caa796805d1dfcc32f01bc489e.jpg'),
(7, 'Level 3', '', 0, ''),
(8, 'Level 6', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `custom_labels`
--

CREATE TABLE `custom_labels` (
  `id` int(11) NOT NULL,
  `line` text NOT NULL,
  `custom_label` text NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custom_labels`
--

INSERT INTO `custom_labels` (`id`, `line`, `custom_label`, `company_id`) VALUES
(1, 'mission', 'MIssionXD', 1),
(2, 'home_country', 'Home CountryXD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_attributes`
--

CREATE TABLE `dynamic_attributes` (
  `attribute_id` int(11) NOT NULL,
  `key` int(11) NOT NULL,
  `value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_attributes_value`
--

CREATE TABLE `dynamic_attributes_value` (
  `id` int(11) NOT NULL,
  `lang_code` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `label` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `document_type` text NOT NULL,
  `mission_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `title`, `upload_date`, `document_type`, `mission_id`, `status`, `userID`) VALUES
(1, '7e1a96cd84dbb1a38a7c25243b9b3e65.pdf', 'L\'expatriation_au_fÃ©minin[1].pdf', '2016-01-18 11:38:33', 'package', 0, 0, 21),
(2, 'bca4c850d1ecd0adb534d7ff605fa0ef.pdf', 'Presentation RHExpat 2015.pdf', '2016-01-12 12:26:47', 'package', 0, 1, 21),
(3, '43d49414880afd4f7b03ac2a8faabb4f.pdf', 'technical-notice-TIKKA-RXP-1.pdf', '2016-01-15 16:20:31', 'package', 2, 1, 1),
(4, 'dbfe9a0c461e0cc0e9616072dd019772.pdf', 'lista_2015_12_21_10_47_52.pdf', '2016-01-15 16:21:25', 'package', 2, 1, 1),
(11, 'dd433091b6c34524ae085d0bf7624bf8.pdf', 'banner tutorial.pdf', '2016-01-18 12:06:43', 'package', 10, 0, 1),
(12, '659888b14e760f6ac4f39b02fce88856.pdf', 'Szerverek_átadása.pdf', '2016-01-18 12:08:11', 'package', 10, 0, 1),
(13, 'a9cf14f23ff21e354884c67fd01a9bc6.pdf', 'logo_RH_2014.pdf', '2016-01-25 11:43:15', 'package', 17, 1, 102),
(14, '282dce6fa30a8f6128c310efe503268b.pdf', 'RH_logo_emploi.pdf', '2016-01-25 11:43:53', 'package', 17, 1, 102),
(15, 'bfa072319b997ab42b7f3f1fae28526f.pdf', 'logo_RH_2014.pdf', '2016-01-25 11:44:06', 'social', 17, 1, 102),
(16, '452b0347035fc0a19be5806c5437cc4e.pdf', 'logo_RH_2014.pdf', '2016-01-29 09:53:27', 'package', 18, 1, 102),
(17, '6183f31bda0d562bd9693130c653c3d8.pdf', 'benner tutorial.pdf', '2016-02-09 14:47:04', 'package', 13, 0, 1),
(18, '6fc93bce3356c75c9a65e6bf533c0105.pdf', 'benner tutorial.pdf', '2016-02-09 14:47:07', 'package', 13, 0, 1),
(19, '66e790995c868fe596761afc7bd800e8.pdf', 'Tablazat_2016.pdf', '2016-02-09 14:59:28', 'package', 13, 0, 1),
(20, '124ce27a5dae0dd7e8baf6db27293696.pdf', 'Igazolofuzet_2016.pdf', '2016-02-09 14:59:17', 'package', 13, 1, 1),
(21, '16ff0386a6c16c51d033a640d6442f6d.pdf', 'Tablazat_2016.pdf', '2016-02-09 14:59:46', 'package', 13, 1, 1),
(22, '69895462179bf665882e7c146315859c.pdf', 'transavia-boardingpass-erwan-allene-3.pdf', '2016-02-12 11:46:54', 'package', 13, 0, 1),
(23, 'da890a8a2e9b91a487fef995054ab1e6.pdf', 'BoardingPass-12.pdf', '2016-02-12 11:46:45', 'package', 13, 0, 1),
(24, 'faa02cef46919451ae2a170451fa39d8.pdf', 'elbow&wrist joint complex of AAPY.pdf', '2016-02-12 11:47:03', 'social', 13, 0, 1),
(25, '351770b7d834fdcce53a624ef3efd482.pdf', 'transavia-boardingpass-erwan-allene-3.pdf', '2016-02-12 11:46:59', 'social', 13, 0, 1),
(26, '1453b2f48c3a5f77716656e15a7d3bbf.pdf', 'À propos des piles.pdf', '2016-02-12 11:47:20', 'relocation', 13, 1, 1),
(27, '252043e938997949697ddf25d9c2438e.pdf', 'AT__B2CFR1000000861.pdf', '2016-02-12 11:47:35', 'relocation', 13, 1, 1),
(28, '99dc47cbf3d975e9d3209249b70810a6.pdf', 'À propos des piles.pdf', '2016-02-12 11:50:43', 'package', 25, 0, 111),
(29, '893e9c77c297c7565fc32a5d227e8a5e.pdf', 'adsl_felmondo_nyilatkozat.pdf', '2016-02-12 11:50:39', 'package', 25, 0, 111),
(30, '85a400a55babcc646250c7546dbdc157.pdf', 'Boarding-pass AF.pdf', '2016-02-12 11:50:34', 'social', 25, 0, 111),
(31, '7041b5c8ef21c5aa267183e04e4c0534.pdf', 'Application12270565.pdf', '2016-02-12 11:50:27', 'social', 25, 0, 111),
(32, 'f1812ed2c6cb56987652258a13a491e0.pdf', 'BoardingPass.pdf', '2016-02-12 11:50:46', 'relocation', 25, 0, 111),
(33, '1d4378f1fe68b8af489bd6e664e5a7d8.pdf', 'BoardingPass-2.pdf', '2016-02-12 11:50:49', 'relocation', 25, 0, 111);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Admin'),
(7, 'admin_sales', 'Admin Sales'),
(8, 'partners', 'Partners');

-- --------------------------------------------------------

--
-- Table structure for table `groups_permission`
--

CREATE TABLE `groups_permission` (
  `perm_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_permission`
--

INSERT INTO `groups_permission` (`perm_id`, `group_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 6),
(1, 7),
(1, 8),
(2, 1),
(2, 2),
(2, 4),
(2, 6),
(2, 7),
(2, 8),
(3, 1),
(3, 2),
(3, 4),
(3, 6),
(3, 7),
(3, 8),
(4, 1),
(4, 2),
(4, 4),
(4, 6),
(4, 7),
(4, 8),
(5, 2),
(5, 4),
(5, 8),
(6, 2),
(6, 4),
(6, 8),
(7, 2),
(7, 4),
(7, 8),
(8, 1),
(8, 7),
(9, 1),
(9, 7),
(10, 1),
(10, 7),
(14, 2),
(14, 4),
(14, 8),
(15, 2),
(15, 4),
(15, 5),
(15, 8),
(16, 2),
(16, 4),
(16, 5),
(16, 8),
(17, 2),
(17, 4),
(17, 8),
(18, 2),
(18, 4),
(18, 8),
(19, 2),
(19, 4),
(19, 8),
(20, 2),
(20, 4),
(20, 8),
(21, 2),
(21, 4),
(21, 5),
(21, 8),
(22, 2),
(22, 4),
(22, 5),
(22, 8),
(23, 6),
(24, 6),
(25, 6),
(33, 4),
(33, 6),
(33, 8),
(34, 4),
(34, 6),
(34, 8),
(35, 4),
(35, 6),
(35, 8),
(36, 1),
(36, 2),
(36, 4),
(36, 6),
(36, 7),
(36, 8),
(37, 1),
(37, 2),
(37, 4),
(37, 6),
(37, 7),
(37, 8),
(39, 1),
(39, 2),
(39, 4),
(39, 6),
(39, 7),
(39, 8),
(40, 2),
(40, 6),
(40, 8),
(42, 2),
(42, 5),
(42, 6),
(42, 8),
(43, 2),
(43, 4),
(43, 5),
(43, 8),
(44, 1),
(44, 2),
(44, 4),
(44, 6),
(44, 7),
(44, 8),
(45, 1),
(45, 2),
(45, 4),
(45, 6),
(45, 7),
(45, 8),
(46, 1),
(46, 6),
(46, 7),
(47, 1),
(47, 6),
(47, 7),
(48, 1),
(48, 6),
(48, 7),
(49, 2),
(49, 4),
(49, 6),
(49, 8),
(50, 2),
(50, 4),
(50, 5),
(50, 6),
(50, 8),
(51, 2),
(51, 4),
(51, 5),
(51, 6),
(51, 8),
(53, 2),
(53, 4),
(53, 5),
(53, 8),
(54, 2),
(54, 4),
(54, 5),
(54, 8),
(55, 1),
(55, 2),
(55, 4),
(55, 6),
(55, 8),
(56, 6),
(59, 5),
(59, 8),
(60, 2),
(60, 4),
(60, 8),
(61, 2),
(61, 4),
(61, 8),
(62, 2),
(62, 4),
(62, 8),
(63, 2),
(63, 5),
(64, 1),
(64, 5),
(64, 7),
(65, 5),
(67, 1),
(67, 7),
(68, 5),
(69, 4),
(69, 8),
(70, 1),
(71, 1),
(72, 1),
(73, 1);

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` int(11) NOT NULL,
  `label_code` text NOT NULL,
  `page` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `label_code`, `page`) VALUES
(1, 'employee_name', 'employee'),
(3, 'employee_first_name', 'employee'),
(4, 'employee_title', 'employee'),
(5, 'employee_serial_number', 'employee'),
(6, 'employee_vip', 'employee'),
(7, 'employee_office_phone', 'employee'),
(8, 'employee_mobile_phone', 'employee'),
(9, 'employee_email', 'employee'),
(10, 'employee_comments', 'employee'),
(11, 'employee_users', 'employee'),
(12, 'family_name', 'family'),
(13, 'family_firstname', 'family'),
(14, 'family_relation', 'family'),
(15, 'family_birthday', 'family'),
(16, 'family_tax_dependant', 'family'),
(17, 'family_on_assignment', 'family'),
(18, 'mission_home_home_country', 'mission_home'),
(19, 'mission_home_home_city', 'mission_home'),
(20, 'mission_home_home_company', 'mission_home'),
(21, 'mission_home_home_companys_address', 'mission_home'),
(22, 'mission_home_home_countrys_profession', 'mission_home'),
(23, 'mission_home_home_countrys_supervisor', 'mission_home'),
(24, 'mission_home_phone_number', 'mission_home'),
(25, 'mission_home_email', 'mission_home'),
(26, 'mission_home_family_composition', 'mission_home'),
(27, 'mission_home_emergency_name', 'mission_home'),
(28, 'mission_home_emergency_relation', 'mission_home'),
(29, 'mission_home_emergency_phone_number', 'mission_home'),
(30, 'mission_home_emergency_email', 'mission_home'),
(31, 'mission_home_google_maps_code', 'mission_home'),
(32, 'mission_home_comment', 'mission_home'),
(33, 'mission_host_host_country', 'mission_host'),
(34, 'mission_host_host_city', 'mission_host'),
(35, 'mission_host_host_company', 'mission_host'),
(36, 'mission_host_host_companys_address', 'mission_host'),
(37, 'mission_host_host_countrys_profession', 'mission_host'),
(38, 'mission_host_host_countrys_supervisor', 'mission_host'),
(39, 'mission_host_phone_number', 'mission_host'),
(40, 'mission_host_email', 'mission_host'),
(41, 'mission_host_family_composition', 'mission_host'),
(42, 'mission_host_emergency_name', 'mission_host'),
(43, 'mission_host_emergency_relation', 'mission_host'),
(44, 'mission_host_emergency_phone_number', 'mission_host'),
(45, 'mission_host_emergency_email', 'mission_host'),
(46, 'mission_host_google_maps_code', 'mission_host'),
(47, 'mission_host_comment', 'mission_host'),
(48, 'mission_general_start_assignment', 'mission_general'),
(49, 'mission_general_projected_end_assignment', 'mission_general'),
(50, 'mission_general_actual_end_assignment', 'mission_general'),
(51, 'mission_general_type_of_mobility', 'mission_general'),
(52, 'mission_general_team_member', 'mission_general'),
(53, 'mission_general_hr_in_charge', 'mission_general'),
(54, 'mission_general_comments_box', 'mission_general'),
(55, 'mission_general_Package', 'mission_general'),
(56, 'mission_general_contract', 'mission_general'),
(57, 'mission_general_social_coverage_affiliation', 'mission_general'),
(58, 'mission_general_immigration', 'mission_general'),
(59, 'mission_general_move_in', 'mission_general'),
(60, 'mission_general_relocation', 'mission_general'),
(61, 'mission_general_retour_social_coverage_affiliation', 'mission_general'),
(62, 'mission_general_retour_immigration', 'mission_general'),
(63, 'mission_general_retour_move_out', 'mission_general'),
(64, 'mission_general_retour_relocation', 'mission_general'),
(65, 'mission_social_social_coverage_status', 'mission_social'),
(66, 'mission_social_affili_start_date', 'mission_social'),
(67, 'mission_social_affili_end_date', 'mission_social'),
(68, 'mission_social_home_country', 'mission_social'),
(69, 'mission_social_provider', 'mission_social'),
(70, 'mission_social_contact_details', 'mission_social'),
(71, 'mission_social_assistance_provided', 'mission_social'),
(72, 'mission_social_assistance_provided', 'mission_social'),
(73, 'mission_social_notifi_issued_date', 'mission_social'),
(74, 'mission_social_tax_status', 'mission_social'),
(75, 'mission_social_comments', 'mission_social'),
(76, 'mission_social_type_issued_date', 'mission_social'),
(77, 'mission_social_type_expiry_date', 'mission_social'),
(78, 'mission_relocation_home_provider', 'mission_relocation'),
(79, 'mission_relocation_home_contact', 'mission_relocation'),
(80, 'mission_relocation_home_storage', 'mission_relocation'),
(81, 'mission_relocation_work_issued_date', 'mission_relocation'),
(82, 'mission_relocation_work_expiry_date', 'mission_relocation'),
(83, 'mission_relocation_residence_issued_date', 'mission_relocation'),
(84, 'mission_relocation_residence_expiry_date', 'mission_relocation'),
(85, 'mission_relocation_host_provider', 'mission_relocation'),
(86, 'mission_relocation_host_contact', 'mission_relocation'),
(87, 'mission_relocation_comments', 'mission_relocation'),
(88, 'mission_social_host_country', 'mission_social'),
(89, 'mission_social_provider2', 'mission_social'),
(90, 'mission_social_contact_details2', 'mission_social'),
(91, 'mission_social_assistance_provided2', 'mission_social'),
(92, 'mission_social_notifi_issued_date2', 'mission_social'),
(93, 'mission_social_tax_status2', 'mission_social');

-- --------------------------------------------------------

--
-- Table structure for table `labels_custom`
--

CREATE TABLE `labels_custom` (
  `id` int(11) NOT NULL,
  `label_id` int(11) NOT NULL,
  `custom_label` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `lang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `labels_custom`
--

INSERT INTO `labels_custom` (`id`, `label_id`, `custom_label`, `company_id`, `lang`) VALUES
(28, 1, 'Custom Employee Name2', 5, 'en'),
(29, 3, 'Employee Custom First Name', 5, 'en'),
(30, 4, 'Custom Employee Title', 5, 'en'),
(31, 20, 'Mission custom Home Company', 5, 'en'),
(32, 93, 'tax stat 2 custom', 5, 'en'),
(359, 1, 'Nom', 4, 'fr'),
(360, 3, 'Prénom', 4, 'fr'),
(361, 4, 'Civilté', 4, 'fr'),
(362, 5, 'Marticule', 4, 'fr'),
(363, 6, 'VIP', 4, 'fr'),
(364, 7, 'Téléphone bureau', 4, 'fr'),
(365, 8, 'Téléphone portable', 4, 'fr'),
(366, 9, 'E-mail bureau', 4, 'fr'),
(367, 10, 'Commentaires', 4, 'fr'),
(368, 11, 'Utilisateurs', 4, 'fr'),
(369, 12, 'Nom', 4, 'fr'),
(370, 13, 'Prénom', 4, 'fr'),
(371, 14, 'Relation', 4, 'fr'),
(372, 15, 'Date de Naissance', 4, 'fr'),
(373, 16, 'A charge fiscale', 4, 'fr'),
(374, 17, 'Accompagne l´expatrié', 4, 'fr'),
(375, 18, 'Pays d´origine', 4, 'fr'),
(376, 19, 'Ville d´origine', 4, 'fr'),
(377, 20, 'Société d´origine', 4, 'fr'),
(378, 21, 'Adresse Société d´origine', 4, 'fr'),
(379, 22, 'Fonction Pays d´origine', 4, 'fr'),
(380, 23, 'Supérieur hiérarchique Pays d´origine', 4, 'fr'),
(381, 24, 'Téléphone', 4, 'fr'),
(382, 25, 'Adresse email', 4, 'fr'),
(383, 26, 'Composition Familiale', 4, 'fr'),
(384, 27, 'Nom', 4, 'fr'),
(385, 28, 'Lien de parenté', 4, 'fr'),
(386, 29, 'Numéro de téléphone', 4, 'fr'),
(387, 30, 'Adresse email', 4, 'fr'),
(388, 31, 'Module Google Map', 4, 'fr'),
(389, 32, 'Commentaires', 4, 'fr'),
(390, 33, 'Pays d´accueil', 4, 'fr'),
(391, 34, 'Pays d´accueil', 4, 'fr'),
(392, 35, 'Société d´accueil', 4, 'fr'),
(393, 36, 'Adresse Société d´accueil', 4, 'fr'),
(394, 37, 'Fonction Pays d´accueil', 4, 'fr'),
(395, 38, 'Supérieur hiérarchique Pays d´accueil', 4, 'fr'),
(396, 39, 'Téléphone', 4, 'fr'),
(397, 40, 'Adresse email', 4, 'fr'),
(398, 41, 'Composition familiale', 4, 'fr'),
(399, 42, 'Nom', 4, 'fr'),
(400, 43, 'Lien de parenté', 4, 'fr'),
(401, 44, 'Numéro de téléphone', 4, 'fr'),
(402, 45, 'Adresse email', 4, 'fr'),
(403, 46, 'Module Google Map', 4, 'fr'),
(404, 47, 'Commentaires', 4, 'fr'),
(405, 33, 'Pays d´accueil', 4, 'fr'),
(406, 34, 'Pays d´accueil', 4, 'fr'),
(407, 35, 'Société d´accueil', 4, 'fr'),
(408, 36, 'Adresse Société d´accueil', 4, 'fr'),
(409, 37, 'Fonction Pays d´accueil', 4, 'fr'),
(410, 38, 'Supérieur hiérarchique Pays d´accueil', 4, 'fr'),
(411, 39, 'Téléphone', 4, 'fr'),
(412, 40, 'Adresse email', 4, 'fr'),
(413, 41, 'Composition familiale', 4, 'fr'),
(414, 42, 'Nom', 4, 'fr'),
(415, 43, 'Lien de parenté', 4, 'fr'),
(416, 44, 'Numéro de téléphone', 4, 'fr'),
(417, 45, 'Adresse email', 4, 'fr'),
(418, 46, 'Module Google Map', 4, 'fr'),
(419, 47, 'Commentaires', 4, 'fr'),
(420, 48, 'Début de mission', 4, 'fr'),
(421, 49, 'Fin prévisionnelle de la mission', 4, 'fr'),
(422, 50, 'Date réelle fin de mission', 4, 'fr'),
(423, 51, 'Statut - Politique MI', 4, 'fr'),
(424, 52, 'Gestionnaire en charge du dossier', 4, 'fr'),
(425, 53, 'RH de référence', 4, 'fr'),
(426, 54, 'Commentaires', 4, 'fr'),
(427, 55, 'Package', 4, 'fr'),
(428, 56, 'Contrat', 4, 'fr'),
(429, 57, 'Affiliation', 4, 'fr'),
(430, 58, 'Immigration', 4, 'fr'),
(431, 59, 'Déménagement', 4, 'fr'),
(432, 60, 'Relocation', 4, 'fr'),
(433, 61, 'Affiliation', 4, 'fr'),
(434, 62, 'Immigration', 4, 'fr'),
(435, 63, 'Déménagement', 4, 'fr'),
(436, 64, 'Relocation', 4, 'fr'),
(437, 65, 'Statut Sécurité Sociale', 4, 'fr'),
(438, 66, 'Date de début de validité', 4, 'fr'),
(439, 67, 'Date de fin de validité', 4, 'fr'),
(440, 68, 'Pays d´origine', 4, 'fr'),
(441, 69, 'Prestataire', 4, 'fr'),
(442, 70, 'Coordonnées', 4, 'fr'),
(443, 71, 'Type d´assistance', 4, 'fr'),
(444, 72, 'Type d´assistance', 4, 'fr'),
(445, 73, 'Date d´envoi E-mail notification départ', 4, 'fr'),
(446, 74, 'Statut fiscal', 4, 'fr'),
(447, 75, 'Commentaires', 4, 'fr'),
(448, 76, 'Début affiliation', 4, 'fr'),
(449, 77, 'Fin affiliation', 4, 'fr'),
(450, 88, 'Pays d´accueil', 4, 'fr'),
(451, 89, 'Prestataire', 4, 'fr'),
(452, 90, 'Coordonnées', 4, 'fr'),
(453, 91, 'Type d´assistance', 4, 'fr'),
(454, 92, 'Date d´envoi E-mail notification départ', 4, 'fr'),
(455, 93, 'Statut fiscal', 4, 'fr'),
(456, 78, 'Société mandatée', 4, 'fr'),
(457, 79, 'Adresse email contact', 4, 'fr'),
(458, 80, 'Garde meuble', 4, 'fr'),
(459, 81, 'Date de début de validité', 4, 'fr'),
(460, 82, 'Date de fin de validité', 4, 'fr'),
(461, 83, 'Date de début de validité', 4, 'fr'),
(462, 84, 'Date de fin de validité', 4, 'fr'),
(463, 85, 'Société mandatée', 4, 'fr'),
(464, 86, 'Adresse email contact', 4, 'fr'),
(465, 87, 'Commentaires', 4, 'fr');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language_name` varchar(100) NOT NULL,
  `language_directory` varchar(100) NOT NULL,
  `slug` varchar(10) NOT NULL,
  `language_code` varchar(20) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `language_directory`, `slug`, `language_code`, `default`) VALUES
(4, 'France', 'french', 'fr', 'fr', 0),
(5, 'English', 'english', 'en', 'en', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `normal_attributes_value`
--

CREATE TABLE `normal_attributes_value` (
  `id` int(11) NOT NULL,
  `lang_code` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` text,
  `definition` text,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `definition`, `active`) VALUES
(1, 'edit_users', 'can add, edit, delete a user', 1),
(2, 'view_users', 'can view a user', 1),
(3, 'list_users', 'can view the users list page', 1),
(4, 'create_users', 'can create a user', 1),
(8, 'edit_companies', 'can add, edit, delete a company', 1),
(9, 'view_companies', 'can view a company', 1),
(10, 'list_companies', 'can view the companies list page', 1),
(36, 'edit_user', 'can add, edit, delete the user', 1),
(37, 'view_user', 'can view the user', 1),
(39, 'list_user', 'can view the user list page', 1),
(44, 'edit_dash', 'can add, edit, delete the dash', 1),
(45, 'view_dash', 'can view the dash', 1),
(46, 'list_group', 'can view the lists list group', 1),
(47, 'edit_group', 'can add, edit, delete the group', 1),
(48, 'view_group', 'can view the group', 1),
(55, 'list_dash', 'can see the dash menu button', 1),
(64, 'all_missions', 'Able to see all company\'s missions', 1),
(67, 'edit_self', 'able to edit own data', 1),
(70, 'admin', 'admin permission for group member tabulate', 1),
(71, 'view_languages', 'You can see the languages', 1),
(72, 'edit_languages', 'You can edit  the languages', 1),
(73, 'list_languages', 'You can list languages', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stat_dates`
--

CREATE TABLE `stat_dates` (
  `id` int(11) NOT NULL,
  `month` text NOT NULL,
  `month_date` text NOT NULL,
  `lang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stat_dates`
--

INSERT INTO `stat_dates` (`id`, `month`, `month_date`, `lang_id`) VALUES
(1, 'January', '01', 5),
(2, 'February', '02', 5),
(3, 'March', '03', 5),
(4, 'April', '04', 5),
(5, 'May', '05', 5),
(6, 'June', '06', 5),
(7, 'July', '07', 5),
(8, 'August', '08', 5),
(9, 'September', '09', 5),
(10, 'October', '10', 5),
(11, 'November', '11', 5),
(12, 'December', '12', 5);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `id` int(11) NOT NULL,
  `created` date NOT NULL,
  `name` text NOT NULL,
  `employee_id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_picture` text NOT NULL,
  `default_lang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `user_picture`, `default_lang`) VALUES
(1, '127.0.0.1', 'admin', '$2y$08$EclHLJJf53n/QPK/1TLXOuYR8jTF6noiJ9hAcYgYoEzuHTsLwnXpW', '', 'admin@admin.com', '', NULL, NULL, 'gUald0tMYXsAQyWAiy97/O', 1268889823, 1503583314, 1, 'Istvan', 'Kaholics', 1, '', 'f5d9d3eeb4940d25bd2ce756d765d644.jpg', 'en'),
(69, '2.14.28.172', 'RHexpat', '$2y$08$WOpSrR0WqQEvKZlHttqMd.kf6laJk73xWvrpKPWenGTeX4YmbSKDa', NULL, 'rhexpat@rhexpat.fr', NULL, NULL, NULL, NULL, 1452583675, 1455632684, 1, 'RH', 'Expat', 1, '', '', 'en'),
(71, '81.53.153.42', 'rhadmin', '$2y$08$9g1V1rHhmpGdbQhQQDBRy.bvHZNBrkYQvQxfXFefLkxQD.uK4aVXm', NULL, 'rhadmin@rhadmin.com', NULL, NULL, NULL, NULL, 1452762412, 1460102333, 1, 'rh', 'admin', 1, '', '', 'en'),
(102, '82.224.232.59', 'Alexandre', '$2y$08$UOpSEs/kGVPjTSgwDUGFdOvg7d04l6k9o8wWhjEkmB/bt.AMj2KsS', NULL, 'alexandre.tournaud@myexpatjob.com', NULL, NULL, NULL, 'cGlrLSpqMgyJqBh2wJ8GYO', 1453720112, 1461059928, 1, 'Alexandre', 'Tournaud', 4, '', 'ea32037e8da00a8fe82433d14a3ef68d.jpg', 'fr'),
(103, '82.224.232.59', 'Sonia', '$2y$08$7HNvmGcxWyM.1.vzwpsxIeSwLg5jUJCd0.xQaTFjNX.2OalFbuWBy', NULL, 'sonia.poggi@rhexpat.com', NULL, NULL, NULL, 'RLk4eO1.cCo3wRJjcuoKUe', 1453896189, 1455631254, 1, 'Sonia', 'Poggi', 4, '', '', 'fr'),
(104, '82.224.232.59', 'Grace', '$2y$08$lUqToeFkxOdP3kiAo6TyeOgchSC0Cha4XLRpUWilNC6ClrU8DfSlS', NULL, 'grace.negui@rhexpat.com', NULL, NULL, NULL, NULL, 1453896225, 1455634843, 1, 'Grace', 'Nagui', 4, '', '', 'fr'),
(105, '89.133.129.161', 'userL1 - societe A', '$2y$08$7W1Q42gxb38o0hQmdL7/NuQ.sXpteegVxhK6UiERhEy1uGaB2ULnC', NULL, 'userL1@societeA.com', NULL, NULL, NULL, 'MCfi2.LT.WFfZ4A7V8EQOO', 1454846846, 1461237634, 1, 'userL1', 'Société A', 5, '', '47109692f1d5d8caf5b52d31f98ee193.jpg', 'en'),
(106, '89.133.129.161', 'userL2a - societe A', '$2y$08$4zRaWGxfZfhBEx907ihbq.mV/sE2ZC6chkyNFM8XLGa2TLZSN47tG', NULL, 'userL2a@societeA.com', NULL, NULL, NULL, NULL, 1454847078, 1455631392, 1, 'userL2a', 'société A', 5, '', '81463f1fe781db9b5a8de940c54ce01a.jpg', 'fr'),
(107, '89.133.129.161', 'userL2b - societe A', '$2y$08$tC9CGFVMzhvAHBGHnWMg5uASDIsxf3LuoHGgwEhemyO8.oFHsujVy', NULL, 'userL2b@societeA.com', NULL, NULL, NULL, 'It7Ti8ZhBqSzX35S9kIK5O', 1454847317, 1454855675, 1, 'userL2b', 'societe A', 5, '', '476a658e3fee8e0e89db271e2dd79e0e.jpg', 'en'),
(108, '89.133.129.161', 'userL3a - societeA', '$2y$08$Giu1YPmbWmzPl/WYw6HzDOANnJkYw1DKLH3e.lqfDeT9fg1VwFqze', NULL, 'userL3a@societeA.com', NULL, NULL, NULL, NULL, 1454848321, 1460126400, 1, 'userL3a', 'societeA', 5, '', 'a15e640cbb45c00ad4f969f5fa756150.jpg', 'en'),
(109, '89.133.129.161', 'userL3b - societeA', '$2y$08$v1QMGNRQqoGODcb48sLt6.fEvJq/OBqa5zQseWgtmFLcok8qmFInC', NULL, 'userL3b@societeA.com', NULL, NULL, NULL, NULL, 1454848770, 1461077155, 1, 'userL3b', 'societeA', 5, '', '45a58b74f20cd2036e6254271b4e5514.jpg', 'en'),
(111, '81.183.108.95', 'erwan@allene.fr', '$2y$08$h5nN9bDOObD.wFFmrHVoX.ONL20IiVOWHXzLbvFB1bwSVcqkS8uLy', NULL, 'erwan@allene.fr', NULL, NULL, NULL, NULL, 1455277707, 1479327950, 1, 'erwan', 'allene', 5, '', '', 'fr'),
(112, '84.1.204.151', 'L2@L2.fr', '$2y$08$Tl6lMlYigKU7aMm32ICw..3GYsrb6INmmGxly3iA/R4.87wPNfHPm', NULL, 'L2@L2.fr', NULL, NULL, NULL, NULL, 1455624130, 1455624581, 1, 'L2', 'L2', 5, '', '', 'en'),
(113, '84.1.204.151', 'L3@L3.fr', '$2y$08$lOj5LAsEa4vYBiGzHgymuuLEFIouV.9u41EaoCjWIGTVYj3UjmBiy', NULL, 'L3@L3.fr', NULL, NULL, NULL, '4l4J4GEjhw6LP.sls2ok/.', 1455624990, 1460104195, 1, 'L3', 'L3', 5, '', 'd02ecd3881e1106b7fed57b36ba51844.jpg', 'en'),
(114, '145.236.13.154', 'joinpaintball', '$2y$08$t7RjlU5pj.P4pkdfzUcMCO8T8.76ZOOxQjkqkG6RtrPXWz6adIvei', NULL, 'joinpaintball@gmail.com', NULL, NULL, NULL, NULL, 1459429607, 1461058480, 1, 'Istvan', 'Kaholics', 1, '', '', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(369, 1, 1),
(365, 69, 7),
(366, 71, 7),
(359, 102, 8),
(343, 105, 8),
(368, 111, 8),
(360, 114, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertracking`
--

CREATE TABLE `usertracking` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `user_identifier` varchar(255) NOT NULL,
  `request_uri` text NOT NULL,
  `timestamp` varchar(20) NOT NULL,
  `client_ip` varchar(50) NOT NULL,
  `client_user_agent` text NOT NULL,
  `referer_page` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD UNIQUE KEY `attribute_id` (`attribute_id`,`entity_id`),
  ADD KEY `attribute_id_2` (`attribute_id`);

--
-- Indexes for table `attributes_default_labels`
--
ALTER TABLE `attributes_default_labels`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `custom_labels`
--
ALTER TABLE `custom_labels`
  ADD KEY `id` (`id`);

--
-- Indexes for table `dynamic_attributes`
--
ALTER TABLE `dynamic_attributes`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_permission`
--
ALTER TABLE `groups_permission`
  ADD KEY `perm_id_group_id_index` (`perm_id`,`group_id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels_custom`
--
ALTER TABLE `labels_custom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_index` (`id`);

--
-- Indexes for table `stat_dates`
--
ALTER TABLE `stat_dates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `usertracking`
--
ALTER TABLE `usertracking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `custom_labels`
--
ALTER TABLE `custom_labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `labels_custom`
--
ALTER TABLE `labels_custom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `stat_dates`
--
ALTER TABLE `stat_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;
--
-- AUTO_INCREMENT for table `usertracking`
--
ALTER TABLE `usertracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD CONSTRAINT `login_attempts_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
