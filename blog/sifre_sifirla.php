<?php
include_once "baglanti.php";

$mesaj = "";
$hata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

$sql = "SELECT id FROM kullanici_bilgileri WHERE eposta = ?";
if ($stmt = $baglanti->prepare($sql)) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $reset_token = bin2hex(random_bytes(16)); 
        $reset_link = "http://localhost/blog/sifre_sifirla.php?token=" . $reset_token;
$sql = "UPDATE kullanici_bilgileri SET reset_token = ? WHERE eposta = ?";
if ($stmt = $baglanti->prepare($sql)) {
    $stmt->bind_param("ss", $reset_token, $email);
    $stmt->execute();

    $to = $email;
    $subject = "Şifre Sıfırlama Talebi";
    $message = "Şifrenizi sıfırlamak için lütfen aşağıdaki bağlantıya tıklayın:\n\n";
    $message .= $reset_link;
    $headers = "From: info@example.com";

    mail($to, $subject, $message, $headers);

    $mesaj = "Şifre sıfırlama bağlantısı e-posta adresinize gönderildi.";
} else {
    $hata = "Bir hata oluştu. Lütfen tekrar deneyin.";
}

    } else {
        $hata = "Bu e-posta adresiyle ilişkilendirilmiş bir hesap bulunamadı.";
    }
    $stmt->close();
}

    $baglanti->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Sıfırlama</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Şifre Sıfırlama</h2>
        <?php if (!empty($mesaj)) : ?>
            <div class="alert alert-success"><?php echo $mesaj; ?></div>
        <?php endif; ?>
        <?php if (!empty($hata)) : ?>
            <div class="alert alert-danger"><?php echo $hata; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="email">E-posta Adresiniz:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Şifre Sıfırlama Bağlantısı Gönder</button>
        </form>
    </div>
</body>
</html>
