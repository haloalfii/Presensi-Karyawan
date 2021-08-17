<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}
?>

<?php
include('proses.php');
$proses = new Presensi();

if (isset($_POST['login'])) {
    $id_presensi = $_POST['id_presensi'];
    $nik = $_SESSION['nik'];
    $tanggal_presensi_masuk = $_POST['tanggal_presensi_masuk'];

    $add_status = $proses->InputMasuk($id_presensi, $nik, $tanggal_presensi_masuk);
    if ($add_status) {
        echo "<script>
            alert('Presensi Telah Berhasil, Selamat Bekerja');
            location='index.php';
        </script>";
    }
}

if (isset($_POST['logout'])) {
    $id_presensi = $_POST['id_presensi'];
    $tanggal_presensi_keluar = $_POST['tanggal_presensi_keluar'];

    $add_status = $proses->InputKeluar($id_presensi, $tanggal_presensi_keluar);
    if ($add_status) {
        echo "<script>
            alert('Presensi Telah Berhasil, Selamat Beristirahat');
            location='index.php';
        </script>";
    }
}

include_once "item/db_connect.php";
$it = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_divisi = 1");
$finance = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_divisi = 2");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard <?php echo $_SESSION['role'] ?></title>
    <?php include_once "item/head.php" ?>
</head>

<body id="page-top" onload="startTime()">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include_once "item/sidebar.php" ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include_once "item/topbar.php" ?>

                <?php
                if ($_SESSION['role'] == 'admin') {
                ?>
                    <div class="container-fluid row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Div. IT</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo mysqli_num_rows($it); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-wrench fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Div. Finance</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo mysqli_num_rows($finance); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php
                }
                ?>

                <?php
                if ($_SESSION['role'] == 'karyawan') {
                ?>
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-users"></i> Silakan Presensi</h1>
                        <hr>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Presensi Karyawan</h6>
                                <br>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>Jam</th>
                                        <th>Absen Masuk</th>
                                        <th>Absen Keluar</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h3 class="nav-link text-dark">
                                                    <div id="clock2"></div>
                                                </h3>
                                            </td>
                                            <td>
                                                <form class="needs-validation" method="post" novalidate="">
                                                    <?php $tglid = date("Y-m-d");
                                                    $tgl = date("Y-m-d h:i:s"); ?>
                                                    <input type="hidden" class="form-control" id="id_presensi" name="id_presensi" value="<?php echo $_SESSION['nik'];
                                                                                                                                            echo $tglid; ?>">
                                                    <input type="hidden" class="form-control" id="nik" name="nik" value="<?php echo $_SESSION['nik'] ?>">
                                                    <input type="hidden" class="form-control" id="tanggal_presensi_masuk" name="tanggal_presensi_masuk" value="<?php echo $tgl ?>">
                                                    <button class="btn btn-info" type="login" name="login">Presensi masuk</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form class="needs-validation" method="post" novalidate="">
                                                    <?php $tglid = date("Y-m-d");
                                                    $tgl_out = date("Y-m-d h:i:s"); ?>
                                                    <input type="hidden" class="form-control" id="id_presensi" name="id_presensi" value="<?php echo $_SESSION['nik'];
                                                                                                                                            echo $tglid; ?>">
                                                    <input type="hidden" class="form-control" id="tanggal_presensi_keluar" name="tanggal_presensi_keluar" value="<?php echo $tgl_out ?>">
                                                    <button class="btn btn-danger" type="logout" name="logout">Presensi Keluar</button>
                                                </form>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                <?php
                }
                ?>

            </div>
            <!-- End of Main Content -->

            <?php include_once "item/footer.php" ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php include_once "item/logout-modal.php" ?>
    <?php include_once "item/script.php" ?>
</body>

</html>