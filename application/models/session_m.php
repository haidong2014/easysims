<?php
class Session_m extends MY_Model
{
    public function __construct(){
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_session';
    }

    // 10000101 : 招生信息录入 班级一览
    // 10010101 : 学生出勤管理 班级一览
    // 10010201 : 学生作品管理 班级一览
    // 10010301 : 课程评价管理 班级一览
    // 10020101 : 就业信息录入 班级一览
    // 10030101 : 高级查询
    // 10030201 : 作品展示
    // 10030301 : 学生评价查询
    // 10030401 : 教师评价查询
    // 10040101 : 课程信息维护
    // 10040201 : 班级信息维护
    // 10040301 : 教师信息维护
    // 10040401 : 学生信息维护
    // 10040501 : 就业信息维护
    // 10050101 : 系统角色设定
    // 10050201 : 系统用户设定
    // 10050301 : 系统权限设定
    // 10060101 : 校长留言
    public function select($data){
        $this->db->select('session_01,session_02,session_03');
        $this->db->where('user_id',    $data['user_id']);
        $this->db->where('url_sub_id', $data['url_sub_id']);
        $this->db->where('delete_flg', 0);
        $query = $this->db->get($this->table_name);
        $sessionData = null;
        foreach ($query->result_array() as $row){
            $sessionData = $row;
        }
        return $sessionData;
    }

    public function insertorupdate($data){

        $sessionData = self::select($data);

        if (empty($sessionData)) {
            $this->db->set( 'user_id',           $data['user_id'] );
            $this->db->set( 'url_sub_id',        $data['url_sub_id'] );
            $this->db->set( 'session_01',        $data['session_01'] );
            $this->db->set( 'session_02',        $data['session_02'] );
            $this->db->set( 'session_03',        $data['session_03'] );
            $this->db->set( 'insert_user',       $data['insert_user'] );
            $this->db->set( 'insert_time',       $data['insert_time'] );
            $this->db->set( 'update_user',       $data['update_user'] );
            $this->db->set( 'update_time',       $data['update_time'] );
            $this->db->insert( $this->table_name );
        } else {
            $this->db->where('user_id',          $data['user_id']);
            $this->db->where('url_sub_id',       $data['url_sub_id']);
            $this->db->set( 'session_01',        $data['session_01'] );
            $this->db->set( 'session_02',        $data['session_02'] );
            $this->db->set( 'session_03',        $data['session_03'] );
            $this->db->set( 'update_user',       $data['update_user'] );
            $this->db->set( 'update_time',       $data['update_time'] );
            $this->db->update( $this->table_name );
        }
    }
}