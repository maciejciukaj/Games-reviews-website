-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Maj 2022, 14:39
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `recenzje`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `games`
--

CREATE TABLE `games` (
  `name` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `publisher` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `games`
--

INSERT INTO `games` (`name`, `genre`, `data`, `publisher`) VALUES
('Stellaris', 'Strategia', '2016-05-09', 'Paradox Interactive'),
('Europa Universalis IV', 'Strategia', '2013-08-13', 'Paradox Interactive'),
('Battlefield 2042', 'FPS', '2021-10-08', 'Electronic Arts'),
('Plants vs. Zombies: Garden Warfare 2', 'FPS', '2016-02-23', 'Electronic Arts'),
('Sekiro: Shadows Die Twice', 'Akcji', '2019-03-21', 'From Software');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(11) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `user` varchar(100) NOT NULL,
  `rate` int(11) NOT NULL,
  `game_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `reviews`
--

INSERT INTO `reviews` (`id_review`, `body`, `user`, `rate`, `game_name`) VALUES
(1, 'Gra szybko nudzi. Nie polecam!', 'login1', 2,'Stellaris'),
(2, 'Ciekawa gra strategiczna. Tego mi brakowało.', 'login2', 8,'Stellaris'),
(3, 'Ta gra nigdy nie nudzi.', 'login1', 10,'Europa Universalis IV'),
(4, 'Mikro tranzakcje zniszczyły te gre.', 'login3', 1,'Battlefield 2042'),
(5, 'Ciekawa wariacja gry FPS.', 'login4', 7,'Plants vs. Zombies: Garden Warfare 2'),
(6, 'Nuda! Jeśli szukasz ciekawej gry FPS omijaj tą.', 'login1', 4,'Plants vs. Zombies: Garden Warfare 2'),
(7, 'From software nigdy nie zawodzi!', 'login4', 10,'Sekiro: Shadows Die Twice'),
(8, 'Najlepsza gra w jaka grałem!', 'login5', 10,'Stellaris'),
(9, 'Super!', 'login6', 7,'Battlefield 2042'),
(10, 'Nieziemska!', 'login5', 10,'Battlefield 2042');


CREATE TABLE `users` (
  `Login` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Haslo` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`Login`, `Email`, `Haslo`, `Status`) VALUES
('login1', 'email@per.op', 'Haslo1', 2),
('login2', 'emuil@se.fe', 'Haslo1', 1),
('login3', 'kwiatek@le.fr', 'Haslo1', 1),
('login4', 'wes@ratuj.prosz', 'Haslo1', 1),
('login5', 'abba@wer.set', 'Haslo1', 0),
('login6', 'wersja@gmail.pl', 'Haslo1', 0);


--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`name`);

--
-- Indeksy dla tabeli `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `game_name` (`game_name`),
  ADD KEY `user` (`user`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`Login`);
--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `games`
--


--
-- AUTO_INCREMENT dla tabeli `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_constr` FOREIGN KEY (`game_name`) REFERENCES `games` (`name`);

ALTER TABLE `reviews`
  ADD CONSTRAINT `user_constr` FOREIGN KEY (`user`) REFERENCES `users` (`Login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
