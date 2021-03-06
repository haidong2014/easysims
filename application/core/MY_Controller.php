<?php
class MY_Controller extends CI_Controller
{
    function __construct($url_id = null)
    {
        parent::__construct();

        $this->load->database('default');
        $this->load->helper('url');
        $this->load->library('session');

        $user = $this->session->all_userdata();

        $role_id = $this->session->userdata('role_id');
        if (empty($role_id)){
            redirect("login_c");
        }

        //$url_id = 100001 招生信息录入
        //$url_id = 100101 学生出勤管理
        //$url_id = 100102 学生作品管理
        //$url_id = 100103 课程评价管理
        //$url_id = 100201 就业信息录入
        //$url_id = 100301 高级查询
        //$url_id = 100302 作品展示
        //$url_id = 100303 学生评价查询
        //$url_id = 100304 教师评价查询
        //$url_id = 100401 课程信息维护
        //$url_id = 100402 班级信息维护
        //$url_id = 100403 教师信息维护
        //$url_id = 100404 学生信息维护
        //$url_id = 100405 就业信息维护
        //$url_id = 100501 系统角色设定
        //$url_id = 100502 系统用户设定
        //$url_id = 100503 系统权限设定
        //$url_id = 100601 校长留言
        $roleflg = "0";
        if (!empty($url_id)) {
            $this->load->model('rolesetup_m','rolesetup_m');
            $url = $this->rolesetup_m->getURL($role_id);

            for ($i=0; $i<count($url); $i++){
                if ($url_id == $url[$i]['url_id']){
                   break;
                }
                if ("100001" == $url[$i]['url_id']){
                   $roleflg = "1";
                } else if ("100201" == $url[$i]['url_id']) {
                   $roleflg = "1";
                } else {
                }
            }
            //具备招生信息和就业信息权限就可以操作学生信息。
            if ($url_id == "100404") {
                if ($roleflg == "1") {
                    return;
                }
            }
            if($i == count($url)){
                redirect("errorpage_c");
            }
        }
    }
}

class Login_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->database('default');
        $this->load->helper('url');
        $this->load->library('session');
    }
}

class Other_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

    }
}