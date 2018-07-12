<?php

/* index.html */
class __TwigTemplate_3fdc19d749aa1a5985ef2189ba9ed6606106e862846b79afe466ee4c84a3e0dc extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'css' => array($this, 'block_css'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"language\" content=\"zh_cn\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\" />
    <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    ";
        // line 8
        $this->displayBlock('css', $context, $blocks);
        // line 13
        echo "</head>

<body class=\"easyui-layout\" style=\"overflow-y: hidden\"  scroll=\"no\">
<div region=\"north\" split=\"true\" border=\"false\" style=\"overflow: hidden; height: 30px;background: url(";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/img/layout-browser-hd-bg.gif) #7f99be repeat-x center 50%;line-height: 20px;color: #fff; font-family: Verdana, 微软雅黑,黑体\">
    <div style=\"float:left; margin-left: 50%\" >京东卡未处理订单<span style=\"color: red;font-weight: bold\">";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["jdcard"]) ? $context["jdcard"] : null), "html", null, true);
        echo "</span>个,回购未付款订单<span style=\"color: red;font-weight: bold\">";
        echo twig_escape_filter($this->env, (isset($context["jdback"]) ? $context["jdback"] : null), "html", null, true);
        echo "</span>个</div>
    <span style=\"float:right; padding-right:20px;\" class=\"head\">管理员(";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "admin", array()), "identity", array()), "username", array()), "html", null, true);
        echo ")&nbsp;<a href=\"#\" id=\"editpass\">修改密码</a> <a href=\"#\" id=\"loginOut\">安全退出</a></span>

</div>

<div region=\"south\" split=\"true\" style=\"height: 30px; background: #D2E0F2; \">
    <div class=\"footer\"></div>
</div>
<div region=\"west\" hide=\"true\" split=\"true\" title=\"导航菜单\" style=\"width:180px;\" id=\"west\">
    <div id=\"nav\" class=\"easyui-accordion\" fit=\"true\" border=\"false\">
    </div>
</div>
<div id=\"mainPanle\" region=\"center\" style=\"background: #eee; overflow-y:hidden\">
    <div id=\"tabs\" class=\"easyui-tabs\"  fit=\"true\" border=\"false\" >
        <div title=\"首页\" style=\"padding:20px;overflow:hidden;\" id=\"home\">

        </div>
    </div>
</div>

<div id=\"mm\" class=\"easyui-menu\" style=\"width:150px;\">
    <div id=\"mm-tabupdate\">刷新</div>
    <div class=\"menu-sep\"></div>
    <div id=\"mm-tabclose\">关闭</div>
    <div id=\"mm-tabcloseall\">全部关闭</div>
    <div id=\"mm-tabcloseother\">除此之外全部关闭</div>
    <div class=\"menu-sep\"></div>
    <div id=\"mm-tabcloseright\">当前页右侧全部关闭</div>
    <div id=\"mm-tabcloseleft\">当前页左侧全部关闭</div>
    <div class=\"menu-sep\"></div>
    <div id=\"mm-exit\">退出</div>
</div>


<script src=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/jquery.min.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/jquery.easyui.min.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/outlook2.js\" type=\"text/javascript\"></script>
<script>

    \$(function() {
        \$.post('/default/get-menu', function(data) {
            \$.each(data, function(i, v) {
                selected = i == 0 ? true : false;
                \$('#nav').accordion('add', {
                    title: v.text,
                    content: \"<ul id='tree\"+i+\"' ></ul>\",
                    selected: selected,
                    //iconCls:e.iconCls//e.Icon
                });
                \$(\"#tree\" + i).tree({
                    data: v.children,
                    onClick: onClick
                });
            });
        });

        if (location.hash.length>0) {
            addTab('tab',location.hash.substr(1));
        }
    })
    \$('#loginOut').click(function() {
        \$.messager.confirm('系统提示', '您确定要退出本次登录吗?', function(r) {
            if (r) {
                location.href = '";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/default/logout"), "html", null, true);
        echo "';
            }
        });
    });
    function onClick(node) {
        if (node.attributes.url != '') {
            addTab(node.text, node.attributes.url);
            location.hash = '#'+node.attributes.url;
        }
    }
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.start_time = \$('#start_time').datetimebox('getValue');
        queryParams.end_time = \$('#end_time').datetimebox('getValue');
        queryParams.orderId = \$('#orderId').val();
        queryParams.content = \$('#content').val();
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }
</script>
";
        // line 100
        $this->displayBlock('script', $context, $blocks);
        // line 101
        echo "</body>
