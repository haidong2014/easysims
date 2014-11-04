<?php
class Teacher_Ev_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100304");
        $this->load->model('evaluationteacher_m','evaluationteacher_m');
        $this->load->model('teacher_m','teacher_m');
        $this->load->model('user_m','user_m');
    }

    public function index()
    {
        $data = array();
        $searchData = array();

        $data['class_name'] = "";
        $data['teacher_name'] = "";
        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('teacher_ev_v',$data);
    }

    public function search(){
        $data = array();
        $searchData = array();
        log_message('info', "teacher_ev_v search post:".var_export($_POST,true));

        $class_name = $this->input->post('class_name');
        $teacher_name = $this->input->post('teacher_name');
        $download_flg = $this->input->post('download_flg');
        $teacher_id = "";
        $data['class_name'] = $class_name;
        $data['teacher_name'] = $teacher_name;
        $data['teacher_id'] = "";

        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        if($role_id == '1007'){
            $data['searchData'] = @json_encode(array('Rows'=>$searchData));
            $this->load->view('teacher_ev_v',$data);
			return;
        } else if($role_id == '1006') {
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $teacher = $this->teacher_m->getOneByNo($user['0']['user']);
            $teacher_id = $teacher['teacher_id'];
            $data['teacher_id'] = $teacher_id;
		} else {
		}
        //---------------------------------------------------------------//

        if($download_flg == "1"){
            $this->load->library('PHPExcel');
            $this->load->library('PHPExcel/IOFactory');

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '班级名称');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '课程名称');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '科目名称');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '任课教师');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '满意度分数');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '考勤分数');

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);

            $searchXlsData = $this->evaluationteacher_m->selectEV($class_name,$teacher_name,$teacher_id);
            $i = 2;
            foreach($searchXlsData as $temp){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $temp['class_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $temp['course_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $temp['subject_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $temp['teacher_name']);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $temp['scores']);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $temp['attendance_scores']);

                $i = $i + 1;
            }

            $date = substr(date("Y-m-d"),0,4).substr(date("Y-m-d"),5,2).substr(date("Y-m-d"),8,2);
            $outputFileName = 'teacher_ev_list_'.$date.'.xls';
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
            $searchData = $this->evaluationteacher_m->selectEV($class_name,$teacher_name,$teacher_id);
            foreach($searchData as &$temp){
                $temp['teacher_name'] = "<a href=\"#\" onclick=\"showTeacher('".SITE_URL."/teacher_c/view_teacher_init/".
                                        $temp['teacher_id']."/1')\">".$temp['teacher_name']."</a>";
            }
        }

        $data['searchData'] = @json_encode(array('Rows'=>$searchData));
        $this->load->view('teacher_ev_v',$data);
    }
}