<?php require_once("_header.php");?>
<script type="text/javascript">
    var studentData = <?php echo $studentData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '学生编号', name: 'student_no', align: 'left', width: 120 },
            { display: '学生姓名', name: 'student_name', align: 'left', width: 120 },
            { display: '联络方式', name: 'contact_way', align: 'left', width: 120 },
            { display: '出勤状况(上午)', name: 'attendance_am', align: 'left', width: 200 },
            { display: '出勤状况(下午)', name: 'attendance_pm', align: 'left', width: 200 }
            ],
            pageSize:50,
            data: $.extend(true,{},studentData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
  function returnPage() {
      var class_id = document.form.class_id.value;
      location.href='<?php echo SITE_URL;?>/attendance_c/student_lst/'+class_id;
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
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/attendance_c/add_attendance';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp日期：<?php echo $today?>&nbsp
            <input type="submit" value=" 提交 " />&nbsp
            <input type="button" value=" 返 回 " onclick="returnPage()" />
            <input type="hidden" name="class_id" value="<?php echo @$class_id?>" />
            <input type="hidden" name="today" value="<?php echo @$today?>" />
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
