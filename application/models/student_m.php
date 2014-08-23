<?php
class student_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_student';
    }

    public function getList($keyword = null)
    {
       $this->db->where('delete_flg', 0);
        if(!empty($keyword)){
            $this->db->like('student_name',$keyword);
        }
       $this->db->select('*');
       $query =  $this->db->get($this->table_name);
       return $query->result_array();
    }
    public function addOne($student_no,$student_name, $sex,$birthday, $age, $id_card, $contact_way, 
         $parent_phone, $course_no, $class_no, $cost, $start_year,$start_month,$start_date,$end_date,
         $attendance,$system_user,$remarks){
      $this->db->set( 'student_no',		$student_no );
      $this->db->set( 'student_name',	$student_name );
      $this->db->set( 'sex',	$sex );
      $this->db->set( 'birthday',		$birthday );
      $this->db->set( 'age',		$age );
      $this->db->set( 'id_card',		$id_card );
      $this->db->set( 'contact_way',		$contact_way );
      $this->db->set( 'parent_phone',		$parent_phone );
      
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

       $this->db->insert( $this->table_name );
      return $this->db->insert_id();
    }
    public function addOneOther($student_id,$student_no, $graduate_school, $specialty,$graduate
    ,$ancestralhome,$know_school,$know_trade,$preference,$software_base,$purpose,
    $follow_city,$follow_company,$follow_salary,$follow_position,$follow_remarks){
    	  $this->db->set( 'student_id',	$student_id );
          $this->db->set( 'student_no',	$student_no );
          $this->db->set( 'graduate_school',	$graduate_school );
          $this->db->set( 'specialty',	$specialty );
          $this->db->set( 'graduate',	$graduate );
          $this->db->set( 'ancestralhome',	$ancestralhome );
          $this->db->set( 'know_school',	$know_school );
          $this->db->set( 'know_trade',	$know_trade );
          $this->db->set( 'preference',	$preference );
          $this->db->set( 'software_base',	$software_base );
          $this->db->set( 'purpose',	$purpose );
          $this->db->set( 'follow_city',	$follow_city );
          $this->db->set( 'follow_company',	$follow_company );
          $this->db->set( 'follow_salary',	$follow_salary );
          $this->db->set( 'follow_position',	$follow_position );
          $this->db->set( 'follow_remarks',	$follow_remarks );
          
          return $this->db->insert( "ss_student_others");
          
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
    public function getOneOther($student_id){
       $this->db->where('student_id', $student_id);
       $this->db->where('delete_flg', 0);
       $this->db->select('*');
       $query = $this->db->get("ss_student_others");
       $student= null;
       log_message('info','student getoneother'.$student_id."|".var_export($query->result_array(),true));
       foreach ($query->result_array() as $row){
         $student = $row;
       }
       return $student;
    }
    public function updateOne($student_no,$student_name, $sex,$birthday, $age, $id_card, $contact_way, 
         $parent_phone, $course_no, $class_no, $cost, $start_year,$start_month,$start_date,$end_date,
         $attendance,$system_user,$remarks,$student_id){
//          log_message('info', "ddd".$student_name."|".$sex."|".$birthday."|".$id_card."|".
//        $contact_way."|".$parent_phone."|".$system_user."|".$remarks."|".$student_id);
        $this->db->where('student_id', $student_id);
        $this->db->set( 'student_no',		$student_no );
        $this->db->set( 'student_name',	$student_name );
        $this->db->set( 'sex',	$sex );
        $this->db->set( 'birthday',		$birthday );
        $this->db->set( 'age',		$age );
        $this->db->set( 'id_card',		$id_card );
        $this->db->set( 'contact_way',		$contact_way );
        $this->db->set( 'parent_phone',		$parent_phone );
        
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
    public function updateOneOther($student_id, $student_no, $graduate_school, $specialty,$graduate
    ,$ancestralhome,$know_school,$know_trade,$preference,$software_base,$purpose,
    $follow_city,$follow_company,$follow_salary,$follow_position,$follow_remarks){
      $this->db->where('student_id', $student_id);
      $this->db->set( 'student_no',	$student_no );
      $this->db->set( 'graduate_school',	$graduate_school );
      $this->db->set( 'specialty',	$specialty );
      $this->db->set( 'graduate',	$graduate );
      $this->db->set( 'ancestralhome',	$ancestralhome );
      $this->db->set( 'know_school',	$know_school );
      $this->db->set( 'know_trade',	$know_trade );
      $this->db->set( 'preference',	$preference );
      $this->db->set( 'software_base',	$software_base );
      $this->db->set( 'purpose',	$purpose );
      $this->db->set( 'follow_city',	$follow_city );
      $this->db->set( 'follow_company',	$follow_company );
      $this->db->set( 'follow_salary',	$follow_salary );
      $this->db->set( 'follow_position',	$follow_position );
      $this->db->set( 'follow_remarks',	$follow_remarks );
      
      return $this->db->update( "ss_student_others");
    }
    public function deleteOne($student_id){
          log_message('info', "del"."|".$student_id);
        $this->db->where('student_id', $student_id);
        $this->db->set( 'delete_flg',		1 );
        return $this->db->update( $this->table_name );
    }
   public function deleteOneOther($student_id){
          log_message('info', "del"."|".$student_id);
        $this->db->where('student_id', $student_id);
        $this->db->set( 'delete_flg',		1 );
        return $this->db->update( "ss_student_others" );
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