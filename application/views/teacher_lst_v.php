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
</script>
<div id="searchbar">
    编号或姓名：<input id="txtKey" type="text" />
    <input id="search" type="button" value=" 查 询 " onclick="search_click()" />
  <input id="regist" type="button" value=" 教师信息登录 " onclick="goreg()" />
</div>
  <br>
  <div id="maingrid4" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
  
  <!--  
  <table width="800" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999" >
    <tr style="background:blue;"  >
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>教师编号</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>教师姓名</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>性别</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>年龄</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>专/兼职</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>任课科目</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>手机号码</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>电子邮件</font></th>
    <th height="20" scope="row" style="text-align:center;vertical-align:middle"><font color=white>操作</font></th>
    </tr>
    <tr>
    <?php foreach($teacherData as $key => $value) {?>
    <td height="20" scope="row"><?php echo $value['teacher_no']?></td>
    <td height="20" scope="row"><?php echo $value['teacher_name']?></td>
    <td height="20" scope="row"><?php echo $sex_name[$value['sex']];?></td>
    <td height="20" scope="row"><?php echo $value['birthday']?></td>
    <td height="20" scope="row"><?php echo $value['property']?></td>
    <td height="20" scope="row"><?php echo $value['course']?></td>
    <td height="20" scope="row"><?php echo $value['telephone']?></td>
    <td height="20" scope="row"><?php echo $value['email']?></td>
    <td height="20" scope="row" style="text-align:center;vertical-align:middle">

    <a href="<?php echo SITE_URL;?>/teacher_c/view_teacher_init/<?php echo $value['teacher_no']?>">查看</a> |
    <a href="<?php echo SITE_URL;?>/teacher_c/upd_teacher_init/<?php echo $value['teacher_no']?>">编辑</a> |
    <a href="#" onclick="delTeacher('<?php echo SITE_URL;?>/teacher_c/delete_teacher/<?php echo $value['teacher_no']?>')">删除</a>
    </td>
    </tr>
    <?php }?>
  </table>

-->

