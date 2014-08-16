<?php require_once("_header.php");?>
<?php $sex_name=array(1=>'男',2=>'女');?>
<script type="text/javascript">
var TeachersData = <?php echo $teachersData?>;
var grid = null;
$(function () {
    grid = $("#maingrid4").ligerGrid({
        columns: [
        { display: '教师编号', name: 'teacher_no', align: 'left', width: 80 },
        { display: '教师姓名', name: 'teacher_name', align: 'left', width: 160 },
        { display: '性别', name: 'sex', align:'left', width: 60 },
        { display: '年龄', name: 'age',  align: 'left', width: 60 },
        { display: '专/兼职', name: 'property', align: 'left', width: 60 },
        { display: '任课科目', name: 'course', align: 'left' },
        { display: '手机号码', name: 'telephone', align: 'left' },
        { display: '电子邮件', name: 'email', align: 'left' },
        { display: '操作', name: 'opt', align: 'center', width: 120}
        ],  
        pageSize:10,
        where : f_getWhere(),
        data: $.extend(true,{},TeachersData), 
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
function search_click(){
	document.form.submit();
}
</script>
<div id="searchbar">
<form id="form" name="form" method="post" action="<?php echo SITE_URL."/teacher_c";?>" >
    编号或姓名：<input id="txtKey" name="txtKey"  type="text" value="<?php echo @$txtKey?>"/>
    <input id="search" type="button" value=" 查 询 " onclick="search_click()" />
  <input id="regist" type="button" value=" 教师信息登录 " onclick="goreg()" /></form>
</div>
  <br>
  <div id="maingrid4" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
