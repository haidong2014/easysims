<?php require_once("_header.php");?>
<?php $sex_name=array(1=>'男',2=>'女');?>
<script type="text/javascript">
var classData = <?php echo $classsData ?>;
var grid = null;
$(function () {
    grid = $("#maingrid4").ligerGrid({
        columns: [
        { display: '班级编号', name: 'class_no', align: 'left', width: 80 },
        { display: '班级名称', name: 'class_name', align: 'left', width: 160 },
        { display: '开始日期', name: 'start_date', align: 'left', width: 80 },
        { display: '结束日期', name: 'end_date', align: 'left', width: 80 },
        { display: '班主任', name: 'teacher_name', align: 'left', width: 80 },
        { display: '教室', name: 'class_room', align: 'left', width: 80 },
        { display: '人数', name: 'numbers', align: 'left', width: 80 },
        { display: '状态', name: 'status', align: 'left', width: 80 },
        { display: '操作', name: 'opt', align: 'center'}
        ],  
        pageSize:10,
        where : f_getWhere(),
        data: $.extend(true,{},classData), 
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
  location.href='<?php echo SITE_URL;?>/class_c/add_class_init';
}
function delclass(parm){
  $.ligerDialog.confirm('确定要删除这个班级吗？', function (yes)
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
<form id="form" name="form" method="post" action="<?php echo SITE_URL."/class_c";?>" >
    编号或名称：<input id="txtKey" name="txtKey"  type="text" value="<?php echo @$txtKey?>"/>
    <input id="search" type="button" value=" 查 询 " onclick="search_click()" />
  <input id="regist" type="button" value=" 班级信息登录 " onclick="goreg()" /></form>
</div>
  <br>
  <div id="maingrid4" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
