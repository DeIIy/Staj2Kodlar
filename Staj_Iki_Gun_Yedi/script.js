// ! Başlık ve metin elementlerini seçme
var baslikElementi = document.getElementById("baslik");
var metinElementi = document.getElementById("metin");
var degistirButton = document.getElementById("degistirButton");

// ? Başlık rengini değiştirme
baslikElementi.style.color = "red";

// * Metni değiştirmek için bir işlev tanımlama
function metniDegistir() {
    metinElementi.textContent = "Efe Emir Etlik";
}

// TODO: Butona tıklama olayını dinlemek ve metni değiştirmek
degistirButton.addEventListener("click", metniDegistir);
