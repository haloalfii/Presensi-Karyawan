<?php
session_start();
include_once('item/db_connect.php');
$database = new database();

if (isset($_SESSION['is_login'])) {
    header('location:index.php');
}

if (isset($_POST['btnlogin'])) {
    $nik = $_POST['nik'];
    $password = $_POST['password'];

    if ($nik !== $database->cekNik($nik)) {
        echo "<script>
        alert('nik atau password salah');
        </script>";
        echo "<script>
        location='login.php';
        </script>";
        echo "<script>
        location.reload(login.php);
        </script>";
    }

    if ($database->login($nik, $password)) {
        header('location:index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once "item/head.php";
    ?>
    <title>Login</title>
</head>

<body class="bg-gradient-info">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="img/nbs-icon.PNG" style="margin-top: 125px; margin-left: 150px; width: 200px; height: 200px">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4 text-dark">NBS</h1>
                                        <p class="text-dark"> Silahkan Login untuk Presensi</p>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="nik" class="form-control form-control-user" id="nik" aria-describedby="nik" placeholder="NIK.." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <button name="btnlogin" class="btn btn-info btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small text-dark" href="register.php">Belum Punya Akun? Daftar Disini!</a>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
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