//pobieranie sekcji
const sekcjaPowitalna = document.getElementById('sekcjaPowitalna');
const sekcjaUzytkownicy = document.querySelector('.listaUzytkownikow');
const sekcjaZmianaRol = document.querySelector('.zmianaRol');
const sekcjaDodawanie = document.querySelector('.dodajProdukt');
const sekcjaEdycja = document.querySelector('.sectionEdycja');
const sekcjaZamowienia = document.querySelector('.sekcjaZamowienia');

//ukrywanie wszystkich sekcji
function ukryjWszystkieSekcje() {
    sekcjaUzytkownicy.style.display = 'none';
    sekcjaZmianaRol.style.display = 'none';
    sekcjaDodawanie.style.display = 'none';
    sekcjaEdycja.style.display = 'none';
    sekcjaZamowienia.style.display = 'none';
}

// pokazywanie sekcji + zapamietywanie
function pokazSekcje(nazwa) {
    ukryjWszystkieSekcje();
    // zapis dopiero po kliknięciu
    localStorage.setItem('aktywnaSekcja', nazwa);

    if (nazwa === 'uzytkownicy') {
        sekcjaUzytkownicy.style.display = 'block';
    }
    if (nazwa === 'role') {
        sekcjaUzytkownicy.style.display = 'block';
        sekcjaZmianaRol.style.display = 'block';
    }
    if (nazwa === 'dodawanie') {
        sekcjaDodawanie.style.display = 'block';
    }
    if (nazwa === 'edycja') {
        sekcjaEdycja.style.display = 'block';
    }
    if (nazwa === 'zamowienia') {
        sekcjaZamowienia.style.display = 'block';
    }
}

//co sie stanie po kliknieciu
document.getElementById('btnListaUzytkownikow').onclick = () => pokazSekcje('uzytkownicy');
document.getElementById('btnZmianaRol').onclick = () => pokazSekcje('role');
document.getElementById('btnDodajProdukt').onclick = () => pokazSekcje('dodawanie');
document.getElementById('btnEdycjaProduktow').onclick = () => pokazSekcje('edycja');
document.getElementById('btnListaZamowien').onclick = () => pokazSekcje('zamowienia');

//startowanie strony
window.addEventListener('load', () => {
    const zapisanaSekcja = localStorage.getItem('aktywnaSekcja');

    if (zapisanaSekcja) {
        //jesli byla jakas wybrana sekcja pokazuje ja 
        sekcjaPowitalna.style.display = 'block';
        pokazSekcje(zapisanaSekcja);
    } else {
        //jesli piwerwsze wejscie to tylko sekcja powitalna
        sekcjaPowitalna.style.display = 'block';
        ukryjWszystkieSekcje();
    }
});