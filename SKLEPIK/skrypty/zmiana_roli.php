<?php
session_start();

$serwer = "localhost";
$uzytkownik_db = "root";
$haslo_db = "";
$nazwa_db = "sklepik";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);
if ($polaczenie->connect_error) {
    die("Błąd połączenia: " . $polaczenie->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa_uzytkownika = trim($_POST['nazwaUzytkownika']); 
    $nowa_rola = $_POST['rola'];
    //sprawdzanie czy nie puste
    if (empty($nazwa_uzytkownika)) {
        $_SESSION['komunikat'] = "Musisz uzupełnic nazwe uzytkownika!";
        $_SESSION['typ_komunikatu'] = "danger";
        header("Location: ../strony/strona_admin.php");
        exit();
    }

    //sprawdzanie czy intenieje wogole taki user
    $zapytanie_sprawdzajace = $polaczenie->prepare("SELECT rola FROM uzytkownicy WHERE nazwa = ?");
    $zapytanie_sprawdzajace->bind_param("s", $nazwa_uzytkownika);
    $zapytanie_sprawdzajace->execute();
    $wynik = $zapytanie_sprawdzajace->get_result();

    if ($wynik->num_rows > 0) {
        $wiersz = $wynik->fetch_assoc();
        $aktualna_rola = $wiersz['rola'];

        //sparwdzanie czy rola sie zmienia czy jest taka sama
        if ($aktualna_rola === $nowa_rola) {
            $_SESSION['komunikat'] = "Uzytkownik $nazwa_uzytkownika ma juz przypisana role: $nowa_rola!";
            $_SESSION['typ_komunikatu'] = "danger";
        } else {
            //zmiana roli
            $zapytanie_aktualizujace = $polaczenie->prepare("UPDATE uzytkownicy SET rola = ? WHERE nazwa = ?");
            $zapytanie_aktualizujace->bind_param("ss", $nowa_rola, $nazwa_uzytkownika);
            
            if ($zapytanie_aktualizujace->execute()) {
                $_SESSION['komunikat'] = "Rola uzytkownika $nazwa_uzytkownika została zmieniona na $nowa_rola.";
                $_SESSION['typ_komunikatu'] = "success";
            } else {
                $_SESSION['komunikat'] = "Wystapił bład podczas aktualizacji bazy danych.";
                $_SESSION['typ_komunikatu'] = "danger";
            }
            $zapytanie_aktualizujace->close();
        }
    } else {
        $_SESSION['komunikat'] = "Nie znaleziono uzytkownika o nazwie: $nazwa_uzytkownika.";
        $_SESSION['typ_komunikatu'] = "danger";
    }

    $zapytanie_sprawdzajace->close();
    header("Location: ../strony/strona_admin.php");
    exit();
}
$polaczenie->close();
?>