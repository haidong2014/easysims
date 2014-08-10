<?php 
/**
 * Teacher_c
 * @author liwei
 *
 */
class Teacher_c extends MY_Controller {
  public function __construct()
   {
        parent::__construct();
        $this->load->model('teacher_m','teacher_m');
   }
  /**
   * index
   */
	public function index()
	{
	  $data = array();
	  $user = $this->session->all_userdata();
    log_message('info', "####user".var_export($user,true));

    $teacherData = $this->teacher_m->getList();
    foreach($teacherData as &$data){
      $data['opt']="<a href=\"".SITE_URL."/teacher_c/view_teacher_init/".$data['teacher_id']."\">查看</a> |".
    "<a href=\"".SITE_URL."/teacher_c/upd_teacher_init/".$data['teacher_id']."\">编辑</a> |".
    "<a href=\"#\" onclick=\"delTeacher('".SITE_URL."/teacher_c/delete_teacher/".$data['teacher_id']."')\">删除</a>";
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
	/**
	 * add_teacher_init
	 */
	public function add_teacher_init(){
	  $data = array();
	  $this->load->view('teacher_add_v',$data);
	}
	/**
	 * add_teacher
	 */
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
          
    if($system_user){
      // add a user
        self::addUser($teacher_no,$teacher_name,$remarks);
    }
	   $this->teacher_m->addOne($teacher_no,$teacher_name, $sex,$birthday, $property, $course, 
          $telephone, $email, $system_user, $remarks);
     redirect("teacher_c");
	  
	}
	/**
	 * add a user if sysuser
	 * @param unknown_type $teacher_no
	 * @param unknown_type $remarks
	 */
	private function addUser($teacher_no,$teacher_name,$remarks){
	   $userinfo = $this->session->userdata('user');
	   log_message('info', " add user userinfo:".var_export($userinfo,true));
       //insert a user
      $this->load->model('user_m','user_m');
      $chkuser= $this->user_m->checkUser($teacher_no);
      if(!empty($chkuser)){return ;}//already exsit
      $userData['user'] = $teacher_no;
      $password =  self::getPwd(5);
      $userData['password'] = md5($password);
      $userData['user_name'] = $teacher_name;
      $userData['role_id'] = 1006;
      $userData['remarks'] = $remarks;
      $userData['delete_flg'] = 0;
      $userData['insert_user'] = 'sysuser';
      $sys_time = date("Y-m-d H:i:s");
      $userData['insert_time'] = $sys_time;
      $userData['update_user'] = 'sysuser';
      $userData['update_time'] = $sys_time;
      log_message('info', " add user userData:".var_export($userData,true));
      $this->user_m->addOne($userData);
	}
	/**
	 * upd_teacher_init
	 * @param unknown_type $teacher_id
	 */
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
	/**
	 * upd_teacher
	 * @param unknown_type $teacher_id
	 */
  public function upd_teacher($teacher_id = null){
      if(empty($teacher_id)){
        $teacher_id = $this->input->post('teacher_id');
      }
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
      if($system_user){
        log_message('info', " update user 2222:");
          // add a user
          $this->load->model('user_m','user_m');
          $chkuser = $this->user_m->checkUser($teacher_no);
          //log_message('info', " update user teacherid:".var_export($chkuser,true));
          if(empty($chkuser)){
            //log_message('info', " update user 3333:".$teacher_no.",". $teacher_name.",". $remarks);
            self::addUser($teacher_no, $teacher_name, $remarks);
          }
      }else{
        log_message('info', " update user 1111:".$teacher_no);
          $this->load->model('user_m','user_m');
          $chkuser= $this->user_m->checkUser($teacher_no);
          if(!empty($chkuser)){
            //log_message('info', " update user teacherid:".var_export($chkuser[0],true));
            $user= $this->user_m->deleteOne($chkuser[0]['user_id']);
          }
      }
      
      $this->teacher_m->updateOne($teacher_no, $teacher_name, $sex,$birthday, $property, $course, 
          $telephone, $email, $system_user, $remarks,$teacher_id);
          
      redirect("teacher_c");
	}
	/**
	 * view_teacher_init
	 * @param unknown_type $teacher_id
	 */
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
	/**
	 * delete_teacher
	 * @param unknown_type $teacher_id
	 */
   public function delete_teacher($teacher_id = null){
      if(empty($teacher_id)){
        $teacher_id = $this->input->post('teacher_id');
      }
      
      $this->teacher_m->deleteOne($teacher_id);
      redirect("teacher_c");
	}
	/**
	 * getPwd
	 * @param unknown_type $len
	 */
	private function getPwd($len){
	  $rand_str="";
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		for($i=0; $i<$len; $i++){
	    	 $rand_str .= $str[mt_rand(0, strlen($str)-1)];
		}
	 	return $rand_str;
	}
}