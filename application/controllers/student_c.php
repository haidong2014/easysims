<?php
class Student_c extends MY_Controller {

    public function __construct()
    {
        parent::__construct("100404");
        $this->load->model('student_m','student_m');
        $this->load->model('code_m','code_m');
        $this->load->model('user_m','user_m');
        $this->load->model('job_m','job_m');
        $this->load->model('class_m','class_m');
        $this->load->model('session_m','session_m');
    }

    public function index($mode = null, $class_id = null)
    {
        // $mode = 1 招生
        // $mode = 2 就业
        // $mode = null 基础信息-学生
        $data = array();
        $search_key = null;
        $start_year = null;
        $start_month = null;
        if (empty($mode)) {
            $mode = $this->input->post('mode');
        }
        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($mode)) {
            //---------------------------------------------------------//
            $sessionData = array();
            $start_year = null;
            $start_month = null;
            $search_key = null;

            $user_id = $this->session->userdata('user_id');
            $data['user_id'] = $user_id;
            $data['url_sub_id'] = "10040401";
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
            $data['start_month'] = $start_month;
            $data['txtKey'] = $search_key;
        } else {
          $data['class_id'] = $class_id;
        }
        $data['mode'] = $mode;

        $studentData = $this->student_m->getList($search_key, $start_year, $start_month, $class_id);
        foreach($studentData as &$temp){
            $temp['opt']="<a href=\"".SITE_URL."/student_c/view_student_init/".
            $temp['student_id']."/".$mode."/".$class_id."\">查看</a> |".
            "<a href=\"".SITE_URL."/student_c/upd_student_init/".
            $temp['student_id']."/".$mode."/".$class_id."\">编辑</a> |".
            "<a href=\"#\" onclick=\"delstudent('".SITE_URL."/student_c/delete_student/".
            $temp['student_id']."/".$mode."/".$class_id."')\">删除</a>";
        }

