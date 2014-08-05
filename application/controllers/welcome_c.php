<?php 
class Welcome_c extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		$this->load->view('welcome_v',$data);
	}
}