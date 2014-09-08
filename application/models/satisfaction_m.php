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
}