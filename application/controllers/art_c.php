<?php
class Art_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100302");
        $this->load->model('class_m','class_m');
        $this->load->model('student_m','student_m');
    }

    public function index()
    {
        $data = array();

        $user = $this->session->all_userdata();
        log_message('info', "art_c index user:".var_export($user,true));
        log_message('info', "art_c index post:".var_export($_POST,true));

        $this->load->view('art_lst_v',$data);
    }

    public function search()
    {
        $data = array();

        $user = $this->session->all_userdata();
        log_message('info', "art_c index user:".var_export($user,true));
        log_message('info', "art_c index post:".var_export($_POST,true));

        $this->load->view('art_lst_v',$data);
    }
}