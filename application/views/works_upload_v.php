<!DOCTYPE html>
<html  lang="zh-cn">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/default.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/ligerui.all.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {
            $("#pageloading").hide();
        });
        function upload() {
            var upfile = document.form.upfile.value;
            var upsmallfile = document.form.upsmallfile.value;
            var works_name = document.form.works_name.value;
            var works_description = document.form.works_description.value;
            if (upfile == ""){
                alert("请选择作品文件！");
                return;
            }
            var check_upsmallfile = upfile.split(".");
            if (check_upsmallfile[1] != "jpg" && check_upsmallfile[1] != "JPG") {
                if (upsmallfile == ""){
                    alert("请选择文件缩略图！");
                    return;
                }
            }
            if (works_name == ""){
                alert("请输入作品名称！");
                return;
            }
            if (works_description == ""){
                alert("请输入作品描述！");
                return;
            }
            document.form.submit();
        }
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
<br>
<div>
    <form name="form" id="form" method="post" action="<?php echo SITE_URL.'/works_c/works_upload_exec';?>"  enctype="multipart/form-data" style="width:100%">
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="right" class="l-table-edit-td">作品上传:</td>
                <td align="left" class="l-table-edit-td">
                    <input type="file" name="upfile" id="upfile" multiple>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td"></td>
                <td align="left" class="l-table-edit-td">
                    <?php if ($msg_flg == "1"){?>
                        &nbsp;<span style="color:red">错误：文件上传失败！请重新上传或是联系管理员。</span>
                    <?php } else {?>
                        &nbsp;<span style="color:red">注：作品只能为JPG、WMV、ZIP类型的文件。</span>
                    <?php }?>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">缩略图:</td>
                <td align="left" class="l-table-edit-td">
                    <input type="file" name="upsmallfile" id="upsmallfile" multiple>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td"></td>
                <td align="left" class="l-table-edit-td">
                    &nbsp;<span style="color:red">注：除了图片文件以外，其他文件都需要自行上传文件缩略图。</span>
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">作品名称:</td>
                <td align="left" class="l-table-edit-td">
                    <input type="text" class="l-text" id="works_name" name="works_name" style="width:400px" />
                </td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="right" class="l-table-edit-td">作品描述:</td>
                <td align="left" class="l-table-edit-td">
                    <textarea cols="100" rows="4" class="l-textarea" id="works_description" name="works_description" style="width:400px"></textarea>
                </td>
                <td align="left"></td>
            </tr>
        </table>
        <br>
        <input type="button" value="提交" class="l-button l-button-submit" onclick="upload()"/>
        <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
        <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
        <input type="hidden" name="course_id" value="<?php echo $course_id ?>" />
        <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />
    </form>
</div>
</body>
</html>
