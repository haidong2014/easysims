<?php
class Evaluation_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100103");
        $this->load->model('class_m','class_m');
        $this->load->model('course_m','course_m');
        $this->load->model('subject_m','subject_m');
        $this->load->model('teacher_m','teacher_m');
        $this->load->model('student_m','student_m');
        $this->load->model('evaluationteacher_m','evaluationteacher_m');
        $this->load->model('evaluationstudent_m','evaluationstudent_m');
        $this->load->model('satisfaction_m','satisfaction_m');
        $this->load->model('code_m','code_m');
        $this->load->model('user_m','user_m');
        $this->load->model('session_m','session_m');
    }

    public function index()
    {
        $data = array();
        $classData = array();

        //---------------------------------------------------------//
        $sessionData = array();
        $status = null;
        $search_key = null;

        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10010301";
        $sessionData = $this->session_m->select($data);
        if(empty($sessionData)){
            $status = "2";
        } else {
            $status = $sessionData['session_01'];
            $search_key = $sessionData['session_02'];
        }
        //---------------------------------------------------------//
        $data['status'] = $status;
        $data['search_key'] =  $search_key;
        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        $data['student_id'] = '';
        if($role_id == '1007'){
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
            $data['student_id'] = $student_id;
        }
        //---------------------------------------------------------------//
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/evaluation_c/subject_lst/".
                              $temp['class_id']."/".$temp['course_id']."\">".$temp['class_no']."</a>";
        }
        $statusLst = $this->code_m->getList("05");
        $data['statusLst'] = $statusLst;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('evaluation_class_v',$data);
    }

    public function search()
    {
        $data = array();
        $classData = array();

        log_message('info', "evaluation_c search post:".var_export($_POST,true));

        $search_key =  $this->input->post('txtKey');
        $status =  $this->input->post('status');
        $data['status'] = $status;
        $data['search_key'] = $search_key;
        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        $data['student_id'] = '';
        if($role_id == '1007'){
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
            $data['student_id'] = $student_id;
        }
        //---------------------------------------------------------------//
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/evaluation_c/subject_lst/".
                              $temp['class_id']."/".$temp['course_id']."\">".$temp['class_no']."</a>";
        }
        $statusLst = $this->code_m->getList("05");
        $data['statusLst'] = $statusLst;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        //---------------------------------------------------------//
        $userinfo = $this->session->userdata('user');
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10010301";
        $data['session_01'] = $status;
        $data['session_02'] = $search_key;
        $data['session_03'] = null;
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->session_m->insertorupdate($data);
        //---------------------------------------------------------//
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
        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        $data['student_id'] = '';
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_m->getOne($user_id);
        if($role_id == '1007'){
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
            $data['student_id'] = $student_id;
        }
        //---------------------------------------------------------------//

        foreach($subjectData as &$temp){
            $temp['period']=$temp['period']."周";

            if($role_id == '1007'){
                if(empty($temp['teacher_id'])){
                    $temp['evaluation']="";
                } else {
                    $temp['evaluation']="<a href=\"".SITE_URL."/evaluation_c/satisfaction_add_init/".
                                        $class_id."/".$course_id."/".$temp['subject_id']."/".
                                        $temp['teacher_id']."\">"."评价"."</a>";
                }
                $temp['attendance']="";
             } else {
                if(empty($temp['teacher_id'])){
                    $temp['attendance']="";
                } else {
                    $temp['attendance']="<a href=\"".SITE_URL."/evaluation_c/attendance_add_init/".
                                        $class_id."/".$course_id."/".$temp['subject_id']."/".
                                        $temp['teacher_id']."\">"."评价"."</a>";
                }
                $temp['teacher_name']="<a href=\"".SITE_URL."/evaluation_c/teacher_ev_lst/".$class_id."/".
                                      $course_id."/".$temp['subject_id']."/".$temp['teacher_id']."\">".
                                      $temp['teacher_name']."</a>";
                if($role_id == '1000' || $role_id == '1001' || $role_id == '1002' || $role_id == '1003' || $role_id == '1004'){
                    $temp['evaluation']="<a href=\"".SITE_URL."/evaluation_c/satisfaction_list_init/".
                                        $class_id."/".$course_id."/".$temp['subject_id']."/".
                                        $temp['teacher_id']."\">"."查看"."</a>";
                } else {
                    $temp['evaluation']="";
                }
             }

            $temp['subject_id']="<a href=\"".SITE_URL."/evaluation_c/student_ev_lst/".$class_id."/".
                                $course_id."/".$temp['subject_id']."\">".$temp['subject_id']."</a>";
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
        $evaluationData = $this->evaluationteacher_m->select($data);

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

        $this->evaluationteacher_m->insertorupdate($data);

        self::subject_lst($class_id,$course_id);
    }

    public function satisfaction_add_init($class_id,$course_id,$subject_id,$teacher_id,$student_id=null,$return_flg=null){
        $data = array();

        if(empty($student_id)){
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
		}
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['teacher_id'] = $teacher_id;
        $data['student_id'] = $student_id;
        $satisfactionData = $this->satisfaction_m->select($data);
        if(empty($satisfactionData)){
            $satisfaction_add_flg = "0";
        } else {
            $satisfaction_add_flg = "1";
        }
        $data = $satisfactionData;
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['teacher_id'] = $teacher_id;
        $data['return_flg'] = $return_flg;
        $data['satisfaction_add_flg'] = $satisfaction_add_flg;
        $this->load->view('satisfaction_add_v',$data);
    }

    public function satisfaction_add(){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $class_id = $this->input->post('class_id');
        $course_id = $this->input->post('course_id');
        $subject_id = $this->input->post('subject_id');
        $teacher_id = $this->input->post('teacher_id');
        $scores_01 = $this->input->post('scores_01');
        $scores_02 = $this->input->post('scores_02');
        $scores_03 = $this->input->post('scores_03');
        $scores_04 = $this->input->post('scores_04');
        $scores_05 = $this->input->post('scores_05');
        $scores_06 = $this->input->post('scores_06');
        $scores_07 = $this->input->post('scores_07');
        $scores_08 = $this->input->post('scores_08');
        $scores_09 = $this->input->post('scores_09');
        $scores_10 = $this->input->post('scores_10');
        $scores_11 = $this->input->post('scores_11');
        $scores_12 = $this->input->post('scores_12');
        $scores_13 = $this->input->post('scores_13');
        $scores_14 = $this->input->post('scores_14');
        $scores_15 = $this->input->post('scores_15');
        $scores_16 = $this->input->post('scores_16');
        $remarks = $this->input->post('remarks');

        $user_id = $this->session->userdata('user_id');
        $user = $this->user_m->getOne($user_id);
        $student = $this->student_m->getStudentId($user['0']['user']);
        $student_id = $student['student_id'];

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['teacher_id'] = $teacher_id;
        $data['student_id'] = $student_id;
        $data['scores_01'] = $scores_01;
        $data['scores_02'] = $scores_02;
        $data['scores_03'] = $scores_03;
        $data['scores_04'] = $scores_04;
        $data['scores_05'] = $scores_05;
        $data['scores_06'] = $scores_06;
        $data['scores_07'] = $scores_07;
        $data['scores_08'] = $scores_08;
        $data['scores_09'] = $scores_09;
        $data['scores_10'] = $scores_10;
        $data['scores_11'] = $scores_11;
        $data['scores_12'] = $scores_12;
        $data['scores_13'] = $scores_13;
        $data['scores_14'] = $scores_14;
        $data['scores_15'] = $scores_15;
        $data['scores_16'] = $scores_16;
        $data['remarks'] = $remarks;
        $data['delete_flg'] = "0";
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        $this->satisfaction_m->insertorupdate($data);

        self::subject_lst($class_id,$course_id);
    }

    public function teacher_ev_lst($class_id,$course_id,$subject_id,$teacher_id){
        $data = array();

        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        if (empty($subject_id)) {
            $subject_id = $this->input->post('subject_id');
        }
        if (empty($teacher_id)) {
            $teacher_id = $this->input->post('teacher_id');
        }

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['teacher_id'] = $teacher_id;
        $teacherData = $this->satisfaction_m->selectTeacherEV($data);
        $data['teacherData'] = @json_encode(array('Rows'=>$teacherData));

        $evaluationData = $this->evaluationteacher_m->select($data);
        if (!empty($evaluationData)) {
            $data['attendance_scores'] = $evaluationData['attendance_scores'];
        }

        $teacherEvData = $this->satisfaction_m->getTeacherEV($data);
        if (!empty($teacherEvData)) {
            $data['scores'] = round($teacherEvData['scores']);
        }

        $this->load->view('evaluation_teacher_v',$data);
    }

    public function student_ev_lst($class_id,$course_id,$subject_id){
        $data = array();

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        $data['student_id'] = '';
        $data['student_ev_flg'] = '0';
        if($role_id == '1007'){
            $data['student_ev_flg'] = '1';
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
            $data['student_id'] = $student_id;
        }
        //---------------------------------------------------------------//
        $studentData = $this->evaluationstudent_m->selectStudentEV($data);
        foreach($studentData as &$temp){
            if ($data['student_ev_flg'] == '1') {
                $temp['scores']="";
            } else {
                $temp['scores']="<a href=\"".SITE_URL."/evaluation_c/student_ev_add_init/".$class_id."/".
                            $course_id."/".$subject_id."/".$temp['student_id']."\">"."评价"."</a>";
            }
        }
        $data['studentData'] = @json_encode(array('Rows'=>$studentData));

        $this->load->view('evaluation_student_v',$data);
    }

    public function student_ev_add_init($class_id,$course_id,$subject_id,$student_id){
        $data = array();

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['student_id'] = $student_id;
        $studentData = $this->evaluationstudent_m->selectStudentEV($data);
        $data = $studentData[0];
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['student_id'] = $student_id;

        $this->load->view('evaluation_studentev_add_v',$data);
    }

    public function student_ev_add(){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $class_id = $this->input->post('class_id');
        $course_id = $this->input->post('course_id');
        $subject_id = $this->input->post('subject_id');
        $student_id = $this->input->post('student_id');
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['student_id'] = $student_id;
        $data['attendance_scores'] = $this->input->post('attendance_scores');
        $data['works_scores'] = $this->input->post('works_scores');
        $data['performance_scores'] = $this->input->post('performance_scores');
        $data['homework_scores'] = $this->input->post('homework_scores');
        $data['remarks'] = $this->input->post('remarks');
        $data['delete_flg'] = $this->input->post('delete_flg');
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->evaluationstudent_m->insertorupdate($data);

        self::student_ev_update($class_id,$course_id,$student_id);

        self::student_ev_lst($class_id,$course_id,$subject_id);
    }

    private function student_ev_update($class_id,$course_id,$student_id){
        $data = array();
        $scores = 0;
        $scores_sum = 0;
        $scores_avg = 0;

        $ev = $this->code_m->getList("10");
        $works_ev = $ev['作品分数']['1']/100;
        $attendance_ev = $ev['出勤分数']['2']/100;
        $performance_ev = $ev['课堂表现']['3']/100;
        $homework_ev = $ev['课后作业']['4']/100;

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['student_id'] = $student_id;

        $subjectData = $this->evaluationstudent_m->selectForS($data);
        foreach($subjectData as $temp){
            $scores = round($temp['works_scores']*$works_ev+$temp['attendance_scores']*$attendance_ev+
                            $temp['performance_scores']*$performance_ev+$temp['homework_scores']*$homework_ev);
            $scores_sum = $scores_sum + $scores;
        }
        if (count($subjectData) > 0) {
            $scores_avg = round($scores_sum/count($subjectData));
            $userinfo = $this->session->userdata('user');
            $data['student_id'] = $student_id;
            $data['scores'] = $scores_avg;
            $data['update_user'] = $userinfo;
            $data['update_time'] = date("Y-m-d H:i:s");
            $this->student_m->updateScores($data);
        }
    }

    public function satisfaction_list_init($class_id,$course_id,$subject_id,$teacher_id){
        $data = array();

        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        if (empty($subject_id)) {
            $subject_id = $this->input->post('subject_id');
        }
        if (empty($teacher_id)) {
            $teacher_id = $this->input->post('teacher_id');
        }

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['teacher_id'] = $teacher_id;
        $satisfactionData = $this->satisfaction_m->selectTeacherEV($data);
        foreach($satisfactionData as &$temp){
            $temp['view']="<a href=\"".SITE_URL."/evaluation_c/satisfaction_add_init/".
                                $class_id."/".$course_id."/".$subject_id."/".$teacher_id."/"
                                .$temp['student_id']."/1"."\">"."查看"."</a>";
        }
        $data['satisfactionData'] = @json_encode(array('Rows'=>$satisfactionData));

        $this->load->view('satisfaction_lst_v',$data);

	}
}