<?php require_once("_header.php");?>
<script type="text/javascript">
var jobData = <?php echo $jobData?>;
var grid = null;
$(function () {
    grid = $("#maingrid").ligerGrid({
        columns: [
        { display: '企业ID', name: 'job_id', align: 'left', width: 80 },
        { display: '企业名称', name: 'job_company', align: 'left', width: 300 },
        { display: '所在城市', name: 'job_city', align: 'left', width: 150 },
        { display: '企业电话', name: 'job_phone', align: 'left', width: 100 },
        { display: '在职人数', name: 'job_onjob', align: 'left', width: 80 },
        { display: '操作', name: 'opt', align: 'center', width: 120}
        ],
        pageSize:10,
        data: $.extend(true,{},jobData),
        width: '100%',height:'100%'
    });

    $("#pageloading").hide();
});
function goreg(){
  location.href='<?php echo SITE_URL;?>/job_c/add_job_init';
}
function deljob(parm){
  $.ligerDialog.confirm('确定要删除这个企业吗？', function (yes)
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
<form id="form" name="form" method="post" action="<?php echo SITE_URL."/job_c";?>" >
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
         企业名称：
        <input id="txtKey" name="txtKey"  type="text" maxlength="20" style="width:200px" value="<?php echo @$txtKey?>"/>&nbsp
        <input id="search" type="submit" value=" 查 询 " />&nbsp
        <input id="regist" type="button" value=" 企业登录 " onclick="goreg()" />
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
