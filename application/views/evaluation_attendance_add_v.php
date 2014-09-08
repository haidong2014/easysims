<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>教师出勤评价</title>
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerForm.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerSpinner.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerTextBox.js" type="text/javascript"></script>
    <script type="text/javascript">
        var eee;
        $(function ()
        {
            $("form").ligerForm();
            $("#pageloading").hide();
        });
        function addAttendance(){
            document.form.submit();
        }
        function returnPage(){
            var class_id = document.form.class_id.value;
            var course_id = document.form.course_id.value;
            location.href='<?php echo SITE_URL;?>/evaluation_c/subject_lst/'+class_id+"/"+course_id;
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
<form name="form" method="post" action="<?php echo SITE_URL.'/evaluation_c/attendance_add';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <td align="right" class="l-table-edit-td">班级名称:</td>
            <td align="left" class="l-table-edit-td">
                <?php echo @$class_name ?>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">课程名称:</td>
            <td align="left" class="l-table-edit-td">
                <?php echo @$course_name ?>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">科目名称:</td>
            <td align="left" class="l-table-edit-td">
                <?php echo @$subject_name ?>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">任课教师:</td>
            <td align="left" class="l-table-edit-td">
                <?php echo @$teacher_name ?>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">出勤分数:</td>
            <td align="left" class="l-table-edit-td">
                <input name="attendance_scores" type="text" id="attendance_scores" ltype='spinner' ligerui="{type:'int'}" value="<?php echo @$attendance_scores;?>"/>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">备注:</td>
            <td align="left" class="l-table-edit-td">
                <textarea cols="100" rows="4" class="l-textarea" id="remarks" name="remarks" style="width:400px" maxlength="1000"><?php echo @$remarks ?></textarea>
            </td>
            <td align="left"></td>
        </tr>
    </table>
    <br>
    <input type="hidden" name="class_id" id="class_id" value="<?php echo @$class_id?>" />
    <input type="hidden" name="course_id" id="course_id" value="<?php echo @$course_id?>" />
    <input type="hidden" name="subject_id" id="subject_id" value="<?php echo @$subject_id?>" />
    <input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo @$teacher_id?>" />
    <input type="button" value="提交" class="l-button l-button-submit" onclick="addAttendance()"/>
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
</form>
<div style="display:none"></div>
</body>
</html>