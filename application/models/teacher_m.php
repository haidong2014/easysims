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
        $query =  $this->db->get();
        return $query->result_array();
    }
    public function addOne($teacher_no,$teacher_name, $sex,$birthday, $property, $course,
          $telephone, $email, $system_user, $remarks){
      $this->db->set( 'teacher_no',		$teacher_no );
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
       log_message('info','teachter getone'.$teacher_id."|".var_export($query->result_array(),true));
       foreach ($query->result_array() as $row){
         $teacher = $row;
       }
       return $teacher;
    }

    public function updateOne($teacher_no,$teacher_name, $sex,$birthday, $property,
        $course, $telephone, $email, $system_user, $remarks,$teacher_id){
          log_message('info', "ddd".$teacher_name."|".$sex."|".$birthday."|".$property."|".
        $course."|".$telephone."|".$email."|".$system_user."|".$remarks."|".$teacher_id);
        $this->db->where('teacher_id', $teacher_id);
        $this->db->set( 'teacher_no',		$teacher_no );
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

    public function deleteOne($teacher_id){
          log_message('info', "del"."|".$teacher_id);
        $this->db->where('teacher_id', $teacher_id);
        $this->db->set( 'delete_flg',		1 );
        return $this->db->update( $this->table_name );
    }
}