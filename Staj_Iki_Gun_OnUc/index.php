<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>E-Ticaret Sitesi</title>
</head>
<body>
    <div id="product-container">
    </div>
    <div id="cart">
        <h2>Sepet</h2>
        <div id="cart-items">
        </div>
        <button id="buy-button">Satın Al</button>
    </div>
    <script src="script.js"></script>
</body>
</html>

<?php
$servername = "localhost";
$username = "kullanici_adi";
$password = "parola";
$dbname = "e_ticaret";

$conn = new mysqli($servername, $username, $password, $dbname);

function addToDatabase($name, $price, $rating) {
    global $conn;
    $sql = "INSERT INTO urunler (urun_adi, fiyat, degerlendirme) VALUES ('$name', $price, $rating)";
    if ($conn->query($sql) === TRUE) {
        echo "Ürün veritabanına eklendi.";
    } else {
        echo "Hata: " . $conn->error;
    }
}

if (isset($_POST['product_name'])) {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $rating = $_POST['product_rating'];
    addToDatabase($name, $price, $rating);
}

$conn->close();
?>

