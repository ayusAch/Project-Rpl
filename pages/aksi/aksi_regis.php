<?php
include "../../koneksi.php";
$email = $_POST['email'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$hp = $_POST['hp'];
$user = $_POST['username'];
$psw = $_POST['password'];
$level = $_POST['level'];
$sql = "INSERT INTO registrasi (email, nama_lengkap, alamat, no_hp, username, password, level) VALUES ('" . $email . "','" . $nama . "','" . $alamat . "','" . $hp . "','" . $user . "', '" . $psw . "', '" . $level . "')";
$query = $koneksi->query($sql);
if ($query === true) {
    header('location: ../forms/form_login.php');
} else {
    echo "errorr";
}
?>