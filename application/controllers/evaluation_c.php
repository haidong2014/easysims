<?php
class Evaluation_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100103");
        $this->load->model('class_m','class_m');
        $this->load->model('course_m','course_m');
        $this->load->model('subject_m','subject_m');
        $this->load->model('teacher_m','teacher_m');
        $this->load->model('evaluation_m','evaluation_m');
    }

    public function index()
    {
        $data = array();
        $classData = array();

        log_message('info', "evaluation_c index post:".var_export($_POST,true));

        $data['search_key'] =  $this->input->post('txtKey');
        $classData = $this->class_m->getList($data);

        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/evaluation_c/subject_lst/".
                              $temp['class_id']."/".$temp['course_id']."\">".$temp['class_no']."</a>";
        }

        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('evaluation_class_v',$data);
    }

    public function subject_lst($class_id=null,$course_id=null){
        $data = array();
        $subjectData = array();

        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        $search_key = $this->input->post('txtKey');
        $data['search_key'] = $search_key;
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $subjectData = $this->class_m->getSubjectList($class_id,$course_id,$search_key);

        foreach($subjectData as &$temp){
            $temp['period']=$temp['period']."周";
            $temp['teacher_name']="<a href=\"".SITE_URL."/evaluation_c/teacher_ev_lst/".$temp['class_id']."/".
                                $temp['course_id']."/".$temp['subject_id']."/".$temp['teacher_id']."\">".$temp['teacher_name']."</a>";
            $temp['evaluation']="<a href=\"".SITE_URL."/evaluation_c/evaluation_add_init/".$temp['class_id']."/".
                                $temp['course_id']."/".$temp['subject_id']."\">"."评价"."</a>";
            $temp['attendance']="<a href=\"".SITE_URL."/evaluation_c/attendance_add_init/".$temp['class_id']."/".
                                $temp['course_id']."/".$temp['subject_id']."/".$temp['teacher_id']."\">"."评价"."</a>";
            $temp['subject_id']="<a href=\"".SITE_URL."/evaluation_c/student_ev_lst/".$temp['class_id']."/".
                                $temp['course_id']."/".$temp['subject_id']."\">".$temp['subject_id']."</a>";
        }

        $data['subjectData'] = @json_encode(array('Rows'=>$subjectData));
        $this->load->view('evaluation_subject_v',$data);
    }

    public function attendance_add_init($class_id,$course_id,$subject_id,$teacher_id){
        $data = array();

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['teacher_id'] = $teacher_id;

        $class_name = $this->class_m->getClassName($class_id);
        $course_name = $this->course_m->getCourseName($course_id);
        $subject_name = $this->subject_m->getSubjectName($course_id,$subject_id);
        $teacher_name = $this->teacher_m->getTeacherName($teacher_id);
        $evaluationData = $this->evaluation_m->select($data);

        $data = $evaluationData;
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['teacher_id'] = $teacher_id;
        $data['class_name'] = $class_name;
        $data['course_name'] = $course_name;
        $data['subject_name'] = $subject_name;
        $data['teacher_name'] = $teacher_name;

        $this->load->view('evaluation_attendance_add_v',$data);
    }

    public function attendance_add(){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $class_id = $this->input->post('class_id');
        $course_id = $this->input->post('course_id');
        $subject_id = $this->input->post('subject_id');
        $teacher_id = $this->input->post('teacher_id');
        $attendance_scores = $this->input->post('attendance_scores');
        $remarks = $this->input->post('remarks');

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['teacher_id'] = $teacher_id;
        $data['attendance_scores'] = $attendance_scores;
        $data['remarks'] = $remarks;
        $data['delete_flg'] = "0";
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        $this->evaluation_m->insertorupdate($data);

        self::subject_lst($class_id,$course_id);
    }
}