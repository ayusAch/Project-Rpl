<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_lokasi = isset($_POST['id_lokasi']) ? $_POST['id_lokasi'] : null;
    $nama_lokasi = isset($_POST['nama_lokasi']) ? $_POST['nama_lokasi'] : null;

    if (isset($_POST['hapus'])) {
        $query_delete = "DELETE FROM lokasi WHERE id_lokasi=?";
        $stmt_delete = $koneksi->prepare($query_delete);
        $stmt_delete->bind_param("i", $id_lokasi);
        $result_delete = $stmt_delete->execute();

        if ($result_delete) {
            header('location: db_lokasi.php');
            exit;
        } else {
            echo "<script>alert('Gagal menghapus data Lokasi.'); window.location.href='db_lokasi.php';</script>";
        }
    } else {
        if ($id_lokasi) {
            $query_update = "UPDATE lokasi SET nama_lokasi=? WHERE id_lokasi=?";
            $stmt_update = $koneksi->prepare($query_update);
            $stmt_update->bind_param("si", $nama_lokasi, $id_lokasi);
            $result_update = $stmt_update->execute();

            if ($result_update) {
                header('location: db_lokasi.php');
                exit;
            } else {
                echo "<script>alert('Gagal mengupdate data Lokasi.'); window.location.href='db_lokasi.php';</script>";
            }
        } else {
            if (!empty($nama_lokasi)) {
                foreach ($nama_lokasi as $lokasi) {
                    $query_insert = $koneksi->prepare("INSERT INTO lokasi (nama_lokasi) VALUES (?)");
                    $query_insert->bind_param("s", $lokasi);

                    $result_insert = $query_insert->execute();

                    if (!$result_insert) {
                        echo "<script>alert('Gagal menambahkan data Lokasi.'); window.location.href='db_lokasi.php';</script>";
                        exit();
                    }
                }
                header('Location: db_lokasi.php');
                exit();
            } else {
                echo "Error: Data tidak lengkap";
            }
        }
    }
} else {
    header('location: db_lokasi.php');
    exit;
}
?>
