<?php
class Presensi
{
    public $presensi;
    public $pdo;

    public function __construct()
    {
        $host = "localhost";
        $database = "presensi_karyawan";
        $user = "root";
        $password = "";
        $this->pdo = new PDO("mysql:host={$host};dbname={$database}", $user, $password);
    }

    public function GetByNik($nik)
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM tbl_user WHERE nik = '" . $nik . "' LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function UpdateProfil($id_divisi, $nama, $no_hp, $email, $password, $id)
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = " UPDATE tbl_user SET id_divisi ='" . $id_divisi . "', nama ='" . $nama . "',  no_hp ='" . $no_hp . "', email ='" . $email . "', password ='" . $password . "' WHERE nik = '" . $id . "'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function UpdateProfilImage($id_divisi, $nama, $no_hp, $email, $password, $fotobaru, $id)
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = " UPDATE tbl_user SET id_divisi ='" . $id_divisi . "', nama ='" . $nama . "',foto ='" . $fotobaru . "',  email ='" . $email . "', no_hp ='" . $no_hp . "', password ='" . $password . "' WHERE nik = '" . $id . "'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        if($stmt)
        {
            $_SESSION['image'] = $fotobaru;
        }
        return $stmt->rowCount();
    }

    public function GetDivisi()
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_divisi";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
?>