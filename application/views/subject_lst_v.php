<?php require_once("_header.php");?>
<script type="text/javascript">
var subjectData = <?php echo $subjectData?>;
var grid = null;
$(function () {
    grid = $("#maingrid").ligerGrid({
        columns: [
        { display: '科目ID', name: 'subject_id', align: 'left', width: 80 },
        { display: '科目名称', name: 'subject_name', align: 'left', width: 160 },
        { display: '周期', name: 'period', align: 'left', width: 80 },
        { display: '操作', name: 'opt', align: 'center', width: 120}
        ],
        pageSize:10,
        where : f_getWhere(),
        data: $.extend(true,{},subjectData),
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
  location.href='<?php echo SITE_URL;?>/subject_c/add_subject_init';
}
function delsubject(parm){
  $.ligerDialog.confirm('确定要删除这个科目吗？', function (yes)
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
<form id="form" name="form" method="post" action="<?php echo SITE_URL."/subject_c";?>" >
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
         科目名称：
        <input id="txtKey" name="txtKey"  type="text" maxlength="20" style="width:200px" value="<?php echo @$txtKey?>"/>&nbsp
        <input id="search" type="submit" value=" 查 询 " />&nbsp
        <input id="regist" type="button" value=" 科目信息登录 " onclick="goreg()" /></form>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
    <input type="hidden" name="course_id" value="<?php echo @$course_id?>" />
</form>
<div style="display:none;"></div>
</body>
