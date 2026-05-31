document.addEventListener("DOMContentLoaded", () => {

    const przyciski = document.querySelectorAll(".btnPromo");

    przyciski.forEach(btn => {

        btn.addEventListener("click", () => {

            const produkt = btn.closest(".promoProdukt");

            const nazwa = produkt.dataset.nazwa;
            const cena = parseFloat(produkt.dataset.cena);
            const img = produkt.dataset.img;

            let koszyk = JSON.parse(localStorage.getItem("koszyk")) || [];

            const istnieje = koszyk.find(p => p.nazwa === nazwa);

            if (istnieje) {
                istnieje.ilosc++;
            } else {
                koszyk.push({
                    nazwa,
                    cena,
                    img,
                    ilosc: 1
                });
            }

            localStorage.setItem("koszyk", JSON.stringify(koszyk));

            alert("Dodano do koszyka");
        });

    });

});