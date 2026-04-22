CREATE TABLE IF NOT EXISTS `produkty` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`nazwa` varchar(50) NOT NULL,
	`cena` decimal(3,2) NOT NULL,
	`zdjecie` varchar(40) NOT NULL,
	`kategoria` varchar(30) NOT NULL,
	`smak` varchar(20),
	`czy_promocja` boolean NOT NULL DEFAULT false,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`nazwa` varchar(30) NOT NULL,
	`email` varchar(100) NOT NULL,
	`haslo` varchar(30) NOT NULL,
	`rola` varchar(20) NOT NULL,
	`kod_dostepu` int,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `zamowienia` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`id_uzytkownika` int NOT NULL,
	`status` varchar(20) NOT NULL,
	`kwota` decimal(3,2) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `pozycje_zamowione` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`id_zamowienia` int NOT NULL,
	`id_produktu` int NOT NULL,
	`ilosc` int NOT NULL,
	`cena` decimal(3,2) NOT NULL,
	PRIMARY KEY (`id`)
);



ALTER TABLE `zamowienia` ADD CONSTRAINT `zamowienia_fk1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy`(`id`);
ALTER TABLE `pozycje_zamowione` ADD CONSTRAINT `pozycje_zamowione_fk1` FOREIGN KEY (`id_zamowienia`) REFERENCES `zamowienia`(`id`);

ALTER TABLE `pozycje_zamowione` ADD CONSTRAINT `pozycje_zamowione_fk2` FOREIGN KEY (`id_produktu`) REFERENCES `produkty`(`id`);