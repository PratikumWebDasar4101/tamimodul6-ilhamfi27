<?php
require_once ('My_Model.php');
/**
 *
 */
class Post extends My_Model{
    public function insert_post($judul, $konten, $gambar, $id) {
        $date_now = date("Y-m-d");
        $query =    "INSERT INTO `post` (
                      `judul`,
                      `id_penulis`,
                      `cerita`,
                      `tanggal`,
                      `gambar`
                    )
                    VALUES
                      (
                        '$judul',
                        '$id',
                        '$konten',
                        '$date_now',
                        '$gambar'
                      );
                    ";
		$query_success = mysqli_query($this -> conn, $query);
        if($query_success){
            return true;
        } else {
            return false;
        }
    }

    public function all_posts() {
        $query = "SELECT
                  `post`.`id` AS 'id',
                  `judul`,
                  `user`.`nama` AS 'nama',
                  `cerita`,
                  `tanggal`,
                  `gambar`
                FROM
                  `post`
                INNER JOIN `user` ON `post`.`id_penulis` = `user`.`id`
                ";
        $data = array();
        $result = mysqli_query($this -> conn, $query);
        while($d = mysqli_fetch_array($result)){
            array_push($data, $d);
        }
        return $data;
    }

    public function user_posts($id) {
        $query = "SELECT
                  `post`.`id` AS 'id',
                  `judul`,
                  `user`.`nama` AS 'nama',
                  `cerita`,
                  `tanggal`,
                  `gambar`
                FROM
                  `post`
                INNER JOIN `user` ON `post`.`id_penulis` = `user`.`id`
                WHERE `post`.`id_penulis` = '$id'
                ";
        $data = array();
        $result = mysqli_query($this -> conn, $query);
        while($d = mysqli_fetch_array($result)){
            array_push($data, $d);
        }
        return $data;
    }
}
