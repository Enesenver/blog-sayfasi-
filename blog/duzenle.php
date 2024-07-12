<?php
include_once "baglanti.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Form gönderildiğinde güncelle
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $konusu = $_POST['konusu'];
        $yazı = $_POST['yazı'];
        $query = "UPDATE blog SET konusu = ?, yazı = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($baglanti, $query)) {
            mysqli_stmt_bind_param($stmt, "ssi", $konusu, $yazı, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        mysqli_close($baglanti);
        header("Location: yazilarim.php"); // Yazılarım sayfasına yönlendir
        exit;
    } else {
        // Yazıyı getir
        $query = "SELECT konusu, yazı FROM blog WHERE id = ?";
        if ($stmt = mysqli_prepare($baglanti, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $konusu, $yazı);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }
} else {
    header("Location: yazilarim.php"); // ID eksikse yazılarım sayfasına yönlendir
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Yazıyı Düzenle</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar Kısmı -->
    <?php include "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Yazıyı Düzenle</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $id; ?>" method="post">
            <div class="form-group">
                <label for="konusu">Konu</label>
                <input type="text" name="konusu" class="form-control" value="<?php echo htmlspecialchars($konusu); ?>" required>
            </div>
            <div class="form-group">
                <label for="yazı">Yazı</label>
                <textarea name="yazı" class="form-control" rows="5" required><?php echo htmlspecialchars($yazı); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
