<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="zh-cn">
<head>
    <title>易用学生管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/default.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/ligerui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
            var tab = null;
            var accordion = null;
            var tree = null;
            $(function ()
            {

                //布局
                $("#layout").ligerLayout({ leftWidth: 190, height: '100%',heightDiff:-34,space:4, onHeightChanged: f_heightChanged });

                var height = $(".l-layout-center").height();

                //Tab
                $("#framecenter").ligerTab({ height: height });

                //面板
                $("#accordion").ligerAccordion({ height: height - 24, speed: null });

                $(".l-link").hover(function ()
                {
                    $(this).addClass("l-link-over");
                }, function ()
                {
                    $(this).removeClass("l-link-over");
                });

                tab = $("#framecenter").ligerGetTabManager();
                accordion = $("#accordion").ligerGetAccordionManager();
                $("#pageloading").hide();

            });
            function f_heightChanged(options)
            {
                if (tab)
                    tab.addHeight(options.diff);
                if (accordion && options.middleHeight - 24 > 0)
                    accordion.setHeight(options.middleHeight - 24);
            }
            function f_addTab(tabid,text, url)
            {
                tab.addTabItem({ tabid : tabid,text: text, url: url });
            }
     </script>

</head>
<body style="padding:0px;background:#EAEEF5;">
    <div id="pageloading"></div>
    <div id="topmenu" class="l-topmenu">
    <div ><font color=white size="4">&nbsp&nbsp易用学生信息管理系统</font></div>
    <div class="l-topmenu-welcome">
         <a href="" class="l-link2" target="_blank">退出</a>
    </div>
    </div>
    <div id="layout" style="width:99.2%; margin:0 auto; margin-top:4px; ">
        <div position="left"  title="主要菜单" id="accordion">
            <div title="招生管理">
                <div style=" height:5px;"></div>
        <a class="l-link" href="javascript:f_addTab('listpage01','招生信息录入','enrol_students_class.html')">招生信息录入</a>
            </div>
            <div title="学生管理">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage02','出勤信息一览','attendance_class.html')">学生出勤管理</a>
                <a class="l-link" href="javascript:f_addTab('listpage03','作品信息一览','works_class.html')">学生作品管理</a>
                <a class="l-link" href="javascript:f_addTab('listpage04','课程评价一览','evaluation_class.html')">课程评价管理</a>
            </div>
            <div title="就业管理">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage05','就业信息录入','obtain_employment_class.html')">就业信息录入</a>
            </div>
            <div title="高级查询">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage06','高级查询','search_lst.html')">高级查询</a>
                <a class="l-link" href="javascript:f_addTab('listpage07','作品展示','art_lst.html')">作品展示</a>
            </div>
            <div title="基础信息">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage08','课程信息维护','course_lst.html')">课程信息维护</a>
                <a class="l-link" href="javascript:f_addTab('listpage09','班级信息维护','class_lst.html')">班级信息维护</a>
                <a class="l-link" href="javascript:f_addTab('listpage10','教师信息维护','<?php echo SITE_URL;?>/teacher_c')">教师信息维护</a>
                <a class="l-link" href="javascript:f_addTab('listpage11','学生信息维护','student_lst.html')">学生信息维护</a>
            </div>
            <div title="用户权限">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage12','系统角色设定','usergroups_lst.html')">系统角色设定</a>
                <a class="l-link" href="javascript:f_addTab('listpage13','系统用户设定','user_lst.html')">系统用户设定</a>
                <a class="l-link" href="javascript:f_addTab('listpage14','系统权限设定','role_setup.html')">系统权限设定</a>
            </div>
            <div title="校长留言">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage15','校长留言','message_lst.html')">校长留言</a>
            </div>
        </div>
        <div position="center" id="framecenter">
            <div tabid="home" title="我的主页" style="height:300px" >
                <iframe frameborder="0" name="home" id="home" src="<?php echo SITE_URL;?>/welcome_c"></iframe>
            </div>
        </div>
    </div>
    <div  style="height:32px; line-height:32px; text-align:center;">
            Copyright © 2014 www.crystaledu.com
    </div>
    <div style="display:none"></div>
</body>
</html>
