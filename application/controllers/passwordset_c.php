<?php 
class Passwordset_c extends MY_Controller {
  const INPUT_REQUIRE_USERNAME = 1;
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
	  $user = $this->session->all_userdata();

	  $data["isLogin"] =false;
	  if(!empty($user)){
	     $data["txtUserName"] = $user['user_name'];
	     $data["isLogin"] =true;
	  }else{
	    $data["txtUserName"] = "";
	  }
	  
		$this->load->view('passwordset_v',$data);
	}
	
	public function resetPwd(){
	  $data = array();
	  $this->load->model('login_m','login_m');
	  $userName = $this->input->post('txtUserName');
	  $data['txtUserName'] = $userName;
	  $password = $this->input->post('txtPassword');
	  
	  $newPassword = $this->input->post('txtNewPassword');
    log_message('info', "####userdd newPassword".$userName."|".$password."|".$newPassword);
	  $user = $this->login_m->getUser($userName);

	  if(!empty($user) && $user['password']===md5($password)){
	     $ret = $this->login_m->setPwd($userName,md5($newPassword));
	     $data["errFlg"] = self::RESULT_OK;
	     $this->load->view('passwordset_v', $data);
	  }else{
	    $data["errFlg"] = self::INPUT_REQUIRE_NGPWD;
	    $this->load->view('passwordset_v', $data);
	  }
	  //$this->load->view('passwordset_v', $data);
	}
}