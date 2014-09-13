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
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerButton.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerRadio.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerTextBox.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerSpinner.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerComboBox.js" type="text/javascript"></script>
    <script type="text/javascript">
        var eee;
        $(function ()
        {
            $("#start_year").ligerComboBox();
            $("#start_month").ligerComboBox();
            $("#course_id").ligerComboBox();
            $("#graduate").ligerComboBox();
            $("#job_id").ligerComboBox();
            $("form").ligerForm();
            $("#pageloading").hide();
        });
        function returnPage() {
            var mode = document.form.mode.value;
            var class_id = document.form.class_id.value;
            if (mode == null || mode == "") {
                location.href='<?php echo SITE_URL;?>/student_c';
            } else {
                location.href='<?php echo SITE_URL;?>/student_c/index/'+mode+'/'+class_id;
            }
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
<form name="form" method="post" action="" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <td align="right" class="l-table-edit-td">学生编号:</td>
            <td align="left" class="l-table-edit-td">
                <input name="student_no" type="text" id="student_no" maxlength="10" onchange="checkStudent()" value="<?php echo @$student_no ?>" />
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">学生姓名:</td>
            <td align="left" class="l-table-edit-td">
                <input name="student_name" type="text" id="student_name" maxlength="30" value="<?php echo @$student_name ?>" />
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">开课日期:</td>
            <td align="left" class="l-table-edit-td">
                <input name="start_date" type="text" id="start_date" ltype="date" value="<?php echo @$start_date?>" />
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">结课日期:</td>
            <td align="left" class="l-table-edit-td">
                <input name="end_date" type="text" id="end_date" ltype="date" value="<?php echo @$end_date?>" />
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td" valign="top">性别:</td>
            <td align="left" class="l-table-edit-td">
                <input id="sex_0" type="radio" name="sex" value="1" <?php echo (@$sex==1?"checked":"")?>/><label for="sex_0">男</label>
                <input id="sex_1" type="radio" name="sex" value="2" <?php echo (@$sex==2?"checked":"")?>/><label for="sex_1">女</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">出生日期:</td>
            <td align="left" class="l-table-edit-td">
                <input name="birthday" type="text" id="birthday" ltype="date" value="<?php echo @$birthday ?>" />
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">年龄:</td>
            <td align="left" class="l-table-edit-td">
                <input name="age" type="text" id="age" ltype='spinner' ligerui="{type:'int'}" value="<?php echo @$age?>"/></td>
            <td align="left"></td>
        </tr>
         <tr>
            <td align="right" class="l-table-edit-td">身份证号:</td>
            <td align="left" class="l-table-edit-td">
                <input name="id_card" type="text" id="id_card" maxlength="18" value="<?php echo @$id_card ?>"/>
            </td>
            <td align="left"></td>
        </tr>
         <tr>
            <td align="right" class="l-table-edit-td">联系方式 :</td>
            <td align="left" class="l-table-edit-td">
                <input name="contact_way" type="text" id="contact_way" maxlength="20" value="<?php echo @$contact_way ?>"/>
            </td>
            <td align="left"></td>
        </tr>
         <tr>
            <td align="right" class="l-table-edit-td">家长电话:</td>
            <td align="left" class="l-table-edit-td">
                <input name="parent_phone" type="text" id="parent_phone" maxlength="12" value="<?php echo @$parent_phone ?>"/>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">毕业学校:</td>
            <td align="left" class="l-table-edit-td">
                <input name="graduate_school" type="text" id="graduate_school" maxlength="30" value="<?php echo @$graduate_school;?>"/>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">毕业专业:</td>
            <td align="left" class="l-table-edit-td">
                <input name="specialty" type="text" id="specialty" maxlength="30" value="<?php echo @$specialty;?>"/>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">学历:</td>
            <td align="left" class="l-table-edit-td">
                <select name="graduate" id="graduate" ltype="select" ligeruiid="graduate">
                <?php foreach($graduateData['GRADUATE'] as $key => $value) { ?>
                <?php if($key == @$graduate){?>
                          <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
                <?php }else{?>
                          <option value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
                <?php } ?>
                </select>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">课程:</td>
            <td align="left" class="l-table-edit-td">
              <select name="course_id" id="course_id" ltype="select" ligeruiid="course_id">
              <?php foreach($courseData as $course){?>
              <?php if(@$course_id==($course['course_id'])){ ?>
                        <option value="<?php  echo $course['course_id'] ?>" selected><?php  echo $course['course_name'] ?></option>
              <?php }else{?>
                        <option value="<?php  echo $course['course_id'] ?>"><?php  echo $course['course_name'] ?></option>
              <?php } ?>
              <?php } ?>
              </select>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">学费:</td>
            <td align="left" class="l-table-edit-td">
                <input name="cost" type="text" id="cost" ltype='spinner' ligerui="{type:'int'}" value="<?php echo @$cost;?>"/>
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">原籍:</td>
            <td align="left" class="l-table-edit-td">
            <textarea cols="100" rows="4" class="l-textarea" id="ancestralhome" name ="ancestralhome" maxlength="200" style="width:400px"><?php echo @$ancestralhome;?></textarea>
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">通过什么<br>方式了解<br>到学校:</td>
            <td align="left" class="l-table-edit-td">
            <textarea cols="100" rows="4" class="l-textarea" id="know_school" name="know_school" maxlength="200" style="width:400px"><?php echo @$know_school;?></textarea>
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">对行业的<br>了解情况:</td>
            <td align="left" class="l-table-edit-td">
            <textarea cols="100" rows="4" class="l-textarea" id="know_trade" name="know_trade" maxlength="200" style="width:400px" ><?php echo @$know_trade?></textarea>
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">个人喜好:</td>
            <td align="left" class="l-table-edit-td">
            <textarea cols="100" rows="4" class="l-textarea" id="preference" name="preference" maxlength="200" style="width:400px"><?php echo @$preference?></textarea>
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">有无软件<br>基础:</td>
            <td align="left" class="l-table-edit-td">
            <textarea cols="100" rows="4" class="l-textarea" id="software_base" name="software_base" maxlength="200" style="width:400px" ><?php echo @$software_base?></textarea>
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">来校学习<br>的目的:</td>
            <td align="left" class="l-table-edit-td">
            <textarea cols="100" rows="4" class="l-textarea" id="purpose" name="purpose" maxlength="200" style="width:400px" ><?php echo @$purpose?></textarea>
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">成绩:</td>
            <td align="left" class="l-table-edit-td">
                <input name="attendance" type="text" id="attendance" ltype='spinner' ligerui="{type:'int'}" validate="{digits:true,min:1,max:100}" value="<?php echo @$attendance;?>" />
            </td><td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">就业企业:</td>
            <td align="left" class="l-table-edit-td">
              <select name="job_id" id="job_id" ltype="select" ligeruiid="job_id">
                  <option value="0000" selected></option>
              <?php foreach($jobData as $job){?>
                  <?php if(@$job_id==($job['job_id'])){ ?>
                        <option value="<?php  echo $job['job_id'] ?>" selected><?php  echo $job['job_company'] ?></option>
                  <?php }else{?>
                        <option value="<?php  echo $job['job_id'] ?>"><?php  echo $job['job_company'] ?></option>
                  <?php } ?>
              <?php } ?>
              </select>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">就业薪资:</td>
            <td align="left" class="l-table-edit-td">
                <input name="follow_salary" type="text" id="follow_salary" ltype='spinner' ligerui="{type:'int'}" value="<?php echo @$follow_salary;?>"/>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">就业职位:</td>
            <td align="left" class="l-table-edit-td">
                <input name="follow_position" type="text" id="follow_position" maxlength="30" value="<?php echo @$follow_position;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">就业情况<br>备注:</td>
            <td align="left" class="l-table-edit-td">
                <textarea cols="100" rows="4" class="l-textarea" id="follow_remarks" name="follow_remarks" maxlength="1000" style="width:400px"><?php echo @$follow_remarks;?></textarea>
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
            <textarea cols="100" rows="4" class="l-textarea" id="remarks" name="remarks" maxlength="1000" style="width:400px" ><?php echo @$remarks ?></textarea>
            </td><td align="left"></td>
        </tr>
    </table>
    <br>
    <input type="hidden" name="student_id" id="student_id" value="<?php echo @$student_id?>" />
    <input type="hidden" name="student_no_old" id="student_no_old" value="<?php echo @$student_no?>" />
    <input type="hidden" name="mode" id="mode" value="<?php echo @$mode?>" />
    <input type="hidden" name="class_id" id="class_id" value="<?php echo @$class_id?>" />
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()" />
    <br>
</form>
<div style="display:none"></div>
</body>
</html>