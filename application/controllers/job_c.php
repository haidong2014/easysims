<?php
class Job_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct("100405");
        $this->load->model('job_m','job_m');
        $this->load->model('code_m','code_m');
   }

    public function index()
    {
        $data = array();

        $keyword = $this->input->post('txtKey');
        $jobData = $this->job_m->getList($keyword);

        foreach($jobData as &$data){
            $data['opt']="<a href=\"".SITE_URL."/job_c/view_job_init/".$data['job_id']."\">查看</a> |".
            "<a href=\"".SITE_URL."/job_c/upd_job_init/".$data['job_id']."\">编辑</a> |".
            "<a href=\"#\" onclick=\"deljob('".SITE_URL."/job_c/delete_job/".$data['job_id']."')\">删除</a>";
        }

        $data['txtKey'] = $keyword;
        $data['jobData'] = @json_encode(array('Rows'=>$jobData));
        $this->load->view('job_lst_v',$data);
    }

    public function add_job_init(){
        $data = array();
        $jobgradeData = $this->code_m->getList("09");
        $data['jobgradeData'] = $jobgradeData;

        $this->load->view('job_add_v',$data);
    }

    public function add_job(){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $job_id = $this->input->post('job_id');

        $data['job_id'] = $job_id;
        $data['job_company'] = $this->input->post('job_company');
        $data['job_city'] = $this->input->post('job_city');
        $data['job_business'] = $this->input->post('job_business');
        $data['job_address'] = $this->input->post('job_address');
        $data['job_telephone'] = $this->input->post('job_telephone');
        $data['job_contacts'] = $this->input->post('job_contacts');
        $data['job_post'] = $this->input->post('job_post');
        $data['job_onjob'] = $this->input->post('job_onjob');
        $data['job_grade'] = $this->input->post('job_grade');
        $data['job_cooperation'] = $this->input->post('job_cooperation');
        $data['remarks'] = $this->input->post('remarks');
        $data['delete_flg'] = "0";
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        if(empty($job_id)) {
            $this->job_m->addOne($data);
        } else {
            $this->job_m->updateOne($data);
        }

        redirect("job_c");
    }

    public function upd_job_init($job_id = null){
        $jobData = $this->job_m->getOne($job_id);
        $data = $jobData;
        $jobgradeData = $this->code_m->getList("09");
        $data['jobgradeData'] = $jobgradeData;
        $this->load->view('job_add_v',$data);
    }

    public function view_job_init($job_id = null, $show_mode = null){
        $data = array();
        $jobData = $this->job_m->getOne($job_id);
        $data = $jobData;
        $jobgradeData = $this->code_m->getList("09");
        $data['jobgradeData'] = $jobgradeData;
        if (empty($show_mode)) {
            $data['show_mode'] = "0";
        } else {
            $data['show_mode'] = "1";
        }
        $this->load->view('job_view_v',$data);
    }

    public function delete_job($job_id = null){

        $data = array();

        $userinfo = $this->session->userdata('user');
        $data['job_id'] = $job_id;
        $data['delete_flg'] = "1";
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        $this->job_m->deleteOne($data);
        redirect("job_c");
    }
}