<?php 
class course_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct();
        $this->load->model('course_m','course_m');
   }

	public function index()
	{
	  $data = array();
	  $user = $this->session->all_userdata();
    log_message('info', "####user".var_export($user,true));

    $courseData = $this->course_m->getList();
    foreach($courseData as &$data){
      $data['opt']="<a href=\"".SITE_URL."/course_c/view_course_init/".$data['course_id']."\">查看</a> |".
    "<a href=\"".SITE_URL."/course_c/upd_course_init/".$data['course_id']."\">编辑</a> |".
    "<a href=\"#\" onclick=\"delcourse('".SITE_URL."/course_c/delete_course/".$data['course_id']."')\">删除</a>";
      log_message('info', "####href".$data['opt']);
    }
    $data['courseData'] = $courseData;
    $data['coursesData'] = @json_encode(array('Rows'=>$courseData));
    
		$this->load->view('course_lst_v',$data);
	}
	public function add_course_init(){
	  $data = array();
	  $this->load->view('course_add_v',$data);
	}
	public function add_course(){
	   log_message('info','add course '.var_export($_POST,true));
	   $course_id = $this->input->post('course_id');
	   $course_name = $this->input->post('course_name');
	  
     $remarks = $this->input->post('remarks');
          
	   $this->course_m->addOne($course_id,$course_name, $sex,$birthday, $id_card, $contact_way, 
          $parent_phone, $email, $system_user, $remarks);
     redirect("course_c");
	  
	}
	public function upd_course_init($course_id = null){
	  
	  $data = array();
	  if(empty($course_id)){
        $course_id = $this->input->get('course_id');
        if(empty($course_id)){
          $course_id = $this->input->post('course_id');
        }
     }
	 
	  $courseData = $this->course_m->getOne($course_id);

	  $this->load->view('course_add_v',$courseData);
	}
    public function upd_course($course_id = null){
      if(empty($course_id)){
        $course_id = $this->input->post('course_id');
      }
      $course_id = $this->input->post('course_id');
      $course_name = $this->input->post('$course_name');
      
      $remarks = $this->input->post('remarks');
          
      $this->course_m->updateOne($course_id, $course_name, $remarks,$course_id);
      redirect("course_c");
	}
public function view_course_init($course_id = null){
	  
	  $data = array();
	  if(empty($course_id)){
        $course_id = $this->input->get('course_id');
        if(empty($course_id)){
          $course_id = $this->input->post('course_id');
        }
     }
	 
	  $courseData = $this->course_m->getOne($course_id);

	  $this->load->view('course_view_v',$courseData);
	}
   public function delete_course($course_id = null){
      if(empty($course_id)){
        $course_id = $this->input->post('course_id');
      }
      
      $this->course_m->deleteOne($course_id);
      redirect("course_c");
	}
}