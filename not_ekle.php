<?php
session_start();

// Oturum kontrolü
if (!isset($_SESSION['kullanici_adi'])) {
    // Giriş yapılmamış, giriş sayfasına yönlendirme
    header('Location: giris.php');
    exit();
}

// Veritabanı bağlantısı
$db = new SQLite3('veritabani.db');

// Notu ekle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kullanici_adi = $_SESSION['kullanici_adi'];
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];

    // Notu veritabanına kaydet
    $query = "
    INSERT INTO notlar (kullanici_adi, baslik, icerik)
    VALUES ('$kullanici_adi', '$baslik', '$icerik')
    ";
    $db->exec($query);

    // Not ekleme işlemi tamamlandıktan sonra index.php'ye yönlendirme
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Not Ekle</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Notlar</a>
        <a href="not_ekle.php">Yeni Not Ekle</a>
        <a href="cikis.php">Çıkış</a>
    </div>
    
    <div class="container">
        <h1>Yeni Not Ekle</h1>
        <form action="not_ekle.php" method="POST" class="note-form">
            <label for="baslik">Başlık:</label>
            <input type="text" name="baslik" required><br><br>
            <label for="icerik">İçerik:</label><br>
            <textarea name="icerik" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Not Ekle" class="btn">
        </form>
    </div>
</body>
</html>
