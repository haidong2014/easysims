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
          $("#teacher_id").ligerComboBox();
          $("#status").ligerComboBox();
          $("form").ligerForm();
        });

        function checkClass(){

            var class_id = document.form.class_id.value;
            var class_no = document.form.class_no.value;
            var class_no_old = document.form.class_no_old.value;
            if (class_id != null && class_id != "") {
                if (class_no != class_no_old) {
                    alert("班级编号不能变更！");
                    document.form.class_no.value = class_no_old;
                    return;
                }
            }
            var jqxhr = $.post("<?php echo SITE_URL.'/class_c/chk_class/';?>" + class_no +'/'+'<?php echo @$class_no?>', function(data) {
                showMsg(data);
            });
        }
        function showMsg(data){
          if (data != "") {
              alert(data.replace(/\"/g, ""));
              document.form.class_no.value = "";
              return ;
          }
        }
        function gotoSetSubject(){
          document.form.action="<?php echo SITE_URL;?>/class_c/selectSubject/";
          document.form.submit();
        }
        function addClass(){
            if(document.getElementById('class_no').value==""){
              alert('班级编号不能为空');
              return;
            }
            if(document.getElementById('class_name').value==""){
              alert('班级名不能为空');
              return;
            }
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

<body style="padding:10px">
<div id="pageloading"></div>
    <form name="form" method="post" action="<?php echo SITE_URL.'/class_c/add_class';?>" id="form">
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">班级编号:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="class_no" type="text" id="class_no" maxlength="10" onchange="checkClass()" value="<?php echo @$class_no ?>" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">班级名称:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="class_name" type="text" id="class_name" maxlength="30" value="<?php echo @$class_name ?>"  />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开课年份:</td>
                <td align="left" class="l-table-edit-td">
                <select name="start_year" id="start_year" ltype="select" ligeruiid="start_year">
                    <?php for($i=0;$i<12;$i++){ ?>
                        <?php if(@$start_year==($i+2014)){ ?>
                            <option value="<?php echo ($i+2014); ?>" selected><?php echo ($i+2014); ?></option>
                        <?php } else {?>
                            <option value="<?php echo ($i+2014); ?>"><?php echo ($i+2014); ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开课月份:</td>
                <td align="left" class="l-table-edit-td">
                <select name="start_month" id="start_month" ltype="select" ligeruiid="start_month">
                    <?php for($i=0;$i<12;$i++){ ?>
                      <?php if(@$start_month==($i+1)){ ?>
                          <option value="<?php echo ($i+1); ?>" selected><?php echo ($i+1); ?></option>
                      <?php } else {?>
                          <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
                      <?php } ?>
                    <?php } ?>
                </select>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开始日期:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="start_date" type="text" id="start_date" ltype="date" value="<?php echo @$start_date?>" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">结课日期:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="end_date" type="text" id="end_date" ltype="date" value="<?php echo @$end_date?>"/>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">课程:</td>
                <td align="left" class="l-table-edit-td">
                <select name="course_id" id="course_id" ligeruiid="course_id" onChange="clearsub()">
                    <?php foreach($courseData as $course){?>
                        <?php if(@$course_id==@$course['course_id']){ ?>
                            <option value="<?php  echo @$course['course_id'] ?>" selected><?php  echo @$course['course_name'] ?></option>
                        <?php }else{?>
                            <option value="<?php  echo @$course['course_id'] ?>"><?php  echo @$course['course_name'] ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">班主任:</td>
                <td align="left" class="l-table-edit-td">
                <select name="teacher_id" id="teacher_id" ligeruiid="teacher_id">
                    <?php foreach($teacherData as $teacher){?>
                        <?php if(@teacher_id==($course['teacher_id'])){ ?>
                            <option value="<?php  echo $teacher['teacher_id'] ?>" selected><?php  echo $teacher['teacher_name'] ?></option>
                        <?php }else{?>
                            <option value="<?php  echo $teacher['teacher_id'] ?>"><?php  echo $teacher['teacher_name'] ?></option>
                        <?php }?>
                    <?php } ?>
                </select>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">教室:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="class_room" type="text" id="class_room"  maxlength="30" value="<?php echo @$class_room?>" ltype="text" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">名额:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="numbers" type="text" id="numbers" ltype='spinner' value="<?php echo @$numbers?>" ligerui="{type:'int'}" class="required" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">费用:</td>
                <td align="left" class="l-table-edit-td">
                    <input name="cost" type="text" id="cost" ltype='spinner' ligerui="{type:'int'}" value="<?php echo @$cost?>" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">状态:</td>
                <td align="left" class="l-table-edit-td">
                <select name="status" id="status" ligeruiid="status">
                <?php foreach($status['STATUS'] as $key => $value) { ?>
                    <?php if($key == @$status){?>
                        <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
                    <?php }else{?>
                        <option value="<?php echo $key;?>"><?php echo $value;?></option>
                    <?php } ?>
                <?php } ?>
                </select>
                </td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">备注:</td>
                <td align="left" class="l-table-edit-td">
                    <textarea cols="100" rows="4" class="l-textarea" id="remarks" name="remarks" maxlength="200" style="width:400px" ><?php echo @$remarks ?></textarea>
                </td>
                <td align="left"></td>
            </tr>
        </table>
    <br>
    <input type="hidden" name="class_id" id="class_id" value="<?php echo @$class_id?>" />
    <input type="hidden" name="class_no_old"  value="<?php echo @$class_no?>" />
    <input type="button" value="提交" class="l-button l-button-submit" onclick="addClass()"/>
    <input type="button" value="返回" class="l-button l-button-submit" onclick="location.href='<?php echo SITE_URL.'/class_c/';?>'" />
    <br>
    </form>
    <div style="display:none"></div>
</body>
</html>