<?php require_once("_header.php");?>
<?php $sex_name=array(1=>'男',2=>'女');?>
<script type="text/javascript">
function goreg(){
	location.href='<?php echo SITE_URL;?>/teacher_c/add_teacher_init';
}
</script>
<div id="searchbar">
    编号或姓名：<input id="txtKey" type="text" />
    <input id="search" type="button" value=" 查 询 " onclick="search_click()" />
	<input id="regist" type="button" value=" 教师信息登录 " onclick="goreg()" />
</div>
	<br>
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
		
		<a href="<?php echo SITE_URL;?>/teacher_c/view_teacher_init/<?php echo $value['teacher_id']?>">查看</a> | 
		<a href="<?php echo SITE_URL;?>/teacher_c/upd_teacher_init/<?php echo $value['teacher_id']?>">编辑</a> | 
		<a href="<?php echo SITE_URL;?>/teacher_c/delete_teacher/<?php echo $value['teacher_id']?>">删除</a>
		</td>
	  </tr>
	  <?php }?>
	</table>


