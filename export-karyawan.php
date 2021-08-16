<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data-Karyawan.xls");
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
        <h2>Data Karyawan</h2>
    </center>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="40%">Nama</th>
                <th width="20%">Divisi</th>
                <th width="20%">Email</th>
                <th width="10%">No Telepon</th>
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
                    <td><?php echo $row['nama'] ?></td>
                    <td><?php echo $row['nama_divisi'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['no_hp'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>