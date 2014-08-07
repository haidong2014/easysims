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
        log_message('info', "message_c index user:".var_export($user,true));
        log_message('info', "message_c index post:".var_export($_POST,true));

        $year = array();
        $year[0] = array("id"=>"0","name"=>"2014","sel"=>"");
        $year[1] = array("id"=>"1","name"=>"2015","sel"=>"");
        $year[2] = array("id"=>"2","name"=>"2016","sel"=>"");
        $year[3] = array("id"=>"3","name"=>"2017","sel"=>"");
        $year[4] = array("id"=>"4","name"=>"2018","sel"=>"");
        $year[5] = array("id"=>"5","name"=>"2019","sel"=>"");
        $year[6] = array("id"=>"6","name"=>"2020","sel"=>"");
        $year[7] = array("id"=>"7","name"=>"2021","sel"=>"");
        $year[8] = array("id"=>"8","name"=>"2022","sel"=>"");
        $year[9] = array("id"=>"9","name"=>"2023","sel"=>"");
        $year[10] = array("id"=>"10","name"=>"2024","sel"=>"");
        $year[11] = array("id"=>"11","name"=>"2025","sel"=>"");

        $month = array();
        $month[0] = array("id"=>"0","name"=>"01","sel"=>"");
        $month[1] = array("id"=>"1","name"=>"02","sel"=>"");
        $month[2] = array("id"=>"2","name"=>"03","sel"=>"");
        $month[3] = array("id"=>"3","name"=>"04","sel"=>"");
        $month[4] = array("id"=>"4","name"=>"05","sel"=>"");
        $month[5] = array("id"=>"5","name"=>"06","sel"=>"");
        $month[6] = array("id"=>"6","name"=>"07","sel"=>"");
        $month[7] = array("id"=>"7","name"=>"08","sel"=>"");
        $month[8] = array("id"=>"8","name"=>"09","sel"=>"");
        $month[9] = array("id"=>"9","name"=>"10","sel"=>"");
        $month[10] = array("id"=>"10","name"=>"11","sel"=>"");
        $month[11] = array("id"=>"11","name"=>"12","sel"=>"");
        
        $ddlYear = $this->input->post('ddlYear');
        $ddlMonth = $this->input->post('ddlMonth');
        $tmpYear = substr(date("Y-m-d"),0,4);
        $tmpMonth = substr(date("Y-m-d"),5,2);
        if ($ddlYear=="" || $ddlMonth=="") {
            $search_ym = $tmpYear.$tmpMonth;
            $i = 0;
            foreach($year as $y){
                if ($y['name']==$tmpYear) {
                    $year[$i]['sel'] = "selected";
                    break;
                }
                $i = $i + 1;
            }
            $i = 0;
            foreach($month as $m){
                if ($m['name']==$tmpMonth) {
                    $month[$i]['sel'] = "selected";
                    break;
                }
                $i = $i + 1;
            }
        } else {
            $search_ym = $year[$ddlYear]['name'].$month[$ddlMonth]['name'];
            $year[$ddlYear]['sel'] = "selected";
            $month[$ddlMonth]['sel'] = "selected";
        }

        $data['year'] = $year;
        $data['month'] = $month;
        $data['search_ym'] =  $search_ym;
        $data['search_key'] =  $this->input->post('txtKey');
        $messageData = $this->message_m->getList($data);
        $data['messageData'] = @json_encode(array('Rows'=>$messageData));

        $this->load->view('message_lst_v',$data);
    }

    public function search_message()
    {
        $data = array();
        $user = $this->session->all_userdata();
        log_message('info', "message_c search_message user:".var_export($user,true));
        log_message('info', "message_c search_message post:".var_export($_POST,true));

        $year = array();
        $year[0] = array("id"=>"0","name"=>"2014","sel"=>"");
        $year[1] = array("id"=>"1","name"=>"2015","sel"=>"");
        $year[2] = array("id"=>"2","name"=>"2016","sel"=>"");
        $year[3] = array("id"=>"3","name"=>"2017","sel"=>"");
        $year[4] = array("id"=>"4","name"=>"2018","sel"=>"");
        $year[5] = array("id"=>"5","name"=>"2019","sel"=>"");
        $year[6] = array("id"=>"6","name"=>"2020","sel"=>"");
        $year[7] = array("id"=>"7","name"=>"2021","sel"=>"");
        $year[8] = array("id"=>"8","name"=>"2022","sel"=>"");
        $year[9] = array("id"=>"9","name"=>"2023","sel"=>"");
        $year[10] = array("id"=>"10","name"=>"2024","sel"=>"");
        $year[11] = array("id"=>"11","name"=>"2025","sel"=>"");

        $month = array();
        $month[0] = array("id"=>"0","name"=>"01","sel"=>"");
        $month[1] = array("id"=>"1","name"=>"02","sel"=>"");
        $month[2] = array("id"=>"2","name"=>"03","sel"=>"");
        $month[3] = array("id"=>"3","name"=>"04","sel"=>"");
        $month[4] = array("id"=>"4","name"=>"05","sel"=>"");
        $month[5] = array("id"=>"5","name"=>"06","sel"=>"");
        $month[6] = array("id"=>"6","name"=>"07","sel"=>"");
        $month[7] = array("id"=>"7","name"=>"08","sel"=>"");
        $month[8] = array("id"=>"8","name"=>"09","sel"=>"");
        $month[9] = array("id"=>"9","name"=>"10","sel"=>"");
        $month[10] = array("id"=>"10","name"=>"11","sel"=>"");
        $month[11] = array("id"=>"11","name"=>"12","sel"=>"");

        $ddlYear = $this->input->post('ddlYear');
        $ddlMonth = $this->input->post('ddlMonth');
        $search_ym = $year[$ddlYear]['name'].$month[$ddlMonth]['name'];

        $year[$ddlYear]['sel'] = "selected";
        $month[$ddlMonth]['sel'] = "selected";

        $data['year'] = $year;
        $data['month'] = $month;
        $data['search_ym'] =  $search_ym;
        $data['search_key'] = $this->input->post('txtKey');
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

        $message_date = date("Y-m-d");
        $message_ym = substr(date("Y-m-d"),0,4).substr(date("Y-m-d"),5,2);
        $message_user = $user;
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