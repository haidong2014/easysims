<?php require_once("_header.php");?>

<script type="text/javascript">
var studentsData = <?php echo $studentsData?>;
var grid = null;
$(function () {
    grid = $("#maingrid4").ligerGrid({
        columns: [
        { display: '学生编号', name: 'student_no', align: 'left', width: 80 },
        { display: '学生姓名', name: 'student_name', align: 'left', width: 160 },
        { display: '性别', name: 'sex', align:'left', width: 60 },
        { display: '年龄', name: 'age',  align: 'left', width: 60 },
        { display: '联系方式 ', name: 'contact_way', align: 'left', width: 60 },
        { display: '家长电话', name: 'parent_phone', align: 'left' },
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
  location.href='<?php echo SITE_URL;?>/student_c/add_student_init';
}
function delstudent(parm){
  $.ligerDialog.confirm('确定要删除这名学生吗？', function (yes)
  {
      if(yes){
          location.href = parm;
      }
  });
}
</script>
<div id="searchbar">
<form id="form" name="form" method="post" action="<?php echo SITE_URL."/student_c";?>" >
 &nbsp入学年月：
	<select name="start_year" id="start_year" ltype="select">
		<option value="0"></option>
		<?php for($i=0;$i<20;$i++){ ?>
				<?php if(@$start_year==($i+2000)){ ?>
				<option value="<?php echo ($i+2000); ?> " selected><?php echo ($i+2000); ?></option>
				<? }else {?>
				<option value="<?php echo ($i+2000); ?> "><?php echo ($i+2000); ?></option>
				<?php } ?>
		<?php } ?>

	</select>
	<select name="start_month" id="start_month" ltype="select">
		<option value="0"></option>
		<?php for($i=0;$i<12;$i++){ ?>
			 <?php if(@$start_month==($i+1)){ ?>
			<option value="<?php echo ($i+1); ?> " selected><?php echo ($i+1); ?>月</option>
			<?php }else{?>
			<option value="<?php echo ($i+1); ?> "><?php echo ($i+1); ?>月</option>
			<?php }?>
		<?php } ?>
	</select>
    编号或姓名：<input id="txtKey" type="text" value="<?php echo $txtKey ?>" />
    <input id="search" type="submit" value=" 查 询 "  />
  <input id="regist" type="button" value=" 学生信息登录 " onclick="goreg()" />
  </form>
</div>
  <br>
  <div id="maingrid4" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
  
  

