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
      $now = date('Ymd');
      $keyword = $this->input->post('txtKey');
      $studentData = $this->student_m->getList($keyword);
      foreach($studentData as &$data){
        $data['opt']="<a href=\"".SITE_URL."/student_c/view_student_init/".$data['student_id']."\">查看</a> |".
        "<a href=\"".SITE_URL."/student_c/upd_student_init/".$data['student_id']."\">编辑</a> |".
        "<a href=\"#\" onclick=\"delstudent('".SITE_URL."/student_c/delete_student/".$data['student_id']."')\">删除</a>";
        
        $data['age'] = floor(($now-str_replace("-","",$data['birthday']))/10000);
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
	   $student_no = $this->input->post('student_no');
	   $student_name = $this->input->post('student_name');
	   $sex = $this->input->post('sex');
	   $birthday = $this->input->post('birthday');
	   $id_card = $this->input->post('id_card');
	   $contact_way = $this->input->post('contact_way');
       $parent_phone = $this->input->post('parent_phone');
       $course_no = $this->input->post('course_no');
       $class_no = $this->input->post('class_no');
       $cost = $this->input->post('cost');
       $start_year = $this->input->post('start_year');
       $start_month = $this->input->post('start_month');
       $start_date = $this->input->post('start_date');
       $end_date = $this->input->post('end_date');
       $attendance = $this->input->post('attendance');
       $system_user = $this->input->post('system_user');
       $remarks = $this->input->post('remarks');
      
          
	   $this->student_m->addOne($student_no,$student_name, $sex,$birthday, $id_card, $contact_way, 
         $parent_phone, $course_no, $class_no, $cost, $start_year,$start_month,$start_date,$end_date,
         $attendance,$system_user,$remarks);
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
       $student_no = $this->input->post('student_no');
	   $student_name = $this->input->post('student_name');
	   $sex = $this->input->post('sex');
	   $birthday = $this->input->post('birthday');
	   $id_card = $this->input->post('id_card');
	   $contact_way = $this->input->post('contact_way');
       $parent_phone = $this->input->post('parent_phone');
       $course_no = $this->input->post('course_no');
       $class_no = $this->input->post('class_no');
       $cost = $this->input->post('cost');
       $start_year = $this->input->post('start_year');
       $start_month = $this->input->post('start_month');
       $start_date = $this->input->post('start_date');
       $end_date = $this->input->post('end_date');
       $attendance = $this->input->post('attendance');
       $system_user = $this->input->post('system_user');
       $remarks = $this->input->post('remarks');
          
      $this->student_m->updateOne($student_no,$student_name, $sex,$birthday, $id_card, $contact_way, 
         $parent_phone, $course_no, $class_no, $cost, $start_year,$start_month,$start_date,$end_date,
         $attendance,$system_user,$remarks,$student_id);
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
	
public function chk_repeat($student_no, $old_no = null){
        log_message('info', "student_c chk_repeat start");
        log_message('info', "student_c chk_repeat post user:".$student_no." : :".$old_no);
        $this->load->model('student_m','student_m');
        $checkuser = $this->student_m->checkRepeat($student_no,$old_no);
        $msg = "课程编号重复";
        if(!empty($checkuser)){
            echo urldecode(json_encode(urlencode($msg)));
        }

        log_message('info', "student chk_repeat end".var_export($checkuser,true));
    }
}