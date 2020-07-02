-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2020 at 06:45 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `licenta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `parola` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `parola`) VALUES
(1, 'admin', 'dianaadudu@yahoo.com', '0e7517141fb53f21ee439b355b5a1d0a');

-- --------------------------------------------------------

--
-- Table structure for table `ind_gest`
--

CREATE TABLE `ind_gest` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` int(11) NOT NULL,
  `cifra_afaceri` int(100) NOT NULL,
  `sold_mediu` int(100) NOT NULL,
  `stocuri` int(100) NOT NULL,
  `creante` int(100) NOT NULL,
  `vr` int(100) NOT NULL,
  `vrs` int(100) NOT NULL,
  `vrc` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_gest`
--

INSERT INTO `ind_gest` (`id`, `id_companie`, `an`, `cifra_afaceri`, `sold_mediu`, `stocuri`, `creante`, `vr`, `vrs`, `vrc`) VALUES
(1, 21, 2015, 535, 65441, 64674, 767, 44646, 44123, 523),
(2, 21, 2016, 32423, 5948, 5424, 524, 66, 61, 6),
(4, 47, 2015, 59367202, 28070717, 9694410, 18376307, 173, 60, 113),
(5, 47, 2016, 57927504, 23954281, 10473722, 13480559, 151, 66, 85),
(6, 47, 2017, 69222576, 28626369, 13150711, 15475658, 151, 69, 82),
(7, 47, 2018, 94361956, 27789452, 14281550, 13507902, 107, 55, 52),
(8, 47, 2019, 67241033, 24868102, 13651955, 11216147, 135, 74, 61);

-- --------------------------------------------------------

--
-- Table structure for table `ind_lic`
--

CREATE TABLE `ind_lic` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` varchar(50) DEFAULT NULL,
  `active_curente` int(100) NOT NULL,
  `stocuri` int(100) NOT NULL,
  `disponibilitati` int(100) NOT NULL,
  `invest_scurt` int(100) NOT NULL,
  `datorii_curente` int(100) NOT NULL,
  `lichiditate_generala` decimal(50,3) NOT NULL,
  `lichiditate_curenta` decimal(50,3) NOT NULL,
  `lichiditate_imediata` decimal(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_lic`
--

INSERT INTO `ind_lic` (`id`, `id_companie`, `an`, `active_curente`, `stocuri`, `disponibilitati`, `invest_scurt`, `datorii_curente`, `lichiditate_generala`, `lichiditate_curenta`, `lichiditate_imediata`) VALUES
(1, 48, '2015', 123, 123, 123, 123, 123, '1.000', '0.000', '2.000'),
(2, 48, '2016', 123, 123, 0, 123, 123, '1.000', '0.000', '0.000'),
(3, 48, '2017', 321, 231, 123, 123, 321, '1.000', '0.280', '0.766'),
(4, 48, '2019', 123, 123, 123, 123, 123, '1.000', '0.000', '2.000'),
(5, 21, '2015', 123, 123, 123, 123, 123, '1.000', '0.000', '2.000'),
(6, 21, '2016', 123, 12321, 123123, 123, 123, '1.000', '-99.171', '1002.000'),
(7, 47, '2015', 40916921, 9694410, 12846204, 0, 20442201, '2.002', '1.527', '0.628'),
(8, 47, '2016', 36542416, 10473722, 12588135, 0, 13079893, '2.794', '1.993', '0.962'),
(9, 47, '2017', 38391853, 13150711, 9765484, 0, 12907361, '2.974', '1.956', '0.757'),
(10, 47, '2018', 38518113, 14281550, 10728661, 0, 9223484, '4.176', '2.628', '1.163'),
(11, 47, '2019', 32128957, 13651955, 7260855, 0, 6717431, '4.783', '2.751', '1.081');

-- --------------------------------------------------------

--
-- Table structure for table `ind_rac`
--

CREATE TABLE `ind_rac` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` int(100) NOT NULL,
  `active_circulante` int(100) NOT NULL,
  `stocuri` int(100) NOT NULL,
  `creante` int(100) NOT NULL,
  `investitii_tscurt` int(100) NOT NULL,
  `disponibilitati` int(100) NOT NULL,
  `active_totale` int(100) NOT NULL,
  `rac` decimal(50,3) NOT NULL,
  `rst` decimal(50,3) NOT NULL,
  `rcr` decimal(50,3) NOT NULL,
  `rits` decimal(50,3) NOT NULL,
  `rdisp` decimal(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_rac`
--

INSERT INTO `ind_rac` (`id`, `id_companie`, `an`, `active_circulante`, `stocuri`, `creante`, `investitii_tscurt`, `disponibilitati`, `active_totale`, `rac`, `rst`, `rcr`, `rits`, `rdisp`) VALUES
(9, 47, 2015, 40916921, 9694410, 18376307, 0, 12846204, 85600132, '47.800', '11.325', '21.468', '0.000', '15.007'),
(10, 47, 2016, 36542416, 10473722, 13480559, 0, 12588135, 79666685, '45.869', '13.147', '16.921', '0.000', '15.801'),
(11, 47, 2017, 38391853, 13150711, 15475658, 0, 9765484, 99504008, '38.583', '13.216', '15.553', '0.000', '9.814'),
(12, 47, 2018, 38518113, 14281550, 13507902, 0, 10728661, 68861990, '55.935', '20.739', '19.616', '0.000', '15.580'),
(13, 47, 2019, 32128957, 13651955, 11216147, 0, 7260855, 70886826, '45.324', '19.259', '15.823', '0.000', '10.243');

-- --------------------------------------------------------

--
-- Table structure for table `ind_rai`
--

CREATE TABLE `ind_rai` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` int(100) NOT NULL,
  `active_imobilizate` int(100) NOT NULL,
  `imobilizari_necorporale` int(100) NOT NULL,
  `imobilizari_corporale` int(100) NOT NULL,
  `imobilizari_financiare` int(100) NOT NULL,
  `active_totale` int(100) NOT NULL,
  `rai` decimal(50,3) NOT NULL,
  `rin` decimal(50,3) NOT NULL,
  `ric` decimal(50,3) NOT NULL,
  `rif` decimal(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_rai`
--

INSERT INTO `ind_rai` (`id`, `id_companie`, `an`, `active_imobilizate`, `imobilizari_necorporale`, `imobilizari_corporale`, `imobilizari_financiare`, `active_totale`, `rai`, `rin`, `ric`, `rif`) VALUES
(5, 21, 2015, 111, 111, 111, 111, 111, '100.000', '100.000', '100.000', '100.000'),
(6, 21, 2016, 85540130, 415234, 85124896, 1, 323096892, '0.129', '0.129', '26.347', '0.000'),
(7, 21, 2017, 91170877, 362758, 90808119, 1, 451234701, '0.080', '0.080', '20.124', '2.216'),
(8, 21, 2019, 85540130, 362758, 85049576, 1, 347755737, '0.104', '0.104', '24.457', '0.000'),
(9, 48, 2015, 123, 123, 123, 123, 123, '100.000', '100.000', '100.000', '100.000'),
(10, 48, 2018, 123, 123, 123, 123, 123, '100.000', '100.000', '100.000', '100.000'),
(11, 48, 2019, 2, 1321, 123, 123, 123, '1073.984', '1073.984', '100.000', '100.000'),
(12, 47, 2015, 39065306, 309448, 38595981, 159877, 85600132, '45.637', '0.362', '45.089', '0.187'),
(13, 47, 2016, 41303730, 204550, 37030727, 4068453, 79666685, '51.846', '0.257', '46.482', '5.107'),
(14, 47, 2017, 29774916, 125289, 24629632, 5019995, 99504008, '29.923', '0.126', '24.752', '5.045'),
(15, 47, 2018, 29264524, 67663, 24065045, 5131816, 68861990, '42.497', '0.098', '34.947', '7.452'),
(16, 47, 2019, 32931303, 104590, 22060386, 10766327, 70886826, '46.456', '0.148', '31.121', '15.188');

-- --------------------------------------------------------

--
-- Table structure for table `ind_rcn`
--

CREATE TABLE `ind_rcn` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` int(100) NOT NULL,
  `profit_net` int(100) NOT NULL,
  `cifra_afaceri` int(100) NOT NULL,
  `rcn` decimal(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_rcn`
--

INSERT INTO `ind_rcn` (`id`, `id_companie`, `an`, `profit_net`, `cifra_afaceri`, `rcn`) VALUES
(1, 21, 2019, 50, 100, '50.000'),
(2, 21, 2018, 654654, 65416514, '1.001'),
(3, 21, 2017, 8974651, 65165474, '13.772'),
(4, 21, 2016, 879879, 999870489, '0.088'),
(5, 48, 2015, 111, 111, '100.000'),
(6, 48, 2016, 41, 41, '100.000'),
(7, 47, 2015, 2136991, 59367202, '3.600'),
(8, 47, 2016, 1227939, 57927504, '2.120'),
(9, 47, 2017, 12647642, 69222576, '18.271'),
(10, 47, 2018, 535602, 94361956, '0.568'),
(11, 47, 2019, 2426170, 67241033, '3.608');

-- --------------------------------------------------------

--
-- Table structure for table `ind_roa`
--

CREATE TABLE `ind_roa` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` int(100) NOT NULL,
  `profit_brut` int(100) NOT NULL,
  `active_totale` int(100) NOT NULL,
  `roa` decimal(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_roa`
--

INSERT INTO `ind_roa` (`id`, `id_companie`, `an`, `profit_brut`, `active_totale`, `roa`) VALUES
(35, 48, 2015, 333, 333, '100.000'),
(36, 48, 2016, 123, 123, '100.000'),
(38, 48, 2017, 123, 123, '100.000'),
(41, 21, 2019, 123, 123, '100.000'),
(43, 48, 2019, 123, 123, '100.000'),
(44, 21, 2015, 213, 123123, '0.173'),
(45, 47, 2015, 2640193, 85600132, '3.084'),
(46, 47, 2016, 1488786, 79666685, '1.869'),
(47, 47, 2017, 14291873, 99504008, '14.363'),
(48, 47, 2018, 515546, 68861990, '0.749'),
(49, 47, 2019, 3333340, 70886826, '4.702');

-- --------------------------------------------------------

--
-- Table structure for table `ind_roe`
--

CREATE TABLE `ind_roe` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` int(100) NOT NULL,
  `profit_net` int(100) NOT NULL,
  `capital_propriu` int(100) NOT NULL,
  `roe` decimal(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_roe`
--

INSERT INTO `ind_roe` (`id`, `id_companie`, `an`, `profit_net`, `capital_propriu`, `roe`) VALUES
(1, 21, 2019, 22, 2, '1100.000'),
(2, 21, 2017, 100, 1000, '10.000'),
(3, 48, 2015, 111, 111, '100.000'),
(4, 48, 2017, 123, 123, '100.000'),
(5, 47, 2015, 2136991, 55956971, '3.819'),
(6, 47, 2016, 1227939, 52525858, '2.338'),
(7, 47, 2017, 12647642, 76593203, '16.513'),
(8, 47, 2018, 535602, 52016765, '1.030'),
(9, 47, 2019, 2426170, 56333503, '4.307');

-- --------------------------------------------------------

--
-- Table structure for table `ind_rsg`
--

CREATE TABLE `ind_rsg` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` int(11) NOT NULL,
  `total_activ` int(100) NOT NULL,
  `datorii_totale` int(100) NOT NULL,
  `rsg` decimal(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_rsg`
--

INSERT INTO `ind_rsg` (`id`, `id_companie`, `an`, `total_activ`, `datorii_totale`, `rsg`) VALUES
(1, 21, 2019, 50, 25, '2.000'),
(2, 21, 2018, 1651, 1000, '1.651'),
(3, 48, 2015, 123, 123, '1.000'),
(7, 48, 2016, 123, 123, '1.000'),
(8, 47, 2015, 85600132, 29643161, '2.888'),
(9, 47, 2016, 79666685, 27140827, '2.935'),
(10, 47, 2017, 99504008, 22910805, '4.343'),
(11, 47, 2018, 68861990, 16845225, '4.088'),
(12, 47, 2019, 70886826, 14553323, '4.871'),
(13, 21, 2015, 123, 123, '1.000');

-- --------------------------------------------------------

--
-- Table structure for table `ind_rsp`
--

CREATE TABLE `ind_rsp` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` int(11) NOT NULL,
  `capital_propriu` int(100) NOT NULL,
  `credite_totale` int(100) NOT NULL,
  `rsp` decimal(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_rsp`
--

INSERT INTO `ind_rsp` (`id`, `id_companie`, `an`, `capital_propriu`, `credite_totale`, `rsp`) VALUES
(1, 21, 2019, 50, 20, '0.714'),
(2, 21, 2018, 65465, 156754, '0.295'),
(3, 48, 2015, 0, 0, '0.000'),
(4, 48, 2017, 213, 123, '0.634'),
(5, 48, 2016, 1321, 23123, '0.054'),
(6, 47, 2015, 55956971, 10975521, '0.836'),
(7, 47, 2016, 52525858, 14653342, '0.782'),
(8, 47, 2017, 76593203, 8612741, '0.899'),
(9, 47, 2018, 52016765, 5066538, '0.911'),
(10, 47, 2019, 56333503, 1993333, '0.966');

-- --------------------------------------------------------

--
-- Table structure for table `ind_sf`
--

CREATE TABLE `ind_sf` (
  `id` int(11) NOT NULL,
  `id_companie` int(11) NOT NULL,
  `an` int(100) NOT NULL,
  `datorii_tlung` int(100) NOT NULL,
  `capital_propriu` int(100) NOT NULL,
  `datorii_totale` int(100) NOT NULL,
  `pasiv_total` int(100) NOT NULL,
  `rsf` decimal(50,2) NOT NULL,
  `rag` decimal(50,2) NOT NULL,
  `ri` decimal(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_sf`
--

INSERT INTO `ind_sf` (`id`, `id_companie`, `an`, `datorii_tlung`, `capital_propriu`, `datorii_totale`, `pasiv_total`, `rsf`, `rag`, `ri`) VALUES
(1, 48, 2015, 111, 11, 111, 11, '1009.09', '100.00', '1009.09'),
(2, 21, 2015, 123, 123, 123, 123, '100.00', '100.00', '100.00'),
(3, 21, 2016, 12323, 21, 321, 123, '10018.70', '17.07', '260.98'),
(4, 47, 2015, 9200960, 55956971, 29643161, 85600132, '76.12', '65.37', '34.63'),
(5, 47, 2016, 14060934, 52525858, 27140827, 79666685, '83.58', '65.93', '34.07'),
(6, 47, 2017, 10003444, 76593203, 22910805, 99504008, '87.03', '76.97', '23.03'),
(7, 47, 2018, 7621741, 52016765, 16845225, 68861990, '86.61', '75.54', '24.46'),
(8, 47, 2019, 7835892, 56333503, 14553323, 70886826, '90.52', '79.47', '20.53');

-- --------------------------------------------------------

--
-- Table structure for table `notificari`
--

CREATE TABLE `notificari` (
  `id` int(11) NOT NULL,
  `expeditor` varchar(50) NOT NULL,
  `destinatar` varchar(50) NOT NULL,
  `tip` varchar(50) NOT NULL,
  `timp` datetime(4) NOT NULL DEFAULT current_timestamp(4)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sugestii`
--

CREATE TABLE `sugestii` (
  `id` int(11) NOT NULL,
  `expeditor` varchar(50) NOT NULL,
  `destinatar` varchar(50) NOT NULL,
  `tip_sugestie` varchar(50) DEFAULT NULL,
  `titlu` varchar(100) NOT NULL,
  `descriere` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id_companie` int(11) NOT NULL,
  `nume` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `companie` varchar(70) NOT NULL,
  `cif` varchar(10) NOT NULL,
  `nrregcom` varchar(15) NOT NULL,
  `stare` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id_companie`, `nume`, `email`, `parola`, `telefon`, `companie`, `cif`, `nrregcom`, `stare`) VALUES
(20, 'George Stoica', 'george@sublimetemplates.com', '488b35b253ada81c53f1be3bb4f04973', '0723607611', 'S.C. Ace of Pixels S.R.L.', 'RO12345678', 'J02/345/2017', 1),
(21, 'George Stoica', 'george@aceofpixels.com', '488b35b253ada81c53f1be3bb4f04973', '0723234234', 'S.C. Companie S.R.L.', '37071333', 'J8/146/2019', 1),
(22, 'Ovidiu Banciu', 'utilizator1@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '0723234234', 'S.C. SOIVTRANS EXPRESS S.R.L.', 'RO27517425', 'J02/345/2017', 1),
(24, 'Stefan Negutesco', 'utilizator3@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '0723234234', 'S.C. D.TRANS RO S.R.L.', 'RO22159300', 'J02/345/2017', 1),
(25, 'Costel Voinea', 'utilizator4@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '0723234234', 'S.C. SNK SPEEDLINE S.R.L.', 'RO35268600', 'J02/345/2017', 0),
(27, 'Cristian Mironescu', 'utilizator6@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '0723234234', 'S.C. BURLACU BVT INTERNATIONAL TRANSPORT S.R.L.', 'RO30222670', 'J02/345/2017', 0),
(29, 'Dracul Manole', 'utilizator8@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. ISTRATE COM S.R.L.', 'RO10704330', 'J02/345/2017', 0),
(30, 'Haralamb Nicolae', 'utilizator9@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. PSIHORELI CONSTRUCT S.A.', 'RO6723252', 'J02/345/2017', 0),
(31, 'Emanuel Stancu', 'utilizator10@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. BURCIU TRANS S.R.L.', 'RO15711869', 'J02/345/2017', 0),
(32, 'Alexandra Barbulescu', 'utilizator11@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. SORCANI S.R.L.', 'RO4846615', 'J02/345/2017', 0),
(33, 'Gheorghita Mihai', 'utilizator12@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. SORTABI TRANS S.R.L.', 'RO33155869', 'J02/345/2017', 1),
(34, 'Isabella Romanescu', 'utilizator13@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. VERDES TRANSPORT S.R.L.', 'RO35461473', 'J02/345/2017', 1),
(35, 'Denisa Dimir', 'utilizator14@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. BONGROUP TRANS S.R.L.', 'RO31098490', 'J02/345/2017', 1),
(36, 'Diona Selymes', 'utilizator15@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. ELECTRICAL BUSINESS CENTER S.R.L.', 'RO14251045', 'J02/345/2017', 1),
(37, 'Sorine Gheorghe', 'utilizator16@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. BANARI TRANS S.R.L.', 'RO29339022', 'J02/345/2017', 1),
(38, 'Brigita Piturca', 'utilizator17@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. IGEXPRESSTRANS S.R.L.', 'RO32225095', 'J02/345/2017', 1),
(39, 'Silvia Calinescu', 'utilizator18@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. SC TOP TRUCKS TRANS S.R.L.', 'RO33201558', 'J02/345/2017', 1),
(40, 'Bianca Enescu', 'utilizator19@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. Bertschi Romania S.R.L.', 'RO22197338', 'J02/345/2017', 0),
(41, 'Michaela Galca', 'utilizator20@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. Containerdienst Sibiu S.R.L.', 'RO28387935', 'J02/345/2017', 1),
(42, 'Glad Filotti', 'utilizator21@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. S.C ALEX SPEDITION IDEAL S.R.L', 'RO29703289', 'J02/345/2017', 1),
(44, 'Dominik Vladu', 'utilizator23@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. GLENCORA IMPEX S.R.L.', 'RO5113280', 'J02/345/2017', 0),
(45, 'Velkan Ilie', 'utilizator24@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. PETRIDEN S.R.L.', 'RO18862564', 'J02/345/2017', 1),
(46, 'Apostol Manole', 'utilizator24@indicator.ro', '488b35b253ada81c53f1be3bb4f04973', '723234234', 'S.C. INTERNATIONAL LAZAR COMPANY S.R.L. ', 'RO6443910', 'J02/345/2017', 1),
(47, 'Diana Dudu', 'dianaadudu@yahoo.com', '488b35b253ada81c53f1be3bb4f04973', '0740478131', 'S.C. Alumil Rom Industry S.A.', 'RO10042631', 'J40/8540/1997', 1),
(48, 'Denisa Dudu', 'denisa.dudu@dudu.ro', '488b35b253ada81c53f1be3bb4f04973', '0740478131', 'S.C. Deni S.A.', 'RO1234567', 'J08/354/1991', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori_stersi`
--

CREATE TABLE `utilizatori_stersi` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilizatori_stersi`
--

INSERT INTO `utilizatori_stersi` (`id`, `email`, `deltime`) VALUES
(1, 'utilizator5@indicator.ro', '2020-05-31 11:00:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ind_gest`
--
ALTER TABLE `ind_gest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `ind_lic`
--
ALTER TABLE `ind_lic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `ind_rac`
--
ALTER TABLE `ind_rac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `ind_rai`
--
ALTER TABLE `ind_rai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `ind_rcn`
--
ALTER TABLE `ind_rcn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `ind_roa`
--
ALTER TABLE `ind_roa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `ind_roe`
--
ALTER TABLE `ind_roe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `ind_rsg`
--
ALTER TABLE `ind_rsg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `ind_rsp`
--
ALTER TABLE `ind_rsp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `ind_sf`
--
ALTER TABLE `ind_sf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companie` (`id_companie`);

--
-- Indexes for table `notificari`
--
ALTER TABLE `notificari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sugestii`
--
ALTER TABLE `sugestii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id_companie`),
  ADD KEY `id` (`id_companie`);

--
-- Indexes for table `utilizatori_stersi`
--
ALTER TABLE `utilizatori_stersi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ind_gest`
--
ALTER TABLE `ind_gest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ind_lic`
--
ALTER TABLE `ind_lic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ind_rac`
--
ALTER TABLE `ind_rac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ind_rai`
--
ALTER TABLE `ind_rai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ind_rcn`
--
ALTER TABLE `ind_rcn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ind_roa`
--
ALTER TABLE `ind_roa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `ind_roe`
--
ALTER TABLE `ind_roe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ind_rsg`
--
ALTER TABLE `ind_rsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ind_rsp`
--
ALTER TABLE `ind_rsp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ind_sf`
--
ALTER TABLE `ind_sf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notificari`
--
ALTER TABLE `notificari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sugestii`
--
ALTER TABLE `sugestii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id_companie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `utilizatori_stersi`
--
ALTER TABLE `utilizatori_stersi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ind_gest`
--
ALTER TABLE `ind_gest`
  ADD CONSTRAINT `ind_gest_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);

--
-- Constraints for table `ind_lic`
--
ALTER TABLE `ind_lic`
  ADD CONSTRAINT `ind_lic_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);

--
-- Constraints for table `ind_rac`
--
ALTER TABLE `ind_rac`
  ADD CONSTRAINT `ind_rac_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);

--
-- Constraints for table `ind_rai`
--
ALTER TABLE `ind_rai`
  ADD CONSTRAINT `ind_rai_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);

--
-- Constraints for table `ind_rcn`
--
ALTER TABLE `ind_rcn`
  ADD CONSTRAINT `ind_rcn_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);

--
-- Constraints for table `ind_roa`
--
ALTER TABLE `ind_roa`
  ADD CONSTRAINT `ind_roa_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);

--
-- Constraints for table `ind_roe`
--
ALTER TABLE `ind_roe`
  ADD CONSTRAINT `ind_roe_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);

--
-- Constraints for table `ind_rsg`
--
ALTER TABLE `ind_rsg`
  ADD CONSTRAINT `ind_rsg_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);

--
-- Constraints for table `ind_rsp`
--
ALTER TABLE `ind_rsp`
  ADD CONSTRAINT `ind_rsp_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);

--
-- Constraints for table `ind_sf`
--
ALTER TABLE `ind_sf`
  ADD CONSTRAINT `ind_sf_ibfk_1` FOREIGN KEY (`id_companie`) REFERENCES `utilizatori` (`id_companie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
