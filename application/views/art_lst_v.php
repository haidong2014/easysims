<?php require_once("_header.php");?>
<script type="text/javascript">
    $(function () {
        $("#pageloading").hide();
    });
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/art_c/search';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        &nbsp入学年月：
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
        &nbsp成绩：
        <select name="ddlScoreFrom" id="ddlScoreFrom" ltype="select">
        <option value="0"></option>
        <option value="1">10</option>
        <option value="2">20</option>
        <option value="3">30</option>
        <option value="4">40</option>
        <option value="5">50</option>
        <option value="6">60</option>
        <option value="7">70</option>
        <option value="8">80</option>
        <option value="9">90</option>
        <option value="10">100</option>
        </select>
        &nbsp到&nbsp
        <select name="ddlScoreTo" id="ddlScoreTo" ltype="select">
        <option value="0"></option>
        <option value="1">10</option>
        <option value="2">20</option>
        <option value="3">30</option>
        <option value="4">40</option>
        <option value="5">50</option>
        <option value="6">60</option>
        <option value="7">70</option>
        <option value="8">80</option>
        <option value="9">90</option>
        <option value="10">100</option>
        </select>
                学生姓名：
        <input type="text" id="txtKey" style="width:200px"/>
        <input id="search" type="submit" value=" 查 询 " onclick="search_click()" />
        <input id="search" type="submit" value=" 作品批量下载 " onclick="download_click()" />
    </table>
    <br>
    <table>
    <tr>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>赵小燕&nbsp;90分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>钱小燕&nbsp;80分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>孙小燕&nbsp;80分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>李小燕&nbsp;85分</td>
    </tr>
    <tr>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>周小燕&nbsp;95分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>吴小燕&nbsp;80分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>郑小燕&nbsp;90分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>王小燕&nbsp;80分</td>
    </tr>
    <tr>
        <td align="right" colspan="4"><input type="submit" value='上一页'>&nbsp&nbsp&nbsp<input type="submit" value='下一页'></td>
    <tr>
    </table>
</form>
<div style="display:none;"></div>
</body>
</html>
