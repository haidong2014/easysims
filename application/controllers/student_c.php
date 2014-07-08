<?php 
class Student_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct();
        $this->load->model('student_m','student_m');
   }

	public function index()
	{
	  $data = array();
	  $user = $this->session->all_userdata();
    log_message('info', "####user".var_export($user,true));

    $studentData = $this->student_m->getList();
    foreach($studentData as &$data){
      $data['opt']="<a href=\"".SITE_URL."/student_c/view_student_init/".$data['student_id']."\">查看</a> |".
    "<a href=\"".SITE_URL."/student_c/upd_student_init/".$data['student_id']."\">编辑</a> |".
    "<a href=\"#\" onclick=\"delstudent('".SITE_URL."/student_c/delete_student/".$data['student_id']."')\">删除</a>";
      log_message('info', "####href".$data['opt']);
    }
    $data['studentData'] = $studentData;
    $data['studentsData'] = @json_encode(array('Rows'=>$studentData));
    
		$this->load->view('student_lst_v',$data);
	}
	public function add_student_init(){
	  $data = array();
	  $this->load->view('student_add_v',$data);
	}
	public function add_student(){
	   log_message('info','add student '.var_export($_POST,true));
	   $student_id = $this->input->post('student_id');
	   $student_name = $this->input->post('student_name');
	   $sex = $this->input->post('sex');
	   $birthday = $this->input->post('birthday');
	   $id_card = $this->input->post('id_card');
	   $contact_way = $this->input->post('contact_way');
     $parent_phone = $this->input->post('parent_phone');
     $email = $this->input->post('email');
     $system_user = $this->input->post('system_user');
     $remarks = $this->input->post('remarks');
          
	   $this->student_m->addOne($student_id,$student_name, $sex,$birthday, $id_card, $contact_way, 
          $parent_phone, $email, $system_user, $remarks);
     redirect("student_c");
	  
	}
	public function upd_student_init($student_id = null){
	  
	  $data = array();
	  if(empty($student_id)){
        $student_id = $this->input->get('student_id');
        if(empty($student_id)){
          $student_id = $this->input->post('student_id');
        }
     }
	 
	  $studentData = $this->student_m->getOne($student_id);

	  $this->load->view('student_add_v',$studentData);
	}
    public function upd_student($student_id = null){
      if(empty($student_id)){
        $student_id = $this->input->post('student_id');
      }
      $student_id = $this->input->post('student_id');
      $student_name = $this->input->post('$student_name');
      $sex = $this->input->post('sex');
      $birthday = $this->input->post('birthday');
      $id_card = $this->input->post('id_card');
      $contact_way = $this->input->post('contact_way');
      $parent_phone = $this->input->post('parent_phone');
      $system_user = $this->input->post('system_user');
      $remarks = $this->input->post('remarks');
          
      $this->student_m->updateOne($student_id, $student_name, $sex,$birthday, $id_card, $contact_way, 
          $parent_phone, $email, $system_user, $remarks,$student_id);
      redirect("student_c");
	}
public function view_student_init($student_id = null){
	  
	  $data = array();
	  if(empty($student_id)){
        $student_id = $this->input->get('student_id');
        if(empty($student_id)){
          $student_id = $this->input->post('student_id');
        }
     }
	 
	  $studentData = $this->student_m->getOne($student_id);

	  $this->load->view('student_view_v',$studentData);
	}
   public function delete_student($student_id = null){
      if(empty($student_id)){
        $student_id = $this->input->post('student_id');
      }
      
      $this->student_m->deleteOne($student_id);
      redirect("student_c");
	}
}