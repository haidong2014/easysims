<?php
class Passwordset_c extends MY_Controller {
	const INPUT_REQUIRE_USERID = 1;
	const INPUT_REQUIRE_PWD = 2;
	const INPUT_REQUIRE_NEWPWD = 4;
	const INPUT_REQUIRE_NGPWD = 3;
	const RESULT_OK = 99;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		$data["errFlg"] = 0;
		$username = $this->session->userdata('user_name');
		log_message('info', "####usersssss".$username);
		$data["isLogin"] =false;
		if(!empty($username)){
			$data["txtUsername"] = $username;
			$data["isLogin"] =true;
		}else{
			$data["txtUsername"] = "";
		}
		$this->load->view('passwordset_v',$data);
	}

	public function resetPwd(){
		$data = array();

		$username = $this->input->post('txtUsername');
		$data['txtUsername'] = $username;
		$password = $this->input->post('txtPassword');

		$newPassword = $this->input->post('txtNewPassword');
		log_message('info', "####userdd newPassword".$username."|".$password."|".$newPassword);

		$this->load->model('login_m','login_m');
		$user = $this->login_m->getUser($username);
		log_message('info', "####user ddds".var_export($user,true));

		if(!empty($user) && $user['password']==md5($password)){
			$this->load->model('passwordset_m','passwordset_m');
			$ret = $this->passwordset_m->setPwd($username,$newPassword);
			$data["errFlg"] = self::RESULT_OK;
			$this->load->view('passwordset_v', $data);
		}else{
			$data["errFlg"] = self::INPUT_REQUIRE_NGPWD;
			$this->load->view('passwordset_v', $data);
	  }
	}
}