<?php
class Obtain_employment_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100201");
        $this->load->model('class_m','class_m');
        $this->load->model('student_m','student_m');
    }

    public function index()
    {
        $data = array();
        $classData = array();

        $user = $this->session->all_userdata();
        log_message('info', "obtain_employment_c index user:".var_export($user,true));
        log_message('info', "obtain_employment_c index post:".var_export($_POST,true));

        $start_year = $this->input->post('start_year');
        if (empty($start_year)) {
            $start_year = substr(date("Y-m-d"),0,4);
        }
        $start_month = $this->input->post('start_month');
        if (empty($start_month)) {
            $start_month = substr(date("Y-m-d"),5,2);
        }
        $data['start_year'] = $start_year;
        $data['start_month'] = substr("0".$start_month,-2);
        $data['search_key'] =  $this->input->post('txtKey');
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/student_c/index/2/".$temp['class_id']."\">".$temp['class_no']."</a>";
        }
        $data['start_month'] = $start_month;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('obtain_employment_class_v',$data);
    }
}