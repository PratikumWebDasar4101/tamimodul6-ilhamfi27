<?php
require_once 'controller/Halaman_Awal_Controller.php';
session_start();
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
if(!isset($_SESSION['id'])){
    header('location: login.php');
}
$ha = new Halaman_Awal_Controller();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="vendor/mystyle.css">
		<title>Beranda</title>
	</head>
	<body>
		<?php include_once 'navigation.php'; ?>
		<div class="container">
			<div class="row">
				<div class="col-3">
					<table>
                        <?php
                        foreach ($ha -> show_user_title_story($id) as $d) {
                        ?>
                        <tr>
                            <td style="width: 100%;"><a href="#"><?php echo $d['judul']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
				</div>
				<div class="col-9">
					<?php
					$d = $ha -> show_user_details($id);
					?>
					<table>
						<tr>
							<td colspan="2"><img src="../multimedia_storage/images/<?php echo $d['foto']; ?>" width="100"></td>
						</tr>
						<tr>
							<td>Nama</td>
							<td><?php echo $d['nama']; ?></td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td><?php
								if ($d['jenis_kelamin'] == "L") {
									$jenis_kelamin = "Laki -Laki";
								} else {
									$jenis_kelamin = "Perempuan";
								}
								echo $jenis_kelamin;
								?>
							</td>
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td><?php echo $d['tanggal_lahir']; ?></td>
						</tr>
						<tr>
							<td>Username</td>
							<td><?php echo $d['username']; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
