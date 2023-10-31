document.addEventListener("DOMContentLoaded", function () {
    var odemeForm = document.getElementById("odemeForm");
    var hataMesaji = document.getElementById("hataMesaji");
    var onayMesaji = document.getElementById("onayMesaji");

    odemeForm.addEventListener("submit", function (e) {
        e.preventDefault();

        var kartSahibiAdi = document.getElementById("kartSahibiAdi").value;
        var kartNumarasi = document.getElementById("kartNumarasi").value;
        var sonKullanmaTarihi = document.getElementById("sonKullanmaTarihi").value;
        var guvenlikKodu = document.getElementById("guvenlikKodu").value;
        var taksitSecenekleri = document.getElementById("taksitSecenekleri").value;

        if (kartNumarasi.length !== 16) {
            hataMesaji.textContent = "Kredi kartı numarası 16 haneli olmalıdır.";
            return;
        }

        if (taksitSecenekleri === "yok") {
            hataMesaji.textContent = "Lütfen taksit seçeneğini seçin.";
            return;
        }

        onayMesaji.textContent = "İşleminiz başarılı. Bilgileriniz kaydedildi.";
    });
});
