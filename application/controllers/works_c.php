<?php
class Works_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100102");
        $this->load->model('class_m','class_m');
        $this->load->model('works_m','works_m');
        $this->load->model('code_m','code_m');
        $this->load->model('student_m','student_m');
        $this->load->model('user_m','user_m');
        $this->load->model('session_m','session_m');
        $this->load->model('teacher_m','teacher_m');
    }

    public function index()
    {
        $data = array();
        $classData = array();

        //---------------------------------------------------------//
        $sessionData = array();
        $status = null;
        $search_key = null;

        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10010201";
        $sessionData = $this->session_m->select($data);
        if(empty($sessionData)){
            $status = "2";
        } else {
            $status = $sessionData['session_01'];
            $search_key = $sessionData['session_02'];
        }
        //---------------------------------------------------------//
        $data['status'] = $status;
        $data['search_key'] =  $search_key;
        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        $data['student_id'] = '';
        if($role_id == '1007'){
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
            $data['student_id'] = $student_id;
        }
        //---------------------------------------------------------------//
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/works_c/subject_lst/".
                              $temp['class_id']."/".$temp['course_id']."\">".$temp['class_no']."</a>";
        }
        $statusLst = $this->code_m->getList("05");
        $data['statusLst'] = $statusLst;

        $data['classData'] = @json_encode(array('Rows'=>$classData));
        $this->load->view('works_class_v',$data);
    }

    public function search()
    {
        $data = array();
        $classData = array();

        log_message('info', "works_c search post:".var_export($_POST,true));

        $search_key =  $this->input->post('txtKey');
        $status =  $this->input->post('status');
        $data['status'] = $status;
        $data['search_key'] = $search_key;
        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        $data['student_id'] = '';
        if($role_id == '1007'){
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
            $data['student_id'] = $student_id;
        }
        //---------------------------------------------------------------//
        $classData = $this->class_m->getList($data);
        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/works_c/subject_lst/".
                              $temp['class_id']."/".$temp['course_id']."\">".$temp['class_no']."</a>";
        }
        $statusLst = $this->code_m->getList("05");
        $data['statusLst'] = $statusLst;
        $data['classData'] = @json_encode(array('Rows'=>$classData));
        //---------------------------------------------------------//
        $userinfo = $this->session->userdata('user');
        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;
        $data['url_sub_id'] = "10010201";
        $data['session_01'] = $status;
        $data['session_02'] = $search_key;
        $data['session_03'] = null;
        $data['insert_user'] = $userinfo;
        $data['insert_time'] = date("Y-m-d H:i:s");
        $data['update_user'] = $userinfo;
        $data['update_time'] = date("Y-m-d H:i:s");
        $this->session_m->insertorupdate($data);
        //---------------------------------------------------------//
        $this->load->view('works_class_v',$data);
    }

    public function subject_lst($class_id=null,$course_id=null){
        $data = array();
        $subjectData = array();

        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        $role_id = $this->session->userdata('role_id');
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_m->getOne($user_id);

        $search_key = $this->input->post('txtKey');
        $data['search_key'] = $search_key;
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
		$teacher_id = '';
        if($role_id == '1006'){
            $teacher = $this->teacher_m->getTeacherId($user['0']['user']);
            $teacher_id = $teacher['teacher_id'];
            $data['teacher_id'] = $teacher_id;
        }
        $subjectData = $this->class_m->getSubjectList($class_id,$course_id,$search_key,$teacher_id);

        foreach($subjectData as &$temp){
            $temp['period']=$temp['period']."周";
            $worksData = $this->works_m->getWorksInfo($class_id,$course_id,$temp['subject_id']);
            $numbers = $worksData['numbers'];
            $scores = $worksData['scores'];
            if (!empty($numbers)) {
                $scores = round($scores/$numbers);
            }
            $temp['numbers']=$numbers;
            $temp['scores']=$scores;
            $temp['subject_id']="<a href=\"".SITE_URL."/works_c/works_lst/".$class_id."/".
                                $course_id."/".$temp['subject_id']."\">".$temp['subject_id']."</a>";
        }

        $data['subjectData'] = @json_encode(array('Rows'=>$subjectData));
        $this->load->view('works_subject_v',$data);
    }

    public function works_lst($class_id=null,$course_id=null,$subject_id=null){
        $data = array();

        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        if (empty($subject_id)) {
            $subject_id = $this->input->post('subject_id');
        }
        $search_key = $this->input->post('txtKey');

        $data['search_key'] = $search_key;
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['txtKey'] = $search_key;
        $workData = $this->works_m->getList($search_key,$class_id,$course_id,$subject_id);
        //---------------------------------------------------------------//
        $role_id = $this->session->userdata('role_id');
        $data['role_id'] = $role_id;
        $data['student_id'] = '';
        $data['works_flg'] = '0';
        if($role_id == '1007'){
            $data['works_flg'] = '1';
            $user_id = $this->session->userdata('user_id');
            $user = $this->user_m->getOne($user_id);
            $student = $this->student_m->getStudentId($user['0']['user']);
            $student_id = $student['student_id'];
            $data['student_id'] = $student_id;
        }
        //---------------------------------------------------------------//
        foreach($workData as &$value){
            $st = $this->student_m->getOne($value['student_id']);
            $value['student_name'] = $st['student_name'];
            if ($data['works_flg'] == '0'){
                $value['remarks']="<a href=\"".SITE_URL."/works_c/works_grade/".$value['class_id']."/".
                                  $value['course_id']."/".$value['subject_id']."/".$value['works_no']."\">点评</a>";
            } else {
                $value['remarks']="";
            }
            $value['works_no']="<a href=\"".SITE_URL."/works_c/works_detail/".$value['class_id']."/".
                                $value['course_id']."/".$value['subject_id']."/".$value['works_no']."\">".$value['works_no']."</a>";

        }
        $data['workData'] = @json_encode(array('Rows'=>$workData));
        $this->load->view('works_lst_v',$data);
    }

    public function works_detail($class_id=null, $course_id=null, $subject_id=null, $works_no=null){
        $data = array();

        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        if (empty($subject_id)) {
            $subject_id = $this->input->post('subject_id');
        }
        if (empty($works_no)) {
            $works_no = $this->input->post('works_no');
        }

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['works_no'] = $works_no;
        $workData = $this->works_m->getOne($class_id,$course_id,$subject_id,$works_no);

        $st = $this->student_m->getOne($workData['student_id']);
        $workData['student_name'] = $st['student_name'];

        $data = array_merge($data, $workData);
        $this->load->view('works_detail_v',$data);
    }

    public function works_upload_init($class_id=null, $course_id=null, $subject_id=null){
        $data = array();

        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        if (empty($subject_id)) {
            $subject_id = $this->input->post('subject_id');
        }
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['msg_flg'] = "0";

        $this->load->view('works_upload_v',$data);
    }

    public function works_upload_exec($class_id=null, $course_id=null, $subject_id=null){
        $data = array();

        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        if (empty($subject_id)) {
            $subject_id = $this->input->post('subject_id');
        }
        $userinfo = $this->session->userdata('user');
        $user_id = $this->session->userdata('user_id');
        $user = $this->user_m->getOne($user_id);
        $student = $this->student_m->getStudentId($user['0']['user']);
        $student_id = $student['student_id'];
        $works_name = $this->input->post('works_name');
        $works_description = $this->input->post('works_description');

        $pathLst = $this->code_m->getList("11");
        $path = $pathLst['FILES_PATH']['1'];
        $up_path = $path.$class_id.'/'.$course_id.'/'.$subject_id.'/'.$student_id;
        if(!file_exists($up_path)){
            mkdir($up_path,0777,true);
        }
        $path_url = $pathLst['FILES_PATH']['2'];
        $up_path_url = $path_url.$class_id.'/'.$course_id.'/'.$subject_id.'/'.$student_id;
        if(!file_exists($up_path_url)){
            mkdir($up_path_url,0777,true);
        }
        $path_temp = $pathLst['FILES_PATH']['3'];
        $up_path_temp = $path_temp;
        if(!file_exists($up_path_temp)){
            mkdir($up_path_temp,0777,true);
        }
        $filename = date('YmdHmis');
        $insData =array();
        $insData['class_id'] = $class_id;
        $insData['course_id'] = $course_id;
        $insData['subject_id'] = $subject_id ;
        $insData['student_id'] = $student_id ;
        $insData['works_no'] = $class_id.$course_id.$subject_id.$student_id;
        $insData['works_name'] = $works_name;
        $insData['works_path']  = '';
        $insData['works_description']= $works_description;
        $insData['remarks']  = '';
        $insData['delete_flg'] =0;
        $insData['insert_user'] = $userinfo;
        $insData['insert_time'] = date("Y-m-d H:i:s");
        $insData['update_user'] = $userinfo;
        $insData['update_time'] = date("Y-m-d H:i:s");

        $config['upload_path']=$up_path;
        $config['allowed_types']="jpg|JPG|wmv|WMV|zip|ZIP";
        $config['max_size']="0";
        $config['max_width']="0";
        $config['max_height']="0";
        $this->load->library("upload",$config);
        if($this->upload->do_upload('upfile')){
            $data = $this->upload->data();
            $path_remarks = $class_id.'/'.$course_id.'/'.$subject_id.'/'.$student_id."/".$data['file_name'];
            if (self::getExt($data['file_name']) == "jpg" || self::getExt($data['file_name']) == "JPG") {
                $this->load->library("image_lib");
                $config_big_thumb['image_library'] = 'gd2';
                $config_big_thumb['source_image'] = $data['full_path'];
                $config_big_thumb['new_image'] = $up_path_url."/".$data['file_name'];
                $config_big_thumb['create_thumb'] = true;
                $config_big_thumb['maintain_ratio'] = true;
                $config_big_thumb['width'] = 300;
                $config_big_thumb['height'] = 300;
                $config_big_thumb['thumb_marker']="";
                $this->image_lib->initialize($config_big_thumb);
                $this->image_lib->resize();
            } else {
                $config['upload_path']=$up_path_temp;
                $config['allowed_types']="jpg|JPG|wmv|WMV|zip|ZIP";
                $config['max_size']="0";
                $config['max_width']="0";
                $config['max_height']="0";
                $this->load->library("upload",$config);
                if($this->upload->do_upload('upsmallfile')){
                    $data = $this->upload->data();
                    $this->load->library("image_lib");
                    $config_big_thumb['image_library'] = 'gd2';
                    $config_big_thumb['source_image'] = $data['full_path'];
                    $config_big_thumb['new_image'] = $up_path_url."/".$data['file_name'];
                    $config_big_thumb['create_thumb'] = true;
                    $config_big_thumb['maintain_ratio'] = true;
                    $config_big_thumb['width'] = 300;
                    $config_big_thumb['height'] = 300;
                    $config_big_thumb['thumb_marker']="";
                    $this->image_lib->initialize($config_big_thumb);
                    $this->image_lib->resize();
                }
            }
            if(!empty($data)){
                $path_save = $class_id.'/'.$course_id.'/'.$subject_id.'/'.$student_id."/".$data['file_name'];
                $insData['works_path']  = $path_save;
                $insData['remarks']  = $path_remarks;
                $this->works_m->insertorupdate($insData);
            }

            redirect("works_c/works_lst/".$class_id."/".$course_id."/".$subject_id);
        } else {
            $data['class_id'] = $class_id;
            $data['course_id'] = $course_id;
            $data['subject_id'] = $subject_id;
            $data['msg_flg'] = "1";
            $this->load->view('works_upload_v',$data);
        }
    }

    public function works_grade($class_id=null, $course_id=null, $subject_id=null, $works_no=null){
        $data = array();

        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        if (empty($subject_id)) {
            $subject_id = $this->input->post('subject_id');
        }
        if (empty($works_no)) {
            $works_no = $this->input->post('works_no');
        }

        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['works_no'] = $works_no;
        $workData = $this->works_m->getOne($class_id,$course_id,$subject_id,$works_no);
        $st = $this->student_m->getOne($workData['student_id']);
        $workData['student_name'] = $st['student_name'];
        $data = array_merge($data, $workData);
        $this->load->view('works_grade_v',$data);
    }

    public function works_grade_exec(){
        $data = array();

        $class_id = $this->input->post('class_id');
        $course_id = $this->input->post('course_id');
        $subject_id = $this->input->post('subject_id');
        $works_no = $this->input->post('works_no');
        $userinfo = $this->session->userdata('user');
        $user_id = $this->session->userdata('user_id');
        $works_scores = $this->input->post('works_scores');
        $works_comment = $this->input->post('works_comment');
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['works_no'] = $works_no;
        $insData =array();
        $user = $this->user_m->getOne($user_id);
        $student = $this->student_m->getStudentId($user['0']['user']);
        $student_id = $student['student_id'];
        $insData['class_id'] = $class_id;
        $insData['course_id'] = $course_id;
        $insData['subject_id'] = $subject_id ;
        $insData['student_id'] = $student_id ;
        $insData['works_no'] =$works_no;
        $insData['works_path']  = '';
        $insData['works_scores']  = $works_scores;
        $insData['works_comment']  = $works_comment;
        $insData['delete_flg'] =0;
        $insData['insert_user'] = $userinfo;
        $insData['insert_time'] = date("Y-m-d H:i:s");
        $insData['update_user'] = $userinfo;
        $insData['update_time'] = date("Y-m-d H:i:s");
        $this->works_m->update($insData);

        redirect("works_c/works_lst/".$class_id."/".$course_id."/".$subject_id);
    }

    public function works_download_exec(){
        $data = array();

        $class_id = $this->input->post('class_id');
        $course_id = $this->input->post('course_id');
        $subject_id = $this->input->post('subject_id');
        $search_key = $this->input->post('txtKey');
        $data['search_key'] = $search_key;
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        $data['txtKey'] = $search_key;
        $workData = $this->works_m->getList($search_key,$class_id,$course_id,$subject_id);
        $files = $this->code_m->getList("11");
        $files_path = $files['FILES_PATH']['1'];
        $temp_path = $files['FILES_PATH']['3'];

        if(!file_exists($temp_path)){
            mkdir($temp_path,0777,true);
        }
        $zipfile = "files".date("YmdHis").".zip";
        $zip = new ZipArchive;
        $res = $zip->open($temp_path.$zipfile, ZipArchive::CREATE);
        if ($res == true) {
            foreach($workData as &$temp){
                if (empty($temp["remarks"])) {
                    $works_path = $temp["works_path"];
                } else {
                    $works_path = $temp["remarks"];
                }
                $path = $files_path.$works_path;
                if(file_exists($path)){
                    $zip->addFile($path, self::getFName($works_path));
                }
            }
           $zip->close();
        }
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$zipfile.'"');
        readfile($temp_path.$zipfile);
    }

    public function works_download_one_exec(){
        $data = array();

        $pathLst = $this->code_m->getList("11");
        $path = $pathLst['FILES_PATH']['1'];

        $class_id = $this->input->post('class_id');
        $course_id = $this->input->post('course_id');
        $subject_id = $this->input->post('subject_id');
        $works_no = $this->input->post('works_no');
        $user_id = $this->session->userdata('user_id');
        $workData = $this->works_m->getOne($class_id,$course_id,$subject_id,$works_no);
        if (empty($workData["remarks"])) {
            $works_path = $workData["works_path"];
        } else {
            $works_path = $workData["remarks"];
        }
        $filename = $works_no.".".self::getExt($works_path);
        $filepath =  $path.$works_path;
        if(file_exists($filepath)){
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            readfile($filepath);
        }
     }

    private function getExt($str){
        $arr = explode(".",$str);
        return $arr[count($arr)-1];
    }

    private function getFName($prm){
        $strs=explode('/',$prm);
        return $strs[count($strs)-1];
    }
}