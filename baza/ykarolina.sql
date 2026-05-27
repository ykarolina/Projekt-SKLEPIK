-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Czas generowania: 27 Maj 2026, 23:07
-- Wersja serwera: 10.11.14-MariaDB-0+deb12u2.1
-- Wersja PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ykarolina`
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
  `cena` decimal(6,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `pozycje_zamowione`
--

INSERT INTO `pozycje_zamowione` (`id`, `id_zamowienia`, `id_produktu`, `ilosc`, `cena`) VALUES
(1, 1, 1, 2, '6.50'),
(2, 2, 11, 1, '8.50'),
(3, 3, 4, 1, '8.50'),
(4, 3, 9, 1, '6.50'),
(5, 4, 18, 2, '6.00'),
(6, 4, 46, 2, '4.40'),
(7, 5, 1, 1, '6.50'),
(8, 5, 11, 1, '4.80'),
(9, 6, 16, 1, '4.20'),
(10, 6, 26, 2, '4.00'),
(11, 7, 13, 2, '5.99'),
(12, 8, 38, 3, '6.50'),
(13, 8, 7, 2, '8.99'),
(14, 9, 19, 2, '1.20'),
(15, 9, 27, 2, '4.00'),
(16, 9, 42, 1, '4.50'),
(17, 10, 2, 2, '7.80'),
(18, 10, 10, 1, '3.50'),
(19, 11, 16, 1, '4.20'),
(20, 12, 17, 2, '5.80'),
(21, 12, 45, 2, '4.50');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  `zdjecie` varchar(40) NOT NULL,
  `kategoria` varchar(30) NOT NULL,
  `smak` varchar(20) DEFAULT NULL,
  `czy_promocja` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `zdjecie`, `kategoria`, `smak`, `czy_promocja`) VALUES
(1, 'Kawa biala', '6.50', 'biala.png', 'kawy', NULL, 0),
(2, 'Cappuccino', '7.80', 'cappuccino.png', 'kawy', NULL, 0),
(3, 'Kawa czarna', '6.00', 'czarna.png', 'kawy', NULL, 0),
(4, 'Double Espresso', '8.50', 'double_espresso.png', 'kawy', NULL, 0),
(5, 'Espresso', '5.50', 'espresso.png', 'kawy', NULL, 0),
(6, 'Espresso Macchiato', '6.20', 'espresso_macchiato.png', 'kawy', NULL, 0),
(7, 'Latte Macchiato', '8.99', 'latte.png', 'kawy', NULL, 0),
(8, 'Double Hot Dog', '8.90', 'double_hot_dog.jpg', 'na_cieplo', NULL, 0),
(9, 'Hot Dog', '6.50', 'hot_dog.jpg', 'na_cieplo', NULL, 0),
(10, 'Tost z masłem', '3.50', 'tost_maslo.jpg', 'na_cieplo', NULL, 0),
(11, 'Tost z serem', '4.80', 'tost_ser.jpg', 'na_cieplo', NULL, 0),
(12, 'Tost z szynka', '5.20', 'tost_szynka.jpg', 'na_cieplo', NULL, 0),
(13, 'Tost z szynką i serem', '5.99', 'tost_szynka_ser.jpg', 'na_cieplo', NULL, 0),
(14, 'Bułka z golosza', '8.50', 'bulka_golosza.png', 'bulki', NULL, 0),
(15, 'Bułka z masłem', '2.50', 'bulka_maslo.png', 'bulki', NULL, 0),
(16, 'Bułka z serem', '4.20', 'bulka_ser.png', 'bulki', NULL, 0),
(17, 'Bułka z serem i szynką', '5.80', 'bulka_ser_szynka.png', 'bulki', NULL, 0),
(18, 'Bułka z sosami', '3.00', 'bulka_sos.png', 'bulki', NULL, 0),
(19, 'Bułka sucha', '1.20', 'bulka_sucha.png', 'bulki', NULL, 0),
(20, 'Bułka z szynką', '4.99', 'bulka_szynka.png', 'bulki', NULL, 0),
(21, 'Sok w szkle', '4.00', 'sok_szklo.jpg', 'sok_szklo', NULL, 0),
(22, 'Sok w szkle Brzoskwinia', '4.00', 'sok_szklo_brzoskwinia.', 'sok_szklo', 'brzoskwinia', 0),
(23, 'Sok w szkle Kiwi', '4.00', 'sok_szklo_kiwi.png', 'sok_szklo', 'kiwi', 0),
(24, 'Sok w szkle Malina', '4.00', 'sok_szklo_malina.png', 'sok_szklo', 'malina', 0),
(25, 'Sok w szkle Mango', '4.00', 'sok_szklo_mango.png', 'sok_szklo', 'mango', 0),
(26, 'Sok w szkle Mięta', '4.00', 'sok_szklo_mieta.png', 'sok_szklo', 'mieta', 0),
(27, 'Sok w szkle Wiśnia', '4.00', 'sok_szklo_wisnia.png', 'sok_szklo', 'wisnia', 0),
(28, 'Woda mineralna', '3.00', 'woda.jpg', 'woda', NULL, 0),
(29, 'Woda gazowana', '3.00', 'woda_gaz.jpg', 'woda', 'gaz', 0),
(30, 'Woda niegazowana', '3.00', 'woda_niegaz.jpg', 'woda', 'niegaz', 0),
(31, 'Soki w kartonie', '5.50', 'sok_karton.jpg', 'sok_karton', NULL, 0),
(32, 'Sok w kartonie Banan', '5.50', 'sok_karton_banan.jpg', 'sok_karton', 'banan', 0),
(33, 'Sok w kartonie Granat', '5.50', 'sok_karton_granat.jpg', 'sok_karton', 'granat', 0),
(34, 'Sok w kartonie Kaktus', '5.50', 'sok_karton_kaktus.jpg', 'sok_karton', 'kaktus', 0),
(35, 'Sok w kartonie Mango', '5.50', 'sok_karton_mango.jpg', 'sok_karton', 'mango', 0),
(36, 'Sok w kartonie Żurawina', '5.50', 'sok_karton_zurawina.j', 'sok_karton', 'zurawina', 0),
(37, 'Sok 2L', '6.50', 'sok_2l.jpg', 'sok_2l', NULL, 0),
(38, 'Sok 2L Brzoskwinia', '6.50', 'sok_2l_brzoskwinia.jpg', 'sok_2l', 'brzoskwinia', 0),
(39, 'Sok 2L Jabłko', '6.50', 'sok_2l_jablko.jpg', 'sok_2l', 'jablko', 0),
(40, 'Sok 2L Wiśnia', '6.50', 'sok_2l_wisnia.jpg', 'sok_2l', 'wisnia', 0),
(41, 'Sok 0.5L', '4.50', 'sok_05.jpg', 'sok_05', NULL, 0),
(42, 'Sok 0.5L Arbuz', '4.50', 'sok_05_arbuz.png', 'sok_05', 'arbuz', 0),
(43, 'Sok 0.5L Brzoskwinia', '4.50', 'sok_05_brzoskwinia.jpg', 'sok_05', 'brzoskwinia', 0),
(44, 'Sok 0.5L Mięta', '4.50', 'sok_05_mieta.jpg', 'sok_05', 'mieta', 0),
(45, 'Sok 0.5L Wiśnia', '4.50', 'sok_05_wisnia.jpg', 'sok_05', 'wisnia', 0),
(46, 'Gorący Kubek', '2.20', 'goracy_kubek.jpg', 'inne', NULL, 0),
(47, 'Gorący Kubek Barszcz', '2.20', 'goracy_kubek_barszcz.jpg', 'inne', 'barszcz', 0),
(48, 'Gorący Kubek Pomidorowa', '2.20', 'goracy_kubek_pomidorowa.jpg', 'inne', 'pomidorowa', 0),
(49, 'Gorący Kubek Rosół', '2.20', 'goracy_kubek_rosol.jpg', 'inne', 'rosol', 0),
(50, 'Mullermilch', '3.80', 'mullermilch_wszystkie.jpg', 'inne', NULL, 0),
(51, 'Mullermilch Bananowy', '3.80', 'mullermilch_bananowy.jpg', 'inne', 'bananowy', 0),
(52, 'Mullermilch Czekoladowy', '3.80', 'mullermilch_czekoladowy.jpg', 'inne', 'czekoladowy', 0),
(53, 'Mullermilch Truskawkowy', '3.80', 'mullermilch_truskawkowy.jpg', 'inne', 'truskawkowy', 0),
(54, 'dodanyprodukt', '3.99', 'test.jpg', 'inne', 'smaktest', 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nazwa`, `email`, `haslo`, `rola`, `kod_dostepu`) VALUES
(1, 'user1', 'mail@gmail.com', '$2y$10$.tUnujMHkqq109b8o8tpaO3AwpmMjK5N41fjtrio3tZqf2exzeyZK', 'user', NULL),
(2, 'user2', 'mail2@gmail.com', '$2y$10$tX0PNyftTAQn1No.4Qmt5u9tLe/aqh9GGSTNl.1PyTo20RLr0rW.2', 'user', NULL),
(3, 'user3', 'mail3@gmail.com', '$2y$10$3qy9kzcKCqz3HiOQ1XHnS.pRVr3z10UVjYIQQLzt9S4FkB6VVVuwO', 'user', NULL),
(4, 'user5', 'mail4@gmail.com', '$2y$10$g84tOSa2pvAJrRMk.YJA0.gWjolPd0VWQm2U872VMU.ULeLcbZiei', 'user', NULL),
(5, 'uzytkownik', 'maill@gmail.com', '$2y$10$K7aWkx3M/xZT8ZtRWkuRcejslg2wpfr0CDIvy6WH/MSG0Eb8xKRQC', 'user', NULL),
(6, 'userr', 'mail6@gmail.com', '$2y$10$wPEmK0Buzc4V9HKbQrOk6.eScpM38NRS4Bq3keLrkvs0qxe68fgym', 'user', NULL),
(7, 'admintest', 'adminmail@gmail.com', '$2y$10$wPEmK0Buzc4V9HKbQrOk6.eScpM38NRS4Bq3keLrkvs0qxe68fgym', 'admin', 123456789),
(8, 'admintest2', 'adminmail2@gmail.com', '$2y$10$g84tOSa2pvAJrRMk.YJA0.gWjolPd0VWQm2U872VMU.ULeLcbZiei', 'admin', 987654321),
(9, 'uzytkownik1', 'mail7@gmail.com', '$2y$10$cRhkgQa5xDN7OFPZQ7Lw9u77QOeBJngxnnEFoaVIlv3wOPFs8Hisi', 'user', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `kwota` decimal(6,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `id_uzytkownika`, `status`, `kwota`) VALUES
(1, 1, 'oczekujace', '13.00'),
(2, 1, 'oczekujące', '8.50'),
(3, 2, 'zrealizowane', '15.00'),
(4, 2, 'w realizacji', '20.80'),
(5, 2, 'zrealizowane', '11.30'),
(6, 3, 'realizacja', '12.20'),
(7, 3, 'w realizacji', '11.98'),
(8, 4, 'w realizacji', '37.48'),
(9, 4, 'zrealizowane', '14.90'),
(10, 5, 'oczekujące', '19.10'),
(11, 6, 'zrealizowane', '4.20'),
(12, 9, 'w realizacji', '20.60');

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
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `pozycje_zamowione`
--
ALTER TABLE `pozycje_zamowione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