        $data['studentsData'] = @json_encode(array('Rows'=>$studentData));
        $this->load->view('student_lst_v',$data);
    }

    public function search()
    {
        // $mode = 1 招生
        // $mode = 2 就业
        // $mode = null 基础信息-学生
        $data = array();
        $search_key = null;
        $start_year = null;
        $start_month = null;
        if (empty($mode)) {
            $mode = $this->input->post('mode');
        }
        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($mode)) {
            $start_year = $this->input->post('start_year');
            $start_month = $this->input->post('start_month');
            $start_month = substr("0".$start_month,-2);
            $data['start_year'] = $start_year;
            $data['start_month'] = $start_month;
        } else {
          $data['class_id'] = $class_id;
        }
        $search_key = $this->input->post('txtKey');
        $data['txtKey'] = $search_key;
        $data['mode'] = $mode;

        $studentData = $this->student_m->getList($search_key, $start_year, $start_month, $class_id);
        foreach($studentData as &$temp){
            $temp['opt']="<a href=\"".SITE_URL."/student_c/view_student_init/".
            $temp['student_id']."/".$mode."/".$class_id."\">查看</a> |".
            "<a href=\"".SITE_URL."/student_c/upd_student_init/".
            $temp['student_id']."/".$mode."/".$class_id."\">编辑</a> |".
            "<a href=\"#\" onclick=\"delstudent('".SITE_URL."/student_c/delete_student/".
            $temp['student_id']."/".$mode."/".$class_id."')\">删除</a>";
        }

        $data['studentsData'] = @json_encode(array('Rows'=>$studentData));
        //---------------------------------------------------------//
        $userinfo = $this->session->userdata('user');
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10040401";
        $data['session_01'] = $start_year;
        $data['session_02'] = $start_month;
        $data['session_03'] = $search_key;
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->session_m->insertorupdate($data);
        //---------------------------------------------------------//
        $this->load->view('student_lst_v',$data);
    }

    public function add_student_init($mode = null, $class_id = null){
        $data = array();
        $graduateData = $this->code_m->getList("06");
        $data['graduateData'] = $graduateData;
        $jobData = $this->job_m->getList(null);
        $data['jobData'] = $jobData;
        $classData = $this->class_m->getOne($class_id);
        $data['start_date'] = $classData['start_date'];
        $data['end_date'] = $classData['end_date'];
        $data['sex'] = "1";
        $data['system_user'] = "1";
        $data['mode'] = $mode;
        $data['class_id'] = $class_id;
        $this->load->view('student_add_v',$data);
    }

    public function add_student(){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $student_id = $this->input->post('student_id');
        $student_no = $this->input->post('student_no');
        $student_name = $this->input->post('student_name');
        $remarks = $this->input->post('remarks');
        $mode = $this->input->post('mode');
        $class_id = $this->input->post('class_id');

        $data['student_id'] = $student_id;
        $data['student_no'] = $student_no;
        $data['student_name'] = $student_name;
        $start_date = $this->input->post('start_date');
        $data['start_date'] = $start_date;
        $end_date = $this->input->post('end_date');
        $data['end_date'] = $end_date;
        $data['sex'] = $this->input->post('sex');
        $data['birthday'] = $this->input->post('birthday');
        $data['age'] = $this->input->post('age');
        $data['id_card'] = $this->input->post('id_card');
        $data['contact_way'] = $this->input->post('contact_way');
        $data['parent_phone'] = $this->input->post('parent_phone');
        $data['class_id'] = $class_id;
        $data['cost'] = $this->input->post('cost');
        $start_year = substr($start_date,0,4);
        $start_month = substr($start_date,5,2);
        $end_year = substr($end_date,0,4);
        $end_month = substr($end_date,5,2);
        $data['start_year'] = $start_year;
        $data['start_month'] = $start_month;
        $data['end_year'] = $end_year;
        $data['end_month'] = $end_month;
        $data['scores'] = $this->input->post('scores');
        $system_user = $this->input->post('system_user');
        $data['system_user'] = $system_user;
        $data['remarks'] = $remarks;
        /*************other***************/
        $data['graduate_school'] = $this->input->post('graduate_school');
        $data['specialty'] = $this->input->post('specialty');
        $data['graduate'] = $this->input->post('graduate');
        $data['ancestralhome'] = $this->input->post('ancestralhome');
        $data['know_school'] = $this->input->post('know_school');
        $data['know_trade'] = $this->input->post('know_trade');
        $data['preference'] = $this->input->post('preference');
        $data['software_base'] = $this->input->post('software_base');
        $data['purpose'] = $this->input->post('purpose');
        $data['job_id'] = $this->input->post('job_id');
        $data['follow_salary'] = $this->input->post('follow_salary');
        $data['follow_position'] = $this->input->post('follow_position');
        $data['follow_remarks'] = $this->input->post('follow_remarks');
        $data['delete_flg'] = "0";
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        if (empty($student_id)) {
            $student_id = $this->student_m->addOne($data);
            /***insert other**/
            $data['student_id'] = $student_id;
            $this->student_m->addOneOther($data);
        } else {
            $this->student_m->updateOne($data);
            $this->student_m->updateOneOther($data);
        }

        if($system_user == "1"){
            self::addUser($student_no,$student_name,$remarks);
        }

        self::index($mode,$class_id);
    }

    public function upd_student_init($student_id = null,$mode = null, $class_id = null){
        $data = array();
        $studentData = $this->student_m->getOneForUpd($student_id);
        $data = $studentData;
        $graduateData = $this->code_m->getList("06");
        $data['graduateData'] = $graduateData;
        $jobData = $this->job_m->getList(null);
        $data['jobData'] = $jobData;
        $data['mode'] = $mode;
        $data['class_id'] = $class_id;
        $this->load->view('student_add_v', $data);
    }

    public function view_student_init($student_id = null,$mode = null, $class_id = null, $show_mode = null){
        $data = array();
        $studentData = $this->student_m->getOneForUpd($student_id);
        $data = $studentData;
        $graduateData = $this->code_m->getList("06");
        $data['graduateData'] = $graduateData;
        $jobData = $this->job_m->getList(null);
        $data['jobData'] = $jobData;
        $data['mode'] = $mode;
        $data['class_id'] = $class_id;
        if (empty($show_mode)) {
            $data['show_mode'] = "0";
        } else {
            $data['show_mode'] = "1";
        }
        $this->load->view('student_view_v', $data);
    }

    public function delete_student($student_id = null, $mode = null, $class_id = null){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $data['student_id'] = $student_id;
        $data['delete_flg'] = "1";
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        $this->student_m->deleteOne($data);
        $this->student_m->deleteOneOther($data);

        self::index($mode,$class_id);
    }

    public function chk_student($student_no){
        $this->load->model('student_m','student_m');
        $checkstudent = $this->student_m->checkStudent($student_no);
        $msg = "此学生编号已经被登录！";
        if(!empty($checkstudent)){
            echo urldecode(json_encode(urlencode($msg)));
        }
    }

    private function addUser($student_no,$student_name,$remarks){
        $userinfo = $this->session->userdata('user');

        $chkuser= $this->user_m->checkUser($student_no);
        if(!empty($chkuser)){
          return ;
        }
        $userData['user'] = $student_no;
        $userData['user_name'] = $student_name;
        $userData['role_id'] = "1007";
        $userData['remarks'] = $remarks;
        $userData['delete_flg'] = 0;
        $userData['insert_user'] = $userinfo;
        $userData['insert_time'] = date("Y-m-d H:i:s");
        $userData['update_user'] = $userinfo;
        $userData['update_time'] = date("Y-m-d H:i:s");
        $this->user_m->addOne($userData);
    }
}