<?php require_once("_header.php");?>
<script type="text/javascript">
    var userData = <?php echo $userData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '编号', name: 'user_id', align: 'left', width: 80 },
            { display: '登录ID', name: 'user', align: 'left', width: 160 },
            { display: '用户名称', name: 'user_name', align: 'left', width: 160 },
            { display: '用户角色', name: 'role_name', align:'left', width: 80 },
            { display: '用户状态', name: 'status', align:'left', width: 80 },
            { display: '操作', name: 'opt', width: 160 }
            ],
            pageSize:10,
            data: $.extend(true,{},userData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function regist_click(){
        location.href='<?php echo SITE_URL;?>/user_c/add_user_init';
    }
    function reSetPwd(parm){
        $.ligerDialog.confirm('确定要重置密码吗？', function (yes)
        {
            if(yes){
                var jqxhr = $.post(parm, function(data) {
                showMsg(data);});
            }
        });
    }
    function showMsg(data){
      if (data != "") {
          alert(data.replace(/\"/g, ""));
      }
    }
    function search_click(){
        document.form.submit();
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/user_c/search';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp状态：
            <select name="status" id="status" ligeruiid="status" onchange="search_click()">
                <?php foreach($statusLst['SYSTEM_USER'] as $key => $value) { ?>
                    <?php if($key == @$status){?>
                        <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
                    <?php }else{?>
                        <option value="<?php echo $key;?>"><?php echo $value;?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            &nbsp用户角色：
            <select name="role" id="role" ligeruiid="role" onchange="search_click()">
                <option value=""></option>
                <?php foreach($roleLst['ROLE'] as $key => $value) { ?>
                    <?php if($key == @$role){?>
                        <option value="<?php echo $key;?>" selected><?php echo $value;?></option>
                    <?php }else{?>
                        <option value="<?php echo $key;?>"><?php echo $value;?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            &nbsp名称：
            <input name="txtKey" id="txtKey" type="text" maxlength="20" style="width:200px" value="<?php echo @$search_key ?>" />&nbsp
            <input type="submit" value=" 查 询 " />&nbsp
            <input type="button" value="系统用户登录" onclick="regist_click()" />
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
