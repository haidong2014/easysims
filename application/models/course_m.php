<?php
class  course_m extends MY_Model 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_course';
    }
    
    public function getList($keyword)
    {
       $this->db->where('delete_flg', 0); 
       if(!empty($keyword)){
          $this->db->like('course_no',$keyword);
          $this->db->or_like('course_name',$keyword);
       }
       $this->db->select('*');
       $query =  $this->db->get($this->table_name);
       return $query->result_array();
    }
    public function addOne($course_no, $course_name, $remarks){
    	$this->db->set( 'course_no',		$course_no );
      	$this->db->set( 'course_name',		$course_name );
  		$this->db->set( 'remarks',		$remarks );
  
  		return $this->db->insert( $this->table_name );
    }
    public function getOne($course_id){
       $this->db->where('course_id', $course_id); 
       $this->db->where('delete_flg', 0); 
       $this->db->select('*');    
       $query = $this->db->get($this->table_name);
       $course= null;
       log_message('info','course getone'.$course_id."|".var_export($query->result_array(),true));
       foreach ($query->result_array() as $row){
         $course = $row;
       }
    	return $course;
    }
    
    public function updateOne($course_no, $course_name, $remarks,$course_id){
        log_message('info', "ddd".$course_name."|".$course_no."|".$remarks."|".$course_id);
        $this->db->where('course_id', $course_id);
        $this->db->set( 'course_name',		$course_name );
        $this->db->set( 'course_no',		$course_no );
        $this->db->set( 'remarks',		$remarks );

		return $this->db->update( $this->table_name );
    }
    
    public function deleteOne($course_id){
        log_message('info', "del"."|".$course_id);
        $this->db->where('course_id', $course_id);
        $this->db->set( 'delete_flg',		1 );
		return $this->db->update( $this->table_name );
    }
    
    public function checkRepeat($new_no, $old_no){
        $this->db->select('course_no');
        $this->db->where('course_no', $new_no);
        if(!empty($old_no)){
        	$this->db->where('course_no !=', $old_no);
        }
        log_message('info','course checkRepeat '.$new_no."|".$old_no);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }
}