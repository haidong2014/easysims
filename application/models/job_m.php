<?php
class Job_m extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_job';
    }

    public function getList($keyword)
    {
        $this->db->select('t1.job_id,t1.job_company,t1.job_city,t1.job_business,t1.job_address,t1.job_phone,t1.job_mail,t1.job_qq,t1.job_telephone,' .
            't1.job_contacts,t1.job_post,t1.job_onjob,t2.code_name as job_grade,t1.job_cooperation,t1.remarks');
        $this->db->from('ss_job t1');
        $this->db->join('ss_code t2', 't2.code_no=t1.job_grade and t2.code='."09", 'left');
        if(!empty($keyword)){
            $this->db->like('t1.job_company',$keyword);
        }
        $this->db->where('t1.delete_flg', 0);
        $this->db->order_by('t1.job_id','esc');
        $query =  $this->db->get();
        log_message('info', "Job_m getList SQL : ".$this->db->last_query());
        return $query->result_array();
    }

    public function addOne($data){
        $this->db->set( 'job_company',	    $data['job_company'] );
        $this->db->set( 'job_city',	        $data['job_city'] );
        $this->db->set( 'job_business',	    $data['job_business'] );
        $this->db->set( 'job_address',	    $data['job_address'] );
        $this->db->set( 'job_phone',	    $data['job_phone'] );
        $this->db->set( 'job_mail',	        $data['job_mail'] );
        $this->db->set( 'job_qq',	        $data['job_qq'] );
        $this->db->set( 'job_telephone',	$data['job_telephone'] );
        $this->db->set( 'job_contacts',	    $data['job_contacts'] );
        $this->db->set( 'job_post',	        $data['job_post'] );
        $this->db->set( 'job_onjob',	    $data['job_onjob'] );
        $this->db->set( 'job_grade',	    $data['job_grade'] );
        $this->db->set( 'job_cooperation',	$data['job_cooperation'] );
        $this->db->set( 'remarks',		    $data['remarks'] );
        $this->db->set( 'delete_flg',	    $data['delete_flg'] );
        $this->db->set( 'insert_user',	    $data['insert_user'] );
        $this->db->set( 'insert_time',	    $data['insert_time'] );
        $this->db->set( 'update_user',	    $data['update_user'] );
        $this->db->set( 'update_time',	    $data['update_time'] );

        return $this->db->insert( $this->table_name );
    }

    public function getOne($job_id){
        $this->db->select('job_id,job_company,job_city,job_business,job_address,job_phone,job_mail,job_qq,job_telephone,job_contacts,job_post,' .
                          'job_onjob,job_grade,job_cooperation,remarks');
        $this->db->where('job_id', $job_id);
        $this->db->where('delete_flg', 0);
        $query = $this->db->get($this->table_name);
        $job = null;
        foreach ($query->result_array() as $row){
            $job = $row;
        }
        return $job;
    }

    public function updateOne($data){
        $this->db->where('job_id',          $data['job_id'] );
        $this->db->set( 'job_company',	    $data['job_company'] );
        $this->db->set( 'job_city',	        $data['job_city'] );
        $this->db->set( 'job_business',	    $data['job_business'] );
        $this->db->set( 'job_address',	    $data['job_address'] );
        $this->db->set( 'job_phone',	    $data['job_phone'] );
        $this->db->set( 'job_mail',	        $data['job_mail'] );
        $this->db->set( 'job_qq',	        $data['job_qq'] );
        $this->db->set( 'job_telephone',	$data['job_telephone'] );
        $this->db->set( 'job_contacts',	    $data['job_contacts'] );
        $this->db->set( 'job_post',	        $data['job_post'] );
        $this->db->set( 'job_onjob',	    $data['job_onjob'] );
        $this->db->set( 'job_grade',	    $data['job_grade'] );
        $this->db->set( 'job_cooperation',	$data['job_cooperation'] );
        $this->db->set( 'remarks',		    $data['remarks'] );
        $this->db->set( 'update_user',	    $data['update_user'] );
        $this->db->set( 'update_time',	    $data['update_time'] );
        return $this->db->update( $this->table_name );
    }

    public function deleteOne($data){
        $this->db->where('job_id',      $data['job_id'] );
        $this->db->set( 'delete_flg',   $data['delete_flg'] );
        $this->db->set( 'update_user',	$data['update_user'] );
        $this->db->set( 'update_time',	$data['update_time'] );
        return $this->db->update( $this->table_name );
    }
}