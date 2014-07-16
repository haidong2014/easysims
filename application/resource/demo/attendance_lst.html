<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>学生出勤一览</title>
    <link href="lib/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <script src="lib/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="lib/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="lib/ligerUI/js/plugins/ligerGrid.js" type="text/javascript"></script> 
    <script src="AttendanceLstData.js" type="text/javascript"></script>
    <script type="text/javascript">
        var grid = null;
        $(function () {
            grid = $("#maingrid").ligerGrid({
                columns: [
                { display: '学生编号', name: 'StudentNo', align: 'left', width: 80 },
                { display: '学生姓名', name: 'StudentName', align: 'left', width: 160 },
                { display: '手机号码', name: 'Telephone', align: 'left', width: 160 },
                { display: '出勤次数', name: 'AttendanceStatus_1' , width: 80},
                { display: '迟到次数', name: 'AttendanceStatus_2' , width: 80},
                { display: '请假次数', name: 'AttendanceStatus_3' , width: 80},
                { display: '旷课次数', name: 'AttendanceStatus_4' , width: 80}
                ],  
                pageSize:10,
                where : f_getWhere(),
                data: $.extend(true,{},AttendanceLstData), 
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
		function regist_click()
        {
			location.href = "attendance_add.html";
        }

        function returnPage() {
            location.href = "attendance_class.html";
        }
    </script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div> 
<div id="searchbar">
    编号或姓名：<input id="txtKey" type="text" />
    <input id="button" type="button" value=" 查 询 " onclick="f_search()" />
	<input id="regist" type="button" value=" 点 名 " onclick="regist_click()" />
    <input id="search" type="button" value=" 返 回 " onclick="returnPage()" />
</div>
<br>
<div id="maingrid" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
</body>
</html>
