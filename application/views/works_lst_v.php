<?php require_once("_header.php");?>
    <script type="text/javascript">
    var WorkslstData = <?php echo $workData?>;
        var grid = null;
        $(function () {
            grid = $("#maingrid").ligerGrid({
                columns: [
                { display: '作品编号', name: 'works_no', align: 'left', width: 150 },
                { display: '作品名称', name: 'works_name', align: 'left', width: 200 },
                { display: '作品作者', name: 'student_name', align: 'left', width: 80 },
                { display: '上传时间', name: 'update_time', align: 'left', width: 120 },
                { display: '作品分数', name: 'works_scores', align: 'left', width: 120 },
                { display: '作品点评', name: 'remarks', align: 'left', width: 120 }
                ],
                pageSize:10,
                data: $.extend(true,{},WorkslstData),
                width: '100%',height:'100%'
            });

            $("#pageloading").hide();
        });
        function regist_click(){
            location.href = "<?php echo SITE_URL.'/works_c/works_upload_init/'.$class_id.'/'.$course_id.'/'.$subject_id;?>";
        }
        function returnPage() {
            location.href = "<?php echo SITE_URL.'/works_c/subject_lst/'.$class_id.'/'.$course_id.'/'.$subject_id;?>";
        }
        function download_click(){
            document.dlform.submit();
        }
    </script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/works_c/works_lst';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp作品名称：
            <input id="txtKey" name="txtKey" type="text" maxlength="20" style="width:200px" value="<?php echo $txtKey?>" />&nbsp
            <input id="button" type="button" value=" 查 询 " onclick="javascript:document.form.submit();" />&nbsp
            <input id="regist" type="button" value=" 上 传 " onclick="regist_click()" />&nbsp
            <input id="download" type="button" value="批量下载" onclick="download_click()" />&nbsp
            <input id="search" type="button" value=" 返 回 " onclick="returnPage()" />
            <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
            <input type="hidden" name="course_id" value="<?php echo $course_id ?>" />
            <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />
        </tr>
    </table>
</form>
<form name="dlform"  method="post" action="<?php echo SITE_URL.'/works_c/works_download_exec';?>" >
    <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
    <input type="hidden" name="course_id" value="<?php echo $course_id ?>" />
    <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />
</form>
<br>
<div id="maingrid" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
</body>
</html>