<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>企业信息登录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerForm.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerSpinner.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerTextBox.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerComboBox.js" type="text/javascript"></script>
    <script type="text/javascript">
        var eee;
        $(function ()
        {
            $("#job_grade").ligerComboBox();
            $("form").ligerForm();
            $("#pageloading").hide();
        });
        function returnPage(){
            location.href='<?php echo SITE_URL;?>/job_c';
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
            <td align="right" class="l-table-edit-td">企业名称:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_company" type="text" id="job_company" maxlength="100" value="<?php echo @$job_company ?>" />
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">所在城市:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_city" type="text" id="job_city" maxlength="100" value="<?php echo @$job_city?>" />
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">企业业务:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_business" type="text" id="job_business" maxlength="100" value="<?php echo @$job_business;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">企业地址:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_address" type="text" id="job_address" maxlength="100" value="<?php echo @$job_address;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">企业电话:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_phone" type="text" id="job_phone" maxlength="12" value="<?php echo @$job_phone;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">企业邮箱:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_mail" type="text" id="job_mail" maxlength="30" value="<?php echo @$job_mail;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">QQ:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_qq" type="text" id="job_qq" maxlength="12" value="<?php echo @$job_qq;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">联系电话:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_telephone" type="text" id="job_telephone" maxlength="12" value="<?php echo @$job_telephone;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">联系人:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_contacts" type="text" id="job_contacts" maxlength="30" value="<?php echo @$job_contacts;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">职务:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_post" type="text" id="job_post" maxlength="30" value="<?php echo @$job_post;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">在职人数:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_onjob" type="text" id="job_onjob" ltype='spinner' ligerui="{type:'int'}" value="<?php echo @$job_onjob;?>"/>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">公司评级:</td>
            <td align="left" class="l-table-edit-td">
                <select name="job_grade" id="job_grade" ltype="select" ligeruiid="job_grade">
                <?php foreach($jobgradeData['JOB_GRADE'] as $key => $value) { ?>
                <?php if($key == @$job_grade){?>
                          <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
                <?php }else{?>
                          <option value="<?php echo $key;?>"><?php echo $value;?></option>
                <?php } ?>
                <?php } ?>
                </select>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">合作意向:</td>
            <td align="left" class="l-table-edit-td">
                <input name="job_cooperation" type="text" id="job_cooperation" maxlength="10" value="<?php echo @$job_cooperation;?>" /></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="right" class="l-table-edit-td">备注:</td>
            <td align="left" class="l-table-edit-td">
                <textarea cols="100" rows="4" class="l-textarea" id="remarks" name="remarks" style="width:400px" maxlength="1000"><?php echo @$remarks ?></textarea>
            </td>
            <td align="left"></td>
        </tr>
    </table>
    <br>
    <input type="hidden" name="job_id" value="<?php echo @$job_id?>" />
    <?php if ($show_mode == "0") { ?>
        <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
    <?php } ?>
</form>
<div style="display:none"></div>
</body>
</html>