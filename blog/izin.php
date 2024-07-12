<?php
include "baglanti.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Gönderileri</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #343a40;
            color: #ffffff;
            border-radius: 15px 15px 0 0;
            font-size: 24px;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #343a40;
            border: none;
            border-radius: 10px;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #23272b;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center">Blog Gönderileri</h1>
    <div class="text-right mb-3">
        <a href="post.php" class="btn btn-primary">Yeni Gönderi Ekle</a>
    </div>
    <div class="card">
        <div class="card-body">
            <?php
            $sorgu = "SELECT * FROM blog ORDER BY id DESC";
            $sonuc = $baglanti->query($sorgu);

            if ($sonuc->num_rows > 0) {
                echo '<table class="table table-bordered">';
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Ad-Soyad</th>';
                echo '<th>Konusu</th>';
                echo '<th>Yazan</th>';
                echo '<th>İşlemler</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($satir = $sonuc->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $satir["id"] . '</td>';
                    echo '<td>' . $satir["adsoyad"] . '</td>';
                    echo '<td>' . $satir["konusu"] . '</td>';
                    echo '<td>' . $satir["yazan"] . '</td>';
                    echo '<td>';
                    echo '<a href="edit.php?id=' . $satir["id"] . '" class="btn btn-warning btn-sm">Düzenle</a> ';
                    echo '<a href="delete.php?id=' . $satir["id"] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Bu gönderiyi silmek istediğinizden emin misiniz?\')">Sil</a>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="alert alert-info">Hiç blog gönderisi bulunamadı.</div>';
            }

            $baglanti->close();
            ?>
        </div>
    </div>
</div>

</body>
</html>
