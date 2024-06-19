<?php
include "../koneksi.php";

// Periksa apakah metode POST dipanggil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $id_ulasan = isset($_POST['id_ulasan']) ? $_POST['id_ulasan'] : null;
    $id_registrasi = $_POST['username'];
    $komentar = $_POST['komentar'];
    $tanggal = $_POST['tanggal'];

    // Periksa apakah tombol Hapus diklik
    if (isset($_POST['hapus'])) {
        // Hapus data wisata berdasarkan ID
        $query_delete = "DELETE FROM ulasan WHERE id_ulasan='$id_ulasan'";
        $result_delete = $koneksi->query($query_delete);

        if ($result_delete) {
            // Jika penghapusan berhasil, arahkan kembali ke halaman data wisata
            header('location: db_ulasan.php');
            exit;
        } else {
            // Jika terjadi kesalahan, tampilkan pesan kesalahan
            echo "<script>alert('Gagal menghapus data ulasan.'); window.location.href='db_ulasan.php';</script>";
        }
    } else {
        // Cari id_registrasi berdasarkan username
        $query_user = "SELECT id FROM users WHERE username = '$id_registrasi'";
        $result_user = $koneksi->query($query_user);
        // Periksa apakah ID wisata disediakan
        if ($id_ulasan) {
            // Perbarui data wisata berdasarkan ID
            $query_update = "UPDATE ulasan SET id_registrasi='$id_registrasi', komentar='$komentar',tanggal='$tanggal' WHERE id_ulasan='$id_ulasan'";
            $result_update = $koneksi->query($query_update);

            if ($result_update) {
                // Jika perubahan berhasil, arahkan kembali ke halaman data wisata
                header('location: db_ulasan.php');
                exit;
            } else {
                // Jika terjadi kesalahan, tampilkan pesan kesalahan
                echo "<script>alert('Gagal mengupdate data ulasan.'); window.location.href='db_ulasan.php';</script>";
            }
        }
    }
} else {
    // Jika tidak ada request POST, kembali ke halaman db_wisata.php
    header('location: db_ulasan.php');
    exit;
}
?>