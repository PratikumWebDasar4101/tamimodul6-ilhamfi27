<?php
session_start();
$id = $_SESSION['id'];
require_once '/../models/Post.php';
require_once 'My_Controller.php';
/**
 *
 */
class Proses_Posting extends My_Controller{
    private $post;
	public function __construct(){
        $this -> post = new Post();
	}

    public function story_minimum_word($story) {
        $words = explode(" ", $story);
        if ($words < 30) {
            return false;
        } else {
            return true;
        }
    }

    public function new_post($judul, $konten, $gambar, $id) {
        return $this -> post -> insert_post($judul, $konten, $gambar, $id);
    }

    public function show_posts(){
        return $this -> post -> all_posts();
    }

    public function show_user_posts($id){
        return $this -> post -> user_posts($id);
    }
}
$pp = new Proses_Posting();
if (isset($_GET['aksi'])) {
    switch ($_GET['aksi']) {
        case 'post_cerita':
            $judul 	= isset($_POST['judul']) ? $_POST['judul'] : "";
            $konten = isset($_POST['konten']) ? $_POST['konten'] : "";
            $gambar = isset($_FILES['gambar']) ? $_FILES['gambar'] : "";

    		$file_name	= "_post_".implode("_",array_map('strtolower', explode(" ", $gambar['name'])));
    		$tmp_name	= $gambar['tmp_name'];
    		$file_error	= $gambar['error'];

			$error = 0;
			$error_messages = array();

            $time_and_random_numbers = $pp -> time_and_random();
            $photo_url = "";

            if($file_error > 0){
				array_push($error_messages, "File Error!");
				$error++;
			} else {
                $file_move_success = move_uploaded_file($tmp_name, "../../multimedia_storage/images/" . $time_and_random_numbers . $file_name);
                $photo_url = $time_and_random_numbers . $file_name;
                if ($file_move_success < 1) {
                    array_push($error_messages, "File Error Di Upload!");
                    $error++;
                }
            }


            if (!$pp -> story_minimum_word($konten)) {
				array_push($error_messages, "Kata Dalam Konten Kurang Dari 30 Kata!");
				$error++;
            }

    		if ($error < 1) {
                $query_result = $pp -> new_post($judul, $konten, $photo_url, $id);
                if ($query_result) {
    				header('location: ../semuaposting.php');
    			} else {
                    array_push($error_messages, $query_result);
                    $_SESSION['pesan_error_registrasi'] = $error_messages;
    				header('location: ../posting.php');
    			}
    		} else {
    			$_SESSION['pesan_error_registrasi'] = $error_messages;
    			header('location: ../posting.php');
            }

            break;
        default:
            break;
    }
}
