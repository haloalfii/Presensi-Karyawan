<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}
?>

<?php
include('proses.php');
$proses = new Presensi();

if (isset($_POST['submit'])) {
    $id_presensi = $_POST['id_presensi'];
    $laporan = $_POST['laporan'];

    $add_status = $proses->InputLaporan($id_presensi, $laporan);
    if ($add_status) {
        echo "<script>
            alert('Laporan Sudah DI Inputkan, Terimakasih');
            location='index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
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

                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-copy"></i> Input Laporan</h1>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-copy"></i> Input Laporan</h6>
                            <br>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" method="post" novalidate="">
                                <?php $tglid = date("Y-m-d"); ?>
                                <input type="hidden" class="form-control" id="id_presensi" name="id_presensi" value="<?php echo $_SESSION['nik'];
                                                                                                                        echo $tglid; ?>">
                                <div class="form-row">
                                    <div class="col-md-6 mb-10">
                                        <label for="laporan">Submit Laporan</label>
                                        <textarea rows="10" class="form-control" id="laporan" name="laporan" required=""></textarea>
                                        <div class="invalid-feedback">Please provide a valid Division Name.</div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary" type="submit" name="submit">Submit Lapotan</button>
                            </form>
                        </div>
                    </div>

                </div>

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