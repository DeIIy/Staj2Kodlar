<?php

session_start();

if (!isset($_SESSION["email"])) {
    header("Location: Hesap_Girme.php");
    exit();
}

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "yusufticaret"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

$email = $_SESSION["email"];

if (isset($_POST["cikis"])) {
    $deleteSql = "DELETE FROM kullanici WHERE email = '$email'";
    if ($conn->query($deleteSql) === TRUE) {
        unset($_SESSION["email"]);
        session_destroy();
        header("Location: Hesap_Girme.php");
        exit();
    } else {
        echo "Çıkış yapılırken hata oluştu: " . $conn->error;
    }
}

$selectSql = "SELECT * FROM uye WHERE email = '$email'";
$result = $conn->query($selectSql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $ad = $row["ad"];
    $soyad = $row["soyad"];
    $telefon = $row["telefon"];
    $cinsiyet = $row["cinsiyet"];
    $haberler = $row["haberler"];
    $tarih = $row["tarih"];
} else {
    echo "Böyle bir kullanıcı kaydı bulunamadı.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Üye Bilgileri</title>
    <link rel="stylesheet" type="text/css" href="uye_bilgileri_style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html">Anasayfa</a></li>
            <li><a href="Hesap_Girme.php">Üye Ol/Giriş Yap</a></li>
            <li><a href="uye_bilgileri.php">Üye Bilgilerim</a></li>
            <li><a href="konum_sec.php">Konum Seç</a></li>
            <li><a href="sepet.php">Sepetim</a></li>
            <li><a href="siparis.php">Siparişlerim</a></li>
            <li><a href="satici.php">Satıcı Girişi</a></li>
        </ul>
    </nav>
    <h1>Üye Bilgileri</h1>
    <div>
        <h3>Ad: <?php echo $ad; ?></h3>
        <h3>Soyad: <?php echo $soyad; ?></h3>
        <h3>E-Posta: <?php echo $email; ?></h3>
        <h3>Telefon: <?php echo $telefon; ?></h3>
        <h3>Cinsiyet: <?php echo $cinsiyet; ?></h3>
        <h3>Haberler: <?php echo $haberler ? 'Evet' : 'Hayır'; ?></h3>
        <h3>Tarih: <?php echo $tarih; ?></h3>
    </div>
    <form method="post">
        <button type="submit" name="cikis">Çıkış Yap</button>
    </form>
</body>
</html>

