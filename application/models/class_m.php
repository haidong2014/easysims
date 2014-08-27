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
        $this->db->join('ss_teachers t2', 't1.teacher_no = t2.teacher_no', 'left');
        $this->db->join('ss_code t3', 't1.status = t3.code_no and t3.code = '."05", 'left');
        $this->db->join('ss_course t4', 't1.course_id = t4.course_id', 'left');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('t1.class_name like', '%'.$data['search_key'].'%');
        }
        if(!empty($data['search_year']) && !empty($data['search_month'])){
            $this->db->where('t1.start_year', $data['search_year']);
            $this->db->where('t1.start_month', $data['search_month']);
        }
        $this->db->where('t1.delete_flg', 0);
        $query =  $this->db->get();
        log_message('info', "class_m getList sql:".$this->db->last_query());
        return $query->result_array();
    }

    public function addOne($class_no, $class_name,$start_year, $start_month,
        $start_date, $end_date,  $course_id, $teacher_no, $class_room, $numbers, $cost, $status, $remarks){
        
        log_message('info', "ddd".$class_no."|".$class_name."|".$start_year."|".$start_month."|".
        $start_date."|".$end_date."|".$course_id."|".$teacher_no."|".$class_room
        ."|".$numbers."|".$cost."|".$status."|".$remarks);
        
        $this->db->set( 'class_name',		$class_name );
        $this->db->set( 'class_no',		$class_no );
        $this->db->set( 'start_year',	$start_year );
        $this->db->set( 'start_month',	$start_month );
        $this->db->set( 'start_date',	$start_date );
        $this->db->set( 'end_date',		$end_date );
        $this->db->set( 'course_id',		$course_id );
        $this->db->set( 'teacher_no',		$teacher_no );
        $this->db->set( 'class_room',		$class_room );
        $this->db->set( 'numbers',		$numbers );
        $this->db->set( 'cost',		$cost );
        $this->db->set( 'status',		$status );
        $this->db->set( 'remarks',		$remarks );

        $this->db->insert( $this->table_name );
        return $this->db->insert_id();
    }
    public function getOne($class_id){
       $this->db->where('class_id', $class_id);
       $this->db->where('delete_flg', 0);
       $this->db->select('*');
       $query = $this->db->get($this->table_name);
       $class= null;
       log_message('info','class getone'.$class_id."|".var_export($query->result_array(),true));
       foreach ($query->result_array() as $row){
         $class = $row;
       }
       return $class;
    }

    public function updateOne($class_no, $class_name,$start_year, $start_month,
        $start_date, $end_date,  $course_id, $teacher_no, $class_room, $numbers, $cost, $status,$remarks,$class_id){
          log_message('info', "ddd".$class_no."|".$class_name."|".$start_year."|".$start_month."|".
        $start_date."|".$end_date."|".$course_id."|".$teacher_no."|".$class_room
        ."|".$numbers."|".$cost."|".$status."|".$remarks."|".$class_id);
        $this->db->where('class_id', $class_id);
        $this->db->set( 'class_name',		$class_name );
        $this->db->set( 'class_no',		$class_no );
        $this->db->set( 'start_year',	$start_year );
        $this->db->set( 'start_month',	$start_month );
        $this->db->set( 'start_date',	$start_date );
        $this->db->set( 'end_date',		$end_date );
        $this->db->set( 'course_id',		$course_id );
        $this->db->set( 'teacher_no',		$teacher_no );
        $this->db->set( 'class_room',		$class_room );
        $this->db->set( 'numbers',		$numbers );
        $this->db->set( 'cost',		$cost );
        $this->db->set( 'status',		$status );
        $this->db->set( 'remarks',		$remarks );

        return $this->db->update( $this->table_name );
    }

    public function deleteOne($class_id){
          log_message('info', "del"."|".$class_id);
        $this->db->where('class_id', $class_id);
        $this->db->set( 'delete_flg',		1 );
        return $this->db->update( $this->table_name );
    }
    
    public function checkRepeat($new_no, $old_no){
        $this->db->select('class_no');
        $this->db->where('class_no', $new_no);
        if(!empty($old_no)){
        	$this->db->where('class_no !=', $old_no);
        }
        log_message('info','class checkRepeat '.$new_no."|".$old_no);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }
    
    public function addSub($class_no ,$subject_id, $start_date, $end_date, $teacher_no , $userInfo){
    
        $sql ="delete from ss_class_course  where class_no = '".$class_no."'";
        $this->db->query($sql);
        $subject_ids = explode(",",$subject_id);
        
        foreach($subject_ids as $id){
         	$this->db->set( 'class_no',		$class_no );
        	$this->db->set( 'subject_id',	$subject_id );
        	$this->db->set( 'start_date',	$start_date );
        	$this->db->set( 'end_date',		$end_date );
        	$this->db->set( 'teacher_no',	$teacher_no );
    		$this->db->set( 'insert_user',   $userInfo);
        	$this->db->set( 'insert_time',   date("Y-m-d H:i:s")); 
        	$this->db->set( 'update_user',   $userInfo);
        	$this->db->set( 'update_time',   date("Y-m-d H:i:s"));
    		 $this->db->insert( "ss_class_course" );
        }
        return count($subject_ids);
    }
    
    public function getSubList($class_no)
    {
        $this->db->select('class_no,subject_id,start_date,end_date,teacher_no');
        $this->db->where( 'class_no', $class_no );

        $this->db->where('delete_flg', 0);
        $query =  $this->db->get("ss_class_course");
        return $query->result_array();
    }
}