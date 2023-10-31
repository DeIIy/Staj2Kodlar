document.addEventListener("DOMContentLoaded", function () {
    var adInput = document.getElementById("ad");
    var soyadInput = document.getElementById("soyad");
    var emailInput = document.getElementById("email");
    var telefonInput = document.getElementById("telefon");
    var sifreInput = document.getElementById("sifre");
    var cinsiyetSelect = document.getElementById("cinsiyet");
    var sozlesmeCheckbox = document.getElementById("sozlesme");
    var haberlerCheckbox = document.getElementById("haberler");
    var robotCheckbox = document.getElementById("robot");
    var kaydolButton = document.getElementById("kaydol");
    var emailSuffix = document.getElementById("emailSuffix"); 

    var emailSuffixValue = "@gmail.com";

    emailSuffix.textContent = emailSuffixValue;

    function kontrolEt() {
        var ad = adInput.value;
        var soyad = soyadInput.value;
        var email = emailInput.value;
        var telefon = telefonInput.value;
        var sifre = sifreInput.value;
        var cinsiyet = cinsiyetSelect.value;
        var sozlesme = sozlesmeCheckbox.checked;
        var robot = robotCheckbox.checked;

        var sifrePattern = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,16}$/;
        var telefonPattern = /^\d{11}$/;

        var sifreUygun = sifrePattern.test(sifre);
        var telefonUygun = telefonPattern.test(telefon);

        kaydolButton.disabled = !(ad && soyad && email && telefonUygun && sifreUygun && cinsiyet && sozlesme && robot);

        emailInput.addEventListener("input", function () {
            var userEmail = emailInput.value + emailSuffixValue;
            emailSuffix.textContent = userEmail;
        });
    }

    adInput.addEventListener("input", kontrolEt);
    soyadInput.addEventListener("input", kontrolEt);
    telefonInput.addEventListener("input", kontrolEt);
    sifreInput.addEventListener("input", kontrolEt);
    cinsiyetSelect.addEventListener("input", kontrolEt);
    sozlesmeCheckbox.addEventListener("change", kontrolEt);
    robotCheckbox.addEventListener("change", kontrolEt);
});
