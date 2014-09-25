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

        log_message('info', "obtain_employment_c index post:".var_export($_POST,true));

        $end_year = $this->input->post('end_year');
        if (empty($end_year)) {
            $end_year = substr(date("Y-m-d"),0,4);
        }
        $end_month = $this->input->post('end_month');
        if (empty($end_month)) {
            $end_month = substr(date("Y-m-d"),5,2);
        }
        $data['end_year'] = $end_year;
        $data['end_month'] = substr("0".$end_month,-2);
        $data['search_key'] =  $this->input->post('txtKey');
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/student_c/index/2/".$temp['class_id']."\">".$temp['class_no']."</a>";
        }
        $data['end_month'] = $end_month;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('obtain_employment_class_v',$data);
    }
}