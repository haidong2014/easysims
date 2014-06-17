<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn">
<head>
    <title>易用学生管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/default.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/ligerui.all.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function ()
        {
            //布局
            $("#layout1").ligerLayout({ leftWidth: 190, height: '100%',heightDiff:-34,space:4 });
            $("#pageloading").hide();
            <?php if($errFlg==3){?>
                     	  $.ligerDialog.error('错误的用户名或密码');
          	<?php }?>
          	<?php if($errFlg==99){?>
                   	$.ligerDialog.success('设定成功');
                   	window.setTimeout( function(){
                   		location.href='<?php echo SITE_URL;?>/menu_c';
                    },2000);
            <?php }?>
        });
        function chkSubmit(){
            if(jQuery.trim(document.getElementById('txtUserName').value)==""){
            	$.ligerDialog.error('请输入用户名');return false;
            }
            if(jQuery.trim(document.getElementById('txtPassword').value)==""){
            	$.ligerDialog.error('请输入现密码');return false;
            }
            if(jQuery.trim(document.getElementById('txtNewPassword').value)==""){
            	$.ligerDialog.error('请输入新密码');return false;
            }
            if(jQuery.trim(document.getElementById('txtNewPasswordRep').value)==""){
            	$.ligerDialog.error('请输入密码确认');return false;
            }
            if(jQuery.trim(document.getElementById('txtNewPasswordRep').value)
                    !=jQuery.trim(document.getElementById('txtNewPassword').value)){
            	$.ligerDialog.error('新密码确认不一致');return false;
            }
            return true;
        }
        function rtnLogin(){
        	location.href='<?php echo SITE_URL;?>/login_c';
        }
     </script>
</head>
<body style="padding:0px;background:#EAEEF5;">
    <div id="pageloading"></div>
    <div id="topmenu" class="l-topmenu"></div>
    <div id="layout1" style="width:99.2%; margin:0 auto; margin-top:4px; ">
	    <BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
        <table width="210" height="130" border="0" align="center" cellpadding="2" cellspacing="0">
            <form name="passwordset" method="post" action="<?php echo SITE_URL;?>/passwordset_c/resetPwd" id="passwordset">
			    <tr>
                	<td align="right" class="l-table-edit-td">用户名:</td>
                    <td align="left" class="l-table-edit-td"><input name="txtUsername" type="text" style="width:130px;" id="txtUsername" value="<?php echo $txtUserName;?>" /></td>
                </tr>
                <tr>
                   <td align="right" class="l-table-edit-td">旧密码:</td>
                   <td align="left" class="l-table-edit-td"><input name="txtPassword" type="password" style="width:130px;" id="txtPassword"/></td>
                </tr>
                <tr>
                   <td align="right" class="l-table-edit-td">新密码:</td>
                   <td align="left" class="l-table-edit-td"><input name="txtNewPassword" type="password" style="width:130px;" id="txtNewPassword"/></td>
                </tr>
                <tr>
                   <td align="right" class="l-table-edit-td">密码确认:</td>
                   <td align="left" class="l-table-edit-td"><input name="txtNewPasswordRep" type="password" style="width:130px;" id="txtNewPasswordRep"/></td>
                </tr>
				<tr>
                   <td colspan="2" align="center">
                   	 <input type="submit" value="提交" id="login" class="l-button l-button" onclick="return chkSubmit();"/>
                   	 <input type="button" value="返回" id="reset" class="l-button l-button" onclick="return rtnLogin();"/>
		           </td>
                </tr>
            </form>
		</table>
    </div>
    <div style="height:32px; line-height:32px; text-align:center;">
            Copyright © 2014 www.easytech.com
    </div>
    <div style="display:none"></div>
</body>
</html>
