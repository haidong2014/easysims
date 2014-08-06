<?php
class Usergroups_m extends MY_Model
{

    public function __construct(){
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_roles';
    }

    public function getList($data){
        $this->db->select('role_id,role_name');
        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('role_name like', '%'.$data['search_key'].'%');
        }
        $this->db->where('delete_flg', "0");
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function addOne($data){
        $this->db->set( 'role_name',     $data['role_name'] );
        $this->db->set( 'remarks',       $data['remarks'] );
        $this->db->set( 'insert_user',   $data['insert_user'] );
        $this->db->set( 'insert_time',   $data['insert_time'] );
        $this->db->set( 'update_user',   $data['update_user'] );
        $this->db->set( 'update_time',   $data['update_time'] );
        return $this->db->insert( $this->table_name );
    }

    public function deleteOne($role_id){
        $this->db->where('role_id', $role_id);
        $this->db->set('delete_flg', "1");
        return $this->db->update( $this->table_name );
    }

    public function updOne($data){
        $this->db->where('role_id',      $data['role_id']);
        $this->db->set( 'role_name',     $data['role_name'] );
        $this->db->set( 'remarks',       $data['remarks'] );
        $this->db->set( 'update_user',   $data['update_user'] );
        $this->db->set( 'update_time',   $data['update_time'] );
        return $this->db->update( $this->table_name );
    }

    public function getOne($role_id){
        $this->db->select('role_id,role_name,remarks');
        $this->db->where('role_id', $role_id);
        $this->db->where('delete_flg', "0");
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }
}