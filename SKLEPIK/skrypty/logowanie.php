<?php
session_start();

$serwer = "localhost";
$uzytkownik_db = "sklepikzeg";
$haslo_db = "Baza123!";
$nazwa_db = "ykarolina";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);
$polaczenie->set_charset("utf8mb4");

//sprawdzenie połączenia
if ($polaczenie->connect_error) {
    die("Błąd połączenia: " . $polaczenie->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //czysci z bialych znakow
    $email = trim($_POST['email']);
    $haslo_wpisane = $_POST['haslo'];

    //walidacja
    if (empty($email) || empty($haslo_wpisane)) {
        $_SESSION['komunikat'] = "Wypełnij wszystkie pola!";
        $_SESSION['typ_komunikatu'] = "danger";
        header("Location: ../strony/strona_logowanie.php");
        exit;
    }

    //szukanie użytkownika w bazie
    $zapytanie = $polaczenie->prepare("SELECT id, haslo, rola FROM uzytkownicy WHERE email = ?");
    $zapytanie->bind_param("s", $email);
    $zapytanie->execute();
    $wynik = $zapytanie->get_result();

    if ($uzytkownik = $wynik->fetch_assoc()) {
        //password_verify sprawdza czy wpisane hasło pasuje do hashu
        if (password_verify($haslo_wpisane, $uzytkownik['haslo'])) {
            //logowanie poprawne ( sesja użytkownika)
            $_SESSION['zalogowany'] = true;
            $_SESSION['uzytkownik_id'] = $uzytkownik['id'];
            $_SESSION['rola'] = $uzytkownik['rola'];

            //strona głowna
            header("Location: ../strony/strona_glowna.php");
            exit;
            
        } else {
            //nie pasujace haslo
            $_SESSION['komunikat'] = "Błędne hasło!";
            $_SESSION['typ_komunikatu'] = "danger";
        }
    } else {
        //brak maila w bazie
        $_SESSION['komunikat'] = "Użytkownik o takim adresie e-mail nie istnieje!";
        $_SESSION['typ_komunikatu'] = "danger";
    }

    //powrot do logowanie jesli blad
    header("Location: ../strony/strona_logowanie.php");
    exit;
} else {
    header("Location: ../strony/strona_logowanie.php");
    exit;
}

$polaczenie->close();
?>