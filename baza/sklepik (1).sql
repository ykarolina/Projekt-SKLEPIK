-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2026 at 03:14 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sklepik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pozycje_zamowione`
--

CREATE TABLE `pozycje_zamowione` (
  `id` int(11) NOT NULL,
  `id_zamowienia` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pozycje_zamowione`
--

INSERT INTO `pozycje_zamowione` (`id`, `id_zamowienia`, `id_produktu`, `ilosc`, `cena`) VALUES
(1, 1, 1, 1, 3.50),
(2, 1, 2, 1, 1.50),
(3, 2, 3, 2, 5.00),
(4, 2, 4, 1, 4.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `cena` decimal(3,2) NOT NULL,
  `zdjecie` varchar(40) NOT NULL,
  `kategoria` varchar(30) NOT NULL,
  `smak` varchar(20) DEFAULT NULL,
  `czy_promocja` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `zdjecie`, `kategoria`, `smak`, `czy_promocja`) VALUES
(1, 'bułka z ser', 3.50, 'bulka_ser.png', 'bulki', NULL, 0),
(2, 'espresso', 1.50, 'espresso.png', 'kawy', NULL, 1),
(3, 'tymbark karton mango', 4.00, 'sok_karton_mango.jpg', 'napoje', 'mango', 0),
(4, 'tost z szynka', 2.50, 'tost_szynka.jpg', 'na_cieplo', NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `rola` varchar(20) NOT NULL,
  `kod_dostepu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nazwa`, `email`, `haslo`, `rola`, `kod_dostepu`) VALUES
(1, 'user', 'user@gmail.com', 'haslo123', 'user', NULL),
(2, 'admin1', 'admin@gmail.com', 'haslo12345', 'admin', 123456789),
(3, 'user2', 'user2@gmail.com', 'haslo1111', 'user', NULL),
(8, 's', 's@s', '$2y$10$gcQhPkNCpQmSB6mt7RZE2O8iZixkh3nkfvcWeS3o3yl92IggZ.0Bq', 'user', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `kwota` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `id_uzytkownika`, `status`, `kwota`) VALUES
(1, 1, 'oczekujące', 5.00),
(2, 2, 'zrealizowane', 9.00);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `pozycje_zamowione`
--
ALTER TABLE `pozycje_zamowione`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `pozycje_zamowione_fk1` (`id_zamowienia`),
  ADD KEY `pozycje_zamowione_fk2` (`id_produktu`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `zamowienia_fk1` (`id_uzytkownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pozycje_zamowione`
--
ALTER TABLE `pozycje_zamowione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pozycje_zamowione`
--
ALTER TABLE `pozycje_zamowione`
  ADD CONSTRAINT `pozycje_zamowione_fk1` FOREIGN KEY (`id_zamowienia`) REFERENCES `zamowienia` (`id`),
  ADD CONSTRAINT `pozycje_zamowione_fk2` FOREIGN KEY (`id_produktu`) REFERENCES `produkty` (`id`);

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_fk1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
