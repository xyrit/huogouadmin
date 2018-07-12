<?php

/* backstage-log.html */
class __TwigTemplate_a95b6b757527999c100a8530e41ca0559d1b0b52c7c2b286016202126916778d extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "backstage-log.html", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@app/views/base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "
<div class=\"search\">
    <span>模块
        <input class=\"easyui-combotree\" name=\"module\" id=\"module\" data-options=\"url:'";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/log/get-module"), "html", null, true);
        echo "', method:'get'\" editable=\"true\" style=\"width:200px;\">
    </span>
    <span>时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <span>操作人
        <input class=\"easyui-textbox\" type=\"text\" name=\"admin\" id=\"admin\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\" class=\"easyui-datagrid\" title=\"后台操作日志\"
       data-options=\"
            rownumbers:false,
            singleSelect:true,
            pagination:true,
            method:'get',
            url:'";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("log/backstage-log"), "html", null, true);
        echo "',
            rownumbers: false,
            pageSize: 20,
            nowrap: false
        \">
    <thead>
    <tr>
        <th data-options=\"field:'id', width:80, align:'center'\">序号</th>
        <th data-options=\"field:'admin', width:200, align:'center'\">操作人</th>
        <th data-options=\"field:'name', width:100, align:'center'\">模块</th>
        <th data-options=\"field:'content', width:800, align:'center'\">内容</th>
        <th data-options=\"field:'created_at', width:180\" formatter=\"formatTime\">操作时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 43
    public function block_js($context, array $blocks = array())
    {
        // line 44
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.admin = \$('#admin').val();
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.module = \$('#module').combotree('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "backstage-log.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 44,  79 => 43,  58 => 25,  37 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>模块*/
/*         <input class="easyui-combotree" name="module" id="module" data-options="url:'{{ url('/log/get-module') }}', method:'get'" editable="true" style="width:200px;">*/
/*     </span>*/
/*     <span>时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <span>操作人*/
/*         <input class="easyui-textbox" type="text" name="admin" id="admin">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata" class="easyui-datagrid" title="后台操作日志"*/
/*        data-options="*/
/*             rownumbers:false,*/
/*             singleSelect:true,*/
/*             pagination:true,*/
/*             method:'get',*/
/*             url:'{{ url('log/backstage-log') }}',*/
/*             rownumbers: false,*/
/*             pageSize: 20,*/
/*             nowrap: false*/
/*         ">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'id', width:80, align:'center'">序号</th>*/
/*         <th data-options="field:'admin', width:200, align:'center'">操作人</th>*/
/*         <th data-options="field:'name', width:100, align:'center'">模块</th>*/
/*         <th data-options="field:'content', width:800, align:'center'">内容</th>*/
/*         <th data-options="field:'created_at', width:180" formatter="formatTime">操作时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.admin = $('#admin').val();*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.module = $('#module').combotree('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
