<?php
session_start();

$serwer = "localhost";
$uzytkownik_db = "sklepikzeg";
$haslo_db = "Baza123!";
$nazwa_db = "ykarolina";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);

if ($polaczenie->connect_error) {
    die("Bład połaczenia: " . $polaczenie->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa_uzytkownika = trim($_POST['nazwaUzytkownika']); 
    $nowa_rola = $_POST['rola'];

    // sprawdzanie czy nie puste
    if (empty($nazwa_uzytkownika)) {
        $_SESSION['komunikat_rola'] = "Musisz uzupełnić nazwę użytkownika!";
        $_SESSION['typ_komunikatu_rola'] = "danger";
        header("Location: ../strony/strona_admin.php");
        exit();
    }

    // sprawdzanie czy istnieje w ogóle taki user
    $zapytanie_sprawdzajace = $polaczenie->prepare("SELECT rola FROM uzytkownicy WHERE nazwa = ?");
    $zapytanie_sprawdzajace->bind_param("s", $nazwa_uzytkownika);
    $zapytanie_sprawdzajace->execute();
    $wynik = $zapytanie_sprawdzajace->get_result();

    if ($wynik->num_rows > 0) {
        $wiersz = $wynik->fetch_assoc();
        $aktualna_rola = $wiersz['rola'];

        // sprawdzanie czy rola się zmienia czy jest taka sama
        if ($aktualna_rola === $nowa_rola) {
            $_SESSION['komunikat_rola'] = "Użytkownik $nazwa_uzytkownika ma już przypisana rolę: $nowa_rola!";
            $_SESSION['typ_komunikatu_rola'] = "danger";
        } else {
            // zmiana roli
            $zapytanie_aktualizujace = $polaczenie->prepare("UPDATE uzytkownicy SET rola = ? WHERE nazwa = ?");
            $zapytanie_aktualizujace->bind_param("ss", $nowa_rola, $nazwa_uzytkownika);
            
            if ($zapytanie_aktualizujace->execute()) {
                $_SESSION['komunikat_rola'] = "Rola użytkownika $nazwa_uzytkownika została zmieniona na $nowa_rola.";
                $_SESSION['typ_komunikatu_rola'] = "success";
            } else {
                $_SESSION['komunikat_rola'] = "Wystąpił błąd podczas aktualizacji bazy danych.";
                $_SESSION['typ_komunikatu_rola'] = "danger";
            }
            $zapytanie_aktualizujace->close();
        }
    } else {
        $_SESSION['komunikat_rola'] = "Nie znaleziono użytkownika o nazwie: $nazwa_uzytkownika.";
        $_SESSION['typ_komunikatu_rola'] = "danger";
    }

    $zapytanie_sprawdzajace->close();
    header("Location: ../strony/strona_admin.php");
    exit();
}
$polaczenie->close();
?>