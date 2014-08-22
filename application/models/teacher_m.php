<?php
class Teacher_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_teachers';
    }
    public function getList($keyword = null)
    {
        $this->db->select('t1.teacher_id,t1.teacher_no,t1.teacher_name,t1.sex,t1.birthday,t1.property,t1.course,' .
                          't1.telephone,t1.email,t1.system_user,t1.remarks,' .
                          't2.code_name as sex_name,t3.code_name as property_name');
        $this->db->from('ss_teachers t1');
        $this->db->join('ss_code t2', 't2.code_no=t1.sex and t2.code='."02", 'left');
        $this->db->join('ss_code t3', 't3.code_no=t1.property and t3.code='."03", 'left');
        if(!empty($keyword)){
            $this->db->like('t1.teacher_name',$keyword);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t1.teacher_id','esc');
        $query =  $this->db->get();
        return $query->result_array();
    }
    public function addOne($data){
      $this->db->set( 'teacher_no',		$data['teacher_no'] );
      $this->db->set( 'teacher_name',	$data['teacher_name'] );
      $this->db->set( 'sex',	        $data['sex'] );
      $this->db->set( 'birthday',		$data['birthday'] );
      $this->db->set( 'property',		$data['property'] );
      $this->db->set( 'course',		    $data['course'] );
      $this->db->set( 'telephone',		$data['telephone'] );
      $this->db->set( 'email',		    $data['email'] );
      $this->db->set( 'system_user',    $data['system_user'] );
      $this->db->set( 'remarks',		$data['remarks'] );
      $this->db->set( 'delete_flg',		$data['delete_flg'] );
      $this->db->set( 'insert_user',	$data['insert_user'] );
      $this->db->set( 'insert_time',	$data['insert_time'] );
      $this->db->set( 'update_user',	$data['update_user'] );
      $this->db->set( 'update_time',	$data['update_time'] );

      return $this->db->insert( $this->table_name );
    }

    public function checkTeacher($teacher_no){
        $this->db->select('teacher_id,teacher_no');
        $this->db->where('teacher_no', $teacher_no);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
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
  public function getOneByNo($teacher_no){
       $this->db->where('teacher_no', $teacher_no);
       $this->db->where('delete_flg', 0);
       $this->db->select('*');
       $query = $this->db->get($this->table_name);
       $teacher= null;
       log_message('info','teachter getOneByNo'.$teacher_no."|".var_export($query->result_array(),true));
       foreach ($query->result_array() as $row){
         $teacher = $row;
       }
       return $teacher;
    }
    public function updateOne($data){

        $this->db->where('teacher_id', $data['teacher_id']);

        $this->db->set( 'teacher_name',	$data['teacher_name'] );
        $this->db->set( 'sex',	        $data['sex'] );
        $this->db->set( 'birthday',		$data['birthday'] );
        $this->db->set( 'property',		$data['property'] );
        $this->db->set( 'course',		$data['course'] );
        $this->db->set( 'telephone',	$data['telephone'] );
        $this->db->set( 'email',		$data['email'] );
        $this->db->set( 'system_user',  $data['system_user'] );
        $this->db->set( 'remarks',		$data['remarks'] );
        $this->db->set( 'update_user',	$data['update_user'] );
        $this->db->set( 'update_time',	$data['update_time'] );

        return $this->db->update($this->table_name);
    }

    public function deleteOne($data){
        $this->db->where('teacher_id',  $data['teacher_id']);
        $this->db->set( 'delete_flg',   $data['delete_flg']);
        $this->db->set( 'update_user',	$data['update_user'] );
        $this->db->set( 'update_time',	$data['update_time'] );
        return $this->db->update($this->table_name);
    }

    public function getMaxId(){
        $this->db->select('Max(teacher_id) as max_id');
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }
}