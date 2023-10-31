<!DOCTYPE html>
<html>
<head>
    <title>E-Ticaret Üye Kaydı ve Giriş</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="tel"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }

        .form-group button[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Üye Ol</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="ad">Ad:</label>
                <input type="text" id="ad" name="ad" required>
            </div>
            <div class="form-group">
                <label for="soyad">Soyad:</label>
                <input type="text" id="soyad" name="soyad" required>
            </div>
            <div class="form-group">
                <label for="email">E-posta:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="sehir">Şehir:</label>
                <input type="text" id="sehir" name="sehir">
            </div>
            <div class="form-group">
                <label for="telefon">Telefon Numarası:</label>
                <input type="tel" id="telefon" name="telefon">
            </div>
            <div class="form-group">
                <label for="sifre">Şifre:</label>
                <input type="password" id="sifre" name="sifre" required>
            </div>
            <div class="form-group">
                <label for="cinsiyet">Cinsiyet:</label>
                <select id="cinsiyet" name="cinsiyet" required>
                    <option value="Erkek">Erkek</option>
                    <option value="Kadın">Kadın</option>
                </select>
            </div>
            <div class="form-group">
                <label>Üyelik Sözleşmesi Kabul Ediyorum:</label>
                <input type="checkbox" name="sozlesme" required>
            </div>
            <div class="form-group">
                <label>Robot Değilim:</label>
                <input type="checkbox" name="robot" required>
            </div>
            <div class="form-group">
                <button type="submit" name="register">Üye Ol</button>
            </div>
        </form>

        <h2>Giriş Yap</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="loginEmail">E-posta:</label>
                <input type="email" id="loginEmail" name="loginEmail" required>
            </div>
            <div class="form-group">
                <label for="loginSifre">Şifre:</label>
                <input type="password" id="loginSifre" name="loginSifre" required>
            </div>
            <div class="form-group">
                <button type="submit" name="login">Giriş Yap</button>
            </div>
        </form>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "eticaret";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        if (isset($_POST["register"])) {
            $ad = $_POST["ad"];
            $soyad = $_POST["soyad"];
            $email = $_POST["email"];
            $sehir = $_POST["sehir"];
            $telefon = $_POST["telefon"];
            $sifre = password_hash($_POST["sifre"], PASSWORD_DEFAULT);
            $cinsiyet = $_POST["cinsiyet"];
            $sozlesmeKabul = isset($_POST["sozlesme"]) ? 1 : 0;
            $robotDegilim = isset($_POST["robot"]) ? 1 : 0;

            $sql = "INSERT INTO kullanici (ad, soyad, email, sehir, telefon, sifre, cinsiyet, sozlesmeKabul, robotDegilim)
                    VALUES ('$ad', '$soyad', '$email', '$sehir', '$telefon', '$sifre', '$cinsiyet', $sozlesmeKabul, $robotDegilim)";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Üye olma başarılı!</p>";
            } else {
                echo "Hata: " . $sql . "<br>" . $conn->error;
            }
        }

        if (isset($_POST["login"])) {
            $loginEmail = $_POST["loginEmail"];
            $loginSifre = $_POST["loginSifre"];

            $sql = "SELECT * FROM kullanici WHERE email='$loginEmail'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($loginSifre, $row["sifre"])) {
                    echo "<p>" . $row["ad"] . " başarıyla giriş yaptı!</p>";
                } else {
                    echo "Giriş başarısız. Lütfen bilgilerinizi kontrol edin.";
                }
            } else {
                echo "Kullanıcı bulunamadı.";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
