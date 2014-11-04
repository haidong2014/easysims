<?php require_once("_header.php");?>

<script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerForm.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerDateEditor.js" type="text/javascript"></script>

<script type="text/javascript">
    var studentData = <?php echo $studentData?>;
    var grid = null;
    $(function () {
        $("form").ligerForm();

        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '学生编号', name: 'student_no', align: 'left', width: 80 },
            { display: '学生姓名', name: 'student_name', align: 'left', width: 160 },
            { display: '联络方式', name: 'contact_way', align: 'left', width: 160 },
            { display: '出勤次数', name: 'status_1' , width: 80},
            { display: '迟到次数', name: 'status_2' , width: 80},
            { display: '请假次数', name: 'status_3' , width: 80},
            { display: '旷课次数', name: 'status_4' , width: 80}
            ],
            pageSize:10,
            data: $.extend(true,{},studentData),
            width: '100%',height:'100%'
        });
        $("#pageloading").hide();
    });
    function attendance_click(){
        var class_id = document.form.class_id.value;
		var attendance_date = document.form.attendance_date.value;
        location.href = '<?php echo SITE_URL;?>/attendance_c/add_attendance_init/' + class_id + "/" + attendance_date;
    }
    function returnPage() {
        location.href='<?php echo SITE_URL;?>/attendance_c';
    }
</script>
<style type="text/css">
    body{ font-size:12px;}
    .l-table-edit {}
    .l-table-edit-td{ padding:2px;}
    .l-button-submit,.l-button-reset{width:80px; float:left; margin-left:10px; padding-bottom:2px;}
    .l-verify-tip{ left:230px; top:120px;}
</style>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/attendance_c/student_lst';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <td align="left" class="l-table-edit-td">
                开始日期：
            </td>
            <td align="left" class="l-table-edit-td">
                <input name="start_date" type="text" id="start_date" ltype="date" value="<?php echo @$start_date?>" />
            </td>
            <td align="left" class="l-table-edit-td">
                结束日期：
            </td>
            <td align="left" class="l-table-edit-td">
			    <input name="end_date" type="text" id="end_date" ltype="date" value="<?php echo @$end_date?>" />
            </td>
            <td align="left" class="l-table-edit-td">
                学生姓名：
            </td>
            <td align="left" class="l-table-edit-td">
                <input name="txtKey" id="txtKey" type="text" maxlength="20" style="width:200px" value="<?php echo @$search_key ?>" />
            </td>
            <td align="left" class="l-table-edit-td">
                <input type="submit" value=" 查 询 " />
            </td>
            <?php if($attendance_flg == '0'){ ?>
                <td align="left" class="l-table-edit-td">
                    <input name="attendance_date" type="text" id="attendance_date" ltype="date" value="<?php echo @$today?>" />
                </td>
                <td align="left" class="l-table-edit-td">
                    <input id="attendance" type="button" value=" 点 名 " onclick="attendance_click()" />
                </td>
            <?php } ?>
            <td align="left" class="l-table-edit-td">
                <input id="return" type="button" value=" 返 回 " onclick="returnPage()" />
            </td>
            <input type="hidden" name="class_id" value="<?php echo @$class_id?>" />
    </table>
    <span style="color:red">标准出勤次数：<?php echo @$attendance_sum ?>&nbsp&nbsp实际出勤次数：<?php echo @$attendance_fact ?>&nbsp&nbsp出勤比率：<?php echo @$attendance_percent ?></span>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
