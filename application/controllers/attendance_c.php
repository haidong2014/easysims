<?php
class Attendance_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100101");
        $this->load->model('class_m','class_m');
        $this->load->model('student_m','student_m');
        $this->load->model('attendance_m','attendance_m');
        $this->load->model('code_m','code_m');
    }

    public function index()
    {
        $data = array();
        $classData = array();

        log_message('info', "attendance_c index post:".var_export($_POST,true));

        $data['search_key'] =  $this->input->post('txtKey');
        $status =  $this->input->post('status');
        if (empty($status)) {
          $status = "2";
        }
        $data['status'] = $status;
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/attendance_c/student_lst/".$temp['class_id']."\">".$temp['class_no']."</a>";
        }
        $statusLst = $this->code_m->getList("05");
        $data['statusLst'] = $statusLst;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('attendance_class_v',$data);
    }

    public function student_lst($class_id=null){
        $data = array();
        $studentData = array();

        log_message('info', "attendance_c student_lst post:".var_export($_POST,true));

        $data['search_key'] =  $this->input->post('txtKey');
        if (empty($class_id)) {
            $class_id =  $this->input->post('class_id');
        }
        $data['class_id'] =  $class_id;
        $data['today'] = date("Y-m-d");
        $studentData = $this->attendance_m->getAttendanceSumList($data);
        foreach($studentData as &$temp){
            $temp['student_no']="<a href=\"".SITE_URL."/attendance_c/show_student/".$class_id."/".$temp['student_id']."\">".$temp['student_no']."</a>";
        }

        $data['studentData'] = @json_encode(array('Rows'=>$studentData));
        $this->load->view('attendance_lst_v',$data);
    }

    public function add_attendance_init($class_id)
    {
        $data = array();
        $studentData = array();

        log_message('info', "attendance_c add_attendance_init post:".var_export($_POST,true));

        $data['search_key'] =  "";
        $data['class_id'] =  $class_id;
        $data['today'] = date("Y-m-d");
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

        $data['search_key'] =  "";
        $data['class_id'] =  $this->input->post('class_id');
        $data['today'] = date("Y-m-d");
        $studentData = $this->attendance_m->getAttendanceList($data);

        $datatmp['class_id'] = $this->input->post('class_id');
        $datatmp['today'] = date("Y-m-d");
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

        $studentData = $this->attendance_m->getAttendanceSumList($data);
        foreach($studentData as &$temp){
            $temp['student_no']="<a href=\"".SITE_URL."/attendance_c/show_student/".$data['class_id']."/".$temp['student_id']."\">".$temp['student_no']."</a>";
        }
        $data['studentData'] = @json_encode(array('Rows'=>$studentData));
        $this->load->view('attendance_lst_v',$data);
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