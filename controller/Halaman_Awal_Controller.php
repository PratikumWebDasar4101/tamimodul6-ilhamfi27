<?php
require_once '/../models/User.php';
require_once '/../models/Post.php';
/**
 * class untuk halamanawal
 */
class Halaman_Awal_Controller {
    private $user;
    private $post;
	public function __construct(){
        $this -> user = new User();
        $this -> post = new Post();
	}

    public function show_user_details($id) {
        return $this -> user -> user_details($id);
    }

    public function show_user_title_story($id) {
        return $this -> post -> posts_titles($id);
    }
}
