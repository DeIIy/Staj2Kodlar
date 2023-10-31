<!DOCTYPE html>
<html>
<head>
    <title>E-Ticaret Ürün Ekleme</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Ürün Ekle</h1>
    <form method="post" action="urun_ekle.php" enctype="multipart/form-data">
        <div>
            <label>Kategori Seçin:</label>
            <select name="kategori">
                <option value="Araba">Araba</option>
                <option value="Ev Eşyası">Ev Eşyası</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Giyim">Giyim</option>
                <option value="Spor">Spor</option>
            </select>
        </div>
        <div>
            <label>İlan Başlığı:</label>
            <input type="text" name="ilan_basligi">
        </div>
        <div>
            <label>Açıklama:</label>
            <textarea name="aciklama"></textarea>
        </div>
        <div>
            <label>Fiyat Belirleme:</label>
            <input type="text" name="fiyat">
            <select name="para_birimi">
                <option value="Dolar">$</option>
                <option value="Euro">€</option>
                <option value="TL">₺</option>
                <option value="Rus Rublesi">₽</option>
            </select>
        </div>
        <div>
            <label>Fotoğraflar (Maksimum 4 Adet):</label>
            <input type="file" name="foto_1">
            <input type="file" name="foto_2">
            <input type="file" name="foto_3">
            <input type="file" name="foto_4">
        </div>
        <div>
            <label>İliniz:</label>
            <input type="text" name="il">
        </div>
        <div>
            <label>Adınız:</label>
            <input type="text" name="ad">
        </div>
        <div>
            <label>Soyadınız:</label>
            <input type="text" name="soyad">
        </div>
        <div>
            <label>Telefon Numaranız:</label>
            <input type="text" name="telefon">
        </div>
        <div>
            <input type="submit" name="urun_ekle" value="Ürünü Satışa Koy">
        </div>
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['urun_ekle'])) {
    $servername = "localhost";
    $username = "kullanici_adi";
    $password = "parola";
    $dbname = "site";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    $kategori = $_POST['kategori'];
    $ilan_basligi = $_POST['ilan_basligi'];
    $aciklama = $_POST['aciklama'];
    $fiyat = $_POST['fiyat'];
    $para_birimi = $_POST['para_birimi'];
    $il = $_POST['il'];
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $telefon = $_POST['telefon'];


    $sql = "INSERT INTO urun_bilgilendirme (kategori, ilan_basligi, aciklama, fiyat, para_birimi, il, foto_1, foto_2, foto_3, foto_4)
            VALUES ('$kategori', '$ilan_basligi', '$aciklama', '$fiyat', '$para_birimi', '$il', '$foto_1', '$foto_2', '$foto_3', '$foto_4')";

    if ($conn->query($sql) === TRUE) {
        echo "Ürününüz başarılı bir şekilde satışa koyuldu.";
    } else {
        echo "Hata oluştu: " . $sql . "<br>" . $conn->error;
    }

    $sql2 = "INSERT INTO satici_bilgilendirme (ad, soyad, telefon)
            VALUES ('$ad', '$soyad', '$telefon')";

    if ($conn->query($sql2) === TRUE) {
    } else {
        echo "Hata oluştu: " . $sql2 . "<br>" . $conn->error;
    }

    $conn->close();
}

?>


