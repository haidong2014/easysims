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
            $am_status = $this->input->post('am_'.$i);
            $pm_status = $this->input->post('pm_'.$i);
            $datatmp['am_status'] = $am_status;
            $datatmp['pm_status'] = $pm_status;

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

     public function show_student($class_no=null,$student_no=null){
        $data = array();
        $studentData = array();
        $studentName = array();

        $user = $this->session->all_userdata();
        log_message('info', "attendance_c show_student user:".var_export($user,true));
        log_message('info', "attendance_c show_student post:".var_export($_POST,true));

        if (empty($class_no)) {
            $data['class_no'] = $this->input->post('txtClassNo');
        } else {
            $data['class_no'] = $class_no;
        }
        if (empty($student_no)) {
            $data['student_no'] = $this->input->post('txtStudentNo');
        } else {
            $data['student_no'] = $student_no;
        }

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
            $search_ymd_start = $year[$ddlYear]['name']."-".$month[$ddlMonth]['name']."-01";
            $search_ymd_end = $year[$ddlYear]['name']."-".$month[$ddlMonth]['name']."-31";
            $year[$ddlYear]['sel'] = "selected";
            $month[$ddlMonth]['sel'] = "selected";

            $data['search_ymd_start'] =  $search_ymd_start;
            $data['search_ymd_end'] =  $search_ymd_end;
        }

        $data['year'] = $year;
        $data['month'] = $month;

        $studentData = $this->attendance_m->getAttendanceForStudent($data);
        $studentName = $this->student_m->getStudentName($data['student_no']);
        if (!empty($studentName)) {
            $data['student_name'] = $studentName[0]['student_name'];
        } else {
            $data['student_name'] = "";
        }

        $data['studentData'] = @json_encode(array('Rows'=>$studentData));

        $this->load->view('attendance_student_lst_v',$data);
     }
}