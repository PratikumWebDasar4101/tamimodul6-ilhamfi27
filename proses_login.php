<?php
session_start();
require_once 'models/User.php';
$u = new User();

if (isset($_POST['submit'])) {
	$username	= isset($_POST['username']) ? $_POST['username'] : "";
	$password	= isset($_POST['password']) ? md5($_POST['password']) : "";

	$data = $u -> user_exist($username, $password);
	if ($data['user_exist'] > 0) {
		$_SESSION['username'] = $data['username'];
		$_SESSION['nama'] = $data['nama'];
		header('location: beranda.php');
	} else {
		$_SESSION['pesan_login_registrasi'] = "Username atau Password Salah atau Akun Belum Terdaftar";
		header('location: login.php');
	}
}
?>
