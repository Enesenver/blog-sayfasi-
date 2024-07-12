<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "baglanti.php";
include "navbar.php";

$kullaniciadi = $sifre = "";
$kullaniciadi_hata = $sifre_hata = $giris_hata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["kullaniciadi"]))) {
        $kullaniciadi_hata = "Lütfen kullanıcı adı giriniz.";
    } else {
        $kullaniciadi = trim($_POST["kullaniciadi"]);
    }
    if (empty(trim($_POST["sifre"]))) {
        $sifre_hata = "Lütfen şifre giriniz.";
    } else {
        $sifre = trim($_POST["sifre"]);
    }
    if (empty($kullaniciadi_hata) && empty($sifre_hata)) {
        $kontrol = "SELECT id, kullaniciadi, sifre FROM kullanici_bilgileri WHERE kullaniciadi = ?";
        if ($stmt = mysqli_prepare($baglanti, $kontrol)) {
            mysqli_stmt_bind_param($stmt, "s", $kullaniciadi);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $kullaniciadi, $gizli_sifre);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($sifre, $gizli_sifre)) {
                            $_SESSION["giris_bilgisi"] = true;
                            $_SESSION["id_bilgisi"] = $id;
                            $_SESSION["kullaniciadi_bilgisi"] = $kullaniciadi;
                            header("Location: yazilarim.php"); 
                            exit;
                        } else {
                            $giris_hata = "Yanlış şifre girdiniz.";
                        }
                    }
                } else {
                    $giris_hata = "Girdiğiniz Kullanıcı Adı Mevcut değil!";
                }
            } else {
                $giris_hata = "Bilinmeyen bir hata oluştu.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($baglanti);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Giriş Yap</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet">
    <style>
        body {
            background: url('https://source.unsplash.com/collection/327760/1920x1080') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(0, 0, 0, 10);
            border-radius: 10px;
        }

        .login-container h3 {
            margin-bottom: 30px;
            font-size: 24px;
            text-align: center;
            font-family: 'Lora', serif;
        }

        .login-container .form-control {
            height: 45px;
            border-radius: 5px;
        }

        .login-container .btn {
            height: 45px;
            border-radius: 5px;
            background-color: #007bff;
            border: none;
        }

        .login-container .btn:hover {
            background-color: #0056b3;
        }

        .login-container .form-check-label {
            font-size: 14px;
        }

        .login-container .alert {
            margin-top: 20px;
        }
        .navbar-container {
            background-color: transparent; /* Arka plan rengini tamamen şeffaf yapar */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Giriş Yap</h3>
        <?php if (!empty($giris_hata)) {
            echo '<div class="alert alert-danger">' . $giris_hata . '</div>';
        } ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" novalidate>
            <div class="mb-3">
                <input type="text" class="form-control <?php echo (!empty($kullaniciadi_hata)) ? 'is-invalid' : ''; ?>" id="kullaniciadi" name="kullaniciadi" placeholder="Kullanıcı Adı" value="<?php echo htmlspecialchars($kullaniciadi); ?>">
                <span class="invalid-feedback"><?php echo $kullaniciadi_hata; ?></span>
            </div>
            <div class="mb-4">
                <input type="password" class="form-control <?php echo (!empty($sifre_hata)) ? 'is-invalid' : ''; ?>" id="sifre" name="sifre" placeholder="Şifre">
                <span class="invalid-feedback"><?php echo $sifre_hata; ?></span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="beniHatirla">
                    <label class="form-check-label" for="beniHatirla">Beni Hatırla</label>
                </div>
                <a href="sifre_sifirla.php" class="forgot-password">Şifremi Unuttum</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
            <p class="text-center mt-3">Bir hesabınız yok mu? <a href="kayit.php">Kayıt Ol</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
