const urunler = [
    { id: 1, ad: "Domates", fiyat: 50 },
    { id: 2, ad: "Salatalık", fiyat: 75 },
    { id: 3, ad: "Marul", fiyat: 100 },
    { id: 4, ad: "Havuç", fiyat: 125 },
    { id: 5, ad: "Patates", fiyat: 150 },
    { id: 6, ad: "Biber", fiyat: 140 },
    { id: 7, ad: "Soğan", fiyat: 130 },
    { id: 8, ad: "Kabak", fiyat: 120 },
    { id: 9, ad: "Brokoli", fiyat: 110 },
    { id: 10, ad: "Karpuz", fiyat: 100 },
    { id: 11, ad: "Portakal", fiyat: 90 },
    { id: 12, ad: "Elma", fiyat: 80 },
    { id: 13, ad: "Ananas", fiyat: 60 },
    { id: 14, ad: "Çilek", fiyat: 12 },
    { id: 15, ad: "Muz", fiyat: 24 },
    { id: 16, ad: "Patlıcan", fiyat: 36 },
    { id: 17, ad: "Üzüm", fiyat: 48 },
    { id: 18, ad: "Sarımsak", fiyat: 69 },
    { id: 19, ad: "Mango", fiyat: 56 },
    { id: 20, ad: "Greyfurt", fiyat: 31 },
];

let sepet = [];

function urunleriListele() {
    const urunlerDiv = document.querySelector(".urunler");
    urunlerDiv.innerHTML = "";

    urunler.forEach((urun) => {
        const urunKutusu = document.createElement("div");
        urunKutusu.classList.add("urun-kutusu");
        urunKutusu.innerHTML = `
            <h3>${urun.ad}</h3>
            <p>Fiyat: ${urun.fiyat} TL</p>
            <button class="ekle-button">Sepete Ekle</button>
        `;
        urunKutusu.querySelector(".ekle-button").addEventListener("click", () => {
            sepeteEkle(urun);
        });
        urunlerDiv.appendChild(urunKutusu);
    });
}

function sepeteEkle(urun) {
    sepet.push(urun);
    sepetiGuncelle();
}

function sepetiGuncelle() {
    const sepetUrunlerDiv = document.querySelector(".sepet-urunler");
    sepetUrunlerDiv.innerHTML = "";

    let toplamFiyat = 0;
    sepet.forEach((urun) => {
        const sepetUrunDiv = document.createElement("div");
        sepetUrunDiv.classList.add("sepet-urun");
        sepetUrunDiv.innerHTML = `
            <span>${urun.ad}</span>
            <span>${urun.fiyat} TL</span>
            <button class="sil-button">Sil</button>
        `;
        sepetUrunDiv.querySelector(".sil-button").addEventListener("click", () => {
            urunuSepettenCikart(urun);
        });
        sepetUrunlerDiv.appendChild(sepetUrunDiv);

        toplamFiyat += urun.fiyat;
    });

    document.getElementById("toplamFiyat").textContent = toplamFiyat + " TL";
}

function urunuSepettenCikart(urun) {
    const urunIndex = sepet.findIndex((u) => u.id === urun.id);
    if (urunIndex !== -1) {
        sepet.splice(urunIndex, 1);
        sepetiGuncelle();
    }
}

function sepetiBosalt() {
    sepet = [];
    sepetiGuncelle();
}

document.getElementById("satinalButton").addEventListener("click", () => {
    if (sepet.length > 0) {
        sepetiBosalt();
        alert("Ürünler başarıyla alındı!");
    } else {
        alert("Sepetiniz boş. Lütfen ürün ekleyin.");
    }
});

urunleriListele();
