<!DOCTYPE html>
<html>
<head>
    <title>Siparişler</title>
    <link rel="stylesheet" type="text/css" href="siparis_style.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="index.html">Anasayfa</a></li>
            <li><a href="Hesap_Girme.php">Üye Ol/Giriş Yap</a></li>
            <li><a href="uye_bilgileri.php">Üye Bilgilerim</a></li>
            <li><a href="">Konum Seç</a></li>
            <li><a href="sepet.php">Sepetim</a></li>
            <li><a href="siparis.php">Siparişlerim</a></li>
            <li><a href="satici.php">Satıcı Girişi</a></li>
        </ul>
    </nav>

    <h1>Siparişler</h1>
    <div id="siparis-listesi">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "yusufticaret";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Veritabanına bağlantı hatası: " . $conn->connect_error);
        }

        $sql = "SELECT id, musteri, siparis_listesi, toplam_fiyat, konum, siparis_tarihi FROM siparis";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $siparisId = $row["id"];
                $musteri = $row["musteri"];
                $siparisListesi = $row["siparis_listesi"];
                $toplam_fiyat = $row["toplam_fiyat"];
                $konum = $row["konum"];
                $siparis_tarihi = $row["siparis_tarihi"];

                echo '<div class="siparis-kutusu">';
                echo '<strong>Müşteri: </strong>' . $musteri . '<br>';
                echo '<strong>Sipariş Listesi: </strong>' . $siparisListesi . '<br>';
                echo '<strong>Toplam Fiyat: </strong>' . $toplam_fiyat . '<br>';
                echo '<strong>Konum: </strong>' . $konum . '<br>';
                echo '<strong>Sipariş Tarihi: </strong>' . $siparis_tarihi . '<br>';
                echo '<button onclick="iptalEt(' . $siparisId . ')">Teslim Edildi</button>';
                echo '</div>';
            }
        } else {
            echo "Henüz sipariş bulunmuyor.";
        }

        $conn->close();
        ?>
    </div>
    <script>
        function iptalEt(siparisId) {
            var onay = confirm("Siparişin teslim edildiğini onaylıyor musunuz ?");
            if (onay) {
                window.location.href = "iptal_et.php?siparisId=" + siparisId;
            }
        }
    </script>
</body>
</html>
