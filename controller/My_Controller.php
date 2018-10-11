<?php
/**
 *
 */
class My_Controller{
    public function time_and_random(){
        return date("YmdHis") . "" . rand(10000, 99999) . "_";
    }
}
