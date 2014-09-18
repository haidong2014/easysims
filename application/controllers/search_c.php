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
        log_message('info', "search_c search post:".var_export($_POST,true));

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
        $download_flg = $this->input->post('download_flg');

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
        foreach($searchData as &$temp){
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

            $temp['teacher_name'] = "<a href=\"#\" onclick=\"showTeacher('".SITE_URL."/teacher_c/view_teacher_init/".
                                    $temp['teacher_id']."/1')\">".$temp['teacher_name']."</a>";
            $temp['student_name'] = "<a href=\"#\" onclick=\"showStudent('".SITE_URL."/student_c/view_student_init/".
                                    $temp['student_id']."/1/1/1')\">".$temp['student_name']."</a>";
            $temp['job_company'] = "<a href=\"#\" onclick=\"showJobCompany('".SITE_URL."/job_c/view_job_init/".
                                    $temp['job_id']."/1')\">".$temp['job_company']."</a>";
        }
        if ($graduate_total != 0) {
            $graduate_p_1 = round(($graduate_1 / $graduate_total)*100,0);
            $graduate_p_2 = round(($graduate_2 / $graduate_total)*100,0);
            $graduate_p_3 = round(($graduate_3 / $graduate_total)*100,0);
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

        if($download_flg == "1"){
            $this->load->library('PHPExcel');
            $this->load->library('PHPExcel/IOFactory');

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '班级名称');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '课程名称');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '班主任');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '学生名称');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '学生性别');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '学生年龄');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '学生原籍');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '毕业学校');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', '学生学历');
            $objPHPExcel->getActiveSheet()->setCellValue('J1', '学生专业');
            $objPHPExcel->getActiveSheet()->setCellValue('K1', '开课日期');
            $objPHPExcel->getActiveSheet()->setCellValue('L1', '毕业日期');
            $objPHPExcel->getActiveSheet()->setCellValue('M1', '学生成绩');
            $objPHPExcel->getActiveSheet()->setCellValue('N1', '就业城市');
            $objPHPExcel->getActiveSheet()->setCellValue('O1', '就业企业');
            $objPHPExcel->getActiveSheet()->setCellValue('P1', '就业职位');
            $objPHPExcel->getActiveSheet()->setCellValue('Q1', '就业薪资');

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12);

            $searchXlsData = $this->student_m->search($data);
            $i = 2;
            foreach($searchXlsData as $temp){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $temp['class_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $temp['course_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $temp['teacher_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $temp['student_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $temp['sex_nm']);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $temp['age']);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $temp['ancestralhome']);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $temp['graduate_school']);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $temp['graduate_nm']);
                $objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $temp['specialty']);
                $objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $temp['start_date']);
                $objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $temp['end_date']);
                $objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $temp['scores']);
                $objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $temp['job_city']);
                $objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $temp['job_company']);
                $objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $temp['follow_position']);
                $objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $temp['follow_salary']);

                $i = $i + 1;
            }

            $date = substr(date("Y-m-d"),0,4).substr(date("Y-m-d"),5,2).substr(date("Y-m-d"),8,2);
            $outputFileName = 'student_info_list_'.$date.'.xls';
            $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control:must-revalidate, post-check=0, pre-check=0');
            header('Content-Type:application/force-download');
            header('Content-Type:application/vnd.ms-execl');
            header('Content-Type:application/octet-stream');
            header('Content-Type:application/download');;
            header('Content-Disposition:attachment;filename='.$outputFileName);
            header('Content-Transfer-Encoding:binary');
            $objWriter->save('php://output');
        }

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('search_lst_v',$data);
    }
}