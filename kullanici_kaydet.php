<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan verileri al
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];

    // Veritabanı bağlantısı
    $db = new SQLite3('veritabani.db');

    // Kullanıcı tablosunu oluştur (eğer daha önce oluşturulmadıysa)
    $query = "
    CREATE TABLE IF NOT EXISTS kullanicilar (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        kullanici_adi TEXT,
        sifre TEXT
    );
    ";
    $db->exec($query);

    // Kullanıcıyı kaydet
    $sifre_hash = password_hash($sifre, PASSWORD_DEFAULT); // Şifreyi hashleme
    $query = "
    INSERT INTO kullanicilar (kullanici_adi, sifre)
    VALUES ('$kullanici_adi', '$sifre_hash')
    ";
    $db->exec($query);

    // Kullanıcı kayıt işlemi tamamlandıktan sonra index.php'ye yönlendirme
    header('Location: index.php');
    exit();
}
?>
