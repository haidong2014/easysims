<?php
class Attendance_m extends MY_Model
{

    public function __construct(){
        parent::__construct();
        $this->CI->load->database();

    }

}