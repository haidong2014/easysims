<?php
class EvaluationTeacher_m extends MY_Model
{
    public function __construct(){
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_teacher_evaluation';
    }

    public function select($data){
        $this->db->select('*');
        $this->db->where('class_id',   $data['class_id']);
        $this->db->where('course_id',  $data['course_id']);
        $this->db->where('subject_id', $data['subject_id']);
        $this->db->where('teacher_id', $data['teacher_id']);
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
            $this->db->set( 'teacher_id',        $data['teacher_id'] );
            $this->db->set( 'attendance_scores', $data['attendance_scores'] );
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
            $this->db->where('teacher_id',       $data['teacher_id']);
            $this->db->set( 'attendance_scores', $data['attendance_scores'] );
            $this->db->set( 'remarks',           $data['remarks'] );
            $this->db->set( 'update_user',       $data['update_user'] );
            $this->db->set( 'update_time',       $data['update_time'] );
            return $this->db->update( $this->table_name );
        }
    }
}