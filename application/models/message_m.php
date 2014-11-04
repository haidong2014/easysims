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
        $this->db->select('message_id,message_date,message_user,message_title,message_content,message_feedback');

        if($data['start_year'] <> null && trim($data['start_year']) <> ""){
            $this->db->where('message_year', $data['start_year']);
        }

        if($data['start_month'] <> null && trim($data['start_month']) <> ""){
            $this->db->where('message_month', $data['start_month']);
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
        log_message('info', "Message_m getList SQL : ".$this->db->last_query());
        return $query->result_array();
    }

    public function getOne($data)
    {
        $this->db->select('message_id,message_date,message_user,message_title,message_content,message_feedback');
        $this->db->where('message_id', $data['message_id']);
        $this->db->where('delete_flg', 0);
        $query =  $this->db->get($this->table_name);
        $message= null;
        foreach ($query->result_array() as $row){
            $message = $row;
        }
        return $message;
    }

    public function addOne($data){
        $this->db->set( 'message_date',     $data['message_date'] );
        $this->db->set( 'message_year',     $data['message_year'] );
        $this->db->set( 'message_month',    $data['message_month'] );
        $this->db->set( 'message_user',     $data['message_user'] );
        $this->db->set( 'message_title',    $data['message_title'] );
        $this->db->set( 'message_content',  $data['message_content'] );
        $this->db->set( 'insert_user',      $data['insert_user'] );
        $this->db->set( 'insert_time',      $data['insert_time'] );
        $this->db->set( 'update_user',      $data['update_user'] );
        $this->db->set( 'update_time',      $data['update_time'] );

        return $this->db->insert( $this->table_name );
    }

    public function updateOne($data){
        $this->db->where('message_id',      $data['message_id']);
        $this->db->set( 'message_feedback', $data['message_feedback'] );
        $this->db->set( 'update_user',      $data['update_user'] );
        $this->db->set( 'update_time',      $data['update_time'] );

        return $this->db->update( $this->table_name );
    }

}