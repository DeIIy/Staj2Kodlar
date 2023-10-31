<!DOCTYPE html>
<html>
<head>
    <title>Kredi Kartı Bilgileri</title>
    <link rel="stylesheet" type="text/css" href="satin_alma_sayfasi_style.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="">Anasayfa</a></li>
            <li><a href="Hesap_Girme.php">Üye Ol/Giriş Yap</a></li>
            <li><a href="uye_bilgileri.php">Üye Bilgilerim</a></li>
            <li><a href="konum_sec.php">Konum Seç</a></li>
            <li><a href="sepet.php">Sepetim</a></li>
            <li><a href="siparis.php">Siparişlerim</a></li>
            <li><a href="satici.php">Satıcı Girişi</a></li>
        </ul>
    </nav>

    <h2>Kredi Kartı Bilgilerini Gir</h2>
    <div id="sslNotification">Bu sitede SSL Sertifikası vardır.</div>
    <form id="paymentForm" method="post" action="" onsubmit="return validateForm()">
        <label for="cardNumber">Kredi Kartı Numarası:</label>
        <input type="text" id="cardNumber" name="cardNumber" maxlength="16" required pattern="\d{16}">
        <br>

        <label for="expirationDate">Son Kullanma Tarihi (MM/YY):</label>
        <input type="text" id="expirationDate" name="expirationDate" required pattern="(0[1-9]|1[0-2])/\d{2}">
        <br>

        <label for="cvv">CVV/CVC:</label>
        <input type="text" id="cvv" name="cvv" maxlength="3" required pattern="\d{3}">
        <br>

        <label for="installments">Taksit:</label>
        <select id="installments" name="installments">
            <option value="0">Yok</option>
            <option value="6">6 Ay</option>
            <option value="12">12 Ay</option>
            <option value="24">24 Ay</option>
        </select>
        <br>

        <input type="checkbox" id="robotCheck" name="robotCheck">
        <label for="robotCheck">Ben Robot Değilim</label>
        <br>

        <button type="submit" id="purchaseButton" disabled>Satın Al</button>
    </form>
    <script src="satin_alma_sayfasi_script.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardNumber = $_POST["cardNumber"];
    $expirationDate = $_POST["expirationDate"];
    $cvv = $_POST["cvv"];
    $installments = $_POST["installments"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "yusufticaret";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanına bağlantı hatası: " . $conn->connect_error);
    }

    $kullaniciQuery = "SELECT konum_id FROM kullanici LIMIT 1";
    $kullaniciResult = $conn->query($kullaniciQuery);

    if ($kullaniciResult->num_rows > 0) {
        $kullaniciRow = $kullaniciResult->fetch_assoc();
        $konumId = $kullaniciRow["konum_id"];
        $email = $kullaniciRow["email"];

        $konumQuery = "SELECT il, ilce, mahalle FROM konum WHERE id = $konumId";
        $konumResult = $conn->query($konumQuery);

        if ($konumResult->num_rows > 0) {
            $konumRow = $konumResult->fetch_assoc();
            $konum = $konumRow["il"] . "/" . $konumRow["ilce"] . "/" . $konumRow["mahalle"];
        } else {
            echo "Konum bilgileri alınamadı.";
            exit();
        }
    } else {
        echo "Kullanıcı bilgileri alınamadı.";
        exit();
    }

    $userQuery = "SELECT id, ad, soyad FROM uye WHERE email = $email";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $userId = $userRow["id"];
        $userName = $userRow["ad"] . " " . $userRow["soyad"];
    } else {
        echo "Kullanıcı bilgileri alınamadı.";
        exit();
    }


    $productList = ""; 
    $totalPrice = 0;

    $productQuery = "SELECT urun_adi, fiyat FROM Sepet";
    $productResult = $conn->query($productQuery);

    if ($productResult->num_rows > 0) {
        while ($productRow = $productResult->fetch_assoc()) {
            $productList .= $productRow["urun_adi"] . ", ";
            $totalPrice += $productRow["fiyat"];
        }
    }

    $productList = rtrim($productList, ", "); 

    $insertQuery = "INSERT INTO siparis (musteri, siparis_listesi, toplam_fiyat, konum) VALUES ('$userName', '$productList', $totalPrice, '$konum')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Sipariş başarıyla oluşturuldu.";
    } else {
        echo "Sipariş oluşturulurken hata oluştu: " . $conn->error;
    }

    $deleteQuery = "TRUNCATE TABLE Sepet";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "Sepet temizlendi.";
    } else {
        echo "Sepet temizlenirken hata oluştu: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Geçersiz istek.";
}
?>
