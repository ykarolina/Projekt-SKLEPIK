<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$serwer = "localhost";
$uzytkownik_db = "sklepikzeg";
$haslo_db = "Baza123!";
$nazwa_db = "ykarolina";

$polaczenie = new mysqli($serwer, $uzytkownik_db, $haslo_db, $nazwa_db);
$polaczenie->set_charset("utf8mb4");

if ($polaczenie->connect_error) die("Błąd połączenia: " . $polaczenie->connect_error);

//przycisk zmien status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['akcja_status'])) {
    $id_zam = $_POST['id_zamowienia'];
    $nowy_status = $_POST['nowy_status'];
    
    $zapytanie_update = $polaczenie->prepare("UPDATE zamowienia SET status = ? WHERE id = ?");
    $zapytanie_update->bind_param("si", $nowy_status, $id_zam);
    
    if($zapytanie_update->execute()){
        $_SESSION['komunikat_zamowienie'] = "Zaktualizowano status zamówienia nr $id_zam!";
        $_SESSION['typ_komunikatu_zamowienie'] = "success";
    } else {
        $_SESSION['komunikat_zamowienie'] = "Błąd podczas aktualizacji statusu.";
        $_SESSION['typ_komunikatu_zamowienie'] = "danger";
    }
    
    $zapytanie_update->close();

    //uzywamy zeby nie bylo bledu ze juz wyswano i komunikat usuwal sie po odswiezeniu
    echo '<script>window.location.href = window.location.href;</script>';
    exit();
}

// komunikat
if(isset($_SESSION['komunikat_zamowienie'])): ?>
    <div class="alert alert-<?php echo $_SESSION['typ_komunikatu_zamowienie']; ?> fade show w-75 text-center mb-4 mx-auto">
        <strong><?php echo $_SESSION['komunikat_zamowienie']; ?></strong>
        <?php 
        //usuwanie komunikatu
            unset($_SESSION['komunikat_zamowienie']); 
            unset($_SESSION['typ_komunikatu_zamowienie']);
        ?>
    </div>
<?php endif;

//pobranie zamowien
$sql_zamowienia = "SELECT z.id, z.status, u.nazwa FROM zamowienia z JOIN uzytkownicy u ON z.id_uzytkownika = u.id ORDER BY z.id ASC";
$wynik_zamowienia = $polaczenie->query($sql_zamowienia);

if ($wynik_zamowienia->num_rows > 0) {
    echo '<div class="listaZamowienScroll mx-auto">';
    
    while ($zamowienie = $wynik_zamowienia->fetch_assoc()) {
        $id_zam = $zamowienie['id'];
        
        echo '<div class="kafelekZamowienie p-4 mb-5">';
        echo '<h4 class="nazwaKlienta mb-4">' . htmlspecialchars($zamowienie['nazwa']) . ' (Zamówienie nr: ' . $id_zam . ')</h4>';
        echo '<div class="d-flex flex-nowrap align-items-center gap-4">';
        
        //produkty w zamówieniu
        echo '<div class="d-flex align-items-stretch gap-3 kontenerProduktow">';
        $sql_produkty = "SELECT p.nazwa, p.zdjecie, p.smak, p.kategoria FROM pozycje_zamowione pz JOIN produkty p ON pz.id_produktu = p.id WHERE pz.id_zamowienia = $id_zam";
        $wynik_produkty = $polaczenie->query($sql_produkty);
        
        while ($produkt = $wynik_produkty->fetch_assoc()) {
            $sciezka_foto = "../grafiki/" . $produkt['kategoria'] . "/" . $produkt['zdjecie'];
            echo '<div class="ramkaMiniZdj">';
            echo '  <div class="divImg"><img src="' . $sciezka_foto . '" class="imgZdjMini"></div>';
            echo '  <p class="nazwaMiniProd">' . htmlspecialchars($produkt['nazwa']) . '</p>';
            if (!empty($produkt['smak'])) {
                echo '  <p class="wariantProd text-muted">smak: ' . htmlspecialchars($produkt['smak']) . '</p>';
            }
            echo '</div>';
        }
        echo '</div>'; //koniec kontener poduktow

        //form zmiany statusu
        echo '<div class="statusZamowienia">';
        echo '  <label>status zamówienia:</label>';
        echo '  <form method="POST" class="statusKontener">';
        echo '    <input type="hidden" name="id_zamowienia" value="' . $id_zam . '">';
        echo '    <select name="nowy_status" class="inputAdmin miniSelect">';
        //tablica zeby statusy sie nie mylily
        $opcje_statusu = [
            'oczekujące' => 'oczekujące', 
            'realizacja' => 'w realizacji', 
            'zrealizowane' => 'zrealizowane'
        ];
        foreach ($opcje_statusu as $klucz => $wartosc) {
            $wybrany = ($zamowienie['status'] == $klucz) ? 'selected' : '';
            echo "<option value='$klucz' $wybrany>$wartosc</option>";
        }   
        echo '    </select>';
        echo '    <button type="submit" name="akcja_status" class="mt-2 p-1 btnAdminPanel btnZmienStatus">zmień status</button>';
        echo '  </form>';
        echo '</div>';
        echo '</div>';
        echo '</div>'; 
    }
    //zamkniecie scrola
    echo '</div>'; 
} else {
    echo '<p class="text-center">Brak zamówień do wyświetlenia.</p>';
}
$polaczenie->close();
?>