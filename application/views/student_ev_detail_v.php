<?php require_once("_header.php");?>
<script type="text/javascript">
    var searchData = <?php echo $searchData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '班级名称', name: 'class_name', align: 'left', width: 160 },
            { display: '课程名称', name: 'course_name', align: 'left', width: 160 },
            { display: '科目名称', name: 'subject_name', align: 'left', width: 160 },
            { display: '学生姓名', name: 'student_name', align: 'left', width: 160 },
            { display: '作品分数', name: 'works_scores', align: 'left', width: 80 },
            { display: '出勤分数', name: 'attendance_scores', align: 'left', width: 80 },
            { display: '课堂表现', name: 'performance_scores', align: 'left', width: 80 },
            { display: '课后作业', name: 'homework_scores', align: 'left', width: 80 },
            { display: '学生成绩', name: 'scores', align: 'left', width: 80 }
            ],
            pageSize:10,
            data: $.extend(true,{},searchData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function download_click(){
        document.form.download_flg.value = "1";
        document.form.submit();
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/student_ev_c/show_ev_detail';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <input id="search" type="button" value=" 返 回 " onclick="location.href='<?php echo SITE_URL.'/student_ev_c/index/1';?>'" />&nbsp
            <input id="search" type="button" value=" EXCEL批量下载 " onclick="download_click()" />
            <input type="hidden" name="download_flg" id="download_flg"/>
            <input type="hidden" name="student_id" value="<?php echo @$student_id?>" />
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
