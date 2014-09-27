<?php require_once("_header.php");?>
<script type="text/javascript">
    var studentData = <?php echo $studentData?>;
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
            { display: '评分', name: 'scores', align: 'left', width: 80 }
            ],
            pageSize:10,
            data: $.extend(true,{},studentData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function returnPage() {
        var class_id = document.form.class_id.value;
        var course_id = document.form.course_id.value;
        location.href='<?php echo SITE_URL;?>/evaluation_c/subject_lst/'+class_id+"/"+course_id;
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <input type="button" value=" 返 回 " onclick="returnPage()"/>&nbsp
            <input type="hidden" name="class_id" id="class_id" value="<?php echo @$class_id?>" />
            <input type="hidden" name="course_id" id="course_id" value="<?php echo @$course_id?>" />
            <input type="hidden" name="subject_id" id="subject_id" value="<?php echo @$subject_id?>" />
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
