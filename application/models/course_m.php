<?php
class  course_m extends MY_Model 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_course';
    }
    
    public function getList()
    {
       $this->db->where('delete_flg', 0); 
       $this->db->select('*');
       $query =  $this->db->get($this->table_name);
       return $query->result_array();
    }
    public function addOne($course_no,$course_name, $sex,$birthday, $property, $course, 
        $telephone, $email, $system_user, $remarks){
      	$this->db->set( 'course_name',		$course_no );
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
    
    public function updateOne($course_name, $sex,$birthday, $id_card, 
        $contact_way, $parent_phone,  $system_user, $remarks,$course_id){
          log_message('info', "ddd".$course_name."|".$sex."|".$birthday."|".$id_card."|".
        $contact_way."|".$parent_phone."|".$system_user."|".$remarks."|".$course_id);
        $this->db->where('course_id', $course_id);
        $this->db->set( 'course_name',		$course_name );
        
        $this->db->set( 'remarks',		$remarks );

		    return $this->db->update( $this->table_name );
    }
    
    public function deleteOne($course_id){
          log_message('info', "del"."|".$course_id);
        $this->db->where('course_id', $course_id);
        $this->db->set( 'delete_flg',		1 );
		    return $this->db->update( $this->table_name );
    }
}