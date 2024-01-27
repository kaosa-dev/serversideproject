<?php
if (isset($_GET['id'])) {
    // Not ID'sini al
    $not_id = $_GET['id'];

    // Veritabanı bağlantısı
    $db = new SQLite3('veritabani.db');

    // Notu sil
    $query = "DELETE FROM notlar WHERE id = $not_id";
    $db->exec($query);

    // Ana sayfaya yönlendirme
    header('Location: index.php');
    exit();
}
?>
