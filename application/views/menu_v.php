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
                $("#layout1").ligerLayout({ leftWidth: 190, height: '100%',heightDiff:-34,space:4, onHeightChanged: f_heightChanged });

                var height = $(".l-layout-center").height();

                //Tab
                $("#framecenter").ligerTab({ height: height });

                //面板
                $("#accordion1").ligerAccordion({ height: height - 24, speed: null });

                $(".l-link").hover(function ()
                {
                    $(this).addClass("l-link-over");
                }, function ()
                {
                    $(this).removeClass("l-link-over");
                });

                tab = $("#framecenter").ligerGetTabManager();
                accordion = $("#accordion1").ligerGetAccordionManager();
                tree = $("#tree1").ligerGetTreeManager();
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
    <div class="l-topmenu-logo">易用学生管理系统</div>
    <div class="l-topmenu-welcome">
         <a href="" class="l-link2" target="_blank">退出</a>
    </div> 
    </div>
    <div id="layout1" style="width:99.2%; margin:0 auto; margin-top:4px; "> 
        <div position="left"  title="主要菜单" id="accordion1"> 
            <div title="招生管理">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage01','学生信息登录','student_add.htm')">学生信息登录</a> 
				<a class="l-link" href="javascript:f_addTab('listpage02','学生信息一览','student_lst.htm')">学生信息一览</a> 
            </div>
            <div title="日常管理">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage03','出勤信息一览','demos/case/listpage.htm')">出勤信息一览</a> 
                <a class="l-link" href="javascript:f_addTab('listpage04','作品信息一览','demos/case/listpage.htm')">作品信息一览</a> 
                <a class="l-link" href="javascript:f_addTab('listpage05','评价信息一览','demos/case/listpage.htm')">评价信息一览</a> 
            </div>    
            <div title="就业管理">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage06','就业信息登录','demos/case/listpage.htm')">就业信息登录</a> 
            </div> 
            <div title="高级查询">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage07','高级信息查询','demos/case/listpage.htm')">高级信息查询</a> 
            </div> 
            <div title="基础信息">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage08','学生信息一览','demos/case/listpage.htm')">学生信息一览</a> 
                <a class="l-link" href="javascript:f_addTab('listpage09','教师信息一览','<?php echo SITE_URL;?>/teacher_c')">教师信息一览</a> 
                <a class="l-link" href="javascript:f_addTab('listpage10','班级信息一览','demos/case/listpage.htm')">班级信息一览</a> 
                <a class="l-link" href="javascript:f_addTab('listpage11','课程信息一览','demos/case/listpage.htm')">课程信息一览</a> 
            </div> 
            <div title="用户管理">
                <div style=" height:5px;"></div>
                <a class="l-link" href="javascript:f_addTab('listpage12','系统用户设定','demos/case/listpage.htm')">系统用户设定</a> 
                <a class="l-link" href="javascript:f_addTab('listpage13','系统权限设定','demos/case/listpage.htm')">系统权限设定</a> 
            </div> 
        </div>
        <div position="center" id="framecenter"> 
            <div tabid="home" title="我的主页" style="height:300px" >
                <iframe frameborder="0" name="home" id="home" src="<?php echo SITE_URL;?>/welcome.htm"></iframe>
            </div> 
        </div> 
    </div>
    <div  style="height:32px; line-height:32px; text-align:center;">
            Copyright © 2014 www.easytech.com
    </div>
    <div style="display:none"></div>
</body>
</html>
