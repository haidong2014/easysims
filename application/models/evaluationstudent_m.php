<?php
class EvaluationStudent_m extends MY_Model
{
    public function __construct(){
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_student_evaluation';
    }

    public function select($data){
        $this->db->select('*');
        $this->db->where('class_id',   $data['class_id']);
        $this->db->where('course_id',  $data['course_id']);
        $this->db->where('subject_id', $data['subject_id']);
        $this->db->where('student_id', $data['student_id']);
        $this->db->where('delete_flg', 0);
        $query = $this->db->get($this->table_name);
        $evaluationData = null;
        foreach ($query->result_array() as $row){
            $evaluationData = $row;
        }
        return $evaluationData;
    }

    public function insertorupdate($data){

        $evaluationData = self::select($data);

        if (empty($evaluationData)) {
            $this->db->set( 'class_id',          $data['class_id'] );
            $this->db->set( 'course_id',         $data['course_id'] );
            $this->db->set( 'subject_id',        $data['subject_id'] );
            $this->db->set( 'student_id',        $data['student_id'] );
            $this->db->set( 'attendance_scores', $data['attendance_scores'] );
            $this->db->set( 'works_scores',      $data['works_scores'] );
            $this->db->set( 'performance_scores',$data['performance_scores'] );
            $this->db->set( 'homework_scores',   $data['homework_scores'] );
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
            $this->db->where('subject_id',       $data['subject_id']);
            $this->db->where('student_id',       $data['student_id']);
            $this->db->set( 'attendance_scores', $data['attendance_scores'] );
            $this->db->set( 'works_scores',      $data['works_scores'] );
            $this->db->set( 'performance_scores',$data['performance_scores'] );
            $this->db->set( 'homework_scores',   $data['homework_scores'] );
            $this->db->set( 'remarks',           $data['remarks'] );
            $this->db->set( 'update_user',       $data['update_user'] );
            $this->db->set( 'update_time',       $data['update_time'] );
            return $this->db->update( $this->table_name );
        }
    }

    public function selectStudentEV($data){
        $this->db->select('t2.class_name,t3.course_name,t4.subject_name,t1.student_id,t1.student_name,' .
                          't5.attendance_scores,t5.works_scores,t5.performance_scores,t5.homework_scores,t5.remarks');
        $this->db->from('ss_student t1');
        $this->db->join('ss_class t2', 't2.class_id=t1.class_id', 'left');
        $this->db->join('ss_course t3', 't3.course_id=t2.course_id', 'left');
        $this->db->join('ss_subject t4', 't4.course_id=t3.course_id and t4.subject_id='.$data['subject_id'], 'left');
        $this->db->join('ss_student_evaluation t5', 't5.student_id=t1.student_id and t5.class_id='.$data['class_id'].' ' .
                        'and t5.course_id='.$data['course_id'].' and t5.subject_id='.$data['subject_id'], 'left');
        $this->db->where('t2.class_id',   $data['class_id']);
        $this->db->where('t3.course_id',  $data['course_id']);
        if (!empty($data['student_id'])) {
            $this->db->where('t1.student_id', $data['student_id']);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t1.student_id', 0);
        $query = $this->db->get();
        log_message('info', "EvaluationStudent_m selectStudentEV SQL : ".$this->db->last_query());
        return $query->result_array();
    }

     public function selectEV($class_name,$student_name,$student_id){
        $this->db->select('t2.class_name,t3.course_name,t4.subject_name,t1.student_id,t1.student_name,' .
                          't5.attendance_scores,t5.works_scores,t5.performance_scores,t5.homework_scores');
        $this->db->from('ss_student t1');
        $this->db->join('ss_class t2', 't2.class_id=t1.class_id', 'left');
        $this->db->join('ss_course t3', 't3.course_id=t2.course_id', 'left');
        $this->db->join('ss_subject t4', 't4.course_id=t3.course_id', 'left');
        $this->db->join('ss_student_evaluation t5', 't5.student_id=t1.student_id and t5.class_id=t2.class_id' .
                        ' and t5.course_id=t3.course_id and t5.subject_id=t4.subject_id', 'left');
        if (!empty($class_name)) {
            $this->db->like('t2.class_name', $class_name);
        }
        if (!empty($student_name)) {
            $this->db->like('t1.student_name', $student_name);
        }
        if (!empty($student_id)) {
            $this->db->like('t1.student_id', $student_id);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t2.class_id,t3.course_id,t4.subject_id,t1.student_id', 0);
        $query = $this->db->get();
        log_message('info', "EvaluationStudent_m selectEV SQL : ".$this->db->last_query());
        return $query->result_array();
    }

    public function selectForS($data){
        $this->db->select('*');
        $this->db->where('class_id',   $data['class_id']);
        $this->db->where('course_id',  $data['course_id']);
        $this->db->where('student_id', $data['student_id']);
        $this->db->where('delete_flg', 0);
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }

}