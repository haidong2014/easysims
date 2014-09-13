<?php require_once("_header.php");?>
    <script type="text/javascript">
    var WorkslstData = <?php echo $workData?>;
        var grid = null;
        $(function () {
            grid = $("#maingrid").ligerGrid({
                columns: [
                { display: '作品编号', name: 'works_no', align: 'left', width: 80 },
                { display: '作品名称', name: 'works_name', align: 'left', width: 200 },
                { display: '作品作者', name: 'student_name', align: 'left', width: 80 },
                { display: '上传时间', name: 'update_time', align: 'left', width: 120 },
                { display: '作品分数', name: 'works_scores', align: 'left', width: 120 },
                { display: '作品点评', name: 'remarks', align: 'left', width: 120 }
                ],  
                pageSize:10,
                where : f_getWhere(),
                data: $.extend(true,{},WorkslstData), 
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
        function search_click()
        {
        }
        function regist_click()
        {
			location.href = "works_add.html";
        }
        function returnPage() {
            location.href = "works_subject.html";
        }
    </script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>  
<div id="searchbar">
<form name="form" method="post" action="<?php echo SITE_URL.'/works_c/works_lst';?>" id="form">
    编号或姓名：<input id="txtKey" name="txtKey" type="text" value="<?php echo $txtKey?>" />
    <input id="button" type="button" value=" 查 询 " onclick="javascript:document.form.submit();" />
	<input id="regist" type="button" value=" 上 传 " onclick="regist_click()" />
	<input id="download" type="button" value="批量下载" onclick="download_click()" />
    <input id="search" type="button" value=" 返 回 " onclick="returnPage()" />
    <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
    <input type="hidden" name="course_id" value="<?php echo $course_id ?>" />
    <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />
    </form>
</div>
<br>
<div id="maingrid" style="margin:0; padding:0"></div>
<div style="display:none;"></div>
</body>
</html>
