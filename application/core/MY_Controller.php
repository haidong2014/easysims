<?php
class MY_Controller extends CI_Controller
{
    function __construct()
    {
       parent::__construct();
       $this->load->database('default');
       $this->load->helper('url');
       $this->load->library('session');
    }
}
