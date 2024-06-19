<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kuota = isset($_POST['id_kuota']) ? $_POST['id_kuota'] : null;
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : null;
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : null;

    if (isset($_POST['hapus'])) {
        $query_delete = "DELETE FROM kuota WHERE id_kuota='$id_kuota'";
        $result_delete = $koneksi->query($query_delete);

        if ($result_delete) {
            header('location: db_kuota.php');
            exit;
        } else {
            echo "<script>alert('Gagal menghapus data kuota.'); window.location.href='db_kuota.php';</script>";
        }
    } else {
        if ($id_kuota) {
            $query_update = "UPDATE kuota SET jumlah_kuota='$jumlah', keterangan='$keterangan' WHERE id_kuota='$id_kuota'";
            $result_update = $koneksi->query($query_update);

            if ($result_update) {
                header('location: db_kuota.php');
                exit;
            } else {
                echo "<script>alert('Gagal mengupdate data kuota.'); window.location.href='db_kuota.php';</script>";
            }
        } else {
            $query_insert = "INSERT INTO kuota (jumlah_kuota, keterangan) VALUES ('$jumlah', '$keterangan')";
            $result_insert = $koneksi->query($query_insert);

            if ($result_insert) {
                header('location: db_kuota.php');
                exit;
            } else {
                echo "<script>alert('Gagal menambahkan data kuota.'); window.location.href='db_kuota.php';</script>";
            }
        }
    }
} else {
    header('location: db_kuota.php');
    exit;
}
?>