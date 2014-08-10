<?php
class Rolesetup_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100503");
        $this->load->model('rolesetup_m','rolesetup_m');
        $this->load->model('usergroups_m','usergroups_m');
    }

    public function index()
    {
        $data = array();
        $functionlist = array();
        $usergroups = array();
        $userfunction = array();
        $user = $this->session->all_userdata();
        log_message('info', "rolesetup_c index user:".var_export($user,true));
        log_message('info', "rolesetup_c index post:".var_export($_POST,true));

        $data['search_key'] = "";
        $usergroupsData = $this->usergroups_m->getList($data);
        $i = 0;
        foreach($usergroupsData as $dataug){

            $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"");

            if ($i == 0) {
                $role_id = $dataug['role_id'];
            }
            $i = $i+1;
        }

        $functionlist = $this->rolesetup_m->getFunctionList($role_id);

        $data['usergroups'] = $usergroups;
        $data['functionlist'] = $functionlist;
        $data['msgFlg'] = "1";
        $this->load->view('role_setup_v',$data);
    }

    public function search_role($role_id = null)
    {
        $data = array();
        $functionlist = array();
        $usergroups = array();
        $userfunction = array();
        $user = $this->session->all_userdata();
        log_message('info', "search_role index user:".var_export($user,true));
        log_message('info', "search_role index post:".var_export($_POST,true));

        $data['search_key'] = "";
        $usergroupsData = $this->usergroups_m->getList($data);
        $i = 0;
        foreach($usergroupsData as $dataug){
            if ($dataug['role_id'] == $role_id){
                  $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"selected");
            } else {
                  $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"");
            }

            $i = $i+1;
        }

        $functionlist = $this->rolesetup_m->getFunctionList($role_id);

        $data['usergroups'] = $usergroups;
        $data['functionlist'] = $functionlist;
        $data['msgFlg'] = "1";
        $this->load->view('role_setup_v',$data);
    }

    public function upd_role()
    {
        $data = array();
        $functionlist = array();
        $usergroups = array();
        $dataforupd = array();
        $user = $this->session->all_userdata();
        log_message('info', "rolesetup_c upd_role user:".var_export($user,true));
        log_message('info', "rolesetup_c upd_role post:".var_export($_POST,true));

        $role_id = $this->input->post('ddlUser');
        $data['search_key'] = "";
        $usergroupsData = $this->usergroups_m->getList($data);
        $i = 0;
        foreach($usergroupsData as $dataug){
          if ($dataug['role_id'] == $role_id){
                  $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"selected");
          } else {
                  $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"");
          }
            $i = $i+1;
        }
        $functionlist = $this->rolesetup_m->getFunctionList($role_id);
        $i = 0;
        foreach($functionlist as $datafl){
            if ($this->input->post($datafl['function_id']) == "on") {
                $dataforupd[$i] = $datafl['function_id'];
                $i = $i + 1;
            }
        }

        $userinfo = $this->session->userdata('user');
        $insert_user = $userinfo;
        $insert_time = date("Y-m-d H:i:s");
        $update_user = $userinfo;
        $update_time = date("Y-m-d H:i:s");
        $data['insert_user'] = $insert_user;
        $data['insert_time'] = $insert_time;
        $data['update_user'] = $update_user;
        $data['update_time'] = $update_time;

        $this->rolesetup_m->updRoleFunction($role_id,$dataforupd,$data);

        $functionlist = $this->rolesetup_m->getFunctionList($role_id);

        $data['usergroups'] = $usergroups;
        $data['functionlist'] = $functionlist;
        $data['msgFlg'] = "0";
        $this->load->view('role_setup_v',$data);

    }
}