<?php 
class Class_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct();
        $this->load->model('class_m','class_m');
   }

	public function index()
	{
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
      log_message('info', "####href".$data['opt']);
    }
    $data['txtKey'] = $keyword;
    $data['classData'] = $classData;
    $data['classsData'] = @json_encode(array('Rows'=>$classData));
    
		$this->load->view('class_lst_v',$data);
	}
	public function add_class_init(){
	  $data = array();
	  $this->load->view('class_add_v',$data);
	}
	public function add_class(){
	   log_message('info','add class '.var_export($_POST,true));
	   $class_id = $this->input->post('class_id');
	   $class_name = $this->input->post('class_name');
	   $start_date = $this->input->post('start_date');
	   $end_date = $this->input->post('end_date');
	   $teacher_id = $this->input->post('teacher_id');
	   $class_room = $this->input->post('class_room');
     $status = $this->input->post('status');
    
     $remarks = $this->input->post('remarks');
          
	   $this->class_m->addOne($class_id,$class_name, $start_date,$end_date, $teacher_id, $class_room, 
          $status, $email, $system_user, $remarks);
     redirect("class_c");
	  
	}
	public function upd_class_init($class_id = null){
	  
	  $data = array();
	  if(empty($class_id)){
        $class_id = $this->input->get('class_id');
        if(empty($class_id)){
          $class_id = $this->input->post('class_id');
        }
     }
	 
	  $classData = $this->class_m->getOne($class_id);

	  $this->load->view('class_add_v',$classData);
	}
    public function upd_class($class_id = null){
      if(empty($class_id)){
        $class_id = $this->input->post('class_id');
      }
      $class_id = $this->input->post('class_id');
      $class_name = $this->input->post('$class_name');
      $start_date = $this->input->post('start_date');
      $end_date = $this->input->post('end_date');
      $teacher_id = $this->input->post('teacher_id');
      $class_room = $this->input->post('class_room');
      $status = $this->input->post('status');
 
      $remarks = $this->input->post('remarks');
          
      $this->class_m->updateOne($class_id, $class_name, $start_date,$end_date, $teacher_id, $class_room, 
          $status, $remarks,$class_id);
      redirect("class_c");
	}
public function view_class_init($class_id = null){
	  
	  $data = array();
	  if(empty($class_id)){
        $class_id = $this->input->get('class_id');
        if(empty($class_id)){
          $class_id = $this->input->post('class_id');
        }
     }
	 
	  $classData = $this->class_m->getOne($class_id);

	  $this->load->view('class_view_v',$classData);
	}
   public function delete_class($class_id = null){
      if(empty($class_id)){
        $class_id = $this->input->post('class_id');
      }
      
      $this->class_m->deleteOne($class_id);
      redirect("class_c");
	}
}