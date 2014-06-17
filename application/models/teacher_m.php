<?php
class Teacher_m extends MY_Model 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_teachers';
    }
    
    public function getList()
    {
       $this->db->where('delete_flg', 0); 
       $this->db->select('*');
       $query =  $this->db->get($this->table_name);
       return $query->result_array();
    }
    public function addOne($teacher_name, $sex,$birthday, $property, $course, 
          $telephone, $email, $system_user, $remarks){
      $this->db->set( 'teacher_name',		$teacher_name );
		  $this->db->set( 'sex',	$sex );
		  $this->db->set( 'birthday',		$birthday );
		  $this->db->set( 'property',		$property );
		  $this->db->set( 'course',		$course );
		  $this->db->set( 'telephone',		$telephone );
		  $this->db->set( 'email',		$email );
		  $this->db->set( 'system_user',		$system_user );
		  $this->db->set( 'remarks',		$remarks );

		  return $this->db->insert( $this->table_name );
    }
    public function getOne($teacher_id){
       $this->db->where('teacher_id', $teacher_id); 
       $this->db->where('delete_flg', 0); 
       $this->db->select('*');    
       $query = $this->db->get($this->table_name);
       $teacher= null;
       
       foreach ($query->result_array() as $row){
         $teacher = $row;
       }
    	 return $teacher;
    }
    
    public function updateOne($teacher_name, $sex,$birthday, $property, 
        $course, $telephone, $email, $system_user, $remarks){
      $this->db->where('teacher_id', $teacher_id);
      $this->db->set( 'teacher_name',		$teacher_name );
		  $this->db->set( 'sex',	$sex );
		  $this->db->set( 'birthday',		$birthday );
		  $this->db->set( 'property',		$property );
		  $this->db->set( 'course',		$course );
		  $this->db->set( 'telephone',		$telephone );
		  $this->db->set( 'email',		$email );
		  $this->db->set( 'system_user',		$system_user );
		  $this->db->set( 'remarks',		$remarks );

		  return $this->db->update( $this->table_name );
    }
}