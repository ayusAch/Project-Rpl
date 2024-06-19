<?php
session_start();
include "../../koneksi.php";

if (isset($_POST['id_registrasi']) && isset($_POST['id_destinasi']) && isset($_POST['rating']) && isset($_POST['komentar']) && isset($_POST['tanggal'])) {
    $id_registrasi = $_POST['id_registrasi'];
    $id_destinasi = $_POST['id_destinasi'];
    $rating = $_POST['rating'];
    $komentar = $_POST['komentar'];
    $tanggal = $_POST['tanggal'];

    $sql = "INSERT INTO ulasan (id_registrasi, id_destinasi, rating, komentar, tanggal_ulasan) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("iiiss", $id_registrasi, $id_destinasi, $rating, $komentar, $tanggal);

    if ($stmt->execute()) {
        header('Location: ../../home.php');
        exit();
    } else {
        echo "Gagal menyimpan ulasan: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Data ulasan tidak lengkap.";
}
$koneksi->close();
?>