<?php
class Attendance_m extends MY_Model
{

    public function __construct(){
        parent::__construct();
        $this->CI->load->database();

    }

    public function getAttendanceList($data)
    {
        $this->db->select('t1.*');
        $this->db->from('ss_student t1');
        //$this->db->join('ss_attendance t2', 't1.student_no = t2.student_no and t2.class_no = '.$data['class_no'], 'left');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('t1.student_name like', '%'.$data['search_key'].'%');
        }
        $this->db->where('t1.class_no', $data['class_no']);
        $this->db->where('t1.delete_flg', 0);
        $query =  $this->db->get();
        log_message('info', "attendance_m getAttendanceList sql:".$this->db->last_query());
        return $query->result_array();
    }

}