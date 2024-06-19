<?php
session_start();
include "../../koneksi.php";

if (isset($_POST['nama']) && isset($_POST['kelamin']) && isset($_POST['tanggal'])) {
    //array
    $nama = $_POST['nama'];
    $kelamin = $_POST['kelamin'];
    $tanggal = $_POST['tanggal'];

    $jumlahAnggota = count($nama);

    for ($i = 0; $i < $jumlahAnggota; $i++) {
        $namaAnggota = $nama[$i];
        $kelaminAnggota = $kelamin[$i];
        $tanggalAnggota = $tanggal[$i];

        $sql = "INSERT INTO pengunjung (nama_pengunjung, jenis_kelamin, tanggal_lahir) 
        VALUES ('$namaAnggota', '$kelaminAnggota', '$tanggalAnggota')";
        
        $query = $koneksi->query($sql);

        if ($query !== true) {
            echo "Error: ";
            exit();
        }
    }
    header('Location: ../forms/form_pesanan.php');
    exit();
} else {
    echo "Error: Data tidak lengkap";
}
?>
