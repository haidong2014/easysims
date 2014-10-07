<?php
class Enrol_students_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100001");
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
        $start_year = null;
        $start_month = null;
        $search_key = null;

        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10000101";
        $sessionData = $this->session_m->select($data);
        if(empty($sessionData)){
            $start_year = substr(date("Y-m-d"),0,4);
            $start_month = substr(date("Y-m-d"),5,2);
        } else {
            $start_year = $sessionData['session_01'];
            $start_month = $sessionData['session_02'];
            $search_key = $sessionData['session_03'];
        }
        //---------------------------------------------------------//
        $data['start_year'] = $start_year;
        $data['start_month'] = substr("0".$start_month,-2);
        $data['search_key'] =  $search_key;
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/student_c/index/1/".$temp['class_id']."\">".$temp['class_no']."</a>";
        }
        $data['start_month'] = $start_month;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('enrol_students_class_v',$data);
    }

    public function search()
    {
        $data = array();
        $classData = array();

        log_message('info', "enrol_students_c search post:".var_export($_POST,true));

        $start_year = $this->input->post('start_year');
        $start_month = $this->input->post('start_month');
        $search_key = $this->input->post('txtKey');
        $data['start_year'] = $start_year;
        $data['start_month'] = substr("0".$start_month,-2);
        $data['search_key'] =  $search_key;
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/student_c/index/1/".$temp['class_id']."\">".$temp['class_no']."</a>";
        }
        $data['start_month'] = $start_month;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        //---------------------------------------------------------//
        $userinfo = $this->session->userdata('user');
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10000101";
        $data['session_01'] = $start_year;
        $data['session_02'] = $start_month;
        $data['session_03'] = $search_key;
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->session_m->insertorupdate($data);
        //---------------------------------------------------------//
        $this->load->view('enrol_students_class_v',$data);
    }
}