<?php
class Message_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->CI->load->database();
        $this->table_name='ss_message';
    }

    public function getList($data)
    {
        $this->db->select('message_date,message_user,message_title,message_content');

        if($data['search_ym'] <> null && trim($data['search_ym']) <> ""){
            $this->db->where('message_ym', $data['search_ym']);
        }

        if($data['search_key'] <> null && trim($data['search_key']) <> ""){
            $this->db->where('message_title like', '%'.$data['search_key'].'%');
        }

        if($data['user_cd'] <> null && trim($data['user_cd']) <> ""){
            $this->db->where('insert_user', $data['user_cd']);
        }

        $this->db->where('delete_flg', 0);
        $this->db->order_by('message_id','desc');
        $query =  $this->db->get($this->table_name);
        return $query->result_array();
    }

    public function addOne($data){
        $this->db->set( 'message_date',     $data['message_date'] );
        $this->db->set( 'message_ym',       $data['message_ym'] );
        $this->db->set( 'message_user',     $data['message_user'] );
        $this->db->set( 'message_title',    $data['message_title'] );
        $this->db->set( 'message_content',  $data['message_content'] );
        $this->db->set( 'insert_user',      $data['insert_user'] );
        $this->db->set( 'insert_time',      $data['insert_time'] );
        $this->db->set( 'update_user',      $data['update_user'] );
        $this->db->set( 'update_time',      $data['update_time'] );

        return $this->db->insert( $this->table_name );
    }
}