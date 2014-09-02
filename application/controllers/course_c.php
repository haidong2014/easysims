<?php
class Course_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct("100401");
        $this->load->model('course_m','course_m');
   }

    public function index()
    {
        $data = array();

        $keyword = $this->input->post('txtKey');
        $courseData = $this->course_m->getList($keyword);

        foreach($courseData as &$data){
            $data['course_id_v']="<a href=\"".SITE_URL."/subject_c/index/".$data['course_id']."\">".$data['course_id']."</a>";

            $data['opt']="<a href=\"".SITE_URL."/course_c/view_course_init/".$data['course_id']."\">查看</a> |".
            "<a href=\"".SITE_URL."/course_c/upd_course_init/".$data['course_id']."\">编辑</a> |".
            "<a href=\"#\" onclick=\"delcourse('".SITE_URL."/course_c/delete_course/".$data['course_id']."')\">删除</a>";
        }

        $data['txtKey'] = $keyword;
        $data['coursesData'] = @json_encode(array('Rows'=>$courseData));
        $this->load->view('course_lst_v',$data);
    }

    public function add_course_init(){
        $data = array();
        $this->load->view('course_add_v',$data);
    }

    public function add_course(){
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

    public function upd_course_init($course_id = null){
        $courseData = $this->course_m->getOne($course_id);
        $this->load->view('course_add_v',$courseData);
    }

    public function view_course_init($course_id = null){

        $data = array();
        $courseData = $this->course_m->getOne($course_id);
        $this->load->view('course_view_v',$courseData);
    }

    public function delete_course($course_id = null){

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