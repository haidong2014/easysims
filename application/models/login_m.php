<?php
class Login_m extends MY_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
    }
    
    public function getUser( $userName )
    {
       $this->db->where('user_name', $userName); 
       $this->db->where('delete_flg', 0); 
       $this->db->select('*');    
       $query = $this->db->get('ss_users');
       $user = null;
       
       foreach ($query->result_array() as $row){
         $user = $row;
       }
    	 return $user;
    }
    public function setPwd($userName,$newPassword){
       $this->db->set('password', $newPassword); 
       $this->db->where('user_name', $userName); 
       $ret = $this->db->update('ss_users');
    	 return $ret;
    }
}