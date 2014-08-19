<?php require_once("_header.php");?>
<script type="text/javascript">
    var searchData = <?php echo $searchData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '班级名称', name: 'class_name', align: 'left', width: 160 },
            { display: '课程名称', name: 'course_name', align: 'left', width: 160 },
            { display: '班主任', name: 'teacher_name', align:'left', width: 60 },
            { display: '学生名称', name: 'student_name', align: 'left', width: 60 },
            { display: '学生性别', name: 'sex', align: 'left', width: 60 },
            { display: '学生年龄', name: 'age', align: 'left', width: 60 },
            { display: '学生原籍', name: 'ancestralhome', align: 'left', width: 160 },
            { display: '毕业学校', name: 'graduate_school', align: 'left', width: 160 },
            { display: '学生学历', name: 'graduate', align: 'left', width: 60 },
            { display: '学生专业', name: 'specialty', align: 'left', width: 160 },
            { display: '开课日期', name: 'start_date', align: 'left', width: 80 },
            { display: '毕业日期', name: 'end_date', align: 'left', width: 80 },
            { display: '学生成绩', name: 'attendance', align: 'left', width: 60 },
            { display: '就业城市', name: 'follow_city', align: 'left', width: 160 },
            { display: '就业企业', name: 'follow_company', align: 'left', width: 160 },
            { display: '就业职位', name: 'follow_position', align: 'left', width: 160 },
            { display: '就业薪资', name: 'follow_salary', align: 'left', width: 60 },
            ],
            pageSize:10,
            where : f_getWhere(),
            data: $.extend(true,{},searchData),
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
<form name="form" method="post" action="<?php echo SITE_URL.'/search_c/search';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
        <td>
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
        </td>
        <td>
        &nbsp学员成绩：
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
        &nbsp&nbsp&nbsp&nbsp&nbsp到&nbsp&nbsp&nbsp&nbsp
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
        </td>
        <td>
        &nbsp年龄：
        <select name="ddlAge" id="ddlAge" ltype="select">
        <option value="0"></option>
        <option value="1">18以下</option>
        <option value="2">18</option>
        <option value="3">19</option>
        <option value="4">20</option>
        <option value="5">21</option>
        <option value="6">22</option>
        <option value="7">23</option>
        <option value="8">24</option>
        <option value="9">25</option>
        <option value="10">26</option>
        <option value="11">27</option>
        <option value="12">28</option>
        <option value="13">29</option>
        <option value="14">30</option>
        <option value="15">30以上</option>
        </select>
        </td>
        <td>
        &nbsp学历：
        <select name="ddlEducation" id="ddlEducation" ltype="select">
        <option value="0"></option>
        <option value="1">本科以上</option>
        <option value="2">本科</option>
        <option value="3">专科</option>
        <option value="4">专科以下</option>
        </select>
        </td>
        </tr>
        <tr>
        <td>
        &nbsp毕业年月：
        <select name="ddlGraduateYear" id="ddlGraduateYear" ltype="select">
        <option value="0"></option>
        <option value="1">2014年</option>
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
        <select name="ddlGraduateMonth" id="ddlGraduateMonth" ltype="select">
        <option value="0"></option>
        <option value="1">1月</option>
        <option value="2">2月</option>
        <option value="3">3月</option>
        <option value="4">4月</option>
        <option value="5">5月</option>
        <option value="6">6月</option>
        <option value="7">7月</option>
        <option value="8">8月</option>
        <option value="9">9月</option>
        <option value="10">10月</option>
        <option value="11">11月</option>
        <option value="12">12月</option>
        </select>
        </td>
        <td>
        &nbsp就业薪资：
        <select name="ddlSalaryFrom" id="ddlSalaryFrom" ltype="select">
        <option value="0"></option>
        <option value="1">1000</option>
        <option value="2">2000</option>
        <option value="3">3000</option>
        <option value="4">4000</option>
        <option value="5">5000</option>
        <option value="6">6000</option>
        <option value="7">7000</option>
        <option value="8">8000</option>
        <option value="9">9000</option>
        <option value="10">10000</option>
        <option value="11">15000</option>
        <option value="12">20000</option>
        </select>
        &nbsp到&nbsp
        <select name="ddlSalaryTo" id="ddlSalaryTo" ltype="select">
        <option value="0"></option>
        <option value="1">1000</option>
        <option value="2">2000</option>
        <option value="3">3000</option>
        <option value="4">4000</option>
        <option value="5">5000</option>
        <option value="6">6000</option>
        <option value="7">7000</option>
        <option value="8">8000</option>
        <option value="9">9000</option>
        <option value="10">10000</option>
        <option value="11">15000</option>
        <option value="12">20000</option>
        </select>
        </td>
        <td>
        &nbsp性别：
        <select name="ddlSex" id="ddlSex" ltype="select">
        <option value="0"></option>
        <option value="1">男</option>
        <option value="2">女</option>
        </select>
        </td>
        <td></td>
        </tr>
        <tr>
        <td colspan="4">
        &nbsp任意查询：
        <input type="text" id="txtKey" style="width:350px"/>
        &nbsp<input id="search" type="submit" value=" 查 询 " onclick="search_click()" />
        &nbsp<input id="search" type="submit" value=" EXCEL批量下载 " onclick="download_click()" />
        </td>
        </tr>
    </table>
    <br>
        本科以上：1人(10%)&nbsp&nbsp本科：2人(20%)&nbsp&nbsp专科：3人(30%)&nbsp&nbsp专科以下：4人(40%)
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
