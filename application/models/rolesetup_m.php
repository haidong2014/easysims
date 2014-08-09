<?php
class Rolesetup_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_roles_functions_relation';
    }

    public function getFunctionList($role_id)
    {
        $this->db->select('t1.function_id,t1.function_name,t2.role_id');
        $this->db->from('ss_functions t1');
        $this->db->join('ss_roles_functions_relation t2', 't1.function_id = t2.function_id and t2.role_id='.$role_id , 'left');
        $this->db->where('t1.delete_flg', 0);
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function updRoleFunction($role_id,$dataforupd,$data){
        $this->db->where('role_id',      $role_id);
        $this->db->delete( $this->table_name );

        $i = 0;
        foreach($dataforupd as $datafu){
            $this->db->set( 'role_id',       $role_id );
            $this->db->set( 'function_id',   $dataforupd[$i] );
            $this->db->set( 'delete_flg',    "0" );
            $this->db->set( 'insert_user',   $data['insert_user'] );
            $this->db->set( 'insert_time',   $data['insert_time'] );
            $this->db->set( 'update_user',   $data['update_user'] );
            $this->db->set( 'update_time',   $data['update_time'] );
            $this->db->insert( $this->table_name );
            $i = $i + 1;
        }
    }
}