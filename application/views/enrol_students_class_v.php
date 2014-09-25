<?php require_once("_header.php");?>
<script type="text/javascript">
    var classData = <?php echo $classData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '班级编号', name: 'class_no', align: 'left', width: 80 },
            { display: '班级名称', name: 'class_name', align: 'left', width: 160 },
            { display: '课程名称', name: 'course_name', align: 'left', width: 160 },
            { display: '开课日期', name: 'start_date', align:'left', width: 80 },
            { display: '结课日期', name: 'end_date',  align: 'left', width: 80 },
            { display: '班主任', name: 'teacher_name', align: 'left', width: 80 },
            { display: '教室', name: 'class_room', align: 'left', width: 80 },
            { display: '名额', name: 'numbers', align: 'left', width: 80 },
            { display: '学费', name: 'cost', align: 'left', width: 80 },
            { display: '状态', name: 'code_name', align: 'left', width: 60 },
            { display: '备注', name: 'remarks', align: 'left', width: 300 }
            ],
            pageSize:10,
            data: $.extend(true,{},classData),
            width: '100%',height:'100%'
        });

        $("#pageloading").hide();
    });
    function search_click()
    {
        document.form.submit();
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/enrol_students_c/';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp开课年月:
            <select name="start_year" id="start_year" onchange="search_click()">
                <?php for($i=0;$i<12;$i++){ ?>
                    <?php if(@$start_year==($i+2014)){ ?>
                        <option value="<?php echo ($i+2014); ?>" selected><?php echo ($i+2014); ?></option>
                    <?php } else {?>
                        <option value="<?php echo ($i+2014); ?>"><?php echo ($i+2014); ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <select name="start_month" id="start_month" onchange="search_click()">
                <?php for($i=0;$i<12;$i++){ ?>
                  <?php if(@$start_month==($i+1)){ ?>
                      <option value="<?php echo ($i+1); ?>" selected><?php echo ($i+1); ?></option>
                  <?php } else {?>
                      <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
                  <?php } ?>
                <?php } ?>
            </select>
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