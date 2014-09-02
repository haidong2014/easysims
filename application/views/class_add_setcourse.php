<?php require_once("_header.php");?>

    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerDateEditor.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerComboBox.js" type="text/javascript"></script>
<script type="text/javascript">
    var subjectData = <?php echo $subjectData?>;
    var teacherData = <?php echo $teacherData?>;
    var manager, g;
    $(function () {
        alert("请继续设定课程的科目信息！");
        g = manager = $("#maingrid").ligerGrid({
            columns: [
            { display: '科目编号', name: 'subject_id', align: 'left', width: 80 },
            { display: '科目名称', name: 'subject_name', align: 'left', width: 200 },
            { display: '周期', name: 'period', align: 'left', width: 80 },
            { display: '开始日期', name: 'start_date', type: 'date', width: 100 ,
                editor: { type: 'date' }
            },
            { display: '结束日期', name: 'end_date', type: 'date', width: 100 ,
                editor: { type: 'date' }
            },
            { display: '任课教师', width: 120, name: 'teacher_id',
                editor: { type: 'select', data: teacherData, valueField: 'teacher_id', textField: 'teacher_name' },
                render: function (item){
                         for (var i = 0; i < teacherData.length; i++)
                         {
                             if (teacherData[i]['teacher_id'] == item.teacher_id)
                                 return teacherData[i]['teacher_name']
                         }
                         return item.teacher_name;
                     }
            },
            { display: '操作', isSort: false, width: 120, render: function (rowdata, rowindex, value)
            {
                var h = "";
                if (!rowdata._editing)
                {
                    h += "<a href='javascript:beginEdit(" + rowindex + ")'>修改</a> ";
                }
                else
                {
                    h += "<a href='javascript:endEdit(" + rowindex + ")'>提交</a> ";
                }
                return h;
            }
            }
            ],
            onSelectRow: function (rowdata, rowindex)
            {
                $("#txtrowindex").val(rowindex);
            },
            enabledEdit: true,clickToEdit:false, isScroll: false,
            data: subjectData,
            width: '100%', height: '97%',
            rownumbers: true,
            fixedCellHeight:false


        });
        $("#pageloading").hide();
    });
    function beginEdit(rowid) {
        manager.beginEdit(rowid);
    }
    function getYmd(date){
    	var year = date.getYear();
    	if(year<2000){
    		year = year+1900;
    	}
    	var month = date.getMonth()+1;
    	var day= date.getDay();
    	var result = ''+ year;
    	if(month<10){
    		result+='-0'+month;
    	}else{
    		result+='-'+month;
    	}
    	if(day<10){
    		result+='-0'+day;
    	}else{
    		result+='-'+day;
    	}
    	return result;
    }
    function endEdit(rowid)
    {
        manager.endEdit(rowid);
        var row = g.getSelectedRow();
        var start = row['start_date'];
        var end = row['end_date'];
        var subject_id = row['subject_id'];
        var class_id = document.getElementById('class_id').value;
        var course_id = document.getElementById('course_id').value;
        //alert(getYmd(start));
		var teacher_id = row['teacher_id'];
        var jqxhr = $.post("<?php echo SITE_URL.'/class_c/update_subject/';?>"+class_id+'/'+course_id+'/'+subject_id+'/' + getYmd(start)+'/'+getYmd(end)+'/'+teacher_id, function(data) {
                showMsg(data);
            });
    }
    function showMsg(data){
          if (data != "") {
              alert(data.replace(/\"/g, ""));
              //document.form.txtUser.value = "";
              //document.form.txtPassword.value = "";
          }
        }
    function returnPage() {
        class_id = document.form.class_id.value;
        location.href='<?php echo SITE_URL;?>/class_c/upd_class_init/'+class_id;
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

<body style="padding:10px">
<div id="pageloading"></div>
<div id="maingrid" style="margin:0; padding:0;height:500px;"></div>
<form name="form" method="post" action="" id="form">
  <br />
  
  <br />
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
    <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id ?>" />
    <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id ?>" />
</form>
<div style="display:none"></div>
</body>
</html>