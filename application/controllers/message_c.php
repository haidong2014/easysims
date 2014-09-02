<?php
class Message_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100601");
        $this->load->model('message_m','message_m');
    }

    public function index()
    {
        $data = array();
        $user = $this->session->all_userdata();
        log_message('info', "message_c index user:".var_export($user,true));
        log_message('info', "message_c index post:".var_export($_POST,true));

        $start_year = $this->input->post('start_year');
        if (empty($start_year)) {
            $start_year = substr(date("Y-m-d"),0,4);
        }
        $start_month = $this->input->post('start_month');
        if (empty($start_month)) {
            $start_month = substr(date("Y-m-d"),5,2);
        } else {
            $start_month = substr("0".$start_month,-2);
        }
        $data['start_year'] = $start_year;
        $data['start_month'] = $start_month;
        $search_ym = $start_year.$start_month;
        $data['search_ym'] =  $search_ym;
        $data['search_key'] =  $this->input->post('txtKey');
        $role_id = $user['role_id'];
        $user_cd = $user['user'];
        if ($role_id == "1001") {
            $data['user_cd'] = "";
            $data['show_flg'] = "1";
        } else {
            $data['user_cd'] = $user_cd;
            $data['show_flg'] = "0";
        }
        $messageData = $this->message_m->getList($data);
        $data['messageData'] = @json_encode(array('Rows'=>$messageData));

        $this->load->view('message_lst_v',$data);
    }

    public function add_message_init(){

        $data = array();
        $this->load->view('message_add_v',$data);
    }

    public function add_message(){
        log_message('info', "message_c add_message post:".var_export($_POST,true));

        $data = array();
        $user = $this->session->userdata('user');
        $user_name = $this->session->userdata('user_name');

        $message_date = date("Y-m-d");
        $message_ym = substr(date("Y-m-d"),0,4).substr(date("Y-m-d"),5,2);
        $message_user = $user_name;
        $message_title = $this->input->post('txtTitle');
        $message_content = $this->input->post('txtMessage');
        $insert_user = $user;
        $insert_time = date("Y-m-d H:i:s");
        $update_user = $user;
        $update_time = date("Y-m-d H:i:s");

        $data['message_date'] = $message_date;
        $data['message_ym'] = $message_ym;
        $data['message_user'] = $message_user;
        $data['message_title'] = $message_title;
        $data['message_content'] = $message_content;
        $data['insert_user'] = $insert_user;
        $data['insert_time'] = $insert_time;
        $data['update_user'] = $update_user;
        $data['update_time'] = $update_time;

        $this->message_m->addOne($data);

        redirect("message_c");
  }
}