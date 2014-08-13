<?php
class Login_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $data["txtUser"] = "";
        $data["errFlg"] = 0;
        $this->load->view('login_v',$data);
    }

    public function doLogin(){
        $data = array();
        $this->load->model('login_m','login_m');
        $user = $this->input->post('txtUser');
        $password = $this->input->post('txtPassword');

        $data["errFlg"] = 0;
        $data["txtUser"] = $user;
        if(empty($user)){
            $data["errFlg"] = 1;
            $this->load->view('login_v', $data);
            return ;
        }

        if(empty($password)){
            $data["errFlg"] = 2;
            $this->load->view('login_v', $data);
            return;
        }

        $user = $this->login_m->getUser($user);
        $this->session->set_userdata($user);
        log_message('info', "login_c doLogin user:".var_export($user,true));
        if(!empty($user) && $user['password']==md5($password)){
            redirect("menu_c");
        }else{
            $data["errFlg"] = 3;
            $this->load->view('login_v', $data);
        }
    }
}