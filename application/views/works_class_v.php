﻿<?php require_once("_header.php");?>
<script type="text/javascript">
    var classData = <?php echo $classData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '班级编号', name: 'class_no', align: 'left', width: 80 },
            { display: '班级名称', name: 'class_name', align: 'left', width: 160 },
            { display: '开课日期', name: 'start_date', align:'left', width: 80 },
            { display: '结课日期', name: 'end_date',  align: 'left', width: 80 },
            { display: '班主任', name: 'teacher_name', align: 'left', width: 80 },
            { display: '教室', name: 'class_room', align: 'left', width: 80 },
            { display: '人数', name: 'numbers', align: 'left', width: 80 },
            { display: '状态', name: 'code_name', align: 'left', width: 80 }
            ],
            pageSize:10,
            where : f_getWhere(),
            data: $.extend(true,{},classData),
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
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/works_c/search_class';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp班级名称：
            <input name="txtKey" id="txtKey" type="text" maxlength="20" style="width:200px" value="<?php echo @$search_key ?>" />&nbsp
            <input type="submit" value=" 查 询 " />&nbsp
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
