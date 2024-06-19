<?php
session_start();
include "../../koneksi.php";

function generateRandomPaymentCode($length = 8)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

if (isset($_POST['tiket']) && isset($_POST['tanggal'])) {
    $tiket = $_POST['tiket'];
    $tanggal = $_POST['tanggal'];

    $kode_pembayaran = generateRandomPaymentCode();

    $stmt = $koneksi->prepare("INSERT INTO pesanan (id_tiket, tanggal_pesanan, kode_pembayaran) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $tiket, $tanggal, $kode_pembayaran);

    if ($stmt->execute()) {
        $_SESSION['kode_pembayaran'] = $kode_pembayaran;

        echo "<script>alert('Kode Pembayaran Anda: $kode_pembayaran'); window.location.href='../forms/form_transaksi.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: Data tidak lengkap.";
}
?>