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
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-users"></i> Data Karyawan</h1>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Data Karyawan</h6>
                            <br>

                            <a class="btn btn-success" href="export-divisi.php">
                                <i class="fa fa-download fa-fw"></i> Export Data
                            </a>
                            <a class="btn btn-success" href="input-karyawan.php">
                                <i class="fa fa-plus fa-fw"></i> Input Data
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Karyawan</th>                   
                                            <th>Kontak</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $number = 1;

                                        include_once "proses.php";
                                        $presensi = new Presensi;
                                        $row = $presensi->GetAllKaryawan();
                                        foreach ($row as $row) {
                                        ?>
                                            <tr>
                                                <td><?php echo $number++ ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="ml-4">
                                                            <?php if (empty($row['foto'])) {
                                                                echo '<img style="width: 75px; height: 75px" class="img-profile rounded-circle" src="img/undraw_profile.svg">';
                                                            } else {
                                                                echo '<img style="width: 75px; height: 75px" class="img-profile rounded-circle" src="file/' . $row['foto'] . '">';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="ml-4 mt-2">
                                                            <b><?php echo $row['nama'] ?></b>
                                                            <br>
                                                            Div. <?php echo $row['nama_divisi'] ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="mt-2 ml-4">
                                                        <div>
                                                            Email : <?php echo $row['email'] ?>
                                                        </div>
                                                        <div>
                                                            Telp : <?php echo $row['no_hp'] ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="edit-divisi.php?get_id_divisi=<?= $row['id_divisi'] ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-original-title="Edit">Edit</a>
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