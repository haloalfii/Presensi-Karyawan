<?php
include_once('item/db_connect.php');
$database = new database();

if (isset($_POST['btn-signup'])) {
    $nik = $_POST['nik'];
    $id_divisi = $_POST['id_divisi'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sumber = $_FILES['foto']['tmp_name'];
    $target = 'file/';
    $nama_gambar = $_FILES['foto']['name'];
    $pindah = move_uploaded_file($sumber, $target . $nama_gambar);

    $role = $_POST['role'];

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
            echo '<div class="container mb-n4 text-center">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Register Berhasil
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            </div>';
            echo '<meta http-equiv="refresh" content="2;url=login.php">';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once "item/head.php";
    ?>
    <title>Daftar</title>
</head>

<body class="bg-gradient-info">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block">
                        <img src="img/nbs-icon.PNG" style="margin-top: 200px; margin-left: 100px; height: 300px; width: 300px">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Mendaftar</h1>
                            </div>
                            <form class="user" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="role" class="form-control form-control-user" id="karyawan" value="karyawan">
                                <div class="form-group" id="inputan">
                                    <label>NIK <strong class="text-danger">*</strong></label>
                                    <input type="text" name="nik" class="form-control form-control-user" id="nik" placeholder="NIK..." value="<?= empty($nik) ? '' : $nik; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Nama <strong class="text-danger">*</strong></label>
                                    <input type="text" name="nama" class="form-control form-control-user" id="nama" placeholder="Nama..." value="<?= empty($nama) ? '' : $nama; ?>">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 mb-10">
                                        <label for="validationCustom03">Divisi</label>
                                        <select name="id_divisi" id="id_divisi" class="form-control rounded-pill" style="height: 50px;">
                                            <option value="">Pilih Divisi..</option>
                                            <?php
                                                include_once "item/db_connect.php";
                                                $row = mysqli_query($con, "SELECT * FROM tbl_divisi");
                                                foreach ($row as $data) {
                                            ?>
                                            <option value="<?php echo $data['id_divisi']?>"><?php echo $data['nama_divisi']?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Please provide a valid Nama Mahasiswa.</div>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label>Email <strong class="text-danger">*</strong></label>
                                    <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email.." value="<?= empty($email) ? '' : $email; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Password <strong class="text-danger">*</strong></label>
                                    <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>No Telepon <strong class="text-danger">*</strong></label>
                                    <input type="text" name="no_hp" class="form-control form-control-user" id="no_hp" placeholder="No Telepon..." value="<?= empty($no_hp) ? '' : $no_hp; ?>">
                                </div>
                                <div class="field image">
                                    <label>Select Image <strong class="text-danger">*</strong></label>
                                    <input type="file" name="foto" accept="image/gif,image/jpeg,image/jpg,image/png,">
                                </div>
                                <button type="submit" id="btn-signup" name="btn-signup" class="btn btn-info btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="login.php">Sudah memiliki Akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>