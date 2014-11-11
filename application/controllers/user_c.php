<?php
class User_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100502");
        $this->load->model('user_m','user_m');
        $this->load->model('usergroups_m','usergroups_m');
        $this->load->model('code_m','code_m');
        $this->load->model('usergroups_m','usergroups_m');
        $this->load->model('session_m','session_m');
    }

    public function index()
    {
        $data = array();
        $dataopt = array();
        log_message('info', "user_c index post:".var_export($_POST,true));

        $sessionData = array();
        $status = null;
        $role = null;
        $search_key = null;

        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10050201";
        $sessionData = $this->session_m->select($data);

        if(empty($sessionData)){
            $status =  $this->input->post('status');
            $role =  $this->input->post('role');
            $search_key = $this->input->post('txtKey');
        } else {
            $status = $sessionData['session_01'];
            $role = $sessionData['session_02'];
            $search_key = $sessionData['session_03'];
        }
        if (empty($status)) {
            $status = "0";
        }
        if (empty($role)) {
            $role = "";
        }
        $data['status'] = $status;
        $data['role'] = $role;
        $data['search_key'] = $search_key;
        $userData = $this->user_m->getList($data);

        foreach($userData as &$dataopt){
            $dataopt['opt']="<a href=\"".SITE_URL."/user_c/view_user_init/".$dataopt['user_id']."\">查看</a> |".
                         "<a href=\"".SITE_URL."/user_c/upd_user_init/".$dataopt['user_id']."\">编辑</a> |".
                         "<a href=\"#\" onclick=\"reSetPwd('".SITE_URL."/user_c/reset_pwd/".
                         $dataopt['user_id']."')\">密码重置</a>";

            if($dataopt['delete_flg'] == "0") {
                $dataopt['status'] = "有效";
            } else {
                $dataopt['status'] = "无效";
            }
        }
        $statusLst = $this->code_m->getList("04");
        $data['statusLst'] = $statusLst;
        $roleLst = $this->usergroups_m->getRoleList();
        $data['roleLst'] = $roleLst;
        $data['userData'] = @json_encode(array('Rows'=>$userData));

        $this->load->view('user_lst_v',$data);
    }

    public function search()
    {
        $data = array();
        $dataopt = array();
        log_message('info', "user_c search post:".var_export($_POST,true));

        $status = null;
        $role = null;
        $search_key = null;

        $status =  $this->input->post('status');
        $role =  $this->input->post('role');
        $search_key = $this->input->post('txtKey');
        $data['status'] = $status;
        $data['role'] = $role;
        $data['search_key'] = $search_key;
        $userData = $this->user_m->getList($data);

        foreach($userData as &$dataopt){
            $dataopt['opt']="<a href=\"".SITE_URL."/user_c/view_user_init/".$dataopt['user_id']."\">查看</a> |".
                         "<a href=\"".SITE_URL."/user_c/upd_user_init/".$dataopt['user_id']."\">编辑</a> |".
                         "<a href=\"#\" onclick=\"reSetPwd('".SITE_URL."/user_c/reset_pwd/".
                         $dataopt['user_id']."')\">密码重置</a>";

            if($dataopt['delete_flg'] == "0") {
                $dataopt['status'] = "有效";
            } else {
                $dataopt['status'] = "无效";
            }
        }
        $statusLst = $this->code_m->getList("04");
        $data['statusLst'] = $statusLst;
        $roleLst = $this->usergroups_m->getRoleList();
        $data['roleLst'] = $roleLst;
        $data['userData'] = @json_encode(array('Rows'=>$userData));

        //---------------------------------------------------------//
        $userinfo = $this->session->userdata('user');
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10050201";
        $data['session_01'] = $status;
        $data['session_02'] = $role;
        $data['session_03'] = $search_key;
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->session_m->insertorupdate($data);
        //---------------------------------------------------------//

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
        $checkuser = $this->user_m->checkUser($user);
        $msg = "此登录ID已经被注册！";
        if(!empty($checkuser)){
            echo urldecode(json_encode(urlencode($msg)));
        }
    }

    public function reset_pwd($user_id = null){
        $data = array();
        $userinfo = $this->session->userdata('user');
        $update_user = $userinfo;
        $update_time = date("Y-m-d H:i:s");
        $data['user_id'] = $user_id;
        $data['password'] = "1a1dc91c907325c69271ddf0c944bc72";
        $data['update_user'] = $update_user;
        $data['update_time'] = $update_time;

        $this->user_m->reSetPwd($data);
        $msg = "密码重置成功！";
        echo urldecode(json_encode(urlencode($msg)));
    }
}