<?php
session_start();
require_once '/../models/User.php';

/**
 * class process registration
 */
class Proses_Registrasi{
    private $user;
	public function __construct(){
        $this -> user = new User();
	}

	public function add_user($username, $password, $nama, $jenis_kelamin, $tanggal_lahir, $photo_url){
		return $this -> user -> new_user($username, $password, $nama, $jenis_kelamin, $tanggal_lahir, $photo_url);
	}

	public function edit_user($id,$username, $password, $nama, $jenis_kelamin, $tanggal_lahir, $photo_url){
		return $this -> user -> update_user($id, $username, $password, $nama, $jenis_kelamin, $tanggal_lahir, $photo_url);
	}

	public function check_username($username){
		return $this -> user -> username_exist($username);
	}

	public function show_user_data($id){
		return $this -> user -> user_details($id);
	}

	public function random_photo_name(){
		return date("YmdHis") . "" . rand(10000, 99999) . "_";
	}
}

$pr = new Proses_Registrasi();
if (isset($_GET['proses'])) {
	switch ($_GET['proses']) {
		case 'registrasi':
			$nama 					= isset($_POST['nama']) ? $_POST['nama'] : "";
			$jenis_kelamin			= isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : "";
			$tanggal_lahir			= isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : "";
			$foto 					= isset($_FILES['foto']) ? $_FILES['foto'] : "";
			$username 				= isset($_POST['username']) ? $_POST['username'] : "";
			$password 				= isset($_POST['password']) ? md5($_POST['password']) : "";
			$konfirmasi_password 	= isset($_POST['konfirmasi_password']) ? md5($_POST['konfirmasi_password']) : "";

			$file_name				= implode("_",array_map('strtolower', explode(" ", $foto['name'])));
			$tmp_name				= $foto['tmp_name'];
			$file_error				= $foto['error'];

			$error = 0;

			$error_messages = array();

			if(!$pr -> check_username($username)){
				array_push($error_messages, "Username Sudah Terpakai!");
				$error++;
			}

			if(strlen($_POST['password']) < 6){
				array_push($error_messages, "Panjang Password Minimal 6 Karakter!");
				$error++;
			}


			if($password != $konfirmasi_password){
				array_push($error_messages, "Konfirmasi Password Salah!");
				$error++;
			}

			if($file_error > 0){
				array_push($error_messages, "File Error!");
				$error++;
			}

			$time_and_random_numbers = date("YmdHis") . "" . rand(10000, 99999) . "_";
			$file_move_success = move_uploaded_file($tmp_name, "../../multimedia_storage/images/" . $time_and_random_numbers . $file_name);
			$photo_url = $time_and_random_numbers . $file_name;

			if ($file_move_success < 1) {
				array_push($error_messages, "File Error Di Upload!");
				$error++;
			}

			if ($error < 1) {
				if ($pr -> add_user($username, $password, $nama, $jenis_kelamin, $tanggal_lahir, $photo_url)) {
					$_SESSION['username'] = $username;
					$_SESSION['nama'] = $nama;
					unset($_SESSION['post_data']);
					header('location: ../login.php');
				} else {
					header('location: ../registrasi.php');
				}
			} else {
				$_SESSION['post_data'] = $_POST;
				array_merge($_SESSION['post_data'], array("foto" => $_FILES['foto']['name']));
				$_SESSION['pesan_error_registrasi'] = $error_messages;
				header('location: ../registrasi.php');
			}
			break;
		case 'update_profil':
			$id 					= isset($_POST['id']) ? $_POST['id'] : "";
			$d = $pr -> show_user_data($id);

			$nama 					= isset($_POST['nama']) ? $_POST['nama'] : "";
			$jenis_kelamin			= isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : "";
			$tanggal_lahir			= isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : "";
			$foto 					= isset($_FILES['foto']) ? $_FILES['foto'] : "";
			$username 				= isset($_POST['username']) ? $_POST['username'] : "";
			$password 				= isset($_POST['password']) ? md5($_POST['password']) : $d['pasword'];
			$konfirmasi_password 	= isset($_POST['konfirmasi_password']) ? md5($_POST['konfirmasi_password']) : $d['pasword'];

			$error = 0;

			$error_messages = array();

			// if(!isset($d['password']) && strlen($_POST['password']) < 6){
			// 	array_push($error_messages, "Panjang Password Minimal 6 Karakter!");
			// 	$error++;
			// }


			if($password != $konfirmasi_password){
				array_push($error_messages, "Konfirmasi Password Salah!");
				$error++;
			}


			if (isset($_FILES['foto'])) {
				$file_name					= implode("_",array_map('strtolower', explode(" ", $foto['name'])));
				$tmp_name					= $foto['tmp_name'];
				$file_error					= $foto['error'];
				$time_and_random_numbers 	= $pr -> random_photo_name();
				$file_move_success = move_uploaded_file($tmp_name, "../../multimedia_storage/images/" . $time_and_random_numbers . $file_name);
				$photo_url = $time_and_random_numbers . $file_name;
				if ($file_move_success < 1) {
					array_push($error_messages, "File Error Di Upload!");
					$error++;
				}
				if($file_error > 0){
					array_push($error_messages, "File Error!");
					$error++;
				}
			} else {
				$photo_url = $d['foto'];
			}

			if ($error < 1) {
				$result = $pr -> edit_user($id, $username, $password, $nama, $jenis_kelamin, $tanggal_lahir, $photo_url);
				echo $result;
				// if ($result) {
				// 	header('location: ../editprofile.php');
				// } else {
				// 	array_push($error_messages, $result);
				// 	header('location: ../editprofile.php');
				// }
			} else {
				$_SESSION['pesan_error_update_registrasi'] = $error_messages;
				header('location: ../editprofile.php');
			}
			break;

		default:
			// code...
			break;
	}
}
