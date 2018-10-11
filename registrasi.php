<?php
session_start();
if (isset($_SESSION['pesan_error_registrasi'])) {
	foreach ($_SESSION['pesan_error_registrasi'] as $error) {
		echo $error . "<br>";
	}
	unset($_SESSION['pesan_error_registrasi']);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Registrasi</title>
	</head>
	<body>
		<form action="controller/proses_registrasi.php?proses=registrasi" method="POST" enctype="multipart/form-data">
			<table>
				<tr>
					<td valign="top">Nama</td>
					<td><input type="text" name="nama" placeholder="Nama" value="<?php echo isset($_SESSION["post_data"]["nama"]) ? $_SESSION["post_data"]["nama"] : ''; ?>" required></td>
				</tr>
				<tr>
					<td valign="top">Jenis Kelamin</td>
					<td>
						<input type="radio" name="jenis_kelamin" value="L" <?php echo isset($_SESSION["post_data"]["jenis_kelamin"]) && $_SESSION["post_data"]["jenis_kelamin"] == "L" ? "checked" : ''; ?>> Laki - Laki <br>
						<input type="radio" name="jenis_kelamin" value="P" <?php echo isset($_SESSION["post_data"]["jenis_kelamin"]) && $_SESSION["post_data"]["jenis_kelamin"] == "P" ? "checked" : ''; ?>> Perempuan
					</td>
				</tr>
				<tr>
					<td valign="top">Tanggal Lahir</td>
					<td><input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo isset($_SESSION["post_data"]["tanggal_lahir"]) ? $_SESSION["post_data"]["tanggal_lahir"] : ''; ?>" required></td>
				</tr>
				<tr>
					<td valign="top">Foto</td>
					<td><input type="file" name="foto"  placeholder="Foto" accept="image/*" value="<?php echo isset($_SESSION["post_data"]["foto"]) ? $_SESSION["post_data"]["foto"] : ''; ?>" required></td>
				</tr>
				<tr>
					<td valign="top">Username</td>
					<td><input type="text" name="username" placeholder="Username" value="<?php echo isset($_SESSION["post_data"]["username"]) ? $_SESSION["post_data"]["username"] : ''; ?>" required></td>
				</tr>
				<tr>
					<td valign="top">Password</td>
					<td><input type="password" name="password" placeholder="Password" required></td>
				</tr>
				<tr>
					<td valign="top">Konfirmasi Password</td>
					<td><input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" required></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
