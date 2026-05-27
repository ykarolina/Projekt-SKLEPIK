<?php
//sesja jesli nie została jzu uruchominina
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$serwer = "localhost";
$uzytkownik_db = "sklepikzeg";
$haslo_db = "Baza123!";
$nazwa_db = "ykarolina";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);


if ($polaczenie->connect_error) {
    die("Błąd połączenia: " . $polaczenie->connect_error);
}

//pobieramy id zalogowanego uzytkownika
$id_user = $_SESSION['uzytkownik_id'] ?? 0;

//Zmienne pomocnicze
// $nazwa_user = "Użytkowniku";
// $mail_user = "brak danych"; 

//pobieranie danych zalogowanego uzytkownika
if ($id_user > 0) {
    $zapytanie_user = $polaczenie->prepare("SELECT nazwa, email FROM uzytkownicy WHERE id = ?");
    $zapytanie_user->bind_param("i", $id_user);
    $zapytanie_user->execute();
    $wynik_user = $zapytanie_user->get_result();
    
    if ($uzytkownik = $wynik_user->fetch_assoc()) {
        $nazwa_user = $uzytkownik['nazwa'];
        $mail_user = $uzytkownik['email'];
    }
    $zapytanie_user->close();
}

//pobieranie zamowien
$sql = "SELECT 
            z.id AS id_zamowienia, 
            z.status, 
            z.kwota AS suma_zamowienia,
            pz.ilosc, 
            pz.cena AS cena_jednostkowa,
            p.nazwa, 
            p.zdjecie, 
            p.kategoria,
            p.smak
        FROM zamowienia z
        JOIN pozycje_zamowione pz ON z.id = pz.id_zamowienia
        JOIN produkty p ON pz.id_produktu = p.id
        WHERE z.id_uzytkownika = ?
        ORDER BY z.id DESC";

$zapytanie_zamowienia = $polaczenie->prepare($sql);
$zapytanie_zamowienia->bind_param("i", $id_user);
$zapytanie_zamowienia->execute();
$wynik = $zapytanie_zamowienia->get_result();
$zamowienia = [];

//grupowanie zamowien
while ($wiersz = $wynik->fetch_assoc()) {
    $id_zam = $wiersz['id_zamowienia'];
    if (!isset($zamowienia[$id_zam])) {
        $zamowienia[$id_zam] = [
            'status' => $wiersz['status'],
            'suma' => $wiersz['suma_zamowienia'],
            'produkty' => []
        ];
    }
    $zamowienia[$id_zam]['produkty'][] = [
        'nazwa' => $wiersz['nazwa'],
        'cena_jednostkowa' => $wiersz['cena_jednostkowa'],
        'ilosc' => $wiersz['ilosc'],
        'zdjecie' => $wiersz['zdjecie'],
        'kategoria' => $wiersz['kategoria'],
        'smak' => $wiersz['smak']
    ];
}

$zapytanie_zamowienia->close();
$polaczenie->close();
?>