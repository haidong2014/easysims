<?php 
if(empty($sex)){
  $sex=1;
}
//echo $sex."###";
if(empty($property)){
  $property=1;
}
$action = SITE_URL."/class_c";

$sex_name = array(1=>'男',2=>'女');
$property_name = array(1=>'专职',2=>'兼职');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn">
<head>
<title>班级信息登录</title>
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
	<a href="<?php echo $action;?>">班级一览</a>&nbsp>&nbsp
    <div></div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
		    <tr>
                <td align="right" >班级编号:</td>
                <td align="left" class="l-table-edit-td"><?php echo @$class_no ?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" >班级姓名:</td>
                <td align="left" class="l-table-edit-td"><?php echo @$class_name ?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开课年份:</td>
				<td align="left" class="l-table-edit-td">
					<?php echo @$start_year?>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开课月份:</td>
				<td align="left" class="l-table-edit-td">
					<?php echo $start_month ?>
				</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">开始日期:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo @$start_date?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">结课日期:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo @$end_date?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">课程:</td>
                <td align="left" class="l-table-edit-td">
					<?php  echo @$course_name ?>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">班主任:</td>
                <td align="left" class="l-table-edit-td">
					<?php  echo @$teacher_name ?>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">教室:</td>
                <td align="left" class="l-table-edit-td"><?php echo @$class_room?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">名额:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo @$numbers?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">费用:</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo @$cost?>
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">状态:</td>
                <td align="left" class="l-table-edit-td">
					<?php echo @$status;?>
                </td>
            </tr>
            <tr>
                <td align="right" >备注:</td>
                <td align="left" class="l-table-edit-td"> 
                <?php echo @$remarks ?>
                </td><td align="left"></td>
            </tr>
        </table>
		<br />
		<input type="hidden" name="class_id"  value="<?php echo @$class_id?>" />
		<a href="<?php echo $action;?>" style="display:block">返回</a>
    <div style="display:none"></div>
</body>
</html>