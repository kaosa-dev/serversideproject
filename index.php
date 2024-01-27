<?php
session_start();

// Oturum kontrolü
if (!isset($_SESSION['kullanici_adi'])) {
    // Giriş yapılmamış, giriş sayfasına yönlendirme
    header('Location: giris.php');
    exit();
}

// Veritabanı bağlantısı ve tablo oluşturma
$db = new SQLite3('veritabani.db');

$query = "
CREATE TABLE IF NOT EXISTS notlar (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    kullanici_adi TEXT,
    baslik TEXT,
    icerik TEXT,
    tarih TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_adi) REFERENCES kullanicilar(kullanici_adi)
);
";
$db->exec($query);

// Not silme işlemi
if (isset($_GET['sil'])) {
    $not_id = $_GET['sil'];
    
    // Notu sil
    $query = "DELETE FROM notlar WHERE id = $not_id AND kullanici_adi = '{$_SESSION['kullanici_adi']}'";
    $db->exec($query);
    
    // Sayfayı yeniden yükle
    header('Location: index.php');
    exit();
}

// Notları getir
$query = "SELECT * FROM notlar WHERE kullanici_adi = '{$_SESSION['kullanici_adi']}' ORDER BY tarih DESC";
$result = $db->query($query);

// Notları liste olarak görüntüle
//while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
  //  echo "<h2>{$row['baslik']}</h2>";
   // echo "<p>{$row['icerik']}</p>";
   // echo "<p>Tarih: {$row['tarih']}</p>";
    
    // Düzenleme bağlantısı
   // echo "<a href='not_duzenle.php?id={$row['id']}' class='btn'>Düzenle</a>";
    
    // Silme bağlantısı
   // echo "<a href='index.php?sil={$row['id']}'>Sil</a>";
  //  echo "<br><br>";
//}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Not Defteri</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Notlar</a>
        <a href="not_ekle.php">Yeni Not Ekle</a>
        <a href="cikis.php">Çıkış</a>
    </div>
    
    <div class="container">
        <h1>Notlar</h1>
        <?php
        // Veritabanı bağlantısı
        $db = new SQLite3('veritabani.db');

        // Notları getir
        $query = "SELECT * FROM notlar WHERE kullanici_adi = '{$_SESSION['kullanici_adi']}' ORDER BY tarih DESC";
        $result = $db->query($query);

        // Notları liste olarak görüntüle
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<div class='note'>";
            echo "<h2>{$row['baslik']}</h2>";
            echo "<p>{$row['icerik']}</p>";
            echo "<p class='date'>Tarih: {$row['tarih']}</p>";
            echo "<a href='not_duzenle.php?id={$row['id']}' class='btn'>Düzenle</a>";
            echo "<a href='not_sil.php?id={$row['id']}' class='btn'>Sil</a>";
            echo "</div>";
        }
        ?>

        <h2>Yeni Not Ekle</h2>
        <form action="not_ekle.php" method="POST">
            <label for="baslik">Başlık:</label>
            <input type="text" name="baslik" required><br><br>
            <label for="icerik">İçerik:</label><br>
            <textarea name="icerik" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Not Ekle" class="btn">
        </form>
    </div>
</body>
</html>
