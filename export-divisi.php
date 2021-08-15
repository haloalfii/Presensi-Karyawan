<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data-Divisi.xls");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Export Data Ke Excel Dengan PHP</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>
    <center>
        <h2>NBS Division</h2>
    </center>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="40%">Nama Divisi</th>
                <th width="30%">Jumlah Karyawan</th>
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
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>