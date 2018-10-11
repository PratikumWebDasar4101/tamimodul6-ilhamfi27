<?php
session_start();
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
        <title>Post Cerita</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="controller/Proses_Posting.php?aksi=post_cerita" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td valign="top">Judul</td>
                                <td><input type="text" name="judul" required></td>
                            </tr>
                            <tr>
                                <td valign="top">Konten</td>
                                <td><textarea name="konten" rows="20" cols="80" required></textarea></td>
                            </tr>
                            <tr>
                                <td valign="top">Gambar</td>
                                <td><input type="file" name="gambar"></td>
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
