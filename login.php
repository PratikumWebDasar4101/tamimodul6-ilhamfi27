<?php
session_start();
if (isset($_SESSION['pesan_error_login'])) {
	echo $_SESSION['pesan_error_login'];
	unset($_SESSION['pesan_error_login']);
}
if(isset($_SESSION['id'])){
    header('location: halamanawal.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Login</title>
	</head>
	<body>
		<form action="controller/proses_login.php" method="POST" enctype="multipart/form-data">
			<table>
				<tr>
					<td valign="top">Username</td>
					<td><input type="text" name="username" required></td>
				</tr>
				<tr>
					<td valign="top">Password</td>
					<td><input type="password" name="password" required></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
		Registrasi di <a href="registrasi.php">Sini</a>!
	</body>
</html>
