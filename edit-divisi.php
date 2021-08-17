<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}
?>

<?php
$get_id_divisi = $_GET['get_id_divisi'];
include_once "item/db_connect.php";
include_once "proses.php";
$sql = mysqli_query($con, "SELECT nama_divisi FROM tbl_divisi WHERE id_divisi = '" . $get_id_divisi . "'");
$x = mysqli_fetch_row($sql);

$proses = new Presensi;
if (isset($_POST['submit'])) {
    $update = $proses->UpdateDivisi($get_id_divisi, $_POST['nama_divisi']);
    if ($update) {
        echo "<script>alert('Data Divisi berhasil diupdate');window.location = 'data-divisi.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Divisi</title>
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
                <br><br>
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-server"></i> Edit Divisi</h1>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-server"></i> Edit Divisi</h6>
                            <br>
                        </div>
                        <div class="card-body">
                            <section class="hk-sec-wrapper">
                                <div class="row">
                                    <div class="col-sm">
                                        <form class="needs-validation" method="post" novalidate="">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="nama_divisi">Nama Divisi</label>
                                                    <input type="text" class="form-control" id="nama_divisi" value="<?php echo $x[0] ?>" name="nama_divisi" required="">
                                                    <div class="invalid-feedback">Please provide a valid Division Name.</div>
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </section>
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