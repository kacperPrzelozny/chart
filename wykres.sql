-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Wrz 2021, 08:17
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wykres`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pomiar`
--

CREATE TABLE `pomiar` (
  `day` int(11) NOT NULL,
  `temperature` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pomiar`
--

INSERT INTO `pomiar` (`day`, `temperature`) VALUES
(1, 36.4),
(2, 36.32),
(3, 36.29),
(4, 36.31),
(5, 36.4),
(6, 36.37),
(7, 36.39),
(8, 36.28),
(9, 36.4),
(10, 36.32),
(11, 36.3),
(12, 36.35),
(13, 36.21),
(14, 36.62),
(15, 36.64),
(16, 36.75),
(17, 36.71),
(18, 36.75),
(19, 36.79),
(21, 1),
(22, 36.86),
(23, 0),
(24, 36.76),
(26, 36.86),
(27, 36.55),
(28, 36.41),
(20, 36.76),
(25, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
