<?php
class Course_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_course';
    }

    public function getList($keyword)
    {
        $this->db->select('course_id,course_name,remarks');
        if(!empty($keyword)){
            $this->db->like('course_name',$keyword);
        }
        $this->db->where('delete_flg', 0);
        $this->db->order_by('course_id','esc');
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function addOne($data){
        $this->db->set( 'course_name',	$data['course_name'] );
        $this->db->set( 'remarks',		$data['remarks'] );
        $this->db->set( 'delete_flg',	$data['delete_flg'] );
        $this->db->set( 'insert_user',	$data['insert_user'] );
        $this->db->set( 'insert_time',	$data['insert_time'] );
        $this->db->set( 'update_user',	$data['update_user'] );
        $this->db->set( 'update_time',	$data['update_time'] );

        return $this->db->insert( $this->table_name );
    }

    public function getOne($course_id){
        $this->db->select('course_id,course_name,remarks');
        $this->db->where('course_id', $course_id);
        $this->db->where('delete_flg', 0);
        $query = $this->db->get($this->table_name);
        $course = null;
        foreach ($query->result_array() as $row){
            $course = $row;
        }
        return $course;
    }

    public function updateOne($data){
        $this->db->where('course_id',    $data['course_id']);
        $this->db->set( 'course_name',	 $data['course_name']);
        $this->db->set( 'remarks',		 $data['remarks']);
        $this->db->set( 'update_user',	 $data['update_user'] );
        $this->db->set( 'update_time',	 $data['update_time'] );
        return $this->db->update( $this->table_name );
    }

    public function deleteOne($data){
        $this->db->where('course_id',   $data['course_id']);
        $this->db->set( 'delete_flg',   $data['delete_flg']);
        $this->db->set( 'update_user',	$data['update_user'] );
        $this->db->set( 'update_time',	$data['update_time'] );
        return $this->db->update( $this->table_name );
    }
}