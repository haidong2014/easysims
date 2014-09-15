<?php
class Student_Ev_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100303");
        $this->load->model('evaluationstudent_m','evaluationstudent_m');
    }

    public function index()
    {
        $data = array();
        $searchData = array();

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('student_ev_v',$data);
    }

    public function search(){
        $data = array();
        $searchData = array();
        log_message('info', "student_ev_c search post:".var_export($_POST,true));

        $class_name = $this->input->post('class_name');
        $student_name = $this->input->post('student_name');
        $download_flg = $this->input->post('download_flg');

        $data['class_name'] = $class_name;
        $data['student_name'] = $student_name;
        $searchData = $this->evaluationstudent_m->selectEV($class_name,$student_name);

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

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(24);

            $i = 2;
            foreach($searchData as $temp){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $temp['class_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $temp['course_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $temp['subject_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $temp['student_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $temp['attendance_scores']);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $temp['works_scores']);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $temp['performance_scores']);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $temp['homework_scores']);

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
        }

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('student_ev_v',$data);
    }
}