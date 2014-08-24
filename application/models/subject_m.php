<?php
class Subject_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_subject';
    }

    public function getList($course_id, $keyword)
    {
        $this->db->select('course_id,subject_id,subject_name,period,remarks');
        $this->db->where( 'course_id', $course_id );
        if(!empty($keyword)){
            $this->db->like('subject_name',$keyword);
        }
        $this->db->where('delete_flg', 0);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function addOne($data){
        $this->db->set( 'course_id',	$data['course_id'] );
        $this->db->set( 'subject_id',	$data['subject_id'] );
        $this->db->set( 'subject_name',	$data['subject_name'] );
        $this->db->set( 'period',	    $data['period'] );
        $this->db->set( 'remarks',		$data['remarks'] );
        $this->db->set( 'delete_flg',	$data['delete_flg'] );
        $this->db->set( 'insert_user',	$data['insert_user'] );
        $this->db->set( 'insert_time',	$data['insert_time'] );
        $this->db->set( 'update_user',	$data['update_user'] );
        $this->db->set( 'update_time',	$data['update_time'] );

        return $this->db->insert( $this->table_name );
    }

    public function getOne($course_id,$subject_id){
        $this->db->select('course_id,subject_id,subject_name,period,remarks');
        $this->db->where('course_id', $course_id);
        $this->db->where('subject_id', $subject_id);
        $this->db->where('delete_flg', 0);
        $query = $this->db->get($this->table_name);
        foreach ($query->result_array() as $row){
            $subject = $row;
        }
        return $subject;
    }

    public function updateOne($data){
        $this->db->where('course_id',    $data['course_id']);
        $this->db->where('subject_id',   $data['subject_id']);
        $this->db->set( 'subject_name',	 $data['subject_name']);
        $this->db->set( 'period',	     $data['period']);
        $this->db->set( 'remarks',		 $data['remarks']);
        $this->db->set( 'update_user',	 $data['update_user'] );
        $this->db->set( 'update_time',	 $data['update_time'] );
        return $this->db->update( $this->table_name );
    }

    public function deleteOne($data){
        $this->db->where('course_id',    $data['course_id']);
        $this->db->where('subject_id',   $data['subject_id']);
        $this->db->set( 'delete_flg',    $data['delete_flg']);
        $this->db->set( 'update_user',   $data['update_user'] );
        $this->db->set( 'update_time',	 $data['update_time'] );
        return $this->db->update( $this->table_name );
    }

    public function getMaxId($course_id){
        $this->db->select('Max(subject_id) as max_id');
        $this->db->where('course_id',$course_id);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }
}