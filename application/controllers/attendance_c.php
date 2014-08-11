<?php
class Attendance_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100101");
        $this->load->model('class_m','class_m');
        $this->load->model('student_m','student_m');
    }

    public function index()
    {
        $data = array();
        $dataopt = array();
        $user = $this->session->all_userdata();
        log_message('info', "attendance_c index user:".var_export($user,true));
        log_message('info', "attendance_c index post:".var_export($_POST,true));

        $data['search_key'] =  $this->input->post('txtKey');
        $userData = $this->class_m->getList($data);

        foreach($userData as &$dataopt){
            $dataopt['opt']="<a href=\"".SITE_URL."/user_c/view_user_init/".$dataopt['user_id']."\">查看</a> |".
                         "<a href=\"".SITE_URL."/user_c/upd_user_init/".$dataopt['user_id']."\">编辑</a> ";
            if($dataopt['delete_flg'] == "0") {
                $dataopt['status'] = "有效";
            } else {
                $dataopt['status'] = "无效";
            }
        }

        $data['userData'] = @json_encode(array('Rows'=>$userData));

        $this->load->view('user_lst_v',$data);
    }

    public function search_user()
    {
        $data = array();
        $user = $this->session->all_userdata();
        log_message('info', "user_c search_user user:".var_export($user,true));
        log_message('info', "user_c search_user post:".var_export($_POST,true));

        $data['search_key'] = $this->input->post('txtKey');
        $userData = $this->user_m->getList($data);

        foreach($userData as &$dataopt){
            $dataopt['opt']="<a href=\"".SITE_URL."/user_c/view_user_init/".$dataopt['user_id']."\">查看</a> |".
                         "<a href=\"".SITE_URL."/user_c/upd_user_init/".$dataopt['user_id']."\">编辑</a> ";
            if($dataopt['delete_flg'] == "0") {
                $dataopt['status'] = "有效";
            } else {
                $dataopt['status'] = "无效";
            }
        }

        $data['userData'] = @json_encode(array('Rows'=>$userData));

        $this->load->view('user_lst_v',$data);
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