<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}
?>

<?php
    include_once 'proses.php';

    $get_id_divisi = $_GET['get_id_divisi'];
    $proses = new Presensi;
    $delete = $proses->DeleteDivisi($get_id_divisi);
    if ($delete){
        echo "<script>alert('Data Divisi berhasil dihapus');window.location = 'data-divisi.php';</script>";
    }
?>