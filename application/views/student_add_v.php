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
                <td align="right" class="l-table-edit-td">学生编号:</td>
                <td align="left" class="l-table-edit-td"><input name="student_no" type="text" id="student_no" ltype="text" value="<?php echo @$student_no ?>" validate="{required:true,maxlength:10}" /></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">学生名称:</td>
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
                 <input name="age" type="text" id="age" ltype='spinner' ligerui="{type:'int'}" value="<?php echo $age?>"/></td>
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
                <td align="left" class="l-table-edit-td"><input name="graduate_school" type="text" id="graduate_school" value="<?php echo $graduate_school"?> ltype="text"/></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">毕业专业:</td>
                <td align="left" class="l-table-edit-td"><input name="specialty" type="text" id="specialty" ltype="text" value="<?php echo $specialty;?>"/></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">学历:</td>
				<td align="left" class="l-table-edit-td">
					<select name="graduate" id="graduate" ltype="select">
						<?php
					foreach($graduateData['GRADUATE'] as $key => $value) { ?>
					  <?php if($key == @$graduate){?>
					  <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
					  <?php }else{?>
					   <option value="<?php echo $key;?>"><?php echo $value;?></option>
					  <?php }
					}?>
					</select>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">课程:</td>
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
                <td align="right" class="l-table-edit-td">学费:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="txtSchooling" type="text" id="cost"   name="cost"  ltype='spinner' ligerui="{type:'int'}" value="<?php echo $cost;?>"/>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">原籍</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="ancestralhome" name ="ancestralhome" style="width:400px"><?php echo $ancestralhome;?></textarea>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">通过什么<br>方式了解<br>到学校:</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="know_school" name="know_school" style="width:400px"><?php echo $know_school;?></textarea>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">对行业的<br>了解情况:</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="know_trade" name="know_trade" style="width:400px" ><?php echo $know_trade?></textarea>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">个人喜好:</td>
                <td align="left" class="l-table-edit-td"> 
                <textarea cols="100" rows="4" class="l-textarea" id="preference" name="" style="width:400px"><?php echo $preference?></textarea>
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
					<select name="start_year" id="start_year" ltype="select">
						<?php for($i=0;$i<10;$i++){ ?>
					    	<?php if(@$start_year==($i+2005)){ ?>
					    	<option value="<?php echo ($i+2005); ?> " selected><?php echo ($i+2005); ?></option>
					    	<? }else {?>
							<option value="<?php echo ($i+2005); ?> "><?php echo ($i+2005); ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">入学月份:</td>
				<td align="left" class="l-table-edit-td">
					<select name="ddlMonth" id="ddlMonth" ltype="select">
						<?php for($i=0;$i<12;$i++){ ?>
						    <?php if(@$start_month==($i+1)){ ?>
						    <option value="<?php echo ($i+1); ?> " selected><?php echo ($i+1); ?></option>
						    <?php }else{?>
							<option value="<?php echo ($i+1); ?> "><?php echo ($i+1); ?></option>
							<?php }?>
						<?php } ?>
					</select>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开课日期:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="start_date" type="text" id="start_date" ltype="date" value="<?php echo $start_date?>" />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">结课日期:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="end_date" type="text" id="end_date" ltype="date" value="<?php echo $end_date?>" />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">成绩:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="attendance" type="text" id="attendance" ltype='spinner'  ligerui="{type:'int'}" validate="{digits:true,min:1,max:100}" <?php echo $attendance;?>/>
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