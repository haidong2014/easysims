<?php 
class Login_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct();
   }

	public function index()
	{
	  $data = array();
    $data["txtUserId"] = "";
	  $data["errFlg"] = 0;
		$this->load->view('login_v',$data);
	}
	
	public function doLogin(){
	  $data = array();
	  $this->load->model('login_m','login_m');
	  $userId = $this->input->post('txtUserId');
	  $password = $this->input->post('txtPassword');
	  log_message('info', "####".$userId."|".md5($password)."|".$password);
	  
	  $data["errFlg"] = 0;
    $data["txtUserId"] = $userId;
	  if(empty($userId)){
	    $data["errFlg"] = 1;
	    $this->load->view('login_v', $data);
	    return ;
	  }
	  if(empty($password)){
	    $data["errFlg"] = 2;
	    $this->load->view('login_v', $data);
	    return;
	  }

	  $user = $this->login_m->getUser($userId);
	  $this->session->set_userdata($user);
	  log_message('info', "####user".var_export($user,true));
	  if(!empty($user) && $user['password']===md5($password)){
	    redirect("menu_c");
	  }else{
	    $data["errFlg"] = 3;
	    $this->load->view('login_v', $data);
	  }
	}
}