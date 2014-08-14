<?php
class Attendance_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100101");
        $this->load->model('class_m','class_m');
        $this->load->model('student_m','student_m');
        $this->load->model('attendance_m','attendance_m');
    }

    public function index()
    {
        $data = array();
        $classData = array();

        $user = $this->session->all_userdata();
        log_message('info', "attendance_c index user:".var_export($user,true));
        log_message('info', "attendance_c index post:".var_export($_POST,true));

        $data['search_key'] =  $this->input->post('txtKey');
        $classData = $this->class_m->getList($data);

        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/attendance_c/student_lst/".$temp['class_no']."\">".$temp['class_no']."</a>";
        }

        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('attendance_class_v',$data);
    }

    public function search_class()
    {
        $data = array();
        $classData = array();

        $user = $this->session->all_userdata();
        log_message('info', "attendance_c search_class user:".var_export($user,true));
        log_message('info', "attendance_c search_class post:".var_export($_POST,true));

        $data['search_key'] = $this->input->post('txtKey');
        $classData = $this->class_m->getList($data);

        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/attendance_c/student_lst/".$temp['class_no']."\">".$temp['class_no']."</a>";
        }

        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('attendance_class_v',$data);
    }

    public function student_lst($class_no){
        $data = array();
        $studentData = array();

        $user = $this->session->all_userdata();
        log_message('info', "attendance_c student_lst user:".var_export($user,true));
        log_message('info', "attendance_c student_lst post:".var_export($_POST,true));

        $data['search_key'] =  $this->input->post('txtKey');
        $data['class_no'] =  $class_no;
        $data['today'] = date("Y-m-d");
        $studentData = $this->attendance_m->getAttendanceSumList($data);

        foreach($studentData as &$temp){
            $temp['student_no']="<a href=\"".SITE_URL."/attendance_c/show_student/".$class_no."/".$temp['student_no']."\">".$temp['student_no']."</a>";
        }

        $data['studentData'] = @json_encode(array('Rows'=>$studentData));
        $data['class_no'] = $class_no;
        $this->load->view('attendance_lst_v',$data);
    }

    public function search_student()
    {
        $data = array();
        $studentData = array();

        $user = $this->session->all_userdata();
        log_message('info', "attendance_c student_lst user:".var_export($user,true));
        log_message('info', "attendance_c student_lst post:".var_export($_POST,true));

        $data['search_key'] =  $this->input->post('txtKey');
        $data['class_no'] =  $this->input->post('txtClassNo');
        $data['today'] = date("Y-m-d");
        $studentData = $this->attendance_m->getAttendanceSumList($data);

        foreach($studentData as &$temp){
            $temp['student_no']="<a href=\"".SITE_URL."/attendance_c/show_student/".$data['class_no']."/".$temp['student_no']."\">".$temp['student_no']."</a>";
        }

        $data['studentData'] = @json_encode(array('Rows'=>$studentData));
        $this->load->view('attendance_lst_v',$data);
    }

    public function add_attendance_init($class_no)
    {
        $data = array();
        $studentData = array();

        $user = $this->session->all_userdata();
        log_message('info', "attendance_c add_attendance_init user:".var_export($user,true));
        log_message('info', "attendance_c add_attendance_init post:".var_export($_POST,true));

        $data['search_key'] =  "";
        $data['class_no'] =  $class_no;
        $data['today'] = date("Y-m-d");
        $studentData = $this->attendance_m->getAttendanceList($data);
        log_message('info', "attendance_c add_attendance_init post:".var_export($studentData,true));
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

        $user = $this->session->all_userdata();
        log_message('info', "attendance_c add_attendance user:".var_export($user,true));
        log_message('info', "attendance_c add_attendance post:".var_export($_POST,true));

        $data['search_key'] =  "";
        $data['class_no'] =  $this->input->post('txtClassNo');
        $data['today'] = date("Y-m-d");
        $studentData = $this->attendance_m->getAttendanceList($data);

        $datatmp['class_no'] = $this->input->post('txtClassNo');
        $datatmp['today'] = date("Y-m-d");
        $datatmp['insert_user'] = $this->session->userdata('user');
        $datatmp['insert_time'] = date("Y-m-d H:i:s");
        $datatmp['update_user'] = $this->session->userdata('user');
        $datatmp['update_time'] = date("Y-m-d H:i:s");

        $this->attendance_m->deleteAttendance($datatmp);

        $i = 0;
        foreach($studentData as $temp){
            $datatmp['student_no'] = $temp['student_no'];
            $datatmp['am_status'] = $this->input->post('am_'.$i);
            $datatmp['pm_status'] = $this->input->post('pm_'.$i);
            $datatmp['status'] = $this->input->post('pm_'.$i);
            $this->attendance_m->insertAttendance($datatmp);
            $i = $i + 1;
        }


        $studentData = $this->attendance_m->getAttendanceSumList($data);
        foreach($studentData as &$temp){
            $temp['student_no']="<a href=\"".SITE_URL."/attendance_c/show_student/".$data['class_no']."/".$temp['student_no']."\">".$temp['student_no']."</a>";
        }
        $data['studentData'] = @json_encode(array('Rows'=>$studentData));
        $this->load->view('attendance_lst_v',$data);
    }

     public function show_student($class_no,$student_no){
        $data = array();
        $studentData = array();

        $user = $this->session->all_userdata();
        log_message('info', "attendance_c show_student user:".var_export($user,true));
        log_message('info', "attendance_c show_student post:".var_export($_POST,true));

        $data['class_no'] = $class_no;
        $data['student_no'] = $student_no;
        $studentData = $this->attendance_m->getAttendanceForStudent($data);

        $data['studentData'] = @json_encode(array('Rows'=>$studentData));
        $this->load->view('attendance_student_lst_v',$data);
     }
}