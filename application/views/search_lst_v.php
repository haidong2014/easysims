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
            { display: '学生性别', name: 'sex_nm', align: 'left', width: 60 },
            { display: '学生年龄', name: 'age', align: 'left', width: 60 },
            { display: '学生原籍', name: 'ancestralhome', align: 'left', width: 160 },
            { display: '毕业学校', name: 'graduate_school', align: 'left', width: 160 },
            { display: '学生学历', name: 'graduate_nm', align: 'left', width: 60 },
            { display: '学生专业', name: 'specialty', align: 'left', width: 160 },
            { display: '开课日期', name: 'start_date', align: 'left', width: 80 },
            { display: '毕业日期', name: 'end_date', align: 'left', width: 80 },
            { display: '学生成绩', name: 'scores', align: 'left', width: 60 },
            { display: '就业城市', name: 'job_city', align: 'left', width: 160 },
            { display: '就业企业', name: 'job_company', align: 'left', width: 160 },
            { display: '就业职位', name: 'follow_position', align: 'left', width: 160 },
            { display: '就业薪资', name: 'follow_salary', align: 'left', width: 60 },
            ],
            pageSize:10,
            data: $.extend(true,{},searchData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function search_click(){
        document.form.download_flg.value = "0";
        document.form.submit();
    }
    function download_click(){
        document.form.download_flg.value = "1";
        document.form.submit();
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/search_c/search';?>" id="form">
    <table cellspacing="0" cellspacing="0" class="l-table-edit" >
        <tr>
        <td>
        &nbsp入学年月：
            <select name="start_year" id="start_year" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=0;$i<12;$i++){ ?>
                <?php if(@$start_year==($i+2014)){ ?>
                    <option value="<?php echo ($i+2014); ?>" selected><?php echo ($i+2014); ?></option>
                <?php } else {?>
                    <option value="<?php echo ($i+2014); ?>"><?php echo ($i+2014); ?></option>
                <?php } ?>
            <?php } ?>
            </select>
            <select name="start_month" id="start_month" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=0;$i<12;$i++){ ?>
              <?php if(@$start_month==($i+1)){ ?>
                  <option value="<?php echo ($i+1); ?>" selected><?php echo ($i+1); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
              <?php }?>
            <?php } ?>
            </select>
        </td>
        <td>
        &nbsp学员成绩：
        <select name="scores_from" id="scores_from" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=1;$i<=10;$i++){ ?>
              <?php if(@$scores_from==($i*10)){ ?>
                  <option value="<?php echo ($i*10); ?>" selected><?php echo ($i*10); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i*10); ?>"><?php echo ($i*10); ?></option>
              <?php }?>
            <?php } ?>
        </select>
        &nbsp&nbsp&nbsp&nbsp&nbsp到&nbsp&nbsp&nbsp&nbsp
        <select name="scores_to" id="scores_to" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=1;$i<=10;$i++){ ?>
              <?php if(@$scores_to==($i*10)){ ?>
                  <option value="<?php echo ($i*10); ?>" selected><?php echo ($i*10); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i*10); ?>"><?php echo ($i*10); ?></option>
              <?php }?>
            <?php } ?>
        </select>
        </td>
        <td>
        &nbsp年龄：
        <select name="age" id="age" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php if(@$age=="00"){ ?>
                <option value="00" selected>18以下</option>
            <?php } else {?>
                <option value="00">18以下</option>
            <?php } ?>
            <?php for($i=18;$i<=30;$i++){ ?>
              <?php if(@$age==($i)){ ?>
                  <option value="<?php echo ($i); ?>" selected><?php echo ($i); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i); ?>"><?php echo ($i); ?></option>
              <?php }?>
            <?php } ?>
            <?php if(@$age=="99"){ ?>
                <option value="99" selected>30以上</option>
            <?php } else {?>
                <option value="99">30以上</option>
            <?php } ?>
        </select>
        </td>
        <td>
        &nbsp学历：
        <select name="graduate" id="graduate" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php if(@$graduate=="1"){ ?>
                <option value="1" selected>本科以上</option>
            <?php } else {?>
                <option value="1">本科以上</option>
            <?php } ?>
            <?php if(@$graduate=="2"){ ?>
                <option value="2" selected>本科</option>
            <?php } else {?>
                <option value="2">本科</option>
            <?php } ?>
            <?php if(@$graduate=="3"){ ?>
                <option value="3" selected>专科</option>
            <?php } else {?>
                <option value="3">专科</option>
            <?php } ?>
            <?php if(@$graduate=="4"){ ?>
                <option value="4" selected>专科以下</option>
            <?php } else {?>
                <option value="4">专科以下</option>
            <?php } ?>
        </select>
        </td>
        </tr>
        <tr>
        <td>
        &nbsp毕业年月：
            <select name="end_year" id="end_year" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=0;$i<12;$i++){ ?>
                <?php if(@$end_year==($i+2014)){ ?>
                    <option value="<?php echo ($i+2014); ?>" selected><?php echo ($i+2014); ?></option>
                <?php } else {?>
                    <option value="<?php echo ($i+2014); ?>"><?php echo ($i+2014); ?></option>
                <?php } ?>
            <?php } ?>
            </select>
            <select name="end_month" id="end_month" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=0;$i<12;$i++){ ?>
              <?php if(@$end_month==($i+1)){ ?>
                  <option value="<?php echo ($i+1); ?>" selected><?php echo ($i+1); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
              <?php }?>
            <?php } ?>
            </select>
        </td>
        <td>
        &nbsp就业薪资：
        <select name="follow_salary_from" id="follow_salary_from" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=1;$i<=10;$i++){ ?>
              <?php if(@$follow_salary_from==($i*1000)){ ?>
                  <option value="<?php echo ($i*1000); ?>" selected><?php echo ($i*1000); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i*1000); ?>"><?php echo ($i*1000); ?></option>
              <?php }?>
            <?php } ?>
            <?php if(@$follow_salary_from=="15000"){ ?>
                <option value="15000" selected>15000</option>
            <?php } else {?>
                <option value="15000">15000</option>
            <?php } ?>
            <?php if(@$follow_salary_from=="20000"){ ?>
                <option value="20000" selected>20000</option>
            <?php } else {?>
                <option value="20000">20000</option>
            <?php } ?>
        </select>
        &nbsp到&nbsp
        <select name="follow_salary_to" id="follow_salary_to" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=1;$i<=10;$i++){ ?>
              <?php if(@$follow_salary_to==($i*1000)){ ?>
                  <option value="<?php echo ($i*1000); ?>" selected><?php echo ($i*1000); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i*1000); ?>"><?php echo ($i*1000); ?></option>
              <?php }?>
            <?php } ?>
            <?php if(@$follow_salary_to=="15000"){ ?>
                <option value="15000" selected>15000</option>
            <?php } else {?>
                <option value="15000">15000</option>
            <?php } ?>
            <?php if(@$follow_salary_to=="20000"){ ?>
                <option value="20000" selected>20000</option>
            <?php } else {?>
                <option value="20000">20000</option>
            <?php } ?>
        </select>
        </td>
        <td>
        &nbsp性别：
        <select name="sex" id="sex" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php if(@$sex=="1"){ ?>
                <option value="1" selected>男</option>
            <?php } else {?>
                <option value="1">男</option>
            <?php } ?>
            <?php if(@$sex=="2"){ ?>
                <option value="2" selected>女</option>
            <?php } else {?>
                <option value="2">女</option>
            <?php } ?>
        </select>
        </td>
        <td></td>
        </tr>
        <tr>
        <td colspan="4">
        &nbsp任意查询：
            <input type="text" name="txtKey" id="txtKey" maxlength="20" style="width:350px" value="<?php echo @$txtKey ?>" />&nbsp
            <input id="search" type="submit" value=" 查 询 " onclick="search_click()"/>&nbsp
            <input id="search" type="button" value=" EXCEL批量下载 " onclick="download_click()" />
            <input type="hidden" name="download_flg" id="download_flg"/>
        </td>
        </tr>
    </table>
    <br>
        本科以上：<?php echo @$graduate_1 ?>人(<?php echo @$graduate_p_1 ?>%)&nbsp&nbsp本科：<?php echo @$graduate_2 ?>人(<?php echo @$graduate_p_2 ?>%)&nbsp&nbsp专科：<?php echo @$graduate_3 ?>人(<?php echo @$graduate_p_3 ?>%)&nbsp&nbsp专科以下：<?php echo @$graduate_4 ?>人(<?php echo @$graduate_p_4 ?>%)
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
