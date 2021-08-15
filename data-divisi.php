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
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-server"></i> Data Divisi</h1>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-server"></i> Data Divisi</h6>
                            <br>

                            <a class="btn btn-success" href="export-mhs.php">
                                <i class="fa fa-download fa-fw"></i> Export Data
                            </a>
                            <a class="btn btn-success" href="input-divisi.php">
                                <i class="fa fa-plus fa-fw"></i> Input Data
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th width="40%">Nama Divisi</th>
                                            <th width="30%">Jumlah Karyawan</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $number = 1;
                                        
                                        include_once "proses.php";
                                        $presensi = new Presensi;
                                        $row = $presensi->GetDivisi();
                                        foreach ($row as $row) {
                                        ?>
                                            <tr>
                                                <td><?php echo $number++ ?></td>
                                                <td><?php echo $row['nama_divisi'] ?></td>
                                                <td>
                                                    <?php
                                                    include_once "item/db_connect.php";
                                                    $id = $row['id_divisi'];
                                                    $jumlah = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_divisi = '$id'");
                                                    echo mysqli_num_rows($jumlah);
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="edit-divisi.php?get_id_divisi=<?=$row['id_divisi']?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-original-title="Edit">Edit</a>
                                                    <a href="hapus-divisi.php?get_id_divisi=<?= $row['id_divisi'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus Divisi <?php echo $row['nama_divisi'] ?>?');" data-toggle="tooltip" data-original-title="Hapus" class="btn btn-danger btn-xs">Delete</i></a>
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