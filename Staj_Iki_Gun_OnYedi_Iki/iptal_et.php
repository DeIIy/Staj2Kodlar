<?php
if (isset($_GET["siparisId"])) {
    $siparisId = $_GET["siparisId"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "yusufticaret";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanına bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "DELETE FROM siparis WHERE id = $siparisId";

    if ($conn->query($sql) === TRUE) {
        header("Location: siparis.php"); 
    } else {
        echo "Sipariş iptal edilirken hata oluştu: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Sipariş ID'si eksik.";
}
?>