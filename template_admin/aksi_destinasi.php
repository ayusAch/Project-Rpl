<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_destinasi = isset($_POST['id_destinasi']) ? $_POST['id_destinasi'] : null;

    $id_wisata = $_POST['wisata'];
    $nama = $_POST['nama'];
    $id_jadwal = $_POST['jadwal'];
    $id_lokasi = $_POST['lokasi'];
    $id_kuota = $_POST['kuota'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $fasilitas = isset($_POST['fasilitas']) ? $_POST['fasilitas'] : [];
    $fasilitas_str = implode(',', $fasilitas);

    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $path = "../images/" . $nama_file;

    if ($id_destinasi) {
        if ($nama_file) {
            if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
                if ($ukuran_file <= 1000000) { // 1 MB
                    if (move_uploaded_file($tmp_file, $path)) {
                        $query_update = "UPDATE destinasi SET id_wisata='$id_wisata', nama_destinasi='$nama', id_jadwal='$id_jadwal', id_kuota='$id_kuota', id_lokasi='$id_lokasi', harga_destinasi='$harga', file='$nama_file', type='$tipe_file', size='$ukuran_file', fasilitas='$fasilitas_str', deskripsi_destinasi='$deskripsi' WHERE id_destinasi='$id_destinasi'";
                    } else {
                        echo "<script>alert('File Gagal Terupload');history.go(-1);</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Ukuran File Lebih dari 1 MB');history.go(-1);</script>";
                    exit;
                }
            } else {
                echo "<script>alert('File Bukan Berekstensi Gambar');history.go(-1);</script>";
                exit;
            }
        } else {
            $query_update = "UPDATE destinasi SET id_wisata='$id_wisata', nama_destinasi='$nama', id_jadwal='$id_jadwal',  id_kuota='$id_kuota', id_lokasi='$id_lokasi', harga_destinasi='$harga', fasilitas='$fasilitas_str', deskripsi_destinasi='$deskripsi' WHERE id_destinasi='$id_destinasi'";
        }

        $result_update = $koneksi->query($query_update);

        if ($result_update) {
            header('Location: db_destinasi.php');
            exit;
        } else {
            echo "<script>alert('Gagal mengupdate data Destinasi.'); window.location.href='db_destinasi.php';</script>";
        }
    } else {
        if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
            if ($ukuran_file <= 1000000) { // 1 MB
                if (move_uploaded_file($tmp_file, $path)) {
                    $query_insert = "INSERT INTO destinasi 
                    (id_wisata, nama_destinasi, id_jadwal,  id_kuota, id_lokasi, harga_destinasi, fasilitas, deskripsi_destinasi, file, type, size) VALUES ('$id_wisata', '$nama', '$id_jadwal', '$id_kuota', '$id_lokasi', '$harga', '$fasilitas_str', '$deskripsi','$nama_file', '$tipe_file', '$ukuran_file')";
                    $result_insert = $koneksi->query($query_insert);
                    if ($result_insert) {
                        echo "<script>alert('File Berhasil di Upload');window.location.href='db_destinasi.php';</script>";
                    } else {
                        echo "<script>alert('File Gagal Masuk Database');history.go(-1);</script>";
                    }
                } else {
                    echo "<script>alert('File Gagal Terupload');history.go(-1);</script>";
                }
            } else {
                echo "<script>alert('Ukuran File Lebih dari 1 MB');history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('File Bukan Berekstensi Gambar');history.go(-1);</script>";
        }
    }
}
?>
