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
        $this->db->set( 'end_year',	        $data['end_year'] );
        $this->db->set( 'end_month',	    $data['end_month'] );
        $this->db->set( 'start_date',	    $data['start_date'] );
        $this->db->set( 'end_date',	        $data['end_date'] );
        $this->db->set( 'scores',	        $data['scores'] );
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

    public function getStudentId($student_no){
       $this->db->select('student_id');
       $this->db->where('student_no', $student_no);
       $this->db->where('delete_flg', 0);
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
        $this->db->set( 'end_year',	       $data['end_year'] );
        $this->db->set( 'end_month',       $data['end_month'] );
        $this->db->set( 'start_date',	   $data['start_date'] );
        $this->db->set( 'end_date',	       $data['end_date'] );
        $this->db->set( 'scores',	       $data['scores'] );
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

    public function search($data){
        $this->db->select('t1.*,t2.*,t3.class_name,t4.course_name,t5.teacher_name,t6.job_company,t6.job_city,' .
                          't7.code_name as sex,t8.code_name as graduate');
        $this->db->from('ss_student t1');
        $this->db->join('ss_student_others t2', 't2.student_id=t1.student_id', 'left');
        $this->db->join('ss_class t3', 't3.class_id=t1.class_id', 'left');
        $this->db->join('ss_course t4', 't4.course_id=t1.course_id', 'left');
        $this->db->join('ss_teachers t5', 't5.teacher_id=t3.teacher_id', 'left');
        $this->db->join('ss_job t6', 't6.job_id=t2.job_id', 'left');
        $this->db->join('ss_code t7', 't7.code_no=t1.sex and t7.code='."02", 'left');
        $this->db->join('ss_code t8', 't8.code_no=t2.graduate and t8.code='."06", 'left');

        if (!empty($data['start_year'])) {
            $this->db->where('t1.start_year', $data['start_year']);
        }
        if (!empty($data['start_month'])) {
            $this->db->where('t1.start_month', $data['start_month']);
        }
        if (!empty($data['end_year'])) {
            $this->db->where('t1.end_year', $data['end_year']);
        }
        if (!empty($data['end_month'])) {
            $this->db->where('t1.end_month', $data['end_month']);
        }
        if (!empty($data['sex'])) {
            $this->db->where('t1.sex', $data['sex']);
        }
        if (!empty($data['age'])) {
            if ($data['age'] == "00") {
                $this->db->where('t1.age < ', '18');
            } else if ($data['age'] == "99") {
                $this->db->where('t1.age > ', '30');
            } else {
                $this->db->where('t1.age', $data['age']);
            }
        }
        if (!empty($data['graduate'])) {
            $this->db->where('t2.graduate', $data['graduate']);
        }
        if (!empty($data['scores_from'])) {
            $this->db->where('t1.scores >=', $data['scores_from']);
        }
        if (!empty($data['scores_to'])) {
            $this->db->where('t1.scores <=', $data['scores_to']);
        }
        if (!empty($data['follow_salary_from'])) {
            $this->db->where('t2.follow_salary >=', $data['follow_salary_from']);
        }
        if (!empty($data['follow_salary_to'])) {
            $this->db->where('t2.follow_salary <=', $data['follow_salary_to']);
        }
        if (!empty($data['txtKey'])) {
            $this->db->like('t1.student_name', $data['txtKey']);
            $this->db->or_like('t3.class_name', $data['txtKey']);
            $this->db->or_like('t4.course_name', $data['txtKey']);
            $this->db->or_like('t5.teacher_name', $data['txtKey']);
            $this->db->or_like('t2.ancestralhome', $data['txtKey']);
            $this->db->or_like('t2.graduate_school', $data['txtKey']);
            $this->db->or_like('t2.specialty', $data['txtKey']);
            $this->db->or_like('t6.job_city', $data['txtKey']);
            $this->db->or_like('t6.job_company', $data['txtKey']);
            $this->db->or_like('t2.follow_position', $data['txtKey']);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t1.student_id', 0);

        $query = $this->db->get();

        return $query->result_array();
    }
}