<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_registrasi = isset($_POST['id_registrasi']) ? $_POST['id_registrasi'] : null;
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['hapus'])) {
        $query_delete = "DELETE FROM registrasi WHERE id_registrasi='$id_registrasi'";
        $result_delete = $koneksi->query($query_delete);

        if ($result_delete) {
            header('location: db_pengunjung.php');
            exit;
        } else {
            echo "<script>alert('Gagal menghapus data user.'); window.location.href='db_pengunjung.php';</script>";
        }
    } else {
        if ($id_registrasi) {
            $query_update = "UPDATE registrasi SET email='$email', nama_lengkap='$nama', alamat='$alamat', no_hp='$hp' , username='$username', password='$password' WHERE id_registrasi='$id_registrasi'";
            $result_update = $koneksi->query($query_update);

            if ($result_update) {
                header('location: db_pengunjung.php');
                exit;
            } else {
                echo "<script>alert('Gagal mengupdate data user.'); window.location.href='db_pengunjung.php';</script>";
            }
        }
    }
} else {
    header('location: db_pengunjung.php');
    exit;
}
?>