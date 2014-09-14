<!DOCTYPE html>
<html  lang="zh-cn">
<head>
    <title>易用学生管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/default.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/ligerui.all.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            $("#pageloading").hide();
        });
        function f_search()
        {
        }
    function returnPage() {
      location.href = "<?php echo SITE_URL?>/works_c/work_lst";
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
  <br>
<div>
    <form name="main" method="post" action="<?php echo SITE_URL.'/works_c/works_upload_exec';?>"  enctype="multipart/form-data" style="width:100%">
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">作品上传:</td>
                <td align="left" class="l-table-edit-td">
                <input type="file" name="upfile" multiple></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">作品名称:</td>
                <td align="left" class="l-table-edit-td">
                <input type="text" class="l-text" id="works_name" name="works_name" style="width:400px" />
                </td><td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">作品描述:</td>
                <td align="left" class="l-table-edit-td">
                <textarea cols="100" rows="4" class="l-textarea" id="works_description" name="works_description" style="width:400px"></textarea>
                </td><td align="left"></td>
            </tr>
        </table>
    <br />
    <input type="submit" value="提交" class="l-button l-button-submit" />
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
    <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
    <input type="hidden" name="course_id" value="<?php echo $course_id ?>" />
    <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />
    </form>
</div>
</body>
</html>
