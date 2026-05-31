document.addEventListener("DOMContentLoaded", () => {

    const lista = document.querySelector(".listaProduktow");
    const koszt = document.getElementById("kosztCalkowity");
    let koszyk = JSON.parse(localStorage.getItem("koszyk")) || [];

    function odswiezKoszyk() {

        lista.innerHTML = "";
        let suma = 0;

        koszyk.forEach((produkt, index) => {

            suma += produkt.cena * produkt.ilosc;

            lista.innerHTML += `
            
            <div class="pojedynczyProdukt d-flex flex-column flex-md-row align-items-center justify-content-between">

                <div class="produktInfo d-flex flex-column flex-md-row align-items-center">
                    <img src="${produkt.img}" class="imgProdukt">

                    <div class="produktOpis text-center text-md-start">
                        <span class="nazwa">${produkt.nazwa}</span>
                    </div>
                </div>

                <div class="cena my-2 my-md-0">
                    ${(produkt.cena * produkt.ilosc).toFixed(2)} zł
                </div>

                <div class="akcje d-flex flex-row flex-md-column align-items-center align-items-md-end gap-3 gap-md-1">

                    <div class="ilosc">

                        ilość: ${produkt.ilosc}

                        <button class="plus btn btn-success btn-sm"
                                data-index="${index}">
                            +
                        </button>

                        <button class="minus btn btn-warning btn-sm"
                                data-index="${index}">
                            -
                        </button>

                    </div>

                    <button class="btnUsun btn btn-danger"
                            data-index="${index}">
                        usuń z koszyka
                    </button>

                </div>

            </div>
            `;
        });
        koszt.innerHTML =
            `Koszt zamówienia: ${suma.toFixed(2)} zł`;
        localStorage.setItem("koszyk", JSON.stringify(koszyk));
        dodajEventy();
    }

    function dodajEventy() {

        document.querySelectorAll(".plus").forEach(btn => {

            btn.onclick = () => {

                koszyk[btn.dataset.index].ilosc++;
                odswiezKoszyk();
            };
        });

        document.querySelectorAll(".minus").forEach(btn => {

            btn.onclick = () => {

                let i = btn.dataset.index;

                if (koszyk[i].ilosc > 1) {
                    koszyk[i].ilosc--;
                } else {
                    koszyk.splice(i, 1);
                }

                odswiezKoszyk();
            };
        });

        document.querySelectorAll(".btnUsun").forEach(btn => {

            btn.onclick = () => {

                koszyk.splice(btn.dataset.index, 1);
                odswiezKoszyk();
            };
        });
    }
    odswiezKoszyk();

});