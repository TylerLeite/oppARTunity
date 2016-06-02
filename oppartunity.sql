-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2014 at 07:48 PM
-- Server version: 5.5.32-cll-lve
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oppartunity`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Registered', '{"standard": 1"}'),
(2, 'Standard', '{"standard": 1, "donor": 1}'),
(3, 'Administrator', '{"standard": 1, "donor": 1, "admin": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `uploader` varchar(64) NOT NULL,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `name`, `uploader`, `title`) VALUES
(1, 'uploads/white/Scout 1.png', 'tyler', ''),
(2, 'uploads/black/Knife.png', 'tyler', ''),
(3, 'uploads/brown/0102141347.png', 'tyler', ''),
(5, 'uploads/green/image.png', 'rchandran', ''),
(6, 'uploads/green/image.png', 'rchandran', ''),
(7, 'uploads/orange/image7.png', 'rchandran', ''),
(8, 'uploads/white/image.png', 'rchandran', ''),
(9, 'uploads/brown/image2.png', 'rchandran', ''),
(11, 'uploads/purple/image.png', 'rchandran', ''),
(12, 'uploads/white/Danny54.png', 'GuacoTaco2014', ''),
(13, 'uploads/pink/image.png', 'Rev D', ''),
(14, 'uploads/blue/364.png', 'Kyleite', ''),
(16, 'uploads/pink/image2.png', 'Rev D', ''),
(17, 'uploads/white/032.png', 'Kyleite', ''),
(18, 'uploads/red/image.png', 'rchandran', ''),
(19, 'uploads/black/Untitled.png', 'tyler', ''),
(20, 'uploads/orange/image.png', 'rchandran', ''),
(21, 'uploads/pink/image.png', 'rchandran', ''),
(22, 'uploads/brown/Scout 2.png', 'tyler', ''),
(23, 'uploads/white/image1.png', 'rchandran', ''),
(24, 'uploads/blue/IMG_7789.png', 'gabbyoc', ''),
(25, 'uploads/pink/IMG_7474.png', 'gabbyoc', ''),
(26, 'uploads/red/IMG_7013.png', 'gabbyoc', ''),
(27, 'uploads/blue/IMG_7015.png', 'gabbyoc', ''),
(28, 'uploads/white/IMG_7518.png', 'gabbyoc', ''),
(29, 'uploads/brown/IMG_1258.png', 'gg97', ''),
(30, 'uploads/green/IMG_6498.png', 'AllyB', ''),
(31, 'uploads/black/IMG_7193.png', 'AllyB', ''),
(32, 'uploads/black/image1.png', 'mdhugs', ''),
(33, 'uploads/brown/image.png', 'mdhugs', ''),
(34, 'uploads/gray/image1.png', 'mdhugs', ''),
(35, 'uploads/white/image3.png', 'mdhugs', ''),
(36, 'uploads/purple/image1.png', 'mdhugs', ''),
(37, 'uploads/blue/image1.png', 'mdhugs', ''),
(38, 'uploads/brown/image1.png', 'mdhugs', ''),
(39, 'uploads/blue/image2.png', 'mdhugs', ''),
(40, 'uploads/white/image2.png', 'mdhugs', ''),
(41, 'uploads/blue/image3.png', 'mdhugs', ''),
(42, 'uploads/black/image.png', 'mdhugs', ''),
(43, 'uploads/black/Bob the Flash Drive.png', 'tyler', 'Bob the Flash Drive'),
(44, 'uploads/blue/image4.png', 'rchandran', 'Pajama'),
(45, 'uploads/red/Shing.png', 'tyler', 'Sunshine'),
(46, 'uploads/blue/Whirlpool.png', 'tyler', 'Whirlpool'),
(47, 'uploads/yellow/Abstract 1.png', 'tyler', 'Burning Lines'),
(48, 'uploads/orange/Sing.png', 'tyler', 'Sing'),
(49, 'uploads/gray/rps20140103_120055.png', 'tyler', 'Scout 3'),
(50, 'uploads/brown/DSC05809.png', 'atkdesigns', 'Suitcase Dog Bed'),
(51, 'uploads/red/IMG_4107.png', 'tyler', 'Laser Bloom'),
(52, 'uploads/brown/0103142010.png', 'tyler', 'Portrait'),
(53, 'uploads/brown/image3.png', 'mdhugs', 'Doge');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` text NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `name`, `joined`, `group`) VALUES
(1, 'tyler', 'f6dc46da3db7e83cee277b49992e6b9db650f3cde3aea6dba8c2e0884824f605', 'ÝEªì9\\Åø9¸ÒåÕ±«j8$kÌ+tâ;©d¼', 'Tyler Leite', '2013-12-17 19:34:51', 3),
(2, 'rchandran', 'cefa329620c335db761a36c78418e7a6ef4b5d41118c32c0fbcf37d60d0bf5dc', '§È Õy9:¸ñ+ä?çu`Ÿþ„ÅjŠéWÆÚÂ8«a', 'Rohit Chandran', '2014-01-02 18:56:09', 3),
(3, 'GuacoTaco2014', 'b581980548c2ada34371108ad4ffa05c364bfde3d0e055f6ca46d0bf66d88aaa', 'Ka‚\0YÆ[û"\Z—Oi„p%\0ŽCÌ\\@?ÛMÄ·G', 'Kapil Chandran', '2014-01-02 19:15:17', 1),
(4, 'Rev D', '6960c6951a5134e9c824296a147531805ffd7a74812f1e46fa689a5e619d91e9', 'Ws^}.t,½²›Ñ‘~«Q\rî''Î³‘\0÷¾ì*Fì', 'Diego Baugh', '2014-01-02 19:38:27', 1),
(5, 'Kyleite', 'f0ac3747b1780803b4d6f4bd02b1bef553944a67d327eaac14030f2ea43a304d', '×7­º—[”{óD½TÙHs¥e´šÃ^Ëd—Že\0]¢Üx', 'Kyle Leite', '2014-01-02 19:39:56', 1),
(6, 'gabbyoc', '252a8d03efffa7b606a535ea054501951ebea29d8311ca7a9f6a5d0827043dd4', 'ú\Zîøm½pÈƒ”I’–ÿþä¾Zm%*''$êLIäÖ', 'Gabby OC', '2014-01-02 21:57:05', 1),
(7, 'gg97', '6527725a0f3efe653a2ae31f51b411acd1363e3c89ac248fcf10e82f19785981', 'k9¨Á\0’àƒÉÄ‘.2ô@''Zx\0nö»úZIU', 'Gabriel Groz', '2014-01-02 22:25:42', 1),
(8, 'AllyB', '4bb4bd068912b0356978121685541143364f34c81373a25a96d2f0456e61ba73', '×\Z´ó$^aZâ¹©;„Ü‰³ÃFÀ¼/ûÑ’3', 'Ally B. ', '2014-01-02 22:32:59', 1),
(9, 'mdhugs', 'b03ec800a3091787c25c33e569b97114c42b9c5232f8940241cfde1c3c2d098e', '=[FX°r»¶³n´+ùÊð8‰VÈÃ–hžïæê’â', 'Matthew Huggins', '2014-01-02 23:42:26', 1),
(10, 'Sekharch', '1949d0655e653d45e07a0fe38cae66e22ff40dcd34ee1a03ecdc02cfade1533e', 'ëÐ\Z#>ãœé/›‡ÖCÅÉê´Fù1(dÎ_Ï)', 'Sekhar Chandran', '2014-01-03 06:11:49', 1),
(11, 'calebcole203', '12f8b7bcfb7429d81978556b5fa99b3482d11605b5a2b6d7310efbdcbbbb9c92', '˜2’˜HlÈh-Û£BÛï³wœâß ?y\r’Ú=Û', 'Caleb shapiro', '2014-01-03 19:52:41', 1),
(12, 'atkdesigns', '35df54dcf120be2493cabb16ee17611c37622a5035b9a3fce0eb63c59401b316', 'ýûŠ2ˆ„èõ(<<ÀfB÷Ô„)¿„+Ú”¾uLøh', 'atkdesigns', '2014-01-03 23:58:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users_session`
--

INSERT INTO `users_session` (`id`, `user_id`, `hash`) VALUES
(11, 4, 'fe90f7d32fd05f2463ce20ae13b8c7f09aebb8760921e4ffca7b7563fc2ed9a9'),
(20, 2, '678680e903aeec1e8235fe264273bbd518ba44f100c067521358cc3e87981a64'),
(21, 1, '9c89d45842c684f6332b16bcb638254e37ea4df25d026e5cc05c939f8444c2f4'),
(23, 6, '1bd16398471fce1ed971baf3e412bb9828164af27954ffd55cf63b89dd9d4fcb'),
(25, 9, '39fca19b9ef472c8f46e6acdd0bb128de581a725b1f0d1f54fee315335491519');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
