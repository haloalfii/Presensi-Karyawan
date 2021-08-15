<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}
?>

<?php
//tampilkan data sesuai NIK
include_once 'proses.php';
$proses = new Presensi;
$id = $_SESSION['nik'];

$data = $proses->GetByNik($id);
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
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-users"></i> Data Diri</h1>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Data Diri Karyawan</h6>
                            <br>
                        </div>
                        <div class="card-body">
                            <table border="0" width="50%">
                                <tr>
                                    <td rowspan="6" width="20%">
                                        <?php if (empty($_SESSION['foto'])) {
                                            echo '<img style="width: 120px; height: 120px;" class="img-profile rounded-circle ml-4" src="img/undraw_profile.svg">';
                                        } else {
                                            echo '<img style="width: 120px; height: 120px" class="img-profile rounded-circle ml-4" src="file/' . $data['foto'] . '">';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td> : </td>
                                    <td><?php echo $data['nama'];?></td>
                                </tr>
                                <tr>
                                    <td>Divisi</td>
                                    <td> : </td>
                                    <td>
                                        <?php 
                                            include_once "item/db_connect.php";
                                            $sql = mysqli_query($con, "SELECT nama_divisi from tbl_divisi WHERE id_divisi = '".$data['id_divisi']."'");
                                            $x = mysqli_fetch_row($sql);
                                            echo $x[0];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td> : </td>
                                    <td><?php echo $data['email'];?></td>
                                </tr>
                                <tr>
                                    <td>No Handphone</td>
                                    <td> : </td>
                                    <td><?php echo $data['no_hp'];?></td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td> : </td>
                                    <td><?php echo $data['role'];?></td>
                                </tr>
                                <tr>
                                    <td><a href="index.php" class="ml-4 mt-4 btn btn-primary">Close</a></td>
                                </tr>
                            </table>
                            
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