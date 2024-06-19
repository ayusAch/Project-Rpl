<?php
include "../koneksi.php";

// Periksa apakah metode POST dipanggil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $id_wisata = isset($_POST['id_wisata']) ? $_POST['id_wisata'] : null;
    $jenis = $_POST['jenis'];
    $nama = $_POST['nama'];

    // Periksa apakah tombol Hapus diklik
    if (isset($_POST['hapus'])) {
        // Hapus data wisata berdasarkan ID
        $query_delete = "DELETE FROM wisata WHERE id_wisata='$id_wisata'";
        $result_delete = $koneksi->query($query_delete);

        if ($result_delete) {
            // Jika penghapusan berhasil, arahkan kembali ke halaman data wisata
            header('location: db_wisata.php');
            exit;
        } else {
            // Jika terjadi kesalahan, tampilkan pesan kesalahan
            echo "<script>alert('Gagal menghapus data Wisata.'); window.location.href='db_wisata.php';</script>";
        }
    } else {
        // Periksa apakah ID wisata disediakan
        if ($id_wisata) {
            // Perbarui data wisata berdasarkan ID
            $query_update = "UPDATE wisata SET jenis_wisata='$jenis', nama_wisata='$nama' WHERE id_wisata='$id_wisata'";
            $result_update = $koneksi->query($query_update);

            if ($result_update) {
                // Jika perubahan berhasil, arahkan kembali ke halaman data wisata
                header('location: db_wisata.php');
                exit;
            } else {
                // Jika terjadi kesalahan, tampilkan pesan kesalahan
                echo "<script>alert('Gagal mengupdate data Wisata.'); window.location.href='db_wisata.php';</script>";
            }
        } else {
            // Jika tidak ada ID, tambah data baru
            $query_insert = "INSERT INTO wisata (jenis_wisata, nama_wisata) VALUES ('$jenis', '$nama')";
            $result_insert = $koneksi->query($query_insert);

            if ($result_insert) {
                // Jika penambahan berhasil, arahkan kembali ke halaman data wisata
                header('location: db_wisata.php');
                exit;
            } else {
                // Jika terjadi kesalahan, tampilkan pesan kesalahan
                echo "<script>alert('Gagal menambahkan data Wisata.'); window.location.href='db_wisata.php';</script>";
            }
        }
    }
} else {
    // Jika tidak ada request POST, kembali ke halaman db_wisata.php
    header('location: db_wisata.php');
    exit;
}
?>