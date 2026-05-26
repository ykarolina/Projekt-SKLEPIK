<?php
session_start();

$serwer = "localhost";
$uzytkownik_db = "sklepikzeg";
$haslo_db = "Baza123!";
$nazwa_db = "ykarolina";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);


if ($polaczenie->connect_error) {
    die("Błąd połączenia: " . $polaczenie->connect_error);
}

// usuwanie produktu przez przycisk
if (isset($_POST['usun_produkt'])) {
    $id = intval($_POST['usun_produkt']);

    $stmt = $polaczenie->prepare("DELETE FROM produkty WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $_SESSION['komunikat_edycja'] = "Produkt o nr $id został usunięty.";
            $_SESSION['typ_komunikatu_edycja'] = "success";
        } else {
            $_SESSION['komunikat_edycja'] = "Nie znaleziono produktu o nr $id.";
            $_SESSION['typ_komunikatu_edycja'] = "danger";
        }
    } else {
        $_SESSION['komunikat_edycja'] = "Błąd bazy danych podczas usuwania.";
        $_SESSION['typ_komunikatu_edycja'] = "danger";
    }
    $stmt->close();
}

// edycja (aktualizacja produktu)
if (isset($_POST['aktualizuj_produkt'])) {
    $id = intval($_POST['nrProduktu']);
    $pole = $_POST['wyborPola']; 
    $nowaWartosc = $_POST['nowaWartosc'];
    $dozwolonePola = ['nazwa', 'cena', 'smak', 'kategoria', 'zdjecie', 'czy_promocja'];

    if (in_array($pole, $dozwolonePola)) {
        
        //walidacja pustych inputów
        if ($pole !== 'smak' && trim($nowaWartosc) === "") {
            $_SESSION['komunikat_edycja'] = "Pole '$pole' nie moze być puste!";
            $_SESSION['typ_komunikatu_edycja'] = "danger";
            header("Location: ../strony/strona_admin.php");
            exit();
        }
        //walidacja ceny
        if ($pole === 'cena') {
            $nowaWartosc = str_replace(',', '.', $nowaWartosc);
            if (!is_numeric($nowaWartosc)) {
                $_SESSION['komunikat_edycja'] = "Wprowadzona cena nie jest liczbą!";
                $_SESSION['typ_komunikatu_edycja'] = "danger";
                header("Location: ../strony/strona_admin.php");
                exit();
            }
        }
        $sql = "UPDATE produkty SET $pole = ? WHERE id = ?";
        $stmt = $polaczenie->prepare($sql);
        $stmt->bind_param("si", $nowaWartosc, $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['komunikat_edycja'] = "Zaktualizowano pole '$pole' dla produktu $id.";
                $_SESSION['typ_komunikatu_edycja'] = "success";
            } else {
                $_SESSION['komunikat_edycja'] = "Brak zmian (ID $id nie istnieje lub dane są identyczne).";
                $_SESSION['typ_komunikatu_edycja'] = "danger";
            }
        } else {
            $_SESSION['komunikat_edycja'] = "Bład bazy danych.";
            $_SESSION['typ_komunikatu_edycja'] = "danger";
        }
        $stmt->close();
    } else {
        $_SESSION['komunikat_edycja'] = "Nieprawidłowe pole edycji.";
        $_SESSION['typ_komunikatu_edycja'] = "danger";
    }
}

$polaczenie->close();
header("Location: ../strony/strona_admin.php");
exit();
?>