<?php 

$con = mysqli_connect('localhost', 'root', '', 'presensi_karyawan');

class database{
	var $host = "localhost";
	var $username = "root";
	var $password = "";
	var $database = "presensi_karyawan";
	var $koneksi;
 
	function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
	}
 
	function register($nik, $id_divisi, $nama, $no_hp, $email, $password, $foto, $role)
	{	
		$insert = mysqli_query($this->koneksi,"INSERT INTO tbl_user VALUES ('$nik','$id_divisi','$nama','$no_hp','$email','$password', '$foto', '$role')");
		return $insert;
	}

	// function update($email,$username,$npm, $no_telepon, $image, $password) {
	// 	$update = mysqli_query($this->koneksi, "INSERT INTO tb_user (email, username, npm, no_telepon, image, password) VALUES ('".$email."','".$username."','".$npm."', '".$no_telepon."', '".$image."', '".$password."')
	// 	ON DUPLICATE KEY UPDATE email=VALUES(email), username=VALUES(username), npm=VALUES(npm), no_telepon=VALUES(no_telepon), image=VALUES(image), password=VALUES(password)");
	// 	return $update;
	// }

	function cekRegisterEmail($email)
	{
		$sql_cek = mysqli_query($this->koneksi, "SELECT * FROM tbl_user WHERE email='" . $email . "'");
        $r_cek = mysqli_num_rows($sql_cek);
		return $r_cek;
	}

	function cekRegisterNik($nik)
	{
		$sql_cek = mysqli_query($this->koneksi, "SELECT * FROM tbl_user WHERE nik='" . $nik . "'");
        $user_cek = mysqli_num_rows($sql_cek);
		return $user_cek;
	}

    function SelectDivisi()   
    {
        $sql_cek = mysqli_query($this->koneksi, "SELECT * FROM tbl_divisi");
        return $sql_cek;
    }

	function login($nik,$password)
	{
		$query = mysqli_query($this->koneksi,"SELECT * FROM tbl_user WHERE nik='$nik'");
		$data_user = $query->fetch_array();
		
		if($password === $data_user['password'])
		{
			$_SESSION['nik'] = $nik;
			$_SESSION['nama'] = $data_user['nama'];
			$_SESSION['foto'] = $data_user['foto'];
			$_SESSION['role'] = $data_user['role'];
			$_SESSION['is_login'] = TRUE;
			return TRUE;
		}
	}

	// function adminoruser($npm)
	// {
	// 	$cekrole = mysqli_query($this->koneksi, "SEELCT role FROM tb_user WHERE npm = '$npm'");
	// 	return $cekrole;
	// }

	function cekNik($nik)
	{
		$query = mysqli_query($this->koneksi,"SELECT * FROM tbl_user WHERE nik ='$nik'");
		$user_cek = mysqli_num_rows($query);
		return $user_cek;
	}

	function cekPassword($password)
	{
		$query = mysqli_query($this->koneksi,"SELECT * FROM tbl_user WHERE password ='$password'");
		$user_cek = mysqli_num_rows($query);
		return $user_cek;
	}
}
