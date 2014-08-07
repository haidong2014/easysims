<?php require_once("_header.php");?>
<script type="text/javascript">
    var rolesetupData = <?php echo $rolesetupData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            checkbox: true,
            columns: [
            { display: '功能名称', name: 'function_name', align: 'left', width: 300 }
            ],  
            pageSize:10,
            where : f_getWhere(),
            data: $.extend(true,{},rolesetupData), 
            width: '100%',height:'90%'
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
    function search_click()
    {
        document.form.submit();
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
    <div id="maingrid" style="margin:0; padding:0"></div>
    <br />
    <input type="submit" value="提交" class="l-button l-button-submit" /> 
</form>
<div style="display:none"></div>
</body>
</html>