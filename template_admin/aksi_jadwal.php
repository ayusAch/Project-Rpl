<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jadwal = isset($_POST['id_jadwal']) ? $_POST['id_jadwal'] : null;
    $hari = $_POST['hari'];
    $buka = $_POST['buka'];
    $tutup = $_POST['tutup'];

    if (isset($_POST['hapus'])) {
        $query_delete = "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'";
        $result_delete = $koneksi->query($query_delete);

        if ($result_delete) {
            header('location: db_jadwal.php');
            exit;
        } else {
            echo "<script>alert('Gagal menghapus data Jadwal.'); window.location.href='db_jadwal.php';</script>";
        }
    } else {
        if ($id_jadwal) {
            $query_update = "UPDATE jadwal SET hari='$hari', jam_buka='$buka',jam_tutup='$tutup' WHERE id_jadwal='$id_jadwal'";
            $result_update = $koneksi->query($query_update);

            if ($result_update) {
                header('location: db_jadwal.php');
                exit;
            } else {
                echo "<script>alert('Gagal mengupdate data Jadwal.'); window.location.href='db_jadwal.php';</script>";
            }
        } else {
            $query_insert = "INSERT INTO jadwal (hari, jam_buka, jam_tutup) VALUES ('$hari', '$buka','$tutup')";
            $result_insert = $koneksi->query($query_insert);

            if ($result_insert) {
                header('location: db_jadwal.php');
                exit;
            } else {
                echo "<script>alert('Gagal menambahkan data Wisata.'); window.location.href='db_jadwal.php';</script>";
            }
        }
    }
} else {
    header('location: db_jadwal.php');
    exit;
}
?>