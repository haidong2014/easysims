﻿<?php require_once("_header.php");?>
<script type="text/javascript">
    var subjectData = <?php echo $subjectData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '科目编号', name: 'subject_id', align: 'left', width: 80 },
            { display: '科目名称', name: 'subject_name', align: 'left', width: 160 },
            { display: '周期', name: 'period', align:'left', width: 80 },
            { display: '开始日期', name: 'start_date',  align: 'left', width: 80 },
            { display: '结束日期', name: 'end_date', align: 'left', width: 80 },
            { display: '任课教师', name: 'teacher_name', align: 'left', width: 80 },
            { display: '作品个数', name: 'numbers', align: 'left', width: 80 },
            { display: '作品平均分', name: 'scores', align: 'left', width: 80 }
            ],
            pageSize:10,
            data: $.extend(true,{},subjectData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function returnPage() {
        location.href='<?php echo SITE_URL;?>/works_c';
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/works_c/subject_lst';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp班级名称：
            <input name="txtKey" id="txtKey" type="text" maxlength="20" style="width:200px" value="<?php echo @$search_key ?>" />&nbsp
            <input type="submit" value=" 查 询 " />&nbsp
            <input type="button" value=" 返 回 " onclick="returnPage()"/>&nbsp
            <input type="hidden" name="class_id" id="class_id" value="<?php echo @$class_id?>" />
            <input type="hidden" name="course_id" id="course_id" value="<?php echo @$course_id?>" />
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
