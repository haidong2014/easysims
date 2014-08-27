<?php 
class Class_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct();
        $this->load->model('class_m','class_m');
   }

	public function index()
	{
		$this->load->model('teacher_m','teacher_m');
		$this->load->model('course_m','course_m');
		$this->load->model('code_m','code_m');
        $status = $this->code_m->getList("05");
	    $data = array();
	    $user = $this->session->all_userdata();
        log_message('info', "####user".var_export($user,true));
        $keyword = $this->input->post('txtKey');
        $classData = $this->class_m->getList(array('search_key'=>$keyword));
         //var_dump($classData);
        foreach($classData as &$data){
          $data['opt']="<a href=\"".SITE_URL."/class_c/view_class_init/".$data['class_id']."\">查看</a> |".
          "<a href=\"".SITE_URL."/class_c/upd_class_init/".$data['class_id']."\">编辑</a> |".
          "<a href=\"#\" onclick=\"delclass('".SITE_URL."/class_c/delete_class/".$data['class_id']."')\">删除</a>";
          $data['status'] = $status['STATUS'][$data['status']];
          log_message('info', "####href".$data['opt']);
        }
        
        $teacherData = $this->teacher_m->getList(null);
        
        $data['teacherData'] = $teacherData;
        
        $courseData = $this->course_m->getList(null);
        
        $data['courseData'] = $courseData;
        
        
        //$data['status'] = $status;
        //var_dump($courseData);
        $data['txtKey'] = $keyword;
        $data['classData'] = $classData;
        $data['classsData'] = @json_encode(array('Rows'=>$classData));
    
		$this->load->view('class_lst_v',$data);
	}
	public function add_class_init($subject_id = null){
	  $data = array();
	    $this->load->model('code_m','code_m');
        $status = $this->code_m->getList("05");
        $data['statuses'] = $status;
        $data['subject_id'] = $subject_id;
        $this->load->model('teacher_m','teacher_m');
		$this->load->model('course_m','course_m');
		$teacherData = $this->teacher_m->getList(null);
        
        $data['teacherData'] = $teacherData;
        
        $courseData = $this->course_m->getList(null);
        
        $data['courseData'] = $courseData;
        $subject_name ="";
        /*if(!empty($subject_id)){
           $subjectData = $this->class_m->getSubList($classData['class_no']);
           $subject_id = "";
           $subject_name = "";
           $this->load->model('subject_m','subject_m');
           foreach($subjectData as $value){
         	 $subject = $this->subjet_m->getOne($value["subject_id"]);
         	 if(empty($subject_id)){
         		$subject_id = $value["subject_id"];
         		$subject_name = $subject['subject_name'];
         	 }else{
         	 	$subject_id .= ",".$value["subject_id"];
         	 	$subject_name = ",".$subject['subject_name'];
         	 } 	
          }
          //var_dump($subjectData);
          
        }*/
        $classData['subject_id'] = $subject_id;
        $classData['subject_name'] = $subject_name;
         
	    $this->load->view('class_add_v',$data);
	}
	public function add_class(){
	   log_message('info','add class '.var_export($_POST,true));
	   $userinfo = $this->session->userdata('user');
	    $class_no = $this->input->post('class_no');
        $class_name = $this->input->post('class_name');
        $start_year = $this->input->post('start_year');
        $start_month = $this->input->post('start_month');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $course_no = $this->input->post('course_no');
        $teacher_no = $this->input->post('teacher_no');
        $class_room = $this->input->post('class_room');
        $numbers = $this->input->post('numbers');
        $cost = $this->input->post('cost');
        $status = $this->input->post('status');
        $remarks = $this->input->post('remarks');
        $subject_id = $this->input->post('subject_id');
          
	    $class_id = $this->class_m->addOne($class_no, $class_name,$start_year, $start_month,
        $start_date, $end_date,  $course_no, $teacher_no, $class_room, $numbers, $cost, $status, $remarks);
        
        
        
        $this->class_m->addSub($class_no, $subject_id, $start_date, $end_date, $teacher_no, $userinfo);
        
        redirect("class_c");
	  
	}
	public function upd_class_init($class_id = null,$subject_id = null){
	    $this->load->model('teacher_m','teacher_m');
		$this->load->model('course_m','course_m');
	    $data = array();
	    //var_dump($this->teacher_m);
	    $teacherData = $this->teacher_m->getList(null);
        //var_dump($teacherData);
        $data['teacherData'] = $teacherData;
        $data['subject_id'] = $subject_id;
        $courseData = $this->course_m->getList(null);
        
        //$data['courseData'] = $courseData;
        //var_dump($courseData);
        
	    if(empty($class_id)){
          $class_id = $this->input->get('class_id');
          if(empty($class_id)){
             $class_id = $this->input->post('class_id');
           }
         }
	 
	     $classData = $this->class_m->getOne($class_id);
	     //$classData['start_date'] = substr($classData['start_date'],0,4)."-".substr($classData['start_date'],4,2)."-".substr($classData['start_date'],6,2);
	     //$classData['end_date'] = substr($classData['end_date'],0,4)."-".substr($classData['end_date'],4,2)."-".substr($classData['end_date'],6,2);
		 $classData['teacherData'] = $teacherData;
		 $classData['courseData'] = $courseData;
		 
		 $this->load->model('code_m','code_m');
         $status = $this->code_m->getList("05");
         $classData['statuses'] = $status;
        
         $this->load->model('class_m','class_m');
         $this->load->model('subject_m','subject_m');
         $subjectData = $this->class_m->getSubList($classData['class_no']);
         $subject_id = "";
         $subject_name = "";
         foreach($subjectData as $value){
         	$subject = $this->subject_m->getOne($class_id,$value["subject_id"]);
         	if(empty($subject_id)){
         		$subject_id = $value["subject_id"];
         		$subject_name = $subject['subject_name'];
         	}else{
         		$subject_id .= ",".$value["subject_id"];
         		$subject_name = ",".$subject['subject_name'];
         	} 	
         }
         //var_dump($subjectData);
         $classData['subject_id'] = $subject_id;
         $classData['subject_name'] = $subject_name;
	     $this->load->view('class_add_v',$classData);
	}
    public function upd_class($class_id = null){
      if(empty($class_id)){
        $class_id = $this->input->post('class_id');
      }
      $userinfo = $this->session->userdata('user');
      $class_no = $this->input->post('class_no');
      $class_name = $this->input->post('class_name');
      $start_year = $this->input->post('start_year');
      $start_month = $this->input->post('start_month');
      $start_date = $this->input->post('start_date');
      $end_date = $this->input->post('end_date');
      $course_no = $this->input->post('course_no');
      $teacher_no = $this->input->post('teacher_no');
      $class_room = $this->input->post('class_room');
      $numbers = $this->input->post('numbers');
      $cost = $this->input->post('cost');
      $status = $this->input->post('status');
      $remarks = $this->input->post('remarks');
       $subject_id = $this->input->post('subject_id');
      $this->class_m->updateOne($class_no, $class_name,$start_year, $start_month,
      $start_date, $end_date,  $course_no, $teacher_no, $class_room, $numbers, $cost, $status,$remarks,$class_id);
        
        
       $this->class_m->addSub($class_no, $subject_id, $start_date, $end_date, $teacher_no , $userinfo);
        
      redirect("class_c");
	}
	public function view_class_init($class_id = null){
	   $this->load->model('teacher_m','teacher_m');
		$this->load->model('course_m','course_m');
	   $data = array();
	  if(empty($class_id)){
        $class_id = $this->input->get('class_id');
        if(empty($class_id)){
          $class_id = $this->input->post('class_id');
        }
      }
	  $this->load->model('code_m','code_m');
	  $status = $this->code_m->getList("05");
	  $classData = $this->class_m->getOne($class_id);
	  $teacher = $this->teacher_m->getOneByNo($classData['teacher_no']);
	  $course = $this->course_m->getOneByNo($classData['course_no']);
	  
	  
	  $classData['teacher_name'] = $teacher['teacher_name'];
	  $classData['course_name'] = $course['course_name'];
	  
	  $classData['status'] = $status['STATUS'][$classData['status']];

	  $this->load->view('class_view_v',$classData);
	}
   public function delete_class($class_id = null){
      if(empty($class_id)){
        $class_id = $this->input->post('class_id');
      }
      
      $this->class_m->deleteOne($class_id);
      redirect("class_c");
	}
	public function chk_repeat($class_no, $old_no = null){
        log_message('info', "class_c chk_repeat start");
        log_message('info', "class_c chk_repeat post user:".$class_no." : :".$old_no);

        $checkuser = $this->class_m->checkRepeat($class_no,$old_no);
        $msg = "班级编号重复";
        if(!empty($checkuser)){
            echo urldecode(json_encode(urlencode($msg)));
        }

        log_message('info', "class chk_repeat end".var_export($checkuser,true));
    }
    
    public function selectKemu($course_id ,$class_id = 0)
    {
        $data = array();
        //echo "course_id;".$course_id;
        $this->load->model('subject_m','subject_m');
		$subjectData = $this->subject_m->getList($course_id, null);
         //var_dump($subjectData);
        $data['subjectData'] = @json_encode(array('Rows'=>$subjectData));
        $data['course_id'] = $course_id;
        $data['class_id'] = $class_id;
        $this->load->view('class_add_setcourse',$data);
    }
    public function save_subject(){
    	//$userinfo = $this->session->userdata('user');
    	$class_id = $this->input->post('class_id');
    	$subject_id = $this->input->post('subject_id');
    	
    	
    	//$this->class_m->addSub($class_id,　$subject_id, $start_date,　$end_date,　$teacher_no ,　$userInfo);
    	if(!empty($class_id)){
    		redirect("class_c/upd_class_init/".$class_id."/".$subject_id);
    	}else{
    		redirect("class_c/add_class_init/".$subject_id);
    	}	
    
    }
}