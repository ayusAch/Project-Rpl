<?php
session_start();
include "../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_registrasi = isset($_POST['id_registrasi']) ? $_POST['id_registrasi'] : null;
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $nama_lengkap = isset($_POST['nama']) ? $_POST['nama'] : null; 
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $nomor_hp = isset($_POST['hp']) ? $_POST['hp'] : null; 
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($id_registrasi && $username && $nama_lengkap && $email && $nomor_hp && $alamat) {
        if (!empty($password)) {
            $password_hashed = password_hash($password, PASSWORD_BCRYPT); 
            $query_update = $koneksi->prepare(
                "UPDATE registrasi SET email=?, nama_lengkap=?, no_hp=?, alamat=?, username=?, password=? WHERE id_registrasi=?"
            );
            $query_update->bind_param("ssssssi", $email, $nama_lengkap, $nomor_hp, $alamat, $username, $password_hashed, $id_registrasi);
        } else {
            $query_update = $koneksi->prepare(
                "UPDATE registrasi SET email=?, nama_lengkap=?, no_hp=?, alamat=?, username=? WHERE id_registrasi=?"
            );
            $query_update->bind_param("sssssi", $email, $nama_lengkap, $nomor_hp, $alamat, $username, $id_registrasi);
        }

        if ($query_update->execute()) {
            header('Location: ../../home.php');
            exit;
        } else {
            echo "<script>alert('Gagal mengupdate data.'); window.location.href='form_setting.php';</script>";
        }
    } else {
        echo "<script>alert('Data tidak lengkap.'); window.location.href='form_setting.php';</script>";
    }
} else {
    echo "Metode pengiriman tidak valid.";
}