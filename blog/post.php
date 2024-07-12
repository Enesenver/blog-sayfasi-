<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "baglanti.php";

if (!isset($_SESSION["giris_bilgisi"]) || $_SESSION["giris_bilgisi"] !== true) {
    header("location: girisYap.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $konusu = $_POST['konusu'];
    $yazi = $_POST['yazi'];
    $yazan = $_SESSION["kullaniciadi_bilgisi"];
    $yazar_id = $_SESSION["id_bilgisi"];
    $yayınlamatarihi = date('Y-m-d H:i:s');

    $sql = "INSERT INTO blog (konusu, yazı, yazan, yazan_id, yayınlamatarihi) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($baglanti, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssis", $konusu, $yazi, $yazan, $yazar_id, $yayınlamatarihi);
        if (mysqli_stmt_execute($stmt)) {
            header("location: yazilarim.php"); 
            exit;
        } else {
            echo "Hata: " . $sql . "<br>" . mysqli_error($baglanti);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($baglanti);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Yazı Ekle</title>
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Yeni Yazı Ekle</div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" novalidate>
                        <div class="form-group">
                            <label for="adsoyad">Ad-Soyad</label>
                            <input class="form-control" id="adsoyad" type="text" name="adsoyad" required>
                        </div>
                        <div class="form-group">
                            <label for="yazan">Yazan</label>
                            <input class="form-control" id="yazan" type="text" name="yazan" required>
                        </div>
                        <div class="form-group">
                            <label for="konusu">Konusu</label>
                            <input class="form-control" id="konusu" type="text" name="konusu" required>
                        </div>
                        <div class="form-group">
                            <label for="yazi">Yazı</label>
                            <textarea class="form-control" id="yazi" name="yazi" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="oekle">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
