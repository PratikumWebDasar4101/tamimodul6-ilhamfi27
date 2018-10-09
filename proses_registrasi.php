<?php
session_start();
include_once 'koneksi.php';
require_once 'models/User.php';

$u = new User();
if (isset($_POST['submit'])) {
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

	if(!$u -> username_exist($username)){
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
	$file_move_success = move_uploaded_file($tmp_name, "../multimedia_storage/images/" . $time_and_random_numbers . $file_name);
	$photo_url = $time_and_random_numbers . $file_name;

	if ($file_move_success < 1) {
		array_push($error_messages, "File Error Di Upload!");
		$error++;
	}

	if ($error < 1) {
		if ($u -> new_user($username, $password, $nama, $jenis_kelamin, $tanggal_lahir, $photo_url)) {
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $nama;
			unset($_SESSION['post_data']);
			header('location: login.php');
		} else {
			array_push($error_messages, mysqli_error($conn));
			$_SESSION['pesan_error_registrasi'] = $error_messages;
			header('location: registrasi.php');
		}
	} else {
		$_SESSION['post_data'] = $_POST;
		array_merge($_SESSION['post_data'], array("foto" => $_FILES['foto']['name']));
		$_SESSION['pesan_error_registrasi'] = $error_messages;
		header('location: registrasi.php');
	}
}
