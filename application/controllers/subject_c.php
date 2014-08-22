<?php
class Subject_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct();
        $this->load->model('subject_m','subject_m');
   }

    public function index($course_id)
    {
        $data = array();

        $keyword = $this->input->post('txtKey');
        $subjectData = $this->subject_m->getList($course_id, $keyword);

        foreach($subjectData as &$data){
            $data['opt']="<a href=\"".SITE_URL."/subject_c/view_subject_init/".$data['course_id']."\">查看</a> |".
            "<a href=\"".SITE_URL."/subject_c/upd_subject_init/".$data['course_id']."\">编辑</a> |".
            "<a href=\"#\" onclick=\"delsubject('".SITE_URL."/subject_c/delete_subject/".$data['course_id']."')\">删除</a>";
        }

        $data['course_id'] = $course_id;
        $data['txtKey'] = $keyword;
        $data['subjectData'] = @json_encode(array('Rows'=>$subjectData));
        $this->load->view('subject_lst_v',$data);
    }

    public function add_subject_init(){
        $data = array();
        $this->load->view('subject_add_v',$data);
    }

    public function add_subject(){
        $data = array();

        $userinfo = $this->session->userdata('user');
        $course_id = $this->input->post('course_id');

        $data['course_id'] = $course_id;
        $data['course_name'] = $this->input->post('course_name');
        $data['remarks'] = $this->input->post('remarks');
        $data['delete_flg'] = "0";
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        if(empty($course_id)) {
            $this->course_m->addOne($data);
        } else {
            $this->course_m->updateOne($data);
        }

        redirect("course_c");
    }

    public function upd_subject_init($course_id = null){
        $courseData = $this->course_m->getOne($course_id);
        $this->load->view('course_add_v',$courseData);
    }

    public function view_subject_init($course_id = null){

        $data = array();
        $courseData = $this->course_m->getOne($course_id);
        $this->load->view('course_view_v',$courseData);
    }

    public function delete_subject($course_id = null){

        $data = array();

        $userinfo = $this->session->userdata('user');
        $data['course_id'] = $course_id;
        $data['delete_flg'] = "1";
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");

        $this->course_m->deleteOne($data);
        redirect("course_c");
    }
}