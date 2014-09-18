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

    public function selectEV($class_name,$teacher_name){
        $this->db->select('max(t2.class_name) as class_name,max(t3.course_name) as course_name,' .
                          'max(t4.subject_name) as subject_name,max(t5.teacher_name) as teacher_name,max(t1.teacher_id) as teacher_id,' .
                          'round(sum(t1.scores_01+t1.scores_02+t1.scores_03+t1.scores_04+t1.scores_05+t1.scores_06+t1.scores_07+' .
                          't1.scores_08+t1.scores_09+t1.scores_10+t1.scores_11+t1.scores_12+t1.scores_13+t1.scores_14+' .
                          't1.scores_15+t1.scores_16)/count(student_id)) as scores, t6.attendance_scores');
        $this->db->from('ss_teacher_satisfaction t1');
        $this->db->join('ss_class t2', 't2.class_id=t1.class_id', 'left');
        $this->db->join('ss_course t3', 't3.course_id=t1.course_id', 'left');
        $this->db->join('ss_subject t4', 't4.course_id=t1.course_id and t4.subject_id=t1.subject_id', 'left');
        $this->db->join('ss_teachers t5', 't5.teacher_id=t1.teacher_id', 'left');
        $this->db->join('ss_teacher_evaluation t6', 't6.class_id=t1.class_id and t6.course_id=t1.course_id and ' .
                        't6.subject_id=t1.subject_id and t6.teacher_id=t1.teacher_id', 'left');
        if (!empty($class_name)) {
            $this->db->like('t2.class_name', $class_name);
        }
        if (!empty($teacher_name)) {
            $this->db->like('t5.teacher_name', $teacher_name);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->group_by('t1.class_id,t1.course_id,t1.subject_id,t1.teacher_id');
        $this->db->order_by('t1.class_id,t1.course_id,t4.subject_id,t1.teacher_id', 0);
        $query = $this->db->get();

        return $query->result_array();
    }
}