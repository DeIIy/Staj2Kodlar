<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yusufticaret";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

$sql = "SELECT * FROM Sepet";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p>Ürün Adı: " . $row['urun_adi'] . "</p>";
        echo "<p>Değerlendirme: " . $row['degerlendirme'] . "</p>";
        echo "<p>Fiyat: " . $row['fiyat'] . "</p>";
        echo "<form method='post' action='sepet.php'>";
        echo "<input type='hidden' name='urunId' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Sil'>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "Sepetiniz boş.";
}

$conn->close();
?>
