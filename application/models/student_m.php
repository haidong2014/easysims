<?php
class student_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_student';
    }

    public function getList()
    {
       $this->db->where('delete_flg', 0);
       $this->db->select('*');
       $query =  $this->db->get($this->table_name);
       return $query->result_array();
    }
    public function addOne($student_no,$student_name, $sex,$birthday, $id_card, $contact_way, 
         $parent_phone, $course_no, $class_no, $cost, $start_year,$start_month,$start_date,$end_date,
         $attendance,$system_user,$remarks){
      $this->db->set( 'student_no',		$student_no );
      $this->db->set( 'student_name',	$student_name );
      $this->db->set( 'sex',	$sex );
      $this->db->set( 'birthday',		$birthday );
      $this->db->set( 'id_card',		$property );
      $this->db->set( 'contact_way',		$course );
      $this->db->set( 'parent_phone',		$telephone );
      
      $this->db->set( 'course_no',	$course_no );
      $this->db->set( 'class_no',	$class_no );
      $this->db->set( 'cost',	$cost );
      $this->db->set( 'start_year',	$start_year );
      $this->db->set( 'start_month',	$start_month );
      $this->db->set( 'start_date',	$start_date );
      $this->db->set( 'end_date',	$end_date );
      $this->db->set( 'attendance',	$attendance );
      
      $this->db->set( 'system_user',	$system_user );
      $this->db->set( 'remarks',		$remarks );

      return $this->db->insert( $this->table_name );
    }
    public function getOne($student_id){
       $this->db->where('student_id', $student_id);
       $this->db->where('delete_flg', 0);
       $this->db->select('*');
       $query = $this->db->get($this->table_name);
       $student= null;
       log_message('info','student getone'.$student_id."|".var_export($query->result_array(),true));
       foreach ($query->result_array() as $row){
         $student = $row;
       }
       return $student;
    }

    public function updateOne($student_no,$student_name, $sex,$birthday, $id_card, $contact_way, 
         $parent_phone, $course_no, $class_no, $cost, $start_year,$start_month,$start_date,$end_date,
         $attendance,$system_user,$remarks,$student_id){
//          log_message('info', "ddd".$student_name."|".$sex."|".$birthday."|".$id_card."|".
//        $contact_way."|".$parent_phone."|".$system_user."|".$remarks."|".$student_id);
        $this->db->where('student_id', $student_id);
        $this->db->set( 'student_no',		$student_no );
        $this->db->set( 'student_name',	$student_name );
        $this->db->set( 'sex',	$sex );
        $this->db->set( 'birthday',		$birthday );
        $this->db->set( 'id_card',		$property );
        $this->db->set( 'contact_way',		$course );
        $this->db->set( 'parent_phone',		$telephone );
        
        $this->db->set( 'course_no',	$course_no );
        $this->db->set( 'class_no',	$class_no );
        $this->db->set( 'cost',	$cost );
        $this->db->set( 'start_year',	$start_year );
        $this->db->set( 'start_month',	$start_month );
        $this->db->set( 'start_date',	$start_date );
        $this->db->set( 'end_date',	$end_date );
        $this->db->set( 'attendance',	$attendance );
        
        $this->db->set( 'system_user',	$system_user );
        $this->db->set( 'remarks',		$remarks );

        return $this->db->update( $this->table_name );
    }

    public function deleteOne($student_id){
          log_message('info', "del"."|".$student_id);
        $this->db->where('student_id', $student_id);
        $this->db->set( 'delete_flg',		1 );
        return $this->db->update( $this->table_name );
    }

    public function getStudentName($student_no) {
        $this->db->select('student_name');
        $this->db->where('student_no', $student_no);
        $this->db->where('delete_flg', 0);
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }
    
    public function checkRepeat($new_no, $old_no){
        $this->db->select('student_no');
        $this->db->where('student_no', $new_no);
        if(!empty($old_no)){
        	$this->db->where('student_no !=', $old_no);
        }
        log_message('info','student checkRepeat '.$new_no."|".$old_no);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }
}