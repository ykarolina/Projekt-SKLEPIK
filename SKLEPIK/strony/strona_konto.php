<?php 
include '../skrypty/konto.php'; // To musi być PIERWSZA linia
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zegowska Szama - konto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../style/styl_header_footer.css">
    <link rel="stylesheet" href="../style/styl_konto.css">

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
                <a href="strona_logowanie_admin.html"><img src="../grafiki/loga/admin.png" class="imgHeader"> Admin</a>
               
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
            <a href="strona_logowanie_admin.html"><img src="../grafiki/loga/admin.png" class="imgHeader"> Admin</a>
        </nav>
    </header>
<main class="strona">
    <section class="sekcjaProfil container mt-5">
        <div class="row mb-4">
            <div class="col-12 text-center text-lg-start">
                <h2 class="napisCzesc">
                    CZESC <span class="nazwaUser"><?php echo htmlspecialchars($nazwa_user); ?></span>, witamy w zegowskiej szamie
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-7">
                <h5 class="naglowekHistorii mb-3">historia zamówien</h5>
                <div class="zamowieniaHistoria">
                <?php if (empty($zamowienia)): ?>
                    <p class="text-muted">Nie masz jeszcze zadnych zamowien.</p>
                <?php else: ?>
                    <?php foreach ($zamowienia as $id_zam => $dane): ?>
                        <div class="kafelekZamowienieUser p-2 p-lg-3 mb-4">
                            <?php foreach ($dane['produkty'] as $p): ?>
                                <div class="ramkaProduktuHistoria d-flex flex-column flex-xl-row align-items-center p-2 p-lg-3 mb-2 gap-3">
                                    <div class="d-flex align-items-center gap-3 flex-grow-1 w-100">
                                        <img src="../grafiki/<?php echo $p['kategoria']; ?>/<?php echo $p['zdjecie']; ?>" 
                                             alt="<?php echo $p['nazwa']; ?>" 
                                             class="imgHistoria">
                                        <h5 class="nazwaProduktuHistoria m-0">
                                            <?php echo $p['nazwa']; ?>
                                        </h5>
                                    </div>

                                    <div class="sekcjaCenaIlosc d-flex align-items-center justify-content-between justify-content-xl-end gap-3 w-100 w-xl-auto pt-2 pt-xl-0">
                                        <div class="cenaHistoria" style="white-space: nowrap;">
                                            <?php echo number_format($p['cena_jednostkowa'], 2, ',', ''); ?>zł
                                        </div>
                                        <div class="ilosc" style="white-space: nowrap;">
                                            ilosc: <?php echo $p['ilosc']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="d-flex justify-content-between align-items-center mt-2 px-2 flex-wrap gap-2">
                                <div class="tekstPodsumowania">
                                    Koszt zamówienia: <?php echo number_format($dane['suma'], 2, ',', ''); ?>zł
                                </div>
                                <div class="statusTekst">
                                    status: <?php echo $dane['status']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-xl-5 d-flex flex-column align-items-center align-items-xl-end mt-5 mt-xl-0">
                <h1 class="twojeKonto">TWOJE KONTO</h1>
                <div class="daneUzytkownika text-center text-xl-end">
                    <p class="daneUser">Twoja nazwa: <?php echo htmlspecialchars($nazwa_user); ?></p>
                    <p class="daneUser">Twój mail to: <?php echo htmlspecialchars($mail_user); ?></p>
                </div>
            </div>
        </div>
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