<?php require_once("_header.php");?>

<script type="text/javascript">
var studentsData = <?php echo $studentsData?>;
var grid = null;
$(function () {
    grid = $("#maingrid").ligerGrid({
        columns: [
        { display: '学生编号', name: 'student_no', align: 'left', width: 80 },
        { display: '学生姓名', name: 'student_name', align: 'left', width: 160 },
        { display: '性别', name: 'sex', align:'left', width: 60 },
        { display: '年龄', name: 'age',  align: 'left', width: 60 },
        { display: '联系方式 ', name: 'contact_way', align: 'left', width: 100 },
        { display: '家长电话', name: 'parent_phone', align: 'left', width: 100},
        { display: '操作', name: 'opt', align: 'center', width: 120}
        ],
        pageSize:10,
        where : f_getWhere(),
        data: $.extend(true,{},studentsData),
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
function goreg(){
    var mode = document.form.mode.value;
    var class_id = document.form.class_id.value;
    location.href='<?php echo SITE_URL;?>/student_c/add_student_init/'+mode+'/'+class_id;
}
function delstudent(parm){
    $.ligerDialog.confirm('确定要删除这名学生吗？', function (yes)
    {
        if(yes){
            location.href = parm;
        }
    });
}
function search_click()
{
    document.form.submit();
}
function returnPage() {
    var mode = document.form.mode.value;
    if (mode == "1") {
        location.href='<?php echo SITE_URL;?>/enrol_students_c';
    } else if (mode == "2") {
        location.href='<?php echo SITE_URL;?>/obtain_employment_c';
    } else {
        return;
    }
}
</script>

<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form id="form" name="form" method="post" action="<?php echo SITE_URL."/student_c";?>" >
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
          <?php if (empty($mode)) { ?>
            &nbsp入学年月：
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
              <?php }?>
            <?php } ?>
            </select>
          <?php } ?>
          &nbsp学生姓名：
          <input type="text" name="txtKey" id="txtKey" maxlength="20" style="width:200px" value="<?php echo @$txtKey ?>" />&nbsp
          <input type="submit" value=" 查 询 "  />&nbsp
          <?php if ($mode == "1") { ?>
              <input type="button" value=" 学生信息登录 " onclick="goreg()" />&nbsp
              <input type="button" value=" 返回 " onclick="returnPage()" />
          <?php } else if ($mode == "2") { ?>
              <input type="button" value=" 返回 " onclick="returnPage()" />
          <?php } else {?>
          <?php } ?>
          <input type="hidden" name="mode" id="mode" value="<?php echo @$mode?>" />
          <input type="hidden" name="class_id" id="class_id" value="<?php echo @$class_id?>" />
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>



