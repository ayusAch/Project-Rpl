<?php
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $path = "../../bukti-bayar/" . basename($nama_file);

    $id_transaksi = isset($_POST['id_transaksi']) ? $_POST['id_transaksi'] : null;
    $id_pesanan = $_POST['id_pesanan'];
    $tanggal = $_POST['tanggal'];
    $metode = $_POST['metode'];

    $allowed_types = ["image/jpeg", "image/png"];

    if (in_array($tipe_file, $allowed_types)) {
        if ($ukuran_file <= 1000000) { // 1 MB
            if (!file_exists("../../bukti-bayar/")) {
                mkdir("../../bukti-bayar/", 0755, true);
            }
            if (move_uploaded_file($tmp_file, $path)) {
                if ($id_transaksi) {
                    $query_update = "UPDATE transaksi SET id_pesanan='$id_pesanan', tanggal_pembayaran='$tanggal', metode_pembayaran='$metode', bukti_pembayaran='$nama_file' WHERE id_transaksi='$id_transaksi'";
                    $result_update = $koneksi->query($query_update);

                    if ($result_update) {
                        echo "<script>alert('Transaksi berhasil diperbarui.'); window.location.href='../../home.php';</script>";
                        exit;
                    } else {
                        unlink($path);
                        echo "<script>alert('Gagal mengupdate data transaksi.'); history.go(-1);</script>";
                    }
                } else {
                    $query_insert = "INSERT INTO transaksi (id_pesanan, tanggal_pembayaran, metode_pembayaran, bukti_pembayaran, type, size) VALUES ('$id_pesanan', '$tanggal', '$metode', '$nama_file', '$tipe_file', '$ukuran_file')";
                    $result_insert = $koneksi->query($query_insert);

                    if ($result_insert) {
                        echo "<script>alert('File Berhasil di Upload dan Transaksi berhasil disimpan'); window.location.href='../forms/rekap.php';</script>";
                        exit;
                    } else {
                        unlink($path);
                        echo "<script>alert('File Gagal Masuk Database'); history.go(-1);</script>";
                    }
                }
            } else {
                echo "<script>alert('File Gagal Terupload. Pastikan direktori tujuan ada dan dapat ditulisi.'); history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('Ukuran File Lebih dari 1 MB'); history.go(-1);</script>";
        }
    } else {
        echo "<script>alert('File Bukan Berekstensi Gambar yang Diizinkan'); history.go(-1);</script>";
    }
}
$koneksi->close();
?>
