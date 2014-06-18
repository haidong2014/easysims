<?php
class Passwordset_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function setPwd($username,$newPassword){
		$this->db->set('password', md5($newPassword));
		$this->db->set('update_user', $username);
		$this->db->set('update_time', date('Y-m-d H:i:s'));
		$this->db->where('user_name', $username);
		$ret = $this->db->update('ss_users');
		return $ret;
	}
}