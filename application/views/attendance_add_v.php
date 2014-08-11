﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>学生点名</title>
    <link href="lib/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <script src="lib/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="lib/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="lib/ligerUI/js/plugins/ligerGrid.js" type="text/javascript"></script> 
    <script src="AttendanceAddData.js" type="text/javascript"></script>
    <script type="text/javascript">
        var grid = null;
        $(function () {
            grid = $("#maingrid").ligerGrid({
                columns: [
                { display: '学生编号', name: 'StudentNo', align: 'left', width: 120 },
                { display: '学生姓名', name: 'StudentName', align: 'left', width: 120 },
                { display: '手机号码', name: 'Telephone', align: 'left', width: 120 },
                { display: '出勤状况(上午)', name: 'AttendanceStatusAM', align: 'left', width: 200 },
                { display: '出勤状况(下午)', name: 'AttendanceStatusPM', align: 'left', width: 200 }
                ],  
                pageSize:10,
                where : f_getWhere(),
                data: $.extend(true,{},AttendanceAddData), 
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
			location.href = "attendance_lst.html";
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
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<br>
<div id="searchbar">
    日期：2014-07-01
</div>
<div id="maingrid" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
<br>
<div id="maingrid" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
<input type="submit" value="提交" class="l-button l-button-submit" /> 
<input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
</body>
</html>
