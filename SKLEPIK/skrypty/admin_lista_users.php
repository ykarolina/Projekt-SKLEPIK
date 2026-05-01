<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$serwer = "localhost";
$uzytkownik_db = "root";
$haslo_db = "";
$nazwa_db = "sklepik";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);

if ($polaczenie->connect_error) {
    die("Błąd połączenia: " . $polaczenie->connect_error);
}

// usuwanie uzytkownika
if (isset($_GET['usun_uzytkownika'])) {
    $id = intval($_GET['usun_uzytkownika']);

    //usuwnie pozycji zamowionych aby uniknac bledy foreing key
    $usun_pozycje = $polaczenie->prepare("DELETE FROM pozycje_zamowione WHERE id_zamowienia IN (SELECT id FROM zamowienia WHERE id_uzytkownika = ?)");
    $usun_pozycje->bind_param("i", $id);
    $usun_pozycje->execute();

    //usuwanie zamowien
    $usun_zamowienia = $polaczenie->prepare("DELETE FROM zamowienia WHERE id_uzytkownika = ?");
    $usun_zamowienia->bind_param("i", $id);
    $usun_zamowienia->execute();

    //usuwanie uzytkownika
    $zapytanie = $polaczenie->prepare("DELETE FROM uzytkownicy WHERE id = ?");
    $zapytanie->bind_param("i", $id);
    $zapytanie->execute();
    
    $_SESSION['aktywna_sekcja'] = 'lista';
    
    header("Location: ../strony/strona_admin.php");
    exit();
}

$wynik = $polaczenie->query("SELECT id, nazwa, rola FROM uzytkownicy");

//wyswietlanie listy
echo '<div class="listaUser">';
echo '<h2 class="tytulPanel fs-3 mb-4">lista uzytkowników</h2>';

if ($wynik->num_rows > 0) {
    $i = 1;
    while ($uzytkownik = $wynik->fetch_assoc()) {
        ?>
        <div class="user">
            <a href="?usun_uzytkownika=<?php echo $uzytkownik['id']; ?>" class="btnUsunUser">
                <span class="btnKwadrat">✖</span>
            </a>
            <span class="dane">
                <?php 
                echo $i++ . ". ";  
                echo htmlspecialchars($uzytkownik['nazwa']) . "|";
                echo "rola: ";
                echo htmlspecialchars($uzytkownik['rola']); 
                ?>
            </span>
        </div>
        <?php
    }
} else {
    echo '<p>Brak użytkowników w bazie.</p>';
}
echo '</div>';

$polaczenie->close();
?>