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
      $this->load->model('code_m','code_m');
      $graduateData = $this->code_m->getList("06");
      $data['graduateData'] = $graduateData;
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
      /*************other***************/
       $graduate_school = $this->input->post('graduate_school');
	   $specialty = $this->input->post('specialty');
	   $graduate = $this->input->post('graduate');
	   $ancestralhome = $this->input->post('ancestralhome');
	   $know_school = $this->input->post('know_school');
	   $know_trade = $this->input->post('know_trade');
       $preference = $this->input->post('preference');
       $software_base = $this->input->post('software_base');
       $purpose = $this->input->post('purpose');
       $follow_city = $this->input->post('follow_city');
       $follow_company = $this->input->post('follow_company');
       $follow_salary = $this->input->post('follow_salary');
       $follow_position = $this->input->post('follow_position');
       $follow_remarks = $this->input->post('follow_remarks');
       
       /********************************************/
	   $student_id = $this->student_m->addOne($student_no,$student_name, $sex,$birthday, $id_card, $contact_way, 
       $parent_phone, $course_no, $class_no, $cost, $start_year,$start_month,$start_date,$end_date,
       $attendance,$system_user,$remarks);
         /***insert other**/
         $this->student_m->addOneOther($student_id, $student_no, $graduate_school, $specialty,$graduate
        ,$ancestralhome,$know_school,$know_trade,$preference,$software_base,$purpose,
        $follow_city,$follow_company,$follow_salary,$follow_position,$follow_remarks);
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

	  $otherData = $this->student_m->getOneOther($student_id);
	  
	  $this->load->view('student_add_v',$studentData+$otherData);
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
          /*************other***************/
       $graduate_school = $this->input->post('graduate_school');
	   $specialty = $this->input->post('specialty');
	   $graduate = $this->input->post('graduate');
	   $ancestralhome = $this->input->post('ancestralhome');
	   $know_school = $this->input->post('know_school');
	   $know_trade = $this->input->post('know_trade');
       $preference = $this->input->post('preference');
       $software_base = $this->input->post('software_base');
       $purpose = $this->input->post('purpose');
       $follow_city = $this->input->post('follow_city');
       $follow_company = $this->input->post('follow_company');
       $follow_salary = $this->input->post('follow_salary');
       $follow_position = $this->input->post('follow_position');
       $follow_remarks = $this->input->post('follow_remarks');
       
       /********************************************/
      $this->student_m->updateOne($student_no,$student_name, $sex,$birthday, $id_card, $contact_way, 
         $parent_phone, $course_no, $class_no, $cost, $start_year,$start_month,$start_date,$end_date,
         $attendance,$system_user,$remarks,$student_id);
         /********************************************/
         $this->student_m->updateOneOther($student_id, $student_no, $graduate_school, $specialty,$graduate
    ,$ancestralhome,$know_school,$know_trade,$preference,$software_base,$purpose,
    $follow_city,$follow_company,$follow_salary,$follow_position,$follow_remarks);
         /********************************************/
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
	  $this->load->model('course_m','course_m');
	  //var_dump($studentData['course_no']);
	  $courseData = $this->course_m->getOneByNo($studentData['course_no']);
	  //var_dump($courseData);
	  $studentData['course_name'] = $courseData['course_name'];
      $otherData = $this->student_m->getOneOther($student_id);
      
      $this->load->model('code_m','code_m');
      $graduateData = $this->code_m->getList("06");
      //var_dump($graduateData);
      $studentData['graduate'] = $graduateData['GRADUATE'][$otherData['graduate']];
      
      
	  $this->load->view('student_view_v',$studentData+$otherData);
	}
   public function delete_student($student_id = null){
      if(empty($student_id)){
        $student_id = $this->input->post('student_id');
      }
      
      $this->student_m->deleteOne($student_id);
      $this->student_m->deleteOneOther($student_id);
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