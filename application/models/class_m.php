<?php
class class_m extends MY_Model 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_class';
    }
    
    public function getList()
    {
       $this->db->where('delete_flg', 0); 
       $this->db->select('*');
       $query =  $this->db->get($this->table_name);
       return $query->result_array();
    }
    public function addOne($class_no,$class_name, $sex,$birthday, $property, $course, 
          $telephone, $email, $system_user, $remarks){
      $this->db->set( 'class_name',		$class_no );
		  $this->db->set( 'start_date',	$start_date );
		  $this->db->set( 'end_date',		$end_date );
		  $this->db->set( 'teacher_id',		$teacher_id );
		  $this->db->set( 'class_room',		$class_room );
		  $this->db->set( 'numbers',		$numbers );
		  $this->db->set( 'status',		$status );
		  $this->db->set( 'remarks',		$remarks );

		  return $this->db->insert( $this->table_name );
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
    
    public function updateOne($class_name, $sex,$birthday, $id_card, 
        $contact_way, $parent_phone,  $system_user, $remarks,$class_id){
          log_message('info', "ddd".$class_name."|".$sex."|".$birthday."|".$id_card."|".
        $contact_way."|".$parent_phone."|".$system_user."|".$remarks."|".$class_id);
        $this->db->where('class_id', $class_id);
        $this->db->set( 'class_name',		$class_name );
        $this->db->set( 'start_date',	$start_date );
        $this->db->set( 'end_date',		$end_date );
        $this->db->set( 'teacher_id',		$teacher_id );
        $this->db->set( 'class_room',		$class_room );
        $this->db->set( 'numbers',		$numbers );
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
}