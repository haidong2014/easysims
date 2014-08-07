<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>系统用户登录</title>
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/core/base.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function ()
        {
            $("#pageloading").hide();
        });
        function addUser() {
            
            txtUser = document.form.txtUser.value;
            if (txtUser == "")
            {
                alert("请输入登录ID！");
                return;
            }
            txtName = document.form.txtName.value;
            if (txtName == "")
            {
                alert("请输入用户姓名！");
                return;
            }
            document.form.submit();
        }

        function returnPage() {
            location.href='<?php echo SITE_URL;?>/user_c';
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
<form name="form" method="post" action="<?php echo SITE_URL.'/user_c/add_user';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <td align="right" class="l-table-edit-td">登录ID:</td>
            <td align="left" class="l-table-edit-td">
                <input name="txtUser" type="text" id="txtUser" maxlength="10" value="<?php echo @$user ?>"/>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">登录密码:</td>
            <td align="left" class="l-table-edit-td">
                <input name="txtPassword" type="password" id="txtPassword" maxlength="10" value=""/>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">用户姓名:</td>
            <td align="left" class="l-table-edit-td">
                <input name="txtName" type="text" id="txtName" maxlength="30" value="<?php echo @$user_name ?>"/>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">用户角色:</td>
            <td align="left" class="l-table-edit-td">
                <select name="ddlRole" id="ddlRole">
                    <?php foreach($usergroups as $y){?>
                        <option value="<?php echo $y['id']?>" <?php echo $y['sel']?>><?php echo $y['name']?></option>
                    <?php } ?>
                </select>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td" valign="top">状态:</td>
            <td align="left" class="l-table-edit-td">
                <input id="rbtnl_0" type="radio" name="rbtDeleteFlg" value="0" <?php if(@$delete_flg =='0'){ ?> checked="checked"<?php } ?> /><label for="rbtnl_0">有效</label>
                <input id="rbtnl_1" type="radio" name="rbtDeleteFlg" value="1" <?php if(@$delete_flg =='1'){ ?> checked="checked"<?php } ?> /><label for="rbtnl_1">无效</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">备注:</td>
            <td align="left" class="l-table-edit-td"> 
                <textarea name="txtRemarks" id="txtRemarks" cols="100" rows="5" class="l-textarea" style="width:400px" maxlength="100"><?php echo @$remarks ?></textarea>
            </td>
            <td align="left"></td>
        </tr>
    </table>
    <br />
    <input type="hidden" name="txtUserId" value="<?php echo @$user_id?>" />
    <input type="button" value="提交" class="l-button l-button-submit" onclick="addUser()"/> 
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
</form>
<div style="display:none"></div>
</body>
</html>