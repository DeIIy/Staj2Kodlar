<!DOCTYPE html>
<html>
<head>
    <title>Üye Kayıt Formu</title>
    <link rel="stylesheet" type="text/css" href="Hesap_Girme_style.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="index.html">Anasayfa</a></li>
            <li><a href="">Üye Ol/Giriş Yap</a></li>
            <li><a href="">Üye Bilgilerim</a></li>
            <li><a href="konum_sec.php">Konum Seç</a></li>
            <li><a href="sepet.php">Sepetim</a></li>
            <li><a href="siparis.php">Siparişlerim</a></li>
            <li><a href="satici.php">Satıcı Girişi</a></li>
        </ul>
    </nav>

    <h1>Üye Ol</h1>
    <form id="uyeForm" action="" method="post">
        <label for="ad">Adınız:</label>
        <input type="text" id="ad" name="ad" required><br><br>
        
        <label for="soyad">Soyadınız:</label>
        <input type="text" id="soyad" name="soyad" required><br><br>
        
        <label for="email">E-Posta Adresiniz:</label>
        <input type="text" id="email" name="email" value="" required>
        <span id="emailSuffix">@gmail.com</span><br><br>

        
        <label for="telefon">Telefon Numaranız:</label>
        <input type="text" id="telefon" name="telefon" pattern="\d{11}" placeholder="Örn: 05464663373" required><br><br>
        
        <label for="sifre">Şifreniz (En az 8 karakter, büyük harf ve rakam içermeli):</label>
        <input type="password" id="sifre" name="sifre" pattern="^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,16}$" required><br><br>
        
        <label for="cinsiyet">Cinsiyetiniz:</label>
        <select id="cinsiyet" name="cinsiyet" required>
            <option value="" disabled selected>Lütfen seçin</option>
            <option value="Erkek">Erkek</option>
            <option value="Kadın">Kadın</option>
        </select><br><br>
        
        <input type="checkbox" id="sozlesme" name="sozlesme" required>
        <label for="sozlesme">Üyelik Sözleşmesi şartlarını okudum ve kabul ediyorum.</label><br><br>
        
        <input type="checkbox" id="haberler" name="haberler">
        <label for="haberler">Bu sitenin bana sunduğu kampanya ve fırsatlardan haberdar olmak istiyorum.</label><br><br>
        
        <input type="checkbox" id="robot" name="robot" required>
        <label for="robot">Ben Robot değilim işaretleme</label><br><br>
        
        <button type="submit" id="kaydol" disabled>Kaydol</button>
    </form>
    
    <p>Zaten kayıtlı mısın? <a href="Giris.php">Giriş yap</a></p>

    <script src="Hesap_Girme_script.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];
    $sifre = $_POST["sifre"];
    $cinsiyet = $_POST["cinsiyet"];
    $haberler = isset($_POST["haberler"]) ? 1 : 0;

    $email .= "@gmail.com";

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "yusufticaret";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $hashed_sifre = password_hash($sifre, PASSWORD_DEFAULT);

    $sql = "INSERT INTO uye (ad, soyad, email, telefon, sifre, cinsiyet, haberler) VALUES ('$ad', '$soyad', '$email', '$telefon', '$hashed_sifre', '$cinsiyet', $haberler)";

    if ($conn->query($sql) === TRUE) {
        echo "Üye kaydı başarıyla oluşturuldu.";
    } else {
        echo "Hata: " . $conn->error;
    }

    $conn->close();
}
?>

