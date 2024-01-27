<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    // Not ID'sini al
    $not_id = $_GET['id'];

    // Formdan verileri al
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];

    // Veritabanı bağlantısı
    $db = new SQLite3('veritabani.db');

    // Notu güncelle
    $query = "
    UPDATE notlar
    SET baslik = '$baslik', icerik = '$icerik'
    WHERE id = $not_id
    ";
    $db->exec($query);

    // Ana sayfaya yönlendirme
    header('Location: index.php');
    exit();
}
?>
