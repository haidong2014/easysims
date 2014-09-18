<?php require_once("_header.php");?>
<script type="text/javascript">
    var usergroupsData = <?php echo $usergroupsData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '用户组编号', name: 'role_id', align: 'left', width: 80 },
            { display: '用户组名称', name: 'role_name', align: 'left', width: 160 },
            { display: '操作', name: 'opt', width: 160 }
            ],  
            pageSize:10,
            data: $.extend(true,{},usergroupsData), 
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function regist_click()
    {
        location.href='<?php echo SITE_URL;?>/usergroups_c/add_usergroups_init';
    }

    function delUsergroups(parm){

        var rst = confirm("确定要删除这条数据吗?");
        if (rst == true){
            location.href = parm;
        }
    }
</script>

</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>  
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/usergroups_c/search_usergroups';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp名称：
            <input name="txtKey" id="txtKey" type="text" maxlength="20" style="width:200px" value="<?php echo @$search_key ?>" />&nbsp
            <input type="submit" value=" 查 询 " />&nbsp
            <input type="button" value="用户角色登录" onclick="regist_click()" />
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
