<?php
class Student_m extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name='ss_student';
    }

    public function getList($keyword = null, $start_year = null, $start_month = null, $class_id = null)
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
        if(!empty($class_id)){
            $this->db->like('t1.class_id', $class_id);
        }
        $this->db->order_by('t1.student_id','esc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function addOne($data){
        $this->db->set( 'student_no',		$data['student_no'] );
        $this->db->set( 'student_name',	    $data['student_name'] );
        $this->db->set( 'sex',	            $data['sex'] );
        $this->db->set( 'birthday',		    $data['birthday'] );
        $this->db->set( 'age',		        $data['age'] );
        $this->db->set( 'id_card',		    $data['id_card'] );
        $this->db->set( 'contact_way',		$data['contact_way'] );
        $this->db->set( 'parent_phone',		$data['parent_phone'] );
        $this->db->set( 'course_id',	    $data['course_id'] );
        $this->db->set( 'class_id',	        $data['class_id'] );
        $this->db->set( 'cost',	            $data['cost'] );
        $this->db->set( 'start_year',	    $data['start_year'] );
        $this->db->set( 'start_month',	    $data['start_month'] );
        $this->db->set( 'start_date',	    $data['start_date'] );
        $this->db->set( 'end_date',	        $data['end_date'] );
        $this->db->set( 'attendance',	    $data['attendance'] );
        $this->db->set( 'system_user',	    $data['system_user'] );
        $this->db->set( 'remarks',		    $data['remarks'] );
        $this->db->set( 'delete_flg',		$data['delete_flg'] );
        $this->db->set('insert_user',       $data['insert_user']);
        $this->db->set('insert_time',       $data['insert_time']);
        $this->db->set('update_user',       $data['update_user']);
        $this->db->set('update_time',       $data['update_time']);
        $this->db->insert( $this->table_name );
        return $this->db->insert_id();
    }

    public function addOneOther($data){
        $this->db->set( 'student_id',	      $data['student_id'] );
        $this->db->set( 'graduate_school',	  $data['graduate_school'] );
        $this->db->set( 'specialty',	      $data['specialty'] );
        $this->db->set( 'graduate',	          $data['graduate'] );
        $this->db->set( 'ancestralhome',	  $data['ancestralhome'] );
        $this->db->set( 'know_school',   	  $data['know_school'] );
        $this->db->set( 'know_trade',	      $data['know_trade'] );
        $this->db->set( 'preference',	      $data['preference']  );
        $this->db->set( 'software_base',	  $data['software_base'] );
        $this->db->set( 'purpose',	          $data['purpose'] );
        $this->db->set( 'job_id',	          $data['job_id'] );
        $this->db->set( 'follow_salary',	  $data['follow_salary'] );
        $this->db->set( 'follow_position',	  $data['follow_position'] );
        $this->db->set( 'follow_remarks',	  $data['follow_remarks'] );
        $this->db->set( 'delete_flg',		  $data['delete_flg'] );
        $this->db->set('insert_user',         $data['insert_user'] );
        $this->db->set('insert_time',         $data['insert_time'] );
        $this->db->set('update_user',         $data['update_user']);
        $this->db->set('update_time',         $data['update_time']);
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

    public function updateOne($data){
        $this->db->where('student_id',     $data['student_id'] );
        $this->db->set( 'student_no',	   $data['student_no'] );
        $this->db->set( 'student_name',	   $data['student_name'] );
        $this->db->set( 'sex',	           $data['sex'] );
        $this->db->set( 'birthday',		   $data['birthday'] );
        $this->db->set( 'age',		       $data['age'] );
        $this->db->set( 'id_card',		   $data['id_card'] );
        $this->db->set( 'contact_way',	   $data['contact_way'] );
        $this->db->set( 'parent_phone',	   $data['parent_phone'] );
        $this->db->set( 'course_id',	   $data['course_id'] );
        $this->db->set( 'cost',	           $data['cost'] );
        $this->db->set( 'start_year',	   $data['start_year'] );
        $this->db->set( 'start_month',     $data['start_month'] );
        $this->db->set( 'start_date',	   $data['start_date'] );
        $this->db->set( 'end_date',	       $data['end_date'] );
        $this->db->set( 'attendance',	   $data['attendance'] );
        $this->db->set( 'system_user',	   $data['system_user'] );
        $this->db->set( 'remarks',		   $data['remarks'] );
        $this->db->set('update_user',      $data['update_user']);
        $this->db->set('update_time',      $data['update_time']);
        return $this->db->update( $this->table_name );
    }

    public function updateOneOther($data){
        $this->db->where('student_id',        $data['student_id']);
        $this->db->set( 'graduate_school',	  $data['graduate_school'] );
        $this->db->set( 'specialty',	      $data['specialty'] );
        $this->db->set( 'graduate',	          $data['graduate'] );
        $this->db->set( 'ancestralhome',	  $data['ancestralhome'] );
        $this->db->set( 'know_school',   	  $data['know_school'] );
        $this->db->set( 'know_trade',	      $data['know_trade'] );
        $this->db->set( 'preference',	      $data['preference']  );
        $this->db->set( 'software_base',	  $data['software_base'] );
        $this->db->set( 'purpose',	          $data['purpose'] );
        $this->db->set( 'job_id',	          $data['job_id'] );
        $this->db->set( 'follow_salary',	  $data['follow_salary'] );
        $this->db->set( 'follow_position',	  $data['follow_position'] );
        $this->db->set( 'follow_remarks',	  $data['follow_remarks'] );
        $this->db->set('update_user',         $data['update_user']);
        $this->db->set('update_time',         $data['update_time']);
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

    public function getStudentName($student_id) {
        $this->db->select('student_name');
        $this->db->where('student_id', $student_id);
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