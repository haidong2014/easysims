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

        $year = array();
        $year[0] = array("id"=>"0","name"=>"2014","sel"=>"");
        $year[1] = array("id"=>"1","name"=>"2015","sel"=>"");
        $year[2] = array("id"=>"2","name"=>"2016","sel"=>"");
        $year[3] = array("id"=>"3","name"=>"2017","sel"=>"");
        $year[4] = array("id"=>"4","name"=>"2018","sel"=>"");
        $year[5] = array("id"=>"5","name"=>"2019","sel"=>"");
        $year[6] = array("id"=>"6","name"=>"2020","sel"=>"");
        $year[7] = array("id"=>"7","name"=>"2021","sel"=>"");
        $year[8] = array("id"=>"8","name"=>"2022","sel"=>"");
        $year[9] = array("id"=>"9","name"=>"2023","sel"=>"");
        $year[10] = array("id"=>"10","name"=>"2024","sel"=>"");
        $year[11] = array("id"=>"11","name"=>"2025","sel"=>"");

        $month = array();
        $month[0] = array("id"=>"0","name"=>"01","sel"=>"");
        $month[1] = array("id"=>"1","name"=>"02","sel"=>"");
        $month[2] = array("id"=>"2","name"=>"03","sel"=>"");
        $month[3] = array("id"=>"3","name"=>"04","sel"=>"");
        $month[4] = array("id"=>"4","name"=>"05","sel"=>"");
        $month[5] = array("id"=>"5","name"=>"06","sel"=>"");
        $month[6] = array("id"=>"6","name"=>"07","sel"=>"");
        $month[7] = array("id"=>"7","name"=>"08","sel"=>"");
        $month[8] = array("id"=>"8","name"=>"09","sel"=>"");
        $month[9] = array("id"=>"9","name"=>"10","sel"=>"");
        $month[10] = array("id"=>"10","name"=>"11","sel"=>"");
        $month[11] = array("id"=>"11","name"=>"12","sel"=>"");

        $ddlYear = $this->input->post('ddlYear');
        $ddlMonth = $this->input->post('ddlMonth');
        $tmpYear = substr(date("Y-m-d"),0,4);
        $tmpMonth = substr(date("Y-m-d"),5,2);
        if ($ddlYear=="" || $ddlMonth=="") {
            $search_ym = $tmpYear.$tmpMonth;
            $i = 0;
            foreach($year as $y){
                if ($y['name']==$tmpYear) {
                    $year[$i]['sel'] = "selected";
                    break;
                }
                $i = $i + 1;
            }
            $i = 0;
            foreach($month as $m){
                if ($m['name']==$tmpMonth) {
                    $month[$i]['sel'] = "selected";
                    break;
                }
                $i = $i + 1;
            }
        } else {
            $year[$ddlYear]['sel'] = "selected";
            $month[$ddlMonth]['sel'] = "selected";
        }

        $data['year'] = $year;
        $data['month'] = $month;
        $data['search_year'] = $tmpYear;
        $data['search_month'] = $tmpMonth;
        $data['search_key'] =  $this->input->post('txtKey');
        $classData = $this->class_m->getList($data);

        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/obtain_employment_c/student_lst/".$temp['class_no']."\">".$temp['class_no']."</a>";
        }

        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('obtain_employment_class_v',$data);
    }

    public function search_class()
    {
        $data = array();
        $classData = array();

        $user = $this->session->all_userdata();
        log_message('info', "obtain_employment_c search_class user:".var_export($user,true));
        log_message('info', "obtain_employment_c search_class post:".var_export($_POST,true));

        $year = array();
        $year[0] = array("id"=>"0","name"=>"2014","sel"=>"");
        $year[1] = array("id"=>"1","name"=>"2015","sel"=>"");
        $year[2] = array("id"=>"2","name"=>"2016","sel"=>"");
        $year[3] = array("id"=>"3","name"=>"2017","sel"=>"");
        $year[4] = array("id"=>"4","name"=>"2018","sel"=>"");
        $year[5] = array("id"=>"5","name"=>"2019","sel"=>"");
        $year[6] = array("id"=>"6","name"=>"2020","sel"=>"");
        $year[7] = array("id"=>"7","name"=>"2021","sel"=>"");
        $year[8] = array("id"=>"8","name"=>"2022","sel"=>"");
        $year[9] = array("id"=>"9","name"=>"2023","sel"=>"");
        $year[10] = array("id"=>"10","name"=>"2024","sel"=>"");
        $year[11] = array("id"=>"11","name"=>"2025","sel"=>"");

        $month = array();
        $month[0] = array("id"=>"0","name"=>"01","sel"=>"");
        $month[1] = array("id"=>"1","name"=>"02","sel"=>"");
        $month[2] = array("id"=>"2","name"=>"03","sel"=>"");
        $month[3] = array("id"=>"3","name"=>"04","sel"=>"");
        $month[4] = array("id"=>"4","name"=>"05","sel"=>"");
        $month[5] = array("id"=>"5","name"=>"06","sel"=>"");
        $month[6] = array("id"=>"6","name"=>"07","sel"=>"");
        $month[7] = array("id"=>"7","name"=>"08","sel"=>"");
        $month[8] = array("id"=>"8","name"=>"09","sel"=>"");
        $month[9] = array("id"=>"9","name"=>"10","sel"=>"");
        $month[10] = array("id"=>"10","name"=>"11","sel"=>"");
        $month[11] = array("id"=>"11","name"=>"12","sel"=>"");

        $ddlYear = $this->input->post('ddlYear');
        $ddlMonth = $this->input->post('ddlMonth');
        $year[$ddlYear]['sel'] = "selected";
        $month[$ddlMonth]['sel'] = "selected";

        $data['year'] = $year;
        $data['month'] = $month;
        $data['search_year'] = $year[$ddlYear]['name'];
        $data['search_month'] = $month[$ddlMonth]['name'];
        $data['search_key'] = $this->input->post('txtKey');
        $classData = $this->class_m->getList($data);

        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/obtain_employment_c/student_lst/".$temp['class_no']."\">".$temp['class_no']."</a>";
        }

        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('obtain_employment_class_v',$data);
    }
}