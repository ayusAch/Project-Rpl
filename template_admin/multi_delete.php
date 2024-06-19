<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['username'])) {
    die("Anda belum login");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['selected_ids'])) {
        $selected_ids = $_POST['selected_ids'];
        foreach ($selected_ids as $id) {
            $id = $koneksi->real_escape_string($id);

            // Hapus data di tabel destinasi
            $query_destinasi = "DELETE FROM destinasi WHERE id_destinasi='$id'";
            $koneksi->query($query_destinasi);
        }
    }
    header('Location: db_destinasi.php');
    exit();
} else {
    die("Akses dilarang");
}
?>
