<!DOCTYPE html>
<html>
<head>
    <title>Alışveriş Sepeti</title>
    <link rel="stylesheet" type="text/css" href="sepet_style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html">Anasayfa</a></li>
            <li><a href="Hesap_Girme.php">Üye Ol/Giriş Yap</a></li>
            <li><a href="uye_bilgileri.php">Üye Bilgilerim</a></li>
            <li><a href="konum_sec.php">Konum Seç</a></li>
            <li><a href="">Sepetim</a></li>
            <li><a href="siparis.php">Siparişlerim</a></li>
            <li><a href="satici.php">Satıcı Girişi</a></li>
        </ul>
    </nav>

    <h1>Alışveriş Sepeti</h1>
    <div id="sepet">
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
                echo "<input type='submit' name='sil' value='Sil'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "Sepetiniz boş.";
        }

        if (isset($_POST['sil'])) {
            $urunId = $_POST['urunId'];
            $sql = "DELETE FROM Sepet WHERE id = $urunId";
            if ($conn->query($sql) === TRUE) {
                header("Location: sepet.php");
                exit();
            } else {
                echo "Hata: Ürünü silme işlemi başarısız oldu. " . $conn->error;
            }
        }

        $conn->close();
        ?>
    </div>
    <p id="toplamFiyat">Toplam: <?php include('toplam_fiyat_getir.php'); ?> TL</p>
    <a href="satin_alma_sayfasi.php">Satın Al</a>
</body>
</html>
