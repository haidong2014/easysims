<?php require_once("_header.php");?>
<script type="text/javascript">
    $(function () {
        $("#pageloading").hide();
    });

    function search_click(){
        document.form.download_flg.value = "0";
        document.form.submit();
    }
    function download_click(){
        document.form.download_flg.value = "1";
        document.form.submit();
    }
    function paging_click(){
        document.form.submit();
    }
</script>
</head>
<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/art_c/search';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
        <td>
        &nbsp入学年月：
            <select name="start_year" id="start_year" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=0;$i<12;$i++){ ?>
                <?php if(@$start_year==($i+2010)){ ?>
                    <option value="<?php echo ($i+2010); ?>" selected><?php echo ($i+2010); ?></option>
                <?php } else {?>
                    <option value="<?php echo ($i+2010); ?>"><?php echo ($i+2010); ?></option>
                <?php } ?>
            <?php } ?>
            </select>
            <select name="start_month" id="start_month" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=0;$i<12;$i++){ ?>
              <?php if(@$start_month==($i+1)){ ?>
                  <option value="<?php echo ($i+1); ?>" selected><?php echo ($i+1); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
              <?php }?>
            <?php } ?>
            </select>
        </td>
        <td>
        &nbsp学员成绩：
        <select name="scores_from" id="scores_from" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=1;$i<=10;$i++){ ?>
              <?php if(@$scores_from==($i*10)){ ?>
                  <option value="<?php echo ($i*10); ?>" selected><?php echo ($i*10); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i*10); ?>"><?php echo ($i*10); ?></option>
              <?php }?>
            <?php } ?>
        </select>
        &nbsp到&nbsp
        <select name="scores_to" id="scores_to" ltype="select" onchange="search_click()">
            <option value=""></option>
            <?php for($i=1;$i<=10;$i++){ ?>
              <?php if(@$scores_to==($i*10)){ ?>
                  <option value="<?php echo ($i*10); ?>" selected><?php echo ($i*10); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i*10); ?>"><?php echo ($i*10); ?></option>
              <?php }?>
            <?php } ?>
        </select>
        </td>
        <td></td>
        </tr>
        <tr>
        <td>
            &nbsp班级名称：
            <input type="text" name="class_name" id="class_name" maxlength="30" style="width:160px" value="<?php echo @$class_name ?>" />&nbsp
		</td>
        <td>
            &nbsp学生姓名：
            <input type="text" name="student_name" id="student_name" maxlength="30" style="width:160px" value="<?php echo @$student_name ?>" />&nbsp
		</td>
        <td>
            <input id="search" type="submit" value=" 查 询 " onclick="search_click()" />
            <input id="search" type="submit" value=" 作品批量下载 " onclick="download_click()" />
            <input type="hidden" name="download_flg" id="download_flg"/>
        </td>
        </tr>
    </table>
    <table style="width:840px;">
      <tr>
        <td colspan="3">&nbsp<span style="color:red">注：作品展示最多只能表示20页数据。如果您没有找到希望查看的作品，请重新设置查询条件。</span></td>
        <td style="text-align:right">
            &nbsp翻页：
            <select name="paging" id="paging" ltype="select" onchange="paging_click()">
            <?php for($i=1;$i<=@$paging_max;$i++){ ?>
                <?php if(@$paging==$i){ ?>
                    <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                <?php } else {?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            <?php } ?>
            </select>&nbsp
        </td>
      </tr>
      <tr>
          <td colspan="4"><hr size=1></td>
      </tr>
      <tr>
      <?php $j = 1; ?>
      <?php foreach(@$searchData as $temp){ ?>
          <?php if ($j <= 4) { ?>
              <td align="left" style="padding:5px;width:200px;"><image src="<?php echo SITE_URL."/upload/".$temp['works_path'] ?>" width="200" height="150" title="<?php echo "班级：".$temp['class_name']."  课程：".$temp['course_name']."  科目：".$temp['subject_name'] ?>"><br><?php echo $temp['student_name'] ?>&nbsp;<?php echo $temp['works_scores'] ?>分</td>
          <?php } else { ?>
          <?php } ?>
          <?php $j = $j + 1; ?>
      <?php } ?>
      <?php if ($j < 5) { ?>
          <?php for($i=$j;$i<5;$i++) { ?>
              <td align="left" style="padding:5px;width:200px;"></td>
          <?php } ?>
      <?php } ?>
      </tr>
      <tr>
      <?php $j = 1; ?>
      <?php foreach(@$searchData as $temp){ ?>
          <?php if ($j <= 4) { ?>
          <?php } else { ?>
              <td align="left" style="padding:5px;width:200px;"><image src="<?php echo SITE_URL."/upload/".$temp['works_path'] ?>" width="200" height="150" title="<?php echo "班级：".$temp['class_name']."  课程：".$temp['course_name']."  科目：".$temp['subject_name'] ?>"><br><?php echo $temp['student_name'] ?>&nbsp;<?php echo $temp['works_scores'] ?>分</td>
          <?php } ?>
          <?php $j = $j + 1; ?>
      <?php } ?>
      </tr>
    </table>
</form>
<div style="display:none;"></div>
</body>
</html>
