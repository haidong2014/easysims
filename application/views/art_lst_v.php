<?php require_once("_header.php");?>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
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
    学生姓名：<input type="text" id="txtKey" style="width:200px"/>
    <input id="search" type="submit" value=" 查 询 " onclick="search_click()" />
    <input id="search" type="submit" value=" 作品批量下载 " onclick="download_click()" />
<br>
<br>
<div id="maingrid" style="margin:0; padding:0">
 <form name="form" method="post" action="" id="form">
        <table  >
     <tr>
                <td align="center" style="padding:5px;" ><image src="lib/images/sample/1.jpg" width="200" height="150" ><br>张小燕&nbsp;90分</td>
                <td align="center" style="padding:5px;"><image src="lib/images/sample/2.jpg" width="200" height="150" ><br>李小燕&nbsp;80分</td>
                <td align="center" style="padding:5px;"><image src="lib/images/sample/3.jpg" width="200" height="150" ><br>王小燕&nbsp;70分</td>
                <td align="center" style="padding:5px;"><image src="lib/images/sample/4.jpg" width="200" height="150" ><br>赵小燕&nbsp;60分</td>
            </tr>
      <tr>
                <td align="center" style="padding:5px;" ><image src="lib/images/sample/5.jpg" width="200" height="150" ><br>孙小燕&nbsp;50分</td>
                <td align="center" style="padding:5px;"><image src="lib/images/sample/6.jpg" width="200" height="150" ><br>张燕&nbsp;40分</td>
                <td align="center" style="padding:5px;"><image src="lib/images/sample/7.jpg" width="200" height="150" ><br>朴燕&nbsp;30分</td>
                <td align="center" style="padding:5px;"><image src="lib/images/sample/8.jpg" width="200" height="150" ><br>国燕&nbsp;20分</td>
            </tr>
           <tr><td align="right" colspan="4"><input type="submit" value='上一页'>&nbsp&nbsp&nbsp<input type="submit" value='下一页'></td><tr>
    </table>

</div>
<div style="display:none;"></div>
</body>
</html>
