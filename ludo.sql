-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Mar 2024, 23:14
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ludo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `games`
--

CREATE TABLE `games` (
  `ID` int(11) NOT NULL,
  `player1b` text NOT NULL,
  `player2r` text NOT NULL,
  `player3g` text NOT NULL,
  `player4y` text NOT NULL,
  `player1b1` int(11) NOT NULL,
  `player1b2` int(11) NOT NULL,
  `player1b3` int(11) NOT NULL,
  `player1b4` int(11) NOT NULL,
  `player2r1` int(11) NOT NULL,
  `player2r2` int(11) NOT NULL,
  `player2r3` int(11) NOT NULL,
  `player2r4` int(11) NOT NULL,
  `player3g1` int(11) NOT NULL,
  `player3g2` int(11) NOT NULL,
  `player3g3` int(11) NOT NULL,
  `player3g4` int(11) NOT NULL,
  `player4y1` int(11) NOT NULL,
  `player4y2` int(11) NOT NULL,
  `player4y3` int(11) NOT NULL,
  `player4y4` int(11) NOT NULL,
  `tura` int(11) NOT NULL,
  `koniec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `games`
--

INSERT INTO `games` (`ID`, `player1b`, `player2r`, `player3g`, `player4y`, `player1b1`, `player1b2`, `player1b3`, `player1b4`, `player2r1`, `player2r2`, `player2r3`, `player2r4`, `player3g1`, `player3g2`, `player3g3`, `player3g4`, `player4y1`, `player4y2`, `player4y3`, `player4y4`, `tura`, `koniec`) VALUES
(9, 'gracz3', 'gracz2', 'gracz1', 'X', -1, -2, -3, -4, -5, -6, -7, -8, -9, -10, -11, -12, -13, -14, -15, -16, 2, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nick` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `nick`, `status`) VALUES
(24, 'gracz1', 33),
(25, 'gracz2', 32),
(26, 'gracz3', 31);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `games`
--
ALTER TABLE `games`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
