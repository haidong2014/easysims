<?php 
class Menu_c extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		$user = $this->session->all_userdata();
		log_message('info', "####user".var_export($user,true));
		$this->load->view('menu_v',$data);
	}
}