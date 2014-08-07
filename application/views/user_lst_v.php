﻿<?php require_once("_header.php");?>
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
            where : f_getWhere(),
            data: $.extend(true,{},userData), 
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function f_search()
    {
        grid.options.data = $.extend(true, {}, CustomersData);
        grid.loadData(f_getWhere());
    }
    function f_getWhere()
    {
        if (!grid) return null;
        var clause = function (rowdata, rowindex)
        {
            var key = $("#txtKey").val();
            return rowdata.CustomerID.indexOf(key) > -1;
        };
        return clause; 
    }
    function regist_click()
    {
        location.href='<?php echo SITE_URL;?>/user_c/add_user_init';
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>  
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/user_c/search_user';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
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
