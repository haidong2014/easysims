<?php require_once("_header.php");?>
<script type="text/javascript">
    $(function () {
        $("#pageloading").hide();
    });

    function search_click(){
        document.form.run_mode.value = "0";
        document.form.submit();
    }
    function download_click(){
        document.form.run_mode.value = "1";
        document.form.submit();
    }
    function paging_click(){
        document.form.run_mode.value = "2";
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
                <?php if(@$start_year==($i+2014)){ ?>
                    <option value="<?php echo ($i+2014); ?>" selected><?php echo ($i+2014); ?></option>
                <?php } else {?>
                    <option value="<?php echo ($i+2014); ?>"><?php echo ($i+2014); ?></option>
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
        <td colspan="2">
            &nbsp学生姓名：
            <input type="text" name="txtKey" id="txtKey" maxlength="20" style="width:160px" value="<?php echo @$txtKey ?>" />&nbsp
            <input id="search" type="submit" value=" 查 询 " onclick="search_click()" />
            <input id="search" type="submit" value=" 作品批量下载 " onclick="download_click()" />
            <input type="hidden" name="run_mode" id="run_mode"/>
        </td>
        </tr>
    </table>
    <table>
      <tr>
        <td colspan="3">&nbsp<span style="color:red">注：作品展示最多只能表示10页数据。如果您没有找到希望查看的作品，请从新设置查询条件。</span></td>
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
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>赵小燕&nbsp;90分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>钱小燕&nbsp;80分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>孙小燕&nbsp;80分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>李小燕&nbsp;85分</td>
      </tr>
      <tr>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>周小燕&nbsp;95分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>吴小燕&nbsp;80分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>郑小燕&nbsp;90分</td>
        <td align="center" style="padding:5px;"><image src="" width="200" height="150"><br>王小燕&nbsp;80分</td>
      </tr>
    </table>
</form>
<div style="display:none;"></div>
</body>
</html>
