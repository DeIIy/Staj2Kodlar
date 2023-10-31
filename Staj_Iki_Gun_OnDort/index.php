<!DOCTYPE html>
<html>
<head>
    <title>Ödeme Sayfası</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div>
        <img src="resim.png" alt="SSL Sertifikası">
        <p>Bu sitede SSL Sertifikası vardır.</p>
    </div>
    <div>
        <h2>Ödeme Bilgileri</h2>
        <form id="payment-form">
            <input type="text" id="fast-access-name" placeholder="Hızlı Erişim Adı">
            <input type="text" id="cardholder-name" placeholder="Kart Sahibinin Adı">
            <input type="text" id="card-number" placeholder="Kredi Kartı Numarası">
            <input type="text" id="expiry-date" placeholder="Kredi Kartının Son Kullanma Tarihi">
            <input type="text" id="cvv" placeholder="Güvenlik Kodu (CVV/CVC)">
            <button id="add-card-button">Kredi Kartı Ekle</button>
        </form>
    </div>
    <div id="card-details" style="display: none;">
        <h2>Hızlı Erişim Kartı Bilgileri</h2>
        <p><strong>Hızlı Erişim Adı:</strong> <span id="display-fast-access-name"></span></p>
        <p><strong>Kart Sahibinin Adı:</strong> <span id="display-cardholder-name"></span></p>
        <p><strong>Kredi Kartı Numarası:</strong> <span id="display-card-number"></span></p>
        <p><strong>Kredi Kartının Son Kullanma Tarihi:</strong> <span id="display-expiry-date"></span></p>
        <p><strong>Güvenlik Kodu (CVV/CVC):</strong> <span id="display-cvv"></span></p>
        <button id="quick-add-button">Hızlı Ekle</button>
    </div>

    <div id="success-message" style="display: none;">
        Kredi Kartı bilginiz seçildi.
    </div>

    <script src="script.js"></script>
</body>
</html>

<?php
$servername = "localhost"; 
$username = ""; 
$password = ""; 
$dbname = "veritabani_adi"; 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $fastAccessName = $_POST['fast_access_name'];
    $cardholderName = $_POST['cardholder_name'];
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    $sql = "INSERT INTO kredi_kartlari (hizli_erisim_adi, kart_sahibi, kart_numarasi, son_kullanma_tarihi, cvv) VALUES (:fastAccessName, :cardholderName, :cardNumber, :expiryDate, :cvv)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fastAccessName', $fastAccessName);
    $stmt->bindParam(':cardholderName', $cardholderName);
    $stmt->bindParam(':cardNumber', $cardNumber);
    $stmt->bindParam(':expiryDate', $expiryDate);
    $stmt->bindParam(':cvv', $cvv);

    $stmt->execute();

    echo "Kredi Kartı bilgileri başarıyla kaydedildi.";
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}

$conn = null;
?>


