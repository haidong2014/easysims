<?php require_once("_header.php");?>
<?php $sex_name=array(1=>'男',2=>'女');?>
<script type="text/javascript">
var studentsData = <?php echo $studentsData?>;
var grid = null;
$(function () {
    grid = $("#maingrid4").ligerGrid({
        columns: [
        { display: '学生编号', name: 'student_id', align: 'left', width: 80 },
        { display: '学生姓名', name: 'student_name', align: 'left', width: 160 },
        { display: '性别', name: 'sex', align:'left', width: 60 },
        { display: '年龄', name: 'birthday',  align: 'left', width: 60 },
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
  $.ligerDialog.confirm('确定要删除这名老师吗？', function (yes)
  {
      if(yes){
          location.href = parm;
      }
  });
}
</script>
<div id="searchbar">
    编号或姓名：<input id="txtKey" type="text" />
    <input id="search" type="button" value=" 查 询 " onclick="search_click()" />
  <input id="regist" type="button" value=" 学生信息登录 " onclick="goreg()" />
</div>
  <br>
  <div id="maingrid4" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
  
  <!--  
  <table width="800" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999" >
    <tr style="background:blue;"  >
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>学生编号</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>学生姓名</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>性别</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>年龄</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>专/兼职</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>任课科目</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>手机号码</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>电子邮件</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>操作</font></th>
    </tr>
    <tr>
    <?php foreach($studentData as $key => $value) {?>
    <td height="20" scope="row"><?php echo $value['student_id']?></td>
    <td height="20" scope="row"><?php echo $value['student_name']?></td>
    <td height="20" scope="row"><?php echo $sex_name[$value['sex']];?></td>
    <td height="20" scope="row"><?php echo $value['birthday']?></td>
    <td height="20" scope="row"><?php echo $value['contact_way']?></td>
    <td height="20" scope="row"><?php echo $value['parent_phone']?></td>

    <td height="20" scope="row" style="text-align:center;vertical-align:middle">

    <a href="<?php echo SITE_URL;?>/student_c/view_student_init/<?php echo $value['student_id']?>">查看</a> |
    <a href="<?php echo SITE_URL;?>/student_c/upd_student_init/<?php echo $value['student_id']?>">编辑</a> |
    <a href="#" onclick="delstudent('<?php echo SITE_URL;?>/student_c/delete_student/<?php echo $value['student_id']?>')">删除</a>
    </td>
    </tr>
    <?php }?>
  </table>

-->

