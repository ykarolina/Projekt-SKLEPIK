<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zegowska Szama - admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../style/styl_header_footer.css">
    <link rel="stylesheet" href="../style/styl_logowanie_rejestracja.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="../grafiki/loga/logo_zeg.png">
</head>
<body>
    <header class="banner">
        <div class="container-fluid">
            <div class="logoDiv"><img src="../grafiki/loga/zegowskaSzama_v2.png" class="logo"></div>
        </div>
    </header>

    <main class="sectionLogRej container d-flex flex-column justify-content-center align-items-center">
    <div class="row justify-content-center w-100">
        <div class="col-12 text-center">
            <h2 class="tytulLogRej">Zaloguj się jako administrator</h2>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="ramkaLogRej">
                <form action="../skrypty/logowanie_admin.php" method="POST">
                    <div class="labelLogRej">
                        <label>Nazwa:</label>
                        <input type="text" name="nazwaAdmin" class="inputLogRej">
                    </div>
                    <div class="labelLogRej">
                        <label>Kod dostępu:</label>
                        <input type="number" name="kodDostepu" class="inputLogRej">
                    </div>
                    <div class="labelLogRej">
                        <label>Hasło:</label>
                        <input type="password" name="hasloAdmin" class="inputLogRej">
                    </div>
                    <?php if(isset($_SESSION['komunikat'])): ?>
            <div class="alert alert-danger py-1 text-center komunikatLogRej">
                <?php echo $_SESSION['komunikat']; unset($_SESSION['komunikat']); ?>
            </div>
        <?php endif; ?>
                    <button type="submit" class="btnLogRej">Zaloguj</button>
                </form>
            </div>
        </div>
    </div>
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
                    <a href="https://www.instagram.com/zegowska_szama/" target="_blank"><img src="../grafiki/loga/logo_ig.png" alt="Instagram"></a>
                    <a href="https://www.facebook.com/ZEG.ZS4.Tychy/?locale=pl_PL" target="_blank"><img src="../grafiki/loga/logo_fb.png" alt="Facebook"></a>
                    <a href="https://www.zs4.oswiata.tychy.pl/" target="_blank"><img src="../grafiki/loga/logo_www.png" alt="WWW"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>