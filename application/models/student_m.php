<?php
class Student_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table_name='ss_student';
    }

    public function getList($keyword = null, $start_year = null, $start_month = null)
    {
        $this->db->select('t1.student_id,t1.student_no,t1.student_name,t1.age,t1.contact_way,t1.parent_phone,t2.code_name as sex');
        $this->db->from('ss_student t1');
        $this->db->join('ss_code t2', 't2.code_no=t1.sex and t2.code='."02", 'left');
        $this->db->where('t1.delete_flg', 0);
        if(!empty($keyword)){
            $this->db->like('t1.student_name',$keyword);
        }
        if(!empty($start_year)){
            $this->db->where('t1.start_year', $start_year);
        }
        if(!empty($start_month)){
            $this->db->like('t1.start_month', $start_month);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function addOne($student_no,$student_name, $sex,$birthday, $age, $id_card, $contact_way,
        $parent_phone, $course_id, $class_id, $cost, $start_year,$start_month,$start_date,$end_date,
        $attendance,$system_user,$remarks, $userInfo = 'sysuser'){
        $this->db->set( 'student_no',		$student_no );
        $this->db->set( 'student_name',	$student_name );
        $this->db->set( 'sex',	$sex );
        $this->db->set( 'birthday',		$birthday );
        $this->db->set( 'age',		$age );
        $this->db->set( 'id_card',		$id_card );
        $this->db->set( 'contact_way',		$contact_way );
        $this->db->set( 'parent_phone',		$parent_phone );
        $this->db->set( 'course_id',	$course_id );
        $this->db->set( 'class_id',	$class_id );
        $this->db->set( 'cost',	$cost );
        $this->db->set( 'start_year',	$start_year );
        $this->db->set( 'start_month',	$start_month );
        $this->db->set( 'start_date',	$start_date );
        $this->db->set( 'end_date',	$end_date );
        $this->db->set( 'attendance',	$attendance );
        $this->db->set( 'system_user',	$system_user );
        $this->db->set( 'remarks',		$remarks );
        $this->db->set('insert_user', $userInfo);
        $this->db->set('insert_time',date("Y-m-d H:i:s"));
        $this->db->set('update_user',$userInfo);
        $this->db->set('update_time', date("Y-m-d H:i:s"));
        $this->db->insert( $this->table_name );
        return $this->db->insert_id();
    }

    public function addOneOther($student_id, $graduate_school, $specialty,$graduate
        ,$ancestralhome,$know_school,$know_trade,$preference,$software_base,$purpose,
        $follow_city,$follow_company,$follow_salary,$follow_position,$follow_remarks,$userInfo ='sysuser'){
        $this->db->set( 'student_id',	$student_id );
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
        $this->db->set('insert_user', $userInfo);
        $this->db->set('insert_time',date("Y-m-d H:i:s"));
        $this->db->set('update_user',$userInfo);
        $this->db->set('update_time', date("Y-m-d H:i:s"));
        return $this->db->insert( "ss_student_others");
     }

    public function getOne($student_id){
       $this->db->where('student_id', $student_id);
       $this->db->where('delete_flg', 0);
       $this->db->select('*');
       $query = $this->db->get($this->table_name);
       $student= null;
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
       foreach ($query->result_array() as $row){
         $student = $row;
       }
       return $student;
    }

    public function getOneForUpd($student_id){
        $this->db->select('t1.*,t2.*');
        $this->db->from('ss_student t1');
        $this->db->join('ss_student_others t2', 't2.student_id=t1.student_id');
        $this->db->where('t1.student_id', $student_id);
        $this->db->where('t1.delete_flg', 0);
        $query = $this->db->get();
        $student= null;
        foreach ($query->result_array() as $row){
            $student = $row;
        }
        return $student;
    }

    public function updateOne($student_no,$student_name, $sex,$birthday, $age, $id_card, $contact_way,
         $parent_phone, $course_id, $class_id, $cost, $start_year,$start_month,$start_date,$end_date,
         $attendance,$system_user,$remarks,$student_id,$userInfo ='sysuser'){
        $this->db->where('student_id', $student_id);
        $this->db->set( 'student_no',		$student_no );
        $this->db->set( 'student_name',	$student_name );
        $this->db->set( 'sex',	$sex );
        $this->db->set( 'birthday',		$birthday );
        $this->db->set( 'age',		$age );
        $this->db->set( 'id_card',		$id_card );
        $this->db->set( 'contact_way',		$contact_way );
        $this->db->set( 'parent_phone',		$parent_phone );
        $this->db->set( 'course_id',	$course_id );
        $this->db->set( 'class_id',	$class_id );
        $this->db->set( 'cost',	$cost );
        $this->db->set( 'start_year',	$start_year );
        $this->db->set( 'start_month',	$start_month );
        $this->db->set( 'start_date',	$start_date );
        $this->db->set( 'end_date',	$end_date );
        $this->db->set( 'attendance',	$attendance );
        $this->db->set( 'system_user',	$system_user );
        $this->db->set( 'remarks',		$remarks );
        $this->db->set('update_user',$userInfo);
        $this->db->set('update_time', date("Y-m-d H:i:s"));
        return $this->db->update( $this->table_name );
    }
    public function updateOneOther($student_id, $graduate_school, $specialty,$graduate
    ,$ancestralhome,$know_school,$know_trade,$preference,$software_base,$purpose,
    $follow_city,$follow_company,$follow_salary,$follow_position,$follow_remarks,$userInfo ='sysuser'){
      $this->db->where('student_id', $student_id);
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
      $this->db->set('update_user',$userInfo);
      $this->db->set('update_time', date("Y-m-d H:i:s"));
      return $this->db->update( "ss_student_others");
    }

    public function deleteOne($data){
        $this->db->where('student_id',  $data['student_id']);
        $this->db->set( 'delete_flg',   $data['delete_flg']);
        $this->db->set( 'update_user',	$data['update_user'] );
        $this->db->set( 'update_time',	$data['update_time'] );
        return $this->db->update( $this->table_name );
    }

    public function deleteOneOther($data){
        $this->db->where('student_id',  $data['student_id']);
        $this->db->set( 'delete_flg',   $data['delete_flg']);
        $this->db->set( 'update_user',	$data['update_user'] );
        $this->db->set( 'update_time',	$data['update_time'] );
        return $this->db->update( "ss_student_others" );
    }

    public function getStudentName($student_no) {
        $this->db->select('student_name');
        $this->db->where('student_no', $student_no);
        $this->db->where('delete_flg', 0);
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function checkStudent($student_no){
        $this->db->select('student_id,student_no');
        $this->db->where('student_no', $student_no);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }
}