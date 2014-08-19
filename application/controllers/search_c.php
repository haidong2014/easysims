<?php
class Search_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100301");
        $this->load->model('class_m','class_m');
        $this->load->model('student_m','student_m');
    }

    public function index()
    {
        $data = array();
        $searchData = array();

        $user = $this->session->all_userdata();
        log_message('info', "search_c index user:".var_export($user,true));
        log_message('info', "search_c index post:".var_export($_POST,true));

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('search_lst_v',$data);
    }

    public function search()
    {
        $data = array();
        $searchData = array();

        $user = $this->session->all_userdata();
        log_message('info', "search_c index user:".var_export($user,true));
        log_message('info', "search_c index post:".var_export($_POST,true));

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('search_lst_v',$data);
    }
}