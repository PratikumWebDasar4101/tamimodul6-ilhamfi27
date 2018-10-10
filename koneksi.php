<?php
$host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "ta_webdas-6";
$conn = mysqli_connect($host, $db_username, $db_password, $db_name);
if (!$conn) {
	die(mysqli_error($conn));
	mysqli_close();
}
?>
