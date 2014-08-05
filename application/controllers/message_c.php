<?php
class Message_c extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('message_m','message_m');
  }

  public function index()
  {
    $data = array();
    $user = $this->session->all_userdata();
    log_message('info', "####user".var_export($user,true));

    $messageData = $this->message_m->getList();
    $data['messageData'] = $messageData;
    $data['messageData'] = @json_encode(array('Rows'=>$messageData));

    $this->load->view('message_lst_v',$data);
  }

  public function add_teacher_init(){
    $data = array();
    $this->load->view('message_add_v',$data);
  }

}