<?php
class Rolesetup_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_roles_functions_relation';
    }

    public function getFunctionList()
    {
        $this->db->select('function_id,function_name');
        $this->db->from('ss_functions');
        $this->db->where('delete_flg', 0);
        $query =  $this->db->get();
        return $query->result_array();
    }
}