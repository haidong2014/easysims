﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>班级课程详细设定</title>
    <link href="lib/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <script src="lib/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="lib/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="lib/ligerUI/js/plugins/ligerGrid.js" type="text/javascript"></script> 
    <script src="SetCourseData.js" type="text/javascript"></script>
    <script type="text/javascript">
    var courseData = <?php echo $subjectData?>;
        var grid = null;
        $(function () {
            grid = $("#maingrid").ligerGrid({
                columns: [
                { display: '科目编号', name: 'subject_no', align: 'left', width: 80 },
                { display: '科目名称', name: 'subject_name', align: 'left', width: 200 },
                { display: '周期', name: 'period', align: 'left', width: 80 },
                { display: '开始日期', name: 'start_date', align: 'left', width: 120 },
                { display: '结束日期', name: 'end_date', align: 'left', width: 120 },
                { display: '任课教师', name: 'teacher', align: 'left', width: 120 }
                ],  
                pageSize:10,
                where : f_getWhere(),
                data: $.extend(true,{},SetCourseData), 
                width: '100%',height:'90%'
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
			location.href = "'<?php echo SITE_URL;?>/class_c/add_class_init/<?php echo $class_id;?>'";
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
<form name="form" method="post" action="<?php echo SITE_URL;?>/class_c/save_subject" id="form">
	<br />
	<div id="maingrid" style="margin:0; padding:0"></div>
	<br />
	<input type="submit" value="保存" class="l-button l-button-submit" /> 
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
</form>
<div style="display:none"></div>
</body>
</html>