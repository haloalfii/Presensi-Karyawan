<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
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
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-users"></i> Detail Presensi</h1>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Presensi Karyawan</h6>
                            <br>
        
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" method="post" novalidate="" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col-md-2 mb-10">
                                        <label for="validationCustom03">Nama Karyawan</label>
                                        <select name="nik" id="nik" class="form-control">
                                            <option value="all">-- Pilih Karyawan --</option>
                                            <?php
                                            include_once "item/db_connect.php";
                                            $row = mysqli_query($con, "SELECT * FROM tbl_user");
                                            foreach ($row as $nik) {
                                            ?>
                                                <option value="<?php echo $nik['nik'] ?>"><?php echo $nik['nama'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" style="margin-top: 32px;" type="cari" name="cari">Submit</button>
                                </div>
                            </form>

                            <form target="blank" action="export-laporan.php" method="POST">
                                <?php
                                if (isset($_POST["cari"])) {
                                    $getnik = $_POST['nik'];
                                    echo "<input type='hidden' name='nik' value='$getnik'>";
                                } 
                                ?>
                                <button type="submit" name="excel" value="excel" class="btn btn-success mt-4"><i class="fa fa-download fa-fw"></i> Export Data</button>
                            </form>
                            <br />
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th width="20%">Nama</th>
                                            <th width="10%">Divisi</th>
                                            <th width="20%">Detail Masuk</th>
                                            <th width="20%">Detail Keluar</th>
                                            <th width="20%">Laporan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $number = 1;

                                        include_once "proses.php";
                                        $proses = new Presensi;
                                        if (isset($_POST['cari'])) {
                                            if ($_POST['nik'] == "all"){
                                                $laporan = $proses->GetPresensiAll();
                                            }
                                            else if ($_POST['nik']) {
                                                $choosenik = $_POST['nik'];
                                                $laporan = $proses->GetPresensi($choosenik);
                                            }
                                        } 
                                        else {
                                            $laporan = $proses->GetPresensiAll();
                                        }

                                        foreach ($laporan as $laporan) {
                                        ?>
                                            <tr>
                                                <td><?php echo $number++ ?></td>
                                                <td><?php echo $laporan['nama'] ?></td>
                                                <td>
                                                    <?php
                                                    include_once "item/db_connect.php";
                                                    $division = mysqli_query($con, "SELECT nama_divisi FROM tbl_divisi WHERE id_divisi = '" . $laporan['id_divisi'] . "'");
                                                    $output = mysqli_fetch_row($division);
                                                    echo $output[0];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $laporan['tanggal_presensi_masuk'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $laporan['tanggal_presensi_keluar'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $laporan['laporan'] ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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