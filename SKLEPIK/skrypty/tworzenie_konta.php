<?php
session_start();

// dane polaczenia z baza
$serwer = "localhost";
$uzytkownik_db = "root";
$haslo_db = "";
$nazwa_db = "sklepik";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);

// Sprawdzenie polaczenia
if ($polaczenie->connect_error) {
    die("Błąd połączenia: " . $polaczenie->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //(oczyszczanuie) z spacji
    $nazwa = trim($_POST['nazwa']);
    $email = trim($_POST['email']);
    $haslo = $_POST['haslo'];
    $hasloPow = $_POST['hasloPow'];

    //Funkcja pomocnicza do wracania z błędem
    function wroc_z_bledem($tekst) {
        $_SESSION['komunikat'] = $tekst;
        $_SESSION['typ_komunikatu'] = "danger";
        //przekierowanie do strony z rejestracja
        header("Location: ../strony/strona_rejestracja.php"); 
        exit;
    }

    //walidacja
    if (empty($nazwa) || empty($email) || empty($haslo)) {
        wroc_z_bledem("Wypełnij wszystkie pola!");
    }
    if ($haslo !== $hasloPow) {
        wroc_z_bledem("Hasła nie są identyczne!");
    }

    //sprawdzenie czy uzytkownik już istnieje
    $spr = $polaczenie->prepare("SELECT id FROM uzytkownicy WHERE email = ? OR nazwa = ?");
    $spr->bind_param("ss", $email, $nazwa);
    $spr->execute();
    if ($spr->get_result()->num_rows > 0) {
        wroc_z_bledem("Taki użytkownik lub e-mail już istnieje!");
    }

    //haszowanie
    $hash = password_hash($haslo, PASSWORD_DEFAULT);
    $rola = "user";

    $insert = $polaczenie->prepare("INSERT INTO uzytkownicy (nazwa, email, haslo, rola) VALUES (?, ?, ?, ?)");
    $insert->bind_param("ssss", $nazwa, $email, $hash, $rola);
    
    if ($insert->execute()) {
        $_SESSION['komunikat'] = "Konto zostało utworzone!";
        $_SESSION['typ_komunikatu'] = "success";
        header("Location: ../strony/strona_logowanie.php");
            exit;
    } else {
        wroc_z_bledem("Błąd bazy danych.");
    }
} else {
    header("Location: strona_rejestracja.php");
    exit;
}
?>