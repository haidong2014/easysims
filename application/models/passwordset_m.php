<?php
class Passwordset_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function setPwd($user,$newPassword){
		$this->db->set('password', md5($newPassword));
		$this->db->set('update_user', $user);
		$this->db->set('update_time', date('Y-m-d H:i:s'));
		$this->db->where('user', $user);
		$ret = $this->db->update('ss_users');
		return $ret;
	}
}