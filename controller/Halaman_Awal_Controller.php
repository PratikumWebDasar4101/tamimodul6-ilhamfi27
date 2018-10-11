<?php
require_once '/../models/User.php';
/**
 * class untuk halamanawal
 */
class Halaman_Awal_Controller {
    private $user;
	public function __construct(){
        $this -> user = new User();
	}

    public function show_user_details($id) {
        // return array
        return $this -> user -> user_details($id);
    }
}
