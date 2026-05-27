<?php
session_start();

$serwer = "localhost";
$uzytkownik_db = "sklepikzeg";
$haslo_db = "Baza123!";
$nazwa_db = "ykarolina";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);
$polaczenie->set_charset("utf8mb4");

if ($polaczenie->connect_error) {
    die("Błąd połączenia: " . $polaczenie->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobieranie danych z formularza
    $nazwa_produktu = trim($_POST['nazwaProduktu']);
    $kategoria = $_POST['kategoria'];
    $zdjecie = trim($_POST['foto']);
    $cena = $_POST['cena'];
    $promocja = $_POST['promocja'];
    $smak = trim($_POST['smak']);

    //sprawdzanie czy nie sa puste pola (poza samkiem bo opcjonalny)
    if (empty($nazwa_produktu) || empty($kategoria) || empty($zdjecie) || empty($cena)) {
        $_SESSION['komunikat_produkt'] = "Musisz uzupełnić wszystkie pola formularza (smak jest opcjonalny)!";
        $_SESSION['typ_komunikatu_produkt'] = "danger";
        header("Location: ../strony/strona_admin.php");
        exit();
    }
    //jeśli pusty do bazy da null
    $wartosc_smaku = empty($smak) ? null : $smak;

    $zapytanie = $polaczenie->prepare("INSERT INTO produkty (nazwa, cena, zdjecie, kategoria, smak, czy_promocja) VALUES (?, ?, ?, ?, ?, ?)");
    $zapytanie->bind_param("sssssi", $nazwa_produktu, $cena, $zdjecie, $kategoria, $wartosc_smaku, $promocja);
    if ($zapytanie->execute()) {
        $_SESSION['komunikat_produkt'] = "Produkt <b>$nazwa_produktu</b> został dodany do bazy.";
        $_SESSION['typ_komunikatu_produkt'] = "success";
    } else {
        $_SESSION['komunikat_produkt'] = "Bład podczas dodawania produktu do bazy danych.";
        $_SESSION['typ_komunikatu_produkt'] = "danger";
    }

    $zapytanie->close();
    header("Location: ../strony/strona_admin.php");
    exit();
}
$polaczenie->close();
?>