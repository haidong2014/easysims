<?php
class Class_m extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_class';
    }

    public function getList($data)
    {
        $this->db->select('t1.*,t2.teacher_name,t3.code_name,t4.course_name');
        $this->db->from('ss_class t1');
        $this->db->join('ss_teachers t2', 't1.teacher_id = t2.teacher_id', 'left');
        $this->db->join('ss_code t3', 't1.status = t3.code_no and t3.code = '."05", 'left');
        $this->db->join('ss_course t4', 't1.course_id = t4.course_id', 'left');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('t1.class_name like', '%'.$data['search_key'].'%');
        }
        if(!empty($data['start_year']) && !empty($data['start_month'])){
            $this->db->where('t1.start_year', $data['start_year']);
            $this->db->where('t1.start_month', $data['start_month']);
        }
        if(!empty($data['end_year']) && !empty($data['end_month'])){
            $this->db->where('t1.end_year', $data['end_year']);
            $this->db->where('t1.end_month', $data['end_month']);
        }
        if(!empty($data['status'])){
            $this->db->where('t1.status', $data['status']);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t1.class_id','esc');
        $query =  $this->db->get();
        log_message('info', "class_m getList sql:".$this->db->last_query());
        return $query->result_array();
    }

    public function addOne($data){

        $this->db->set( 'class_no',		$data['class_no'] );
        $this->db->set( 'class_name',	$data['class_name'] );
        $this->db->set( 'start_date',	$data['start_date'] );
        $this->db->set( 'end_date',		$data['end_date'] );
        $this->db->set( 'start_year',	$data['start_year'] );
        $this->db->set( 'start_month',	$data['start_month'] );
        $this->db->set( 'end_year',  	$data['end_year'] );
        $this->db->set( 'end_month',	$data['end_month'] );
        $this->db->set( 'course_id',	$data['course_id'] );
        $this->db->set( 'teacher_id',	$data['teacher_id'] );
        $this->db->set( 'class_room',	$data['class_room'] );
        $this->db->set( 'numbers',		$data['numbers'] );
        $this->db->set( 'cost',		    $data['cost'] );
        $this->db->set( 'status',		$data['status'] );
        $this->db->set( 'remarks',		$data['remarks'] );
        $this->db->set( 'delete_flg',	$data['delete_flg'] );
        $this->db->set('insert_user',   $data['insert_user'] );
        $this->db->set('insert_time',   $data['insert_time'] );
        $this->db->set('update_user',   $data['update_user']);
        $this->db->set('update_time',   $data['update_time']);
        $this->db->insert( $this->table_name );
        return $this->db->insert_id();
    }

    public function getOne($class_id){
       $this->db->where('class_id', $class_id);
       $this->db->where('delete_flg', 0);
       $this->db->select('*');
       $query = $this->db->get($this->table_name);
       $class= null;
       foreach ($query->result_array() as $row){
         $class = $row;
       }
       return $class;
    }

    public function getClassName($class_id){
       $this->db->select('class_name');
       $this->db->where('class_id', $class_id);
       $this->db->where('delete_flg', 0);
       $query = $this->db->get($this->table_name);
       $class_name = null;
       foreach ($query->result_array() as $row){
         $class_name = $row['class_name'];
       }
       return $class_name;
    }

    public function updateOne($data){
        $this->db->where('class_id',    $data['class_id']);
        $this->db->set( 'class_name',	$data['class_name'] );
        $this->db->set( 'start_date',	$data['start_date'] );
        $this->db->set( 'end_date',		$data['end_date'] );
        $this->db->set( 'start_year',	$data['start_year'] );
        $this->db->set( 'start_month',	$data['start_month'] );
        $this->db->set( 'end_year',	    $data['end_year'] );
        $this->db->set( 'end_month',	$data['end_month'] );
        $this->db->set( 'course_id',	$data['course_id'] );
        $this->db->set( 'teacher_id',	$data['teacher_id'] );
        $this->db->set( 'class_room',	$data['class_room'] );
        $this->db->set( 'numbers',		$data['numbers'] );
        $this->db->set( 'cost',		    $data['cost'] );
        $this->db->set( 'status',		$data['status'] );
        $this->db->set( 'remarks',		$data['remarks'] );
        $this->db->set( 'delete_flg',	$data['delete_flg'] );
        $this->db->set('update_user',   $data['update_user']);
        $this->db->set('update_time',   $data['update_time']);

        return $this->db->update( $this->table_name );
    }

    public function deleteOne($data){
        $this->db->where('class_id',  $data['class_id']);
        $this->db->set( 'delete_flg',   $data['delete_flg']);
        $this->db->set( 'update_user',	$data['update_user'] );
        $this->db->set( 'update_time',	$data['update_time'] );
        return $this->db->update( $this->table_name );
    }

    public function checkClass($class_no){
        $this->db->select('class_id,class_no');
        $this->db->where('class_no', $class_no);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function deleteSubject($data){
        $sql ="delete from ss_class_course  where class_no = '".$data['$class_id']."'";
        $this->db->query($sql);
    }

    public function addSubject($data){
        $this->db->set( 'class_no',		$data['class_id'] );
        $this->db->set( 'subject_id',	$data['subject_id'] );
        $this->db->set( 'start_date',	$data['start_date'] );
        $this->db->set( 'end_date',		$data['end_date'] );
        $this->db->set( 'teacher_id',	$data['teacher_id'] );
        $this->db->set( 'delete_flg',   $data['delete_flg'] );
        $this->db->set( 'insert_user',  $data['insert_user'] );
        $this->db->set( 'insert_time',  $data['insert_time'] );
        $this->db->set( 'update_user',  $data['update_user'] );
        $this->db->set( 'update_time',  $data['update_time'] );
        $this->db->insert( "ss_class_course" );
    }

    public function getSubjectList($class_id,$course_id,$search_key=null)
    {
        $this->db->select('t1.class_id,t1.course_id,t1.subject_id,t1.start_date,t1.end_date,t1.teacher_id,' .
                          't2.subject_name,t2.period,t3.teacher_name');
        $this->db->from('ss_class_course t1');
        $this->db->join('ss_subject t2', 't1.course_id = t2.course_id and t1.subject_id = t2.subject_id', 'left');
        $this->db->join('ss_teachers t3', 't1.teacher_id = t3.teacher_id', 'left');
        $this->db->where( 't1.class_id', $class_id );
        $this->db->where( 't1.course_id', $course_id );
        if($search_key <> null && trim($search_key) <> ""){
            $this->db->where('t2.subject_name like', '%'.$search_key.'%');
        }
        $this->db->order_by('t1.subject_id');
        $query =  $this->db->get();
        log_message('info', "class_m getSubjectList sql:".$this->db->last_query());
        return $query->result_array();
    }

    public function getOneSubject($class_id,$course_id,$subject_id){
        $this->db->where('class_id',    $class_id);
        $this->db->where('course_id',    $course_id);
        $this->db->where('subject_id',    $subject_id);
        $this->db->where('delete_flg', 0);
        $this->db->select('*');
        $query = $this->db->get("ss_class_course");
        $class= null;
        foreach ($query->result_array() as $row){
            $class = $row;
        }
        return $class;
    }

    public function updateSubject($data){

      $subject = self::getOneSubject($data['class_id'],$data['course_id'],$data['subject_id']);

      if(0<count($subject)){
          $this->db->where('class_id',     $data['class_id'] );
          $this->db->where('course_id',    $data['course_id'] );
          $this->db->where('subject_id',   $data['subject_id'] );
          $this->db->set('start_date',	   $data['start_date'] );
          $this->db->set('end_date',	   $data['end_date'] );
          $this->db->set('teacher_id',	   $data['teacher_id'] );
          $this->db->set('update_user',    $data['update_user'] );
          $this->db->set('update_time',    $data['update_time'] );

          return $this->db->update( "ss_class_course");
      }else{
          $this->db->set('class_id',      $data['class_id'] );
          $this->db->set('course_id',     $data['course_id'] );
          $this->db->set('subject_id',    $data['subject_id'] );
          $this->db->set('start_date',	   $data['start_date'] );
          $this->db->set('end_date',	   $data['end_date'] );
          $this->db->set('teacher_id',	   $data['teacher_id'] );
          $this->db->set('delete_flg',    $data['delete_flg'] );
          $this->db->set('insert_user',   $data['insert_user'] );
          $this->db->set('insert_time',   $data['insert_time'] );
          $this->db->set('update_user',   $data['update_user'] );
          $this->db->set('update_time',   $data['update_time'] );

          return $this->db->insert( "ss_class_course" );
      }
    }
}