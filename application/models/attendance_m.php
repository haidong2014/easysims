<?php
class Attendance_m extends MY_Model
{
    public function __construct(){
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_attendance';
    }

    public function getAttendanceSumList($data){
        $this->db->select('t1.student_id as student_id,t1.student_no as student_no, ' .
            'max(t1.student_name) as student_name, max(t1.contact_way) as contact_way,' .
            'sum(case when am_status=1 then 1 else 0 end) + sum(case when pm_status=1 then 1 else 0 end) as status_1,' .
            'sum(case when am_status=2 then 1 else 0 end) + sum(case when pm_status=2 then 1 else 0 end) as status_2,' .
            'sum(case when am_status=3 then 1 else 0 end) + sum(case when pm_status=3 then 1 else 0 end) as status_3,' .
            'sum(case when am_status=4 then 1 else 0 end) + sum(case when pm_status=4 then 1 else 0 end) as status_4');
        $this->db->from('ss_student t1');
        $this->db->join('ss_attendance t2', "t1.class_id = t2.class_id and t1.student_id = t2.student_id" , 'left');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('t1.student_name like', '%'.$data['search_key'].'%');
        }
        if($data['start_date'] <> null && trim($data['start_date']) <> ""){
            $this->db->where('t2.today >=', $data['start_date']);
        }
        if($data['end_date'] <> null && trim($data['end_date']) <> ""){
            $this->db->where('t2.today <=', $data['end_date']);
        }
        $this->db->where('t1.class_id', $data['class_id']);
        if(!empty($data['student_id'])){
            $this->db->where('t1.student_id', $data['student_id']);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->group_by('t1.student_id');
        $this->db->order_by('t1.student_id','esc');
        $query = $this->db->get();
        log_message('info', "Attendance_m getAttendanceSumList SQL : ".$this->db->last_query());
        return $query->result_array();
    }

    public function getAttendanceList($data){
        $this->db->select('t1.student_id,t1.student_no,t1.student_name,t1.contact_way,t2.am_status,t2.pm_status');
        $this->db->from('ss_student t1');
        $this->db->join('ss_attendance t2', "t1.class_id = t2.class_id and t1.student_id = t2.student_id and " .
                        "t2.today = '".$data['today']."'" , 'left');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('t1.student_name like', '%'.$data['search_key'].'%');
        }
        $this->db->where('t1.class_id', $data['class_id']);
        $this->db->where('t1.end_date >=', $data['today']);
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t1.student_id','esc');
        $query = $this->db->get();
        log_message('info', "Attendance_m getAttendanceList SQL : ".$this->db->last_query());
        return $query->result_array();
    }

    public function getAttendanceForStudent($data){
        $this->db->select('t1.today,t2.code_name as am_status,t3.code_name as pm_status');
        $this->db->from('ss_attendance t1');
        $this->db->join('ss_code t2', 't2.code_no=t1.am_status and t2.code='."08", 'left');
        $this->db->join('ss_code t3', 't3.code_no=t1.pm_status and t3.code='."08", 'left');
        $this->db->where('t1.class_id', $data['class_id']);
        $this->db->where('t1.student_id', $data['student_id']);
        if (!empty($data['search_ymd_start']) && !empty($data['search_ymd_end'])) {
            $this->db->where('t1.today >=', $data['search_ymd_start']);
            $this->db->where('t1.today <=', $data['search_ymd_end']);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t1.today','esc');
        $query = $this->db->get();
        log_message('info', "Attendance_m getAttendanceForStudent SQL : ".$this->db->last_query());
        return $query->result_array();
    }

    public function insertAttendance($data){
        $this->db->set( 'class_id',      $data['class_id'] );
        $this->db->set( 'student_id',    $data['student_id'] );
        $this->db->set( 'today',         $data['today'] );
        $this->db->set( 'am_status',     $data['am_status'] );
        $this->db->set( 'pm_status',     $data['pm_status'] );
        $this->db->set( 'delete_flg',    "0" );
        $this->db->set( 'insert_user',   $data['insert_user'] );
        $this->db->set( 'insert_time',   $data['insert_time'] );
        $this->db->set( 'update_user',   $data['update_user'] );
        $this->db->set( 'update_time',   $data['update_time'] );
        $this->db->insert( $this->table_name );
    }

   public function deleteAttendance($data){
        $this->db->where('class_id',     $data['class_id'] );
        $this->db->where('today',        $data['today']);
        $this->db->delete( $this->table_name );
   }

    public function getAttendanceScores($class_id,$course_id,$subject_id,$student_id){
        $this->db->select('t1.class_id,t1.student_id,t2.course_id,t2.subject_id, ' .
            'sum(case when am_status=1 then 1 else 0 end) + sum(case when pm_status=1 then 1 else 0 end) as status_1,' .
            'sum(case when am_status=2 then 1 else 0 end) + sum(case when pm_status=2 then 1 else 0 end) as status_2,' .
            'sum(case when am_status=3 then 1 else 0 end) + sum(case when pm_status=3 then 1 else 0 end) as status_3,' .
            'sum(case when am_status=4 then 1 else 0 end) + sum(case when pm_status=4 then 1 else 0 end) as status_4');
        $this->db->from('ss_attendance t1');
        $this->db->join('ss_class_course t2', "t1.class_id = t2.class_id and (t1.today >= t2.start_date and t2.end_date >= t1.today)");
        $this->db->where('t1.class_id',   $class_id);
        $this->db->where('t1.student_id', $student_id);
        $this->db->where('t2.course_id',  $course_id);
        $this->db->where('t2.subject_id', $subject_id);
        $this->db->where('t1.delete_flg', 0);
        $this->db->where('t2.delete_flg', 0);
        $this->db->group_by('t1.class_id,t1.student_id,t2.course_id,t2.subject_id');
        $query = $this->db->get();
        $attendance= null;
        foreach ($query->result_array() as $row){
            $attendance = $row;
        }
        log_message('info', "Attendance_m getAttendanceScores SQL : ".$this->db->last_query());
        return $attendance;
    }
}