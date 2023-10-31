function validateForm() {
    const cardNumber = document.getElementById('cardNumber').value;
    const expirationDate = document.getElementById('expirationDate').value;
    const cvv = document.getElementById('cvv').value;
    const robotCheck = document.getElementById('robotCheck').checked;

    if (!/^\d{16}$/.test(cardNumber)) {
        alert('Geçerli bir kart numarası giriniz.');
        return false;
    }

    if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expirationDate)) {
        alert('Geçerli bir son kullanma tarihi giriniz (MM/YY).');
        return false;
    }

    if (!/^\d{3}$/.test(cvv)) {
        alert('Geçerli bir CVV/CVC giriniz.');
        return false;
    }

    if (!robotCheck) {
        alert('Lütfen "Ben Robot Değilim" kutusunu işaretleyin.');
        return false;
    }

    return true;
}

document.getElementById('robotCheck').addEventListener('change', function () {
    const purchaseButton = document.getElementById('purchaseButton');
    purchaseButton.disabled = !this.checked; // Hata düzeltilmiş burada
});
