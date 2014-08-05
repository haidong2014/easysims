<?php
class Menu_c extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data = array();
    $username = $this->session->userdata('user_name');
    log_message('info', "####username:".$username);
    $data["username"] = $username;
    $this->load->view('menu_v',$data);
  }
}