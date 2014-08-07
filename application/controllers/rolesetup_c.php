<?php
class Rolesetup_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rolesetup_m','rolesetup_m');
        $this->load->model('usergroups_m','usergroups_m');
    }

    public function index()
    {
        $data = array();
        $rolesetupData = array();
        $usergroups = array();
		$user = $this->session->all_userdata();
        log_message('info', "rolesetup_c index user:".var_export($user,true));
        log_message('info', "rolesetup_c index post:".var_export($_POST,true));

        $data['search_key'] = "";
        $usergroupsData = $this->usergroups_m->getList($data);
        $i = 0;
        foreach($usergroupsData as $dataug){
            $usergroups[$i] = array("id"=>"".$dataug['role_id'],"name"=>"".$dataug['role_name'],"sel"=>"");
            $i = $i+1;
        }
        $rolesetupData = $this->rolesetup_m->getFunctionList();
        $data['usergroups'] = $usergroups;
        $data['rolesetupData'] =  @json_encode(array('Rows'=>$rolesetupData));

        $this->load->view('role_setup_v',$data);
    }

    public function upd_role()
    {
        $data = array();
        $rolesetupData = array();
        $usergroups = array();
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
        $rolesetupData = $this->rolesetup_m->getFunctionList();
        $data['usergroups'] = $usergroups;
        $data['rolesetupData'] =  @json_encode(array('Rows'=>$rolesetupData));

        $this->load->view('role_setup_v',$data);

    }
}