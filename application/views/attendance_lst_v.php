﻿<?php require_once("_header.php");?>
<script type="text/javascript">
    var studentData = <?php echo $studentData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '学生编号', name: 'student_no', align: 'left', width: 80 },
            { display: '学生姓名', name: 'student_name', align: 'left', width: 160 },
            { display: '联络方式', name: 'contact_way', align: 'left', width: 160 },
            { display: '出勤次数', name: 'AttendanceStatus_1' , width: 80},
            { display: '迟到次数', name: 'AttendanceStatus_2' , width: 80},
            { display: '请假次数', name: 'AttendanceStatus_3' , width: 80},
            { display: '旷课次数', name: 'AttendanceStatus_4' , width: 80}
            ],
            pageSize:10,
            where : f_getWhere(),
            data: $.extend(true,{},studentData),
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
    function attendance_click(){
        var class_no = document.form.txtClassNo.value;
        location.href = '<?php echo SITE_URL;?>/attendance_c/add_attendance_init/' + class_no;
    }
    function returnPage() {
        location.href='<?php echo SITE_URL;?>/attendance_c';
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/attendance_c/search_student';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp学生姓名：
            <input name="txtKey" id="txtKey" type="text" maxlength="20" style="width:200px" value="<?php echo @$search_key ?>" />&nbsp
            <input type="submit" value=" 查 询 " />&nbsp
            <input id="attendance" type="button" value=" 点 名 " onclick="attendance_click()" />&nbsp
            <input id="return" type="button" value=" 返 回 " onclick="returnPage()" />
            <input type="hidden" name="txtClassNo" value="<?php echo @$class_no?>" />
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
