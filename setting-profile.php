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
    <?php
    include_once "item/head.php";
    ?>
    <title>Data Mahasiswa</title>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        include_once "item/sidebar.php";
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php
                include_once "item/topbar.php";
                ?>

                <div class="container">
                    <?php
                    if (isset($_POST['submit'])) {

                        // Ambil data foto yang dipilih dari form
                        $sumber = $_FILES['foto']['name'];

                        $nama_gambar = $_FILES['foto']['tmp_name'];
                        // Rename nama fotonya dengan menambahkan tanggal dan jam upload
                        $fotobaru = date('dmYHis') . $sumber;

                        // Set path folder tempat menyimpan fotonya

                        $path = "file/" . $fotobaru;



                        if (move_uploaded_file($nama_gambar, $path)) { // Cek apakah gambar berhasil diupload atau tidak
                            // Cek apakah file gambar sebelumnya ada di folder foto

                            if (is_file("file/" . $data['foto'])) { // Jika gambar ada

                                unlink("file/" . $data['foto']); // Hapus file gambar sebelumnya yang ada di folder images
                            }

                            $update = $proses->UpdateProfilImage($_POST['id_divisi'], $_POST['nama'], $_POST['no_hp'], $_POST['email'], $_POST['password'], $fotobaru, $id);
                            if ($update) {
                                echo '<div class="container mb-n4 text-center">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Profile anda berhasil diupdate
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    </div>';
                                echo '<meta http-equiv="refresh" content="1;url=setting-profile.php">';
                            }
                        }
                        $update = $proses->UpdateProfil($_POST['id_divisi'], $_POST['nama'], $_POST['no_hp'], $_POST['email'], $_POST['password'], $id);
                        if ($update) {
                            echo '<div class="container mb-n4 text-center">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Profile anda berhasil diupdate
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    </div>';
                            echo '<meta http-equiv="refresh" content="1;url=index.php">';
                        }
                    }
                    ?>
                    <!-- Title -->
                    <br><br>
                    <div class="hk-pg-header">
                        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link">
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                        <polyline points="15 3 21 3 21 9"></polyline>
                                        <line x1="10" y1="14" x2="21" y2="3"></line>
                                    </svg></span></span>Edit Profil</h4>
                    </div>
                    <!-- /Title -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <section class="hk-sec-wrapper">
                                <div class="row">
                                    <div class="col-sm">
                                        <form class="needs-validation" method="post" novalidate="" enctype="multipart/form-data">
                                            <img class="img-profile rounded-circle" style="width: 150px; height: 150px" src="file/<?php echo $data['foto']; ?>">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="nim">Nama</label>
                                                    <input type="text" class="form-control" id="nama" value="<?php echo $data['nama']; ?>" name="nama" required="">
                                                    <div class="invalid-feedback">Please provide a valid name.</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Divisi</label>
                                                    <select name="id_divisi" id="id_divisi" class="form-control">
                                                        <?php
                                                        include_once "item/db_connect.php";
                                                        $row = mysqli_query($con, "SELECT * FROM tbl_divisi");
                                                        foreach ($row as $divisi) {
                                                        ?>
                                                            <option value="<?php echo $divisi['id_divisi'] ?>"><?php echo $divisi['nama_divisi'] ?></option>
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
                                                    <input type="email" class="form-control" id="email" value="<?php echo $data['email']; ?>" name="email" required="">
                                                    <div class="invalid-feedback">Please provide a valid Email.</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">No Hp</label>
                                                    <input type="text" class="form-control" id="no_hp" value="<?php echo $data['no_hp']; ?>" name="no_hp" required="">
                                                    <div class="invalid-feedback">Please provide a valid No Hp.</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <label for="validationCustom03">Password</label>
                                                    <input type="text" class="form-control" id="password" value="<?php echo $data['password']; ?>" name="password" required="">
                                                    <div class="invalid-feedback">Please provide a valid Password.</div>
                                                </div>
                                            </div>
                                            <div class="form-row pt-4">
                                                <div class="field image">
                                                    <label>Select Image</label>
                                                    <input type="file" name="foto" accept="image/gif,image/jpeg,image/jpg,image/png,">
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
            <?php
            include_once "item/footer.php";
            ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php
    include_once "item/logout-modal.php";
    ?>
    <?php
    include_once "item/script.php";
    ?>
</body>

</html>