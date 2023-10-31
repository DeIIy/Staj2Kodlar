
var konumlar = [];


window.onload = function() {
    konumlarıGetir();
};

function konumKaydet() {
    var konumAdi = document.getElementById("konumAdi").value;
    var il = document.getElementById("il").value;
    var ilce = document.getElementById("ilce").value;
    var mahalle = document.getElementById("mahalle").value;


    var yeniKonum = {
        ad: konumAdi,
        il: il,
        ilce: ilce,
        mahalle: mahalle
    };


    konumlar.unshift(yeniKonum);


    konumlarıGuncelle();


    document.getElementById("konumForm").reset();
}

function konumlarıGuncelle() {
    var konumListesi = document.getElementById("konumListesi");
    konumListesi.innerHTML = "";


    konumlar.forEach(function(konum, index) {
        var listItem = document.createElement("li");
        listItem.textContent = konum.ad;
        listItem.onclick = function() {
            konumuSec(index);
        };
        konumListesi.appendChild(listItem);
    });
}

function konumuSec(index) {
    var kullanButon = document.getElementById("kullanButon");
    var vazgecButon = document.getElementById("vazgecButon");

    kullanButon.style.display = "block";
    vazgecButon.style.display = "none";

    kullanButon.onclick = function() {
        konumuKullan(index);
    };
}

function konumuKullan(index) {

    var secilenKonum = konumlar[index];
    console.log("Seçilen Konum: ", secilenKonum);

    var kullanButon = document.getElementById("kullanButon");
    var vazgecButon = document.getElementById("vazgecButon");

    kullanButon.style.display = "none";
    vazgecButon.style.display = "block";
}

function konumuSil() {

    var kullanButon = document.getElementById("kullanButon");
    var vazgecButon = document.getElementById("vazgecButon");

    kullanButon.style.display = "block";
    vazgecButon.style.display = "none";
}

function konumlarıGetir() {

}
