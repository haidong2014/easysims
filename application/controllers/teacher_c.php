<?php
class Teacher_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100403");
        $this->load->model('teacher_m','teacher_m');
    }

    public function index(){
        $data = array();
        $user = $this->session->all_userdata();
        log_message('info', "teacher_c index user:".var_export($user,true));
        log_message('info', "teacher_c index post:".var_export($_POST,true));

        $keyword = $this->input->post('txtKey');
        $teacherData = $this->teacher_m->getList($keyword);

        foreach($teacherData as &$data){
            $data['opt']="<a href=\"".SITE_URL."/teacher_c/view_teacher_init/".$data['teacher_id']."\">查看</a> |".
            "<a href=\"".SITE_URL."/teacher_c/upd_teacher_init/".$data['teacher_id']."\">编辑</a> |".
            "<a href=\"#\" onclick=\"delTeacher('".SITE_URL."/teacher_c/delete_teacher/".$data['teacher_id']."')\">删除</a>";
        }
        $data['keyword'] = $keyword;
        $data['teachersData'] = @json_encode(array('Rows'=>$teacherData));
        $this->load->view('teacher_lst_v',$data);
    }

    public function add_teacher_init(){
        $data = array();

        $maxId = $this->teacher_m->getMaxId();
        if (empty($maxId[0]['max_id'])) {
            $data['teacher_no'] = "T1000";
        } else {
            $data['teacher_no'] = "T".($maxId[0]['max_id']+1);
        }

        $data['sex'] = "1";
        $data['property'] = "1";
        $data['system_user'] = "1";
        $this->load->view('teacher_add_v',$data);
    }

    public function add_teacher(){

        $data = array();
        $user = $this->session->all_userdata();
        log_message('info', "teacher_c add_teacher user:".var_export($user,true));
        log_message('info', "teacher_c add_teacher post:".var_export($_POST,true));

        $userinfo = $this->session->userdata('user');
        $teacher_id = $this->input->post('teacher_id');
        $teacher_no = $this->input->post('teacher_no');
        $teacher_name = $this->input->post('teacher_name');
        $system_user = $this->input->post('system_user');

        $data['teacher_id'] = $teacher_id;
        $data['teacher_no'] = $teacher_no;
        $data['teacher_name'] = $teacher_name;
        $data['sex'] = $this->input->post('sex');
        $data['birthday'] = $this->input->post('birthday');
        $data['property'] = $this->input->post('property');
        $data['course'] = $this->input->post('course');
        $data['telephone'] = $this->input->post('telephone');
        $data['email'] = $this->input->post('email');
        $data['system_user'] = $system_user;
        $data['remarks'] = $this->input->post('remarks');
        $data['delete_flg'] = "0";
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        if($system_user == "1"){
            self::addUser($teacher_no,$teacher_name,$data['remarks']);
        }

        if(empty($teacher_id)) {
            $this->teacher_m->addOne($data);
        } else {
            $this->teacher_m->updateOne($data);
        }

        redirect("teacher_c");
    }

    private function addUser($teacher_no,$teacher_name,$remarks){
        $userinfo = $this->session->userdata('user');

        $this->load->model('user_m','user_m');

        $chkuser= $this->user_m->checkUser($teacher_no);
        if(!empty($chkuser)){
          return ;
        }
        $userData['user'] = $teacher_no;
        $userData['user_name'] = $teacher_name;
        $userData['role_id'] = "1006";
        $userData['delete_flg'] = 0;
        $userData['remarks'] = $remarks;
        $userData['insert_user'] = $userinfo;
        $userData['insert_time'] = date("Y-m-d H:i:s");
        $userData['update_user'] = $userinfo;
        $userData['update_time'] = date("Y-m-d H:i:s");
        $this->user_m->addOne($userData);
    }

    public function upd_teacher_init($teacher_id = null){
        $data = array();

        $data = $this->teacher_m->getOne($teacher_id);
        $this->load->view('teacher_add_v',$data);
    }

    public function view_teacher_init($teacher_id = null, $show_mode = null){
        $data = array();

        $data = $this->teacher_m->getOne($teacher_id);
        if (empty($show_mode)) {
            $data['show_mode'] = "0";
        } else {
            $data['show_mode'] = "1";
        }

        $this->load->view('teacher_view_v',$data);
    }

    public function delete_teacher($teacher_id = null){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $data['teacher_id'] = $teacher_id;
        $data['delete_flg'] = "1";
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->teacher_m->deleteOne($data);
        redirect("teacher_c");
    }

    public function chk_teacher($teacher_no = null){
        $checkuser = $this->teacher_m->checkTeacher($teacher_no);
        $msg = "此教师编号已经被登录！";
        if(!empty($checkuser)){
            echo urldecode(json_encode(urlencode($msg)));
        }
    }
}