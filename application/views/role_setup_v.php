<?php require_once("_header.php");?>

<script type="text/javascript">
    $(function (){

        $("#pageloading").hide();
    });
    function search_click()
    {
        user_id = document.form.ddlUser.value;
        location.href='<?php echo SITE_URL;?>/rolesetup_c/search_role/'+user_id;
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
<form name="form" method="post" action="<?php echo SITE_URL.'/rolesetup_c/upd_role';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <td align="right" class="l-table-edit-td">用户角色:</td>
            <td align="left" class="l-table-edit-td">
                <select name="ddlUser" id="ddlUser" onchange="search_click()">
                    <?php foreach($usergroups as $y){?>
                        <option value="<?php echo $y['id']?>" <?php echo $y['sel']?>><?php echo $y['name']?></option>
                    <?php } ?>
                </select>
            </td>
            <td align="left"></td>
        </tr>
    </table>
    <br />

    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <td align="right" class="l-table-edit-td">用户权限:</td>
            <td align="left" class="l-table-edit-td">
                <?php foreach($functionlist as $y){?>
                    <?php if($y['role_id']==null) {?>
                        <input id="<?php echo $y['function_id']?>" type="checkbox" name="<?php echo $y['function_id']?>"/>
                    <?php } else {?>
                      <input id="<?php echo $y['function_id']?>" type="checkbox" name="<?php echo $y['function_id']?>" checked/>
                    <?php } ?>
                    <label>&nbsp;<?php echo $y['function_name']?></label>
                <?php } ?>
            </td>
            <td align="left"></td>
        </tr>
    </table>
    <br />
    <input type="submit" value="提交" class="l-button l-button-submit" />
</form>
<div style="display:none"></div>
</body>
</html>