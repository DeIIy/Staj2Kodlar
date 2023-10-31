<!DOCTYPE html>
<html>
<head>
    <title>Satıcı Girişi</title>
    <link rel="stylesheet" type="text/css" href="satici_style.css">
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

    <h1>Satıcı Girişi</h1>
    <form method="post" action="">
        <label for="kullanici_adi">Kullanıcı Adı:</label>
        <input type="text" id="kullanici_adi" name="kullanici_adi" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="sifre">Şifre:</label>
        <input type="password" id="sifre" name="sifre" required>
        <br><br>

        <button type="submit" name="giris">Giriş Yap</button>
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = $_POST["kullanici_adi"];
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "yusufticaret";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanına bağlantı hatası: " . $conn->connect_error);
    }

    $query = "SELECT id, sifre FROM satici WHERE kullanici_adi = '$kullanici_adi' AND email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["sifre"];
        
        if ($sifre === $storedPassword) {
            session_start();
            $_SESSION["kullanici_adi"] = $kullanici_adi;
            header("Location: satici_yonetim_sayfasi.php");
            exit();
        } else {
            echo "Şifrenizi yanlış girdiniz.";
        }
    } else {
        echo "Kullanıcı adı veya email hatalı.";
    }
    $conn->close();
} else {
    echo "Geçersiz istek.";
}
?>

