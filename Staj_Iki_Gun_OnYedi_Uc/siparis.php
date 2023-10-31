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

    $query = "SELECT email FROM kullanici LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $email = $row["email"];

    } else {
        echo "Kullanıcı bulunamadı.";
    }

    $sql = "SELECT ad, soyad FROM uye WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $uyeAd = $row["ad"];
        $uyeSoyad = $row["soyad"];

        $siparisQuery = "SELECT id, musteri, siparis_listesi, toplam_fiyat, konum, siparis_tarihi
                        FROM siparis
                        WHERE musteri = '$uyeAd $uyeSoyad'";
        $siparisResult = $conn->query($siparisQuery);

        if ($siparisResult->num_rows > 0) {
            while ($siparisRow = $siparisResult->fetch_assoc()) {
                $siparisId = $siparisRow["id"];
                $musteri = $siparisRow["musteri"];
                $siparisListesi = $siparisRow["siparis_listesi"];
                $toplam_fiyat = $siparisRow["toplam_fiyat"];
                $konum = $siparisRow["konum"];
                $siparis_tarihi = $siparisRow["siparis_tarihi"];

                echo '<div class="siparis-kutusu">';
                echo '<strong>Müşteri: </strong>' . $musteri . '<br>';
                echo '<strong>Sipariş Listesi: </strong>' . $siparisListesi . '<br>';
                echo '<strong>Toplam Fiyat: </strong>' . $toplam_fiyat . '<br>';
                echo '<strong>Konum: </strong>' . $konum . '<br>';
                echo '<strong>Sipariş Tarihi: </strong>' . $siparis_tarihi . '<br>';
                echo '<button onclick="iptalEt(' . $siparisId . ')">Siparişi İptal Et</button>';
                echo '</div>';
            }
        } else {
            echo "Bu kullanıcının henüz siparişi bulunmuyor.";
        }
    } else {
        echo "Kullanıcı bulunamadı veya şifre hatalı.";
    }

    $conn->close();
    ?>
    </div>
    <script>
        function iptalEt(siparisId) {
            var onay = confirm("Siparişi iptal etmek istediğinizden emin misiniz?");
            if (onay) {
                window.location.href = "iptal_et.php?siparisId=" + siparisId;
            }
        }
    </script>
</body>
</html>
