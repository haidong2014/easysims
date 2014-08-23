<?php 
if(empty($sex)){
  $sex=1;
}
//echo $sex."###";
if(empty($property)){
  $property=1;
}
$action = SITE_URL."/student_c";

$sex_name = array(1=>'男',2=>'女');
$property_name = array(1=>'专职',2=>'兼职');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn">
<head>
<title>课程信息登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
       /* var eee;
        $(function ()
        {
            $.metadata.setType("attr", "validate");
            var v = $("form").validate({
                debug: true,
                errorPlacement: function (lable, element)
                {
                    if (element.hasClass("l-textarea"))
                    {
                        element.ligerTip({ content: lable.html(), target: element[0] }); 
                    }
                    else if (element.hasClass("l-text-field"))
                    {
                        element.parent().ligerTip({ content: lable.html(), target: element[0] });
                    }
                    else
                    {
                        lable.appendTo(element.parents("td:first").next("td"));
                    }
                },
                success: function (lable)
                {
                    lable.ligerHideTip();
                    lable.remove();
                },
                submitHandler: function ()
                {
                    $("form .l-text,.l-textarea").ligerHideTip();
                    //$("form").submit();
                }
            });
            $("form").ligerForm();
            $(".l-button-test").click(function ()
            {
                alert(v.element($("#txtName")));
            });
        });  */
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
	<a href="<?php echo $action;?>">课程一览</a>&nbsp>&nbsp
    <div></div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
		     <tr>
                <td align="right" class="l-table-edit-td">学生编号:</td>
                <td align="left" class="l-table-edit-td"><?php echo @$student_no ?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">学生名称:</td>
                <td align="left" class="l-table-edit-td"><?php echo @$student_name ?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td" valign="top">性别:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo @$sex?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">出生日期:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo @$birthday ?>
                </td><td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">年龄:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo $age?></td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">身份证号::</td>
                <td align="left" class="l-table-edit-td"><?php echo @$id_card ?></td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">联系方式 :</td>
                <td align="left" class="l-table-edit-td"><?php echo @$contact_way ?></td>
                <td align="left"></td>
            </tr>
             <tr>
                <td align="right" class="l-table-edit-td">家长电话:</td>
                <td align="left" class="l-table-edit-td"><?php echo @$parent_phone ?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">毕业学校:</td>
                <td align="left" class="l-table-edit-td"><?php echo $graduate_school;?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">毕业专业:</td>
                <td align="left" class="l-table-edit-td"><?php echo $specialty;?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">学历:</td>
				<td align="left" class="l-table-edit-td">
					<?php echo $graduate;?>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">课程:</td>
				<td align="left" class="l-table-edit-td">
					<?php  echo $course_name; ?>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">学费:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo $cost;?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">原籍</td>
                <td align="left" class="l-table-edit-td"> 
                <?php echo $ancestralhome;?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">通过什么<br>方式了解<br>到学校:</td>
                <td align="left" class="l-table-edit-td"> 
                <?php echo $know_school;?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">对行业的<br>了解情况:</td>
                <td align="left" class="l-table-edit-td"> 
                <?php echo $know_trade?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">个人喜好:</td>
                <td align="left" class="l-table-edit-td"> 
                <?php echo $preference?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">有无软件<br>基础:</td>
                <td align="left" class="l-table-edit-td"> 
                <?php echo $software_base?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">来校学习<br>的目的:</td>
                <td align="left" class="l-table-edit-td"> 
                <?php echo $purpose?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">入学年度:</td>
				<td align="left" class="l-table-edit-td">
					<?php echo @$start_year; ?>
					    	
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">入学月份:</td>
				<td align="left" class="l-table-edit-td">
					<?php echo @$start_month ; ?>		   
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开课日期:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo $start_date?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">结课日期:</td>
                <td align="left" class="l-table-edit-td">
                   <?php echo $end_date?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">成绩:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo $attendance;?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业城市:</td>
                <td align="left" class="l-table-edit-td">
                 <?php echo $follow_city?>
                 </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业企业:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo $follow_company?>" 
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业薪资:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo $follow_salary;?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业职位:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo $follow_position;?>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">就业情况<br>备注:</td>
                <td align="left" class="l-table-edit-td"> 
                <?php echo $follow_remarks;?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td" valign="top">系统用户:</td>
                <td align="left" class="l-table-edit-td">
                     <?php if(@$system_user)==1){?>有效<?php }?>
                </td>
                <td align="left"></td>
            </tr>

            <tr>
                <td align="right" class="l-table-edit-td">备注:</td>
                <td align="left" class="l-table-edit-td">
                <?php echo @$remarks ?>
                </td><td align="left"></td>
            </tr>
        </table>
		<br />
		<input type="hidden" name="student_id"  value="<?php echo @$student_id?>" />
		<a href="<?php echo $action;?>" style="display:block">返回</a>
    <div style="display:none"></div>
</body>
</html>