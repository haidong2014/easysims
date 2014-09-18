<?php require_once("_header.php");?>
<script type="text/javascript">
var courseData = <?php echo $coursesData?>;
var grid = null;
$(function () {
    grid = $("#maingrid").ligerGrid({
        columns: [
        { display: '课程ID', name: 'course_id_v', align: 'left', width: 80 },
        { display: '课程名称', name: 'course_name', align: 'left', width: 160 },
        { display: '操作', name: 'opt', align: 'center', width: 120}
        ],
        pageSize:10,
        data: $.extend(true,{},courseData),
        width: '100%',height:'100%'
    });

    $("#pageloading").hide();
});
function goreg(){
  location.href='<?php echo SITE_URL;?>/course_c/add_course_init';
}
function delcourse(parm){
  $.ligerDialog.confirm('确定要删除这个课程吗？', function (yes)
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
<form id="form" name="form" method="post" action="<?php echo SITE_URL."/course_c";?>" >
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
         课程名称：
        <input id="txtKey" name="txtKey"  type="text" maxlength="20" style="width:200px" value="<?php echo @$txtKey?>"/>&nbsp
        <input id="search" type="submit" value=" 查 询 " />&nbsp
        <input id="regist" type="button" value=" 课程信息登录 " onclick="goreg()" />
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
