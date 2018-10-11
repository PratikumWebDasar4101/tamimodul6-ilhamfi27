<?php
include_once('koneksi.php');
/**
 *  model core
 */
class My_Model {
    protected $conn;
    public function __construct(){
		$this->conn = $GLOBALS['conn'];
    }
}
