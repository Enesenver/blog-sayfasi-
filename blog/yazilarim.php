<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["giris_bilgisi"]) || $_SESSION["giris_bilgisi"] !== true) {
    header("location: girisYap.php"); // Giriş sayfasına yönlendir
    exit;
}

include_once "baglanti.php";

$kullanici_id = $_SESSION["id_bilgisi"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blog Yazılarım</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Yazılarım</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ad Soyad</th>
                    <th>Konu</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT id, adsoyad, konusu, yazı, yazan, yayınlamatarihi FROM blog WHERE yazan_id = ?";
                if ($stmt = mysqli_prepare($baglanti, $query)) {
                    mysqli_stmt_bind_param($stmt, "i", $kullanici_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row["adsoyad"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["konusu"]) . "</td>";
                            echo "<td>";
                            echo "<a href='duzenle.php?id=" . $row['id'] . "' class='btn btn-primary'>Düzenle</a> ";
                            echo "<a href='silme.php?id=" . $row['id'] . "' class='btn btn-danger' onclick=\"return confirm('Bu gönderiyi silmek istediğinizden emin misiniz?')\">Sil</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Hiç blog yazınız yok.</td></tr>";
                    }

                    mysqli_stmt_close($stmt);
                }

                mysqli_close($baglanti);
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Anasayfa</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
