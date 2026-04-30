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

// Obsługa wyłącznie edycji (aktualizacji) produktu
if (isset($_POST['aktualizuj_produkt'])) {
    // Pobieranie danych z formularza
    $id = intval($_POST['nrProduktu']);
    $pole = $_POST['wyborPola']; 
    $nowaWartosc = $_POST['nowaWartosc'];

    // Lista dozwolonych kolumn zgodnie ze zrzutem bazy (nazwa, cena, smak, kategoria)
    $dozwolonePola = ['nazwa', 'cena', 'smak', 'kategoria'];

    if (in_array($pole, $dozwolonePola)) {
        // Przygotowanie zapytania UPDATE
        $sql = "UPDATE produkty SET $pole = ? WHERE id = ?";
        $stmt = $polaczenie->prepare($sql);
        
        // Bindowanie: s = string (nowa wartość), i = integer (ID produktu)
        $stmt->bind_param("si", $nowaWartosc, $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['komunikat_edycja'] = "Pomyślnie zaktualizowano pole '$pole' dla produktu o ID #$id.";
                $_SESSION['typ_komunikatu_edycja'] = "success";
            } else {
                $_SESSION['komunikat_edycja'] = "Nie znaleziono produktu o ID #$id lub dane są identyczne z obecnymi.";
                $_SESSION['typ_komunikatu_edycja'] = "warning";
            }
        } else {
            $_SESSION['komunikat_edycja'] = "Błąd bazy danych podczas zapisu.";
            $_SESSION['typ_komunikatu_edycja'] = "danger";
        }
        $stmt->close();
    } else {
        $_SESSION['komunikat_edycja'] = "Próba edycji nieistniejącego pola.";
        $_SESSION['typ_komunikatu_edycja'] = "danger";
    }
}

$polaczenie->close();

// Powrót do panelu administratora
header("Location: ../strony/strona_admin.php");
exit();
?>