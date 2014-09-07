<?php
class Class_c extends MY_Controller {

    public function __construct()
    {
        parent::__construct("100402");

        $this->load->model('class_m','class_m');
        $this->load->model('subject_m','subject_m');
        $this->load->model('code_m','code_m');
        $this->load->model('teacher_m','teacher_m');
        $this->load->model('course_m','course_m');
    }

    public function index(){
        $data = array();

        $search_key = $this->input->post('txtKey');
        $data['search_key'] = $search_key;
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
          $temp['opt']="<a href=\"".SITE_URL."/class_c/view_class_init/".$temp['class_id']."\">查看</a> |".
          "<a href=\"".SITE_URL."/class_c/upd_class_init/".$temp['class_id']."\">编辑</a> |".
          "<a href=\"#\" onclick=\"delclass('".SITE_URL."/class_c/delete_class/".$temp['class_id']."')\">删除</a>";
        }
        $data['classsData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('class_lst_v',$data);
    }

    public function add_class_init(){
        $data = array();

        $status = $this->code_m->getList("05");
        $data['status'] = $status;
        $teacherData = $this->teacher_m->getTeacher();
        $data['teacherData'] = $teacherData;
        $courseData = $this->course_m->getList(null);
        $data['courseData'] = $courseData;
        $start_year = substr(date("Y-m-d"),0,4);
        $start_month = substr(date("Y-m-d"),5,2);
        $data['start_year'] = $start_year;
        $data['start_month'] = $start_month;

        $this->load->view('class_add_v',$data);
    }

    public function add_class(){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $class_id = $this->input->post('class_id');
        $data['class_id'] = $class_id;
        $data['class_no'] = $this->input->post('class_no');
        $data['class_name'] = $this->input->post('class_name');
        $data['start_year'] = $this->input->post('start_year');
        $data['start_month'] = substr("0".$this->input->post('start_month'),-2);
        $data['start_date'] = $this->input->post('start_date');
        $data['end_date'] = $this->input->post('end_date');
        $course_id = $this->input->post('course_id');
        $data['course_id'] = $course_id;
        $data['teacher_id'] = $this->input->post('teacher_id');
        $data['class_room'] = $this->input->post('class_room');
        $data['numbers'] = $this->input->post('numbers');
        $data['cost'] = $this->input->post('cost');
        $data['status'] = $this->input->post('status');
        $data['remarks'] = $this->input->post('remarks');
        $data['delete_flg'] = "0";
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        if (empty($class_id)) {
            $class_id = $this->class_m->addOne($data);

        } else {
            $this->class_m->updateOne($data);

            $subjectData = $this->class_m->getSubjectList($class_id,$course_id);
            foreach($subjectData as &$value){
                $subject= $this->subject_m->getOne($course_id,$value['subject_id']);
                $value['subject_name'] = $subject['subject_name'];
                $value['period'] = $subject['period'];
            }
        }

        if (empty($subjectData)) {
            $subjectData = $this->subject_m->getList($course_id, null);
        }
        $data['subjectData'] = @json_encode(array('Rows'=>$subjectData));
        $teacherData = $this->teacher_m->getTeacher();
        $data['teacherData'] = @json_encode($teacherData);
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $userinfo = $this->session->userdata('user');
        $data['user'] =  $userinfo ;
        $this->load->view('class_add_setcourse',$data);
    }

    public function upd_class_init($class_id = null){
        $data = array();

        $classData = $this->class_m->getOne($class_id);
        $data = $classData;
        $status = $this->code_m->getList("05");
        $data['status'] = $status;
        $teacherData = $this->teacher_m->getTeacher();
        $data['teacherData'] = $teacherData;
        $courseData = $this->course_m->getList(null);
        $data['courseData'] = $courseData;

        $this->load->view('class_add_v',$data);
    }

    public function view_class_init($class_id = null){
        $data = array();

        $classData = $this->class_m->getOne($class_id);
        $data = $classData;
        $status = $this->code_m->getList("05");
        $data['status'] = $status;
        $teacherData = $this->teacher_m->getTeacher();
        $data['teacherData'] = $teacherData;
        $courseData = $this->course_m->getList(null);
        $data['courseData'] = $courseData;

        $this->load->view('class_view_v',$data);
    }

    public function delete_class($class_id = null){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $data['class_id'] = $class_id;
        $data['delete_flg'] = "1";
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->class_m->deleteOne($data);
        redirect("class_c");
    }

    public function chk_class($class_no){

        $checkclass = $this->class_m->checkClass($class_no);
        $msg = "此班级编号已经被登录！";
        if(!empty($checkclass)){
            echo urldecode(json_encode(urlencode($msg)));
        }
    }

    public function showSubject()
    {
        $data = array();
        $data['post'] = $_POST;
        $class_id = $this->input->post('class_id');
        $course_id = $this->input->post('course_id');
        $subjectData = $this->class_m->getSubjectList($class_id,$course_id);

        foreach($subjectData as &$value){
            $subject= $this->subject_m->getOne($course_id,$value['subject_id']);
            $value['subject_name'] = $subject['subject_name'];
            $value['period'] = $subject['period'];
        }

        $data['subjectData'] = @json_encode(array('Rows'=>$subjectData));
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $this->load->view('class_view_subject',$data);
    }

    public function add_subject(){
        log_message('info', "class_c add_subject post:".var_export($_POST,true));

        $class_id = $this->input->post('class_id');
        $course_id = $this->input->post('course_id');

        redirect("class_c");
    }

    public function update_subject($class_id,$course_id,$subject_id,$start_date,$end_date,$teacher_id){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['teacher_id'] = $teacher_id;
        $data['delete_flg'] = "0";
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        $this->class_m->updateSubject($data);
    }
}