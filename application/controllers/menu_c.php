<?php
class Menu_c extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('rolesetup_m','rolesetup_m');
  }

  public function index()
  {
    $data = array();
    $menu = array();
    $url =array();
    $username = $this->session->userdata('user_name');
    $role_id = $this->session->userdata('role_id');

    $data['username'] = $username;

    $menu = $this->rolesetup_m->getFunction($role_id);
    $url = $this->rolesetup_m->getURL($role_id);
    log_message('info', "menu_c index menu:".var_export($menu,true));
    log_message('info', "menu_c index url:".var_export($url,true));

    $data['menu'] = $menu;
    $data['url'] = $url;
    $this->load->view('menu_v',$data);
  }
}