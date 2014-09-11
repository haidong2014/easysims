<?php
class Works_m extends MY_Model
{
    public function __construct(){
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_works';
    }

    public function getWorksInfo($class_id,$course_id,$subject_id){
        $this->db->select('count(*) as numbers,sum(works_scores) as scores');
        $this->db->where('class_id',   $class_id);
        $this->db->where('course_id',  $course_id);
        $this->db->where('subject_id', $subject_id);
        $this->db->where('delete_flg', '0');
        $this->db->group_by('class_id,course_id,subject_id');
        $query = $this->db->get( $this->table_name );
        $works = null;
        foreach ($query->result_array() as $row){
            $works = $row;
        }
        return $works;
    }
	public function getList($keyword = null, $class_id, $course_id, $subject_id)
    {

       
        //$this->db->select('*');
        $this->db->where( 'class_id', $class_id );
        $this->db->where( 'course_id', $course_id );
        $this->db->where( 'subject_id', $subject_id );
        if(!empty($keyword)){
            $this->db->like('works_name',$keyword);
        }
        $this->db->where('delete_flg', 0);
        $this->db->order_by('works_no','desc');
        $query =  $this->db->get($this->table_name);
        log_message('info', "Works_m getList sql:".$this->db->last_query());
        return $query->result_array();
    }

    public function insert($data){
        $this->db->set( 'class_id',          $data['class_id'] );
        $this->db->set( 'course_id',         $data['course_id'] );
        $this->db->set( 'subject_id',        $data['subject_id'] );
        $this->db->set( 'student_id',        $data['student_id'] );
        $this->db->set( 'works_no',          $data['works_no'] );
        $this->db->set( 'works_name',        $data['works_name'] );
        $this->db->set( 'works_path',        $data['works_path'] );
        $this->db->set( 'works_description', $data['works_description'] );
        $this->db->set( 'remarks',           $data['remarks'] );
        $this->db->set( 'delete_flg',        $data['delete_flg'] );
        $this->db->set( 'insert_user',       $data['insert_user'] );
        $this->db->set( 'insert_time',       $data['insert_time'] );
        $this->db->set( 'update_user',       $data['update_user'] );
        $this->db->set( 'update_time',       $data['update_time'] );
        $this->db->insert( $this->table_name );
    }

    public function update($data){
        $this->db->where('class_id',      $data['class_id']);
        $this->db->where('course_id',     $data['course_id']);
        $this->db->where('subject_id',    $data['subject_id']);
        $this->db->where('student_id',    $data['student_id']);
        $this->db->where('works_no',      $data['works_no']);
        $this->db->set( 'works_scores',   $data['works_scores'] );
        $this->db->set( 'works_comment',  $data['works_comment'] );
        $this->db->set( 'update_user',    $data['update_user'] );
        $this->db->set( 'update_time',    $data['update_time'] );
        return $this->db->update( $this->table_name );
    }
}