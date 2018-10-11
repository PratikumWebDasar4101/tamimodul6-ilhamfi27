<?php
require_once ('My_Model.php');

class User extends My_Model{
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
        $query = "SELECT `id`, `username`, `nama` FROM `user` WHERE username = '$username' OR password = '$password'";
    	$result = mysqli_query($this -> conn, $query);
    	$user_exist = mysqli_num_rows($result);
        $user_data = mysqli_fetch_array($result);
        $result = array(
                'user_exist' => $user_exist,
				'id' => $user_data[0],
                'username' => $user_data[1],
                'nama' => $user_data[2]
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

    public function update_user($id, $username, $password, $nama, $jenis_kelamin, $tanggal_lahir, $photo_url){
		$query = "UPDATE
				  `user`
				SET
				  `username` = '$username',
				  `password` = '$password',
				  `nama` = '$nama',
				  `jenis_kelamin` = '$jenis_kelamin',
				  `tanggal_lahir` = '$tanggal_lahir',
				  `foto` = '$photo_url'
				WHERE `id` = '$id';
				";
		$query_success = mysqli_query($this -> conn, $query);
        if($query_success){
            return true;
        } else {
            return mysqli_error($this -> conn);
        }
    }

	public function user_details($id){
        $query = "SELECT `id`, `username`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `foto` FROM `user` WHERE id = '$id'";
    	$result = mysqli_query($this -> conn, $query);
        $user_data = mysqli_fetch_array($result);
		$jenis_kelamin = "";
        $result = array(
				'id' => $user_data[0],
                'username' => $user_data[1],
				'nama' => $user_data[2],
				'jenis_kelamin' => $user_data[3],
				'tanggal_lahir' => $user_data[4],
				'foto' => $user_data[5]
            );
        return $result;
	}
}
