<?php
class Art_c extends MY_Controller {
    public function __construct()
    {
        parent::__construct("100302");
        $this->load->model('works_m','works_m');
        $this->load->model('code_m','code_m');
    }

    public function index()
    {
        $data = array();
        $searchData = array();
        $data['start_year'] = "";
        $data['start_month'] = "";
        $data['scores_from'] = "";
        $data['scores_to'] = "";
        $data['txtKey'] = "";
        $data['paging'] = 1;
        $data['paging_max'] = 1;
        $data['searchData'] = $searchData;
        $this->load->view('art_lst_v',$data);
    }

    public function search()
    {
        $data = array();
        $searchData = array();
        log_message('info', "art_c search post:".var_export($_POST,true));

        $start_year = $this->input->post('start_year');
        $start_month = $this->input->post('start_month');
        $scores_from = $this->input->post('scores_from');
        $scores_to = $this->input->post('scores_to');
        $keyword = $this->input->post('txtKey');
        $paging = $this->input->post('paging');
        $download_flg = $this->input->post('download_flg');

        $data['start_year'] = $start_year;
        $data['start_month'] = substr('0'.$start_month,-2);
        $data['scores_from'] = $scores_from;
        $data['scores_to'] = $scores_to;
        $data['txtKey'] = $keyword;
        $data['paging'] = $paging;
        $paging_max = $this->works_m->getPagingMax($data);
        $data['paging_max'] = ceil($paging_max/8);
        $searchData = $this->works_m->search($data);
        $data['searchData'] = $searchData;
        if (count($searchData) == 0) {
            $data['paging'] = 1;
            $data['paging_max'] = 1;
        }
        $files = $this->code_m->getList("11");
        $files_path = $files['FILES_PATH']['1'];
        $data['files_path'] = $files_path;
        if ($download_flg == "1") {
            $user_id = $this->session->userdata('user_id');
            $zipfile = $user_id."_".date("YmdHis").".zip";
            $zip = new ZipArchive;
            $res = $zip->open($files_path.$zipfile, ZipArchive::CREATE);
            if ($res == true) {
                foreach($searchData as &$temp){
                    $path = $files_path.$temp['works_path'];
                    $zip->addFile($path, self::getFName($temp['works_path']));
                }
               $zip->close();
            }

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$zipfile.'"');
            readfile($files_path.$zipfile);
        }else{
          $this->load->view('art_lst_v',$data);
        }
    }
    private function getFName($prm){
        $strs=explode('/',$prm);
        return $strs[count($strs)-1];
    }
}