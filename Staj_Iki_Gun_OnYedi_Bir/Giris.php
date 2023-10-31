<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
    <link rel="stylesheet" type="text/css" href="giris_style.css">
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

    <h1>Giriş Yap</h1>
    <form method="post" action="">
        <label for="email">E-Posta:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="sifre">Şifre:</label>
        <input type="password" id="sifre" name="sifre" required><br><br>

        <button type="submit" name="giris">Giriş Yap</button>
    </form>
</body>
</html>

<?php
// Veritabanı bağlantısı oluştur
$servername = "localhost"; // Veritabanı sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifre
$dbname = "yusufticaret"; // Veritabanı adı

$conn = new mysqli($servername, $username, $password, $dbname);

// Veritabanı bağlantı hatasını kontrol et
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

if (isset($_POST["giris"])) {
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];

    // E-postayı kullanarak veritabanından şifreyi getir
    $sql = "SELECT sifre FROM uye WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hash = $row["sifre"];
        
        // Girilen şifreyi hash ile karşılaştır
        if (password_verify($sifre, $hash)) {
            // Giriş başarılı, oturum başlat
            session_start();
            $_SESSION["email"] = $email;
            $hashedPassword = password_hash($sifre, PASSWORD_DEFAULT);

            // Kullanici tablosundaki verileri sil
            $truncateSql = "TRUNCATE TABLE kullanici";
            if ($conn->query($truncateSql) === TRUE) {
                // Kullanici tablosu temizlendikten sonra yeni kullanıcı verilerini ekle
                $insertSql = "INSERT INTO kullanici (email, sifre) VALUES ('$email', '$hashedPassword')";
                if ($conn->query($insertSql) === TRUE) {
                    // Kullanıcı başarıyla eklenmişse
                    echo "Kullanıcı başarıyla oluşturuldu. Şimdi giriş yapabilirsiniz.";
                } else {
                    // Eğer ekleme başarısız olursa hata mesajı göster
                    echo "Kullanıcı eklenirken hata oluştu: " . $conn->error;
                }
            } else {
                // Eğer temizleme başarısız olursa hata mesajı göster
                echo "Kullanici tablosu temizlenirken hata oluştu: " . $conn->error;
            }
            header("Location: uye_bilgileri.php"); // Başarılı giriş durumunda yönlendirilecek sayfa
            exit();
        } else {
            // Şifre yanlışsa hata mesajı göster
            echo "Şifrenizi yanlış girdiniz.";
        }
    } else {
        // E-posta yanlışsa hata mesajı göster
        echo "E-postanızı yanlış girdiniz.";
    }
}

$conn->close();
?>


