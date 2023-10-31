<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yusufticaret";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

$sql = "SELECT SUM(fiyat) as toplam FROM Sepet";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['toplam'];
} else {
    echo "0";
}

$conn->close();
?>
