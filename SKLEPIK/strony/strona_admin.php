<?php
    session_start();
?>  
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zegowska Szama - admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../style/styl_header_footer.css">
    <link rel="stylesheet" href="../style/styl_panel_admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>
    <header class="banner">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="logoDiv">
                <img src="../grafiki/loga/zegowskaSzama_v2.png" class="logo">
            </div>
            <div class="kontener2">
                <a href="strona_glowna.html"><img src="../grafiki/loga/logo_hot-dog.png" class="imgHeader"> Produkty</a> 
                <a href="strona_koszyk.html"><img src="../grafiki/loga/logo_koszyk.png" class="imgHeader"> Koszyk</a>
                <a href="strona_konto.html"><img src="../grafiki/loga/logo_konto.png" class="imgHeader"> Konto</a>
               
            </div>
            <div class="menuTel" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <nav class="navTel" id="mobileMenu">
            <a href="strona_glowna.html"><img src="../grafiki/loga/logo_hot-dog.png" class="imgHeader"> Produkty</a> 
            <a href="strona_koszyk.html"><img src="../grafiki/loga/logo_koszyk.png" class="imgHeader"> Koszyk</a>
            <a href="strona_konto.html"><img src="../grafiki/loga/logo_konto.png" class="imgHeader"> Konto</a>
        </nav>
    </header>
    <main class="strona">
      <section class="container mt-5">
        <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
            <h1 class="tytulAdmin">Panel administratora</h1>
        </div>

        <div class="col-12">
            <div class="row g-2 justify-content-center">
                <div class="col-4 col-md-auto p-1 d-flex justify-content-center">
                    <button type="button" class="btn btnAdminPanel">lista uzytkowników</button>
                </div>
              
                <div class="col-4 col-md-auto p-1 d-flex justify-content-center">
                    <button type="button" class="btn btnAdminPanel">zmiana ról</button>
                </div>
                <div class="col-4 col-md-auto p-1 d-flex justify-content-center">
                    <button type="button" class="btn btnAdminPanel">dodawanie produktu</button>
                </div>

                <div class="col-6 col-md-auto p-1 d-flex justify-content-center">
                    <button type="button" class="btn btnAdminPanel">edycja i usuwanie produktów</button>
                </div>
                <div class="col-6 col-md-auto p-1 d-flex justify-content-center">
                    <button type="button" class="btn btnAdminPanel">lista zamówien</button>
                </div>
            </div>
        </div>
        </div>
      </section>
    <section class="zmianaRol container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-lg-5 pe-lg-5 mb-5 mb-md-0">
            <div class="listaUserAdmin">
                <?php include '../skrypty/admin_lista_users.php'; ?>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-5 ps-lg-5">
            <div class="ramka p-3 p-sm-4 mx-auto" style="max-width: 450px;">
                <h2 class="tytulPanel fs-4 mb-4 text-center">ZMIANA ROLI UZYTKOWIKA</h2>
                <?php if(isset($_SESSION['komunikat_rola'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['typ_komunikatu_rola']; ?> alert-sm p-1 text-center" style="font-size: 0.8rem;">
                        <?php 
                            echo $_SESSION['komunikat_rola']; 
                            unset($_SESSION['komunikat_rola']); 
                            unset($_SESSION['typ_komunikatu_rola']);
                        ?>
                    </div>
                <?php endif; ?>

                <form action="../skrypty/zmiana_roli.php" method="POST" class="d-flex flex-column gap-3">

                    <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center justify-content-lg-center gap-2">
                        <label class="mb-0 text-center text-lg-start">nazwa uzytkownika:</label>
                        <input type="text" name="nazwaUzytkownika" class="inputAdmin w-100 w-lg-auto" style="max-width: 210px;">
                    </div>

                    <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center justify-content-lg-between gap-4">
                        <div class="d-flex align-items-center gap-2">
                            <label class="mb-0">rola:</label>
                            <select name="rola" class="py-1 inputAdmin" style="width: 100px; height: 45px;">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btnAdminPanel btnZmienRole px-3 mb-0 w-100 w-lg-auto"> zmien role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="dodajProdukt container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-center">
            <div class="ramka p-4 w-100">
                <h2 class="tytulPanel fs-3 mb-4 text-center">DODAJ PRODUKT</h2>
                    <?php if(isset($_SESSION['komunikat_produkt'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['typ_komunikatu_produkt']; ?> alert-sm p-2 text-center mb-4" style="font-size: 0.9rem;">
                        <?php 
                            echo $_SESSION['komunikat_produkt']; 
                            unset($_SESSION['komunikat_produkt']); 
                            unset($_SESSION['typ_komunikatu_produkt']);
                        ?>
                    </div>
                <?php endif; ?>

                <form action="../skrypty/dodawanie_produktu.php" method="POST">
                    <div class="row px-md-4 mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="d-block mb-1">Nazwa:</label>
                            <input type="text" name="nazwaProduktu" class="inputAdmin w-100">
                        </div>
                        <div class="col-md-6">
                            <label class="d-block mb-1">Kategoria:</label>
                            <select name="kategoria" class="inputAdmin w-100">
                                <option value="kawa">kawa</option>
                                <option value="napoje">napoje</option>
                                <option value="bulki">bulki</option>
                                <option value="na_cieplo">na cieplo</option>
                                <option value="inne">inne</option>
                            </select>
                        </div>
                    </div>

                    <div class="row px-md-4 mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="d-block mb-1">Nazwa zdjecia (.rozszerzenie):</label>
                            <input type="text" name="foto" class="inputAdmin w-100">
                        </div>
                        <div class="col-md-6">
                            <label class="d-block mb-1">Cena:</label>
                            <input type="number" step="0.01" name="cena" max="100" class="inputAdmin w-100">
                        </div>
                    </div>

                   <div class="d-flex justify-content-center align-items-center gap-4 mb-4 mt-4 flex-wrap">
                        <div class="form-check d-flex align-items-center gap-2 mb-0">
                            <input class="custom-radio" type="radio" name="promocja" id="brak" value="0" checked>
                            <label for="brak" class="mb-0">brak promocji</label>
                        </div>

                        <div class="form-check d-flex align-items-center gap-2 mb-0">
                            <input class="custom-radio" type="radio" name="promocja" id="na" value="1">
                            <label for="na" class="mb-0">na promocji</label>
                        </div>

                        <div class="d-flex align-items-center gap-2 ms-auto me-2 me-md-4">
                            <label class="mb-0 AdminSmak">smak (opcjonalnie)</label>
                            <input type="text" name="smak" class="inputAdmin w-75">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btnAdminPanel btnDodajProdukt px-5 py-2 w-auto mx-auto">dodaj produkt</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="sectionEdycja container mt-5">
    <h1 class="tytulPanel fs-2 mb-5 text-center">EDYTUJ PRODUKT</h1>
    <div class="row gy-5 justify-content-center">
        
        <div class="col-12 col-md-4 ps-md-5">
            <h2 class="tytulPanel fs-3 mb-4 text-center">LISTA PRODUKTOW</h2>
            <div class="d-flex flex-column align-items-center align-items-md-start">
                <h4 class="mb-1">kategoria:</h4>
                <form method="POST" action="" class="w-100 d-flex flex-column align-items-center align-items-md-start">
                    <select name="filtr_kategorii" class="inputAdmin w-50 py-1 h-25" onchange="this.form.submit()">
                        <!--filtrowanie kategori !-->
                        <?php
                        $kat = $_POST['filtr_kategorii'] ?? 'wszystkie';
                        ?>
                        <option value="wszystkie" <?php if($kat == 'wszystkie') echo 'selected'; ?>>wszystkie</option>
                        <option value="kawa" <?php if($kat == 'kawa') echo 'selected'; ?>>kawa</option>
                        <option value="napoje" <?php if($kat == 'napoje') echo 'selected'; ?>>napoje</option>
                        <option value="bulki" <?php if($kat == 'bulki') echo 'selected'; ?>>bułki</option>
                        <option value="na_cieplo" <?php if($kat == 'na_cieplo') echo 'selected'; ?>>na ciepło</option>
                        <option value="inne" <?php if($kat == 'inne') echo 'selected'; ?>>inne</option>
                    </select>
                </form>
                <div class="w-100"> 
                    <?php
                    if (isset($_SESSION['komunikat_edycja'])) {
                        echo '<div class="alert alert-' . $_SESSION['typ_komunikatu_edycja'] . ' mt-2 mb-2" style="font-size: 0.9rem; padding: 8px;">';
                        echo $_SESSION['komunikat_edycja'];
                        echo '</div>';
                        unset($_SESSION['komunikat_edycja']);
                        unset($_SESSION['typ_komunikatu_edycja']);
                    }
                    ?>
                </div>
                <div class="w-100 mt-1 produktyLista">
                    <?php include '../skrypty/wyswietlanie_produktow.php'; ?>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-5 d-flex justify-content-center justify-content-md-end ms-auto">
            <div class="ramka p-4 p-lg-5 w-100"> 
                <h2 class="tytulPanel fs-3 mb-4 text-center">EDYTOWANIE PRODUKTU</h2>
                <form action="../skrypty/edytowanie_produktu.php" method="POST" class="d-flex flex-column gap-2">
                    <div class="row g-2"> 
                        <div class="col-md-6 mb-2">
                            <label class="mb-1">Numer produktu:</label>
                            <input type="text" name="nrProduktu" class="inputAdmin w-100">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="mb-1">edytuj pole:</label>
                            <select name="wyborPola" class="inputAdmin w-100 py-1">
                                <option value="nazwa">nazwa</option>
                                <option value="cena">cena</option>
                                <option value="smak">smak</option>
                                <option value="kategoria">kategoria</option>
                                <option value="zdjecie">nazwa pliku zdjęcia</option>
                                <option value="czy_promocja">promocja (0 -brak lub 1-promo)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2 align-items-end">
                        <div class="col-md-6 mb-2">
                            <label class="mb-1">zmiana na:</label>
                            <input type="text" name="nowaWartosc" class="inputAdmin w-100">
                        </div>
                        <div class="col-md-6 mb-2">
                            <button type="submit" name="aktualizuj_produkt" class="btnAdminPanel btnZmienRole w-100">zaktualizuj</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="sekcjaZamowienia container mt-5">
    <h1 class="tytulZamowien text-center mb-5">LISTA ZAMÓWIEN</h1>
        <?php include '../skrypty/lista_zamowien.php'; ?>
    <!-- <div class="kafelekZamowienie p-4 mb-5">
        <h4 class="nazwaKlienta mb-4">nazwa uzytkownika</h4>
        <div class="d-flex flex-nowrap align-items-center gap-4">
            <div class="d-flex align-items-stretch gap-3 kontenerProduktow">
                
                <div class="ramkaMiniZdj">
                    <div class="divImg">
                        <img src="../grafiki/kawy/czarna.png" alt="zdj" class="imgZdjMini">
                    </div>
                    <p class="nazwaMiniProd">kawa czarna</p>
                </div>

                <div class="ramkaMiniZdj">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="../grafiki/napoje/sok_05_arbuz.png" alt="zdj" class="imgZdjMini">
                        <p class="nazwaMiniProd mb-0">sok plastik 0,5L</p>
                        <p class="wariantProd text-muted">smak: arbuz</p>
                    </div>
                </div>

                <div class="ramkaMiniZdj">
                    <div class="divImg">
                        <img src="../grafiki/na_cieplo/tost_szynka.jpg" alt="zdj" class="imgZdjMini">
                    </div>
                    <p class="nazwaMiniProd">tost z szynka</p>
                </div>

                <div class="ramkaMiniZdj">
                    <div class="divImg">
                        <img src="../grafiki/bulki/bulka_ser.png" alt="zdj" class="imgZdjMini">
                    </div>
                    <p class="nazwaMiniProd">bułka z serem</p>
                </div>
            </div> -->
<!-- 
            <div class="statusZamowienia">
                <label>status zamówienia:</label>
                <div class="statusKontener">
                    <select class="inputAdmin miniSelect">
                       <option value="oczekujace">oczekujace</option>
                        <option value="realizacja">w realizacji</option>
                        <option value="realizacja">zrealizowane</option>
                    </select>
                <button class="mt-2 p-1 btnAdminPanel btnZmienStatus">zmien status</button>
                </div>
            </div>
          </div>
            </div> -->
    
    
</section>
</main>
   <footer class="stopka">
    <div class="container">
        <div class="row align-items-center gy-4 gy-md-0">
            <div class="col-12 col-md-4 text-start dane">
                <p><strong>Adres:</strong> al. Bielska 100, 43-100 Tychy</p>
                <p><strong>Kontakt:</strong> 32 217 38 22</p>
                <p><strong>Autorzy:</strong></p>
            </div>

            <div class="col-12 col-md-4 text-center zeg">
                <img src="../grafiki/loga/logo_zeg.png" alt="Logo ZEG" class="logoZEG">
                <p class="mb-0">Zespół Szkół nr 4 im. J. Groszkowskiego w Tychach</p>
            </div>
            
            <div class="col-12 col-md-4 text-md-end media">
                <span>Nasze media</span>
                <div class="ikony">
                    <a href="#"><img src="../grafiki/loga/logo_ig.png" alt="Instagram"></a>
                    <a href="#"><img src="../grafiki/loga/logo_fb.png" alt="Facebook"></a>
                    <a href="#"><img src="../grafiki/loga/logo_www.png" alt="WWW"></a>
                </div>
            </div>
        </div>
    </div>
     <script>
        function toggleMenu() {
            document.getElementById('mobileMenu').classList.toggle('active');
        }
    </script>
</footer>
</body>
</html>