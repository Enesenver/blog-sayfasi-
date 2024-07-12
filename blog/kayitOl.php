<?php
include "baglanti.php";
include "navbar.php";

$ad = $email = $sifre = $sifre_tekrar = "";
$ad_hata = $email_hata = $sifre_hata = $sifre_tekrar_hata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["ad"]))) {
        $ad_hata = "Lütfen adınızı giriniz.";
    } else {
        $ad = trim($_POST["ad"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_hata = "Lütfen email adresinizi giriniz.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["sifre"]))) {
        $sifre_hata = "Lütfen şifrenizi giriniz.";
    } else {
        $sifre = trim($_POST["sifre"]);
    }

    if (empty(trim($_POST["sifre_tekrar"]))) {
        $sifre_tekrar_hata = "Lütfen şifrenizi tekrar giriniz.";
    } else {
        $sifre_tekrar = trim($_POST["sifre_tekrar"]);
        if (empty($sifre_hata) && ($sifre != $sifre_tekrar)) {
            $sifre_tekrar_hata = "Girdiğiniz şifreler uyuşmuyor.";
        }
    }

    if (empty($ad_hata) && empty($email_hata) && empty($sifre_hata) && empty($sifre_tekrar_hata)) {
        $ekle = "INSERT INTO kullanici_bilgileri (ad, email, sifre) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($baglanti, $ekle)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_ad, $param_email, $param_sifre);
            $param_ad = $ad;
            $param_email = $email;
            $param_sifre = password_hash($sifre, PASSWORD_DEFAULT); // Şifreyi hashleme
            if (mysqli_stmt_execute($stmt)) {
                header("location: girisYap.php");
                exit();
            } else {
                echo "Bir şeyler yanlış gitti, lütfen daha sonra tekrar deneyin.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($baglanti);
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kayıt Ol</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body {
            background: url('https://source.unsplash.com/collection/327760/1920x1080') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
        }

        .register-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(0, 0, 0, 10);
            border-radius: 10px;
        }

        .register-container h3 {
            margin-bottom: 30px;
            font-size: 24px;
            text-align: center;
            font-family: 'Lora', serif;
        }

        .register-container .form-control {
            height: 45px;
            border-radius: 5px;
        }

        .register-container .btn {
            height: 45px;
            border-radius: 5px;
            background-color: #007bff;
            border: none;
        }

        .register-container .btn:hover {
            background-color: #0056b3;
        }

        .register-container .form-check-label {
            font-size: 14px;
        }

        .register-container .alert {
            margin-top: 20px;
        }

        .navbar-container {
            background-color: transparent;

        }
    </style>
</head>

<body>
    <div class="register-container">
        <h3>Kayıt Ol</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" novalidate>
            <div class="mb-3">
                <input type="text" class="form-control <?php echo (!empty($ad_hata)) ? 'is-invalid' : ''; ?>" id="ad" name="ad" placeholder="Ad" value="<?php echo htmlspecialchars($ad); ?>">
                <span class="invalid-feedback"><?php echo $ad_hata; ?></span>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control <?php echo (!empty($email_hata)) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="invalid-feedback"><?php echo $email_hata; ?></span>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control <?php echo (!empty($sifre_hata)) ? 'is-invalid' : ''; ?>" id="sifre" name="sifre" placeholder="Şifre">
                <span class="invalid-feedback"><?php echo $sifre_hata; ?></span>
            </div>
            <div class="mb-4">
                <input type="password" class="form-control <?php echo (!empty($sifre_tekrar_hata)) ? 'is-invalid' : ''; ?>" id="sifre_tekrar" name="sifre_tekrar" placeholder="Şifre Tekrar">
                <span class="invalid-feedback"><?php echo $sifre_tekrar_hata; ?></span>
            </div>
            <button type="submit" class="btn btn-primary w-100">Kayıt Ol</button>
            <p class="text-center mt-3">Zaten bir hesabınız var mı? <a href="girisYap.php">Giriş Yap</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>

