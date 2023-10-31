document.addEventListener("DOMContentLoaded", function () {
    const paymentForm = document.getElementById("payment-form");
    const addCardButton = document.getElementById("add-card-button");
    const quickAddButton = document.getElementById("quick-add-button");
    const cardDetailsDiv = document.getElementById("card-details");
    const successMessageDiv = document.getElementById("success-message");

    addCardButton.addEventListener("click", function (e) {
        e.preventDefault();
        const fastAccessName = document.getElementById("fast-access-name").value;
        const cardholderName = document.getElementById("cardholder-name").value;
        const cardNumber = document.getElementById("card-number").value;
        const expiryDate = document.getElementById("expiry-date").value;
        const cvv = document.getElementById("cvv").value;

        document.getElementById("display-fast-access-name").textContent = fastAccessName;
        document.getElementById("display-cardholder-name").textContent = cardholderName;
        document.getElementById("display-card-number").textContent = cardNumber;
        document.getElementById("display-expiry-date").textContent = expiryDate;
        document.getElementById("display-cvv").textContent = cvv;

        cardDetailsDiv.style.display = "block";
        successMessageDiv.style.display = "none";
    });

    quickAddButton.addEventListener("click", function () {
        successMessageDiv.style.display = "block";
    });
});
