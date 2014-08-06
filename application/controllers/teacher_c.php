<?php 
class Teacher_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct();
        $this->load->model('teacher_m','teacher_m');
   }

	public function index()
	{
	  $data = array();
	  $user = $this->session->all_userdata();
    log_message('info', "####user".var_export($user,true));

    $teacherData = $this->teacher_m->getList();
    foreach($teacherData as &$data){
      $data['opt']="<a href=\"".SITE_URL."/teacher_c/view_teacher_init/".$data['teacher_no']."\">查看</a> |".
    "<a href=\"".SITE_URL."/teacher_c/upd_teacher_init/".$data['teacher_no']."\">编辑</a> |".
    "<a href=\"#\" onclick=\"delTeacher('".SITE_URL."/teacher_c/delete_teacher/".$data['teacher_no']."')\">删除</a>";
      log_message('info', "####href".$data['opt']);
    }
    foreach($teacherData as &$teacher){
    	$now = date('Ymd');
    	$birthday = $teacher["birthday"];
    	$teacher["age"] = floor(($now-$birthday)/10000);
    }
    $data['teacherData'] = $teacherData;
    $data['teachersData'] = @json_encode(array('Rows'=>$teacherData));
    
		$this->load->view('teacher_lst_v',$data);
	}
	public function add_teacher_init(){
	  $data = array();
	  $this->load->view('teacher_add_v',$data);
	}
	public function add_teacher(){
	   log_message('info','add teacher '.var_export($_POST,true));
	   $teacher_no = $this->input->post('teacher_no');
	   $teacher_name = $this->input->post('teacher_name');
	   $sex = $this->input->post('sex');
	   $birthday = $this->input->post('birthday');
	   $property = $this->input->post('property');
	   $course = $this->input->post('course');
     $telephone = $this->input->post('telephone');
     $email = $this->input->post('email');
     $system_user = $this->input->post('system_user');
     $remarks = $this->input->post('remarks');
          
	   $this->teacher_m->addOne($teacher_no,$teacher_name, $sex,$birthday, $property, $course, 
          $telephone, $email, $system_user, $remarks);
     redirect("teacher_c");
	  
	}
	public function upd_teacher_init($teacher_id = null){
	  
	  $data = array();
	  if(empty($teacher_id)){
        $teacher_id = $this->input->get('teacher_id');
        if(empty($teacher_id)){
          $teacher_id = $this->input->post('teacher_id');
        }
     }
	 
	  $teacherData = $this->teacher_m->getOne($teacher_id);

	  $this->load->view('teacher_add_v',$teacherData);
	}
    public function upd_teacher($teacher_id = null){
      if(empty($teacher_id)){
        $teacher_id = $this->input->post('teacher_id');
      }
      $teacher_no = $this->input->post('teacher_no');
      $teacher_name = $this->input->post('$eacher_name');
      $sex = $this->input->post('sex');
      $birthday = $this->input->post('birthday');
      $property = $this->input->post('property');
      $course = $this->input->post('course');
      $telephone = $this->input->post('telephone');
      $email = $this->input->post('email');
      $system_user = $this->input->post('system_user');
      $remarks = $this->input->post('remarks');
          
      $this->teacher_m->updateOne($teacher_no, $teacher_name, $sex,$birthday, $property, $course, 
          $telephone, $email, $system_user, $remarks,$teacher_id);
      redirect("teacher_c");
	}
public function view_teacher_init($teacher_id = null){
	  
	  $data = array();
	  if(empty($teacher_id)){
        $teacher_id = $this->input->get('teacher_id');
        if(empty($teacher_id)){
          $teacher_id = $this->input->post('teacher_id');
        }
     }
	 
	  $teacherData = $this->teacher_m->getOne($teacher_id);

	  $this->load->view('teacher_view_v',$teacherData);
	}
   public function delete_teacher($teacher_id = null){
      if(empty($teacher_id)){
        $teacher_id = $this->input->post('teacher_id');
      }
      
      $this->teacher_m->deleteOne($teacher_id);
      redirect("teacher_c");
	}
}