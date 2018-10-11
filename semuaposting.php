<?php
require_once 'controller/Proses_Posting.php';
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
$pp = new Proses_Posting();
$id = $_SESSION['id'];
if(!isset($_SESSION['id'])){
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
		<link rel="stylesheet" href="vendor/mystyle.css">
        <title>Semua Postingan</title>
    </head>
	<body>
		<?php include_once 'navigation.php'; ?>
		<div class="container">
			<div class="row">
				<div class="col-12">
                    <table>
                        <?php
                        foreach ($pp -> show_posts() as $d) {
                        ?>
                        <tr>
                            <td><?php echo $d['nama'] ?></td>
                            <td align="right"><?php echo $d['tanggal'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><?php echo $d['judul']; ?></td>
                        </tr>
                        <tr style="min-height: 200px;">
                            <td colspan="2" style="width:100%;"><?php echo $d['cerita']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="height:50px;"></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
				</div>
			</div>
		</div>
	</body>
</html>
