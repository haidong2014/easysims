<?php require_once("_header.php");?>
<script type="text/javascript">
    var messageData = <?php echo $messageData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '日期', name: 'message_date', align: 'left', width: 80 },
            { display: '姓名', name: 'message_user', align: 'left', width: 80 },
            { display: '标题', name: 'message_title', align: 'left', width: 200 },
            { display: '内容', name: 'message_content', align: 'left', width: 600 }
            ],
            pageSize:10,
            where : f_getWhere(),
            data: $.extend(true,{},messageData),
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
        location.href = "message_add.html";
    }
</script>

<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar">
  &nbsp年月:
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
  &nbsp标题：<input id="txtKey" type="text" />
  <input id="search" type="button" value=" 查 询 " onclick="search_click()" />
  <input id="regist" type="button" value="校长留言" onclick="regist_click()" />
</div>
<br>
<div id="maingrid" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
</body>
