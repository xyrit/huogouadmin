<?php

/* index.html */
class __TwigTemplate_89da8c17bbef901702a3d6314c41cc72a594921f5264326a8f5fefa9c64d86de extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "index.html", 1);
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
        echo "<div class=\"search\">
    <span>渠道名称
        <input type=\"text\" name=\"spread\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["spread"]) ? $context["spread"] : null), "html", null, true);
        echo "\" id=\"spread\">
    </span>&nbsp;
    <span>选择时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"starttime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endtime\">
    </span>&nbsp;
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>
<table title=\"数据统计\" id=\"listdata\" class=\"easyui-datagrid\"
       data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/spread/index"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
    <tr>
        <th data-options=\"field:'spread_source_name',align:'center'\" width=\"100\">渠道名称</th>
        <th data-options=\"field:'spread_source', align:'center'\" width=\"100\">渠道标示</th>
        <th data-options=\"field:'reg_nums', align:'center'\" width=\"100\">注册人数</th>
        <th data-options=\"field:'recharge_nums', align:'center'\" width=\"100\">充值人数</th>
        <th data-options=\"field:'recharge_money', align:'center'\" width=\"100\">充值金额</th>
        <th data-options=\"field:'consume_nums', align:'center'\" width=\"100\">消费人数</th>
        <th data-options=\"field:'consume_money', align:'center'\" width=\"100\">消费金额</th>
        <th data-options=\"field:'consume_point', align:'center'\" width=\"100\">消费积分</th>
    </tr>

    </thead>
</table>

";
    }

    // line 33
    public function block_js($context, array $blocks = array())
    {
        // line 34
        echo "<script type=\"text/javascript\">
    function reloadgrid(){
    var queryParams = \$('#listdata').datagrid('options').queryParams;
    queryParams.spread = \$('#spread').val();
    queryParams.starttime = \$('#starttime').datetimebox('getValue');
    queryParams.endtime = \$('#endtime').datetimebox('getValue');

    queryParams.random_param = Math.random();
    \$('#listdata').datagrid('options').queryParams = queryParams;
    \$(\"#listdata\").datagrid('reload');
}
</script>
";
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
        return array (  72 => 34,  69 => 33,  48 => 15,  36 => 6,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>渠道名称*/
/*         <input type="text" name="spread" value="{{spread}}" id="spread">*/
/*     </span>&nbsp;*/
/*     <span>选择时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="starttime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endtime">*/
/*     </span>&nbsp;*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* <table title="数据统计" id="listdata" class="easyui-datagrid"*/
/*        data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{ url('/spread/index') }}',rownumbers: false">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'spread_source_name',align:'center'" width="100">渠道名称</th>*/
/*         <th data-options="field:'spread_source', align:'center'" width="100">渠道标示</th>*/
/*         <th data-options="field:'reg_nums', align:'center'" width="100">注册人数</th>*/
/*         <th data-options="field:'recharge_nums', align:'center'" width="100">充值人数</th>*/
/*         <th data-options="field:'recharge_money', align:'center'" width="100">充值金额</th>*/
/*         <th data-options="field:'consume_nums', align:'center'" width="100">消费人数</th>*/
/*         <th data-options="field:'consume_money', align:'center'" width="100">消费金额</th>*/
/*         <th data-options="field:'consume_point', align:'center'" width="100">消费积分</th>*/
/*     </tr>*/
/* */
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     function reloadgrid(){*/
/*     var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*     queryParams.spread = $('#spread').val();*/
/*     queryParams.starttime = $('#starttime').datetimebox('getValue');*/
/*     queryParams.endtime = $('#endtime').datetimebox('getValue');*/
/* */
/*     queryParams.random_param = Math.random();*/
/*     $('#listdata').datagrid('options').queryParams = queryParams;*/
/*     $("#listdata").datagrid('reload');*/
/* }*/
/* </script>*/
/* {% endblock %}*/
/* */
