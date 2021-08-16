<?php
include_once "proses.php";
$proses = new Presensi;

if (isset($_POST['excel'])) {
    if (isset($_POST['nik'])) {
        $getnik = $_POST['nik'];
        if ($getnik == "all") {
            $row = $proses->GetPresensiAll();
        } else {
            $row = $proses->GetPresensi($getnik);
        }
    } else {
        $row = $proses->GetPresensiAll();
    }
}
?>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data-Karyawan $getnik .xls");
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
        <h2>Laporan Karyawan</h2>
    </center>

    <table border="1" id="dataTable" width="100%" cellspacing="0">
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
            foreach ($row as $row) {
            ?>
                <tr>
                    <td><?php echo $number++ ?></td>
                    <td><?php echo $row['nama'] ?></td>
                    <td>
                        <?php
                        include_once "item/db_connect.php";
                        $division = mysqli_query($con, "SELECT nama_divisi FROM tbl_divisi WHERE id_divisi = '" . $row['id_divisi'] . "'");
                        $output = mysqli_fetch_row($division);
                        echo $output[0];
                        ?>
                    </td>
                    <td>
                        <?php echo $row['tanggal_presensi_masuk'] ?>
                    </td>
                    <td>
                        <?php echo $row['tanggal_presensi_keluar'] ?>
                    </td>
                    <td>
                        <?php echo $row['laporan'] ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>