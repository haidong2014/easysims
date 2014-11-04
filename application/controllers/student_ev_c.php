<?php
class Student_Ev_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100303");
        $this->load->model('evaluationstudent_m','evaluationstudent_m');
        $this->load->model('code_m','code_m');
        $this->load->model('user_m','user_m');
        $this->load->model('student_m','student_m');
    }

    public function index()
    {
        $data = array();
        $searchData = array();

        $data['class_name'] = "";
        $data['student_name'] = "";
        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('student_ev_v',$data);
    }

    public function search(){
        $data = array();
        $searchData = array();
        log_message('info', "student_ev_c search post:".var_export($_POST,true));

        $class_name = $this->input->post('class_name');
        $student_name = $this->input->post('student_name');
        $student_id = "";
        $download_flg = $this->input->post('download_flg');
        $data['class_name'] = $class_name;
        $data['student_name'] = $student_name;
        $data['student_id'] = "";

        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        if($role_id == '1007'){
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
            $data['student_id'] = $student_id;
        }
        //---------------------------------------------------------------//

        $ev = $this->code_m->getList("10");
        $works_ev = $ev['作品分数']['1']/100;
        $attendance_ev = $ev['出勤分数']['2']/100;
        $performance_ev = $ev['课堂表现']['3']/100;
        $homework_ev = $ev['课后作业']['4']/100;
        if($download_flg == "1"){
            $this->load->library('PHPExcel');
            $this->load->library('PHPExcel/IOFactory');

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '班级名称');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '课程名称');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '科目名称');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '学生名称');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '出勤分数');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '作品分数');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '课堂表现');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '课后作业');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', '学生成绩');

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);

            $searchXlsData = $this->evaluationstudent_m->selectEV($class_name,$student_name,$student_id);
            $i = 2;
            foreach($searchXlsData as $temp){
                $scores = round($temp['works_scores']*$works_ev+$temp['attendance_scores']*$attendance_ev+
                                  $temp['performance_scores']*$performance_ev+$temp['homework_scores']*$homework_ev);
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $temp['class_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $temp['course_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $temp['subject_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $temp['student_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $temp['works_scores']);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $temp['attendance_scores']);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $temp['performance_scores']);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $temp['homework_scores']);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $scores);

                $i = $i + 1;
            }

            $date = substr(date("Y-m-d"),0,4).substr(date("Y-m-d"),5,2).substr(date("Y-m-d"),8,2);
            $outputFileName = 'student_ev_list_'.$date.'.xls';
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
        } else {
            $searchData = $this->evaluationstudent_m->selectEV($class_name,$student_name,$student_id);
            foreach($searchData as &$temp){
                $temp['student_name'] = "<a href=\"#\" onclick=\"showStudent('".SITE_URL."/student_c/view_student_init/".
                                        $temp['student_id']."/1/1/1')\">".$temp['student_name']."</a>";
                $temp['scores'] = round($temp['works_scores']*$works_ev+$temp['attendance_scores']*$attendance_ev+
                                  $temp['performance_scores']*$performance_ev+$temp['homework_scores']*$homework_ev);
            }
        }

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('student_ev_v',$data);
    }
}