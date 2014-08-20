<?php require_once("_header.php");?>
<script type="text/javascript">
var teachersData = <?php echo $teachersData?>;
var grid = null;
$(function () {
    grid = $("#maingrid").ligerGrid({
        columns: [
        { display: '教师编号', name: 'teacher_no', align: 'left', width: 80 },
        { display: '教师姓名', name: 'teacher_name', align: 'left', width: 120 },
        { display: '性别', name: 'sex_name', align:'left', width: 60 },
        { display: '年龄', name: 'age',  align: 'left', width: 60 },
        { display: '专/兼职', name: 'property_name', align: 'left', width: 60 },
        { display: '任课科目', name: 'course', align: 'left', width: 160  },
        { display: '手机号码', name: 'telephone', align: 'left', width: 120  },
        { display: '电子邮件', name: 'email', align: 'left', width: 120  },
        { display: '操作', name: 'opt', align: 'center', width: 120}
        ],
        pageSize:10,
        where : f_getWhere(),
        data: $.extend(true,{},teachersData),
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
  location.href='<?php echo SITE_URL;?>/teacher_c/add_teacher_init';
}
function delTeacher(parm){
  $.ligerDialog.confirm('确定要删除这名老师吗？', function (yes)
  {
      if(yes){
          location.href = parm;
      }
  });
}
</script>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form id="form" name="form" method="post" action="<?php echo SITE_URL."/teacher_c";?>" >
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        教师姓名：
       <input id="txtKey" name="txtKey"  type="text" maxlength="20" style="width:200px" value="<?php echo @$keyword?>"/>&nbsp
       <input id="search" type="submit" value=" 查 询 " />&nbsp
       <input id="regist" type="button" value=" 教师信息登录 " onclick="goreg()" />
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>