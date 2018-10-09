<?php
include_once 'koneksi.php';
class User {
	private $conn;
	public function __construct(){
		$this->conn = $GLOBALS['conn'];
	}
	public function username_exist($username){
		$query = "SELECT `username` FROM `user` WHERE username = '$username'";
		$query_success = mysqli_query($this -> conn, $query);
		if(mysqli_num_rows($query_success) > 0){
			return false;
		} else {
			return true;
		}
	}

    public function user_exist($username, $password){
        $query = "SELECT `username`, `nama` FROM `user` WHERE username = '$username' OR password = '$password'";
    	$result = mysqli_query($this -> conn, $query);
    	$user_exist = mysqli_num_rows($result);
        $user_data = mysqli_fetch_array($result);
        $result = array(
                'user_exist' => $user_exist,
                'username' => $user_data[0],
                'nama' => $user_data[1]
            );
        return $result;
    }

    public function new_user($username, $password, $nama, $jenis_kelamin, $tanggal_lahir, $photo_url){
		$query = "INSERT INTO `user` (
				  `username`,
				  `password`,
				  `nama`,
				  `jenis_kelamin`,
				  `tanggal_lahir`,
				  `foto`
				)
				VALUES
				  (
				    '$username',
				    '$password',
				    '$nama',
				    '$jenis_kelamin',
				    '$tanggal_lahir',
				    '$photo_url'
				  );
				";
		$query_success = mysqli_query($this -> conn, $query);
        if($query_success){
            return true;
        } else {
            return false;
        }
    }
}
