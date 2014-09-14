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

        $graduate_1 = 0;
        $graduate_2 = 0;
        $graduate_3 = 0;
        $graduate_4 = 0;
        $graduate_p_1 = 0;
        $graduate_p_2 = 0;
        $graduate_p_3 = 0;
        $graduate_p_4 = 0;
        $graduate_total = 0;
        foreach($searchData as $temp){
            if ($temp['graduate'] == '1') {
                $graduate_1 = $graduate_1 + 1;
                $graduate_total = $graduate_total + 1;
            } else if ($temp['graduate'] == '2') {
                $graduate_2 = $graduate_2 + 1;
                $graduate_total = $graduate_total + 1;
            } else if ($temp['graduate'] == '3') {
                $graduate_3 = $graduate_3 + 1;
                $graduate_total = $graduate_total + 1;
            } else if ($temp['graduate'] == '4') {
                $graduate_4 = $graduate_4 + 1;
                $graduate_total = $graduate_total + 1;
            } else {
            }
        }
        if ($graduate_total != 0) {
            $graduate_p_1 = round(($graduate_1 / $graduate_total)*100,2);
            $graduate_p_2 = round(($graduate_2 / $graduate_total)*100,2);
            $graduate_p_3 = round(($graduate_3 / $graduate_total)*100,2);
            $graduate_p_4 = 100 - $graduate_p_1 - $graduate_p_2 - $graduate_p_3;
        }
        $data['graduate_1'] = $graduate_1;
        $data['graduate_2'] = $graduate_2;
        $data['graduate_3'] = $graduate_3;
        $data['graduate_4'] = $graduate_4;
        $data['graduate_p_1'] = $graduate_p_1;
        $data['graduate_p_2'] = $graduate_p_2;
        $data['graduate_p_3'] = $graduate_p_3;
        $data['graduate_p_4'] = $graduate_p_4;

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));

        log_message('info', "search_c search data:".var_export($data,true));

        $this->load->view('search_lst_v',$data);
    }
}