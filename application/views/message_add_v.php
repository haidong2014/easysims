<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>校长留言</title>
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/core/base.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function ()
        {
            $("#pageloading").hide();
        });

        function addMessage() {

            txtTitle = document.form.txtTitle.value;
            if (txtTitle == "")
            {
                alert("请输入标题！");
                return;
            }
            document.form.submit();
        }

        function returnPage() {
            location.href='<?php echo SITE_URL;?>/message_c';
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
<form name="form" method="post" action="<?php echo SITE_URL.'/message_c/add_message';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <td align="right" class="l-table-edit-td">标题:</td>
            <td align="left" class="l-table-edit-td">
                <input name="txtTitle" id="txtTitle" type="text" maxlength="20" style="width:400px" value=""/>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">留言内容:</td>
            <td align="left" class="l-table-edit-td">
                <textarea name="txtMessage" id="txtMessage" cols="100" rows="8" class="l-textarea" style="width:400px" maxlength="200"></textarea>
            </td>
            <td align="left"></td>
        </tr>
    </table>
    <br />
    <input type="button" value="提交" class="l-button l-button-submit" onclick="addMessage()"/>
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
</form>
<div style="display:none"></div>
</body>
</html>