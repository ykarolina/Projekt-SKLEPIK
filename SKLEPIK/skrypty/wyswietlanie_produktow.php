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

// --- LOGIKA USUWANIA PRODUKTU ---
if (isset($_POST['usun_produkt'])) {
    $id_produktu = intval($_POST['usun_produkt']);

    //usuwanie po kolei aby unikac bledy ze usuwanmy klucz glowny
    $usun_pozycje = $polaczenie->prepare("DELETE FROM pozycje_zamowione WHERE id_produktu = ?");
    $usun_pozycje->bind_param("i", $id_produktu);
    $usun_pozycje->execute();

    // 2. Teraz usuwamy sam produkt
    $zapytanie = $polaczenie->prepare("DELETE FROM produkty WHERE id = ?");
    $zapytanie->bind_param("i", $id_produktu);
    
    if ($zapytanie->execute()) {
        $_SESSION['komunikat_edycja'] = "Produkt został pomyslnie usuniety.";
        $_SESSION['typ_komunikatu_edycja'] = "success";
    } else {
        $_SESSION['komunikat_edycja'] = "Błąd podczas usuwania produktu.";
        $_SESSION['typ_komunikatu_edycja'] = "danger";
    }
    //aby uniknac bledu
   echo "<script>window.location.href='../strony/strona_admin.php';</script>";
    exit();
}

//pobieranie listy produktow
$wybrana_kat = isset($_POST['filtr_kategorii']) ? $_POST['filtr_kategorii'] : 'wszystkie';

if ($wybrana_kat === 'wszystkie') {
    $sql = "SELECT id, nazwa, cena, kategoria ,smak, czy_promocja, zdjecie FROM produkty ORDER BY id ASC";
    $wynik = $polaczenie->query($sql);
} else {
    $sql = "SELECT id, nazwa, cena, kategoria, smak, czy_promocja, zdjecie FROM produkty WHERE kategoria = ? ORDER BY id DESC";
    $stmt = $polaczenie->prepare($sql);
    $stmt->bind_param("s", $wybrana_kat);
    $stmt->execute();
    $wynik = $stmt->get_result();
}

//wyswietlanie listy
if ($wynik && $wynik->num_rows > 0) {
    while ($produkt = $wynik->fetch_assoc()) {
        $promocja = ($produkt['czy_promocja'] == 1) ? "PROMOCJA" : "bez promocji";
        $smak = !empty($produkt['smak']) ?  htmlspecialchars($produkt['smak']) . " | " : "";
        $foto_tekst = !empty($produkt['zdjecie']) ? htmlspecialchars($produkt['zdjecie']) : " | brak zdjecia";
        ?>
        <div class="user">
            <form action="" method="POST" style="display:inline;">
                <button type="submit" name="usun_produkt" value="<?php echo $produkt['id']; ?>" class="btnUsunUser border-0 p-0">
                    <span class="btnKwadrat">✖</span>
                </button>
            </form>
            <span class="dane">
                <?php
                echo $produkt['id'] . ". ";
                echo htmlspecialchars($produkt['nazwa']) . " | ";
                echo number_format($produkt['cena'], 2) . " zł" . " | ";
                echo htmlspecialchars($produkt['kategoria']);
                echo " | " ;
                echo $smak . $foto_tekst . " | " . $promocja;
                ?>
            </span>
        </div>
        <?php
    }
} else {
    echo '<p class="mt-2">Brak produktow w kategorii: ' . htmlspecialchars($wybrana_kat) . '</p>';
}

// wywietlanie komunikatu
if (isset($_SESSION['komunikat_edycja'])) {
    echo '<div class="alert alert-' . $_SESSION['typ_komunikatu_edycja'] . ' mt-3" style="font-size: 0.9rem; padding: 10px;">';
    echo $_SESSION['komunikat_edycja'];
    echo '</div>';
    unset($_SESSION['komunikat_edycja']);
    unset($_SESSION['typ_komunikatu_edycja']);
}

$polaczenie->close();
?>