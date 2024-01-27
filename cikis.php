<?php
session_start();

// Oturumu sonlandır
session_unset();
session_destroy();

// Giriş sayfasına yönlendirme
header('Location: giris.php');
exit();
?>
<head>
    <title>Not Defteri</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navbar">
    <a href="giris.php">Giriş</a>
    <a href="kayit.php">Kayıt Ol!</a>
    </div>
    </div>
</body>
</html>