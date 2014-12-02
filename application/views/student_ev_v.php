<?php require_once("_header.php");?>
<script type="text/javascript">
    var searchData = <?php echo $searchData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '班级名称', name: 'class_name', align: 'left', width: 160 },
            { display: '课程名称', name: 'course_name', align: 'left', width: 160 },
            { display: '学生姓名', name: 'student_name', align: 'left', width: 160 }
            ],
            pageSize:10,
            data: $.extend(true,{},searchData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function search_click(){
        var class_name = document.form.class_name.value;
        var student_name = document.form.student_name.value;
        if (class_name=="" && student_name=="") {
            alert("班级名称和学生姓名请任意输入一个!");
            return;
        }
        document.form.submit();
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/student_ev_c/search';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
        &nbsp班级名称：
            <input type="text" name="class_name" id="class_name" maxlength="20" style="width:200px" value="<?php echo @$class_name ?>" />&nbsp
        &nbsp学生姓名：
            <input type="text" name="student_name" id="student_name" maxlength="20" style="width:200px" value="<?php echo @$student_name ?>" />&nbsp
            <input id="search" type="button" value=" 查 询 " onclick="search_click()"/>&nbsp
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
</html>
