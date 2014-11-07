<?php
class Login_c extends Login_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_m','login_m');
        $this->load->model('student_m','student_m');
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

        $user = $this->input->post('txtUser');
        $password = $this->input->post('txtPassword');

        $data["errFlg"] = 0;
        $data["txtUser"] = $user;

        $userinfo = $this->login_m->getUser($user);

        if (!empty($userinfo)) {
            $pwdinfo = $this->login_m->getPwd($user);
            if ($pwdinfo['password']==md5($password)) {
                if (md5($password)!="1a1dc91c907325c69271ddf0c944bc72") {
                    $studentData = $this->student_m->checkStudent($user);
                    if(empty($studentData)) {
                        $this->session->set_userdata($userinfo);
                        redirect("menu_c");
                    } else {
                        $end_date = $studentData[0]['end_date'];
                        $today = date("Y-m-d");
                        if ($today > $end_date) {
                            $data["errFlg"] = 4;
                            $this->load->view('login_v', $data);
                        } else {
                            $this->session->set_userdata($userinfo);
                            redirect("menu_c");
                        }
                    }
                } else {
                    $data["errFlg"] = 3;
                    $this->load->view('passwordset_v', $data);
                }
            } else {
                $data["errFlg"] = 2;
                $this->load->view('login_v', $data);
            }
        }else{
            $data["errFlg"] = 1;
            $this->load->view('login_v', $data);
        }
    }
}