<?php
class Attendance_m extends MY_Model
{

    public function __construct(){
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_attendance';
    }

    public function getAttendanceSumList($data){
        $this->db->select('t1.student_no as student_no, max(t1.student_name) as student_name, max(t1.contact_way) as contact_way,' .
            'sum(case when am_status=1 then 1 else 0 end) + sum(case when pm_status=1 then 1 else 0 end) as status_1,' .
            'sum(case when am_status=2 then 1 else 0 end) + sum(case when pm_status=2 then 1 else 0 end) as status_2,' .
            'sum(case when am_status=3 then 1 else 0 end) + sum(case when pm_status=3 then 1 else 0 end) as status_3,' .
            'sum(case when am_status=4 then 1 else 0 end) + sum(case when pm_status=4 then 1 else 0 end) as status_4');
        $this->db->from('ss_student t1');
        $this->db->join('ss_attendance t2', "t1.class_no = t2.class_no and t1.student_no = t2.student_no" , 'left');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('t1.student_name like', '%'.$data['search_key'].'%');
        }
        $this->db->where('t1.class_no', $data['class_no']);
        $this->db->where('t1.delete_flg', 0);
        $this->db->group_by('t1.student_no');
        $this->db->order_by('t1.student_no','esc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAttendanceList($data){
        $this->db->select('t1.student_no,t1.student_name,t1.contact_way,t2.am_status,t2.pm_status');
        $this->db->from('ss_student t1');
        $this->db->join('ss_attendance t2', "t1.class_no = t2.class_no and t1.student_no = t2.student_no and t2.today = '".$data['today']."'" , 'left');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('t1.student_name like', '%'.$data['search_key'].'%');
        }
        $this->db->where('t1.class_no', $data['class_no']);
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t1.student_no','esc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAttendanceForStudent($data){
        $this->db->select('t1.today,t2.code_name as am_status,t3.code_name as pm_status');
        $this->db->from('ss_attendance t1');
        $this->db->join('ss_code t2', 't2.code_no=t1.am_status and t2.code='."08", 'left');
        $this->db->join('ss_code t3', 't3.code_no=t1.pm_status and t3.code='."08", 'left');
        $this->db->where('t1.class_no', $data['class_no']);
        $this->db->where('t1.student_no', $data['student_no']);
        if (!empty($data['search_ymd_start']) && !empty($data['search_ymd_end'])) {
            $this->db->where('t1.today >=', $data['search_ymd_start']);
            $this->db->where('t1.today <=', $data['search_ymd_end']);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t1.today','esc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertAttendance($data){
        $this->db->set( 'class_no',      $data['class_no'] );
        $this->db->set( 'student_no',    $data['student_no'] );
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
        $this->db->where('class_no',     $data['class_no'] );
        $this->db->where('today',        $data['today']);
        $this->db->delete( $this->table_name );
   }
}