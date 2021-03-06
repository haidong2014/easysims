<?php
class User_m extends MY_Model
{

    public function __construct(){
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_users';
    }

    public function getList($data){
        $this->db->select('t1.user_id,t1.user,t1.password,t1.user_name,t1.delete_flg,t2.role_name');
        $this->db->from('ss_users t1');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('t1.user_name like', '%'.$data['search_key'].'%');
        }
        if($data['status'] <> null && trim($data['status']) <> ""){
            $this->db->where('t1.delete_flg', $data['status']);
        }
        if($data['role'] <> null && trim($data['role']) <> ""){
            $this->db->where('t1.role_id', $data['role']);
        }
        $this->db->join('ss_roles t2', 't1.role_id = t2.role_id');
        $this->db->order_by('t1.user_id','esc');
        $query =  $this->db->get();
        log_message('info', "User_m getList SQL : ".$this->db->last_query());
        return $query->result_array();
    }

    public function addOne($data){
        $this->db->set( 'user',          $data['user'] );
        $this->db->set( 'user_name',     $data['user_name'] );
        $this->db->set( 'role_id',       $data['role_id'] );
        $this->db->set( 'remarks',       $data['remarks'] );
        $this->db->set( 'delete_flg',    $data['delete_flg'] );
        $this->db->set( 'insert_user',   $data['insert_user'] );
        $this->db->set( 'insert_time',   $data['insert_time'] );
        $this->db->set( 'update_user',   $data['update_user'] );
        $this->db->set( 'update_time',   $data['update_time'] );
        return $this->db->insert( $this->table_name );
    }

    public function updOne($data){
        $this->db->where('user_id',      $data['user_id']);
        $this->db->set( 'user',          $data['user'] );
        $this->db->set( 'user_name',     $data['user_name'] );
        $this->db->set( 'role_id',       $data['role_id'] );
        $this->db->set( 'remarks',       $data['remarks'] );
        $this->db->set( 'delete_flg',    $data['delete_flg'] );
        $this->db->set( 'update_user',   $data['update_user'] );
        $this->db->set( 'update_time',   $data['update_time'] );
        return $this->db->update( $this->table_name );
    }

    public function getOne($user_id){
        $this->db->select('user_id,user,user_name,role_id,remarks,delete_flg');
        $this->db->where('user_id', $user_id);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function checkUser($user){
        $this->db->select('user_id,user');
        $this->db->where('user', $user);
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function reSetPwd($data){
        $this->db->where('user_id',      $data['user_id']);
        $this->db->set( 'password',      $data['password'] );
        $this->db->set( 'update_user',   $data['update_user'] );
        $this->db->set( 'update_time',   $data['update_time'] );
        return $this->db->update( $this->table_name );
    }
}