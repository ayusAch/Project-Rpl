<?php
session_start();
include "../../koneksi.php";

if (isset($_SESSION['id_registrasi']) && isset($_POST['destinasi']) && isset($_POST['jumlah']) && isset($_POST['harga'])) {
    $registrasi = $_SESSION['id_registrasi'];
    $destinasi = $_POST['destinasi'];
    $jumlah = $_POST['jumlah'];
    $total = $_POST['harga'];

    $sql = "INSERT INTO tiket (id_destinasi, id_registrasi, jumlah_tiket, total_harga) VALUES ('$destinasi', '$registrasi', '$jumlah', '$total')";
    $query = $koneksi->query($sql);

    if ($query=== true) {
            header('Location: ../forms/form_pesanan.php');
            exit();
    } else {
        echo "Gagal menyimpan data tiket: ";
    }

    $stmt->close();
} else {
    echo "Data tidak lengkap atau tidak valid.";
}
?>