<?php
class Obtain_employment_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100201");
        $this->load->model('class_m','class_m');
        $this->load->model('student_m','student_m');
        $this->load->model('session_m','session_m');
    }

    public function index()
    {
        $data = array();
        $classData = array();

        //---------------------------------------------------------//
        $sessionData = array();
        $end_year = null;
        $end_month = null;
        $search_key = null;

        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10020101";
        $sessionData = $this->session_m->select($data);
        if(empty($sessionData)){
            $end_year = substr(date("Y-m-d"),0,4);
            $end_month = substr(date("Y-m-d"),5,2);
        } else {
            $end_year = $sessionData['session_01'];
            $end_month = $sessionData['session_02'];
            $search_key = $sessionData['session_03'];
        }
        //---------------------------------------------------------//
        $data['end_year'] = $end_year;
        $data['end_month'] = substr("0".$end_month,-2);
        $data['search_key'] =  $search_key;
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/student_c/index/2/".$temp['class_id']."\">".$temp['class_no']."</a>";
        }
        $data['end_month'] = $end_month;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('obtain_employment_class_v',$data);
    }

    public function search()
    {
        $data = array();
        $classData = array();

        log_message('info', "obtain_employment_c search post:".var_export($_POST,true));

        $end_year = $this->input->post('end_year');
        $end_month = $this->input->post('end_month');
        $search_key = $this->input->post('txtKey');
        $data['end_year'] = $end_year;
        $data['end_month'] = substr("0".$end_month,-2);
        $data['search_key'] =  $search_key;
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/student_c/index/2/".$temp['class_id']."\">".$temp['class_no']."</a>";
        }
        $data['end_month'] = $end_month;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        //---------------------------------------------------------//
        $userinfo = $this->session->userdata('user');
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10020101";
        $data['session_01'] = $end_year;
        $data['session_02'] = $end_month;
        $data['session_03'] = $search_key;
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->session_m->insertorupdate($data);
        //---------------------------------------------------------//
        $this->load->view('obtain_employment_class_v',$data);
    }
}