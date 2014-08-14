<?php require_once("_header.php");?>
<script type="text/javascript">
    var studentData = <?php echo $studentData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '日期', name: 'today', align: 'left', width: 80 },
            { display: '出勤状况(上午)', name: 'am_status', align: 'left', width: 200 },
            { display: '出勤状况(下午)', name: 'pm_status', align: 'left', width: 200 },
            { display: '出勤结果', name: 'status', align: 'left', width: 200 },
            ],
            pageSize:10,
            where : f_getWhere(),
            data: $.extend(true,{},studentData),
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
    function returnPage() {
        location.href = "attendance_lst.html";
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
<div id="searchbar">
    &nbsp年月：
  <select name="ddlYear" id="ddlYear" ltype="select">
    <option value="0"></option>
    <option value="1" selected>2014年</option>
    <option value="2">2013年</option>
    <option value="3">2012年</option>
    <option value="4">2011年</option>
    <option value="5">2010年</option>
    <option value="6">2009年</option>
    <option value="7">2008年</option>
    <option value="8">2007年</option>
    <option value="9">2006年</option>
    <option value="10">2005年</option>
  </select>
  <select name="ddlMonth" id="ddlMonth" ltype="select">
    <option value="0"></option>
    <option value="1">1月</option>
    <option value="2">2月</option>
    <option value="3">3月</option>
    <option value="4">4月</option>
    <option value="5">5月</option>
    <option value="6">6月</option>
    <option value="7">7月</option>
    <option value="8" selected>8月</option>
    <option value="9">9月</option>
    <option value="10">10月</option>
    <option value="11">11月</option>
    <option value="12">12月</option>
  </select>
    <input id="search" type="button" value=" 返 回 " onclick="returnPage()" />
</div>
<br>
学生编号：NO00001 &nbsp&nbsp 学生姓名：张三
<div id="maingrid" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
<br>
</body>
</html>
