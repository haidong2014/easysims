<?php 
class Welcome_c extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		$user = $this->session->all_userdata();
		log_message('info', "####user".var_export($user,true));
		$this->load->view('welcome_v',$data);
	}
}