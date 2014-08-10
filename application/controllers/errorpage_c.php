<?php 
class Errorpage_c extends Other_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		$this->load->view('errorpage_v',$data);
	}
}