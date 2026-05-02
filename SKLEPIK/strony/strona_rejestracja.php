<?php session_start(); // Rozpoczęcie sesji, aby widzieć komunikaty ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zegowska Szama - rejestracja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../style/styl_header_footer.css">
    <link rel="stylesheet" href="../style/styl_logowanie_rejestracja.css">
    <!--aby czcionka z excalidraw byla taka sama-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>
    <header class="banner">
        <div class="container-fluid">
            <div class="logoDiv"><img src="../grafiki/loga/zegowskaSzama_v2.png" class="logo"></div>
        </div>
    </header>

    <main class="sectionLogRej container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <h2 class="tytulLogRej">Stwórz konto</h2>
                
                <div class="ramkaLogRej">
                    <form action="../skrypty/tworzenie_konta.php" method="POST" >
                         <div class="labelLogRej">
                            <label>Nazwa:</label>
                            <input type="text" name="nazwa" maxlength="20" class="inputLogRej">
                        </div>

                        <div class="labelLogRej">
                            <label>Email:</label>
                            <input type="email" name="email" class="inputLogRej">
                        </div>

                        <div class="labelLogRej">
                            <label>Hasło:</label>
                            <input type="password" name="haslo" class="inputLogRej">
                        </div>

                        <div class="labelLogRej">
                            <label>Powtórz hasło:</label>
                            <input type="password" name="hasloPow" class="inputLogRej">
                        </div>
                            <?php 
                                 if(isset($_SESSION['komunikat'])) {
                                    $typ = $_SESSION['typ_komunikatu'];
                                    echo '<div class="alert alert-'.$typ.' py-1 text-center komunikatLogRej">';
                                    echo $_SESSION['komunikat'];
                                    echo '</div>';
                
                                    // usuwanie komunikatu po odswierzeniu
                                    unset($_SESSION['komunikat']);
                                    unset($_SESSION['typ_komunikatu']);
                                    }
                            ?>
                        <button type="submit" class="btnLogRej">Zarejestruj</button>
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
                    <a href="#"><img src="../grafiki/loga/logo_ig.png" alt="Instagram"></a>
                    <a href="#"><img src="../grafiki/loga/logo_fb.png" alt="Facebook"></a>
                    <a href="#"><img src="../grafiki/loga/logo_www.png" alt="WWW"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>