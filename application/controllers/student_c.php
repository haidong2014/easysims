<?php
class Student_c extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_m','student_m');
    }

    public function index($mode = null, $class_id = null)
    {
        $data = array();
        $keyword = $this->input->post('txtKey');
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
        $studentData = $this->student_m->getList($keyword, $start_year, $start_month);
        foreach($studentData as &$data){
            $data['opt']="<a href=\"".SITE_URL."/student_c/view_student_init/".$data['student_id']."\">查看</a> |".
            "<a href=\"".SITE_URL."/student_c/upd_student_init/".$data['student_id']."\">编辑</a> |".
            "<a href=\"#\" onclick=\"delstudent('".SITE_URL."/student_c/delete_student/".$data['student_id']."')\">删除</a>";
        }
        $data['start_year'] = $start_year;
        $data['start_month'] = $start_month;
        $data['txtKey'] = $keyword;
        $data['studentsData'] = @json_encode(array('Rows'=>$studentData));
        $this->load->view('student_lst_v',$data);
    }

    public function add_student_init(){
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
        $this->load->view('student_add_v',$data);
    }

    public function add_student(){
        $userinfo = $this->session->userdata('user');

        $student_id = $this->input->post('student_id');
        $student_no = $this->input->post('student_no');
        $student_name = $this->input->post('student_name');
        $sex = $this->input->post('sex');
        $birthday = $this->input->post('birthday');
        $age = $this->input->post('age');
        $id_card = $this->input->post('id_card');
        $contact_way = $this->input->post('contact_way');
        $parent_phone = $this->input->post('parent_phone');
        $course_id = $this->input->post('course_id');
        $class_id = $this->input->post('class_id');
        $cost = $this->input->post('cost');
        $start_year = $this->input->post('start_year');
        $start_month = $this->input->post('start_month');
        $start_month = substr("0".$start_month,-2);
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $attendance = $this->input->post('attendance');
        $system_user = $this->input->post('system_user');
        $remarks = $this->input->post('remarks');
        /*************other***************/
        $graduate_school = $this->input->post('graduate_school');
        $specialty = $this->input->post('specialty');
        $graduate = $this->input->post('graduate');
        $ancestralhome = $this->input->post('ancestralhome');
        $know_school = $this->input->post('know_school');
        $know_trade = $this->input->post('know_trade');
        $preference = $this->input->post('preference');
        $software_base = $this->input->post('software_base');
        $purpose = $this->input->post('purpose');
        $follow_city = $this->input->post('follow_city');
        $follow_company = $this->input->post('follow_company');
        $follow_salary = $this->input->post('follow_salary');
        $follow_position = $this->input->post('follow_position');
        $follow_remarks = $this->input->post('follow_remarks');

        if (empty($student_id)) {
            $student_id = $this->student_m->addOne($student_no,$student_name, $sex,$birthday, $age, $id_card, $contact_way,
            $parent_phone, $course_id, $class_id, $cost, $start_year,$start_month,$start_date,$end_date,
            $attendance,$system_user,$remarks,$userinfo);
            /***insert other**/
            $this->student_m->addOneOther($student_id, $graduate_school, $specialty,$graduate
            ,$ancestralhome,$know_school,$know_trade,$preference,$software_base,$purpose,
            $follow_city,$follow_company,$follow_salary,$follow_position,$follow_remarks,$userinfo);
        } else {
            $this->student_m->updateOne($student_no,$student_name, $sex,$birthday, $age, $id_card, $contact_way,
            $parent_phone, $course_id, $class_id, $cost, $start_year,$start_month,$start_date,$end_date,
            $attendance,$system_user,$remarks,$student_id,$userinfo);
            $this->student_m->updateOneOther($student_id, $graduate_school, $specialty,$graduate
            ,$ancestralhome,$know_school,$know_trade,$preference,$software_base,$purpose,
            $follow_city,$follow_company,$follow_salary,$follow_position,$follow_remarks,$userinfo);
        }

        if($system_user == "1"){
            self::addUser($student_no,$student_name);
        }
        redirect("student_c");
    }

    public function upd_student_init($student_id = null){
        $data = array();
        $studentData = $this->student_m->getOneForUpd($student_id);
        $data = $studentData;
        $this->load->model('code_m','code_m');
        $graduateData = $this->code_m->getList("06");
        $data['graduateData'] = $graduateData;
        $this->load->model('course_m','course_m');
        $courseData = $this->course_m->getList(null);
        $data['courseData'] = $courseData;
        $this->load->view('student_add_v', $data);
    }

    public function view_student_init($student_id = null){
        $data = array();
        $studentData = $this->student_m->getOneForUpd($student_id);
        $data = $studentData;
        $this->load->model('code_m','code_m');
        $graduateData = $this->code_m->getList("06");
        $data['graduateData'] = $graduateData;
        $this->load->model('course_m','course_m');
        $courseData = $this->course_m->getList(null);
        $data['courseData'] = $courseData;
        $this->load->view('student_view_v', $data);
    }

    public function delete_student($student_id = null){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $data['student_id'] = $student_id;
        $data['delete_flg'] = "1";
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        $this->student_m->deleteOne($data);
        $this->student_m->deleteOneOther($data);
        redirect("student_c");
    }

    public function chk_student($student_no){
        $this->load->model('student_m','student_m');
        $checkstudent = $this->student_m->checkStudent($student_no);
        $msg = "此学生编号已经被登录！";
        if(!empty($checkstudent)){
            echo urldecode(json_encode(urlencode($msg)));
        }
    }

    private function addUser($student_no,$student_name){
        $userinfo = $this->session->userdata('user');

        $this->load->model('user_m','user_m');

        $chkuser= $this->user_m->checkUser($student_no);
        if(!empty($chkuser)){
          return ;
        }
        $userData['user'] = $student_no;
        $userData['user_name'] = $student_name;
        $userData['role_id'] = "1007";
        $userData['delete_flg'] = 0;
        $userData['insert_user'] = $userinfo;
        $userData['insert_time'] = date("Y-m-d H:i:s");
        $userData['update_user'] = $userinfo;
        $userData['update_time'] = date("Y-m-d H:i:s");
        $this->user_m->addOne($userData);
    }
}