</html>";
    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
    }

    // line 8
    public function block_css($context, array $blocks = array())
    {
        // line 9
        echo "    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/themes/gray/easyui.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/js/jquery-easyui-1.4.4/themes/icon.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "params", array()), "skinUrl", array()), "html", null, true);
        echo "/css/default.css\">
    ";
    }

    // line 100
    public function block_script($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 100,  172 => 11,  168 => 10,  163 => 9,  160 => 8,  155 => 7,  150 => 101,  148 => 100,  125 => 80,  95 => 53,  91 => 52,  87 => 51,  51 => 18,  45 => 17,  41 => 16,  36 => 13,  34 => 8,  30 => 7,  22 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">*/
/* <head>*/
/*     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />*/
/*     <meta name="language" content="zh_cn" />*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=Edge" />*/
/*     <title>{% block title %}{% endblock %}</title>*/
/*     {% block css %}*/
/*     <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/gray/easyui.css">*/
/*     <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/themes/icon.css">*/
/*     <link rel="stylesheet" type="text/css" href="{{ app.params.skinUrl }}/css/default.css">*/
/*     {% endblock %}*/
/* </head>*/
/* */
/* <body class="easyui-layout" style="overflow-y: hidden"  scroll="no">*/
/* <div region="north" split="true" border="false" style="overflow: hidden; height: 30px;background: url({{ app.params.skinUrl }}/img/layout-browser-hd-bg.gif) #7f99be repeat-x center 50%;line-height: 20px;color: #fff; font-family: Verdana, 微软雅黑,黑体">*/
/*     <div style="float:left; margin-left: 50%" >京东卡未处理订单<span style="color: red;font-weight: bold">{{jdcard}}</span>个,回购未付款订单<span style="color: red;font-weight: bold">{{jdback}}</span>个</div>*/
/*     <span style="float:right; padding-right:20px;" class="head">管理员({{ app.admin.identity.username }})&nbsp;<a href="#" id="editpass">修改密码</a> <a href="#" id="loginOut">安全退出</a></span>*/
/* */
/* </div>*/
/* */
/* <div region="south" split="true" style="height: 30px; background: #D2E0F2; ">*/
/*     <div class="footer"></div>*/
/* </div>*/
/* <div region="west" hide="true" split="true" title="导航菜单" style="width:180px;" id="west">*/
/*     <div id="nav" class="easyui-accordion" fit="true" border="false">*/
/*     </div>*/
/* </div>*/
/* <div id="mainPanle" region="center" style="background: #eee; overflow-y:hidden">*/
/*     <div id="tabs" class="easyui-tabs"  fit="true" border="false" >*/
/*         <div title="首页" style="padding:20px;overflow:hidden;" id="home">*/
/* */
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="mm" class="easyui-menu" style="width:150px;">*/
/*     <div id="mm-tabupdate">刷新</div>*/
/*     <div class="menu-sep"></div>*/
/*     <div id="mm-tabclose">关闭</div>*/
/*     <div id="mm-tabcloseall">全部关闭</div>*/
/*     <div id="mm-tabcloseother">除此之外全部关闭</div>*/
/*     <div class="menu-sep"></div>*/
/*     <div id="mm-tabcloseright">当前页右侧全部关闭</div>*/
/*     <div id="mm-tabcloseleft">当前页左侧全部关闭</div>*/
/*     <div class="menu-sep"></div>*/
/*     <div id="mm-exit">退出</div>*/
/* </div>*/
/* */
/* */
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/jquery.easyui.min.js" type="text/javascript"></script>*/
/* <script src="{{ app.params.skinUrl }}/js/jquery-easyui-1.4.4/outlook2.js" type="text/javascript"></script>*/
/* <script>*/
/* */
/*     $(function() {*/
/*         $.post('/default/get-menu', function(data) {*/
/*             $.each(data, function(i, v) {*/
/*                 selected = i == 0 ? true : false;*/
/*                 $('#nav').accordion('add', {*/
/*                     title: v.text,*/
/*                     content: "<ul id='tree"+i+"' ></ul>",*/
/*                     selected: selected,*/
/*                     //iconCls:e.iconCls//e.Icon*/
/*                 });*/
/*                 $("#tree" + i).tree({*/
/*                     data: v.children,*/
/*                     onClick: onClick*/
/*                 });*/
/*             });*/
/*         });*/
/* */
/*         if (location.hash.length>0) {*/
/*             addTab('tab',location.hash.substr(1));*/
/*         }*/
/*     })*/
/*     $('#loginOut').click(function() {*/
/*         $.messager.confirm('系统提示', '您确定要退出本次登录吗?', function(r) {*/
/*             if (r) {*/
/*                 location.href = '{{ url('/default/logout') }}';*/
/*             }*/
/*         });*/
/*     });*/
/*     function onClick(node) {*/
/*         if (node.attributes.url != '') {*/
/*             addTab(node.text, node.attributes.url);*/
/*             location.hash = '#'+node.attributes.url;*/
/*         }*/
/*     }*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.start_time = $('#start_time').datetimebox('getValue');*/
/*         queryParams.end_time = $('#end_time').datetimebox('getValue');*/
/*         queryParams.orderId = $('#orderId').val();*/
/*         queryParams.content = $('#content').val();*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* </script>*/
/* {% block script %}{% endblock %}*/
/* </body>*/
/* </html>*/
