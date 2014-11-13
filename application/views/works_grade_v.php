<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>作品点评</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerGrid.js" type="text/javascript"></script>
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerForm.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerSpinner.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerTextBox.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/jquery-validation/jquery.metadata.js" type="text/javascript"></script>
    <script type="text/javascript">
        var eee;
        $(function ()
        {
            $.metadata.setType("attr", "validate");
            $("form").ligerForm();
            $("#works_scores").ligerComboBox();
            $("#pageloading").hide();
        });
        function returnPage() {
            location.href = "<?php echo SITE_URL?>/works_c/works_lst/<?php echo $class_id.'/'.$course_id.'/'.$subject_id ?>";
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
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div>
  <br>
    <form name="form1" method="post" action="<?php echo SITE_URL?>/works_c/works_grade_exec" id="form1">
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">作品名称</td>
                <td align="left" class="l-table-edit-td">
                    <?php echo $works_name?>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">作品作者</td>
                <td align="left" class="l-table-edit-td">
                   <?php echo $student_name;?>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">作品分数</td>
                <td align="left" class="l-table-edit-td">
                    <input type="text" id="works_scores" name="works_scores" ltype='spinner' ligerui="{type:'int'}" value="<?php echo $works_scores?>" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">作品点评</td>
                <td align="left" class="l-table-edit-td">
                    <textarea cols="100" rows="4" class="l-textarea" name="works_comment" id="works_comment" style="width:400px"><?php echo $works_comment?></textarea>
                </td>
                <td align="left"></td>
            </tr>
        </table>
    <br>
        <input type="submit" value="提交" class="l-button l-button-submit" />
        <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
        <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
        <input type="hidden" name="course_id" value="<?php echo $course_id ?>" />
        <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />
        <input type="hidden" name="works_no" value="<?php echo $works_no ?>" />
    </form>
</div>
</body>
</html>
