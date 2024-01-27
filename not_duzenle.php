<?php
// Not ID'sini al
if (isset($_GET['id'])) {
    $not_id = $_GET['id'];

    // Veritabanı bağlantısı
    $db = new SQLite3('veritabani.db');

    // Notu getir
    $query = "SELECT * FROM notlar WHERE id = $not_id";
    $result = $db->query($query);
    $note = $result->fetchArray(SQLITE3_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notu Düzenle</title>
</head>
<body>
    <h1>Notu Düzenle</h1>
    <?php if (isset($note)): ?>
        <form action="not_guncelle.php?id=<?php echo $note['id']; ?>" method="POST">
            <label for="baslik">Başlık:</label>
            <input type="text" name="baslik" value="<?php echo $note['baslik']; ?>" required><br><br>
            <label for="icerik">İçerik:</label><br>
            <textarea name="icerik" rows="4" cols="50" required><?php echo $note['icerik']; ?></textarea><br><br>
            <input type="submit" value="Notu Güncelle">
        </form>
    <?php else: ?>
        <p>Not bulunamadı.</p>
    <?php endif; ?>
</body>
</html>
