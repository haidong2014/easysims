<?php
class Passwordset_c extends Login_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $data["errFlg"] = 0;
        $user = $this->session->userdata('user');
        $data["isLogin"] =false;
        if(!empty($user)){
            $data["txtUser"] = $user;
            $data["isLogin"] =true;
        }else{
            $data["txtUser"] = "";
        }
        $this->load->view('passwordset_v',$data);
    }

    public function resetPwd(){
        $data = array();

        $user = $this->input->post('txtUser');
        $data['txtUser'] = $user;
        $password = $this->input->post('txtPassword');

        $newPassword = $this->input->post('txtNewPassword');

        $this->load->model('login_m','login_m');
        $userinfo = $this->login_m->getUser($user);

        if(!empty($userinfo) && $userinfo['password']==md5($password)){
            $this->load->model('passwordset_m','passwordset_m');
            $ret = $this->passwordset_m->setPwd($user,$newPassword);
            $data["errFlg"] = 1;
            $this->load->view('passwordset_v', $data);
        }else{
            $data["errFlg"] = 2;
            $this->load->view('passwordset_v', $data);
      }
    }
}