<?php
class Message_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_message';
    }

    public function getList($code)
    {
        $this->db->select('*');

        if(!empty($code)){
            $this->db->where('code', $code]);
        }

        $this->db->where('delete_flg', 0);

        $query =  $this->db->get($this->table_name);
        $res = array();
        foreach($query->result_array() as $value){
        	$res[$value['code']][$value['code_no']] = $value['code_name'];
        }
        
        return $res;
    }

   
}