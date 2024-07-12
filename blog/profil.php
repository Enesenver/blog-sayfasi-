<?php 
include "navbar.php";  
include "fonksiyonlar.php";

$kullaniciadi = $ad = $soyad = $id = $email = $sifre = $eski_sifre = $yeni_sifre = $sifre_onay = $yeni_sifre_onay= "";
$kullaniciadi_hata = $email_hata = $sifre_hata = $eski_sifre_hata = $yeni_sifre_hata = $sifre_onay_hata = $yeni_sifre_onay_hata = "";

if(session_bilgi() == true){
    $kullaniciadi = $_SESSION["kullaniciadi_bilgisi"];
    $id = $_SESSION["id_bilgisi"];
    $sonuc = bilgi_getir($id);
    $GLOBALS['row'] = mysqli_fetch_assoc($sonuc);
    $id = $row["id"];
    $kullaniciadi_veritabani = $row["kullaniciadi"];
    $ad = $row["adi"];
    $soyad = $row["soyadi"];
    $email = $row["eposta"];
    $adres = $row["adres"];
    $ilce = $row["ilce"];
    $il = $row["il"];
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profil - Blog Sayfanız</title>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        .navbar {
            margin-top: 0;
            padding-top: 0;
        }
    </style>
</head>
<body>
    <div class="container pt-4">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" novalidate enctype="multipart/form-data"> 
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-12 col-md-4">
                    <div class="col-md-4">
                        <?php
                        $img="img/avatars/".$id.".jpg";
                        if(empty(file_exists($img))){
                            $GLOBALS['img']="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg";
                        }
                        ?>
                        <div class="d-flex justify-content-center mb-4">
                            <img src="<?php echo $img;?>" class="rounded-circle" alt="<?php echo $kullaniciadi;?>"  width="128" height="128"/>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="btn btn-primary btn-rounded m-1">
                                <label class="form-label text-white m-1" for="foto">Foto Seç</label>
                                <input type="file" class="form-control d-none" id="foto" name="foto"/>
                            </div>
                            <div class="btn btn-danger btn-rounded m-1">
                                <label class="form-label text-white m-1" for="foto_yukle">Foto Yükle</label>
                                <input type="submit" class="form-control d-none" id="foto_yukle" name="foto_yukle"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="kullaniciadi" class="form-label">Kullanıcı Adı</label>
                                <input class="form-control <?php echo (!empty($kullaniciadi_hata)) ? 'is-invalid': ''?>" id="kullaniciadi" type="text" name="kullaniciadi" placeholder="Kullanıcı Adı" value="<?php echo $kullaniciadi; ?>">
                                <span class="invalid-feedback"><?php echo $kullaniciadi_hata; ?></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="ad" class="form-label">Ad</label>
                                <input type="text" class="form-control" id="ad" placeholder="Ad" name="ad" value="<?php echo $ad; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="soyad" class="form-label">Soyad</label>
                                <input type="text" class="form-control" id="soyad" name="soyad" placeholder="Soyad" value="<?php echo $soyad; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-8">
                    <div class="mb-3">
                        <label for="adres" class="form-label">Adres</label>
                        <input type="text" class="form-control" id="adres" name="adres" value="<?php echo $adres; ?>" placeholder="Adres">
                    </div>
                </div>
                <div class="mb-3 col-md-2">
                    <label for="ilce" class="form-label">İlçe</label>
                    <input type="text" class="form-control" id="ilce" name="ilce" placeholder="İlçe" value="<?php echo $ilce; ?>">
                </div>
                <div class="mb-3 col-md-2">
                    <label for="il" class="form-label">İl</label>
                    <input type="text" class="form-control" id="il"  name="il" value="<?php echo $il; ?>" placeholder="İl">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="kayit">Değişikleri Kaydet</button>
        </form>
        <br><br><br>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" novalidate>				
            <div class="mb-3">
                <label for="eski_sifre" class="form-label">Mevcut Şifreniz</label>
                <input class="form-control <?php echo (!empty($eski_sifre_hata)) ? 'is-invalid': ''?>" id="eski_sifre" name="eski_sifre" value="<?php echo $eski_sifre; ?>" type="password" placeholder="Mevcut Şifre">
                <span class="invalid-feedback"><?php echo $eski_sifre_hata; ?></span>
                <small><a href="şifremiU.php">Şifremi Unuttum</a></small>				
            </div>
            <div class="mb-3">
                <label for="yeni_sifre" class="form-label">Yeni Şifre</label>
                <input class="form-control <?php echo (!empty($yeni_sifre_hata)) ? 'is-invalid': ''?>" value="<?php echo $yeni_sifre; ?>" id="yeni_sifre" name="yeni_sifre" type="password" placeholder="Yeni Şifrenizi Giriniz">
                <span class="invalid-feedback"><?php echo $yeni_sifre_hata; ?></span>
            </div>
            <div class="mb-3">
                <label for="yeni_sifre_onay" class="form-label">Yeni Şifre Onay</label>
                <input class="form-control <?php echo (!empty($yeni_sifre_onay_hata)) ? 'is-invalid': ''?>" value="<?php echo $yeni_sifre_onay; ?>" id="yeni_sifre_onay" name="yeni_sifre_onay" type="password" placeholder="Yeni Şifre Onay">
                <span class="invalid-feedback"><?php echo $yeni_sifre_onay_hata; ?></span>
            </div>		
            <button type="submit" class="btn btn-primary" name="sifre_degistir">Değişikleri Kaydet</button>
        </form>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
