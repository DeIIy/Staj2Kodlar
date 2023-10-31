document.addEventListener("DOMContentLoaded", function() {

    const ekleButonlari = document.querySelectorAll(".sepete-ekle");

    ekleButonlari.forEach((buton) => {
        buton.addEventListener("click", () => {
            sepeteEkle(buton);
        });
    });

    function sepeteEkle(buton) {
        const urunAdi = buton.getAttribute("data-urun-adi");
        const degerlendirme = parseFloat(buton.getAttribute("data-degerlendirme"));
        const fiyat = parseFloat(buton.getAttribute("data-fiyat"));

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "sepete_ekle.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                sonucMesaji(xhr.responseText);
            }
        };
        xhr.send(`urun_adi=${urunAdi}&degerlendirme=${degerlendirme}&fiyat=${fiyat}`);
    }

    function sonucMesaji(mesaj) {
        const sonucMesajiDiv = document.querySelector(".sonuc-mesaji");
        sonucMesajiDiv.textContent = mesaj;
    }
});
