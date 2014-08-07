<?php
class Usergroups_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usergroups_m','usergroups_m');
    }

    public function index()
    {
        $data = array();
        $dataopt = array();
        $user = $this->session->all_userdata();
        log_message('info', "usergroups_c index user:".var_export($user,true));
        log_message('info', "usergroups_c index post:".var_export($_POST,true));

        $data['search_key'] =  $this->input->post('txtKey');
        $usergroupsData = $this->usergroups_m->getList($data);

        foreach($usergroupsData as &$dataopt){
            $dataopt['opt']="<a href=\"".SITE_URL."/usergroups_c/view_usergroups_init/".$dataopt['role_id']."\">view</a> |".
                         "<a href=\"".SITE_URL."/usergroups_c/upd_usergroups_init/".$dataopt['role_id']."\">modify</a> |".
                         "<a href=\"#\" onclick=\"delUsergroups('".SITE_URL."/usergroups_c/delete_usergroups/".$dataopt['role_id']."')\">delete</a>";
        }

        $data['usergroupsData'] = @json_encode(array('Rows'=>$usergroupsData));

        $this->load->view('usergroups_lst_v',$data);
    }

    public function search_usergroups()
    {
        $data = array();
        $user = $this->session->all_userdata();
        log_message('info', "usergroups_c search_usergroups user:".var_export($user,true));
        log_message('info', "usergroups_c search_usergroups post:".var_export($_POST,true));

        $data['search_key'] = $this->input->post('txtKey');
        $usergroupsData = $this->usergroups_m->getList($data);

        foreach($usergroupsData as &$dataopt){
            $dataopt['opt']="<a href=\"".SITE_URL."/usergroups_c/view_usergroups_init/".$dataopt['role_id']."\">view</a> |".
                         "<a href=\"".SITE_URL."/usergroups_c/upd_usergroups_init/".$dataopt['role_id']."\">modify</a> |".
                         "<a href=\"#\" onclick=\"delUsergroups('".SITE_URL."/usergroups_c/delete_usergroups/".$dataopt['role_id']."')\">delete</a>";
        }

        $data['usergroupsData'] = @json_encode(array('Rows'=>$usergroupsData));

        $this->load->view('usergroups_lst_v',$data);
    }

    public function add_usergroups_init(){

        $data = array();
        $this->load->view('usergroups_add_v',$data);
    }

    public function add_usergroups(){
        log_message('info', "usergroups_c add_usergroups post:".var_export($_POST,true));

        $data = array();
        $user = $this->session->userdata('user');

        $role_id = $this->input->post('txtRoleId');
        $role_name = $this->input->post('txtName');
        $remarks = $this->input->post('txtRemarks');
        $insert_user = $user;
        $insert_time = date("Y-m-d H:i:s");
        $update_user = $user;
        $update_time = date("Y-m-d H:i:s");

        $data['role_id'] = $role_id;
        $data['role_name'] = $role_name;
        $data['remarks'] = $remarks;
        $data['insert_user'] = $insert_user;
        $data['insert_time'] = $insert_time;
        $data['update_user'] = $update_user;
        $data['update_time'] = $update_time;

        if(empty($role_id)){
            $this->usergroups_m->addOne($data);
        } else {
            $this->usergroups_m->updOne($data);
        }

        redirect("usergroups_c");
    }

    public function delete_usergroups($role_id = null){
        $data = array();
        $user = $this->session->userdata('user');
        $update_user = $user;
        $update_time = date("Y-m-d H:i:s");
 
        $data['role_id'] = $role_id;
        $data['update_user'] = $update_user;
        $data['update_time'] = $update_time;
        $this->usergroups_m->deleteOne($role_id);
        redirect("usergroups_c");
    }

    public function view_usergroups_init($role_id = null){
        $data = array();

        $usergroupsData = $this->usergroups_m->getOne($role_id);
        if(count($usergroupsData) == 1){
            $data = $usergroupsData[0];
        }
        $this->load->view('usergroups_view_v',$data);
    }

    public function upd_usergroups_init($role_id = null){
        $data = array();

        $usergroupsData = $this->usergroups_m->getOne($role_id);
        if(count($usergroupsData) == 1){
            $data = $usergroupsData[0];
        }
        $this->load->view('usergroups_add_v',$data);
    }
}