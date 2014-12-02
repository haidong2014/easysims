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

    public function getOne($class_id,$course_id,$subject_id,$works_no){
        $this->db->where('class_id',   $class_id);
        $this->db->where('course_id',  $course_id);
        $this->db->where('subject_id', $subject_id);
        $this->db->where('works_no', $works_no);
        $this->db->where('delete_flg', 0);
        $this->db->select('*');
        $query = $this->db->get($this->table_name);
        $works= null;
        foreach ($query->result_array() as $row){
            $works = $row;
        }
        return $works;
    }

    public function getList($keyword = null, $class_id, $course_id, $subject_id)
    {
        $this->db->where( 'class_id', $class_id );
        $this->db->where( 'course_id', $course_id );
        $this->db->where( 'subject_id', $subject_id );
        if(!empty($keyword)){
            $this->db->like('works_name',$keyword);
        }
        $this->db->where('delete_flg', 0);
        $this->db->order_by('works_no','asc');
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function insertorupdate($data){

        $worksData = self::getOne($data['class_id'],$data['course_id'],$data['subject_id'],$data['works_no']);

        if (empty($worksData)) {
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
        } else {
            $this->db->where('class_id',         $data['class_id']);
            $this->db->where('course_id',        $data['course_id']);
            $this->db->where('student_id',       $data['student_id']);
            $this->db->where('subject_id',       $data['subject_id']);
            $this->db->where('works_no',         $data['works_no']);
            $this->db->set( 'works_name',        $data['works_name'] );
            $this->db->set( 'works_path',        $data['works_path'] );
            $this->db->set( 'works_description', $data['works_description'] );
            $this->db->set( 'works_scores',      0 );
            $this->db->set( 'works_comment',     '' );
            $this->db->set( 'remarks',           $data['remarks'] );
            $this->db->set( 'update_user',       $data['update_user'] );
            $this->db->set( 'update_time',       $data['update_time'] );
            $this->db->update( $this->table_name );
        }
    }

    public function update($data){
        $this->db->where('class_id',      $data['class_id']);
        $this->db->where('course_id',     $data['course_id']);
        $this->db->where('subject_id',    $data['subject_id']);
        $this->db->where('works_no',      $data['works_no']);
        $this->db->set( 'works_scores',   $data['works_scores'] );
        $this->db->set( 'works_comment',  $data['works_comment'] );
        $this->db->set( 'update_user',    $data['update_user'] );
        $this->db->set( 'update_time',    $data['update_time'] );
        $ret= $this->db->update( $this->table_name );
        return $ret;
    }

    public function search($data){
        $this->db->select('t1.class_id,t1.course_id,t1.subject_id,t1.student_id,t1.works_no,t1.works_name,' .
                          't1.works_path,t1.works_description,t1.works_scores,t1.works_comment,t1.remarks,' .
                          't2.student_name,t3.class_name,t4.course_name,t5.subject_name');
        $this->db->from('ss_works t1');
        $this->db->join('ss_student t2', 't2.student_id=t1.student_id', 'left');
        $this->db->join('ss_class t3', 't3.class_id=t1.class_id', 'left');
        $this->db->join('ss_course t4', 't4.course_id=t1.course_id', 'left');
        $this->db->join('ss_subject t5', 't5.course_id=t1.course_id and t5.subject_id=t1.subject_id', 'left');
        if (!empty($data['start_year'])) {
            $this->db->where('t2.start_year', $data['start_year']);
        }
        if (!empty($data['start_month'])) {
            $this->db->where('t2.start_month', $data['start_month']);
        }
        if (!empty($data['scores_from'])) {
            $this->db->where('t1.works_scores >=', $data['scores_from']);
        }
        if (!empty($data['scores_to'])) {
            $this->db->where('t1.works_scores <=', $data['scores_to']);
        }
        if (!empty($data['class_name'])) {
            $this->db->like('t3.class_name', $data['class_name']);
        }
        if (!empty($data['student_name'])) {
            $this->db->like('t2.student_name', $data['student_name']);
        }
        $this->db->order_by('t1.class_id,t1.course_id,t1.subject_id,t1.student_id,t1.works_no', 0);
        $this->db->limit(8,($data['paging']-1)*8);
        $query = $this->db->get();
        log_message('info', "Works_m search SQL : ".$this->db->last_query());
        return $query->result_array();
    }

    public function getPagingMax($data){
        $this->db->select('count(t1.student_id) as paging_max');
        $this->db->from('ss_works t1');
        $this->db->join('ss_student t2', 't2.student_id=t1.student_id', 'left');
        $this->db->join('ss_class t3', 't3.class_id=t1.class_id', 'left');
        if (!empty($data['start_year'])) {
            $this->db->where('t2.start_year', $data['start_year']);
        }
        if (!empty($data['start_month'])) {
            $this->db->where('t2.start_month', $data['start_month']);
        }
        if (!empty($data['scores_from'])) {
            $this->db->where('t1.works_scores >=', $data['scores_from']);
        }
        if (!empty($data['scores_to'])) {
            $this->db->where('t1.works_scores <=', $data['scores_to']);
        }
        if (!empty($data['class_name'])) {
            $this->db->like('t3.class_name', $data['class_name']);
        }
        if (!empty($data['student_name'])) {
            $this->db->like('t2.student_name', $data['student_name']);
        }
        $this->db->limit(160);
        $query = $this->db->get();
        $paging_max= null;
        foreach ($query->result_array() as $row){
            $paging_max = $row['paging_max'];
        }
        return $paging_max;
    }

    public function getWorksScores($class_id,$course_id,$subject_id,$student_id){
        $this->db->where('class_id',   $class_id);
        $this->db->where('course_id',  $course_id);
        $this->db->where('subject_id', $subject_id);
        $this->db->where('student_id', $student_id);
        $this->db->where('delete_flg', 0);
        $this->db->select('*');
        $query = $this->db->get($this->table_name);
        $works= null;
        foreach ($query->result_array() as $row){
            $works = $row;
        }
        return $works;
    }
}