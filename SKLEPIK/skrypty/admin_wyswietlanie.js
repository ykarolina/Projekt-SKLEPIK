//pobieranie sekcji 
    const sekcjaUzytkownicy = document.querySelector('.listaUzytkownikow')
    const sekcjaZmianaRol = document.querySelector('.zmianaRol');
    const sekcjaDodawanie = document.querySelector('.dodajProdukt');
    const sekcjaEdycja = document.querySelector('.sectionEdycja');
    const sekcjaZamowienia = document.querySelector('.sekcjaZamowienia');

    // funkcja do usuwaniei sekcji
    function ukryjWszystkieSekcje() {
        sekcjaUzytkownicy.style.display = 'none';
        sekcjaZmianaRol.style.display = 'none';
        sekcjaDodawanie.style.display = 'none';
        sekcjaEdycja.style.display = 'none';
        sekcjaZamowienia.style.display = 'none';
    }

    document.getElementById('btnListaUzytkownikow').addEventListener('click', function() {
        ukryjWszystkieSekcje();
        sekcjaUzytkownicy.style.display = 'block';
    });

    document.getElementById('btnZmianaRol').addEventListener('click', function() {
        ukryjWszystkieSekcje();
        sekcjaUzytkownicy.style.display = 'block';
        sekcjaZmianaRol.style.display = 'block';
    });

    // Dodawanie produktu
    document.getElementById('btnDodajProdukt').addEventListener('click', function() {
        ukryjWszystkieSekcje();
        sekcjaDodawanie.style.display = 'block';
    });

    // Edycja i usuwanie
    document.getElementById('btnEdycjaProduktow').addEventListener('click', function() {
        ukryjWszystkieSekcje();
        sekcjaEdycja.style.display = 'block';
    });

    // Lista zamówień
    document.getElementById('btnListaZamowien').addEventListener('click', function() {
        ukryjWszystkieSekcje();
        sekcjaZamowienia.style.display = 'block';
    });
