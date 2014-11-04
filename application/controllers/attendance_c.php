<?php
class Attendance_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100101");
        $this->load->model('class_m','class_m');
        $this->load->model('student_m','student_m');
        $this->load->model('attendance_m','attendance_m');
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
        $data['url_sub_id'] = "10010101";
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
            $temp['class_no']="<a href=\"".SITE_URL."/attendance_c/student_lst/".$temp['class_id']."\">".$temp['class_no']."</a>";
        }
        $statusLst = $this->code_m->getList("05");
        $data['statusLst'] = $statusLst;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('attendance_class_v',$data);
    }

    public function search()
    {
        $data = array();
        $classData = array();

        log_message('info', "attendance_c search post:".var_export($_POST,true));

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
            $temp['class_no']="<a href=\"".SITE_URL."/attendance_c/student_lst/".$temp['class_id']."\">".$temp['class_no']."</a>";
        }
        $statusLst = $this->code_m->getList("05");
        $data['statusLst'] = $statusLst;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        //---------------------------------------------------------//
        $userinfo = $this->session->userdata('user');
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10010101";
        $data['session_01'] = $status;
        $data['session_02'] = $search_key;
        $data['session_03'] = null;
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->session_m->insertorupdate($data);
        //---------------------------------------------------------//
        $this->load->view('attendance_class_v',$data);
    }

    public function student_lst($class_id=null){
        $data = array();
        $studentData = array();
        $today = "";
        $start_date = "";
        $end_date = "";

        log_message('info', "attendance_c student_lst post:".var_export($_POST,true));

        $data['search_key'] = $this->input->post('txtKey');
        if (empty($class_id)) {
            $class_id =  $this->input->post('class_id');
        }
        $data['class_id'] =  $class_id;

        $today = $this->input->post('today');
        if (empty($today)) {
            $today = date("Y-m-d");
        }
        $start_date = $this->input->post('start_date');
        if (empty($start_date)) {
            $start_date = substr(date("Y-m-d"),0,8)."01";
        }
        $end_date = $this->input->post('end_date');
        if (empty($end_date)) {
            $this->load->helper('date');
            $month = substr(date("Y-m-d"),5,6);
            $day = days_in_month($month);
            $end_date = substr(date("Y-m-d"),0,8).$day;
        }
        $data['today'] = $today;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        $data['student_id'] = '';
        $data['attendance_flg'] = '0';
        if($role_id == '1007'){
            $data['attendance_flg'] = '1';
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
            $data['student_id'] = $student_id;
        }
        //---------------------------------------------------------------//
        $studentData = $this->attendance_m->getAttendanceSumList($data);
        $attendance_sum = 0;
        $attendance_fact = 0;
        $attendance_percent = 0;
        foreach($studentData as &$temp){
            $temp['student_no']="<a href=\"".SITE_URL."/attendance_c/show_student/".$class_id."/".$temp['student_id']."\">".$temp['student_no']."</a>";
            $attendance_sum = $attendance_sum + $temp['status_1'] + $temp['status_2'] + $temp['status_3'] + $temp['status_4'];
            $attendance_fact = $attendance_fact + $temp['status_1'];
        }
        if($attendance_sum !=0 ) {
            $attendance_percent = round($attendance_fact/$attendance_sum,2);
        }
        $attendance_percent = $attendance_percent*100;
        $attendance_percent = $attendance_percent."%";
        $data['attendance_sum'] = $attendance_sum;
        $data['attendance_fact'] = $attendance_fact;
        $data['attendance_percent'] = $attendance_percent;

        $data['studentData'] = @json_encode(array('Rows'=>$studentData));
        log_message('info', "attendance_c student_lst data:".var_export($data,true));

        $this->load->view('attendance_lst_v',$data);
    }

    public function add_attendance_init($class_id,$attendance_date)
    {
        $data = array();
        $studentData = array();

        log_message('info', "attendance_c add_attendance_init post:".var_export($_POST,true));

        $data['search_key'] =  "";
        $data['class_id'] =  $class_id;
        $data['today'] = $attendance_date;
        $studentData = $this->attendance_m->getAttendanceList($data);
        $i = 0;
        foreach($studentData as &$temp){
          if ($temp['am_status'] == "1") {
              $temp['attendance_am']="<input id='am_1".$i."' type='radio' name='am_".$i."' value='1' checked='checked' /><label for='am_".$i."'>出勤</label>&nbsp<input id='am_2".$i."' type='radio' name='am_".$i."' value='2' />&nbsp<label for='am_".$i."'>迟到</label><input id='am_3".$i."' type='radio' name='am_".$i."' value='3' />&nbsp<label for='am_".$i."'>请假</label><input id='am_4".$i."' type='radio' name='am_".$i."' value='4' />&nbsp<label for='am_".$i."'>旷课</label>";
          } else if ($temp['am_status'] == "2") {
              $temp['attendance_am']="<input id='am_1".$i."' type='radio' name='am_".$i."' value='1' /><label for='am_".$i."'>出勤</label>&nbsp<input id='am_2".$i."' type='radio' name='am_".$i."' value='2' checked='checked' />&nbsp<label for='am_".$i."'>迟到</label><input id='am_3".$i."' type='radio' name='am_".$i."' value='3' />&nbsp<label for='am_".$i."'>请假</label><input id='am_4".$i."' type='radio' name='am_".$i."' value='4' />&nbsp<label for='am_".$i."'>旷课</label>";
          } else if ($temp['am_status'] == "3") {
              $temp['attendance_am']="<input id='am_1".$i."' type='radio' name='am_".$i."' value='1' /><label for='am_".$i."'>出勤</label>&nbsp<input id='am_2".$i."' type='radio' name='am_".$i."' value='2' />&nbsp<label for='am_".$i."'>迟到</label><input id='am_3".$i."' type='radio' name='am_".$i."' value='3' checked='checked' />&nbsp<label for='am_".$i."'>请假</label><input id='am_4".$i."' type='radio' name='am_".$i."' value='4' />&nbsp<label for='am_".$i."'>旷课</label>";
          } else if ($temp['am_status'] == "4") {
              $temp['attendance_am']="<input id='am_1".$i."' type='radio' name='am_".$i."' value='1' /><label for='am_".$i."'>出勤</label>&nbsp<input id='am_2".$i."' type='radio' name='am_".$i."' value='2' />&nbsp<label for='am_".$i."'>迟到</label><input id='am_3".$i."' type='radio' name='am_".$i."' value='3' />&nbsp<label for='am_".$i."'>请假</label><input id='am_4".$i."' type='radio' name='am_".$i."' value='4' checked='checked' />&nbsp<label for='am_".$i."'>旷课</label>";
          } else {
              $temp['attendance_am']="<input id='am_1".$i."' type='radio' name='am_".$i."' value='1' checked='checked' /><label for='am_".$i."'>出勤</label>&nbsp<input id='am_2".$i."' type='radio' name='am_".$i."' value='2' />&nbsp<label for='am_".$i."'>迟到</label><input id='am_3".$i."' type='radio' name='am_".$i."' value='3' />&nbsp<label for='am_".$i."'>请假</label><input id='am_4".$i."' type='radio' name='am_".$i."' value='4' />&nbsp<label for='am_".$i."'>旷课</label>";
          }
          if ($temp['pm_status'] == "1") {
              $temp['attendance_pm']="<input id='pm_1".$i."' type='radio' name='pm_".$i."' value='1' checked='checked' /><label for='pm_".$i."'>出勤</label>&nbsp<input id='pm_2".$i."' type='radio' name='pm_".$i."' value='2' />&nbsp<label for='pm_".$i."'>迟到</label><input id='pm_3".$i."' type='radio' name='pm_".$i."' value='3' />&nbsp<label for='pm_".$i."'>请假</label><input id='pm_4".$i."' type='radio' name='pm_".$i."' value='4' />&nbsp<label for='pm_".$i."'>旷课</label>";
          } else if ($temp['pm_status'] == "2") {
              $temp['attendance_pm']="<input id='pm_1".$i."' type='radio' name='pm_".$i."' value='1' /><label for='pm_".$i."'>出勤</label>&nbsp<input id='pm_2".$i."' type='radio' name='pm_".$i."' value='2' checked='checked' />&nbsp<label for='pm_".$i."'>迟到</label><input id='pm_3".$i."' type='radio' name='pm_".$i."' value='3' />&nbsp<label for='pm_".$i."'>请假</label><input id='pm_4".$i."' type='radio' name='pm_".$i."' value='4' />&nbsp<label for='pm_".$i."'>旷课</label>";
          } else if ($temp['pm_status'] == "3") {
              $temp['attendance_pm']="<input id='pm_1".$i."' type='radio' name='pm_".$i."' value='1' /><label for='pm_".$i."'>出勤</label>&nbsp<input id='pm_2".$i."' type='radio' name='pm_".$i."' value='2' />&nbsp<label for='pm_".$i."'>迟到</label><input id='pm_3".$i."' type='radio' name='pm_".$i."' value='3' checked='checked' />&nbsp<label for='pm_".$i."'>请假</label><input id='pm_4".$i."' type='radio' name='pm_".$i."' value='4' />&nbsp<label for='pm_".$i."'>旷课</label>";
          } else if ($temp['pm_status'] == "4") {
              $temp['attendance_pm']="<input id='pm_1".$i."' type='radio' name='pm_".$i."' value='1' /><label for='pm_".$i."'>出勤</label>&nbsp<input id='pm_2".$i."' type='radio' name='pm_".$i."' value='2' />&nbsp<label for='pm_".$i."'>迟到</label><input id='pm_3".$i."' type='radio' name='pm_".$i."' value='3' />&nbsp<label for='pm_".$i."'>请假</label><input id='pm_4".$i."' type='radio' name='pm_".$i."' value='4' checked='checked' />&nbsp<label for='pm_".$i."'>旷课</label>";
          } else {
              $temp['attendance_pm']="<input id='pm_1".$i."' type='radio' name='pm_".$i."' value='1' checked='checked' /><label for='pm_".$i."'>出勤</label>&nbsp<input id='pm_2".$i."' type='radio' name='pm_".$i."' value='2' />&nbsp<label for='pm_".$i."'>迟到</label><input id='pm_3".$i."' type='radio' name='pm_".$i."' value='3' />&nbsp<label for='pm_".$i."'>请假</label><input id='pm_4".$i."' type='radio' name='pm_".$i."' value='4' />&nbsp<label for='pm_".$i."'>旷课</label>";
          }

            $i = $i + 1;
        }

        $data['studentData'] = @json_encode(array('Rows'=>$studentData));
        $this->load->view('attendance_add_v',$data);
    }

    public function add_attendance()
    {
        $data = array();
        $datatmp = array();

        log_message('info', "attendance_c add_attendance post:".var_export($_POST,true));

        $class_id = $this->input->post('class_id');
        $data['search_key'] =  "";
        $data['class_id'] = $this->input->post('class_id');
        $data['today'] = $this->input->post('today');
        $studentData = $this->attendance_m->getAttendanceList($data);

        $datatmp['class_id'] = $this->input->post('class_id');
        $datatmp['today'] = $this->input->post('today');
        $datatmp['insert_user'] = $this->session->userdata('user');
        $datatmp['insert_time'] = date("Y-m-d H:i:s");
        $datatmp['update_user'] = $this->session->userdata('user');
        $datatmp['update_time'] = date("Y-m-d H:i:s");

        $this->attendance_m->deleteAttendance($datatmp);

        $i = 0;
        foreach($studentData as $temp){
            $datatmp['student_id'] = $temp['student_id'];
            $am_status = $this->input->post('am_'.$i);
            $pm_status = $this->input->post('pm_'.$i);
            $datatmp['am_status'] = $am_status;
            $datatmp['pm_status'] = $pm_status;

            $this->attendance_m->insertAttendance($datatmp);
            $i = $i + 1;
        }

        redirect("attendance_c/student_lst/".$class_id);

    }

     public function show_student($class_id=null,$student_id=null){
        $data = array();
        $studentData = array();
        $studentName = array();

        log_message('info', "attendance_c show_student post:".var_export($_POST,true));

        if (empty($class_id)) {
            $data['class_id'] = $this->input->post('class_id');
        } else {
            $data['class_id'] = $class_id;
        }
        if (empty($student_id)) {
            $data['student_id'] = $this->input->post('student_id');
        } else {
            $data['student_id'] = $student_id;
        }

        $start_year = $this->input->post('start_year');
        if (empty($start_year)) {
            $start_year = substr(date("Y-m-d"),0,4);
        }
        $start_month = $this->input->post('start_month');
        if (empty($start_month)) {
            $start_month = substr(date("Y-m-d"),5,2);
        }
        $data['search_ymd_start'] = $start_year.'-'.substr("0".$start_month,-2).'-'.'01';
        $data['search_ymd_end'] = $start_year.'-'.substr("0".$start_month,-2).'-'.'31';
        $studentData = $this->attendance_m->getAttendanceForStudent($data);
        $studentName = $this->student_m->getStudentName($student_id);
        if (!empty($studentName)) {
            $data['student_name'] = $studentName[0]['student_name'];
        } else {
            $data['student_name'] = "";
        }
        $data['start_year'] = $start_year;
        $data['start_month'] = $start_month;
        $data['studentData'] = @json_encode(array('Rows'=>$studentData));

        $this->load->view('attendance_student_lst_v',$data);
     }
}