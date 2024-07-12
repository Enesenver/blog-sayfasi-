<?php
include "baglanti.php";
include "navbar.php";

$sorgu = "SELECT * FROM blog";
$sonuc = mysqli_query($baglanti, $sorgu);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloglar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Bloglar</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Ad-Soyad</th>
                <th>Konusu</th>
                <th>Yazı</th>
                <th>Yazan</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($sonuc)) { ?>
            <tr>
                <td><?php echo $row['adsoyad']; ?></td>
                <td><?php echo $row['konusu']; ?></td>
                <td><?php echo $row['yazı']; ?></td>
                <td><?php echo $row['yazan']; ?></td>
                <td>
                    <a href="duzenle.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Düzenle</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php mysqli_close($baglanti); ?>
