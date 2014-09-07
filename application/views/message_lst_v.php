<?php require_once("_header.php");?>
<script type="text/javascript">
    var messageData = <?php echo $messageData?>;
    var grid = null;
    $(function () {
        grid = $("#maingrid").ligerGrid({
            columns: [
            { display: '日期', name: 'message_date', align: 'left', width: 80 },
            { display: '姓名', name: 'message_user', align: 'left', width: 80 },
            { display: '标题', name: 'message_title', align: 'left', width: 260 },
            { display: '内容', name: 'message_content', align: 'left', width: 610 }
            ],
            pageSize:10,
            where : f_getWhere(),
            data: $.extend(true,{},messageData),
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
        document.form.submit();
    }

    function regist_click()
    {
        location.href='<?php echo SITE_URL;?>/message_c/add_message_init';
    }
</script>

<body style="padding:6px; overflow:hidden;">
<div id="pageloading"></div>
<div id="searchbar"></div>
<form name="form" method="post" action="<?php echo SITE_URL.'/message_c';?>" id="form">
    <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr>
            &nbsp年月:
            <select name="start_year" id="start_year" onchange="search_click()">
            <?php for($i=0;$i<12;$i++){ ?>
                <?php if(@$start_year==($i+2014)){ ?>
                    <option value="<?php echo ($i+2014); ?>" selected><?php echo ($i+2014); ?></option>
                <?php } else {?>
                    <option value="<?php echo ($i+2014); ?>"><?php echo ($i+2014); ?></option>
                <?php } ?>
            <?php } ?>
            </select>
            <select name="start_month" id="start_month" onchange="search_click()">
            <?php for($i=0;$i<12;$i++){ ?>
              <?php if(@$start_month==($i+1)){ ?>
                  <option value="<?php echo ($i+1); ?>" selected><?php echo ($i+1); ?></option>
              <?php } else {?>
                  <option value="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></option>
              <?php }?>
            <?php } ?>
            </select>
            &nbsp标题：
            <input name="txtKey" id="txtKey" type="text" maxlength="20" style="width:200px" value="<?php echo @$search_key ?>" />&nbsp
            <input type="submit" value=" 查 询 " />&nbsp
            <?php if ($show_flg == "0"){?>
                <input type="button" value="校长留言" onclick="regist_click()" />
            <?php } ?>
        </tr>
    </table>
    <br>
    <div id="maingrid" style="margin:0; padding:0"></div>
</form>
<div style="display:none;"></div>
</body>
