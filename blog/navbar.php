<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Sayfanız</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand {
            font-size: 1.5rem; 
            font-weight: bold;
        }
        .nav-link {
            color: white;
            font-size: 1.1rem; 
            font-weight: bold; 
            text-transform: uppercase; 
            margin-right: 20px;
        }
        .nav-link:hover {
            color: #ffc107;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#!">Blog Sayfanız</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Anasayfa</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">Hakkında</a></li>
                <li class="nav-item"><a class="nav-link" href="post.php">Yazı Ekle</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">İletişim</a></li>
                <li class="nav-item"><a class="nav-link" href="yazilar.php">Bloglar</a></li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION["giris_bilgisi"]) && $_SESSION["giris_bilgisi"] === true): ?>
                    <li class="nav-item">
                    <a class="nav-link" href="yazilarim.php">Yazılarım</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (!isset($_SESSION["giris_bilgisi"]) || $_SESSION["giris_bilgisi"] !== True) { ?>
                    <li class="nav-item"><a class="nav-link" href="girisYap.php">Giriş Yap</a></li>
                    <li class="nav-item"><a class="nav-link" href="kayitOl.php">Kayıt Ol</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="cikis.php"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a></li>
                <?php } ?>
            </ul>


        </div>
    </div>
</nav>

</body>
</html>
