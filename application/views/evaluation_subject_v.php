<?php require_once("_header.php");?>
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
            { display: '教师满意度评价', name: 'evaluation', align: 'left', width: 120 },
            { display: '教师出勤评价', name: 'attendance', align: 'left', width: 120 }
            ],
            pageSize:10,
            where : f_getWhere(),
            data: $.extend(true,{},subjectData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function f_search()
    {
        grid.options.data = $.extend(true, {}, CustomersData);
        grid.loadData(f_getWhere());
    }
    function f_getWhere()
    {
        if (!grid) return null;
        var clause = function (rowdata, rowindex)
        {
            var key = $("#txtKey").val();
            return rowdata.CustomerID.indexOf(key) > -1;
        };
        return clause;
    }
    function returnPage() {
        location.href='<?php echo SITE_URL;?>/evaluation_c';
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/evaluation_c/subject_lst';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp科目名称：
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
