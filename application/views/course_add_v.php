<?php
if(empty($sex)){
  $sex=1;
}
//echo $sex."###";
if(empty($property)){
  $property=1;
}
$action = SITE_URL."/course_c/add_course";
//echo $course_id."###";
if(!empty($course_id)){
  $action = SITE_URL."/course_c/upd_course";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>课程信息登录</title>
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
            if(document.getElementById('course_no').value==""){
            	alert('课程编号不能为空');return;
            }
            if(document.getElementById('course_name').value==""){
            	alert('课程名不能为空');return;
            }

            var user = document.form.course_no.value;
           
            var jqxhr = $.post("<?php echo SITE_URL.'/course_c/chk_repeat/';?>" + document.getElementById('course_no').value+'/'+'<?php echo @$course_no?>', function(data) {
                showMsg(data);
            });
        }
        function showMsg(data){
          if (data != "") {
              alert(data.replace(/\"/g, ""));
              document.form.course_no.value = "";
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
  <a href="<?php echo SITE_URL;?>/course_c">课程一览</a>&nbsp>&nbsp
    <form name="form" method="post" action="<?php echo $action;?>" id="form">
    <div></div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">课程编号:</td>
                <td align="left" class="l-table-edit-td"><input name="course_no" type="text" id="course_no" ltype="text" value="<?php echo @$course_no ?>" validate="{required:true,maxlength:10}" /></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">课程名称:</td>
                <td align="left" class="l-table-edit-td"><input name="course_name" type="text" id="course_name" ltype="text" value="<?php echo @$course_name ?>" validate="{required:true,maxlength:30}" /></td>
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
    <input type="hidden" name="course_id"  value="<?php echo @$course_id?>" />
    <input type="hidden" name="old_course_no"  value="<?php echo @$course_no?>" />
    <input type="button" value="提交" class="l-button l-button-submit" onclick="checkUser()"/>
    <input type="reset" value="重置" class="l-button l-button-reset"/>
    </form>
    <div style="display:none"></div>
</body>
</html>