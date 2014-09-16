<?php require_once("_header.php");?>
<script type="text/javascript">
    var subjectData = <?php echo $subjectData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '科目编号', name: 'subject_id', align: 'left', width: 80 },
            { display: '科目名称', name: 'subject_name', align: 'left', width: 200 },
            { display: '周期', name: 'period', align: 'left', width: 80 },
            { display: '开始日期', name: 'start_date', align: 'left', width: 120 },
            { display: '结束日期', name: 'end_date', align: 'left', width: 120 },
            { display: '任课教师', name: 'teacher_name', align: 'left', width: 120 }
            ],
            pageSize:10,
            where : f_getWhere(),
            data: $.extend(true,{},subjectData),
            width: '100%',height:'60%'
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
        class_id = document.form.class_id.value;
        location.href='<?php echo SITE_URL;?>/class_c/view_class_init/'+class_id;
    }
</script>
<style type="text/css">
    body{ font-size:12px;}
    .l-table-edit {}
    .l-table-edit-td{ padding:4px;}
    .l-button-submit,.l-button-reset{width:80px; float:left; margin-left:10px; padding-bottom:2px;}
    .l-verify-tip{ left:230px; top:120px;}
</style>
</head>

<body style="padding:10px">
<div id="pageloading"></div>
<form name="form" method="post" action="" id="form">
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
    <br>
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
    <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id ?>" />
    <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id ?>" />
</form>
<div style="display:none"></div>
</body>
</html>