<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ol</title>
    <style>
        body {
            background: rgb(238,214,102);
background: linear-gradient(90deg, rgba(238,214,102,1) 0%, rgba(219,214,188,1) 0%, rgba(253,246,214,1) 100%);            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fdf6d6;
            padding: 20px;
            border: 1px solid #c8bfb4;
            border-radius: 5px;
            text-align: center;
            width: 300px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            margin-bottom: 10px;
        }

        label {
            color: #333;
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #fdf6d6;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #555;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }

        p {
            color: #333;
            text-align: center;
            margin-top: 10px;
        }

        a {
            color: #333;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kayıt Ol</h1>
        <form action="kullanici_kaydet.php" method="POST">
            <label for="kullanici_adi">Kullanıcı Adı:</label>
            <input type="text" name="kullanici_adi" required><br><br>
            <label for="sifre">Şifre:</label>
            <input type="password" name="sifre" required><br><br>
            <input type="submit" value="Kayıt Ol">
        </form>
        <?php
            // Hata mesajını göster
            if (isset($_GET['error'])) {
                echo '<p class="error">' . $_GET['error'] . '</p>';
            }
        ?>
    </div>
</body>
</html>
