<?php
class Works_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100102");
        $this->load->model('class_m','class_m');
        $this->load->model('works_m','works_m');
    }

    public function index()
    {
        $data = array();
        $classData = array();

        log_message('info', "works_c index post:".var_export($_POST,true));

        $data['search_key'] =  $this->input->post('txtKey');
        $classData = $this->class_m->getList($data);

        foreach($classData as &$temp){
            $temp['class_no']="<a href=\"".SITE_URL."/works_c/subject_lst/".
                              $temp['class_id']."/".$temp['course_id']."\">".$temp['class_no']."</a>";
        }

        $data['classData'] = @json_encode(array('Rows'=>$classData));
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
        $search_key = $this->input->post('txtKey');
        $data['search_key'] = $search_key;
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $subjectData = $this->class_m->getSubjectList($class_id,$course_id,$search_key);

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
            $temp['subject_id']="<a href=\"".SITE_URL."/works_c/works_lst/".$temp['class_id']."/".
                                $temp['course_id']."/".$temp['subject_id']."\">".$temp['subject_id']."</a>";
        }

        $data['subjectData'] = @json_encode(array('Rows'=>$subjectData));
        $this->load->view('works_subject_v',$data);
    }
    public function works_lst($class_id=null,$course_id=null,$subject_id=null){
        $data = array();

		$this->load->model('student_m','student_m');
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
		foreach($workData as &$value){
			$st = $this->student_m->getOne($value['student_id']);
			$value['student_name'] = $st['student_name'];
			$value['works_no']="<a href=\"".SITE_URL."/works_c/works_detail/".$value['class_id']."/".
                                $value['course_id']."/".$value['subject_id']."/".$value['works_no']."\">".$value['subject_id']."</a>";
		}
        $data['workData'] = @json_encode(array('Rows'=>$workData));
        $this->load->view('works_lst_v',$data);
    }
    public function works_detail($class_id=null, $course_id=null, $subject_id=null, $works_no=null){
        $data = array();

		$this->load->model('student_m','student_m');
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
		//foreach($workData as &$value){
			$st = $this->student_m->getOne($workData['student_id']);
			$workData['student_name'] = $st['student_name'];
			//$value['works_no']="<a href=\"".SITE_URL."/works_c/works_detail/".$value['class_id']."/".
                                //$value['course_id']."/".$value['subject_id']."/".$value['works_no']."\">".$value['subject_id']."</a>";
		//}
        $data = array_merge($data, $workData);
        $this->load->view('works_detail_v',$data);
    }
   public function works_upload_init($class_id=null, $course_id=null, $subject_id=null){
        $data = array();

		$this->load->model('student_m','student_m');
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
        //$data['works_no'] = $works_no;
       
        $this->load->view('works_upload_v',$data);
    }
   public function works_upload_exec($class_id=null, $course_id=null, $subject_id=null){
        $data = array();

		$this->load->model('student_m','student_m');
        if (empty($class_id)) {
            $class_id = $this->input->post('class_id');
        }
        if (empty($course_id)) {
            $course_id = $this->input->post('course_id');
        }
        if (empty($subject_id)) {
            $subject_id = $this->input->post('subject_id');
        }
        
        $varYear="year";
         $varMonth="month";
         $varDay="day";
         $varSecondName="second_name";
         $filename=$$varYear.$$varMonth.$$varDay;

        //for($k=0;$k<6;$k++){
           for($j=0;$j<count($_FILES["upfile"]["tmp_name"]);$j++){
             //echo "upfile".$k."<br>";
             $file=$_FILES["upfile".$k]["tmp_name"][$j];
             $name=$_FILES["upfile".$k]["name"][$j];
             $imageUpload = uploadfile($file, $name, $filename, $errmsg);
             if($errmsg=="" && !empty($imageUpload)){
            		$sql = " INSERT INTO images (name,second_name,path	 ) VALUES ( ";
            		$sql.= $filename;
            		$sql.=",'".$$varSecondName."'";
            		$sql.=($imageUpload==""?",''":",'".$imageUpload."'");
            		$sql.=");";
            		//print "sql".$sql."<br>";
            		if (!(mysql_query($sql))) {
            			//err page 
            		}
             }	
           }
        //}
        
        
        $data['class_id'] = $class_id;
        $data['course_id'] = $course_id;
        $data['subject_id'] = $subject_id;
        
        //$this->load->view('works_detail_v',$data);
        redirect("works_c/work_lst/".$class_id."/".$course_id."/".$subject_id);
    }
    function uploadfile($file,$name,$filename,&$errmsg){
    	$root="./";
    
    	if (is_uploaded_file($file)) {
    		$temp = explode(".", $name);
    
    		if(count($temp)>1){
    			$ext=$temp[count($temp)-1];
    			if(strtolower($ext)!="jpg" && strtolower($ext)!="png" && strtolower($ext)!="gif"){
    				$errmsg.="not support file type!";
    			}
    		}else{
    			$errmsg.="file can't be empty!";
    		}
    
    		if($errmsg==""){
    			$filepath = $root."upload/image";
                $fullname=$filepath."/".$filename.".".$ext;
                if(file_exists($fullname)){
                  $fullname=$filepath."/".$filename."_".mt_rand(1,999999).".".$ext;
                }
    			if (move_uploaded_file($file, $fullname)) {
    			} else {
    				echo "move_uploaded_file error";
    			}
                $thumb = new Imagick($fullname);
                $d = $thumb->getImageGeometry(); 
                $w = intval($d['width']); 
                $h = intval($d['height']); 
                $newWidth = round(($w/$h)*300.0);
                
                $thumb->resizeImage($newWidth,300,Imagick::FILTER_LANCZOS,1);
                $thumb->writeImage($fullname);
                
                $thumb->destroy(); 
    			
    		}
    		//return "../upload/tmp".$_SESSION['userid']."/".$filename.".".$ext;
    		return $fullname;
    	}else{
    		return "";
    	}
    	
    }
}