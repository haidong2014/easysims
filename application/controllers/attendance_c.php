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
        $studentData = $this->attendance_m->getAttendanceList($data);

        foreach($studentData as &$temp){
            $temp['student_no']="<a href=\"".SITE_URL."/attendance_c/student_lst/".$temp['student_no']."\">".$temp['student_no']."</a>";
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
        $studentData = $this->attendance_m->getAttendanceList($data);

        foreach($studentData as &$temp){
            $temp['student_no']="<a href=\"".SITE_URL."/attendance_c/student_lst/".$temp['student_no']."\">".$temp['student_no']."</a>";
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
        $today = date("Y-m-d");
        $studentData = $this->attendance_m->getAttendanceList($data);
        $i = 0;
        foreach($studentData as &$temp){
            $temp['attendance_am']="<input id='am_'".$i." type='radio' name='am_'".$i." value='1' checked='checked' /><label for='am_'".$i.">出勤</label>&nbsp<input id='am_'".$i." type='radio' name='am_'".$i." value='2' />&nbsp<label for='am_'".$i.">迟到</label><input id='am_'".$i." type='radio' name='am_'".$i." value='3' />&nbsp<label for='am_'".$i.">请假</label><input id='am_'".$i." type='radio' name='am_'".$i." value='4' />&nbsp<label for='am_'".$i.">旷课</label>";
            $temp['attendance_pm']="<input id='pm_'".$i." type='radio' name='pm_'".$i." value='1' checked='checked' /><label for='pm_'".$i.">出勤</label>&nbsp<input id='pm_'".$i." type='radio' name='pm_'".$i." value='2' />&nbsp<label for='pm_'".$i.">迟到</label><input id='pm_'".$i." type='radio' name='pm_'".$i." value='3' />&nbsp<label for='pm_'".$i.">请假</label><input id='pm_'".$i." type='radio' name='pm_'".$i." value='4' />&nbsp<label for='pm_'".$i.">旷课</label>";
            $i = $i + 1;
        }
        log_message('info', "attendance_c add_attendance_init post:".var_export($studentData,true));

        $data['studentData'] = @json_encode(array('Rows'=>$studentData));
        $data['today'] = $today;
        $this->load->view('attendance_add_v',$data);
    }

    public function add_user_init(){

        $data = array();
        $usergroups = array();

        $data['search_key'] = "";
        $usergroupsData = $this->usergroups_m->getList($data);
        $i = 0;
        foreach($usergroupsData as $dataug){
            $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"");
            $i = $i+1;
        }
        $data['usergroups'] = $usergroups;
        $data['delete_flg'] = "0";
        $data['msgFlg'] = "1";
        $data['user'] = "";
        $data['user_name'] = "";
        $data['remarks'] = "";
        $data['user_id'] = "";
        $this->load->view('user_add_v',$data);
    }

    public function add_user(){
        log_message('info', "user_c add_user post:".var_export($_POST,true));

        $data = array();
        $usergroups = array();

        $userinfo = $this->session->userdata('user');

        $user_id = $this->input->post('txtUserId');
        $user = $this->input->post('txtUser');
        $password = $this->input->post('txtPassword');
        $user_name = $this->input->post('txtName');
        $role_id = $this->input->post('ddlRole');
        $remarks = $this->input->post('txtRemarks');
        $delete_flg = $this->input->post('rbtDeleteFlg');
        $insert_user = $userinfo;
        $insert_time = date("Y-m-d H:i:s");
        $update_user = $userinfo;
        $update_time = date("Y-m-d H:i:s");

        $data['user_id'] = $user_id;
        $data['user'] = $user;
        if (empty($password)){
            $data['password'] = "";
        } else {
            $data['password'] = md5($password);
        }
        $data['user_name'] = $user_name;
        $data['role_id'] = $role_id;
        $data['remarks'] = $remarks;
        $data['delete_flg'] = $delete_flg;
        $data['insert_user'] = $insert_user;
        $data['insert_time'] = $insert_time;
        $data['update_user'] = $update_user;
        $data['update_time'] = $update_time;

        if(empty($user_id)){
            $this->user_m->addOne($data);
        } else {
            $this->user_m->updOne($data);
        }

        redirect("user_c");
    }

    public function view_user_init($user_id = null){
        $data = array();

        $userData = $this->user_m->getOne($user_id);
        if(count($userData) == 1){
            $data = $userData[0];
        }

        $data['search_key'] = "";
        $usergroupsData = $this->usergroups_m->getList($data);
        $i = 0;
        foreach($usergroupsData as $dataug){
      if ($dataug['role_id'] == $userData[0]['role_id']){
                $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"selected");
      } else {
                $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"");
      }
            $i = $i+1;
        }
        $data['usergroups'] = $usergroups;

        $this->load->view('user_view_v',$data);
    }

    public function upd_user_init($user_id = null){
        $data = array();

        $userData = $this->user_m->getOne($user_id);
        if(count($userData) == 1){
            $data = $userData[0];
        }

        $data['search_key'] = "";
        $usergroupsData = $this->usergroups_m->getList($data);
        $i = 0;
        foreach($usergroupsData as $dataug){
        if ($dataug['role_id'] == $userData[0]['role_id']){
                $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"selected");
        } else {
                $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"");
        }
            $i = $i+1;
        }
        $data['usergroups'] = $usergroups;
        $data['msgFlg'] = "1";
        $this->load->view('user_add_v',$data);
    }

    public function chk_user($user){
        log_message('info', "user_c chk_user start");
        log_message('info', "user_c chk_user post user:".$user);
        $checkuser = $this->user_m->checkUser($user);
        $msg = "此登录ID已经被注册！";
        if(!empty($checkuser)){
            echo urldecode(json_encode(urlencode($msg)));
        }

        log_message('info', "user_c chk_user end");
    }
}