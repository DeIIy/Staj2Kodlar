<!DOCTYPE html>
<html>
<head>
    <title>Konum Seç</title>
    <link rel="stylesheet" type="text/css" href="konum_sec_style.css">
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

    <h1>Konum Seç</h1>
    <div>
        <h2>Konum Oluştur</h2>
        <form method="post" action="">
            <label for="konumAdi">Konum İsmi:</label>
            <input type="text" id="konumAdi" name="konumAdi" required><br><br>
            
            <label for="il">İl:</label>
            <select id="il" name="il" required>
                <option value="Istanbul">İstanbul</option>
                <option value="Ankara">Ankara</option>
            </select><br><br>
            
            <label for="ilce">İlçe:</label>
            <input type="text" id="ilce" name="ilce" required><br><br>
            
            <label for="mahalle">Mahalle:</label>
            <input type="text" id="mahalle" name="mahalle" required><br><br>
            
            <button type="submit" name="kaydet">Kaydet</button>
        </form>
    </div>
    <div>
        <h2>Konumlar</h2>
        <ul>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "yusufticaret";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Veritabanına bağlantı hatası: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM konum";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>{$row['konumAdi']} - {$row['il']} - {$row['ilce']} - {$row['mahalle']} ";
                    echo "<form method='post' action='' style='display:inline;'>";
                    echo "<input type='hidden' name='konumId' value='{$row['id']}'>";
                    echo "<button type='submit' name='vazgec'>Vazgeç</button></form> ";
                    echo "<form method='post' action='' style='display:inline;'>";
                    echo "<input type='hidden' name='konumId' value='{$row['id']}'>";
                    echo "<button type='submit' name='sil'>Sil</button></form> ";
                    echo "<form method='post' action='' style='display:inline;'>";
                    echo "<input type='hidden' name='konumId' value='{$row['id']}'>";
                    echo "<button type='submit' name='kullan'>Kullan</button></form></li>";
                }
            } else {
                echo "Kaydedilen konum bulunmamaktadır.";
            }

            $conn->close();
            ?>
        </ul>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["kaydet"])) {
        $konumAdi = $_POST["konumAdi"];
        $il = $_POST["il"];
        $ilce = $_POST["ilce"];
        $mahalle = $_POST["mahalle"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "yusufticaret";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Veritabanına bağlantı hatası: " . $conn->connect_error);
        }

        $sql = "INSERT INTO konum (konumAdi, il, ilce, mahalle) VALUES ('$konumAdi', '$il', '$ilce', '$mahalle')";

        if ($conn->query($sql) === TRUE) {
            header("Location: konum_sec.php"); 
            exit();
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["vazgec"])) {
        $konumId = $_POST["konumId"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "yusufticaret";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Veritabanına bağlantı hatası: " . $conn->connect_error);
        }

        // Kullanici tablosundaki konum_id değerini sıfırlama
        $sql = "UPDATE kullanici SET konum_id = NULL WHERE konum_id = $konumId";

        if ($conn->query($sql) === TRUE) {
            header("Location: konum_sec.php"); // Sayfayı yeniden yükle
            exit();
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["kullan"])) {
        $konumId = $_POST["konumId"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "yusufticaret";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Veritabanına bağlantı hatası: " . $conn->connect_error);
        }

        $sql = "UPDATE kullanici SET konum_id = $konumId";

        if ($conn->query($sql) === TRUE) {
            header("Location: konum_sec.php"); // Sayfayı yeniden yükle
            exit();
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["sil"])) {
        $konumId = $_POST["konumId"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "yusufticaret";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Veritabanına bağlantı hatası: " . $conn->connect_error);
        }

        $sql = "DELETE FROM konum WHERE id = $konumId";

        if ($conn->query($sql) === TRUE) {
            header("Location: konum_sec.php"); 
            exit();
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>
