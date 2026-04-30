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

// 1. SPRAWDZAMY WYBRANĄ KATEGORIĘ
$wybrana_kat = isset($_POST['filtr_kategorii']) ? $_POST['filtr_kategorii'] : 'wszystkie';

// 2. MODYFIKUJEMY ZAPYTANIE SQL W ZALEŻNOŚCI OD WYBORU
if ($wybrana_kat === 'wszystkie') {
    $sql = "SELECT id, nazwa, cena, smak, czy_promocja FROM produkty ORDER BY id DESC";
    $wynik = $polaczenie->query($sql);
} else {
    // Filtrowanie po konkretnej kategorii
    $sql = "SELECT id, nazwa, cena, smak, czy_promocja FROM produkty WHERE kategoria = ? ORDER BY id DESC";
    $stmt = $polaczenie->prepare($sql);
    $stmt->bind_param("s", $wybrana_kat);
    $stmt->execute();
    $wynik = $stmt->get_result();
}

// Wyświetlanie listy
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
                // Dodano #id - niezbędne dla administratora do edycji
                echo $produkt['id'];
                echo " | ";
                echo htmlspecialchars($produkt['nazwa']) . " | ";
                echo number_format($produkt['cena'], 2) . " zł";
                echo $smak . " | " . $promocja;
                ?>
            </span>
        </div>
        <?php
    }
} else {
    echo '<p class="mt-2">Brak produktów w kategorii: ' . htmlspecialchars($wybrana_kat) . '</p>';
}

// Wyświetlanie komunikatu (jeśli istnieje) pod listą
if (isset($_SESSION['komunikat_edycja'])) {
    echo '<div class="alert alert-' . $_SESSION['typ_komunikatu_edycja'] . ' mt-3" style="font-size: 0.9rem; padding: 10px;">';
    echo $_SESSION['komunikat_edycja'];
    echo '</div>';
    unset($_SESSION['komunikat_edycja']);
    unset($_SESSION['typ_komunikatu_edycja']);
}

$polaczenie->close();
?>