<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>教师满意度调查</title>
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/core/base.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerForm.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerDateEditor.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerButton.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerRadio.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/plugins/ligerTextBox.js" type="text/javascript"></script>
    <script type="text/javascript">
        var eee;
        $(function ()
        {
            $("form").ligerForm();
            $("#pageloading").hide();
        });

        function addSatisfaction(){
            document.form.submit();
        }
        function returnPage(){
            var class_id = document.form.class_id.value;
            var course_id = document.form.course_id.value;
            location.href='<?php echo SITE_URL;?>/evaluation_c/subject_lst/'+class_id+"/"+course_id;
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
<form name="form" method="post" action="<?php echo SITE_URL.'/evaluation_c/satisfaction_add';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">1.专业技术能力:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_01_5" type="radio" name="scores_01" value="5" <?php echo (@$scores_01==5?"checked":"")?>/><label for="scores_01_5">A.5</label>
                <input id="scores_01_4" type="radio" name="scores_01" value="4" <?php echo (@$scores_01==4?"checked":"")?>/><label for="scores_01_4">B.4</label>
                <input id="scores_01_3" type="radio" name="scores_01" value="3" <?php echo (@$scores_01==3?"checked":"")?>/><label for="scores_01_3">C.3</label>
                <input id="scores_01_2" type="radio" name="scores_01" value="2" <?php echo (@$scores_01==2?"checked":"")?>/><label for="scores_01_2">D.2</label>
                <input id="scores_01_1" type="radio" name="scores_01" value="1" <?php echo (@$scores_01==1?"checked":"")?>/><label for="scores_01_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">2.授课过程中的操作熟练度:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_02_5" type="radio" name="scores_02" value="5" <?php echo (@$scores_02==5?"checked":"")?>/><label for="scores_02_5">A.5</label>
                <input id="scores_02_4" type="radio" name="scores_02" value="4" <?php echo (@$scores_02==4?"checked":"")?>/><label for="scores_02_4">B.4</label>
                <input id="scores_02_3" type="radio" name="scores_02" value="3" <?php echo (@$scores_02==3?"checked":"")?>/><label for="scores_02_3">C.3</label>
                <input id="scores_02_2" type="radio" name="scores_02" value="2" <?php echo (@$scores_02==2?"checked":"")?>/><label for="scores_02_2">D.2</label>
                <input id="scores_02_1" type="radio" name="scores_02" value="1" <?php echo (@$scores_02==1?"checked":"")?>/><label for="scores_02_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">3.课堂上解决问题、排除错误的能力:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_03_5" type="radio" name="scores_03" value="5" <?php echo (@$scores_03==5?"checked":"")?>/><label for="scores_03_5">A.5</label>
                <input id="scores_03_4" type="radio" name="scores_03" value="4" <?php echo (@$scores_03==4?"checked":"")?>/><label for="scores_03_4">B.4</label>
                <input id="scores_03_3" type="radio" name="scores_03" value="3" <?php echo (@$scores_03==3?"checked":"")?>/><label for="scores_03_3">C.3</label>
                <input id="scores_03_2" type="radio" name="scores_03" value="2" <?php echo (@$scores_03==2?"checked":"")?>/><label for="scores_03_2">D.2</label>
                <input id="scores_03_1" type="radio" name="scores_03" value="1" <?php echo (@$scores_03==1?"checked":"")?>/><label for="scores_03_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">4.解答学员提出问题的能力:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_04_5" type="radio" name="scores_04" value="5" <?php echo (@$scores_04==5?"checked":"")?>/><label for="scores_04_5">A.5</label>
                <input id="scores_04_4" type="radio" name="scores_04" value="4" <?php echo (@$scores_04==4?"checked":"")?>/><label for="scores_04_4">B.4</label>
                <input id="scores_04_3" type="radio" name="scores_04" value="3" <?php echo (@$scores_04==3?"checked":"")?>/><label for="scores_04_3">C.3</label>
                <input id="scores_04_2" type="radio" name="scores_04" value="2" <?php echo (@$scores_04==2?"checked":"")?>/><label for="scores_04_2">D.2</label>
                <input id="scores_04_1" type="radio" name="scores_04" value="1" <?php echo (@$scores_04==1?"checked":"")?>/><label for="scores_04_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">5.教师授课声音洪亮、语言流畅、准确、有感染力:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_05_5" type="radio" name="scores_05" value="5" <?php echo (@$scores_05==5?"checked":"")?>/><label for="scores_05_5">A.5</label>
                <input id="scores_05_4" type="radio" name="scores_05" value="4" <?php echo (@$scores_05==4?"checked":"")?>/><label for="scores_05_4">B.4</label>
                <input id="scores_05_3" type="radio" name="scores_05" value="3" <?php echo (@$scores_05==3?"checked":"")?>/><label for="scores_05_3">C.3</label>
                <input id="scores_05_2" type="radio" name="scores_05" value="2" <?php echo (@$scores_05==2?"checked":"")?>/><label for="scores_05_2">D.2</label>
                <input id="scores_05_1" type="radio" name="scores_05" value="1" <?php echo (@$scores_05==1?"checked":"")?>/><label for="scores_05_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">6.思维敏捷、逻辑性强、案例讲解通俗易懂、条理透彻:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_06_5" type="radio" name="scores_06" value="5" <?php echo (@$scores_06==5?"checked":"")?>/><label for="scores_06_5">A.5</label>
                <input id="scores_06_4" type="radio" name="scores_06" value="4" <?php echo (@$scores_06==4?"checked":"")?>/><label for="scores_06_4">B.4</label>
                <input id="scores_06_3" type="radio" name="scores_06" value="3" <?php echo (@$scores_06==3?"checked":"")?>/><label for="scores_06_3">C.3</label>
                <input id="scores_06_2" type="radio" name="scores_06" value="2" <?php echo (@$scores_06==2?"checked":"")?>/><label for="scores_06_2">D.2</label>
                <input id="scores_06_1" type="radio" name="scores_06" value="1" <?php echo (@$scores_06==1?"checked":"")?>/><label for="scores_06_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">7.具有较强的语言控制力、表达和操作速度让学生能够很好的接受:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_07_5" type="radio" name="scores_07" value="5" <?php echo (@$scores_07==5?"checked":"")?>/><label for="scores_07_5">A.5</label>
                <input id="scores_07_4" type="radio" name="scores_07" value="4" <?php echo (@$scores_07==4?"checked":"")?>/><label for="scores_07_4">B.4</label>
                <input id="scores_07_3" type="radio" name="scores_07" value="3" <?php echo (@$scores_07==3?"checked":"")?>/><label for="scores_07_3">C.3</label>
                <input id="scores_07_2" type="radio" name="scores_07" value="2" <?php echo (@$scores_07==2?"checked":"")?>/><label for="scores_07_2">D.2</label>
                <input id="scores_07_1" type="radio" name="scores_07" value="1" <?php echo (@$scores_07==1?"checked":"")?>/><label for="scores_07_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">8.课堂气氛是否活跃、能够调动学员的积极性:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_08_5" type="radio" name="scores_08" value="5" <?php echo (@$scores_08==5?"checked":"")?>/><label for="scores_08_5">A.5</label>
                <input id="scores_08_4" type="radio" name="scores_08" value="4" <?php echo (@$scores_08==4?"checked":"")?>/><label for="scores_08_4">B.4</label>
                <input id="scores_08_3" type="radio" name="scores_08" value="3" <?php echo (@$scores_08==3?"checked":"")?>/><label for="scores_08_3">C.3</label>
                <input id="scores_08_2" type="radio" name="scores_08" value="2" <?php echo (@$scores_08==2?"checked":"")?>/><label for="scores_08_2">D.2</label>
                <input id="scores_08_1" type="radio" name="scores_08" value="1" <?php echo (@$scores_08==1?"checked":"")?>/><label for="scores_08_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">9.整个课程的进度把握安排:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_09_5" type="radio" name="scores_09" value="5" <?php echo (@$scores_09==5?"checked":"")?>/><label for="scores_09_5">A.5</label>
                <input id="scores_09_4" type="radio" name="scores_09" value="4" <?php echo (@$scores_09==4?"checked":"")?>/><label for="scores_09_4">B.4</label>
                <input id="scores_09_3" type="radio" name="scores_09" value="3" <?php echo (@$scores_09==3?"checked":"")?>/><label for="scores_09_3">C.3</label>
                <input id="scores_09_2" type="radio" name="scores_09" value="2" <?php echo (@$scores_09==2?"checked":"")?>/><label for="scores_09_2">D.2</label>
                <input id="scores_09_1" type="radio" name="scores_09" value="1" <?php echo (@$scores_09==1?"checked":"")?>/><label for="scores_09_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">10.对讲授内容有适时的复习和总结:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_10_5" type="radio" name="scores_10" value="5" <?php echo (@$scores_10==5?"checked":"")?>/><label for="scores_10_5">A.5</label>
                <input id="scores_10_4" type="radio" name="scores_10" value="4" <?php echo (@$scores_10==4?"checked":"")?>/><label for="scores_10_4">B.4</label>
                <input id="scores_10_3" type="radio" name="scores_10" value="3" <?php echo (@$scores_10==3?"checked":"")?>/><label for="scores_10_3">C.3</label>
                <input id="scores_10_2" type="radio" name="scores_10" value="2" <?php echo (@$scores_10==2?"checked":"")?>/><label for="scores_10_2">D.2</label>
                <input id="scores_10_1" type="radio" name="scores_10" value="1" <?php echo (@$scores_10==1?"checked":"")?>/><label for="scores_10_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">11.所讲内容重点是否突出:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_11_5" type="radio" name="scores_11" value="5" <?php echo (@$scores_11==5?"checked":"")?>/><label for="scores_11_5">A.5</label>
                <input id="scores_11_4" type="radio" name="scores_11" value="4" <?php echo (@$scores_11==4?"checked":"")?>/><label for="scores_11_4">B.4</label>
                <input id="scores_11_3" type="radio" name="scores_11" value="3" <?php echo (@$scores_11==3?"checked":"")?>/><label for="scores_11_3">C.3</label>
                <input id="scores_11_2" type="radio" name="scores_11" value="2" <?php echo (@$scores_11==2?"checked":"")?>/><label for="scores_11_2">D.2</label>
                <input id="scores_11_1" type="radio" name="scores_11" value="1" <?php echo (@$scores_11==1?"checked":"")?>/><label for="scores_11_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">12.是否合理把握课堂授课节奏，不过快或拖堂:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_12_5" type="radio" name="scores_12" value="5" <?php echo (@$scores_12==5?"checked":"")?>/><label for="scores_12_5">A.5</label>
                <input id="scores_12_4" type="radio" name="scores_12" value="4" <?php echo (@$scores_12==4?"checked":"")?>/><label for="scores_12_4">B.4</label>
                <input id="scores_12_3" type="radio" name="scores_12" value="3" <?php echo (@$scores_12==3?"checked":"")?>/><label for="scores_12_3">C.3</label>
                <input id="scores_12_2" type="radio" name="scores_12" value="2" <?php echo (@$scores_12==2?"checked":"")?>/><label for="scores_12_2">D.2</label>
                <input id="scores_12_1" type="radio" name="scores_12" value="1" <?php echo (@$scores_12==1?"checked":"")?>/><label for="scores_12_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">13.课堂讲授内容准备充分:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_13_5" type="radio" name="scores_13" value="5" <?php echo (@$scores_13==5?"checked":"")?>/><label for="scores_13_5">A.5</label>
                <input id="scores_13_4" type="radio" name="scores_13" value="4" <?php echo (@$scores_13==4?"checked":"")?>/><label for="scores_13_4">B.4</label>
                <input id="scores_13_3" type="radio" name="scores_13" value="3" <?php echo (@$scores_13==3?"checked":"")?>/><label for="scores_13_3">C.3</label>
                <input id="scores_13_2" type="radio" name="scores_13" value="2" <?php echo (@$scores_13==2?"checked":"")?>/><label for="scores_13_2">D.2</label>
                <input id="scores_13_1" type="radio" name="scores_13" value="1" <?php echo (@$scores_13==1?"checked":"")?>/><label for="scores_13_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">14.课堂上解答学生提出问题的耐心程度:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_14_5" type="radio" name="scores_14" value="5" <?php echo (@$scores_14==5?"checked":"")?>/><label for="scores_14_5">A.5</label>
                <input id="scores_14_4" type="radio" name="scores_14" value="4" <?php echo (@$scores_14==4?"checked":"")?>/><label for="scores_14_4">B.4</label>
                <input id="scores_14_3" type="radio" name="scores_14" value="3" <?php echo (@$scores_14==3?"checked":"")?>/><label for="scores_14_3">C.3</label>
                <input id="scores_14_2" type="radio" name="scores_14" value="2" <?php echo (@$scores_14==2?"checked":"")?>/><label for="scores_14_2">D.2</label>
                <input id="scores_14_1" type="radio" name="scores_14" value="1" <?php echo (@$scores_14==1?"checked":"")?>/><label for="scores_14_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">15.善于激发学生的学习热情、明确学习目标和方法:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_15_5" type="radio" name="scores_15" value="5" <?php echo (@$scores_15==5?"checked":"")?>/><label for="scores_15_5">A.5</label>
                <input id="scores_15_4" type="radio" name="scores_15" value="4" <?php echo (@$scores_15==4?"checked":"")?>/><label for="scores_15_4">B.4</label>
                <input id="scores_15_3" type="radio" name="scores_15" value="3" <?php echo (@$scores_15==3?"checked":"")?>/><label for="scores_15_3">C.3</label>
                <input id="scores_15_2" type="radio" name="scores_15" value="2" <?php echo (@$scores_15==2?"checked":"")?>/><label for="scores_15_2">D.2</label>
                <input id="scores_15_1" type="radio" name="scores_15" value="1" <?php echo (@$scores_15==1?"checked":"")?>/><label for="scores_15_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
        <tr>
            <td align="left" class="l-table-edit-td" valign="top">16.能够公平平等的对待每位学员:</td>
            <td align="left" class="l-table-edit-td">
                <input id="scores_16_5" type="radio" name="scores_16" value="5" <?php echo (@$scores_16==5?"checked":"")?>/><label for="scores_16_5">A.5</label>
                <input id="scores_16_4" type="radio" name="scores_16" value="4" <?php echo (@$scores_16==4?"checked":"")?>/><label for="scores_16_4">B.4</label>
                <input id="scores_16_3" type="radio" name="scores_16" value="3" <?php echo (@$scores_16==3?"checked":"")?>/><label for="scores_16_3">C.3</label>
                <input id="scores_16_2" type="radio" name="scores_16" value="2" <?php echo (@$scores_16==2?"checked":"")?>/><label for="scores_16_2">D.2</label>
                <input id="scores_16_1" type="radio" name="scores_16" value="1" <?php echo (@$scores_16==1?"checked":"")?>/><label for="scores_16_1">E.1</label>
            </td>
            <td align="left"></td>
        </tr>
    </table>
    <br>
    <input type="hidden" name="class_id" id="class_id" value="<?php echo @$class_id?>" />
    <input type="hidden" name="course_id" id="course_id" value="<?php echo @$course_id?>" />
    <input type="hidden" name="subject_id" id="subject_id" value="<?php echo @$subject_id?>" />
    <input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo @$teacher_id?>" />
    <input type="button" value="提交" class="l-button l-button-submit" onclick="addSatisfaction()"/>
    <input type="button" value="返回" class="l-button l-button-submit" onclick="returnPage()"/>
</form>
<div style="display:none"></div>
</body>
</html>