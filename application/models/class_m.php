<?php
class Class_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_class';
    }

    public function getList($data)
    {
        $this->db->select('t1.*,t2.teacher_name,t3.code_name,t4.course_name');
        $this->db->from('ss_class t1');
        $this->db->join('ss_teachers t2', 't1.teacher_no = t2.teacher_no', 'left');
        $this->db->join('ss_code t3', 't1.status = t3.code_no and t3.code = '."05", 'left');
        $this->db->join('ss_course t4', 't1.course_no = t4.course_no', 'left');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('t1.class_name like', '%'.$data['search_key'].'%');
        }
        if(!empty($data['search_year']) && !empty($data['search_month'])){
            $this->db->where('t1.start_year', $data['search_year']);
            $this->db->where('t1.start_month', $data['search_month']);
        }
        $this->db->where('t1.delete_flg', 0);
        $query =  $this->db->get();
        log_message('info', "class_m getList sql:".$this->db->last_query());
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