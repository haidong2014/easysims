<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>教师信息登录</title>
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerForm.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerDateEditor.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerButton.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerRadio.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerTextBox.js" type="text/javascript"></script>
    <script type="text/javascript">
        var eee;
        $(function ()
        {
            $("form").ligerForm();
            $("#pageloading").hide();
        });

        function checkTeacher(){
            var teacher_id = document.form.teacher_id.value;
            var teacher_no = document.form.teacher_no.value;
            var teacher_no_old = document.form.teacher_no_old.value;
            if (teacher_id != null) {
                if (teacher_no != teacher_no_old) {
                    alert("教师编号不能变更！");
                    document.form.teacher_no.value = teacher_no_old;
                    return;
                }
            }
            var jqxhr = $.post("<?php echo SITE_URL.'/teacher_c/chk_teacher/';?>" + teacher_no, function(data) {
                showMsg(data);
            });
        }
        function showMsg(data){
          if (data != "") {
              alert(data.replace(/\"/g, ""));
              document.form.teacher_no.value = "";
          }
        }
        function addStudent(){
            txtTeacherNo = document.form.teacher_no.value;
            if (txtTeacherNo == ""){
                alert("请输入教师编号！");
                return;
            }
            txtTeacherName = document.form.teacher_name.value;
            if (txtTeacherName == ""){
                alert("请输入教师姓名！");
                return;
            }
            document.form.submit();
        }
        function returnPage(){
            location.href='<?php echo SITE_URL;?>/teacher_c';
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
<form name="form" method="post" action="<?php echo SITE_URL.'/teacher_c/add_teacher';?>" id="form">
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">教师编号:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="teacher_no" type="text" id="teacher_no" maxlength="10" onchange="checkTeacher()" value="<?php echo @$teacher_no ?>" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">教师姓名:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="teacher_name" type="text" id="teacher_name" maxlength="30" value="<?php echo @$teacher_name ?>" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td" valign="top">性别:</td>
                <td align="left" class="l-table-edit-td">
                    <input id="sex_0" type="radio" name="sex" value="1" <?php echo (@$sex==1?"checked":"")?>/><label for="sex_0">男</label>
                    <input id="sex_1" type="radio" name="sex" value="2" <?php echo (@$sex==2?"checked":"")?>/><label for="sex_1">女</label>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">出生日期:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="birthday" type="text" id="birthday" ltype="date" value="<?php echo @$birthday ?>" />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td" valign="top">专/兼职:</td>
                <td align="left" class="l-table-edit-td">
                    <input id="property_0" type="radio" name="property" value="1" <?php echo (@$property==1?"checked":"")?>/><label for="property_0">专</label>
                    <input id="property_1" type="radio" name="property" value="2" <?php echo (@$property==2?"checked":"")?>/><label for="property_1">兼</label>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">任课科目:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="course" type="text" id="course" maxlength="20" value="<?php echo @$course ?>" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">手机:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="telephone" type="text" id="telephone" maxlength="12" value="<?php echo @$telephone ?>" />
                </td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">Email:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="email" type="text" id="email" maxlength="30" value="<?php echo @$email ?>" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td" valign="top">系统用户:</td>
                <td align="left" class="l-table-edit-td">
                     <input id="system_user_0" type="checkbox" name="system_user" value="1" <?php echo (intval(@$system_user)==1?"checked":"")?> /><label for="system_user_0">有效</label>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">备注:</td>
                <td align="left" class="l-table-edit-td">
                    <textarea cols="100" rows="4" class="l-textarea" id="remarks" name="remarks" style="width:400px" maxlength="100"><?php echo @$remarks ?></textarea>
                </td><td align="left"></td>
            </tr>
        </table>
    <br>
    <input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo @$teacher_id?>" />
    <input type="hidden" name="teacher_no_old" id="teacher_no_old" value="<?php echo @$teacher_no?>" />
    <input type="button" value="提交" class="l-button l-button-submit" onclick="addStudent()"/>
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
</form>
<div style="display:none"></div>
</body>
</html>