<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="zh-cn">
<head>
    <title>学生信息管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?php echo SITE_URL;?>/statics/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SITE_URL;?>/statics/default.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo SITE_URL;?>/statics/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL;?>/statics/ligerUI/js/ligerui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
            var tab = null;
            var accordion = null;
            var tree = null;
            $(function ()
            {

                //布局
                $("#layout").ligerLayout({ leftWidth: 190, height: '100%',heightDiff:-34,space:4, onHeightChanged: f_heightChanged });

                var height = $(".l-layout-center").height();

                //Tab
                $("#framecenter").ligerTab({ height: height });

                //面板
                $("#accordion").ligerAccordion({ height: height - 24, speed: null });

                $(".l-link").hover(function ()
                {
                    $(this).addClass("l-link-over");
                }, function ()
                {
                    $(this).removeClass("l-link-over");
                });

                tab = $("#framecenter").ligerGetTabManager();
                accordion = $("#accordion").ligerGetAccordionManager();
                $("#pageloading").hide();

            });
            function f_heightChanged(options)
            {
                if (tab)
                    tab.addHeight(options.diff);
                if (accordion && options.middleHeight - 24 > 0)
                    accordion.setHeight(options.middleHeight - 24);
            }
            function f_addTab(tabid,text, url)
            {
                tab.addTabItem({ tabid : tabid,text: text, url: url });
            }
     </script>

</head>
<body style="padding:0px;background:#EAEEF5;">
    <div id="pageloading"></div>
    <div id="topmenu" class="l-topmenu">
    <div ><font color=white size="4">&nbsp&nbsp学生信息管理系统</font></div>
    <div class="l-topmenu-welcome">
         <font color=white><?php echo $username;?></font>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="<?php echo SITE_URL;?>/menu_c/logout" class="l-link2">退出</a>
    </div>
    </div>
    <div id="layout" style="width:99.2%; margin:0 auto; margin-top:4px; ">
        <div position="left"  title="主要菜单" id="accordion">
            <?php for($i=0;$i<count($menu);$i++){?>
                <div title="<?php echo $menu[$i]['function_name']?>">
                    <div style=" height:5px;"></div>
                    <?php for($j=0;$j<count($url);$j++){?>
                        <?php if ($menu[$i]['function_id'] == $url[$j]['function_id']) {?>
                            <a class="l-link" href="javascript:f_addTab('<?php echo $i.$j;?>','<?php echo $url[$j]['url_name'];?>','<?php echo SITE_URL;?>/<?php echo $url[$j]['url'];?>')"><?php echo $url[$j]['url_name'];?></a>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div position="center" id="framecenter">
            <div tabid="home" title="我的主页" style="height:300px" >
                <iframe frameborder="0" name="home" id="home" src="<?php echo SITE_URL;?>/welcome_c"></iframe>
            </div>
        </div>
    </div>
    <div  style="height:32px; line-height:32px; text-align:center;">
            Copyright © 2014 www.crystaledu.com
    </div>
    <div style="display:none"></div>
</body>
</html>
