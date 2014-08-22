<?php
if(empty($sex)){
  $sex=1;
}
//echo $sex."###";
if(empty($property)){
  $property=1;
}
$action = SITE_URL."/student_c/add_student";
//echo $student_id."###";
if(!empty($student_id)){
  $action = SITE_URL."/student_c/upd_student";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>学生信息登录</title>
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerForm.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerDateEditor.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerComboBox.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerCheckBox.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerButton.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerDialog.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerRadio.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerSpinner.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerTextBox.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerTip.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/jquery-validation/jquery.metadata.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/jquery-validation/messages_cn.js" type="text/javascript"></script>

    <script type="text/javascript">
        var eee;
        $(function ()
        {
            $("form").ligerForm();
        });
        
        function checkUser(){
            if(document.getElementById('student_no').value==""){
            	alert('课程编号不能为空');return;
            }
            if(document.getElementById('student_name').value==""){
            	alert('课程名不能为空');return;
            }

            var user = document.form.student_no.value;
           
            var jqxhr = $.post("<?php echo SITE_URL.'/student_c/chk_repeat/';?>" + document.getElementById('student_no').value+'/'+'<?php echo @$student_no?>', function(data) {
                showMsg(data);
            });
        }
        function showMsg(data){
          if (data != "") {
              alert(data.replace(/\"/g, ""));
              document.form.student_no.value = "";
              return ;
          }
          //alert('111');
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
<body>
<div id="pageloading"></div>
  <a href="<?php echo SITE_URL;?>/student_c">学生一览</a>&nbsp>&nbsp
    <form name="form" method="post" action="<?php echo $action;?>" id="form">
    <div></div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">课程编号:</td>
                <td align="left" class="l-table-edit-td"><input name="student_no" type="text" id="student_no" ltype="text" value="<?php echo @$student_no ?>" validate="{required:true,maxlength:10}" /></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">课程名称:</td>
                <td align="left" class="l-table-edit-td"><input name="student_name" type="text" id="student_name" ltype="text" value="<?php echo @$student_name ?>" validate="{required:true,maxlength:30}" /></td>
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
                <td align="right" class="l-table-edit-td">年龄:</td>
                <td align="left" class="l-table-edit-td"><input name="age" type="text" id="age" ltype="text" value="<?php echo @$age ?>"  /></td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">卡号:</td>
                <td align="left" class="l-table-edit-td"><input name="id_card" type="text" id="id_card" ltype="text" value="<?php echo @$id_card ?>"  /></td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">联系方式 :</td>
                <td align="left" class="l-table-edit-td"><input name="contact_way" type="text" id="contact_way" ltype="text" value="<?php echo @$contact_way ?>"  /></td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">父母电话:</td>
                <td align="left" class="l-table-edit-td"><input name="parent_phone" type="text" id="parent_phone" ltype="text" value="<?php echo @$parent_phone ?>" /></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">课程(<input type="button" value="设定" onclick="setCourse()"/>):</td>
                <td align="left" class="l-table-edit-td">
					<select name="course_no" id="course_no" ltype="select">
						<?php foreach($courseData as $course){?>
    						<?php if(@$course_no==($course['course_no'])){ ?>
    						<option value="<?php  echo $course['course_no'] ?>" selected><?php  echo $course['course_name'] ?></option>
    						<?php }else{?>
    						<option value="<?php  echo $course['course_no'] ?>"><?php  echo $course['course_name'] ?></option>
    						<?php } ?>
						<?php } ?>
					</select>
					
                </td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">班级:</td>
                <td align="left" class="l-table-edit-td">
					<select name="class_no" id="class_no" ltype="select">
						<?php foreach($classData as $class){?>
    						<?php if(@$class_no==($class['class_no'])){ ?>
    						<option value="<?php  echo $class['class_no'] ?>" selected><?php  echo $class['class_name'] ?></option>
    						<?php }else{?>
    						<option value="<?php  echo $class['class_no'] ?>"><?php  echo $class['class_name'] ?></option>
    						<?php } ?>
						<?php } ?>
					</select>
					
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">备注:</td>
                <td align="left" class="l-table-edit-td">
                <textarea cols="100" rows="4" class="l-textarea" id="remarks" name="remarks" style="width:400px" ><?php echo @$remarks ?></textarea>
                </td><td align="left"></td>
            </tr>
        </table>
    <br />
    <input type="hidden" name="student_id"  value="<?php echo @$student_id?>" />
    <input type="hidden" name="old_student_no"  value="<?php echo @$student_no?>" />
    <input type="button" value="提交" class="l-button l-button-submit" onclick="checkUser()"/>
    <input type="reset" value="返回" class="l-button l-button-reset"/>
    </form>
    <div style="display:none"></div>
</body>
</html>