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
    $nazwa = trim($_POST['nazwaAdmin']);
    $kod_z_formularza = trim($_POST['kodDostepu']);
    $haslo_wpisane = $_POST['hasloAdmin'];

    //sprawdzanie czy nie puste
    if (empty($nazwa) || empty($kod_z_formularza) || empty($haslo_wpisane)) {
        $_SESSION['komunikat'] = "Wypełnij wszystkie pola!";
        header("Location: ../strony/strona_logowanie_admin.php");
        exit;
    }

    //sprawdzqanie czy rola admin
    $zapytanie = $polaczenie->prepare("SELECT id, haslo, rola, kod_dostepu FROM uzytkownicy WHERE nazwa = ? AND rola = 'admin'");
    $zapytanie->bind_param("s", $nazwa);
    $zapytanie->execute();
    $wynik = $zapytanie->get_result();

    if ($uzytkownik = $wynik->fetch_assoc()) {
        //sprawdzanie kodu dostepu != zamiast !== bo moze byc problem w bazie
        if ($kod_z_formularza != $uzytkownik['kod_dostepu']) {
            $_SESSION['komunikat'] = "Błędny kod dostępu!";
            header("Location: ../strony/strona_logowanie_admin.php");
            exit; //koniec jesli zly
        }

        //sprawdzanie hasla jesli kod dostepu poprawny(odhaszowywanie)
        if (password_verify($haslo_wpisane, $uzytkownik['haslo'])) {
            $_SESSION['admin_zalogowany'] = true;
            $_SESSION['uzytkownik_id'] = $uzytkownik['id'];
            $_SESSION['rola'] = 'admin';

            //przełoczenie na strone admina
            header("Location: ../strony/strona_admin.php");
            exit;
            
        } else {
            $_SESSION['komunikat'] = "Błędne hasło administratora!";
        }
    } else {
        $_SESSION['komunikat'] = "Administrator o nazwie '$nazwa' nie istnieje!";
    }
    header("Location: ../strony/strona_logowanie_admin.php");
    exit;
}

$polaczenie->close();
?>