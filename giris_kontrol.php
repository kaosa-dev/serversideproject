<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan verileri al
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];

    // Veritabanı bağlantısı
    $db = new SQLite3('veritabani.db');

    // Kullanıcıyı bul
    $query = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$kullanici_adi'";
    $result = $db->query($query);
    $user = $result->fetchArray(SQLITE3_ASSOC);

    // Şifreyi kontrol et
    if ($user && password_verify($sifre, $user['sifre'])) {
        // Giriş başarılı, oturumu başlat
        session_start();
        $_SESSION['kullanici_adi'] = $kullanici_adi;

        // Ana sayfaya yönlendirme
        header('Location: index.php');
        exit();
    } else {
        // Giriş başarısız mesajı
        echo "Kullanıcı adı veya şifre hatalı!";
    }
}
?>
