<?php
include "baglanti.php";
include "navbar.php";

// Veritabanından tüm blog kayıtlarını seçme sorgusu
$sorgu = "SELECT * FROM `blog`";
$sonuc = mysqli_query($baglanti, $sorgu);

?>

<main>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<button class="btn btn-outline-primary m-2" onclick="history.back()">Geri Dön</button>
<hr class="bg-primary">

<div class="container">
    <h2 class="text-center m-4">Blog Kayıtları</h2>
    <?php
    // Blog kayıtlarını liste şeklinde gösterme
    if (mysqli_num_rows($sonuc) > 0) {
        while($blog = mysqli_fetch_assoc($sonuc)) {
            echo '<div class="card mb-3">';
            echo '<div class="card-header">' . $blog['konusu'] . '</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $blog['adsoyad'] . '</h5>';
            echo '<p class="card-text">' . $blog['yazı'] . '</p>';
            echo '<p class="card-text"><small class="text-muted">Yazan: ' . $blog['yazan'] . '</small></p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-center">Henüz blog kaydı bulunmamaktadır.</p>';
    }
    ?>
</div>
</main>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yazılar</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome icons -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="navbar.css">
    <style>
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-weight: bold;
        }
        .card-text {
            color: #666;
        }
        .post-meta {
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
       
            <?php
            // Buraya yazıları listeleme kodu gelecek
            ?>

            <!-- Diğer yazılar buraya gelir -->
        </div>
    </div>
</div>

<!-- Bootstrap JS, Popper.js ve jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

</body>
</html>
