<?php
class Code_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_code';
    }

    public function getList($code = null)
    {
        $this->db->select('*');

        if(!empty($code)){
            $this->db->where('code', $code);
        }

        $this->db->where('delete_flg', 0);

        $query =  $this->db->get($this->table_name);
        $res = array();
        foreach($query->result_array() as $value){
        	$res[$value['code']][$value['code_no']] = $value['code_name'];
        }
        //var_dump($res);
        return $res;
    }

   
}