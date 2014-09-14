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

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('search_lst_v',$data);
    }

    public function search(){
        $data = array();
        $searchData = array();

        log_message('info', "search_c index post:".var_export($_POST,true));

        $start_year = $this->input->post('start_year');
        $start_month = $this->input->post('start_month');
        $scores_from = $this->input->post('scores_from');
        $scores_to = $this->input->post('scores_to');
        $age = $this->input->post('age');
        $graduate = $this->input->post('graduate');
        $end_year = $this->input->post('end_year');
        $end_month = $this->input->post('end_month');
        $follow_salary_from = $this->input->post('follow_salary_from');
        $follow_salary_to = $this->input->post('follow_salary_to');
        $sex = $this->input->post('sex');
        $keyword = $this->input->post('txtKey');

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $data['start_year'] = $start_year;
        $data['start_month'] = substr('0'.$start_month,-2);
        $data['scores_from'] = $scores_from;
        $data['scores_to'] = $scores_to;
        $data['age'] = $age;
        $data['graduate'] = $graduate;
        $data['end_year'] = $end_year;
        $data['end_month'] = substr('0'.$end_month,-2);
        $data['follow_salary_from'] = $follow_salary_from;
        $data['follow_salary_to'] = $follow_salary_to;
        $data['sex'] = $sex;
        $data['txtKey'] = $keyword;

        $searchData = $this->student_m->search($data);
        $data['searchData'] = @json_encode(array('Rows'=>$searchData));

        $this->load->view('search_lst_v',$data);
    }
}