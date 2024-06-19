<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_transaksi = isset($_POST['id_transaksi']) ? $_POST['id_transaksi'] : null;

    if (isset($_POST['konfirmasi'])) {
        // Update status transaksi menjadi 'Pembayaran Berhasil'
        $query = "UPDATE transaksi SET status_transaksi='Pembayaran Berhasil' WHERE id_transaksi=?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("i", $id_transaksi);

        if ($stmt->execute()) {
            header('location: db_transaksi.php');
            exit;
        } else {
            echo "<script>alert('Gagal konfirmasi pembayaran.'); window.location.href='db_transaksi.php';</script>";
        }
    } else {
        header('location: db_transaksi.php');
        exit;
    }
} else {
    header('location: db_transaksi.php');
    exit;
}
?>