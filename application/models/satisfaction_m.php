<?php
class Satisfaction_m extends MY_Model
{
    public function __construct(){
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_teacher_satisfaction';
    }

    public function select($data){
        $this->db->select('*');
        $this->db->where('class_id',   $data['class_id']);
        $this->db->where('course_id',  $data['course_id']);
        $this->db->where('subject_id', $data['subject_id']);
        $this->db->where('teacher_id', $data['teacher_id']);
        $this->db->where('student_id', $data['student_id']);
        $this->db->where('delete_flg', 0);
        $query = $this->db->get($this->table_name);
        $satisfactionData = null;
        foreach ($query->result_array() as $row){
            $satisfactionData = $row;
        }
        return $satisfactionData;
    }

    public function insertorupdate($data){

        $satisfactionData = self::select($data);

        if (empty($satisfactionData)) {
            $this->db->set( 'class_id',          $data['class_id'] );
            $this->db->set( 'course_id',         $data['course_id'] );
            $this->db->set( 'subject_id',        $data['subject_id'] );
            $this->db->set( 'teacher_id',        $data['teacher_id'] );
            $this->db->set( 'student_id',        $data['student_id'] );
            $this->db->set( 'scores_01',         $data['scores_01'] );
            $this->db->set( 'scores_02',         $data['scores_02'] );
            $this->db->set( 'scores_03',         $data['scores_03'] );
            $this->db->set( 'scores_04',         $data['scores_04'] );
            $this->db->set( 'scores_05',         $data['scores_05'] );
            $this->db->set( 'scores_06',         $data['scores_06'] );
            $this->db->set( 'scores_07',         $data['scores_07'] );
            $this->db->set( 'scores_08',         $data['scores_08'] );
            $this->db->set( 'scores_09',         $data['scores_09'] );
            $this->db->set( 'scores_10',         $data['scores_10'] );
            $this->db->set( 'scores_11',         $data['scores_11'] );
            $this->db->set( 'scores_12',         $data['scores_12'] );
            $this->db->set( 'scores_13',         $data['scores_13'] );
            $this->db->set( 'scores_14',         $data['scores_14'] );
            $this->db->set( 'scores_15',         $data['scores_15'] );
            $this->db->set( 'scores_16',         $data['scores_16'] );
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
            $this->db->where('student_id',       $data['student_id']);
            $this->db->set( 'scores_01',         $data['scores_01'] );
            $this->db->set( 'scores_02',         $data['scores_02'] );
            $this->db->set( 'scores_03',         $data['scores_03'] );
            $this->db->set( 'scores_04',         $data['scores_04'] );
            $this->db->set( 'scores_05',         $data['scores_05'] );
            $this->db->set( 'scores_06',         $data['scores_06'] );
            $this->db->set( 'scores_07',         $data['scores_07'] );
            $this->db->set( 'scores_08',         $data['scores_08'] );
            $this->db->set( 'scores_09',         $data['scores_09'] );
            $this->db->set( 'scores_10',         $data['scores_10'] );
            $this->db->set( 'scores_11',         $data['scores_11'] );
            $this->db->set( 'scores_12',         $data['scores_12'] );
            $this->db->set( 'scores_13',         $data['scores_13'] );
            $this->db->set( 'scores_14',         $data['scores_14'] );
            $this->db->set( 'scores_15',         $data['scores_15'] );
            $this->db->set( 'scores_16',         $data['scores_16'] );
            $this->db->set( 'remarks',           $data['remarks'] );
            $this->db->set( 'update_user',       $data['update_user'] );
            $this->db->set( 'update_time',       $data['update_time'] );
            return $this->db->update( $this->table_name );
        }
    }

    public function selectTeacherEV($data){
        $this->db->select('t1.student_id,t2.class_name,t3.course_name,t4.subject_name,t5.teacher_name,t6.student_name,' .
                          '(t1.scores_01+t1.scores_02+t1.scores_03+t1.scores_04+t1.scores_05+t1.scores_06+t1.scores_07+' .
                          't1.scores_08+t1.scores_09+t1.scores_10+t1.scores_11+t1.scores_12+t1.scores_13+t1.scores_14+' .
                          't1.scores_15+t1.scores_16) as scores');
        $this->db->from('ss_teacher_satisfaction t1');
        $this->db->join('ss_class t2', 't2.class_id=t1.class_id', 'left');
        $this->db->join('ss_course t3', 't3.course_id=t1.course_id', 'left');
        $this->db->join('ss_subject t4', 't4.course_id=t1.course_id and t4.subject_id=t1.subject_id', 'left');
        $this->db->join('ss_teachers t5', 't5.teacher_id=t1.teacher_id', 'left');
        $this->db->join('ss_student t6', 't6.student_id=t1.student_id', 'left');
        $this->db->where('t1.class_id',   $data['class_id']);
        $this->db->where('t1.course_id',  $data['course_id']);
        $this->db->where('t1.subject_id', $data['subject_id']);
        $this->db->where('t1.teacher_id', $data['teacher_id']);
        $this->db->where('t1.delete_flg', 0);
        $query = $this->db->get();
        log_message('info', "Satisfaction_m selectTeacherEV SQL : ".$this->db->last_query());
        return $query->result_array();
    }

    public function getTeacherEV($data){
        $this->db->select('round((sum(scores_01+scores_02+scores_03+scores_04+scores_05+scores_06+scores_07+' .
                          'scores_08+scores_09+scores_10+scores_11+scores_12+scores_13+scores_14+' .
                          'scores_15+scores_16)/count(student_id))*1.25) as scores');
        $this->db->where('class_id',   $data['class_id']);
        $this->db->where('course_id',  $data['course_id']);
        $this->db->where('subject_id', $data['subject_id']);
        $this->db->where('teacher_id', $data['teacher_id']);
        $this->db->where('delete_flg', 0);
        $this->db->group_by('class_id,course_id,subject_id,teacher_id');
        $query = $this->db->get($this->table_name);
        $teacherEvData = null;
        foreach ($query->result_array() as $row){
            $teacherEvData = $row;
        }
        return $teacherEvData;
    }
}