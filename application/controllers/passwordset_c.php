<?php
class Passwordset_c extends Login_Controller {
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
        $user = $this->session->userdata('user');
        log_message('info', "passwordset_c index user:".$user);
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
        log_message('info', "passwordset_c resetPwd username&password&newPassword:".$user."|".$password."|".$newPassword);

        $this->load->model('login_m','login_m');
        $userinfo = $this->login_m->getUser($user);
        log_message('info', "passwordset_c resetPwd user:".var_export($userinfo,true));

        if(!empty($userinfo) && $userinfo['password']==md5($password)){
            $this->load->model('passwordset_m','passwordset_m');
            $ret = $this->passwordset_m->setPwd($user,$newPassword);
            $data["errFlg"] = self::RESULT_OK;
            $this->load->view('passwordset_v', $data);
        }else{
            $data["errFlg"] = self::INPUT_REQUIRE_NGPWD;
            $this->load->view('passwordset_v', $data);
      }
    }
}