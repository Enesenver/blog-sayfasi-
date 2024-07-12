<?php
include_once "baglanti.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["giris_bilgisi"]) || $_SESSION["giris_bilgisi"] !== true) {
    header("location: girisYap.php"); // Giriş sayfasına yönlendir
    exit;
}

$kullanici_id = $_SESSION["id_bilgisi"];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM blog WHERE id = ? AND yazan_id = ?";
    if ($stmt = mysqli_prepare($baglanti, $query)) {
        mysqli_stmt_bind_param($stmt, "ii", $id, $kullanici_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            mysqli_stmt_close($stmt);
            mysqli_close($baglanti);
            header("Location: yazilarim.php"); 
            exit;
        } else {
            echo "Bu yazıyı silme yetkiniz yok veya yazı bulunamadı.";
        }
    } else {
        echo "Veritabanı hatası.";
    }
} else {
    echo "Geçersiz istek.";
}

mysqli_close($baglanti);
?>
