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
    
    $data['teacherData'] = $teacherData;
    
		$this->load->view('teacher_lst_v',$data);
	}
	public function add_teacher(){
	  $teacher_name = $this->input->post('$eacher_name');
	   $sex = $this->input->post('sex');
	   $birthday = $this->input->post('birthday');
	   $property = $this->input->post('property');
	   $course = $this->input->post('course');
     $telephone = $this->input->post('telephone');
     $email = $this->input->post('email');
     $system_user = $this->input->post('system_user');
     $remarks = $this->input->post('remarks');
          
	  $this->teacher_m->addOne($teacher_name, $sex,$birthday, $property, $course, 
          $telephone, $email, $system_user, $remarks);
	  
	}
  public function upd_teacher(){
	  $teacher_name = $this->input->post('$eacher_name');
	   $sex = $this->input->post('sex');
	   $birthday = $this->input->post('birthday');
	   $property = $this->input->post('property');
	   $course = $this->input->post('course');
     $telephone = $this->input->post('telephone');
     $email = $this->input->post('email');
     $system_user = $this->input->post('system_user');
     $remarks = $this->input->post('remarks');
          
	  $this->teacher_m->updateOne($teacher_name, $sex,$birthday, $property, $course, 
          $telephone, $email, $system_user, $remarks);
	  
	}
}