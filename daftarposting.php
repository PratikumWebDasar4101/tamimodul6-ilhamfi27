<?php
require_once 'controller/Proses_Posting.php';
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
$pp = new Proses_Posting();
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
                    <?php
                    foreach ($pp -> show_user_posts($id) as $d) {
                    ?>
                    <div class="row">
                        <div class="col12">
                            <table>
                                <tr>
                                    <td><?php echo $d['nama'] ?></td>
                                    <td><?php echo $d['tanggal'] ?></td>
                                </tr>
                                    <tr>
                                        <td colspan="2" style="width:100%;"><?php echo $d['cerita']; ?></td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
				</div>
			</div>
		</div>
	</body>
</html>
