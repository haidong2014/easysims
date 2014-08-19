<?php
if(empty($sex)){
  $sex=1;
}
//echo $sex."###";
if(empty($property)){
  $property=1;
}
$action = SITE_URL."/class_c/add_class";
//echo $class_id."###";
if(!empty($class_id)){
  $action = SITE_URL."/class_c/upd_class";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>班级信息登录</title>
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
            if(document.getElementById('class_no').value==""){
            	alert('班级编号不能为空');return;
            }
            if(document.getElementById('class_name').value==""){
            	alert('班级名不能为空');return;
            }

            var user = document.form.class_no.value;
           
            var jqxhr = $.post("<?php echo SITE_URL.'/class_c/chk_repeat/';?>" + document.getElementById('class_no').value+'/'+'<?php echo @$class_no?>', function(data) {
                showMsg(data);
            });
        }
        function showMsg(data){
          if (data != "") {
              alert(data.replace(/\"/g, ""));
              document.form.class_no.value = "";
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
  <a href="<?php echo SITE_URL;?>/class_c">班级一览</a>&nbsp>&nbsp
    <form name="form" method="post" action="<?php echo $action;?>" id="form">
    <div></div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">班级编号:</td>
                <td align="left" class="l-table-edit-td"><input name="class_no" type="text" id="class_no" ltype="text" value="<?php echo @$class_no ?>" /></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">班级名称:</td>
                <td align="left" class="l-table-edit-td"><input name="class_name" type="text" id="class_name" ltype="text" value="<?php echo @$class_name ?>"  /></td>
                <td align="left"></td>
            </tr>
              <tr>
                <td align="right" class="l-table-edit-td">开课年份:</td>
				<td align="left" class="l-table-edit-td">
					<select name="ddlYear" id="ddlYear" ltype="select">
					<?php for($i=0;$i<10;$i++){ ?>
					    	<?php if(@$start_year==($i+2005)){ ?>
					    	<? }else {?>
							<option value="<?php echo ($i+2005); ?> "><?php echo ($i+2005); ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开课月份:</td>
				<td align="left" class="l-table-edit-td">
					<select name="ddlMonth" id="ddlMonth" ltype="select">
						<?php for($i=0;$i<12;$i++){ ?>
						<option value="<?php echo ($i+1); ?> "><?php echo ($i+1); ?></option>
						<?php } ?>
					</select>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开始日期:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="txtStartDate" type="text" id="txtStartDate" ltype="date"  />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">结课日期:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="txtEndDate" type="text" id="txtEndDate" ltype="date"  />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">课程(<input type="button" value="设定" onclick="setCourse()"/>):</td>
                <td align="left" class="l-table-edit-td">
					<select name="ddlSpecialty" id="ddlSpecialty" ltype="select">
						<?php foreach($courseData as $course){?>
						<option value="<?php  echo $course['course_id'] ?>"><?php  echo $course['course_name'] ?></option>
						<?php } ?>
					</select>
					
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">班主任:</td>
                <td align="left" class="l-table-edit-td">
					<select name="ddlTeacher" id="ddlTeacher" ltype="select">
						<?php foreach($teacherData as $teacher){?>
						<option value="<?php  echo $teacher['teacher_id'] ?>"><?php  echo $teacher['teacher_name'] ?></option>
						<?php } ?>
					</select>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">教室:</td>
                <td align="left" class="l-table-edit-td"><input name="txtClassroom" type="text" id="txtClassroom" ltype="text" /></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">名额:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="txtNumbers" type="text" id="txtNumbers" ltype='spinner' ligerui="{type:'int'}" class="required" />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">费用:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="txtSchooling" type="text" id="txtSchooling" ltype='spinner' ligerui="{type:'int'}" />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">状态:</td>
                <td align="left" class="l-table-edit-td">
					<select name="ddlStatus" id="ddlStatus" ltype="select">
						<option value="1">招生</option>
						<option value="2">开课</option>
						<option value="3">结课</option>
						<option value="4">取消</option>
					</select>
                </td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">备注:</td>
                <td align="left" class="l-table-edit-td">
                <textarea cols="100" rows="4" class="l-textarea" id="remarks" name="remarks" style="width:400px" ><?php echo @$remarks ?></textarea>
                </td><td align="left"></td>
            </tr>
        </table>
    <br />
    <input type="hidden" name="class_id"  value="<?php echo @$class_id?>" />
    <input type="hidden" name="old_class_no"  value="<?php echo @$class_no?>" />
    <input type="button" value="提交" class="l-button l-button-submit" onclick="checkUser()"/>
    <input type="reset" value="重置" class="l-button l-button-reset"/>
    </form>
    <div style="display:none"></div>
</body>
</html>