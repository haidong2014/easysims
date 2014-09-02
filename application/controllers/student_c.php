<?php
class Student_c extends MY_Controller {

    public function __construct()
    {
        parent::__construct("100404");
        $this->load->model('student_m','student_m');
    }

    public function index($mode = null, $class_id = null)
    {
        // $mode = 1 招生
        // $mode = 2 就业
        // $mode = null 基础信息-学生
        $data = array();
        $keyword = null;
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
            if (empty($start_year)) {
                $start_year = substr(date("Y-m-d"),0,4);
            }
            $start_month = $this->input->post('start_month');
            if (empty($start_month)) {
                $start_month = substr(date("Y-m-d"),5,2);
            } else {
                $start_month = substr("0".$start_month,-2);
            }
            $data['start_year'] = $start_year;
            $data['start_month'] = $start_month;
        } else {
          $data['class_id'] = $class_id;
        }
        $keyword = $this->input->post('txtKey');
        $data['txtKey'] = $keyword;
        $data['mode'] = $mode;

        $studentData = $this->student_m->getList($keyword, $start_year, $start_month, $class_id);
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

    public function add_student_init($mode = null, $class_id = null){
        $data = array();
        $this->load->model('code_m','code_m');
        $graduateData = $this->code_m->getList("06");
        $data['graduateData'] = $graduateData;
        $this->load->model('course_m','course_m');
        $courseData = $this->course_m->getList(null);
        $data['courseData'] = $courseData;
        $data['sex'] = "1";
        $start_year = substr(date("Y-m-d"),0,4);
        $start_month = substr(date("Y-m-d"),5,2);
        $data['start_year'] = $start_year;
        $data['start_month'] = $start_month;
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
        $data['sex'] = $this->input->post('sex');
        $data['birthday'] = $this->input->post('birthday');
        $data['age'] = $this->input->post('age');
        $data['id_card'] = $this->input->post('id_card');
        $data['contact_way'] = $this->input->post('contact_way');
        $data['parent_phone'] = $this->input->post('parent_phone');
        $data['course_id'] = $this->input->post('course_id');
        $data['class_id'] = $class_id;
        $data['cost'] = $this->input->post('cost');
        $data['start_year'] = $this->input->post('start_year');
        $start_month = $this->input->post('start_month');
        $data['start_month'] = substr("0".$start_month,-2);
        $data['start_date'] = $this->input->post('start_date');
        $data['end_date'] = $this->input->post('end_date');
        $data['attendance'] = $this->input->post('attendance');
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
        $data['follow_city'] = $this->input->post('follow_city');
        $data['follow_company'] = $this->input->post('follow_company');
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
        $this->load->model('code_m','code_m');
        $graduateData = $this->code_m->getList("06");
        $data['graduateData'] = $graduateData;
        $this->load->model('course_m','course_m');
        $courseData = $this->course_m->getList(null);
        $data['courseData'] = $courseData;
        $data['mode'] = $mode;
        $data['class_id'] = $class_id;
        $this->load->view('student_add_v', $data);
    }

    public function view_student_init($student_id = null,$mode = null, $class_id = null){
        $data = array();
        $studentData = $this->student_m->getOneForUpd($student_id);
        $data = $studentData;
        $this->load->model('code_m','code_m');
        $graduateData = $this->code_m->getList("06");
        $data['graduateData'] = $graduateData;
        $this->load->model('course_m','course_m');
        $courseData = $this->course_m->getList(null);
        $data['courseData'] = $courseData;
        $data['mode'] = $mode;
        $data['class_id'] = $class_id;
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

        $this->load->model('user_m','user_m');

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