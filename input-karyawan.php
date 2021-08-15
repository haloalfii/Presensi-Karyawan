<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}

include_once('item/db_connect.php');
$database = new database();


if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $id_divisi = $_POST['id_divisi'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $nama_gambar = "";

    if (empty($nik)) {
        echo '<div class="container mb-n4 text-center">
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 NIK Harus Diisi
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>
             </div>';
    }
    if (empty($nama)) {
        echo '<div class="container mb-n4 text-center">
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 Nama Harus Diisi
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>
             </div>';
    }
    if (empty($id_divisi)) {
        echo '<div class="container mb-n4 text-center">
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 Divisi Harus Diisi
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>
             </div>';
    }
    if (empty($email)) {
        echo '<div class="container mb-n4 text-center">
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 Email Harus Diisi
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>
             </div>';
    }
    if (empty($password)) {
        echo '<div class="container mb-n4 text-center">
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 password Harus Diisi
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>
             </div>';
    }
    if (empty($no_hp)) {
        echo '<div class="container mb-n4 text-center">
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 Nomor Telepon Harus Diisi
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>
             </div>';
    } else {
        if ($database->cekRegisterEmail($email)) {
            echo '<div class="container mb-n4 text-center">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Email Sudah Terdaftar
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            </div>';
        } else if ($database->cekRegisterNik($nik)) {
            echo '<div class="container mb-n4 text-center">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Username Sudah Terdaftar
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            </div>';
        } else {
            $database->register($nik, $id_divisi, $nama, $no_hp, $email, $password, $nama_gambar, $role);
            echo "<script>alert('Berhasil Mendaftarkan Karyawan');window.location = 'data-karyawan.php';</script>";
        }
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
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-users mr-2"></i>Input Data Karyawan</h1>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users mr-2"></i> Data Karyawan</h6>
                            <br>
                        </div>
                        <div class="card-body">
                            <section class="hk-sec-wrapper">

                                <div class="row">
                                    <div class="col-sm">
                                        <form class="needs-validation" method="post" novalidate="">
                                            <input type="hidden" name="role" class="form-control form-control-user" id="karyawan" value="karyawan">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="nik">NIK</label>
                                                    <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik" required="">
                                                    <div class="invalid-feedback">Please provide a valid NIK.</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="Nama">Nama Karyawan</label>
                                                    <input type="text" class="form-control" id="nama" placeholder="Nama Karyawan" name="nama" required="">
                                                    <div class="invalid-feedback">Please provide a valid Nama Karyawan.</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Divisi</label>
                                                    <select name="id_divisi" id="id_divisi" class="form-control">
                                                        <option value="">Pilih Divisi..</option>
                                                        <?php
                                                        include_once "item/db_connect.php";
                                                        $row = mysqli_query($con, "SELECT * FROM tbl_divisi");
                                                        foreach ($row as $data) {
                                                        ?>
                                                            <option value="<?php echo $data['id_divisi'] ?>"><?php echo $data['nama_divisi'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="invalid-feedback">Please provide a valid Nama Mahasiswa.</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Email</label>
                                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required="">
                                                    <div class="invalid-feedback">Please provide a valid Email.</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Password</label>
                                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required="">
                                                    <div class="invalid-feedback">Please provide a valid Password.</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">No Hp</label>
                                                    <input type="text" class="form-control" id="no_hp" placeholder="No Hp" name="no_hp" required="">
                                                    <div class="invalid-feedback">Please provide a valid No Hp.</div>
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