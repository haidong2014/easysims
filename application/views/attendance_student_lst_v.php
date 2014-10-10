<?php require_once("_header.php");?>
<script type="text/javascript">
    var studentData = <?php echo $studentData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '日期', name: 'today', align: 'left', width: 80 },
            { display: '出勤状况(上午)', name: 'am_status', align: 'left', width: 200 },
            { display: '出勤状况(下午)', name: 'pm_status', align: 'left', width: 200 }
            ],
            pageSize:10,
            data: $.extend(true,{},studentData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function returnPage() {
        var class_id = document.form.class_id.value;
        location.href='<?php echo SITE_URL;?>/attendance_c/student_lst/'+class_id;
    }
    function search_click()
    {
        document.form.submit();
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
<form name="form" method="post" action="<?php echo SITE_URL.'/attendance_c/show_student';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp年月:
            <select name="start_year" id="start_year" ltype="select" ligeruiid="start_year" onchange="search_click()">
                <?php for($i=0;$i<12;$i++){ ?>
                    <?php if(@$start_year==($i+2010)){ ?>
                        <option value="<?php echo ($i+2010); ?>" selected><?php echo ($i+2010); ?></option>
                    <?php } else {?>
                        <option value="<?php echo ($i+2010); ?>"><?php echo ($i+2010); ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <select name="start_month" id="start_month" ltype="select" ligeruiid="start_month" onchange="search_click()">
                <?php for($i=0;$i<12;$i++){ ?>
                  <?php if(@$start_month==($i+1)){ ?>
                      <option value="<?php echo ($i+1); ?>" selected><?php echo ($i+1); ?></option>
                  <?php } else {?>
                      <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
                  <?php } ?>
                <?php } ?>
            </select>&nbsp
            <input type="button" value=" 返 回 " onclick="returnPage()" />&nbsp 学生姓名：<?php echo $student_name?>
            <input type="hidden" name="class_id" value="<?php echo @$class_id?>" />
            <input type="hidden" name="student_id" value="<?php echo @$student_id?>" />
        </tr>
    </table>
<br>
<div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
