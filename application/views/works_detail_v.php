<?php require_once("_header.php");?>
    <script type="text/javascript">
        $(function () {

            $("#pageloading").hide();
        });
        function f_search()
        {
        }
 function returnPage() {
      location.href = "<?php echo SITE_URL?>/works_c/works_lst/<?php echo $class_id.'/'.$course_id.'/'.$subject_id ?>";
    }
    function dlfl(){
    	document.dlform.submit();
    }
    </script>
    <style type="text/css">
        body{ font-size:12px;}
        .l-table-edit {}
        .l-table-edit-td{ padding:4px;}
        .l-button-submit,.l-button-reset{width:80px; float:left; margin-left:10px; padding-bottom:2px;}
        .l-verify-tip{ left:230px; top:120px;}
    </style>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div>
  <br>
    <form name="form1" method="post" action="" id="form1">
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
            <tr>
                <td align="left" class="l-table-edit-td">作品名称</td>
                <td align="left" class="l-table-edit-td"><?php echo $works_name?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="left" class="l-table-edit-td">作品描述</td>
                <td align="left" class="l-table-edit-td"><?php echo $works_description?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="left" class="l-table-edit-td">作品分数</td>
                <td align="left" class="l-table-edit-td"><?php echo $works_scores?></td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="left" class="l-table-edit-td">作品点评</td>
                <td align="left" class="l-table-edit-td"><?php echo $works_comment?></td>
                <td align="left"></td>
            </tr>
      <tr>
          <td colspan="3" align="center" style="padding:5px;" ><image src="<?php echo SITE_URL."/images/uploads/".$works_path?>" height="300" /></td>
            </tr>
        </table>
    <br />
    <input type="button" value="下载" class="l-button l-button-submit" onclick="dlfl()"/>
        <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
    </form>
    <form name="dlform"  method="post" action="<?php echo SITE_URL.'/works_c/works_download_one_exec';?>" >
    <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
    <input type="hidden" name="course_id" value="<?php echo $course_id ?>" />
    <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />
    <input type="hidden" name="works_no" value="<?php echo $works_no ?>" />
    </form>
</div>
</body>
</html>
