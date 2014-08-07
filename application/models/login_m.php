<?php
class Login_m extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUser( $user )
    {
        $this->db->where('user', $user);
        $this->db->where('delete_flg', '0');
        $this->db->select('user,user_name,password');
        $query = $this->db->get('ss_users');
        $user = null;

        foreach ($query->result_array() as $row){
            $user = $row;
        }
        return $user;
    }
}