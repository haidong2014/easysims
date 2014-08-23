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
                <td align="left" class="l-table-edit-td">
                 <input name="txtAge" type="text" id="txtAge" ltype='spinner' ligerui="{type:'int'}" value="<?php echo $age?>"/></td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">身份证号::</td>
                <td align="left" class="l-table-edit-td"><input name="id_card" type="text" id="id_card" ltype="text" value="<?php echo @$id_card ?>"  /></td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">联系方式 :</td>
                <td align="left" class="l-table-edit-td"><input name="contact_way" type="text" id="contact_way" ltype="text" value="<?php echo @$contact_way ?>"  /></td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">家长电话:</td>
                <td align="left" class="l-table-edit-td"><input name="parent_phone" type="text" id="parent_phone" ltype="text" value="<?php echo @$parent_phone ?>" /></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">毕业学校:</td>
                <td align="left" class="l-table-edit-td"><input name="txtGraduateSchool" type="text" id="txtGraduateSchool" ltype="text"/></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">毕业专业:</td>
                <td align="left" class="l-table-edit-td"><input name="txtSpecialty" type="text" id="txtSpecialty" ltype="text"/></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">学历:</td>
				<td align="left" class="l-table-edit-td">
					<select name="ddlEducation" id="ddlEducation" ltype="select">
						<option value="1">本科以上</option>
						<option value="2">本科</option>
						<option value="3">专科</option>
						<option value="4">专科以下</option>
					</select>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">课程:</td>
				<td align="left" class="l-table-edit-td">
					<select name="ddlSpecialty" id="ddlSpecialty" ltype="select">
						<option value="1">建筑动画课程信息</option>
						<option value="2">室内设计课程信息</option>
						<option value="3">影视动画课程信息</option>
						<option value="4">影视后期课程信息</option>
						<option value="5">影视坐标合作班课程信息</option>
					</select>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">学费:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="txtSchooling" type="text" id="txtSchooling" ltype='spinner' ligerui="{type:'int'}" />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">原籍</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="ancestralhome" style="width:400px"></textarea>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">通过什么<br>方式了解<br>到学校:</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="knowme" style="width:400px"></textarea>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">对行业的<br>了解情况:</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="knowtrade" style="width:400px"></textarea>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">个人喜好:</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="preference" style="width:400px"></textarea>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">有无软件<br>基础:</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="software_base" name="software_base" style="width:400px" ><?php echo $software_base?></textarea>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">来校学习<br>的目的:</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="purpose" name="purpose" style="width:400px" ><?php echo $purpose?></textarea>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">入学年度:</td>
				<td align="left" class="l-table-edit-td">
					<select name="ddlYear" id="ddlYear" ltype="select">
						<option value="1">2014</option>
						<option value="2">2013</option>
						<option value="3">2012</option>
						<option value="4">2011</option>
						<option value="5">2010</option>
						<option value="6">2009</option>
						<option value="7">2008</option>
						<option value="8">2007</option>
						<option value="9">2006</option>
						<option value="10">2005</option>
					</select>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">入学月份:</td>
				<td align="left" class="l-table-edit-td">
					<select name="ddlMonth" id="ddlMonth" ltype="select">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开课日期:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="txtStartDate" type="text" id="txtStartDate" ltype="date" />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">结课日期:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="txtEndDate" type="text" id="txtEndDate" ltype="date" />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">成绩:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="txtScore" type="text" id="purpose" ltype='spinner'  ligerui="{type:'int'}" validate="{digits:true,min:1,max:100}" <?php echo $purpose;?>/>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业城市:</td>
                <td align="left" class="l-table-edit-td"><input name="follow_city" type="text" id="follow_city" ltype="text" <?php echo $follow_city?>/></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业企业:</td>
                <td align="left" class="l-table-edit-td"><input name="follow_company" type="text" id="follow_company" ltype="text" value="<?php echo $follow_company?>" /></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业薪资:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="follow_salary" type="text" id="follow_salary" ltype='spinner' ligerui="{type:'int'}" value="<?php echo $follow_salary;?>"/>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业职位:</td>
                <td align="left" class="l-table-edit-td"><input name="follow_position" type="text" id="follow_position" ltype="text" value="<?php echo $follow_position;?>" /></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业情况<br>备注:</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="follow" style="width:400px"><?php echo $follow_remarks;?></textarea>
                </td><td align="left"></td>
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