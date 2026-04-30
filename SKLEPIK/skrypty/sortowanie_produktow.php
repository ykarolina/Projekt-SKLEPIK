<?php
// Połączenie z bazą (jeśli nie masz go wcześniej w pliku)
$serwer = "localhost";
$uzytkownik_db = "root";
$haslo_db = "";
$nazwa_db = "sklepik";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);

// Sprawdzamy czy przyszła kategoria z formularza
$wybrana_kategoria = $_POST['filtr_kategorii'] ?? 'wszystkie';

// Budujemy zapytanie SQL w zależności od wyboru
if ($wybrana_kategoria == 'wszystkie') {
    $sql = "SELECT id, nazwa, cena, smak, czy_promocja FROM produkty ORDER BY id DESC";
    $wynik = $polaczenie->query($sql);
} else {
    // Używamy prepare, aby było bezpieczniej
    $stmt = $polaczenie->prepare("SELECT id, nazwa, cena, smak, czy_promocja FROM produkty WHERE kategoria = ? ORDER BY id DESC");
    $stmt->bind_param("s", $wybrana_kategoria);
    $stmt->execute();
    $wynik = $stmt->get_result();
}

if ($wynik && $wynik->num_rows > 0) {
    while ($produkt = $wynik->fetch_assoc()) {
        $promocja = ($produkt['czy_promocja'] == 1) ? "na promocji" : "brak promocji";
        $smak = !empty($produkt['smak']) ? " | " . htmlspecialchars($produkt['smak']) : "";

        ?>
        <div class="user">
            <form action="../skrypty/edytowanie_produktu.php" method="POST" style="display:inline;">
                <button type="submit" name="usun_produkt" value="<?php echo $produkt['id']; ?>" class="btnUsunUser border-0 p-0">
                    <span class="btnKwadrat">✖</span>
                </button>
            </form>
            <span class="dane">
                <?php
                echo "<b>#" . $produkt['id'] . "</b> " . htmlspecialchars($produkt['nazwa']) . " | ";
                echo number_format($produkt['cena'], 2) . " zł";
                echo $smak . " | " . $promocja;
                ?>
            </span>
        </div>
        <?php
    }
} else {
    echo '<p class="mt-2">Brak produktów w tej kategorii.</p>';
}

$polaczenie->close();
?>