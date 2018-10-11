<?php
require_once 'controller/Proses_Registrasi.php';
if (isset($_SESSION['pesan_error_update_registrasi'])) {
	foreach ($_SESSION['pesan_error_update_registrasi'] as $error) {
		echo $error . "<br>";
	}
	unset($_SESSION['pesan_error_update_registrasi']);
}
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
if(!isset($_SESSION['id'])){
    header('location: login.php');
}
$pr = new Proses_Registrasi();
$d = $pr -> show_user_data($id);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="vendor/mystyle.css">
		<title>Registrasi</title>
	</head>
	<body>
		<?php include_once 'navigation.php'; ?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<form action="controller/proses_registrasi.php?proses=update_profil" method="POST" enctype="multipart/form-data">
			            <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
						<table>
							<tr>
								<td valign="top">Nama</td>
								<td><input type="text" name="nama" placeholder="Nama" value="<?php echo $d['nama']; ?>" required></td>
							</tr>
							<tr>
								<td valign="top">Jenis Kelamin</td>
								<td>
									<input type="radio" name="jenis_kelamin" value="L" <?php echo $d['jenis_kelamin'] == "L" ? "checked" : ''; ?>> Laki - Laki <br>
									<input type="radio" name="jenis_kelamin" value="P" <?php echo $d['jenis_kelamin'] == "P" ? "checked" : ''; ?>> Perempuan
								</td>
							</tr>
							<tr>
								<td valign="top">Tanggal Lahir</td>
								<td><input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $d['tanggal_lahir']; ?>" required></td>
							</tr>
							<tr>
								<td valign="top">Foto</td>
								<td><input type="file" name="foto"  placeholder="Foto" accept="image/*"></td>
							</tr>
							<tr>
								<td valign="top">Username</td>
								<td><input type="text" name="username" placeholder="Username" value="<?php echo $d['username']; ?>" required></td>
							</tr>
							<tr>
								<td valign="top">Password</td>
								<td><input type="password" name="password" placeholder="Password"></td>
							</tr>
							<tr>
								<td valign="top">Konfirmasi Password</td>
								<td><input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password"><br>Kosongkan Jika Tidak Diganti</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" name="submit" value="Submit">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
